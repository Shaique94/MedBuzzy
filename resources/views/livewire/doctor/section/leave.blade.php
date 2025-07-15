<div class="bg-white p-6 rounded-lg shadow-lg max-w-3xl mx-auto space-y-6">
    <h2 class="text-2xl font-bold text-gray-800 border-b pb-2">Set Your Leave</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">From Date</label>
                <input type="date" wire:model="from_date" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                @error('from_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">To Date</label>
                <input type="date" wire:model="to_date" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                @error('to_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition shadow">
                Submit Leave
            </button>
        </div>
    </form>

    @if ($doctor->unavailable_from && $doctor->unavailable_to)
        <div class="bg-gray-50 p-4 rounded-lg shadow mt-6">
            <h3 class="font-semibold text-gray-700 mb-2">Current Leave Period</h3>
            <p class="text-gray-600">From: <strong>{{ \Carbon\Carbon::parse($doctor->unavailable_from)->format('d/m/Y') }}</strong></p>
            <p class="text-gray-600">To: <strong>{{ \Carbon\Carbon::parse($doctor->unavailable_to)->format('d/m/Y') }}</strong></p>
        </div>
    @endif
</div>
