<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manage Doctors</h1>

    <!-- Add Doctor Button -->
    <div class="mb-6">
        <a href="/admin/doctors/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Add New Doctor
        </a>
    </div>

    <!-- Doctors Table -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 px-4 py-2 text-left">Name</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Specialization</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Email</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Phone</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Doctor Row -->
                <tr>
                    <td class="border border-gray-200 px-4 py-2">Dr. John Doe</td>
                    <td class="border border-gray-200 px-4 py-2">Cardiologist</td>
                    <td class="border border-gray-200 px-4 py-2">johndoe@example.com</td>
                    <td class="border border-gray-200 px-4 py-2">+1 234 567 890</td>
                    <td class="border border-gray-200 px-4 py-2">
                        <a href="/admin/doctors/edit/1" class="text-blue-600 hover:underline">Edit</a>
                        <a href="/admin/doctors/delete/1" class="text-red-600 hover:underline ml-4">Delete</a>
                    </td>
                </tr>
                <!-- Repeat for more doctors -->
                <tr>
                    <td class="border border-gray-200 px-4 py-2">Dr. Jane Smith</td>
                    <td class="border border-gray-200 px-4 py-2">Dermatologist</td>
                    <td class="border border-gray-200 px-4 py-2">janesmith@example.com</td>
                    <td class="border border-gray-200 px-4 py-2">+1 987 654 321</td>
                    <td class="border border-gray-200 px-4 py-2">
                        <a href="/admin/doctors/edit/2" class="text-blue-600 hover:underline">Edit</a>
                        <a href="/admin/doctors/delete/2" class="text-red-600 hover:underline ml-4">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
