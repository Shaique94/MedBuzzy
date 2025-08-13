<div class="min-h-screen bg-gray-50 mt-5 pb-20">
    <!-- Header -->
    <div class="text-center bg-brand-blue-800 rounded-none py-6 w-full">
        <h1 class="text-3xl font-bold text-white">Book an Appointment</h1>
        <p class="mt-2 text-brand-yellow-300">Schedule your visit with our expert doctors</p>
    </div>

    <!-- Progress Steps -->
    <div class="bg-brand-blue-50 px-0 py-4 w-full border-b border-brand-blue-100">
        <div class="flex items-center justify-between max-w-5xl mx-auto flex-nowrap overflow-x-auto scrollbar-hide gap-0 px-2 sm:px-0"
            style="min-width:0;">
            @foreach ([
                1 => ['label' => 'Doctor', 'icon' => 'user-md'],
                2 => ['label' => 'Date & Time', 'icon' => 'calendar-alt'],
                3 => ['label' => 'Details', 'icon' => 'user-circle'],
                4 => ['label' => 'Confirm', 'icon' => 'check-circle'],
            ] as $stepNumber => $stepInfo)
                <div class="flex flex-col items-center relative flex-1 min-w-[90px] sm:min-w-0 px-1">
                    <div
                        class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full
                    {{ $currentStep >= $stepNumber ? 'bg-brand-blue-800 text-white' : 'bg-white text-gray-400 border-2 border-gray-300' }}
                    transition-all duration-300 relative z-10 text-base sm:text-lg">
                        @if ($stepInfo['icon'] === 'user-md')
                            <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        @elseif($stepInfo['icon'] === 'calendar-alt')
                            <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        @elseif($stepInfo['icon'] === 'user-circle')
                            <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
                            </svg>
                        @elseif($stepInfo['icon'] === 'check-circle')
                            <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                        @if ($currentStep === $stepNumber)
                            <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-2 h-2 sm:w-3 sm:h-3 bg-brand-blue-800 rounded-full"></div>
                        @endif
                    </div>
                    <span class="mt-1 text-[11px] sm:text-xs font-medium {{ $currentStep >= $stepNumber ? 'text-brand-blue-800' : 'text-gray-500' }} hidden sm:block text-center leading-tight break-words w-full">
                        {{ $stepInfo['label'] }}
                    </span>
                    <span class="mt-1 text-[10px] font-medium {{ $currentStep >= $stepNumber ? 'text-brand-blue-800' : 'text-gray-500' }} sm:hidden text-center leading-tight break-words w-full">
                        {{ $stepInfo['label'] }}
                    </span>
                    @if ($stepNumber < 4)
                        <div class="hidden sm:block absolute top-4 left-2/3 w-full h-1 {{ $currentStep > $stepNumber ? 'bg-brand-blue-800' : 'bg-gray-300' }}"></div>
                        <div class="block sm:hidden absolute top-4 left-1/2 w-[80%] h-0.5 {{ $currentStep > $stepNumber ? 'bg-brand-blue-800' : 'bg-gray-300' }}"
                            style="z-index:1; transform: translateX(10px);"></div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Step Content Container -->
    <div class="container mx-auto max-w-5xl p-4 sm:p-6">
        <!-- Dynamic step components -->
        @switch($currentStep)
            @case(1)
                <livewire:public.appointment.steps.doctor-selection :appointment-data="$appointmentData" wire:key="step-1" />
                @break
            @case(2)
                <livewire:public.appointment.steps.date-time-selection :appointment-data="$appointmentData" wire:key="step-2" />
                @break
            @case(3)
                <livewire:public.appointment.steps.patient-information :appointment-data="$appointmentData" wire:key="step-3" />
                @break
            @case(4)
                <livewire:public.appointment.steps.appointment-confirmation :appointment-data="$appointmentData" wire:key="step-4" />
                @break
        @endswitch
    </div>

    <!-- Navigation Buttons -->
    <div class="fixed bottom-0 inset-x-0 z-40 bg-white border-t border-gray-200 p-4 md:static md:bg-transparent md:border-t-0 md:mt-6">
        <div class="flex flex-col-reverse sm:flex-row justify-between gap-3 max-w-5xl mx-auto">
            @if ($currentStep > 1)
                <button wire:click="previousStep" 
                    class="w-full sm:w-auto px-6 py-3 bg-white border border-brand-yellow-400 text-brand-yellow-600 rounded-lg hover:bg-brand-yellow-50 transition flex items-center justify-center shadow-sm">
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Back
                </button>
            @else
                <div class="hidden sm:block"></div>
            @endif

            @if ($currentStep < 4)
                <button wire:click="validateAndProceed" 
                    class="w-full sm:w-auto px-6 py-3 bg-brand-blue-800 text-white rounded-lg hover:bg-brand-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-700 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center shadow-md transition-all duration-300">
                    <span>Continue</span>
                    <svg class="h-5 w-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            @endif

            @if ($currentStep === 4)
                <button wire:click="submitAppointment" wire:loading.attr="disabled"
                    class="w-full sm:w-auto px-6 py-3 bg-brand-blue-800 text-white rounded-lg hover:bg-brand-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-700 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center shadow-md transition-all duration-300">
                    <span wire:loading.remove>Confirm & Pay ₹50 Booking Fee</span>
                    <span wire:loading class="flex items-center">
                        <svg class="animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processing Payment...
                    </span>
                </button>
            @endif
        </div>
    </div>
    
    <!-- Debug section - remove in production -->
    @if(config('app.debug'))
        <div class="fixed bottom-0 right-0 bg-gray-900 text-white p-2 text-xs m-2 rounded opacity-60 hover:opacity-100 transition-opacity">
            Current Step: {{ $currentStep }}
        </div>
    @endif
</div>
