<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manage Doctors</h1>

    <!-- Add Doctor Button -->
    <div class="mb-6">
        <a wire:click="$set('showModal', true)" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Add New Doctor
        </a>
    </div>

    <!-- Doctors Table -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 px-4 py-2 text-left">Name</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Department</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Email</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Phone</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($doctors as $doctor)
                <tr>
                    <td class="border border-gray-200 px-4 py-2">{{$doctor->user->name}}</td>
                    <td class="border border-gray-200 px-4 py-2">{{$doctor->department->name}}</td>
                    <td class="border border-gray-200 px-4 py-2">{{$doctor->user->email}}</td>
                    <td class="border border-gray-200 px-4 py-2">{{$doctor->user->phone}}</td>
                    <td class="border border-gray-200 px-4 py-2">
                        <a href="/admin/doctors/edit/1" class="text-blue-600 hover:underline">Edit</a>
                        <a href="/admin/doctors/delete/1" class="text-red-600 hover:underline ml-4">Delete</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="border border-gray-200 px-4 py-2 text-center text-gray-500">
                        No doctors found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Add Department Modal -->
    @if ($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white w-full max-w-md mx-auto rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Add Doctor</h2>

            <form wire:submit.prevent="save">
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Name</label>
                    <input type="text" wire:model="name"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" />
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Email</label>
                    <input type="text" wire:model="email"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" />
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Phone</label>
                    <input type="text" wire:model="phone"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" />
                    @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>


                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Department</label>
                    <select wire:model="department_id"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Fees</label>
                    <input type="text" wire:model="fees"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" />
                    @error('fees') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Password</label>
                    <input type="password" wire:model="password"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" />
                    @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Confirm Password</label>
                    <input type="password" wire:model="password_confirmation"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" />
                    @error('password_confirmation') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" wire:click="$set('showModal', false)"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>