<div>
    <!-- Include Create, Update, and View components -->
    <livewire:admin.doctor.create-doctor />
    <livewire:admin.doctor.update-doctor />
    <livewire:admin.doctor.view-doctor />
    
    <div class="container mx-auto max-w-8xl">
        <!-- Enhanced Header Section -->
        <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 lg:p-8 mb-6 lg:mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                <div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 tracking-tight">Doctor Management</h1>
                    <p class="text-gray-600 mt-2 responsive-text-base">Manage all doctors in your medical practice</p>
                    <div class="flex items-center mt-3 space-x-4 text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-users mr-2 text-blue-500"></i>
                            {{ $doctors->total() }} Total Doctors
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-clock mr-2 text-green-500"></i>
                            Last updated {{ now()->diffForHumans() }}
                        </span>
                    </div>
                </div>
                <button wire:click="openCreateModal" class="btn-primary flex items-center px-4 py-3 sm:px-6 sm:py-3 rounded-xl font-medium shadow-lg transition-all duration-300 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="responsive-text-base">Add New Doctor</span>
                </button>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg flex items-start">
            <svg class="h-5 w-5 text-green-500 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <p>{{ session('message') }}</p>
        </div>
        @endif

        @if (session()->has('error'))
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg flex items-start">
            <svg class="h-5 w-5 text-red-500 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p>{{ session('error') }}</p>
        </div>
        @endif

        <!-- Enhanced Search and Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0 lg:space-x-4">
                <!-- Search Bar -->
                <div class="flex-1 relative">
                    <input type="text" 
                           placeholder="Search by name, email, department..." 
                           wire:model.live.debounce.300ms="search" 
                           class="form-input w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 responsive-text-base">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                    @if($search)
                        <button wire:click="$set('search', '')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    @endif
                </div>
                
                <!-- Quick Filters -->
                <div class="flex flex-wrap gap-2 lg:flex-nowrap">
                    <button class="px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors duration-200 responsive-text-sm">
                        <i class="fas fa-filter mr-2"></i>All Doctors
                    </button>
                    <button class="px-4 py-2 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors duration-200 responsive-text-sm">
                        <i class="fas fa-check-circle mr-2"></i>Active
                    </button>
                    <button class="px-4 py-2 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors duration-200 responsive-text-sm">
                        <i class="fas fa-pause-circle mr-2"></i>Inactive
                    </button>
                </div>
            </div>
        </div>

        <!-- Enhanced Doctors Table -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Desktop Table -->
            <div class="overflow-x-auto hidden lg:block">
                <table class="w-full table-auto">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Doctor</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Department</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Schedule</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fee</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($doctors as $doctor)
                        <tr class="hover:bg-blue-50/50 transition-all duration-200 card-hover">
                            <!-- Doctor Info -->
                            <td class="px-6 py-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-14 w-14 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center shadow-md">
                                        @if ($doctor->image)
                                            <img src="{{ $doctor->image }}" class="h-14 w-14 rounded-full object-cover ring-2 ring-blue-200" alt="{{ $doctor->user->name }}">
                                        @else
                                            <span class="text-blue-600 font-bold text-lg">{{ substr($doctor->user->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $doctor->user->name }}</div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            @if (is_array($doctor->qualification))
                                                {{ implode(', ', array_slice($doctor->qualification, 0, 2)) }}
                                                @if(count($doctor->qualification) > 2)
                                                    <span class="text-gray-400">+{{ count($doctor->qualification) - 2 }} more</span>
                                                @endif
                                            @else
                                                {{ $doctor->qualification ?? 'No qualification specified' }}
                                            @endif
                                        </div>
                                        @if($doctor->city || $doctor->state)
                                        <div class="text-xs text-gray-400 mt-1 flex items-center">
                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                            {{ $doctor->city }}, {{ $doctor->state }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Department -->
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 shadow-sm">
                                    <i class="fas fa-building mr-2 text-xs"></i>
                                    {{ $doctor->department->name }}
                                </span>
                            </td>

                            <!-- Schedule -->
                            <td class="px-6 py-5">
                                <div class="space-y-1">
                                    <div class="text-sm font-medium text-gray-900 flex items-center">
                                        <i class="fas fa-clock mr-2 text-blue-500"></i>
                                        {{ \Carbon\Carbon::parse($doctor->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($doctor->end_time)->format('h:i A') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        @if (is_array($doctor->available_days) && count($doctor->available_days) > 0)
                                            {{ implode(', ', array_slice($doctor->available_days, 0, 3)) }}
                                            @if(count($doctor->available_days) > 3)
                                                <span class="text-gray-400">+{{ count($doctor->available_days) - 3 }} more</span>
                                            @endif
                                        @else
                                            <span class="text-red-500">No schedule set</span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-400 flex items-center space-x-2">
                                        <span>{{ $doctor->slot_duration_minutes }}min slots</span>
                                        <span>•</span>
                                        <span>{{ $doctor->patients_per_slot }} patient(s)</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact -->
                            <td class="px-6 py-5">
                                <div class="space-y-1">
                                    <div class="text-sm text-gray-600 flex items-center">
                                        <i class="fas fa-envelope mr-2 text-gray-400"></i>
                                        <span class="truncate">{{ $doctor->user->email }}</span>
                                    </div>
                                    <div class="text-sm text-gray-600 flex items-center">
                                        <i class="fas fa-phone mr-2 text-gray-400"></i>
                                        {{ $doctor->user->phone ?? 'No phone' }}
                                    </div>
                                </div>
                            </td>

                            <!-- Fee -->
                            <td class="px-6 py-5">
                                <div class="text-lg font-bold text-gray-900 flex items-center">
                                    <i class="fas fa-rupee-sign mr-1 text-green-500"></i>
                                    {{ number_format($doctor->fee, 0) }}
                                </div>
                                <div class="text-xs text-gray-500">Per consultation</div>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-5">
                                @if($doctor->status == 1)
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Active
                                    </span>
                                @elseif($doctor->status == 0)
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Inactive
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        On Leave
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-5">
                                <div class="flex items-center space-x-2">
                                    <button wire:click="openViewModal({{ $doctor->id }})" class="flex items-center px-3 py-2 text-blue-600 hover:text-blue-800 transition-colors duration-200 bg-blue-50 hover:bg-blue-100 rounded-lg shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span class="text-sm font-medium">View</span>
                                    </button>
                                    <button wire:click="openUpdateModal({{ $doctor->id }})" class="flex items-center px-3 py-2 text-indigo-600 hover:text-indigo-800 transition-colors duration-200 bg-indigo-50 hover:bg-indigo-100 rounded-lg shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span class="text-sm font-medium">Edit</span>
                                    </button>
                                    <button wire:click="confirmDelete({{ $doctor->id }})" class="flex items-center px-3 py-2 text-red-600 hover:text-red-800 transition-colors duration-200 bg-red-50 hover:bg-red-100 rounded-lg shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span class="text-sm font-medium">Delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 sm:px-6 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-700 mb-2">No doctors found</h3>
                                    <p class="text-sm text-gray-500 mb-4">
                                        @if($search)
                                            No doctors match your search criteria. Try adjusting your search terms.
                                        @else
                                            Get started by adding your first doctor to the system.
                                        @endif
                                    </p>
                                    @if(!$search)
                                    <button wire:click="openCreateModal" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Add First Doctor
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Enhanced Mobile Cards -->
            <div class="lg:hidden space-y-4 p-4">
                @forelse($doctors as $doctor)
                <div class="card-hover bg-white rounded-xl p-4 shadow-lg border border-gray-100">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 h-14 w-14 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center shadow-md">
                            @if ($doctor->image)
                                <img src="{{ $doctor->image }}" class="h-14 w-14 rounded-full object-cover ring-2 ring-blue-200" alt="{{ $doctor->user->name }}">
                            @else
                                <span class="text-blue-600 font-bold text-lg">{{ substr($doctor->user->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $doctor->user->name }}</h3>
                                    <p class="text-sm text-gray-600 truncate">{{ $doctor->department->name }}</p>
                                    <div class="mt-2 flex items-center space-x-2">
                                        <span class="text-lg font-bold text-green-600 flex items-center">
                                            <i class="fas fa-rupee-sign mr-1 text-sm"></i>
                                            {{ number_format($doctor->fee, 0) }}
                                        </span>
                                        <span class="text-gray-400">•</span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            @if($doctor->status == 1) bg-green-100 text-green-800 
                                            @elseif($doctor->status == 0) bg-red-100 text-red-800 
                                            @else bg-yellow-100 text-yellow-800 @endif">
                                            @if($doctor->status == 1) Active 
                                            @elseif($doctor->status == 0) Inactive 
                                            @else On Leave @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Contact Info -->
                            <div class="mt-3 space-y-1">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-envelope mr-2 text-gray-400 w-4"></i>
                                    <span class="truncate">{{ $doctor->user->email }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-clock mr-2 text-gray-400 w-4"></i>
                                    <span>{{ \Carbon\Carbon::parse($doctor->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($doctor->end_time)->format('h:i A') }}</span>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="mt-4 flex space-x-2">
                                <button wire:click="openViewModal({{ $doctor->id }})" class="flex-1 text-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg text-sm font-medium hover:bg-blue-200 transition-colors duration-200">
                                    <i class="fas fa-eye mr-1"></i>View
                                </button>
                                <button wire:click="openUpdateModal({{ $doctor->id }})" class="flex-1 text-center px-3 py-2 bg-indigo-100 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-200 transition-colors duration-200">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                <button wire:click="confirmDelete({{ $doctor->id }})" class="flex-1 text-center px-3 py-2 bg-red-100 text-red-700 rounded-lg text-sm font-medium hover:bg-red-200 transition-colors duration-200">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12 bg-white rounded-xl shadow-lg">
                    <div class="flex flex-col items-center justify-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-700 mb-2">No doctors found</h3>
                        <p class="text-sm text-gray-500 mb-4 px-4">
                            @if($search)
                                No doctors match your search criteria. Try adjusting your search terms.
                            @else
                                Get started by adding your first doctor to the system.
                            @endif
                        </p>
                        @if(!$search)
                        <button wire:click="openCreateModal" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add First Doctor
                        </button>
                        @endif
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Enhanced Pagination -->
            @if($doctors->hasPages())
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-4 py-6 sm:px-6 flex flex-col sm:flex-row items-center justify-between border-t border-gray-200">
                <div class="responsive-text-sm text-gray-600 mb-3 sm:mb-0">
                    <span class="font-medium">Showing {{ $doctors->firstItem() }}</span> to <span class="font-medium">{{ $doctors->lastItem() }}</span> of <span class="font-medium">{{ $doctors->total() }}</span> results
                </div>
                <nav class="flex space-x-1" aria-label="Pagination">
                    {{ $doctors->links() }}
                </nav>
            </div>
            @endif
        </div>

        <!-- Enhanced Delete Confirmation Modal -->
        @if($confirmingDelete)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4" x-data x-trap.inert.noscroll="true">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300 animate-pulse">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Confirm Deletion</h3>
                        <button wire:click="cancelDelete" class="text-gray-400 hover:text-gray-500 transition-colors duration-200 p-1 rounded-lg hover:bg-gray-100">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Warning Icon -->
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-red-100 rounded-full">
                        <svg class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    
                    <!-- Content -->
                    <div class="text-center mb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Delete Doctor?</h4>
                        <p class="text-gray-600 responsive-text-sm">Are you sure you want to delete this doctor? This action will permanently remove:</p>
                        <ul class="responsive-text-sm text-gray-600 mt-3 space-y-1 text-left bg-gray-50 rounded-lg p-3">
                            <li class="flex items-center">
                                <i class="fas fa-times-circle text-red-500 mr-2 w-4"></i>
                                Doctor profile and account
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-times-circle text-red-500 mr-2 w-4"></i>
                                All associated data
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-times-circle text-red-500 mr-2 w-4"></i>
                                Appointment history
                            </li>
                        </ul>
                        <p class="text-red-600 responsive-text-sm font-medium mt-3 bg-red-50 rounded-lg p-2">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            This action cannot be undone!
                        </p>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-3">
                        <button wire:click="cancelDelete" class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                            <i class="fas fa-arrow-left mr-2"></i>Cancel
                        </button>
                        <button wire:click="delete" class="flex-1 px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200 font-medium flex items-center justify-center">
                            <svg wire:loading wire:target="delete" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span wire:loading.remove wire:target="delete">
                                <i class="fas fa-trash mr-2"></i>Yes, Delete
                            </span>
                            <span wire:loading wire:target="delete">Deleting...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <style>
        /* Enhanced scrollbar for better UX */
        .overflow-y-auto::-webkit-scrollbar {
            width: 8px;
        }
        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #cbd5e1, #94a3b8);
            border-radius: 10px;
        }
        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #94a3b8, #64748b);
        }

        /* Table row hover animation */
        .table-row-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .table-row-hover:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(147, 197, 253, 0.05) 100%);
            transform: translateY(-1px);
        }

        /* Mobile card animations */
        .mobile-card {
            transition: all 0.3s ease;
        }

        .mobile-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Loading animation for buttons */
        .btn-loading {
            position: relative;
            overflow: hidden;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-loading:hover::after {
            left: 100%;
        }

        /* Search input focus animation */
        .search-input {
            transition: all 0.3s ease;
        }

        .search-input:focus {
            transform: scale(1.02);
        }

        /* Status badge animations */
        .status-badge {
            transition: all 0.3s ease;
        }

        .status-badge:hover {
            transform: scale(1.05);
        }

        /* Responsive utilities */
        @media (max-width: 640px) {
            .responsive-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        @media (min-width: 641px) and (max-width: 1024px) {
            .responsive-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
        }

        @media (min-width: 1025px) {
            .responsive-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }
        }
    </style>
</div>
