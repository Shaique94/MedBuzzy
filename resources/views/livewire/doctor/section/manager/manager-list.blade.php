<div class="p-4 md:p-6 w-full max-w-[95vw] md:max-w-6xl mx-auto bg-white rounded-xl shadow-lg">
    <!-- Header and Add Button -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Managers Management</h2>
        <button 
            wire:click="$dispatch('open-manager-modal')" 
            class="w-full sm:w-auto bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2 text-sm sm:text-base"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            <span>Add Manager</span>
        </button>
    </div>

    <!-- Form Modal -->
    <div wire:ignore.self>
        @livewire('doctor.section.manager.form-modal', key('form-modal'))
    </div>
    @livewire('doctor.section.manager.edit-modal') 

    <!-- Success/Error Messages -->
    @if (session()->has('success'))
        <div class="bg-teal-100 border-l-4 border-teal-600 text-teal-800 p-3 mb-4 rounded-lg text-sm">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-600 text-red-800 p-3 mb-4 rounded-lg text-sm">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9v2h2v-2h-2zm0-4h2v2h-2V5z"/>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Manager List Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-3 py-2 text-left font-medium text-gray-600">Name</th>
                    <th class="px-3 py-2 text-left font-medium text-gray-600 hidden sm:table-cell">Email</th>
                    <th class="px-3 py-2 text-left font-medium text-gray-600 hidden md:table-cell">Phone</th>
                    <th class="px-3 py-2 text-left font-medium text-gray-600">Status</th>
                    <th class="px-3 py-2 text-left font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($managers as $mgr)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-3 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10">
                                    <img class="h-8 w-8 sm:h-10 sm:w-10 rounded-full object-cover" 
                                         src="{{ $mgr->user->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($mgr->user->name).'&color=0D9488&background=CCFBF1' }}" 
                                         alt="">
                                </div>
                                <div class="ml-2 sm:ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $mgr->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ ucfirst($mgr->gender) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap text-gray-600 hidden sm:table-cell">{{ $mgr->user->email }}</td>
                        <td class="px-3 py-3 whitespace-nowrap text-gray-600 hidden md:table-cell">{{ $mgr->user->phone }}</td>
                        <td class="px-3 py-3 whitespace-nowrap">
                            <span class="px-2 py-0.5 inline-flex text-xs font-medium rounded-full {{ $mgr->status === 'active' ? 'bg-teal-100 text-teal-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($mgr->status) }}
                            </span>
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap space-x-1 sm:space-x-2">
                            <button wire:click="$dispatch('openEditModal', { managerId: {{ $mgr->id }} })"
                                class="text-teal-600 hover:text-teal-800 text-sm">
                                Edit
                            </button>
                            <button wire:click="confirmDelete({{ $mgr->id }})" 
                                class="text-red-600 hover:text-red-800 text-sm">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-3 py-4 text-center text-sm text-gray-500">No managers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($managers->hasPages())
        <div class="mt-4 px-2">
            {{ $managers->onEachSide(1)->links() }}
        </div>
    @endif
</div>