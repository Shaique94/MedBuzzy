<div class="min-h-screen flex flex-col bg-gray-100">
    <!-- Header -->
   

    <!-- Main Content -->
    <div class="flex flex-grow">
      
        <!-- Dashboard Content -->
        <main class="flex-grow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Welcome, Admin!</h2>

            <!-- Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-800">Total Users</h3>
                    <p class="text-2xl font-bold text-blue-600">1,234</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-800">Total Doctors</h3>
                    <p class="text-2xl font-bold text-blue-600">567</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-800">Appointments Today</h3>
                    <p class="text-2xl font-bold text-blue-600">89</p>
                </div>
            </div>

            <!-- Recent Appointments -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Recent Appointments</h3>
                <table class="w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-200 px-4 py-2 text-left">Patient</th>
                            <th class="border border-gray-200 px-4 py-2 text-left">Doctor</th>
                            <th class="border border-gray-200 px-4 py-2 text-left">Date</th>
                            <th class="border border-gray-200 px-4 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-200 px-4 py-2">John Doe</td>
                            <td class="border border-gray-200 px-4 py-2">Dr. Smith</td>
                            <td class="border border-gray-200 px-4 py-2">2025-06-28</td>
                            <td class="border border-gray-200 px-4 py-2 text-green-600">Confirmed</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-4 py-2">Jane Doe</td>
                            <td class="border border-gray-200 px-4 py-2">Dr. Brown</td>
                            <td class="border border-gray-200 px-4 py-2">2025-06-28</td>
                            <td class="border border-gray-200 px-4 py-2 text-yellow-600">Pending</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>