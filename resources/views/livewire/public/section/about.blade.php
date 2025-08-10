<div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #0d9488 0%, #115e59 100%);
        }

        .team-card {
            transition: all 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
            transition: all 0.5s ease;
        }

        .stat-card:hover::after {
            transform: rotate(30deg) translate(20px, 20px);
        }

        .feature-icon {
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1);
            background-color: #0d9488;
            color: white;
        }

        .partner-logo {
            filter: grayscale(100%);
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .partner-logo:hover {
            filter: grayscale(0%);
            opacity: 1;
            transform: scale(1.05);
        }

        .timeline-dot {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translate(-50%, -50%);
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #14b8a6;
            z-index: 10;
        }

        .timeline-line {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 2px;
            background: #14b8a6;
            transform: translateX(-50%);
        }

        /* New Leadership Styles */
        .leader-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .leader-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .leader-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .leader-header {
            background: linear-gradient(135deg, #0d9488 0%, #115e59 100%);
            height: 120px;
            position: relative;
        }

        .leader-content {
            margin-top: 75px;
        }

        .position-badge {
            background-color: #f59e0b;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .leader-image {
                width: 120px;
                height: 120px;
            }
            .leader-content {
                margin-top: 60px;
            }
        }
    </style>

    <body class="bg-gray-50">
        <!-- Hero Section -->
        <div class="hero-gradient py-16 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                        <span class="block">About MedBuzzy India</span>
                        <span class="block text-brand-orange-300 mt-2">Your Healthcare Partner</span>
                    </h1>
                    <p class="mt-4 max-w-md mx-auto text-lg text-brand-teal-100 sm:text-xl md:mt-6 md:text-2xl md:max-w-3xl">
                        Connecting patients with India's top doctors across 100+ hospitals
                    </p>
                </div>
            </div>
        </div>

        <!-- Vision Section -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2 class="text-base text-brand-teal-600 font-semibold tracking-wide uppercase">Our Vision</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Transforming healthcare access in India
                    </p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-600 lg:mx-auto">
                        Bridging the gap between patients and quality healthcare providers across the country
                    </p>
                </div>

                <!-- Statistics Section -->
                <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="stat-card bg-brand-teal-50 rounded-xl p-8 text-center border border-brand-teal-100">
                        <div class="text-4xl font-bold text-brand-teal-600">100+</div>
                        <div class="text-md font-medium text-gray-600 mt-2">Partner Hospitals</div>
                        <i class="fas fa-hospital text-brand-teal-300 text-3xl mt-4"></i>
                    </div>
                    <div class="stat-card bg-brand-teal-50 rounded-xl p-8 text-center border border-brand-teal-100">
                        <div class="text-4xl font-bold text-brand-orange-500">5,000+</div>
                        <div class="text-md font-medium text-gray-600 mt-2">Verified Doctors</div>
                        <i class="fas fa-user-md text-brand-orange-400 text-3xl mt-4"></i>
                    </div>
                    <div class="stat-card bg-brand-teal-50 rounded-xl p-8 text-center border border-brand-teal-100">
                        <div class="text-4xl font-bold text-brand-teal-600">50+</div>
                        <div class="text-md font-medium text-gray-600 mt-2">Cities Covered</div>
                        <i class="fas fa-city text-brand-teal-300 text-3xl mt-4"></i>
                    </div>
                    <div class="stat-card bg-brand-teal-50 rounded-xl p-8 text-center border border-brand-teal-100">
                        <div class="text-4xl font-bold text-brand-orange-500">10M+</div>
                        <div class="text-md font-medium text-gray-600 mt-2">Patients Served</div>
                        <i class="fas fa-users text-brand-orange-400 text-3xl mt-4"></i>
                    </div>
                </div>

                <!-- Our Story Section -->
                <div class="mt-16">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div>
                            <h2 class="text-2xl font-bold text-brand-teal-800 mb-4">Our Indian Journey</h2>
                            <div class="prose text-gray-600">
                                <p class="mb-4">
                                    Founded in 2020, MedBuzzy India began with a mission to solve the challenges Indian
                                    patients face in accessing quality healthcare.
                                    Our platform was designed specifically for India's diverse healthcare landscape.
                                </p>
                                <p class="mb-4">
                                    Starting with just 10 hospitals in Delhi NCR, we've grown to partner with leading
                                    healthcare providers across the country,
                                    from multi-specialty hospitals in metros to trusted clinics in tier-2 cities.
                                </p>
                                <p>
                                    Today, we're proud to be India's fastest growing doctor appointment platform,
                                    serving patients in 12 regional languages
                                    with features designed for Indian healthcare needs.
                                </p>
                            </div>
                        </div>
                        <div class="rounded-xl overflow-hidden shadow-xl border-4 border-white">
                            <img src="https://images.unsplash.com/photo-1581056771107-24ca5f033842?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                                alt="Indian hospital reception" class="w-full h-auto object-cover rounded-lg">
                        </div>
                    </div>
                </div>

                <!-- Why Choose MedBuzzy Section -->
                <div class="mt-16">
                    <h2 class="text-3xl font-bold text-center text-brand-teal-800 mb-12">Why Choose MedBuzzy India</h2>
                    <div class="grid gap-8 md:grid-cols-3">
                        <!-- Feature 1 -->
                        <div class="feature-card bg-white p-8 rounded-xl shadow-md border border-brand-teal-100 hover:border-brand-teal-300 transition-all">
                            <div class="flex items-center justify-center h-16 w-16 rounded-xl bg-brand-teal-100 text-brand-teal-600 mb-6 feature-icon">
                                <i class="fas fa-user-md text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Verified Indian Doctors</h3>
                            <p class="mt-3 text-gray-600">
                                All doctors verified with MCI registration and hospital credentials. We ensure only
                                qualified professionals join our platform.
                            </p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="feature-card bg-white p-8 rounded-xl shadow-md border border-brand-teal-100 hover:border-brand-teal-300 transition-all">
                            <div class="flex items-center justify-center h-16 w-16 rounded-xl bg-brand-teal-100 text-brand-teal-600 mb-6 feature-icon">
                                <i class="fas fa-headset text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">24/7 Hindi & English Support</h3>
                            <p class="mt-3 text-gray-600">
                                Our care coordinators speak both Hindi and English. We also provide support in 12
                                regional languages.
                            </p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="feature-card bg-white p-8 rounded-xl shadow-md border border-brand-teal-100 hover:border-brand-teal-300 transition-all">
                            <div class="flex items-center justify-center h-16 w-16 rounded-xl bg-brand-teal-100 text-brand-teal-600 mb-6 feature-icon">
                                <i class="fas fa-rupee-sign text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Transparent Indian Pricing</h3>
                            <p class="mt-3 text-gray-600">
                                See consultation fees upfront with no hidden charges. We offer price match guarantee for
                                all services.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Leadership Section -->
        <div class="py-16 bg-brand-teal-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-brand-teal-800 sm:text-4xl">Our Leadership</h2>
                    <p class="mt-4 max-w-2xl text-xl text-gray-600 mx-auto">
                        The team dedicated to improving healthcare access in India
                    </p>
                </div>

                <!-- Founder -->
                <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="leader-card bg-white rounded-xl overflow-hidden">
                        <div class="leader-header relative">
                            <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                                <img src="/leaders/Papa.jpg" alt="Ramotar Sah" class="leader-image rounded-full">
                            </div>
                        </div>
                        <div class="leader-content p-6 text-center">
                            <div class="position-badge">Founder</div>
                            <h3 class="text-xl font-bold text-gray-900">Ramotar Sah</h3>
                            <p class="mt-4 text-gray-600 text-sm">
                                The company "Gauriram Medbuzzy (OPC) Private Limited," which is the top provider of
                                healthcare services in India, Ramotar Sah was founded by Ramotar Sah. He has
                                been a social crusader and self-made serial entrepreneur for fifty years. His personal
                                goal is to educate consumers and society about the importance of time, the worth of
                                health, and how to choose the finest medical professionals and medications. He
                                frequently takes risks since he firmly believes in having a vision and carrying
                                it out quickly and accurately. Ramotar Sah is a firm believer in leading his team
                                down a progressive route. In society, he is also referred to as a health assistant.
                            </p>
                        </div>
                    </div>

                    <!-- Co-Founder -->
                    <div class="leader-card bg-white rounded-xl overflow-hidden">
                        <div class="leader-header relative">
                            <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                                <img src="/leaders/Rajeev.jpg" alt="R.K. Ranjan" class="leader-image rounded-full">
                            </div>
                        </div>
                        <div class="leader-content p-6 text-center">
                            <div class="position-badge">Co-Founder</div>
                            <h3 class="text-xl font-bold text-gray-900">R.K. Ranjan</h3>
                            <p class="mt-4 text-gray-600 text-sm">
                                RK Ranjan oversees Medbuzzy's product service and technology, executing the
                                founder's ideas for the online platform. He formally believes in creating value
                                for all stakeholders, and he handles operational integrity, data security, and
                                privacy system support. Preserving thinkers, diligent workers, and
                                problem solvers make up RK Ranjan's team. Thus, preserve the website's and the
                                app's integrity for the future. RK Ranjan is primarily a proponent of understanding
                                stakeholder sentiment and fostering an atmosphere of openness and trust.
                            </p>
                        </div>
                    </div>

                    <!-- CEOs -->
                    <div class="leader-card bg-white rounded-xl overflow-hidden">
                        <div class="leader-header relative">
                            <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2 flex space-x-4">
                                <img src="/leaders/IMG-20250718-WA0004 (1).jpg" alt="Sourav Kumar Sah" class="leader-image rounded-full">
                                <img src="/leaders/IMG-20250718-WA0005.jpg" alt="Ranjeet Kumar" class="leader-image rounded-full">
                            </div>
                        </div>
                        <div class="leader-content p-6 text-center">
                            <div class="position-badge">Chief Executive Officers</div>
                            <h3 class="text-xl font-bold text-gray-900">Sourav Kumar Sah & Ranjeet Kumar</h3>
                            <p class="mt-4 text-gray-600 text-sm">
                                Sourav Kumar Sah and Ranjeet Kumar lead Gauriram Medbuzzy with a visionary mindset and a deep
                                passion for revolutionizing healthcare delivery in India. As CEOs, they are
                                responsible for strategic decision-making, business expansion, stakeholder
                                relations, and driving innovation across the organization. Known for their
                                hands-on leadership style, they believe in empowering their team,
                                streamlining digital operations, and delivering exceptional value to both patients and
                                healthcare professionals. Under their leadership, the company aims to transform healthcare accessibility across India.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Medical Advisory Board -->
                <div class="mt-16">
                    <h3 class="text-2xl font-bold text-brand-teal-700 text-center mb-8">Medical Advisory Board</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                        <!-- Medical Advisor 1 -->
                        <div class="leader-card bg-white rounded-xl overflow-hidden">
                            <div class="leader-header relative">
                                <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                                    <img src="/leaders/Pankaj.jpg" alt="Pankaj Kumar" class="leader-image rounded-full">
                                </div>
                            </div>
                            <div class="leader-content p-6 text-center">
                                <div class="position-badge">Medical Advisory Board</div>
                                <h3 class="text-xl font-bold text-gray-900">Mr. Pankaj Kumar</h3>
                                <p class="mt-4 text-gray-600 text-sm">
                                    Dr Pankaj Kumar is the Chief Healthcare Strategy Officer at Medbuzzy and
                                    Chairman of the Advisory Board. In a career spanning nearly one decade, Dr Pankaj is a
                                    General Medical Practitioner with 10 years of experience seeking a residency in
                                    obstetrics to utilize advanced skills in diagnosing ailments, administering medication,
                                    prescribing medication, and suggesting lifestyle changes. Detail-oriented and
                                    exceptional follow through skills with the ability to multi-task and prioritize.
                                </p>
                            </div>
                        </div>

                        <!-- Medical Advisor 2 -->
                        <div class="leader-card bg-white rounded-xl overflow-hidden">
                            <div class="leader-header relative">
                                <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                                    <img src="/leaders/Dr. sneha gupta.jpeg" alt="Dr. Sneha Gupta" class="leader-image rounded-full">
                                </div>
                            </div>
                            <div class="leader-content p-6 text-center">
                                <div class="position-badge">Medical Advisory Board</div>
                                <h3 class="text-xl font-bold text-gray-900">Dr. Sneha Gupta</h3>
                                <p class="mt-4 text-gray-600 text-sm">
                                    Dr Sneha Gupta has over 20 years of experience in healthcare consulting,
                                    budgeting, operations management, medical devices, and physician relations.
                                    Thorough and well-organized in attending to administrative functions to ensure
                                    patient histories, examination results, and treatments were properly recorded
                                    and maintained. Recognized for consistent reliability and resourcefulness in
                                    problem-solving situations. Demonstrated ability to provide high-quality patient
                                    care and supervise support staff.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Partner Hospitals Section -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-brand-teal-800">Our Partner Hospitals</h2>
                    <p class="mt-4 max-w-2xl text-xl text-gray-600 mx-auto">
                        Trusted by India's leading healthcare providers
                    </p>
                </div>

                <div class="mt-10 grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-6">
                    <div class="partner-logo flex items-center justify-center p-6 bg-gray-50 rounded-lg">
                        <span class="text-xl font-bold text-brand-teal-700">Apollo</span>
                    </div>
                    <div class="partner-logo flex items-center justify-center p-6 bg-gray-50 rounded-lg">
                        <span class="text-xl font-bold text-brand-teal-700">Fortis</span>
                    </div>
                    <div class="partner-logo flex items-center justify-center p-6 bg-gray-50 rounded-lg">
                        <span class="text-xl font-bold text-brand-teal-700">Max</span>
                    </div>
                    <div class="partner-logo flex items-center justify-center p-6 bg-gray-50 rounded-lg">
                        <span class="text-xl font-bold text-brand-teal-700">Manipal</span>
                    </div>
                    <div class="partner-logo flex items-center justify-center p-6 bg-gray-50 rounded-lg">
                        <span class="text-xl font-bold text-brand-teal-700">AIIMS</span>
                    </div>
                    <div class="partner-logo flex items-center justify-center p-6 bg-gray-50 rounded-lg">
                        <span class="text-xl font-bold text-brand-teal-700">Artemis</span>
                    </div>
                </div>
            </div>
        </div>
    </body>
</div>