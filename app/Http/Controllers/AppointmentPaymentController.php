<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Razorpay\Api\Utility;

class AppointmentPaymentController extends Controller
{
    private $api;
    private $amount = 5000; // Fixed ₹50 (5000 paise)

    public function __construct()
    {
        try {
            $key = config('services.razorpay.key');
            $secret = config('services.razorpay.secret');
            
            if (!$key || !$secret) {
                Log::error('Razorpay configuration missing in constructor', [
                    'has_key' => !empty($key),
                    'has_secret' => !empty($secret)
                ]);
                throw new \Exception('Razorpay configuration is missing');
            }
            
            $this->api = new Api($key, $secret);
            
        } catch (\Exception $e) {
            Log::error('Failed to initialize Razorpay API: ' . $e->getMessage());
            // Don't throw exception here to allow error handling in individual methods
            $this->api = null;
        }
    }

    /**
     * Show payment page for appointment
     */
    public function show(Appointment $appointment)
    {
        Log::info('Payment page access attempt', [
            'appointment_id' => $appointment->id,
            'appointment_status' => $appointment->status,
            'user_id' => auth()->id()
        ]);

        // Check if appointment exists and is pending
        if (!$appointment || $appointment->status !== 'pending') {
            Log::warning('Payment page redirect - Invalid appointment or status', [
                'appointment_id' => $appointment->id ?? 'null',
                'status' => $appointment->status ?? 'null',
                'expected_status' => 'pending'
            ]);
            return redirect()->route('hero')->with('error', 'Invalid appointment or payment already completed.');
        }

        // Check if payment already exists and is successful
        $existingPayment = Payment::where('appointment_id', $appointment->id)
            ->where('status', 'paid')
            ->first();

        if ($existingPayment) {
            Log::info('Payment already completed, redirecting to confirmation', [
                'appointment_id' => $appointment->id,
                'payment_id' => $existingPayment->id
            ]);
            return redirect()->route('appointment.confirmation', ['id' => $appointment->id]);
        }

        // Check Razorpay configuration
        if (!config('services.razorpay.key') || !config('services.razorpay.secret')) {
            Log::error('Razorpay configuration missing', [
                'has_key' => !empty(config('services.razorpay.key')),
                'has_secret' => !empty(config('services.razorpay.secret'))
            ]);
            return redirect()->route('hero')->with('error', 'Payment service is not configured. Please contact support.');
        }

        try {
            DB::beginTransaction();

            // Create Razorpay order
            $order = $this->api->order->create([
                'amount' => $this->amount,
                'currency' => 'INR',
                'receipt' => 'appointment_' . $appointment->id . '_' . time(),
                'payment_capture' => 1
            ]);

            Log::info('Razorpay order created successfully', [
                'order_id' => $order['id'],
                'appointment_id' => $appointment->id,
                'amount' => $this->amount
            ]);

            // Create or update payment record
            Payment::updateOrCreate(
                ['appointment_id' => $appointment->id],
                [
                    'patient_id' => $appointment->patient_id,
                    'created_by' => auth()->id(),
                    'amount' => $this->amount / 100, // Store in rupees
                    'method' => 'upi',
                    'status' => 'pending',
                    'razorpay_order_id' => $order['id'],
                ]
            );

            DB::commit();

            Log::info('Payment page loaded successfully', [
                'appointment_id' => $appointment->id,
                'order_id' => $order['id']
            ]);

            return view('payment.show', [
                'order_id' => $order['id'],
                'amount' => $this->amount,
                'currency' => 'INR',
                'key' => config('services.razorpay.key'),
                'appointment_id' => $appointment->id,
                'appointment' => $appointment->load(['doctor.user', 'doctor.department', 'patient.user']),
                'patient_name' => $appointment->patient->name,
                'patient_email' => $appointment->patient->email,
                'patient_phone' => $appointment->patient->user->phone,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment order creation failed: ' . $e->getMessage(), [
                'appointment_id' => $appointment->id,
                'trace' => $e->getTraceAsString(),
                'razorpay_config' => [
                    'has_key' => !empty(config('services.razorpay.key')),
                    'has_secret' => !empty(config('services.razorpay.secret'))
                ]
            ]);
            
            return redirect()->route('hero')->with('error', 'Unable to process payment. Please try again. Error: ' . $e->getMessage());
        }
    }

