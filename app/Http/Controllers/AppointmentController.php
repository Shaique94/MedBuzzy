<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
            'appointment_ids' => ['required', 'array'],
            'appointment_ids.*' => ['required', 'integer', 'exists:appointments,id'],
            'new_date' => ['required', 'date', 'after:today'],
            'new_time' => ['required', 'date_format:H:i'],
        ]);

        if ($validator->fails()) {
            Log::error('Bulk reschedule validation failed', ['errors' => $validator->errors()->all()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        Log::info('Request data', $request->all());

        $appointments = Appointment::whereIn('id', $request->appointment_ids)
            ->where('rescheduled', false)
            ->get();

        Log::info('Appointments for bulk reschedule', [
            'count' => $appointments->count(),
            'ids' => $appointments->pluck('id')->toArray(),
        ]);

        if ($appointments->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No valid appointments found for rescheduling',
            ], 400);
        }

        $doctorIds = $appointments->pluck('doctor_id')->unique();
        if ($doctorIds->count() > 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'All appointments must belong to the same doctor',
            ], 400);
        }

        $doctor = Doctor::find($doctorIds->first());
        if (!$doctor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor not found',
            ], 404);
        }

        $newDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->new_date . ' ' . $request->new_time, 'Asia/Kolkata');
        $availableSlots = $doctor->generateTimeSlots($request->new_date);

        Log::info('Available slots for bulk reschedule', [
            'date' => $request->new_date,
            'slots' => $availableSlots,
            'requested_time' => $request->new_time,
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
            Log::error('Insufficient slot capacity', [
                'required' => count($request->appointment_ids),
                'available' => $selectedSlotCapacity,
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Selected slot is not available or has insufficient capacity',
            ], 400);
        }

        $successCount = 0;
        $failedAppointments = [];

        foreach ($appointments as $appointment) {
            Log::info('Processing appointment', ['id' => $appointment->id, 'status' => $appointment->status]);
            if (!in_array($appointment->status, ['scheduled', 'pending', 'rescheduled'])) {
                $failedAppointments[$appointment->id] = 'Invalid status: ' . $appointment->status;
                Log::warning("Skipping appointment {$appointment->id} due to invalid status: {$appointment->status}");
                continue;
            }

            try {
                $updateData = [
                    'original_date' => $appointment->appointment_date->toDateString(),
                    'appointment_date' => $newDateTime,
                    'appointment_time' => $newDateTime->format('H:i:s'),
                    'rescheduled' => true,
                    'status' => 'rescheduled',
                    'rescheduled_at' => now(),
                    'reschedule_reason' => 'Bulk reschedule by manager',
                ];
                Log::info('Update data', ['id' => $appointment->id, 'data' => $updateData]);
                $result = $appointment->update($updateData);
                Log::info('Update result', ['id' => $appointment->id, 'result' => $result]);
                $successCount++;
                Log::info("Rescheduled appointment {$appointment->id} to {$newDateTime}");
            } catch (\Exception $e) {
                $failedAppointments[$appointment->id] = $e->getMessage();
                Log::error("Failed to reschedule appointment {$appointment->id}: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            }
        }

        $failedCount = count($failedAppointments);
        if ($successCount === 0 && $failedCount > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'No appointments were rescheduled',
                'failed' => $failedAppointments,
                'failed_count' => $failedCount,
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => "Successfully rescheduled {$successCount} appointments",
            'success_count' => $successCount,
            'failed' => $failedAppointments,
            'failed_count' => $failedCount,
        ], $successCount > 0 ? 200 : 400);
    }

    public function checkStatuses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'appointment_ids' => 'required|array',
            'appointment_ids.*' => 'exists:appointments,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $appointments = Appointment::whereIn('id', $request->appointment_ids)->get();
        $invalidAppointments = $appointments->filter(function ($appointment) {
            return !in_array($appointment->status, ['scheduled', 'pending', 'rescheduled']);
        })->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'status' => $appointment->status
            ];
        })->values();

        return response()->json([
            'status' => 'success',
            'invalid_appointments' => $invalidAppointments
        ]);
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

    public function bulkReschedule(Request $request)
    {
        $validated = $request->validate([
            'newDate' => 'required|date|after:today',
            'selectedSlot' => 'required|date_format:H:i:s',
            'appointmentIds' => 'required|array',
            'reason' => 'nullable|string|max:255'
        ]);

        \Log::debug('Reschedule data:', $validated);

        $updatedCount = 0;
        $errors = [];

        foreach ($validated['appointmentIds'] as $id) {
            try {
                $appointment = Appointment::findOrFail($id);

                $appointment->update([
                    'original_date' => $appointment->appointment_date,
                    'original_appointment_id' => $appointment->id,
                    'appointment_date' => $validated['newDate'],
                    'appointment_time' => $validated['selectedSlot'],
                    'rescheduled' => true,
                    'is_rescheduled' => true,
                    'status' => 'rescheduled',
                    'rescheduled_at' => now(),
                    'reschedule_reason' => $validated['reason'] ?? 'Bulk reschedule'
                ]);

                $updatedCount++;

            } catch (\Exception $e) {
                $errors[$id] = $e->getMessage();
                \Log::error("Failed to reschedule appointment {$id}: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => $updatedCount > 0,
            'updated' => $updatedCount,
            'errors' => $errors
        ]);
    }
}