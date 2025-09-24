@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-brand-blue-50 to-indigo-50 py-8">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-brand-blue-600 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-brand-blue-900 mb-2">Complete Your Payment</h1>
            <p class="text-brand-blue-700">Secure payment processing for your appointment</p>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column - Doctor Card (lg:4 columns) -->
            <div class="lg:col-span-4">
                @if(isset($appointment) && $appointment->doctor)
                    <livewire:public.appointment.components.doctor-card 
                        :doctor="$appointment->doctor"
                        :appointment-date="$appointment->appointment_date->format('Y-m-d')"
                        :appointment-time="$appointment->appointment_time" />
                @endif
            </div>

            <!-- Right Column - Payment Details and Actions (lg:8 columns) -->
            <div class="lg:col-span-8">
                <!-- Payment Card -->
                <div class="bg-white rounded-xl overflow-hidden border border-brand-blue-200">
                    <!-- Payment Header -->
                    <div class="bg-gradient-to-r from-brand-blue-600 to-brand-blue-700 px-8 py-6">
                        <h2 class="text-2xl font-bold text-white mb-2">Payment Details</h2>
                        <p class="text-brand-blue-100">Please review and confirm your payment</p>
                    </div>

                    <!-- Payment Body -->
                    <div class="p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Left Column - Appointment Details -->
                            <div>
                                <h3 class="text-lg font-semibold text-brand-blue-900 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-brand-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    Appointment Information
                                </h3>
                                
                                <div class="space-y-4">
                                    <div class="bg-brand-blue-50 p-4 rounded-lg border border-brand-blue-200">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-brand-blue-700 font-medium">Appointment ID:</span>
                                            <span class="font-bold text-brand-blue-900">APT-{{ str_pad($appointment_id, 5, '0', STR_PAD_LEFT) }}</span>
                                        </div>
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-brand-blue-700 font-medium">Patient Name:</span>
                                            <span class="font-semibold text-brand-blue-900">{{ $patient_name }}</span>
                                        </div>
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-brand-blue-700 font-medium">Email:</span>
                                            <span class="font-semibold text-brand-blue-900 text-sm">{{ $patient_email }}</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-brand-blue-700 font-medium">Phone:</span>
                                            <span class="font-semibold text-brand-blue-900">{{ $patient_phone }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column - Payment Summary -->
                            <div>
                                <h3 class="text-lg font-semibold text-brand-blue-900 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-brand-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                    </svg>
                                    Payment Summary
                                </h3>
                                
                                <div class="bg-brand-teal-50 rounded-lg p-6 border border-brand-teal-200">
                                    <div class="flex justify-between items-center mb-4">
                                        <span class="text-brand-teal-700 font-medium">Consultation Fee:</span>
                                        <span class="font-semibold text-brand-blue-900">₹{{ number_format($amount / 100, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center mb-4">
                                        <span class="text-brand-teal-700 font-medium">Platform Fee:</span>
                                        <span class="font-semibold text-brand-blue-900">₹0.00</span>
                                    </div>
                                    <div class="border-t border-brand-teal-300 pt-4">
                                        <div class="flex justify-between items-center">
                                            <span class="text-lg font-bold text-brand-blue-900">Total Amount:</span>
                                            <span class="text-2xl font-bold text-brand-blue-600">₹{{ number_format($amount / 100, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment and Cancel Buttons -->
                        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                            <!-- Cancel Button -->
                            <button 
                                onclick="cancelPayment()"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 font-bold rounded-xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300 border-2 border-gray-300 hover:border-gray-400"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel Appointment
                            </button>

                            <!-- Payment Button -->
                            <button 
                                id="pay-button" 
                                class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-brand-blue-600 to-brand-blue-700 hover:from-brand-blue-700 hover:to-brand-blue-800 text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-brand-blue-300 border-2 border-brand-blue-600 hover:border-brand-blue-700"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Pay Securely ₹{{ number_format($amount / 100, 2) }}
                            </button>
                        </div>

                        <!-- Security Info -->
                        <div class="mt-6 flex items-center justify-center text-sm text-brand-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Secured by Razorpay SSL encryption
                        </div>
                    </div>
                </div>

                <!-- Help Section -->
                <div class="mt-8 bg-white rounded-xl p-6 border border-brand-blue-200">
                    <h4 class="text-lg font-semibold text-brand-blue-900 mb-4">Need Help?</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 text-brand-blue-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div>
                                <strong class="text-brand-blue-900">Customer Support</strong><br>
                                <span class="text-brand-blue-700">Call us for immediate assistance</span>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 text-brand-blue-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <div>
                                <strong class="text-brand-blue-900">Secure Payment</strong><br>
                                <span class="text-brand-blue-700">Your payment is protected and encrypted</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 z-50 bg-white bg-opacity-75 backdrop-blur-sm flex items-center justify-center hidden">
    <div class="bg-white rounded-xl p-8 border border-brand-blue-200 text-center">
        <div class="flex flex-col items-center space-y-4">
            <svg class="animate-spin h-12 w-12 text-brand-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="text-brand-blue-900 font-medium text-lg">Processing your payment...</p>
            <p class="text-brand-blue-600 text-sm">Please wait while we securely process your transaction.</p>
        </div>
    </div>
</div>

<!-- Razorpay Checkout Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
// Function to show/hide loading overlay
function showLoading() {
    const loadingOverlay = document.getElementById('loadingOverlay');
    loadingOverlay.classList.remove('hidden');
}

function hideLoading() {
    const loadingOverlay = document.getElementById('loadingOverlay');
    loadingOverlay.classList.add('hidden');
}

// Cancel payment function
function cancelPayment() {
    if (confirm('Are you sure you want to cancel this appointment? This action cannot be undone.')) {
        showLoading();
        // Redirect to appointment cancellation
        window.location.href = "{{ route('appointment.payment.failed', $appointment_id) }}?reason=cancelled";
    }
}

// Payment button click handler
document.getElementById('pay-button').onclick = function(e) {
    e.preventDefault();
    
    // Show loading
    showLoading();
    
    var options = {
        "key": "{{ $key }}",
        "amount": "{{ $amount }}",
        "currency": "{{ $currency }}",
        "name": "MedBuzzy",
        "description": "Appointment Payment",
        "order_id": "{{ $order_id }}",
        "prefill": {
            "name": "{{ $patient_name }}",
            "email": "{{ $patient_email }}",
            "contact": "{{ $patient_phone }}"
        },
        "theme": {
            "color": "#2563eb"
        },
        "handler": function(response) {
            // Payment successful - submit verification form
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("appointment.payment.verify", $appointment_id) }}';
            
            // Add CSRF token
            var csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            
            // Add payment data
            var paymentIdInput = document.createElement('input');
            paymentIdInput.type = 'hidden';
            paymentIdInput.name = 'razorpay_payment_id';
            paymentIdInput.value = response.razorpay_payment_id;
            form.appendChild(paymentIdInput);
            
            var orderIdInput = document.createElement('input');
            orderIdInput.type = 'hidden';
            orderIdInput.name = 'razorpay_order_id';
            orderIdInput.value = response.razorpay_order_id;
            form.appendChild(orderIdInput);
            
            var signatureInput = document.createElement('input');
            signatureInput.type = 'hidden';
            signatureInput.name = 'razorpay_signature';
            signatureInput.value = response.razorpay_signature;
            form.appendChild(signatureInput);
            
            document.body.appendChild(form);
            form.submit();
        },
        "modal": {
            "ondismiss": function() {
                // Payment cancelled - hide loading
                hideLoading();
            },
            "onopen": function() {
                // Razorpay modal opened - hide our loading
                hideLoading();
            }
        }
    };
    
    try {
        var rzp = new Razorpay(options);
        rzp.open();
    } catch (error) {
        hideLoading();
        alert('Payment gateway error. Please try again.');
    }
};
</script>
@endsection