    /**
     * Create Razorpay order
     */
    public function createOrder(Request $request, Appointment $appointment)
    {
        try {
            // Validate appointment
            if (!$appointment || $appointment->status !== 'pending') {
                return response()->json(['error' => 'Invalid appointment'], 400);
            }

            // Check if payment already exists
            $existingPayment = Payment::where('appointment_id', $appointment->id)->first();
            if ($existingPayment && $existingPayment->status === 'paid') {
                return response()->json(['error' => 'Payment already completed'], 400);
            }

            DB::beginTransaction();

            // Create Razorpay Order
            if (!config('services.razorpay.key') || !config('services.razorpay.secret')) {
                throw new \Exception('Razorpay configuration not found');
            }

            $order = $this->api->order->create([
                'amount' => $this->amount,
                'currency' => 'INR',
                'receipt' => 'appointment_' . $appointment->id . '_' . time(),
                'payment_capture' => $this->amount > 0 ? 1 : 0,
            ]);

            Log::info('Razorpay order created', ['orderId' => $order['id']]);

            // Create or update Payment record
            $payment = Payment::updateOrCreate(
                ['appointment_id' => $appointment->id],
                [
                    'patient_id' => $appointment->patient_id,
                    'created_by' => auth()->id(),
                    'amount' => $this->amount / 100, // Store in rupees
                    'method' => 'upi',
                    'status' => 'pending',
                    'razorpay_order_id' => $order['id'],
                ]
            );

            DB::commit();

            return view('payment.show', [
                'order_id' => $order['id'],
                'amount' => $this->amount,
                'currency' => 'INR',
                'key' => config('services.razorpay.key'),
                'appointment_id' => $appointment->id,
                'appointment' => $appointment->load(['doctor.user', 'doctor.department', 'patient.user']),
                'patient_name' => $appointment->patient->name,
                'patient_email' => $appointment->patient->email,
                'patient_phone' => $appointment->patient->user->phone,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment order creation failed: ' . $e->getMessage(), [
                'appointment_id' => $appointment->id,
                'trace' => $e->getTraceAsString(),
            ]);
            
            return response()->json(['error' => 'Failed to create payment order: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Verify payment and update records
     */
    public function verifyPayment(Request $request, Appointment $appointment)
    {
        try {
            $request->validate([
                'razorpay_payment_id' => 'required|string',
                'razorpay_order_id' => 'required|string',
                'razorpay_signature' => 'required|string',
            ]);

            // Verify signature
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            // Create the signature verification string
            $expectedSignature = hash_hmac('sha256', 
                $request->razorpay_order_id . '|' . $request->razorpay_payment_id, 
                config('services.razorpay.secret')
            );

            if ($expectedSignature !== $request->razorpay_signature) {
                throw new \Exception('Payment signature verification failed');
            }

            DB::beginTransaction();

            // Find payment record
            $payment = Payment::where('appointment_id', $appointment->id)
                ->where('razorpay_order_id', $request->razorpay_order_id)
                ->first();

            if (!$payment) {
                throw new \Exception('Payment record not found');
            }

            // Update payment record
            $payment->update([
                'status' => 'paid',
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
                'transaction_id' => $request->razorpay_payment_id,
            ]);

            // Update appointment status
            $appointment->update([
                'status' => 'scheduled',
                'payment_method' => 'upi'
            ]);

            DB::commit();

            Log::info('Payment verified successfully', [
                'appointment_id' => $appointment->id,
                'payment_id' => $request->razorpay_payment_id
            ]);

            // Redirect to confirmation page
            return redirect()->route('appointment.confirmation', ['id' => $appointment->id])
                ->with('success', 'Payment completed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment verification failed: ' . $e->getMessage(), [
                'appointment_id' => $appointment->id,
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['error' => 'Payment verification failed: ' . $e->getMessage()], 400);
        }
    }

    /**
     * Handle payment failure
     */
    public function paymentFailed(Request $request, Appointment $appointment)
    {
        try {
            DB::beginTransaction();

            // Find and update payment record
            $payment = Payment::where('appointment_id', $appointment->id)
                ->where('status', 'pending')
                ->first();

            if ($payment) {
                $payment->update(['status' => 'failed']);
            }

            // Keep appointment as pending for retry
            $appointment->update(['status' => 'pending']);

            DB::commit();

            Log::info('Payment marked as failed', [
                'appointment_id' => $appointment->id,
                'error' => $request->get('error', 'Unknown error')
            ]);

            return redirect()->route('appointment.failed', ['id' => $appointment->id])
                ->with('error', 'Payment failed. Please try again.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to handle payment failure: ' . $e->getMessage(), [
                'appointment_id' => $appointment->id,
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('hero')->with('error', 'An error occurred. Please contact support.');
        }
    }
}
