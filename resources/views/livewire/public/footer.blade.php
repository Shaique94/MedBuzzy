<div><footer class="bg-gray-800 text-white pt-12 pb-10">
    <div class="container mx-auto px-4">
        <!-- Mobile Footer with Collapsible Sections -->
        <div class="md:hidden">
            <div class="flex flex-col items-center mb-8">
                <div class="flex items-center justify-center mb-4">
                     <a wire:navigate href="/" class="flex items-center">
                    <img src="/logo/logo.png" alt="MedBuzzy Logo" class="h-16 md:h-20">
                </a>
                </div>
                <p class="text-gray-400 text-sm text-center px-8 mb-6">Your trusted healthcare partner connecting patients with top medical professionals.</p>
                
                <!-- Social Media Icons -->
                <div class="flex space-x-4 mb-8">
                    <a  href="https://www.facebook.com/people/Med-Buzzy/pfbid02D56pbCqxDNPcrX2ZP9jjkwzLgyto89DEkGn11bArtcGx4HLEzpWfFeVDEwG8cHuSl/" 
                     target="_blank" rel="noopener noreferrer"
      class="h-10 w-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-teal-600 transition-colors">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"></path>
                        </svg>
                    </a>
                   <a href="https://instagram.com/medbuzzy" target="_blank" rel="noopener noreferrer" class="h-10 w-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-teal-600 transition-colors">
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a  href="https://www.youtube.com/@Medbuzzy"  target="_blank" rel="noopener noreferrer"
 class="h-10 w-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-teal-600 transition-colors">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Accordion Footer Links - Fixed Implementation -->
            <div x-data="{ activeSection: null }" class="space-y-2 mb-8">
                <!-- Quick Links Section -->
                <div class="border-b border-gray-700">
                    <button 
                        @click="activeSection = activeSection === 'quickLinks' ? null : 'quickLinks'" 
                        class="w-full flex justify-between items-center py-3 px-1"
                    >
                        <span class="text-lg font-medium text-teal-400">Quick Links</span>
                        <svg 
                            class="w-5 h-5 transition-transform" 
                            :class="activeSection === 'quickLinks' ? 'transform rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div x-show="activeSection === 'quickLinks'" style="display: none;">
                        <ul class="space-y-3 pl-2 py-3">
                            <li><a wire:navigate href="{{route('hero')}}" class="block py-2 text-gray-400 hover:text-white transition">Home</a></li>
                            <li><a wire:navigate href="{{route('our-doctors')}}" class="block py-2 text-gray-400 hover:text-white transition">Find Doctors</a></li>
                            <li><a wire:navigate href="{{route('contact-us')}}" class="block py-2 text-gray-400 hover:text-white transition">Contact Us</a></li>
                            <li><a wire:navigate href="{{route('about-us')}}" class="block py-2 text-gray-400 hover:text-white transition">About Us</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Legal Section -->
                <div class="border-b border-gray-700">
                    <button 
                        @click="activeSection = activeSection === 'legal' ? null : 'legal'" 
                        class="w-full flex justify-between items-center py-3 px-1"
                    >
                        <span class="text-lg font-medium text-teal-400">Legal</span>
                        <svg 
                            class="w-5 h-5 transition-transform" 
                            :class="activeSection === 'legal' ? 'transform rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div x-show="activeSection === 'legal'" style="display: none;">
                        <ul class="space-y-3 pl-2 py-3">
                            <li><a wire:navigate href="{{route('privacy-policy')}}" class="block py-2 text-gray-400 hover:text-white transition">Privacy Policy</a></li>
                            <li><a wire:navigate href="{{route('terms-conditons')}}" class="block py-2 text-gray-400 hover:text-white transition">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Contact Section -->
                <div class="border-b border-gray-700">
                    <button 
                        @click="activeSection = activeSection === 'contact' ? null : 'contact'" 
                        class="w-full flex justify-between items-center py-3 px-1"
                    >
                        <span class="text-lg font-medium text-teal-400">Contact Us</span>
                        <svg 
                            class="w-5 h-5 transition-transform" 
                            :class="activeSection === 'contact' ? 'transform rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div x-show="activeSection === 'contact'" style="display: none;">
                        <ul class="space-y-4 pl-2 py-3">
                            <li>
                                <a wire:navigate href="tel:{{ $contactDetails['phone'] }}" class="flex items-center text-gray-400 hover:text-white">
                                    <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-3">
                                        <svg class="h-4 w-4 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                    <span>{{ $contactDetails['phone'] }}</span>
                                </a>
                            </li>
                             @if($contactDetails['emergency_phone'])
                         
                            <li>
                                <a wire:navigate href="tel:{{$contactDetails['emergency_phone'] }}" class="flex items-center text-gray-400 hover:text-white">
                                    <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-3">
                                        <svg class="h-4 w-4 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                    {{-- <span>Support: {{ $contactDetails['emergency_phone'] }}</span> --}}
                                </a>
                            </li>
                            @endif
                            <li>
                                <a wire:navigate href="mailto:{{ $contactDetails['email'] }}" class="flex items-center text-gray-400 hover:text-white">
                                    <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-3">
                                        <svg class="h-4 w-4 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <span>{{ $contactDetails['email'] }}</span>
                                </a>
                            </li>
                            <li class="flex items-start text-gray-400">
                                <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                    <svg class="h-4 w-4 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <span>{{ $contactDetails['address'] }}</span>
                            </li>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Desktop Footer Layout -->
        <div class="hidden md:grid grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- Brand Column -->
            <div class="space-y-4">
                <div class="flex items-center">
                   <a wire:navigate href="/" class="flex items-center">
                    <img src="/logo/logo.png" alt="MedBuzzy Logo" class="h-16 md:h-20">
                </a>
                </div>
                <p class="text-gray-400 text-sm">Your trusted healthcare partner connecting patients with top medical professionals.</p>
                
                <!-- Social Media Icons -->
                <div class="flex space-x-3 pt-2">
                 <a 
    href="https://www.facebook.com/people/Med-Buzzy/pfbid02D56pbCqxDNPcrX2ZP9jjkwzLgyto89DEkGn11bArtcGx4HLEzpWfFeVDEwG8cHuSl/" 
    target="_blank" 
    rel="noopener noreferrer"  class="h-8 w-8 bg-gray-700 rounded-full flex items-center justify-center hover:bg-teal-600 transition-colors">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"></path>
                        </svg>
                    </a>
                  <a href="https://instagram.com/medbuzzy" target="_blank" rel="noopener noreferrer" class="h-8 w-8 bg-gray-700 rounded-full flex items-center justify-center hover:bg-teal-600 transition-colors">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a href="https://www.youtube.com/@Medbuzzy" target="_blank" rel="noopener noreferrer" class="h-8 w-8 bg-gray-700 rounded-full flex items-center justify-center hover:bg-teal-600 transition-colors">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-teal-400">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a wire:navigate href="{{route('hero')}}" class="text-gray-400 hover:text-white transition">Home</a></li>
                    <li><a wire:navigate href="{{route('our-doctors')}}" class="text-gray-400 hover:text-white transition">Find Doctors</a></li>
                    <li><a wire:navigate href="{{route('contact-us')}}" class="text-gray-400 hover:text-white transition">Contact Us</a></li>
                    <li><a wire:navigate href="{{route('about-us')}}" class="text-gray-400 hover:text-white transition">About Us</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-teal-400">Legal</h3>
                <ul class="space-y-2">
                    <li><a wire:navigate href="{{route('privacy-policy')}}" class="text-gray-400 hover:text-white transition">Privacy Policy</a></li>
                    <li><a wire:navigate href="{{route('terms-conditons')}}" class="text-gray-400 hover:text-white transition">Terms & Conditions</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-teal-400">Contact Us</h3>
                <ul class="space-y-3">
                    <li class="flex items-center text-gray-400">
                        <svg class="h-5 w-5 mr-2 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a wire:navigate href="tel:{{ $contactDetails['phone'] }}" class="hover:text-white transition-colors">{{ $contactDetails['phone'] }}</a>
                    </li>

                      @if($contactDetails['emergency_phone'])
                   
                    {{-- <li class="flex items-center text-gray-400">
                        <svg class="h-5 w-5 mr-2 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a wire:navigate href="tel:{{ $contactDetails['emergency_phone'] }}" class="hover:text-white transition-colors">Support: {{ $contactDetails['emergency_phone'] }}</a>
                    </li> --}}
                    @endif
                    <li class="flex items-center text-gray-400">
                        <svg class="h-5 w-5 mr-2 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                       <a wire:navigate href="mailto:{{ $contactDetails['email'] }}" class="hover:text-white transition-colors">{{ $contactDetails['email'] }}</a>
                    </li>
                    <li class="flex items-start text-gray-400">
                        <svg class="h-5 w-5 mr-2 text-teal-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $contactDetails['address'] }}
                    </li>
                  
                </ul>
            </div>
        </div>

        <!-- Bottom Divider -->
        <div class="border-t border-gray-700 pt-6 text-center text-sm text-gray-400">
            <p class="mb-2">MedBuzzy is not a substitute for professional medical advice, diagnosis, or treatment.</p>
            <p class="mb-4">Always seek the advice of your physician or other qualified health provider with any questions you may have regarding a medical condition.</p>
            <p>© {{ date('Y') }} MedBuzzy. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Embedded Alpine.js (ensure Alpine.js works even if not loaded in layout) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof window.Alpine === 'undefined') {
            // Alpine.js is not loaded, load it now
            var script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/alpinejs@3.13.0/dist/cdn.min.js';
            script.defer = true;
            document.head.appendChild(script);
            
            script.onload = function() {
                console.log('Alpine.js loaded dynamically');
                if (typeof window.Alpine !== 'undefined') {
                    window.Alpine.start();
                }
            };
        }
    });
</script>

<style>
    /* Enhanced tap targets for mobile */
    @media (max-width: 768px) {
        footer a, 
        footer button {
            padding: 8px 0;
            display: inline-block;
            min-height: 44px; /* Improved tap target size */
        }
        
        /* Fix for links visibility */
        footer [x-show]:not([style*="display: none"]) {
            display: block !important;
        }
    }
    
    /* Smooth transitions */
    footer a,
    footer button {
        transition: all 0.2s ease;
    }
    
    /* Make footer links more touch-friendly */
    footer ul a {
        position: relative;
        display: inline-block;
    }
    
    footer ul a:after {
        content: '';
        position: absolute;
        width: 0;
        height: 1px;
        bottom: -1px;
        left: 0;
        background-color: #14b8a6;
        transition: width 0.3s ease;
    }
    
    footer ul a:hover:after {
        width: 100%;
    }
</style>
</div>