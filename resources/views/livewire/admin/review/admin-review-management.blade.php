<div class="min-h-screen bg-gray-50">
  <!-- Header -->
 
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Title and Controls -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
      <div>
        <h2 class="text-xl font-semibold text-gray-800">Pending Reviews</h2>
        <p class="text-gray-500 mt-1">Manage and approve customer reviews</p>
      </div>
      <div class="mt-4 md:mt-0">
        <div class="relative rounded-md shadow-sm">
          <input type="text" class="block w-full pr-10 sm:text-sm border-gray-300 rounded-md p-2 border" placeholder="Search reviews...">
          <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Review List -->
    @forelse ($pendingReviews as $review)
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
  <ul class="divide-y divide-gray-200">
    @foreach($pendingReviews as $review)
    <li class="p-6 hover:bg-gray-50 transition-colors duration-150">
      <div class="flex flex-col sm:flex-row sm:items-start">
        <!-- User Avatar with Initials -->
        <div class="flex-shrink-0">
          @php
            $colors = ['indigo', 'purple', 'blue', 'green', 'yellow', 'red', 'pink'];
            $color = $colors[array_rand($colors)];
          @endphp
          <div class="h-10 w-10 rounded-full bg-{{ $color }}-100 flex items-center justify-center text-{{ $color }}-600 font-medium">
            {{ strtoupper(substr($review->user->name, 0, 2)) }}
          </div>
        </div>
        
        <div class="mt-4 sm:mt-0 sm:ml-6 flex-1">
          <div class="flex items-center">
            <!-- Star Rating -->
            <div class="flex items-center">
              @for($i = 1; $i <= 5; $i++)
                @if($i <= $review->rating)
                  <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                  </svg>
                @else
                  <svg class="h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                  </svg>
                @endif
              @endfor
            </div>
            
            <p class="ml-2 text-sm font-medium text-gray-600">{{ $review->user->name }}</p>
            <span class="mx-1 text-gray-400">•</span>
            <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
          </div>
          
          <div class="mt-2">
            <h4 class="text-sm font-medium text-gray-900">Review for Dr. {{ $review->doctor->user->name }}</h4>
            <p class="mt-1 text-sm text-gray-600">{{ $review->comment }}</p>
          </div>
          
          <div class="mt-4 flex space-x-4">
            <button wire:click="approve({{ $review->id }})" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
              Approve
            </button>
            
            <button wire:click="reject({{ $review->id }})" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              Reject
            </button>
          </div>
        </div>
      </div>
    </li>
    @endforeach
  </ul>
</div>
@empty
<div class="bg-white shadow overflow-hidden sm:rounded-lg p-6 text-center">
  <p class="text-gray-500">No pending reviews to approve.</p>
</div>
@endforelse
   
  </div>
</div>