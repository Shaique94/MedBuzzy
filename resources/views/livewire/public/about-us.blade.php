<section class="py-20 bg-white">
    <div class="container mx-auto px-4 lg:px-16">
        <div class="text-center mb-14">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-4">About Us</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-2">Welcome to MedBuzzy, your trusted partner in healthcare innovation and excellence.</p>
            <p class="text-gray-500">Learn more about who we are and what we do.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Left: Mission & Values -->
            <div>
                <div class="bg-gray-50 rounded-2xl border border-teal-100 p-8 mb-6">
                    <h3 class="text-2xl font-bold text-teal-800 mb-4">Our Mission</h3>
                    <p class="text-gray-700 mb-4">
                        At MedBuzzy, our mission is to provide exceptional healthcare solutions that empower individuals and communities.
                        We strive to innovate and deliver services that make a difference in people's lives.
                    </p>
                    <h4 class="text-lg font-semibold text-teal-700 mb-2">Our Core Values</h4>
                    <ul class="list-disc list-inside text-teal-700 space-y-1">
                        <li>Compassionate Care</li>
                        <li>Innovation &amp; Excellence</li>
                        <li>Integrity &amp; Trust</li>
                        <li>Community Empowerment</li>
                    </ul>
                </div>
                <a wire:navigate href="{{route('contact-us')}}"
                   class="inline-block mt-4 px-6 py-3 bg-teal-600 text-white rounded-lg font-semibold hover:bg-teal-700 transition">
                    Contact Us
                </a>
            </div>
            <!-- Right: Image & Team -->
            <div class="flex flex-col items-center">
                <div class="w-full max-w-md rounded-2xl overflow-hidden border border-teal-100 mb-6 bg-gradient-to-br from-teal-50 to-orange-50 flex items-center justify-center">
                    <img src="/images/doctors.jpg" alt="About Us" class="w-full h-64 object-cover rounded-2xl">
                </div>
                <div class="bg-gray-50 rounded-xl border border-teal-100 p-6 w-full max-w-md text-center">
                    <h4 class="text-lg font-bold text-teal-800 mb-2">Meet Our Team</h4>
                    <p class="text-gray-700">Our dedicated team of healthcare professionals is committed to delivering the highest quality of care and support to our patients and partners.</p>
                </div>
            </div>
        </div>
    </div>
</section>
