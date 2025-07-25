<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function rescheduleSingle(Request $request, Appointment $appointment)
    {
        $validator = Validator::make($request->all(), [
            'new_date' => 'required|date|after_or_equal:today',
            'new_time' => 'required|date_format:H:i'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        if (!in_array($appointment->status, ['scheduled', 'pending', 'rescheduled'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Only scheduled, pending or rescheduled appointments can be rescheduled'
            ], 400);
        }

        try {
            $newDateTime = Carbon::parse($request->new_date . ' ' . $request->new_time, 'Asia/Kolkata');
            $doctor = $appointment->doctor;

            if (!$doctor) {
                \Log::error("Doctor not found for appointment {$appointment->id}");
                return response()->json([
                    'status' => 'error',
                    'message' => 'Doctor not found for this appointment'
                ], 404);
            }

            $availableSlots = $doctor->generateTimeSlots($request->new_date);

            if (empty($availableSlots)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No available slots for the selected date. The doctor may be fully booked or unavailable.',
                    'available_slots' => []
                ], 400);
            }

            $isSlotAvailable = false;
            foreach ($availableSlots as $slot) {
                $slotTime = Carbon::parse($slot['time_value'])->format('H:i');
                if ($slotTime === $request->new_time && $slot['remaining_capacity'] > 0) {
                    $isSlotAvailable = true;
                    break;
                }
            }

            if (!$isSlotAvailable) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'The selected time slot is no longer available. Please choose another time.',
                    'available_slots' => $availableSlots
                ], 400);
            }

            $appointment->update([
                'original_date' => $appointment->appointment_date,
                'appointment_date' => $newDateTime->format('Y-m-d'),
                'appointment_time' => $newDateTime->format('H:i:s'),
                'rescheduled' => true,
                'status' => 'rescheduled',
                'rescheduled_at' => now()
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Appointment rescheduled successfully',
                'new_date' => $newDateTime->format('Y-m-d'),
                'new_time' => $newDateTime->format('H:i')
            ]);

        } catch (\Exception $e) {
            \Log::error("Failed to reschedule appointment {$appointment->id}: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to reschedule appointment: ' . $e->getMessage()
            ], 500);
        }
    }

