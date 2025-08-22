<div class="container px-4 py-8 mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-blue-100 overflow-hidden">
        <!-- Table Header -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-blue-200">
                <thead class="bg-blue-600">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider hidden sm:table-cell">
                            Name
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-blue-100 uppercase tracking-wider">
                            <span class="hidden sm:inline">Phone</span>
                            <span class="sm:hidden">Contact</span>
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-blue-100 uppercase tracking-wider hidden md:table-cell">
                            Email
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-blue-100 uppercase tracking-wider hidden lg:table-cell">
                            Message
                        </th>
                        <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-blue-100 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-100">
                    @foreach ($enquiries as $enquiry)
                        <tr class="@if ($enquiry->is_read) bg-blue-100 @else bg-white @endif transition-colors duration-150">
                            <!-- Name Column -->
                            <td class="px-4 py-4 whitespace-nowrap hidden sm:table-cell">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-blue-900">
                                        {{ $enquiry->name }}
                                    </div>
                                </div>
                            </td>

                            <!-- Phone Column (always visible) -->
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-blue-900 sm:hidden">{{ $enquiry->name }}</span>
                                    <span class="text-sm text-blue-700">{{ $enquiry->phone }}</span>
                                </div>
                            </td>

                            <!-- Email Column (hidden on mobile) -->
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-blue-700 hidden md:table-cell">
                                <span class="truncate max-w-[180px] inline-block">{{ $enquiry->email }}</span>
                            </td>

                            <!-- Message Column (hidden on tablet and below) -->
                            <td class="px-4 py-4 text-sm text-blue-700 hidden lg:table-cell">
                                <span class="line-clamp-2">{{ $enquiry->message }}</span>
                            </td>

                            <!-- Action Column -->
                            <td class="px-4 py-4 whitespace-nowra text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <button wire:click="markAsRead({{ $enquiry->id }})" 
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        <span class="hidden sm:inline">View</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <livewire:admin.enquiry.show-enquiry/>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($enquiries->hasPages())
        <div class="px-4 py-3 border-t border-blue-100 sm:px-6">
            {{ $enquiries->links('pagination::tailwind') }}
        </div>
        @endif

        <!-- Empty State -->
        @if($enquiries->isEmpty())
        <div class="px-4 py-12 text-center">
            <svg class="mx-auto h-12 w-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-blue-800">No enquiries found</h3>
            <p class="mt-1 text-sm text-blue-600">Any new enquiries will appear here.</p>
        </div>
        @endif
    </div>
</div>