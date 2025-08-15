<!-- livewire/public/appointments/book-appointment.blade.php -->
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left: Doctor Details -->
            <div class="bg-white rounded-xl shadow-sm p-6 sticky top-4">
                <div class="flex flex-col items-center lg:items-start">
                    <img src="{{ $doctor->image ?? 'https://via.placeholder.com/150' }}" alt="Dr. {{ $doctor->user->name }}" class="w-32 h-32 rounded-full object-cover mb-4">
                    <h2 class="text-2xl font-bold text-gray-900">Dr. {{ $doctor->user->name }}</h2>
                    <p class="text-brand-blue-600 font-medium">{{ $doctor->department->name }}</p>
                    <p class="text-gray-600">{{ implode(', ', $doctor->qualification ?? []) }}</p>
                    <div class="flex items-center mt-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= round($doctor->rating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                        <span class="ml-2 text-gray-600">({{ $doctor->review_count }})</span>
                    </div>
                    <div class="mt-4 space-y-2 text-gray-700">
                        <p><strong>Experience:</strong> {{ $doctor->experience }} years</p>
                        <p><strong>Fee:</strong> ₹{{ $doctor->fee }} (paid at hospital)</p>
                        <p><strong>Location:</strong> {{ $doctor->city }}, {{ $doctor->state }}</p>
                    </div>
                </div>
            </div>

            <!-- Right: Components -->
            <div class="space-y-8">
                <livewire:public.appointments.date-time-selector :doctor="$doctor" />
                <livewire:public.appointments.patient-form />
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h3 class="text-xl font-bold mb-4">Payment Summary</h3>
                    <div class="space-y-4">
                        <div class="border-b pb-2">
                            <p class="flex justify-between"><span>Doctor Fee (at hospital):</span> <span>₹{{ $doctor->fee }}</span></p>
                            <p class="flex justify-between"><span>Booking Fee:</span> <span>₹{{ $booking_fee }}</span></p>
                            <p class="flex justify-between font-bold"><span>Total to Pay Now:</span> <span>₹{{ $booking_fee }}</span></p>
                        </div>
                        <button wire:click="confirmAndPay" wire:loading.attr="disabled" class="w-full bg-brand-blue-600 text-white py-3 rounded-lg hover:bg-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-brand-blue-500 disabled:opacity-50">
                            <span wire:loading.remove wire:target="confirmAndPay">Confirm & Pay</span>
                            <span wire:loading wire:target="confirmAndPay" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://checkout.razorpay.com/v1/checkout.js" defer></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('initAppointmentPayment', (data) => {
            console.log('Payment event data:', data);

            if (!Array.isArray(data) || !data[0] || !Array.isArray(data[0])) {
                console.error('Invalid payment data structure:', data);
                return;
            }

            const paymentData = data[0][0];
            console.log('Payment data:', paymentData);

            if (!paymentData || typeof paymentData !== 'object') {
                console.error('Payment data is not an object:', paymentData);
                return;
            }

            const options = {
                "key": paymentData.key,
                "amount": paymentData.amount,
                "currency": paymentData.currency,
                "name": paymentData.name,
                "description": paymentData.description,
                "order_id": paymentData.order_id,
                "handler": function (response) {
                    console.log('Payment success:', response);
                    Livewire.emit('paymentSuccess', response);
                },
                "prefill": {
                    "name": paymentData.prefill.name,
                    "email": paymentData.prefill.email,
                    "contact": paymentData.prefill.contact
                },
                "theme": paymentData.theme || { "color": "#14b8a6" }
            };

            console.log('Razorpay options:', options);

            try {
                const rzp = new Razorpay(options);
                rzp.on('payment.failed', function (response) {
                    console.error('Payment failed:', response.error);
                    alert('Payment failed. Please try again. Error: ' + (response.error ? response.error.description : 'Unknown'));
                });
                rzp.open();
            } catch (error) {
                console.error('Razorpay initialization error:', error);
                alert('Failed to initialize payment. Check console for details.');
            }
        });
    });

    window.addEventListener('open-razorpay', (event) => {
        console.log('open-razorpay event received:', event.detail);
        const options = event.detail;
        try {
            const rzp = new Razorpay(options);
            rzp.on('payment.failed', function (response) {
                console.error('Payment failed:', response.error);
                alert('Payment failed. Please try again. Error: ' + (response.error ? response.error.description : 'Unknown'));
            });
            rzp.open();
        } catch (error) {
            console.error('Razorpay initialization error in event listener:', error);
            alert('Failed to initialize payment. Check console for details.');
        }
    });
</script>

</div>