<div>
    <!-- Include Create, Update, and View components -->
    <livewire:admin.doctor.create-doctor />
    <livewire:admin.doctor.update-doctor />
    <livewire:admin.doctor.view-doctor />
    
    <!-- Include Delete Confirmation Modal -->
    <livewire:components.delete-confirmation-modal />
    
    <div class="container mx-auto max-w-8xl px-2 sm:px-4 lg:px-6">
        <!-- Enhanced Header Section -->
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 lg:p-8 mb-4 sm:mb-6 lg:mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-user-md text-blue-600 text-xl"></i>
                        </div>
                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">Doctor Management</h1>
                    </div>
                    <p class="text-gray-600 text-sm sm:text-base mb-2">Manage all doctors in your medical practice</p>
                    <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-users mr-1 text-blue-500"></i>
                            {{ $doctors->total() ?? 0 }} Total
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-clock mr-1 text-green-500"></i>
                            Updated {{ now()->diffForHumans() }}
                        </span>
                    </div>
                </div>
                
                <!-- Search and Add Button -->
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <!-- Search Bar -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" 
                               wire:model.live.debounce.300ms="search" 
                               placeholder="Search doctors..." 
                               class="pl-10 pr-4 py-2 sm:py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64 text-sm transition-all duration-200">
                    </div>
                    
                    <!-- Add Doctor Button -->
                    <button wire:click="openCreateModal" 
                            class="bg-blue-600  hover:bg-blue-800 text-white px-4 py-2 sm:py-2.5 rounded-lg font-medium shadow-lg transition-all duration-300 flex items-center justify-center space-x-2 hover:shadow-xl transform hover:-translate-y-0.5 text-sm sm:text-base">
                        <i class="fas fa-plus text-sm"></i>
                        <span class="hidden sm:inline">Add Doctor</span>
                        <span class="sm:hidden">Add</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session()->has('message'))
        <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg flex items-start">
            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-green-500 mr-2 sm:mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <p class="text-sm sm:text-base">{{ session('message') }}</p>
        </div>
        @endif

        @if (session()->has('error'))
        <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg flex items-start">
            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-red-500 mr-2 sm:mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm sm:text-base">{{ session('error') }}</p>
        </div>
        @endif

        <!-- Enhanced Doctors Table -->
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
            <!-- Desktop Table -->
            <div class="overflow-x-auto hidden lg:block">
                <table class="w-full table-auto">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Doctor
                            </th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Department
                            </th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Contact
                            </th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Schedule
                            </th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Fee
                            </th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($doctors as $doctor)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($doctor->image)
                                            <img class="h-10 w-10 rounded-full object-cover ring-2 ring-blue-100" 
                                                 src="{{ $doctor->image }}" 
                                                 alt="{{ $doctor->user->name }}">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center ring-2 ring-blue-100">
                                                <span class="text-white font-semibold text-sm">
                                                    {{ substr($doctor->user->name, 0, 1) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $doctor->user->name }}</div>
                                        <div class="text-xs text-gray-500 truncate max-w-32">
                                            @if($doctor->qualification && is_array($doctor->qualification))
                                                {{ implode(', ', array_slice($doctor->qualification, 0, 1)) }}
                                                @if(count($doctor->qualification) > 1)
                                                    <span class="text-blue-600">+{{ count($doctor->qualification) - 1 }}</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                    {{ $doctor->department->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="space-y-1">
                                    <div class="flex items-center text-xs">
                                        <i class="fas fa-envelope text-gray-400 mr-1 w-3"></i>
                                        <span class="truncate max-w-28">{{ $doctor->user->email }}</span>
                                    </div>
                                    <div class="flex items-center text-xs">
                                        <i class="fas fa-phone text-gray-400 mr-1 w-3"></i>
                                        <span>{{ $doctor->user->phone ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="space-y-1">
                                    <div class="font-medium text-xs">
                                        {{ \Carbon\Carbon::parse($doctor->start_time)->format('g:i A') }} - 
                                        {{ \Carbon\Carbon::parse($doctor->end_time)->format('g:i A') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ count($doctor->available_days ?? []) }} days/week
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    ₹{{ number_format($doctor->fee) }}
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <!-- Toggle Switch for Status -->
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" 
                                           wire:click="toggleStatus({{ $doctor->id }})"
                                           {{ $doctor->status == 1 ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-green-500"></div>
                                </label>
                                <span class="ml-2 text-xs font-medium text-gray-700">
                                    {{ $doctor->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center space-x-1">
                                    <button wire:click="openViewModal({{ $doctor->id }})" 
                                            class="text-blue-600 hover:text-blue-900 transition-colors duration-200 p-1.5 hover:bg-blue-50 rounded-lg">
                                        <i class="fas fa-eye text-xs"></i>
                                    </button>
                                    <button wire:click="openUpdateModal({{ $doctor->id }})" 
                                            class="text-green-600 hover:text-green-900 transition-colors duration-200 p-1.5 hover:bg-green-50 rounded-lg">
                                        <i class="fas fa-edit text-xs"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $doctor->id }})" 
                                            class="text-red-600 hover:text-red-900 transition-colors duration-200 p-1.5 hover:bg-red-50 rounded-lg">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-user-md text-gray-300 text-6xl mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No doctors found</h3>
                                    <p class="text-gray-500 mb-6">Get started by adding your first doctor to the system.</p>
                                    <button wire:click="openCreateModal" 
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                                        <i class="fas fa-plus mr-2"></i>Add First Doctor
                                    </button>
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
                <div class="bg-white rounded-xl p-4 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-200">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 h-14 w-14 bg-blue-200 rounded-full flex items-center justify-center shadow-md">
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
                                        <!-- Toggle Switch for Status -->
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" 
                                                   wire:click="toggleStatus({{ $doctor->id }})"
                                                   {{ $doctor->status == 1 ? 'checked' : '' }}
                                                   class="sr-only peer">
                                            <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-green-500"></div>
                                        </label>
                                        <span class="text-xs font-medium text-gray-700">
                                            {{ $doctor->status == 1 ? 'Active' : 'Inactive' }}
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
                                <button wire:click="openViewModal({{ $doctor->id }})" class="flex-1 text-center px-3 py-3 bg-blue-100 text-blue-700 rounded-lg text-sm font-medium hover:bg-blue-200 transition-colors duration-200 min-h-[44px] touch-target">
                                    <i class="fas fa-eye mr-1"></i>View
                                </button>
                                <button wire:click="openUpdateModal({{ $doctor->id }})" class="flex-1 text-center px-3 py-3 bg-indigo-100 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-200 transition-colors duration-200 min-h-[44px] touch-target">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                <button wire:click="confirmDelete({{ $doctor->id }})" class="flex-1 text-center px-3 py-3 bg-red-100 text-red-700 rounded-lg text-sm font-medium hover:bg-red-200 transition-colors duration-200 min-h-[44px] touch-target">
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
            
            .touch-target {
                min-height: 44px;
                min-width: 44px;
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
