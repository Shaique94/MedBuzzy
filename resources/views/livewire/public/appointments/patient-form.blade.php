<!-- livewire/appointment/patient-form.blade.php -->
<div>
    <h3 class="text-xl font-bold mb-4">Patient Information</h3>
    <div class="space-y-4">
        <div class="flex space-x-4">
            <label class="flex items-center">
                <input type="radio" wire:model="patient_type" value="myself" class="mr-2">
                For Myself
            </label>
            <label class="flex items-center">
                <input type="radio" wire:model="patient_type" value="someone" class="mr-2">
                For Someone Else
            </label>
        </div>
        <input wire:model="patient_name" placeholder="Name" class="w-full p-3 border rounded-lg" required>
        <input wire:model="patient_email" placeholder="Email (optional)" class="w-full p-3 border rounded-lg">
        <input wire:model="patient_phone" placeholder="Phone" class="w-full p-3 border rounded-lg" {{ $patient_type === 'someone' ? 'readonly' : '' }} required>
        <select wire:model="patient_gender" class="w-full p-3 border rounded-lg" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
    </div>
</div>