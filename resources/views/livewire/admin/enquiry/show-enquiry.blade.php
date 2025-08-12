<div>
    @if($showModel && $enquiry)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden transform transition-all duration-300 scale-100">
                <!-- Modal Header with Teal Background -->
                <div class="bg-teal-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-white">Enquiry Details</h2>
                            <p class="text-teal-100 text-sm mt-1">ID: #{{ $enquiry->id }}</p>
                        </div>
                        <button wire:click="closeModal" 
                                class="text-teal-100 hover:text-white transition-colors duration-200 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Card Body -->
                <div class="p-6 space-y-6">
                    <!-- Contact Info Section -->
                    <div class="bg-teal-50 rounded-lg p-4 border border-teal-100">
                        <h3 class="text-sm font-medium text-teal-800 mb-3">CONTACT INFORMATION</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <span class="block text-xs font-medium text-teal-600">Name</span>
                                <span class="block text-gray-800 font-medium mt-1">{{ $enquiry->name ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-medium text-teal-600">Email</span>
                                <span class="block text-gray-800 font-medium mt-1">{{ $enquiry->email ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-medium text-teal-600">Phone</span>
                                <span class="block text-gray-800 font-medium mt-1">{{ $enquiry->phone ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Message Section -->
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <h3 class="text-sm font-medium text-teal-800 mb-3">MESSAGE</h3>
                        <div class="prose prose-sm max-w-none text-gray-700">
                            <p class="whitespace-pre-line">{{ $enquiry->message ?? 'No message provided' }}</p>
                        </div>
                    </div>

                    <!-- Meta Info Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h3 class="text-sm font-medium text-teal-800 mb-2">STATUS</h3>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                @if($enquiry->is_read) bg-green-100 text-green-800 @else bg-amber-100 text-amber-800 @endif">
                                @if($enquiry->is_read) 
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Read
                                @else 
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    Pending
                                @endif
                            </span>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h3 class="text-sm font-medium text-teal-800 mb-2">SUBMITTED</h3>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $enquiry->created_at->format('d M Y, h:i A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex  space-x-3">
                    <button wire:click="closeModal" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors duration-200">
                        Close
                    </button>
                    @if(!$enquiry->is_read)
                        <button wire:click="$parent.markAsRead({{ $enquiry->id }})" 
                                class="px-4 py-2 text-sm font-medium text-white bg-teal-600 border border-transparent rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Mark as Read
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>