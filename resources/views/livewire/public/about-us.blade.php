<section class="bg-gradient-to-br from-teal-100 to-white py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-extrabold text-teal-900 mb-2">About Us</h2>
            <p class="text-lg text-teal-700 mb-4">Welcome to MedBuzzy, your trusted partner in healthcare innovation and excellence.</p>
            <p class="text-teal-600">Learn more about who we are and what we do.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div>
                <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                    <h3 class="text-2xl font-semibold text-teal-800 mb-4">Our Mission</h3>
                    <p class="text-teal-700 mb-4">
                        At MedBuzzy, our mission is to provide exceptional healthcare solutions that empower individuals and communities. 
                        We strive to innovate and deliver services that make a difference in people's lives.
                    </p>
                    <h4 class="text-xl font-semibold text-teal-700 mb-2">Our Core Values</h4>
                    <ul class="list-disc list-inside text-teal-600">
                        <li>Compassionate Care</li>
                        <li>Innovation & Excellence</li>
                        <li>Integrity & Trust</li>
                        <li>Community Empowerment</li>
                    </ul>
                </div>
                <a wire:navigate href="{{route('contact-us')}}" class="inline-block mt-4 px-6 py-2 bg-teal-600 text-white rounded-lg shadow hover:bg-teal-700 transition">Contact Us</a>
            </div>
            <div class="flex flex-col items-center">
                <img src="/images/doctors.jpg" alt="About Us" class="rounded-lg shadow-xl mb-6 w-full max-w-md">
                <div class="bg-white rounded-lg shadow p-4 w-full max-w-md">
                    <h4 class="text-lg font-bold text-teal-800 mb-2">Meet Our Team</h4>
                    <p class="text-teal-700">Our dedicated team of healthcare professionals is committed to delivering the highest quality of care and support to our patients and partners.</p>
                </div>
            </div>
        </div>
    </div>
</section>
