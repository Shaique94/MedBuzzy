<div class="container mx-auto h-screen overflow-hidden px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8 h-full">

        <!-- Filter Sidebar -->
        <aside class="md:w-1/4 bg-white p-4 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Filters</h2>
            <form>
                <!-- Specialization Filter -->
                <div class="mb-4">
                    <label for="specialization" class="block text-gray-700 font-semibold mb-2">Specialization</label>
                    <select id="specialization" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Specializations</option>
                        <option value="cardiologist">Cardiologist</option>
                        <option value="dermatologist">Dermatologist</option>
                        <option value="pediatrician">Pediatrician</option>
                        <option value="orthopedic">Orthopedic</option>
                    </select>
                </div>

                <!-- Location Filter -->
                <div class="mb-4">
                    <label for="location" class="block text-gray-700 font-semibold mb-2">Location</label>
                    <input type="text" id="location" placeholder="Enter location" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Availability Filter -->
                <div class="mb-4">
                    <label for="availability" class="block text-gray-700 font-semibold mb-2">Availability</label>
                    <select id="availability" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Any</option>
                        <option value="morning">Morning</option>
                        <option value="afternoon">Afternoon</option>
                        <option value="evening">Evening</option>
                    </select>
                </div>

                <!-- Apply Filters Button -->
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                    Apply Filters
                </button>
            </form>
        </aside>
        <!-- filters here -->

        <!-- Doctor List Section -->
        <main class="md:w-3/4 overflow-y-auto pr-2">
            <h2 class="text-2xl font-bold mb-6">Our Doctors</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Doctor Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img src="/images/doctor-placeholder.jpg" alt="Doctor" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Dr. John Doe</h3>
                    <p class="text-gray-600">Cardiologist</p>
                    <p class="text-gray-600 text-sm">MBBS, MD - Cardiology</p>
                    <p class="text-gray-600 text-sm">10+ years of experience</p>
                    <button class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        Book Appointment
                    </button>
                </div>

                <!-- Doctor Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img src="/images/doctor-placeholder.jpg" alt="Doctor" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Dr. John Doe</h3>
                    <p class="text-gray-600">Cardiologist</p>
                    <p class="text-gray-600 text-sm">MBBS, MD - Cardiology</p>
                    <p class="text-gray-600 text-sm">10+ years of experience</p>
                    <button class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        Book Appointment
                    </button>
                </div>

                <!-- Doctor Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img src="/images/doctor-placeholder.jpg" alt="Doctor" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Dr. John Doe</h3>
                    <p class="text-gray-600">Cardiologist</p>
                    <p class="text-gray-600 text-sm">MBBS, MD - Cardiology</p>
                    <p class="text-gray-600 text-sm">10+ years of experience</p>
                    <button class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        Book Appointment
                    </button>
                </div>

                <!-- Doctor Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img src="/images/doctor-placeholder.jpg" alt="Doctor" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Dr. John Doe</h3>
                    <p class="text-gray-600">Cardiologist</p>
                    <p class="text-gray-600 text-sm">MBBS, MD - Cardiology</p>
                    <p class="text-gray-600 text-sm">10+ years of experience</p>
                    <button class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        Book Appointment
                    </button>
                </div>


                <!-- Doctor Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img src="/images/doctor-placeholder.jpg" alt="Doctor" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Dr. John Doe</h3>
                    <p class="text-gray-600">Cardiologist</p>
                    <p class="text-gray-600 text-sm">MBBS, MD - Cardiology</p>
                    <p class="text-gray-600 text-sm">10+ years of experience</p>
                    <button class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        Book Appointment
                    </button>
                </div>


                <!-- Doctor Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img src="/images/doctor-placeholder.jpg" alt="Doctor" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Dr. John Doe</h3>
                    <p class="text-gray-600">Cardiologist</p>
                    <p class="text-gray-600 text-sm">MBBS, MD - Cardiology</p>
                    <p class="text-gray-600 text-sm">10+ years of experience</p>
                    <button class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        Book Appointment
                    </button>
                </div>

                <!-- Doctor Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img src="/images/doctor-placeholder.jpg" alt="Doctor" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Dr. John Doe</h3>
                    <p class="text-gray-600">Cardiologist</p>
                    <p class="text-gray-600 text-sm">MBBS, MD - Cardiology</p>
                    <p class="text-gray-600 text-sm">10+ years of experience</p>
                    <button class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        Book Appointment
                    </button>
                </div>
            </div>
        </main>
    </div>
</div>