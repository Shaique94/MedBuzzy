<div 
    x-data="otpComponent({{ $countdown }})"
>
    @if ($showModal)
        <div x-ref="phoneModal" tabindex="-1"
            class="fixed  inset-0 bg-gray-50 bg-opacity-90 flex items-center justify-center z-50 transition-opacity duration-300
            sm:items-center sm:justify-center
            md:items-center md:justify-center
            ">
            <div class="relative w-full h-full sm:h-auto sm:max-w-md flex flex-col justify-center items-center">
                <!-- Mobile Header -->
                <div
                    class="block sm:hidden absolute top-0 left-0 w-full bg-gray-100 py-4 px-6  shadow-lg z-10 flex items-center justify-between">
                    <span class="text-white text-lg font-bold tracking-wide"> <img src="/logo/logo1.png"
                            alt="MedBuzzy Logo" class="h-9 md:h-12">
                    </span>
                    <button wire:click="ClosePhoneModal" class="text-blue-">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 mx-0 sm:mx-4
                    h-full sm:h-auto flex flex-col justify-center
                    mt-16 sm:mt-0
                    ">
                    @if (!$showVerification && !$submitFinalForm)
                        <!-- Phone Number Form -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-xl font-bold text-blue-800">Enter Your Phone</h3>
                                <button wire:click="ClosePhoneModal" class="hidden sm:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-800">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <p class="mt-2 text-sm text-blue-700">We'll send a 6-digit verification code to this number.
                            </p>
                            <div class="mt-6">
                                <input wire:model="phone" type="tel"
                                    class="block w-full rounded-lg border border-blue-700 px-3 py-2 text-lg focus:border-blue-800 focus:ring-blue-700 transition-all"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                                    placeholder="10-digit phone number">
                                @error('phone')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-6">
                                <button wire:click="submitPhone" type="button"
                                    class="w-full rounded px-4 py-2 bg-brand-blue-700 text-lg font-medium text-white hover:bg-brand-blue-800 focus:outline-none focus:ring-2 focus:ring-brand-blue-700 transition-all shadow">
                                    Send Verification Code
                                </button>
                            </div>
                        </div>
                    @elseif ($showVerification && !$submitFinalForm)
                        <!-- OTP Verification Form -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-xl font-bold text-blue-800">Verify Your Phone</h3>
                                <button wire:click="ClosePhoneModal" class="hidden sm:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-800">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <p class="text-sm text-blue-700 mb-1">
                                We sent a 6-digit code to {{ $phone }}.
                                <button wire:click="editPhone"
                                    class="text-blue-700 hover:text-blue-900 underline ml-1">Edit</button>
                            </p>
                            {{-- <p class="text-xs text-gray-400 mb-4">Demo code: {{ $generatedCode }}</p> --}}
                            <div x-data="{
                                otp: '',
                                setOtp(event) {
                                    const input = event.target;
                                    let value = input.value.replace(/[^0-9]/g, '');
                                    if (value.length > 6) value = value.slice(0, 6); // Limit to 6 digits
                                    this.otp = value;
                                    input.value = value;
                                    $wire.set('verificationCode', this.otp);
                                },
                                handlePaste(event) {
                                    event.preventDefault();
                                    let paste = (event.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
                                    if (paste.length > 6) paste = paste.slice(0, 6); // Limit to 6 digits
                                    this.otp = paste;
                                    event.target.value = paste;
                                    $wire.set('verificationCode', this.otp);
                                }
                            }" class="mb-4 mt-4">
                                <input type="text" maxlength="6" inputmode="numeric" pattern="[0-9]*"
                                    aria-label="6-digit OTP"
                                    class="w-full h-14 text-center text-2xl rounded-xl border-2 border-blue-700 focus:ring-2 focus:ring-blue-700 bg-white text-blue-800 font-bold shadow transition-all"
                                    x-model="otp" @input="setOtp($event)" @paste="handlePaste($event)"
                                    @keydown="if (!/^[0-9]$|^Backspace$|^Tab$/.test($event.key)) $event.preventDefault()" />
                            </div>
                            @error('verificationCode')
                                <span class="text-red-500 text-xs block mb-2">{{ $message }}</span>
                            @enderror
                            <div class="flex items-center justify-between mb-4">
                                <button wire:click="resendOtp" type="button" :disabled="countdown > 0"
                                    class="text-sm text-blue-700 hover:text-blue-900 disabled:text-gray-400 font-medium">
                                    <span
                                        x-text="countdown > 0 ? 'Resend OTP (' + countdown + 's)' : 'Resend OTP'"></span>
                                </button>
                            </div>
                            <button wire:click="verifyCode" type="button"
                                class="w-full rounded px-4 py-2 bg-brand-blue-700 text-lg font-medium text-white hover:bg-brand-blue-800 focus:outline-none focus:ring-2 focus:ring-brand-blue-700 transition-all shadow">
                                Verify & Continue
                            </button>
                        </div>
                    @elseif ($submitFinalForm)
                        <!-- Final Form with Name and Email -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-xl font-bold text-blue-800">Patient Information</h3>
                                <button wire:click="ClosePhoneModal" type="button" class="hidden sm:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-800">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <p class="mt-2 text-sm text-blue-700">Please provide your details to continue.</p>
                            @if ($errors->any())
                                <div class="text-red-500 text-sm mt-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-blue-800">Full
                                        Name</label>
                                    <input wire:model="name" type="text" id="name"
                                        class="block w-full rounded-xl border-2 border-blue-700 p-3 focus:border-blue-800 focus:ring-blue-700"
                                        placeholder="Your full name">
                                    @error('name')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-blue-800">Email
                                        Address</label>
                                    <input wire:model="email" type="email" id="email"
                                        class="block w-full rounded-xl border-2 border-blue-700 p-3 focus:border-blue-800 focus:ring-blue-700"
                                        placeholder="Your email address">
                                    @error('email')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-6">
                                <button wire:click="submit" type="submit"
                                    class="w-full rounded px-4 py-2 bg-brand-blue-700 text-lg font-medium text-white hover:bg-brand-blue-800 focus:outline-none focus:ring-2 focus:ring-brand-blue-700 transition-all shadow">
                                    Submit & Find Doctors
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    function otpComponent(initialCountdown) {
        return {
            countdown: initialCountdown,
            countdownInterval: null,
            init() {
                if (this.countdown > 0) {
                    this.startCountdown();
                }
                $wire.on('start-countdown', () => {
                    this.countdown = 30;
                    this.startCountdown();
                    console.log('Countdown reset to 30');
                });
            },
            startCountdown() {
                clearInterval(this.countdownInterval);
                this.countdownInterval = setInterval(() => {
                    if (this.countdown > 0) {
                        this.countdown--;
                    } else {
                        clearInterval(this.countdownInterval);
                    }
                }, 1000);
            }
        }
    }
</script>
