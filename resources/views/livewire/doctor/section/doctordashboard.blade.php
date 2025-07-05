<div class="flex h-screen bg-gray-50">

    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto p-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                    Welcome back Dr. <span class="text-blue-600 ml-1">{{ $doctor_name }}</span>
                    <span class="ml-2"></span>
                </h1>
            </div>


            <div class="relative w-full md:w-auto">
                <input type="text" placeholder="Search patients..."
                    class="w-full md:w-64 pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-2.5"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <!-- Appointments Card -->
            <div
                class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200 group">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-50 text-blue-600 mr-4 group-hover:bg-blue-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Total Appointments</h3>
                        <p class="text-2xl font-bold text-gray-800">{{$appointments_count}}</p>

                    </div>
                </div>
            </div>

            <!-- Patients Card -->
            <div
                class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200 group">
                <div class="flex items-center">
                    <div
                        class="p-3 rounded-lg bg-green-50 text-green-600 mr-4 group-hover:bg-green-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Total Patients</h3>
                        <p class="text-2xl font-bold text-gray-800">{{$patient_count}}</p>
                    </div>
                </div>
            </div>

            <!-- Upcoming Card -->
            <div
                class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200 group">
                <div class="flex items-center">
                    <div
                        class="p-3 rounded-lg bg-purple-50 text-purple-600 mr-4 group-hover:bg-purple-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Upcoming</h3>
                        <p class="text-2xl font-bold text-gray-800">{{$appointments_upcoming}}</p>

                    </div>
                </div>
            </div>

            <!-- Completed Card -->
            <div
                class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200 group">
                <div class="flex items-center">
                    <div
                        class="p-3 rounded-lg bg-amber-50 text-amber-600 mr-4 group-hover:bg-amber-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Completed</h3>
                        <p class="text-2xl font-bold text-gray-800">{{$appointments_completed}}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Appointments -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Upcoming Appointments</h2>
                <a href="#" class="text-blue-600 text-sm font-medium">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-500 text-sm border-b border-gray-200">
                            <th class="pb-3">Patient</th>
                            <th class="pb-3">Time</th>
                            <th class="pb-3">Purpose</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gray-200 mr-3 overflow-hidden">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Patient"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">John Smith</p>
                                        <p class="text-sm text-gray-500">#PT-1001</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                <p class="font-medium">10:30 AM</p>
                                <p class="text-sm text-gray-500">Today</p>
                            </td>
                            <td class="py-4">Cardiac Checkup</td>
                            <td class="py-4">
                                <span
                                    class="px-3 py-1 text-sm bg-green-100 text-green-800 rounded-full">Confirmed</span>
                            </td>
                            <td class="py-4">
                                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gray-200 mr-3 overflow-hidden">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Patient"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Sarah Johnson</p>
                                        <p class="text-sm text-gray-500">#PT-1002</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                <p class="font-medium">11:45 AM</p>
                                <p class="text-sm text-gray-500">Today</p>
                            </td>
                            <td class="py-4">Follow-up Visit</td>
                            <td class="py-4">
                                <span
                                    class="px-3 py-1 text-sm bg-green-100 text-green-800 rounded-full">Confirmed</span>
                            </td>
                            <td class="py-4">
                                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gray-200 mr-3 overflow-hidden">
                                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Patient"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Michael Brown</p>
                                        <p class="text-sm text-gray-500">#PT-1003</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                <p class="font-medium">2:15 PM</p>
                                <p class="text-sm text-gray-500">Today</p>
                            </td>
                            <td class="py-4">New Patient</td>
                            <td class="py-4">
                                <span
                                    class="px-3 py-1 text-sm bg-yellow-100 text-yellow-800 rounded-full">Pending</span>
                            </td>
                            <td class="py-4">
                                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>
