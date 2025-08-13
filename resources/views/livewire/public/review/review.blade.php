<div>
    @if($showModal)
    <div>
        @if(session('message'))
            <div class="alert alert-success bg-brand-blue-100 border-l-4 border-brand-blue-500 text-brand-blue-900 p-4 mb-6 rounded-r-lg">
                {{ session('message') }}
            </div>
        @endif

        @if($showLoginMessage)
            <div class="alert alert-warning bg-yellow-100 border-l-4 border-yellow-500 text-yellow-900 p-4 mb-6 rounded-r-lg">
                Please <a wire:navigate href="{{ route('login') }}" class="underline hover:text-yellow-700">login</a> to submit a review!
            </div>
        @endif

        <form wire:submit.prevent="submitReview" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-6">
                <label class="block text-brand-blue-900 font-semibold mb-2">Your Rating</label>
              
                <div class="flex items-center space-x-1">
                    @for($i = 1; $i <= 5; $i++)
                        <button 
                            type="button" 
                            wire:click="setRating({{ $i }})" 
                            class="text-2xl focus:outline-none {{ $rating >= $i ? 'text-brand-orange-500' : 'text-gray-300' }} hover:text-brand-orange-400 transition-colors"
                        >
                            ★
                        </button>
                    @endfor
                </div>
                @error('rating') 
                    <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> 
                @enderror
            </div>

            <div class="mb-6">
                <label for="comment" class="block text-brand-blue-900 font-semibold mb-2">Your Review</label>
                <textarea 
                    wire:model="comment" 
                    id="comment" 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue-500 focus:border-transparent resize-y" 
                    rows="4"
                    placeholder="Share your thoughts..."
                ></textarea>
                @error('comment') 
                    <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> 
                @enderror
            </div>

            <button 
                type="submit" 
                class="w-full bg-brand-blue-500 text-white font-semibold py-3 rounded-lg hover:bg-brand-blue-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
            >
                Submit Review
            </button>
        </form>
    </div>
@endif
</div>