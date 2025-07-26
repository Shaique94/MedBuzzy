<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand Column -->
            <div class="space-y-4">
                <div class="flex items-center">
                    <svg class="h-8 w-8 text-teal-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="ml-2 text-xl font-bold text-white">MedBuzzy</span>
                </div>
                <p class="text-gray-400 text-sm">Your trusted healthcare partner connecting patients with top medical professionals.</p>
                <p class="text-gray-400 text-xs mt-4">© {{ date('Y') }} MedBuzzy. All rights reserved.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-teal-400">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{route('hero')}}" class="text-gray-400 hover:text-white transition">Home</a></li>
                    <li><a href="{{route('our-doctors')}}" class="text-gray-400 hover:text-white transition">Find Doctors</a></li>
                    <li><a href="{{route('contact-us')}}" class="text-gray-400 hover:text-white transition">Contact Us</a></li>
                    <li><a href="{{route('about-us')}}" class="text-gray-400 hover:text-white transition">About Us</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-teal-400">Legal</h3>
                <ul class="space-y-2">
                    {{-- <li><a href="#" class="text-gray-400 hover:text-white transition">Privacy Policy</a></li> --}}
                    <li><a href="{{route('terms-conditons')}}" class="text-gray-400 hover:text-white transition">Terms & Conditions</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-teal-400">Contact Us</h3>
                <ul class="space-y-2">
                    <li class="flex items-center text-gray-400">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        +919430808079
                    </li>
                    <li class="flex items-center text-gray-400">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                       infomedbuzzy@gmail.com
                    </li>
                    <li class="flex items-center text-gray-400">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        123 Medical Drive, Health City
                    </li>
                </ul>
               
            </div>
        </div>

        <div class="border-t border-gray-700 mt-8 pt-6 text-center text-sm text-gray-400">
            <p>MedBuzzy is not a substitute for professional medical advice, diagnosis, or treatment.</p>
            <p class="mt-2">Always seek the advice of your physician or other qualified health provider with any questions you may have regarding a medical condition.</p>
        </div>
    </div>
</footer>