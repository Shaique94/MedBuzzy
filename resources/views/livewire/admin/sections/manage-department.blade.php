<div class="container mx-auto max-w-8xl px-2 sm:px-4 lg:px-6">
    <!-- Enhanced Header Section -->
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 lg:p-8 mb-4 sm:mb-6 lg:mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div class="flex-1">
                <div class="flex items-center mb-2">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-building text-blue-600 text-xl"></i>
                    </div>
                    <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">Department Management</h1>
                </div>
                <p class="text-gray-600 text-sm sm:text-base mb-2">Organize and manage hospital departments</p>
                <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-gray-500">
                    <span class="flex items-center">
                        <i class="fas fa-layer-group mr-1 text-blue-500"></i>
                        {{ $departments->count() ?? 0 }} Departments
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-clock mr-1 text-green-500"></i>
                        Updated {{ now()->diffForHumans() }}
                    </span>
                </div>
            </div>
            
            <!-- Add Department Button -->
            <button wire:click="$set('showModal', true)" 
                    class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 sm:py-2.5 rounded-lg font-medium shadow-lg transition-all duration-300 flex items-center justify-center space-x-2 hover:shadow-xl transform hover:-translate-y-0.5 text-sm sm:text-base">
                <i class="fas fa-plus text-sm"></i>
                <span class="hidden sm:inline">Add Department</span>
                <span class="sm:hidden">Add</span>
            </button>
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

    <!-- Enhanced Departments Table -->
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
        <!-- Desktop Table -->
        <div class="overflow-x-auto hidden md:block">
            <table class="w-full table-auto">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Department
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
                    @forelse($departments as $department)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center ring-2 ring-blue-100">
                                        <i class="fas fa-building text-white text-sm"></i>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $department->name }}</div>
                                    <div class="text-xs text-gray-500">Last updated: {{ $department->updated_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <!-- Toggle Switch for Status -->
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" 
                                       wire:click="toggleStatus({{ $department->id }})"
                                       {{ $department->status ? 'checked' : '' }}
                                       class="sr-only peer">
                                <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-green-500"></div>
                            </label>
                            <span class="ml-2 text-xs font-medium text-gray-700">
                                {{ $department->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <button wire:click="edit({{ $department->id }})" 
                                        class="text-green-600 hover:text-green-900 transition-colors duration-200 p-1.5 hover:bg-green-50 rounded-lg">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                <button wire:click="delete({{ $department->id }})" 
                                        class="text-red-600 hover:text-red-900 transition-colors duration-200 p-1.5 hover:bg-red-50 rounded-lg">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-building text-gray-300 text-6xl mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No departments found</h3>
                                <p class="text-gray-500 mb-6">Get started by creating your first department.</p>
                                <button wire:click="$set('showModal', true)" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-plus mr-2"></i>Add First Department
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="md:hidden space-y-3 p-3 sm:p-4">
            @forelse($departments as $department)
            <div class="bg-white rounded-lg p-4 shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-start space-x-3">
                    <!-- Department Icon -->
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center ring-2 ring-blue-100">
                            <i class="fas fa-building text-white text-lg"></i>
                        </div>
                    </div>
                    
                    <!-- Department Info -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-gray-900 truncate">{{ $department->name }}</h3>
                                <p class="text-xs text-gray-500 mt-1">Updated {{ $department->updated_at->diffForHumans() }}</p>
                            </div>
                            <!-- Status Toggle -->
                            <label class="relative inline-flex items-center cursor-pointer ml-2">
                                <input type="checkbox" 
                                       wire:click="toggleStatus({{ $department->id }})"
                                       {{ $department->status ? 'checked' : '' }}
                                       class="sr-only peer">
                                <div class="relative w-8 h-4 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[1px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-green-500"></div>
                            </label>
                        </div>
                        
                        <!-- Status Badge -->
                        <div class="mt-2">
                            @if($department->status)
                                <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> Active
                                </span>
                            @else
                                <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i> Inactive
                                </span>
                            @endif
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="mt-3 flex space-x-2">
                            <button wire:click="edit({{ $department->id }})" 
                                    class="flex-1 bg-green-50 text-green-600 px-2 py-1.5 rounded text-xs font-medium hover:bg-green-100 transition-colors duration-200">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>
                            <button wire:click="delete({{ $department->id }})" 
                                    class="flex-1 bg-red-50 text-red-600 px-2 py-1.5 rounded text-xs font-medium hover:bg-red-100 transition-colors duration-200">
                                <i class="fas fa-trash mr-1"></i>Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-8 bg-white rounded-lg shadow-md">
                <i class="fas fa-building text-gray-300 text-4xl mb-3"></i>
                <h3 class="text-base font-medium text-gray-900 mb-2">No departments found</h3>
                <p class="text-gray-500 mb-4 text-sm">Get started by creating your first department.</p>
                <button wire:click="$set('showModal', true)" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-sm">
                    <i class="fas fa-plus mr-2"></i>Add First Department
                </button>
            </div>
            @endforelse
        </div>

        <!-- Enhanced Pagination -->
        @if($departments->hasPages())
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-3 sm:px-6 py-4 flex flex-col sm:flex-row items-center justify-between border-t border-gray-200">
            <div class="text-xs sm:text-sm text-gray-600 mb-3 sm:mb-0">
                Showing {{ $departments->firstItem() }} to {{ $departments->lastItem() }} of {{ $departments->total() }} results
            </div>
            <nav class="flex space-x-1" aria-label="Pagination">
                {{ $departments->links() }}
            </nav>
        </div>
        @endif
    </div>

    <!-- Enhanced Add/Edit Department Modal -->
    @if ($showModal)
    <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-building text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ $departmentId ? 'Edit Department' : 'Add New Department' }}
                        </h3>
                    </div>
                    <button wire:click="$set('showModal', false)" 
                            class="text-gray-400 hover:text-gray-500 p-1 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                
                <form wire:submit.prevent="save" class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Department Name</label>
                        <input type="text" wire:model="name" id="name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            placeholder="e.g. Cardiology, Emergency">
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="flex space-x-3 pt-4">
                        <button type="button" wire:click="$set('showModal', false)"
                                class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-1 px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <span wire:loading.remove wire:target="save">{{ $departmentId ? 'Update' : 'Create' }}</span>
                            <span wire:loading wire:target="save">Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

<style>
    /* Touch-friendly sizing for mobile */
    @media (max-width: 640px) {
        button, a, input, select, textarea {
            min-height: 44px;
        }
    }

    /* Custom toggle switch styles */
    .peer:checked + div {
        background-color: #10b981;
    }
    
    .peer:focus + div {
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
    }
</style>
</div>
