<div class="p-8 max-w-6xl mx-auto bg-white rounded-xl shadow-lg">
    <!-- Header and Add Button -->
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Managers Management</h2>
        <button 
            wire:click="$dispatch('open-manager-modal')" 
            class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg transition-colors duration-200"
        >
            Add Manager
        </button>
    </div>

    <!-- Form Modal -->
    <div wire:ignore.self>
        @livewire('doctor.section.manager.form-modal', key('form-modal'))
    </div>
  @livewire('doctor.section.manager.edit-modal') 

    <!-- Success Message -->
@if (session()->has('success'))
    <div class="bg-teal-100 border-l-4 border-teal-600 text-teal-800 p-4 mb-6 rounded-lg">
        <div class="flex items-center">
            <svg class="h-6 w-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
            </svg>
            {{ session('success') }}
        </div>
    </div>
@endif


<!-- Error Message -->
@if (session()->has('error'))
    <div class="bg-red-100 border-l-4 border-red-600 text-red-800 p-4 mb-6 rounded-lg">
        <div class="flex items-center">
            <svg class="h-6 w-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9v2h2v-2h-2zm0-4h2v2h-2V5z"/>
            </svg>
            {{ session('error') }}
        </div>
    </div>
@endif

    <!-- Manager List Table -->
    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Phone</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($managers as $mgr)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <img class="h-12 w-12 rounded-full object-cover" src="{{ $mgr->user->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($mgr->user->name).'&color=0D9488&background=CCFBF1' }}" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $mgr->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ ucfirst($mgr->gender) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $mgr->user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $mgr->user->phone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $mgr->status === 'active' ? 'bg-teal-100 text-teal-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($mgr->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
<button
  wire:click="$dispatch('openEditModal', { managerId: {{ $mgr->id }} })"
  class="text-teal-600 hover:text-teal-800"
>
  Edit
</button>
                            <button wire:click="confirmDelete({{ $mgr->id }})" class="text-red-600 hover:text-red-800 transition-colors duration-150">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-sm text-gray-500 py-4">No managers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($managers->hasPages())
        <div class="mt-6">
            {{ $managers->links() }}
        </div>
    @endif
</div>