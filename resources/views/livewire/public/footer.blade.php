<div>
    <footer class="bg-brand-blue-900 text-white pt-12 pb-10">
        <div class="container mx-auto px-4">
            <!-- Mobile Footer with Collapsible Sections -->
            <div class="md:hidden">
                <div class="flex flex-col items-center mb-8">



                    <p class="text-gray-400 text-sm text-center px-8 mb-6">Your trusted healthcare partner connecting
                        patients with top medical professionals.</p>

                    <!-- Social Media Icons -->
                    <div class="flex space-x-4 mb-8">
                        <a href="https://www.facebook.com/people/Med-Buzzy/pfbid02D56pbCqxDNPcrX2ZP9jjkwzLGyto89DEkGn11bArtcGx4HLEzpWfFeVDEwG8cHuSl/"
                            target="_blank" rel="noopener noreferrer" aria-label="Facebook"
                            class="h-10 w-10 bg-gradient-to-br from-brand-blue-600 to-brand-blue-800 rounded-full flex items-center justify-center hover:bg-brand-blue-500 transition-all duration-300 shadow-lg hover:shadow-brand-blue-500/50 hover:scale-110 transform">
                            <svg aria-hidden="true" class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z">
                                </path>
                            </svg>
                        </a>
                        <a href="https://instagram.com/medbuzzy" target="_blank" rel="noopener noreferrer"
                            aria-label="Instagram"
                            class="h-10 w-10 bg-gradient-to-br from-purple-600 via-pink-600 to-brand-yellow-400 rounded-full flex items-center justify-center hover:from-purple-500 hover:via-pink-500 hover:to-brand-yellow-400 transition-all duration-300 shadow-lg hover:shadow-pink-500/50 hover:scale-110 transform">
                            <svg aria-hidden="true" class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="https://www.youtube.com/@Medbuzzy" target="_blank" rel="noopener noreferrer"
                            aria-label="YouTube"
                            class="h-10 w-10 bg-gradient-to-br from-red-600 to-red-700 rounded-full flex items-center justify-center hover:from-red-500 hover:to-red-600 transition-all duration-300 shadow-lg hover:shadow-red-500/50 hover:scale-110 transform">
                            <svg aria-hidden="true" class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Accordion Footer Links - Fixed Implementation -->
                <div x-data="{ activeSection: null }" class="space-y-2 mb-8">
                    <!-- Quick Links Section -->
                    <div class="border-b border-gray-700">
                        <button @click="activeSection = activeSection === 'quickLinks' ? null : 'quickLinks'"
                            class="w-full flex justify-between items-center py-3 px-1">
                            <span class="text-lg font-medium text-brand-yellow-400">Quick Links</span>
                            <svg class="w-5 h-5 transition-transform"
                                :class="activeSection === 'quickLinks' ? 'transform rotate-180' : ''" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="activeSection === 'quickLinks'" style="display: none;">
                            <ul class="space-y-3 pl-2 py-3">
                                <li><a wire:navigate href="{{ route('hero') }}"
                                        class="block py-2 text-gray-400 hover:text-white transition">Home</a></li>
                                <li><a wire:navigate href="{{ route('our-doctors') }}"
                                        class="block py-2 text-gray-400 hover:text-white transition">Find Doctors</a>
                                </li>
                                <li><a wire:navigate href="{{ route('contact-us') }}"
                                        class="block py-2 text-gray-400 hover:text-white transition">Contact Us</a></li>
                                <li><a wire:navigate href="{{ route('about-us') }}"
                                        class="block py-2 text-gray-400 hover:text-white transition">About Us</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Legal Section -->
                    <div class="border-b border-gray-700">
                        <button @click="activeSection = activeSection === 'legal' ? null : 'legal'"
                            class="w-full flex justify-between items-center py-3 px-1">
                            <span class="text-lg font-medium text-brand-yellow-400">Legal</span>
                            <svg class="w-5 h-5 transition-transform"
                                :class="activeSection === 'legal' ? 'transform rotate-180' : ''" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="activeSection === 'legal'" style="display: none;">
                            <ul class="space-y-3 pl-2 py-3">
                                <li><a wire:navigate href="{{ route('privacy-policy') }}"
                                        class="block py-2 text-gray-400 hover:text-white transition">Privacy Policy</a>
                                </li>
                                <li><a wire:navigate href="{{ route('terms-conditons') }}"
                                        class="block py-2 text-gray-400 hover:text-white transition">Terms &
                                        Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div class="border-b border-gray-700">
                        <button @click="activeSection = activeSection === 'contact' ? null : 'contact'"
                            class="w-full flex justify-between items-center py-3 px-1">
                            <span class="text-lg font-medium text-brand-yellow-400">Contact Us</span>
                            <svg class="w-5 h-5 transition-transform"
                                :class="activeSection === 'contact' ? 'transform rotate-180' : ''" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="activeSection === 'contact'" style="display: none;">
                            <ul class="space-y-4 pl-2 py-3">
                                <li>
                                    <a href="tel:{{ $contactDetails['phone'] }}"
                                        class="flex items-center text-gray-400 hover:text-white" aria-hidden="true">
                                        <div
                                            class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-3">
                                            <svg class="h-4 w-4 text-brand-yellow-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                        </div>
                                        <span>{{ $contactDetails['phone'] }}</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="mailto:{{ $contactDetails['email'] }}"
                                        class="flex items-center text-gray-400 hover:text-white" aria-hidden="true">
                                        <div
                                            class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-3">
                                            <svg class="h-4 w-4 text-brand-yellow-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span>{{ $contactDetails['email'] }}</span>
                                    </a>
                                </li>
                                <li class="flex items-start text-gray-400">
                                    <div
                                        class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                        <svg class="h-4 w-4 text-brand-yellow-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
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

                    <svg id="Layer_1" class="h-10" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 141.61 28.02">
                        <defs>
                            <style>
                                .cls-1footer {
                                    fill: #fff;
                                }

                                .cls-2footer {
                                    fill: #003066;
                                }

                                .cls-3footer {
                                    fill: #003066;
                                }

                                .cls-4footer {
                                    font-size: 8.8px;
                                    fill: #003066;
                                    font-family: Poppins-SemiBold, Poppins;
                                    font-weight: 600;
                                }
                            </style>
                        </defs>
                        <title>{{env('APP_NAME')}}</title>
                        <path class="cls-1footer"
                            d="M15.65,18.93c-.61-.06-1.22-.17-1.83-.2-.94,0-1.88,0-2.82,0a4.74,4.74,0,0,1-3.93-1.91A3.48,3.48,0,0,1,6.48,14a2.81,2.81,0,0,1,3.27-2,8.35,8.35,0,0,1,4.49,2.4c.7.66,1.44,1.29,2.19,2a3,3,0,0,1,3.19-1.54,2.59,2.59,0,0,0-1-2.35c-.16-.12-.38-.29-.39-.45s0-.65.23-.75a.68.68,0,0,1,1,.25,9.81,9.81,0,0,1,.71,1.82,9.1,9.1,0,0,1,.15,1.58l1.48.77a5.3,5.3,0,0,1,2.54-2,2.41,2.41,0,0,1,.89-.14.57.57,0,0,1,.59.67.56.56,0,0,1-.67.58c-1.35-.34-2.15.44-2.94,1.34A3.51,3.51,0,0,1,23,19.28a3.21,3.21,0,0,1-2.37,2.17,23.8,23.8,0,0,1,.36,3,7.71,7.71,0,0,1-1.66,5,11.39,11.39,0,0,1-6.38,3.9c-.59.15-1.17.35-1.76.48a.69.69,0,0,0-.58.76,3.42,3.42,0,0,0,2.75,3.33,6.4,6.4,0,0,0,5.2-1.19,15.1,15.1,0,0,0,5.28-7c.1-.23.2-.47.28-.71.19-.55.4-1-.13-1.59a1.81,1.81,0,0,1,.69-2.64,1.89,1.89,0,0,1,2.59.94,1.81,1.81,0,0,1-1.09,2.5l-.08,0c-.77-.13-.82.45-1,1a18.21,18.21,0,0,1-4.69,7.32,8.6,8.6,0,0,1-6,2.52A4.6,4.6,0,0,1,9.63,35.1a.57.57,0,0,1,0-.29c.29-1-.24-1.84-.55-2.72a13.63,13.63,0,0,1-.92-5,8.05,8.05,0,0,1,6.6-7.93,4.31,4.31,0,0,1,.88,0Zm3,9.31a21.76,21.76,0,0,1-8.5-4.51c-.24,1-.48,1.85-.67,2.74,0,.11.11.29.22.38A22,22,0,0,0,16,30.25a.59.59,0,0,0,.5-.09C17.23,29.55,17.9,28.92,18.63,28.24Zm-6.58-6.6a21.71,21.71,0,0,0,7.64,3.74c-.1-1-.19-1.87-.3-2.75,0-.08-.2-.18-.31-.21a6.16,6.16,0,0,1-3.6-1.94.53.53,0,0,0-.4-.18A8.16,8.16,0,0,0,12.05,21.64ZM9.61,30.27l.85,2.25,2.51-.6ZM19.82,17.6c0,.58.28.9.81.91a.78.78,0,0,0,.85-.87.88.88,0,0,0-.89-.88A.77.77,0,0,0,19.82,17.6Zm5.73,9.47a.56.56,0,0,0,.59-.65.56.56,0,0,0-.63-.62.58.58,0,0,0-.63.62A.6.6,0,0,0,25.55,27.07Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-2footer"
                            d="M18.63,28.24c-.73.68-1.4,1.31-2.09,1.92a.59.59,0,0,1-.5.09,22,22,0,0,1-6.36-3.4c-.11-.09-.25-.27-.22-.38.19-.89.43-1.77.67-2.74A21.76,21.76,0,0,0,18.63,28.24Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-2footer"
                            d="M12.05,21.64a8.16,8.16,0,0,1,3-1.34.53.53,0,0,1,.4.18,6.16,6.16,0,0,0,3.6,1.94c.11,0,.3.13.31.21.11.88.2,1.76.3,2.75A21.71,21.71,0,0,1,12.05,21.64Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-2footer" d="M9.61,30.27,13,31.92l-2.51.6Z" transform="translate(-6.39 -11)" />
                        <path class="cls-3footer"
                            d="M19.82,17.6a.77.77,0,0,1,.77-.84.88.88,0,0,1,.89.88.78.78,0,0,1-.85.87C20.1,18.5,19.81,18.18,19.82,17.6Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-3footer"
                            d="M25.55,27.07a.6.6,0,0,1-.67-.65.58.58,0,0,1,.63-.62.56.56,0,0,1,.63.62A.56.56,0,0,1,25.55,27.07Z"
                            transform="translate(-6.39 -11)" /><text class="cls-4footer"
                            transform="translate(1.57 7.52) scale(1.02 1)">+</text>
                        <path class="cls-1footer"
                            d="M48.05,15V30.13h-4V20.64l-3.53,9.49H37.1l-3.56-9.51v9.51h-4V15h4.86l4.45,10.58L43.21,15Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-1footer"
                            d="M63,24.77H54a2.71,2.71,0,0,0,.75,2,2.53,2.53,0,0,0,1.72.59,2.4,2.4,0,0,0,1.46-.41,1.89,1.89,0,0,0,.77-1.06h4.21a4.89,4.89,0,0,1-1.12,2.28,5.87,5.87,0,0,1-2.18,1.58,7.92,7.92,0,0,1-6.34-.17A5.64,5.64,0,0,1,51,27.39a6.31,6.31,0,0,1-.84-3.29A6.37,6.37,0,0,1,51,20.8a5.49,5.49,0,0,1,2.31-2.14,7.42,7.42,0,0,1,3.39-.75,7.5,7.5,0,0,1,3.4.74,5.47,5.47,0,0,1,2.27,2.06,5.87,5.87,0,0,1,.8,3.06A4.61,4.61,0,0,1,63,24.77Zm-4.59-3.34a2.63,2.63,0,0,0-1.76-.6,2.7,2.7,0,0,0-1.81.61A2.43,2.43,0,0,0,54,23.21H59.1A2.15,2.15,0,0,0,58.41,21.43Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-1footer"
                            d="M72.68,18.54a3.79,3.79,0,0,1,1.56,1.71V14.13h4v16h-4V28a3.79,3.79,0,0,1-1.56,1.71,5,5,0,0,1-2.56.63,5.51,5.51,0,0,1-2.87-.75,5.27,5.27,0,0,1-2-2.15,7,7,0,0,1-.74-3.29,7,7,0,0,1,.74-3.3,5.24,5.24,0,0,1,2-2.14,5.51,5.51,0,0,1,2.87-.75A5,5,0,0,1,72.68,18.54Zm-3.34,3.4a2.92,2.92,0,0,0-.78,2.16,2.92,2.92,0,0,0,.78,2.16,3.08,3.08,0,0,0,4.12,0,2.91,2.91,0,0,0,.8-2.14,2.88,2.88,0,0,0-.8-2.15,3.1,3.1,0,0,0-4.12,0Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-1footer"
                            d="M93.18,23.6A3.53,3.53,0,0,1,94.05,26,3.67,3.67,0,0,1,92.64,29a6.38,6.38,0,0,1-4,1.1H81V14.84h7.46a6.38,6.38,0,0,1,3.88,1,3.38,3.38,0,0,1,1.38,2.9,3.43,3.43,0,0,1-.79,2.3,3.74,3.74,0,0,1-2.07,1.2A4.22,4.22,0,0,1,93.18,23.6Zm-8.25-2.51h2.61c1.38,0,2.07-.55,2.07-1.64s-.71-1.65-2.12-1.65H84.93Zm5,4.35a1.55,1.55,0,0,0-.58-1.29,2.59,2.59,0,0,0-1.65-.46H84.93v3.44h2.84C89.24,27.13,90,26.56,90,25.44Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-1footer"
                            d="M109.05,18.06V30.13h-4V28a4.15,4.15,0,0,1-1.66,1.69,5.12,5.12,0,0,1-2.57.62,4.68,4.68,0,0,1-3.55-1.38A5.28,5.28,0,0,1,96,25.07v-7h4v6.56a2.56,2.56,0,0,0,.69,1.91,2.46,2.46,0,0,0,1.84.68,2.52,2.52,0,0,0,1.91-.71,2.77,2.77,0,0,0,.7-2V18.06Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-1footer" d="M115.3,27h6v3.09H111V27.21l5.58-6.07h-5.49V18.06h10V21Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-1footer" d="M126.7,27h6v3.09H122.35V27.21l5.58-6.07h-5.49V18.06h10V21Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-1footer"
                            d="M137.58,18.06l3.12,7.4,2.9-7.4H148l-8.09,17.83h-4.38l3.05-6.21-5.44-11.62Z"
                            transform="translate(-6.39 -11)" />
                    </svg>
                    <p class="text-gray-400 text-sm">Your trusted healthcare partner connecting patients with top
                        medical professionals.</p>

                    <!-- Social Media Icons -->
                    <div class="flex space-x-3 pt-2">
                        <a href="https://www.facebook.com/people/Med-Buzzy/pfbid02D56pbCqxDNPcrX2ZP9jjkwzLgyto89DEkGn11bArtcGx4HLEzpWfFeVDEwG8cHuSl/"
                            aria-label="Facebook" target="_blank" rel="noopener noreferrer"
                            class="h-8 w-8 bg-gradient-to-br from-brand-blue-600 to-brand-blue-800 rounded-full flex items-center justify-center hover:bg-brand-blue-500 transition-all duration-300 shadow-md hover:shadow-brand-blue-500/50 hover:scale-110 transform">
                            <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path
                                    d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z">
                                </path>
                            </svg>
                        </a>
                        <a href="https://instagram.com/medbuzzy" target="_blank" rel="noopener noreferrer"
                            aria-label="Instagram"
                            class="h-8 w-8 bg-gradient-to-br from-purple-600 via-pink-600 to-brand-yellow-400 rounded-full flex items-center justify-center hover:from-purple-500 hover:via-pink-500 hover:to-brand-yellow-400 transition-all duration-300 shadow-md hover:shadow-pink-500/50 hover:scale-110 transform">
                            <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="https://www.youtube.com/@Medbuzzy" target="_blank" rel="noopener noreferrer"
                            aria-label="YouTube"
                            class="h-8 w-8 bg-gradient-to-br from-red-600 to-red-700 rounded-full flex items-center justify-center hover:from-red-500 hover:to-red-600 transition-all duration-300 shadow-md hover:shadow-red-500/50 hover:scale-110 transform">
                            <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-brand-yellow-400">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a wire:navigate href="{{ route('hero') }}"
                                class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a wire:navigate href="{{ route('our-doctors') }}"
                                class="text-gray-400 hover:text-white transition">Find Doctors</a></li>
                        <li><a wire:navigate href="{{ route('contact-us') }}"
                                class="text-gray-400 hover:text-white transition">Contact Us</a></li>
                        <li><a wire:navigate href="{{ route('about-us') }}"
                                class="text-gray-400 hover:text-white transition">About Us</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-brand-yellow-400">Legal</h3>
                    <ul class="space-y-2">
                        <li><a wire:navigate href="{{ route('privacy-policy') }}"
                                class="text-gray-400 hover:text-white transition">Privacy Policy</a></li>
                        <li><a wire:navigate href="{{ route('terms-conditons') }}"
                                class="text-gray-400 hover:text-white transition">Terms & Conditions</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-brand-yellow-400">Contact Us</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center text-gray-400">
                            <svg class="h-5 w-5 mr-2 text-brand-yellow-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <a wire:navigate href="tel:{{ $contactDetails['phone'] }}"
                                class="hover:text-white transition-colors">{{ $contactDetails['phone'] }}</a>
                        </li>

                        @if ($contactDetails['emergency_phone'])
                            <li class="flex items-center text-gray-400">
                                <svg class="h-5 w-5 mr-2 text-brand-yellow-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <a wire:navigate href="tel:{{ $contactDetails['emergency_phone'] }}"
                                    class="hover:text-white transition-colors">Support:
                                    {{ $contactDetails['emergency_phone'] }}</a>
                            </li>
                        @endif

                        <li class="flex items-center text-gray-400">
                            <svg class="h-5 w-5 mr-2 text-brand-yellow-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a wire:navigate href="mailto:{{ $contactDetails['email'] }}"
                                class="hover:text-white transition-colors">{{ $contactDetails['email'] }}</a>
                        </li>

                        <li class="flex items-start text-gray-400">
                            <svg class="h-5 w-5 mr-2 text-brand-yellow-400 mt-0.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $contactDetails['address'] }}
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Divider -->
            <div class="border-t border-gray-700 pt-6 text-center flex flex-col items-center text-sm text-gray-400">

                <a href="https://play.google.com/store/apps/details?id=com.comestro.medbuzzy" target="_blank"
                    rel="noopener noreferrer" class="flex items-center text-gray-400 hover:text-white"
                    x-data="{}" x-init="if (navigator.userAgent.indexOf('wv') > -1 ||
                        navigator.userAgent.indexOf('Android') > -1 && navigator.userAgent.indexOf('Version') > -1) {
                        $el.style.display = 'none';
                    }">
                    <img src="{{ asset('logo/playstore.png') }}" class="mb-3 max-h-10 w-auto"
                        alt="Get our app on Google Play">
                </a>
                <p class="mb-2">MedBuzzy is not a substitute for professional medical advice, diagnosis, or
                    treatment.</p>
                <p class="mb-4">Always seek the advice of your physician or other qualified health provider with any
                    questions you may have regarding a medical condition.</p>
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
                min-height: 44px;
                /* Improved tap target size */
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
            background-color: #f59e0b;
            transition: width 0.3s ease;
        }

        footer ul a:hover:after {
            width: 100%;
        }
    </style>
</div>
