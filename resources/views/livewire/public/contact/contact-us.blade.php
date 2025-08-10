<div class="container mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Contact Us</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Contact Form -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Get in Touch</h2>
            
        <form wire:submit.prevent="submit">
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        wire:model="name"
                        class="py-3 px-4 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                        required
                        placeholder="Your full name"
                    >
                    @error('name')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        wire:model="email"
                        class="py-3 px-4 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                        required
                        placeholder="your.email@example.com"
                    >
                    @error('email')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <!-- Phone -->
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone (Optional)</label>
                    <input 
                        type="text" 
                        id="phone" 
                        wire:model="phone"
                        class="py-3 px-4 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                        placeholder="Your phone number"
                    >
                    @error('phone')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <!-- Subject -->
                <div class="mb-4">
                    <label for="subject" class="block text-gray-700 font-semibold mb-2">Subject</label>
                    <input 
                        type="text" 
                        id="subject" 
                        wire:model="subject"
                        class="py-3 px-4 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                        required
                        placeholder="Subject of your message"
                    >
                    @error('subject')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <!-- Message -->
                <div class="mb-4">
                    <label for="message" class="block text-gray-700 font-semibold mb-2">Message</label>
                    <textarea 
                        id="message" 
                        wire:model="message" 
                        rows="4" 
                        placeholder="Your Message" 
                        class="py-3 px-4 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                    ></textarea>
                    @error('message')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <button 
                    type="submit" 
                    wire:loading.attr="disabled"
                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-150 ease-in-out"
                >
                    <span wire:loading.remove>Send Message</span>
                    <span wire:loading>Sending...</span>
                </button>
            </form>
        </div>

        <!-- Contact Information -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Contact Information</h2>
            <p class="text-gray-600 mb-4">Feel free to reach out to us through the following contact details:</p>
            <ul class="space-y-4">
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>{{ $contactDetails['address'] }}</span>
                </li>
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <a wire:navigate href="tel:{{ $contactDetails['phone'] }}" class="hover:text-blue-800 transition-colors">{{ $contactDetails['phone'] }}</a>
                </li>
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <a wire:navigate href="mailto:{{ $contactDetails['email'] }}" class="hover:text-blue-800 transition-colors">{{ $contactDetails['email'] }}</a>
                </li>
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $contactDetails['working_hours'] }}</span>
                </li>
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    <span>Emergency: <a wire:navigate href="tel:{{ $contactDetails['emergency_phone'] }}" class="hover:text-red-800 transition-colors">{{ $contactDetails['emergency_phone'] }}</a></span>
                </li>
            </ul>
        </div>
    </div>

<div class="mt-6 h-64 w-full rounded-lg overflow-hidden">
  
 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d238102.51169974558!2d82.5430330148308!3d21.178181449890033!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e858d4332ca77e3%3A0x210504201aebfb8!2sMedbuzzy!5e0!3m2!1sen!2sin!4v1754839055050!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>


</div>