<div x-data="appointmentReport()" class="container mx-auto p-2 max-w-8xl">
    <!-- Header and Filters in One Line -->
    <div
        class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white p-4 rounded-lg shadow border border-gray-100 mb-4">
        <h2 class="text-xl font-bold text-gray-900">Appointment Reports</h2>
        <div class="flex items-center gap-2 flex-wrap">
            <button wire:click="set('filterType', 'all')"
                :class="$wire.filterType === 'all' ? 'bg-indigo-600 text-white' :
                    'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                class="px-3 py-1.5 rounded-md text-sm font-medium transition-colors">All</button>
            <button wire:click="set('filterType', 'today')"
                :class="$wire.filterType === 'today' ? 'bg-indigo-600 text-white' :
                    'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                class="px-3 py-1.5 rounded-md text-sm font-medium transition-colors">Today</button>
            <button wire:click="set('filterType', 'tomorrow')"
                :class="$wire.filterType === 'tomorrow' ? 'bg-indigo-600 text-white' :
                    'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                class="px-3 py-1.5 rounded-md text-sm font-medium transition-colors">Tomorrow</button>
            <button wire:click="set('filterType', 'date_range')"
                :class="$wire.filterType === 'date_range' ? 'bg-indigo-600 text-white' :
                    'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                class="px-3 py-1.5 rounded-md text-sm font-medium transition-colors">Date Range</button>

            @if ($filterType === 'date_range')
                <div class="flex items-center gap-2">
                    <input type="date" wire:model="fromDate" wire:change="filterAppointments"
                        class="border-gray-200 rounded-md p-1.5 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <input type="date" wire:model="toDate" wire:change="filterAppointments"
                        class="border-gray-200 rounded-md p-1.5 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            @endif

            <button @click="printReport()"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-md text-sm font-medium flex items-center transition-colors">
                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m4 4h6a2 2 0 002-2v-4a2 2 0 00-2-2h-6a2 2 0 00-2 2v4a2 2 0 002 2z" />
                </svg>
                Print
            </button>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 bg-indigo-50 border-b">
            <h3 class="text-lg font-semibold text-gray-800" x-text="getHeaderText()"></h3>
            <p class="text-sm text-gray-600">{{ $appointments->count() }} appointments found</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">S.No</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Patient Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Doctor</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($appointments as $index => $appointment)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-2 text-sm text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-sm font-medium text-gray-900">{{ $appointment->patient->name }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-500">Dr. {{ $appointment->doctor->user->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">
                                @if ($appointment->appointment_time)
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full 
                                @if ($appointment->status === 'scheduled') bg-green-100 text-green-800
                                @elseif($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($appointment->status === 'completed') bg-blue-100 text-blue-800
                                @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    @if ($appointments->count() === 0)
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-sm text-gray-500">No appointments found
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Print Section (Hidden until printing) -->
    <div id="printSection" class="hidden">
        <div class="p-8 max-w-6xl mx-auto">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Appointment Report</h1>
                <p class="text-base text-gray-700" x-text="getHeaderText()"></p>
                <p class="text-sm text-gray-600">Generated on: <span x-text="new Date().toLocaleString()"></span></p>
            </div>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-semibold text-gray-700 uppercase">
                            S.No</th>
                        <th
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-semibold text-gray-700 uppercase">
                            Patient Name</th>
                        <th
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-semibold text-gray-700 uppercase">
                            Doctor</th>
                        <th
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-semibold text-gray-700 uppercase">
                            Date</th>
                        <th
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-semibold text-gray-700 uppercase">
                            Time</th>
                        <th
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-semibold text-gray-700 uppercase">
                            Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $index => $appointment)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-sm text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $appointment->patient->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">Dr.
                                {{ $appointment->doctor->user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm text-center">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm text-center">
                                @if ($appointment->appointment_time)
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-sm text-center">
                                {{ ucfirst($appointment->status) }}</td>
                        </tr>
                    @endforeach
                    @if ($appointments->count() === 0)
                        <tr>
                            <td colspan="6"
                                class="border border-gray-300 px-4 py-4 text-center text-sm text-gray-600">No
                                appointments found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-6 text-sm text-gray-600 flex justify-between">
                <p>Total Appointments: {{ $appointments->count() }}</p>
                <p>Generated by: {{ auth()->user()->name }}</p>
            </div>
        </div>
    </div>

    <script>
        function appointmentReport() {
            return {
                getHeaderText() {
                    const filterType = @this.filterType;
                    const fromDate = @this.fromDate;
                    const toDate = @this.toDate;

                    if (filterType === 'all') return 'All Appointments';
                    if (filterType === 'today')
                    return `Today's Appointments (${new Date().toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })})`;
                    if (filterType === 'tomorrow') {
                        const tomorrow = new Date();
                        tomorrow.setDate(tomorrow.getDate() + 1);
                        return `Tomorrow's Appointments (${tomorrow.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })})`;
                    }
                    if (filterType === 'date_range') {
                        const from = new Date(fromDate);
                        const to = new Date(toDate);
                        return `Appointments from ${from.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })} to ${to.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}`;
                    }
                    return '';
                },

                printReport() {
                    const printSection = document.getElementById('printSection').cloneNode(true);
                    printSection.classList.remove('hidden');

                    const printWindow = window.open('', '_blank');
                    printWindow.document.write(`
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title>Appointment Report</title>
                            <style>
                                body { font-family: Arial, sans-serif; margin: 15mm; color: #000; font-size: 14px; }
                                table { width: 100%; border-collapse: collapse; margin-top: 15px; }
                                th, td { border: 1px solid #000; padding: 6px 8px; }
                                th { background-color: #f0f0f0; font-weight: bold; }
                                .text-center { text-align: center; }
                            </style>
                        </head>
                        <body>
                            ${printSection.innerHTML}
                        </body>
                        </html>
                    `);
                    printWindow.document.close();
                    setTimeout(() => {
                        printWindow.print();
                        printWindow.close();
                    }, 250);
                }
            }
        }
    </script>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }
        }

        @media (max-width: 640px) {
            .container {
               
            }
        }
    </style>
</div>
