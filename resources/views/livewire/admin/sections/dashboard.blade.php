 <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                <div class="container mx-auto px-4 py-6">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-3 rounded-lg">
                                    <i class="bi bi-calendar-check-fill fs-3 text-blue-600 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-2xl font-bold text-gray-800">24</h3>
                                    <p class="text-gray-600"> Appointments</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-3 rounded-lg">
                                    <i class="bi bi-people-fill fs-3 text-green-600 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-2xl font-bold text-gray-800">142</h3>
                                    <p class="text-gray-600">Patients</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-amber-500">
                            <div class="flex items-center">
                                <div class="bg-amber-100 p-3 rounded-lg">
                                    <i class="bi bi-heart-pulse-fill fs-3 text-amber-600 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-2xl font-bold text-gray-800">32</h3>
                                    <p class="text-gray-600">Doctors</p>
                                </div>
                                
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-amber-500">
                            <div class="flex items-center">
                                <div class="bg-amber-100 p-3 rounded-lg">
                                    <i class="bi bi-currency-rupee fs-3 text-amber-600 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-2xl font-bold text-gray-800">32</h3>
                                    <p class="text-gray-600">Revenue</p>
                                </div>
                                
                            </div>
                        </div>
                       
                    </div>                    

                    <!-- Upcoming Appointments -->
                    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-bold text-gray-800">Upcoming Appointments</h2>
                            <a href="#" class="text-blue-600 text-sm font-medium hover:underline">View All</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="text-left text-gray-500 border-b">
                                    <tr>
                                        <th class="pb-3 font-medium">Patient</th>
                                        <th class="pb-3 font-medium">Time</th>
                                        <th class="pb-3 font-medium">Type</th>
                                        <th class="pb-3 font-medium">Status</th>
                                        <th class="pb-3 font-medium">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    <tr>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&h=200&q=80" 
                                                     class="w-10 h-10 rounded-full object-cover mr-3">
                                                <div>
                                                    <p class="font-medium text-gray-800">Robert Fox</p>
                                                    <p class="text-sm text-gray-600">ID: #PT-0012</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            <p class="font-medium">9:30 AM</p>
                                            <p class="text-sm text-gray-600">Today</p>
                                        </td>
                                        <td class="py-4">
                                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Consultation</span>
                                        </td>
                                        <td class="py-4">
                                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Confirmed</span>
                                        </td>
                                        <td class="py-4">
                                            <button class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&h=200&q=80" 
                                                     class="w-10 h-10 rounded-full object-cover mr-3">
                                                <div>
                                                    <p class="font-medium text-gray-800">Jenny Wilson</p>
                                                    <p class="text-sm text-gray-600">ID: #PT-0034</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            <p class="font-medium">10:45 AM</p>
                                            <p class="text-sm text-gray-600">Today</p>
                                        </td>
                                        <td class="py-4">
                                            <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">Follow Up</span>
                                        </td>
                                        <td class="py-4">
                                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Confirmed</span>
                                        </td>
                                        <td class="py-4">
                                            <button class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&h=200&q=80" 
                                                     class="w-10 h-10 rounded-full object-cover mr-3">
                                                <div>
                                                    <p class="font-medium text-gray-800">Jacob Jones</p>
                                                    <p class="text-sm text-gray-600">ID: #PT-0078</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            <p class="font-medium">1:15 PM</p>
                                            <p class="text-sm text-gray-600">Today</p>
                                        </td>
                                        <td class="py-4">
                                            <span class="bg-amber-100 text-amber-800 text-xs px-2 py-1 rounded-full">Checkup</span>
                                        </td>
                                        <td class="py-4">
                                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Pending</span>
                                        </td>
                                        <td class="py-4">
                                            <button class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>