public function rescheduleAll(Request $request)
{
    $validator = Validator::make($request->all(), [
        'appointment_ids' => 'required|array',
        'appointment_ids.*' => 'exists:appointments,id',
        'new_date' => 'required|date|after_or_equal:today',
        'new_time' => 'required|date_format:H:i'
    ]);

    if ($validator->fails()) {
        \Log::error('Bulk reschedule validation failed', ['errors' => $validator->errors()->all()]);
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 422);
    }

    DB::beginTransaction();

    try {
        $appointments = Appointment::with('doctor')
            ->whereIn('id', $request->appointment_ids)
            ->get();

        \Log::info('Appointments for bulk reschedule', [
            'count' => $appointments->count(),
            'ids' => $appointments->pluck('id')->toArray()
        ]);

        // Verify we found all requested appointments
        if ($appointments->count() !== count($request->appointment_ids)) {
            $missing = array_diff($request->appointment_ids, $appointments->pluck('id')->toArray());
            \Log::error('Some appointments not found', ['missing_ids' => $missing]);
            throw new \Exception('Some appointments could not be found');
        }

        // Check all appointments belong to the same doctor
        $doctorIds = $appointments->pluck('doctor_id')->unique();
        if ($doctorIds->count() > 1) {
            \Log::error('Multiple doctors in bulk reschedule', [
                'doctor_ids' => $doctorIds->toArray(),
                'appointment_ids' => $request->appointment_ids
            ]);
            throw new \Exception('All appointments must belong to the same doctor');
        }

        $doctor = $appointments->first()->doctor;
        if (!$doctor) {
            \Log::error('Doctor not found for appointments', [
                'doctor_id' => $doctorIds->first(),
                'appointment_ids' => $request->appointment_ids
            ]);
            throw new \Exception('Doctor not found for these appointments');
        }

        // Check slot availability
        $newDateTime = Carbon::parse($request->new_date . ' ' . $request->new_time, 'Asia/Kolkata');
        $availableSlots = $doctor->generateTimeSlots($request->new_date);
        
        \Log::info('Available slots for bulk reschedule', [
            'date' => $request->new_date,
            'slots' => $availableSlots,
            'requested_time' => $request->new_time
        ]);

        $isSlotAvailable = false;
        $selectedSlotCapacity = 0;
        
        foreach ($availableSlots as $slot) {
            $slotTime = Carbon::parse($slot['time_value'])->format('H:i');
            if ($slotTime === $request->new_time) {
                $selectedSlotCapacity = $slot['remaining_capacity'];
                $isSlotAvailable = $slot['remaining_capacity'] >= count($request->appointment_ids);
                break;
            }
        }

        if (!$isSlotAvailable) {
            \Log::error('Insufficient slot capacity', [
                'required' => count($request->appointment_ids),
                'available' => $selectedSlotCapacity
            ]);
            throw new \Exception("The selected time slot only has {$selectedSlotCapacity} available spots, but you're trying to reschedule " . count($request->appointment_ids) . " appointments");
        }

        $successCount = 0;
        $failedAppointments = [];
        
        foreach ($appointments as $appointment) {
            try {
                if (!in_array($appointment->status, ['scheduled', 'pending', 'rescheduled'])) {
                    $failedAppointments[$appointment->id] = 'Invalid status: ' . $appointment->status;
                    continue;
                }
                
                $appointment->update([
                    'original_date' => $appointment->appointment_date,
                    'original_time' => $appointment->appointment_time,
                    'appointment_date' => $newDateTime->format('Y-m-d'),
                    'appointment_time' => $newDateTime->format('H:i:s'),
                    'rescheduled' => true,
                    'status' => 'rescheduled',
                    'rescheduled_at' => now()
                ]);
                
                $successCount++;
                
            } catch (\Exception $e) {
                $failedAppointments[$appointment->id] = $e->getMessage();
                \Log::error("Failed to reschedule appointment {$appointment->id}", [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }
        
        DB::commit();

        \Log::info('Bulk reschedule completed', [
            'success_count' => $successCount,
            'failed_count' => count($failedAppointments),
            'failed_appointments' => $failedAppointments
        ]);

        return response()->json([
            'status' => 'success',
            'message' => "Successfully rescheduled {$successCount} appointments",
            'success_count' => $successCount,
            'failed' => $failedAppointments,
            'failed_count' => count($failedAppointments)
        ]);
        
    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error("Bulk rescheduling failed", [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'request' => $request->all()
        ]);

        return response()->json([
            'status' => 'error',
            'message' => 'Bulk rescheduling failed: ' . $e->getMessage()
        ], 500);
    }
}

    public function cancelRescheduled(Request $request, Appointment $appointment)
    {
        if (!$appointment->rescheduled) {
            return response()->json([
                'status' => 'error',
                'message' => 'Only rescheduled appointments can be cancelled'
            ], 400);
        }

        try {
            $appointment->update(['status' => 'cancelled']);
            return response()->json([
                'status' => 'success',
                'message' => 'Appointment cancelled successfully'
            ]);

        } catch (\Exception $e) {
            \Log::error("Failed to cancel appointment {$appointment->id}: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to cancel appointment: ' . $e->getMessage()
            ], 500);
        }
    }

    public function requestNextDay(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'appointment_id' => 'required|exists:appointments,id',
            'desired_date' => 'required|date|after:today'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $original = Appointment::findOrFail($request->appointment_id);
            $newAppointment = $original->replicate();
            $newAppointment->appointment_date = $request->desired_date;
            $newAppointment->status = 'pending';
            $newAppointment->rescheduled = false;
            $newAppointment->original_date = null;
            $newAppointment->save();

            return response()->json([
                'status' => 'success',
                'message' => 'New appointment requested successfully',
                'appointment_id' => $newAppointment->id
            ]);

        } catch (\Exception $e) {
            \Log::error("Failed to request new appointment for original ID {$request->appointment_id}: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to request new appointment: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getAvailableSlots(Doctor $doctor, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date|after_or_equal:today'
        ]);

        if ($validator->fails()) {
            \Log::warning("Invalid date input for doctor {$doctor->id}: " . json_encode($validator->errors()));
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $date = $request->query('date');
            $slots = $doctor->generateTimeSlots($date);

            return response()->json([
                'status' => 'success',
                'slots' => $slots,
                'message' => empty($slots) ? 'No available slots for this date' : 'Slots retrieved successfully'
            ]);

        } catch (\Exception $e) {
            \Log::error("Failed to fetch slots for doctor {$doctor->id} on {$date}: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch available slots: ' . $e->getMessage()
            ], 500);
        }
    }
}