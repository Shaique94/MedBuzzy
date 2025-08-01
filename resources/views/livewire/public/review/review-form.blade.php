<div>
    <div x-data="{ showModal: false, rating: 0 }"
         x-show="showModal"
         @openreviewmodal.window="showModal = true; rating = 0;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
         style="display: none;">
        
        <div @click.outside="showModal = false" class="bg-white rounded-xl shadow-2xl max-w-lg w-full mx-4 overflow-hidden">
            <div class="p-6 bg-gradient-to-r from-brand-teal-500 to-brand-teal-600 text-white">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold">Write Your Review</h3>
                    <button @click="showModal = false" class="text-white hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="p-6">
                <form wire:submit.prevent="saveReview">
                    <input type="hidden" wire:model="doctorId">
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Your Rating</label>
                        <div class="flex space-x-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <button type="button"
                                        @click="rating = {{ $i }}; $wire.rating = {{ $i }}"
                                        :class="rating >= {{ $i }} ? 'text-amber-400' : 'text-gray-300'"
                                        class="focus:outline-none transition-colors">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                            @endfor
                        </div>
                        @error('rating') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="mb-6">
                        <label for="comment" class="block text-gray-700 mb-2">Your Review</label>
                        <textarea
                            id="comment"
                            wire:model="comment"
                            rows="4"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-teal-500"
                            placeholder="Share your experience with this doctor..."
                        ></textarea>
                        @error('comment') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="flex justify-end">
                        <button
                            type="button"
                            @click="showModal = false"
                            class="px-4 py-2 mr-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="px-4 py-2 text-white bg-brand-teal-600 rounded-lg hover:bg-brand-teal-700"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-75">
                            <span wire:loading.remove>Submit Review</span>
                            <span wire:loading>Submitting...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
