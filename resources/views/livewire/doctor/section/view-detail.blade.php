@if ($showPatientModal)
    <div wire:key="patient-modal"  class="fixed inset-0 z-50 flex items-center justify-center md:p-4 p-6  bg-black bg-opacity-50">
     <div class="bg-white w-full max-w-lg mx-auto rounded-2xl shadow-lg relative max-h-[90vh] overflow-y-auto p-8">  
            <!-- Close Button -->
            {{-- <button wire:click="$set('showPatientModal', false)"
              class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl md:text-xl transition-colors">
                &times;
            </button> --}}

            <!-- Header -->
            <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Patient Information</h2>

            @if($selectedPatient)
            <!-- Patient Info -->
         <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 text-vsm md:text-base">
                <div><p class="font-semibold">Name:</p><p>{{ $selectedPatient->name }}</p></div>
                <div><p class="font-semibold">Phone:</p><p>{{ $selectedPatient->phone }}</p></div>
                <div><p class="font-semibold">Email:</p><p>{{ $selectedPatient->email ?? 'N/A' }}</p></div>
                <div><p class="font-semibold">Gender:</p><p>{{ ucfirst($selectedPatient->gender) }}</p></div>
                <div><p class="font-semibold">Age:</p><p>{{ $selectedPatient->age }}</p></div>
                <div><p class="font-semibold">Pincode:</p><p>{{ $selectedPatient->pincode ?? 'N/A' }}</p></div>
             <div class="md:col-span-2 space-y-1">
                    <p class="font-semibold">Address:</p>
                    <p>{{ $selectedPatient->address }}</p>
                    <p>{{ $selectedPatient->district }}, {{ $selectedPatient->state }}, {{ $selectedPatient->country }}</p>
                </div>
            </div>
            @else
                <p class="text-red-500">No patient selected.</p>
            @endif

            <!-- Footer -->
          <div class="mt-6 flex justify-end space-x-3">
                <button wire:click="$set('showPatientModal', false)"
                  class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm md:text-base">
                    Close
                </cbutton>
            </div>
        </div>
    </div>
@endif
