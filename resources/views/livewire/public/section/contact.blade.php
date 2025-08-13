<div class="min-h-screen">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-brand-blue-900 to-brand-blue-600 py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                    <span class="block">Contact MedBuzzy</span>
                    <span class="block text-brand-yellow-400">We're here to help</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-200 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Have questions or need assistance? Our team is ready to assist you with your healthcare needs.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2 lg:gap-8">
                <!-- Contact Information -->
                <div class="space-y-8">
                    <div>
                        <h2 class="text-2xl font-bold text-brand-blue-800">Get in touch</h2>
                        <p class="mt-4 text-lg text-gray-600">
                            Our support team is happy to answer your questions about booking appointments,
                            doctor availability, or any other inquiries.
                        </p>
                    </div>

                    <!-- Contact Cards -->
                    <div class="space-y-6">
                        <div class="flex items-start p-4 bg-brand-blue-50 rounded-lg">
                            <div class="flex-shrink-0 bg-brand-blue-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-brand-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Phone Support</h3>
                                <p class="mt-1 text-gray-600"><a href="tel:{{ $contactDetails['phone'] }}" class="hover:text-brand-blue-600 transition-colors">{{ $contactDetails['phone'] }}</a></p>
                                      <p class="mt-2 text-sm text-gray-500">{{ $contactDetails['working_hours'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-brand-blue-50 rounded-lg">
                            <div class="flex-shrink-0 bg-brand-blue-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-brand-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Email Us</h3>

                                
                                <p class="mt-1 text-gray-600"><a href="mailto:{{ $contactDetails['email'] }}" class="hover:text-brand-blue-600 transition-colors">{{ $contactDetails['email'] }}</a></p>

                                <p class="mt-2 text-sm text-gray-500">Response time: Typically within 24 hours</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-brand-blue-50 rounded-lg">
                            <div class="flex-shrink-0 bg-brand-blue-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-brand-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Visit Us</h3>
                                <p class="mt-1 text-gray-600">{{ $contactDetails['address'] }}</p>
                                <p class="mt-2 text-sm text-brand-blue-600 flex items-start">
                                    <svg class="flex-shrink-0 h-4 w-4 mt-0.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Located in the MedBuzzy Healthcare Center</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Map Section -->
                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-brand-blue-800 mb-4">Our Location</h3>
                        <div class="rounded-lg overflow-hidden shadow-lg border border-gray-200">
                            <!-- Google Maps Embed -->
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d203.21872341888738!2d87.4748357133329!3d25.769771128101407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eff9d8714e0611%3A0x61d781772546423d!2sTax%20Litigator!5e1!3m2!1sen!2sin!4v1754892957625!5m2!1sen!2sin"
    width="100%" 
    height="400" 
    style="border:0;" 
    allowfullscreen="" 
    loading="lazy"
></iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div>
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="p-6 sm:p-8">
                            <h2 class="text-2xl font-bold text-brand-blue-800 mb-6">Send us a message</h2>
                            
                            <form class="space-y-6" wire:submit.prevent="submitContactForm">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
                                    <div class="mt-1">
                                        <input 
                                            type="text" 
                                            id="name" 
                                            name="name" 
                                            wire:model="name"
                                            required
                                            class="py-3 px-4 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-brand-blue-500 focus:border-brand-blue-500 transition duration-150"
                                            placeholder="Your full name"
                                        >
                                    </div>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                                    <div class="mt-1">
                                        <input 
                                            type="email" 
                                            id="email" 
                                            name="email" 
                                            wire:model="email"
                                            required
                                            class="py-3 px-4 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-brand-blue-500 focus:border-brand-blue-500 transition duration-150"
                                            placeholder="your.email@example.com"
                                        >
                                    </div>
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                    <div class="mt-1">
                                        <input 
                                            type="tel" 
                                            id="phone" 
                                            name="phone" 
                                            wire:model="phone"
                                            class="py-3 px-4 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-brand-blue-500 focus:border-brand-blue-500 transition duration-150"
                                            placeholder="+91 98765 43210"
                                        >
                                    </div>
                                </div>

                                <div>
                                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject <span class="text-red-500">*</span></label>
                                    <div class="mt-1">
                                        <select 
                                            id="subject" 
                                            name="subject" 
                                            wire:model="subject"
                                            required
                                            class="py-3 px-4 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-brand-blue-500 focus:border-brand-blue-500 transition duration-150"
                                        >
                                            <option value="">Select a subject</option>
                                            <option value="Appointment Booking">Appointment Booking</option>
                                            <option value="Doctor Information">Doctor Information</option>
                                            <option value="Technical Support">Technical Support</option>
                                            <option value="Billing Inquiry">Billing Inquiry</option>
                                            <option value="Feedback">Feedback</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700">Message <span class="text-red-500">*</span></label>
                                    <div class="mt-1">
                                        <textarea 
                                            id="message" 
                                            name="message" 
                                            wire:model="message"
                                            rows="5" 
                                            required
                                            class="py-3 px-4 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-brand-blue-500 focus:border-brand-blue-500 transition duration-150"
                                            placeholder="How can we help you?"
                                        ></textarea>
                                    </div>
                                </div>

                                <div>
                                    <button 
                                        type="submit"
                                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand-blue-600 hover:bg-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500 transition duration-150"
                                        wire:loading.attr="disabled"
                                    >
                                        <span wire:loading.remove>Send Message</span>
                                        <span wire:loading>
                                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Sending...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-brand-blue-800 sm:text-4xl">
                    Frequently Asked Questions
                </h2>
                <p class="mt-3 max-w-2xl mx-auto text-lg text-gray-600">
                    Can't find what you're looking for? Check out these common questions.
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- FAQ Item 1 -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="text-lg font-medium text-brand-blue-800">How do I book an appointment?</h3>
                    <p class="mt-2 text-gray-600">
                        You can book appointments directly through our website by selecting a doctor and available time slot, or call our support team for assistance.
                    </p>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="text-lg font-medium text-brand-blue-800">What are your working hours?</h3>
                    <p class="mt-2 text-gray-600">
                        Our support team is available {{ $contactDetails['working_hours'] }}. Doctors have varying schedules you can view when booking.
                    </p>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="text-lg font-medium text-brand-blue-800">Do you offer emergency services?</h3>
                    <p class="mt-2 text-gray-600">
                        For medical emergencies, please visit your nearest hospital. We provide non-emergency consultation services by appointment.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>