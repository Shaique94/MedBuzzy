<div>
    <form wire:submit.prevent="save">
        <select wire:model="doctor_id">
            <option value="">Select Doctor</option>
            @foreach ($doctors as $doctor)
                <option value="{{ $doctor->id }}">Dr. {{ $doctor->user->name }}</option>
            @endforeach
        </select>
        @error('doctor_id') <span>{{ $message }}</span> @enderror

        <select wire:model="patient_id">
            <option value="">Select Patient</option>
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
            @endforeach
        </select>
        @error('patient_id') <span>{{ $message }}</span> @enderror

        <input type="date" wire:model="appointment_date">
        @error('appointment_date') <span>{{ $message }}</span> @enderror

        <select wire:model="appointment_time">
            <option value="">Select Time Slot</option>
            @foreach ($available_slots as $slot)
                <option value="{{ $slot['time_value'] }}" {{ $slot['disabled'] ? 'disabled' : '' }}>
                    {{ $slot['start'] }} - {{ $slot['end'] }} ({{ $slot['remaining_capacity'] }} left)
                </option>
            @endforeach
        </select>
        @error('appointment_time') <span>{{ $message }}</span> @enderror

        <textarea wire:model="notes" placeholder="Notes"></textarea>
        <button type="submit">Book Appointment</button>
    </form>

    @if (session()->has('message'))
        <p>{{ session('message') }}</p>
    @endif
</div>



