<div>
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-transition>
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Write a Review</h3>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                @if(session('message'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                @if($showLoginMessage)
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">
                        Please <a href="{{ route('login') }}" class="underline">login</a> to submit a review.
                    </div>
                @endif

                <form wire:submit.prevent="submitReview" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                <button 
                                    type="button" 
                                    wire:click="setRating({{ $i }})" 
                                    class="text-2xl focus:outline-none {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                >
                                    ★
                                </button>
                            @endfor
                        </div>
                        @error('rating')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Review</label>
                        <textarea 
                            wire:model="comment" 
                            id="comment" 
                            rows="4" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Share your experience..."
                        ></textarea>
                        @error('comment')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button 
                            type="button" 
                            wire:click="closeModal" 
                            class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand-blue-600 hover:bg-brand-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500"
                        >
                            Submit Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>