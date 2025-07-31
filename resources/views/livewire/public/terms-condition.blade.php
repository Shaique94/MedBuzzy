<div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        .section-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .toc-item {
            position: relative;
            padding-left: 1.25rem;
            transition: all 0.2s;
        }

        .toc-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background-color: #14b8a6;
            border-radius: 50%;
        }

        .toc-item:hover {
            color: #f97316;
            transform: translateX(5px);
        }

        .back-to-top {
            position: fixed;
            bottom: 1.4rem;
            right: 1.5rem;
            z-index: 1000;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            background-color: #14b8a6;
            color: white;
            padding: 0.75rem;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .back-to-top.show {
            opacity: 1;
            transform: translateY(0);
        }

        .back-to-top:hover {
            background-color: #0d9488;
        }

        /* Custom scrollbar for table of contents */
        .scrollbar-thin {
            scrollbar-width: thin;
        }

        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #14b8a6;
            border-radius: 3px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: #0d9488;
        }

        /* Fixed Table of Contents */
        .toc-fixed {
            position: sticky;
            top: 2rem;
            width: 25%;
            align-self: flex-start;
            z-index: 10;
        }

        /* Main content offset for fixed TOC */
        .main-content-offset {
            width: 73%;
        }

        /* Container layout */
        .content-container {
            display: flex;
            gap: 2%;
        }

        /* Smooth scroll offset for anchor links */
        html {
            scroll-padding-top: 2rem;
        }

        @media (max-width: 1024px) {
            .toc-fixed {
                position: relative;
                top: auto;
                width: 100%;
                align-self: auto;
                z-index: auto;
                margin-bottom: 2rem;
            }
            
            .main-content-offset {
                width: 100%;
            }
            
            .content-container {
                flex-direction: column;
                gap: 0;
            }
        }

        @media (max-width: 640px) {
            .back-to-top {
                bottom: 6rem;
                right: 1rem;
                padding: 0.5rem;
            }
        }
    </style>

    <body class="bg-gray-50">
        <!-- Hero Section -->
        <div class="bg-teal-700 text-white py-10 sm:py-12 md:py-16">
            <div class="container mx-auto px-4 sm:px-6 text-center">
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-4 sm:mb-6 leading-tight">
                    Medbuzzy Terms & Conditions
                </h1>
                <p class="text-base sm:text-lg md:text-xl max-w-3xl mx-auto mb-6 sm:mb-8 leading-relaxed">
                    Terms of Use governing your access and use of our healthcare platform
                </p>
                <div class="text-xs sm:text-sm text-teal-100">
                    Last updated: August 1, 2025
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 py-8 sm:py-10 md:py-12">
            <div class="content-container">
                <!-- Table of Contents - Sticky Position -->
                <div class="toc-fixed">
                    <div class="bg-white rounded-xl shadow-lg p-5 sm:p-6">
                        <h3 class="text-lg sm:text-xl font-bold text-brand-teal-800 mb-4 pb-2 border-b border-gray-200">
                            Contents</h3>
                        <div class="pr-2">
                            <ul class="space-y-2 sm:space-y-3 text-sm sm:text-base">
                                <li><a href="#overview" class="toc-item block text-gray-700 hover:text-brand-orange-600">Terms Overview</a></li>
                                <li><a href="#general" class="toc-item block text-gray-700 hover:text-brand-orange-600">1. General</a></li>
                                <li><a href="#eligibility" class="toc-item block text-gray-700 hover:text-brand-orange-600">2. Eligibility</a></li>
                                <li><a href="#services" class="toc-item block text-gray-700 hover:text-brand-orange-600">3. Our Services</a></li>
                                <li><a href="#platform-use" class="toc-item block text-gray-700 hover:text-brand-orange-600">4. Platform Use</a></li>
                                <li><a href="#prohibited-content" class="toc-item block text-gray-700 hover:text-brand-orange-600">5. Prohibited Content</a></li>
                                <li><a href="#indemnity" class="toc-item block text-gray-700 hover:text-brand-orange-600">6. Indemnity</a></li>
                                <li><a href="#liability" class="toc-item block text-gray-700 hover:text-brand-orange-600">7. Limitation of Liability</a></li>
                                <li><a href="#platform-modification" class="toc-item block text-gray-700 hover:text-brand-orange-600">8. Platform Modification</a></li>
                                <li><a href="#data-policy" class="toc-item block text-gray-700 hover:text-brand-orange-600">9. Data & Information</a></li>
                                <li><a href="#intellectual-property" class="toc-item block text-gray-700 hover:text-brand-orange-600">10. Intellectual Property</a></li>
                                <li><a href="#other-conditions" class="toc-item block text-gray-700 hover:text-brand-orange-600">11. Other Conditions</a></li>
                                <li><a href="#miscellaneous" class="toc-item block text-gray-700 hover:text-brand-orange-600">12. Miscellaneous</a></li>
                                <li><a href="#third-party-links" class="toc-item block text-gray-700 hover:text-brand-orange-600 ml-4">• 12.1 Third-Party Links</a></li>
                                <li><a href="#amendments" class="toc-item block text-gray-700 hover:text-brand-orange-600 ml-4">• 12.2 Amendments</a></li>
                                <li><a href="#force-majeure" class="toc-item block text-gray-700 hover:text-brand-orange-600 ml-4">• 12.3 Force Majeure</a></li>
                                <li><a href="#termination" class="toc-item block text-gray-700 hover:text-brand-orange-600 ml-4">• 12.4 Termination</a></li>
                                <li><a href="#jurisdiction" class="toc-item block text-gray-700 hover:text-brand-orange-600 ml-4">• 12.5 Jurisdiction</a></li>
                                <li><a href="#severability" class="toc-item block text-gray-700 hover:text-brand-orange-600 ml-4">• 12.6 Severability</a></li>
                                <li><a href="#waiver" class="toc-item block text-gray-700 hover:text-brand-orange-600 ml-4">• 12.7 Waiver</a></li>
                                <li><a href="#grievance-contact" class="toc-item block text-gray-700 hover:text-brand-orange-600 ml-4">• 12.8 Contact & Grievance</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="main-content-offset">
                <!-- Terms Overview -->
                    <div id="overview" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-center mb-4 sm:mb-6">
                            <div class="bg-brand-teal-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-info-circle text-brand-teal-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Terms Overview</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Understanding our terms of use</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                These Terms of Use ("Terms of Use") is an electronic record in terms of the Information Technology Act, 2000, and rules thereunder, as applicable, and the amended provisions pertaining to electronic records in various statutes, as amended from time to time by the Information Technology Act, 2000. These Terms of Use does not require any physical or digital signatures.
                            </p>
                            <div class="bg-blue-50 rounded-lg p-4 sm:p-5 border border-blue-200">
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    <strong>Legal Compliance:</strong> These Terms of Use is published in accordance with the provisions of rule 3(1) of the Information Technology (Intermediaries Guidelines and Digital Media Ethics Code) Rules, 2021 as amended from time to time, which requires publishing of the rules and regulations, privacy policy and terms for access or usage of www.medbuzzy.com website and its mobile application.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 1. General Section -->
                    <div id="general" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-brand-teal-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-building text-brand-teal-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">1. General</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Company information and agreement scope</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <div class="bg-brand-teal-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-brand-teal-700 mb-2 text-sm sm:text-base">1.1 Company Information</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    We, at <strong>GAURIRAM MEDBUZZY (OPC) PRIVATE LIMITED</strong> a company duly incorporated under the provisions of the Companies Act, 2013, having its registered office at Gurudwara Road, Bhatta Bazar, Purnia-854301 Bihar, India (collectively, "GM(O)Pvt. Ltd", "Medbuzzy", "We", "Us", "Our" "Company") provide services to all individuals accessing or using our app, Medbuzzy and website (www.medbuzzy.com) (collectively "Platform") for any reason ("You", "Yours", "User") subject to the notices, terms, and conditions set forth in these Terms of Use ("Terms of Use", "Agreement", "Terms"), read with the Privacy Policy, Return Policy, Payment & Refunds Policy available here https://www.medbuzzy.com. GM(O)Pvt. Ltd and User are hereinafter individually referred to as the "Party" and collectively as the "Parties".
                                </p>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-blue-700 mb-2 text-sm sm:text-base">1.2 Agreement Scope</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-3">
                                    These Terms of Use together with below listed documents/policies (without limitation) available either at Platform or entered separately by the Company with You, as applicable, and all other notices, rules, guidelines with respect to Your use of the Platform, constitutes the entire agreement ("Agreement") between the Company and You:
                                </p>
                                <ul class="list-disc pl-6 space-y-1 text-gray-700 text-sm sm:text-base">
                                    <li>Privacy Policy;</li>
                                    <li>Return Policy; and</li>
                                    <li>Payment and Refund Policy.</li>
                                </ul>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-4 sm:p-5 border border-yellow-200">
                                <h3 class="font-bold text-yellow-700 mb-2 text-sm sm:text-base">1.3 Platform Operation</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    The domain name www.medbuzzy.com, an internet-based portal, and "medbuzzy", a mobile application, is run, operated, and maintained by GM(O)Pvt. Ltd may assign, transfer, and subcontract its rights and/or obligations under these Terms of Use to any third party, as it may deem fit, and you shall continue to be bound by these Terms of Use in the event of such assignment, transfer, or subcontracting.
                                </p>
                            </div>

                            <div class="bg-red-50 rounded-lg p-4 sm:p-5 border border-red-200">
                                <h3 class="font-bold text-red-700 mb-2 text-sm sm:text-base">1.4 Compliance and Jurisdiction</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    Our Platform is operated, and services are provided in compliance with the laws in India and GM(O)Pvt. Ltd shall not be liable to provide any Services availed by you in locations outside India. If you access our services from locations outside India, you do so at your own risk and you are solely liable for compliance with applicable local laws. The User agrees to use the service to authorize an individual and get the services from the third party on his/her behalf. Where you use any third-party website or the services of any third party, you may be subject to alternative or additional Terms of Use of use and privacy policies of the respective third party/s.
                                </p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4 sm:p-5">
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    <strong>Agreement Acceptance:</strong> Any accessing or browsing of the Platform and using the Services (as defined in these Terms of Use) indicates your Agreement to all the Terms of Use in this Agreement. If you disagree with any part of the Terms of Use, then you may discontinue access or use of the Platform.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Eligibility Section -->
                    <div id="eligibility" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-brand-orange-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-user-check text-brand-orange-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">2. Eligibility</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Requirements for using our platform</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                When You use the Platform, You represent that You meet the following primary eligibility criteria:
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                                <div class="bg-green-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-green-700 mb-2 text-sm sm:text-base">Age Requirements</h3>
                                    <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                        <li>You are at least 18 years old or accessing the Platform under the supervision of a parent or guardian, who in such a case will be deemed as the recipient/end-user of the Services for the purpose of these Terms of Use.</li>
                                        <li>If Your age is below that of 18 years, your parents or legal guardians can transact on behalf of You if they are registered users.</li>
                                        <li>You are prohibited from purchasing any material the sale or purchase of which to/by minors is prohibited and which is for consumption by adults only.</li>
                                        <li>GM(O)Pvt. Ltd reserves the right to terminate your membership and/or refuse to provide You with access to the Platform if GM(O)Pvt. Ltd discovers that You are under the age of 18 years.</li>
                                    </ul>
                                </div>

                                <div class="bg-blue-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-blue-700 mb-2 text-sm sm:text-base">Legal Competency</h3>
                                    <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                        <li>You are legally competent to contract, and otherwise competent to receive the Services.</li>
                                        <li>Persons who are "incompetent to contract" within the meaning of the Indian Contract Act, 1872 including un-discharged insolvents, etc. are not eligible to use the Platform.</li>
                                        <li>You have not been previously suspended or removed by GM(O)Pvt. Ltd or disqualified for any other reason, from availing the Services.</li>
                                    </ul>
                                </div>

                                <div class="bg-purple-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-purple-700 mb-2 text-sm sm:text-base">Account Requirements</h3>
                                    <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                        <li>Your registered id can only be utilized by You wherein Your details have been provided and We do not permit multiple persons to share a single login/registration id.</li>
                                        <li>Organizations, companies, and businesses may not become registered Users on the Platform or use the Platform through individual Users.</li>
                                        <li>You agree and acknowledge that You shall (i) create only 1 (one) account; (ii) provide accurate, truthful, current, and complete information when creating your account and in all Your dealings through the Platform; (iii) maintain and promptly update your account information; (iv) maintain the security of Your account by not sharing Your password with others and restricting access to Your account and Your computer; (v) promptly notify GM(O)Pvt. Ltd if You discover or otherwise suspect any security breaches relating to the Platform; and (vi) take responsibility for all the activities that occur under Your account and accept all risk of unauthorized access.</li>
                                    </ul>
                                </div>

                                <div class="bg-yellow-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-yellow-700 mb-2 text-sm sm:text-base">Platform Access Rights</h3>
                                    <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                        <li>We reserve our rights to refuse access to use the Services offered at the Platform to new Users or to terminate access granted to existing Users at any time without assigning any reasons for doing so and you shall have no right to object to the same.</li>
                                        <li>We at Our discretion, reserve the right to permanently or temporarily suspend Users, to bar their use and access of the Platform, at any time while We investigate complaints or alleged violations of these Terms of Use or any Services, or for any other reason.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Our Services Section -->
                    <div id="services" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-green-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-heartbeat text-green-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">3. Our Services</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Healthcare services we provide</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                Through the Platform, We provide You with the following services ("Services"):
                            </p>

                            <div class="bg-brand-teal-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-brand-teal-700 mb-3 text-base sm:text-lg">a. Creating and maintaining user accounts</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    Users need to register on the Platform in order to use the Platform or the Services provided through the Platform. In order to register, You have to provide certain personal details including but not limited to Your name, phone number, email address, birth date, gender, etc.
                                </p>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-blue-700 mb-3 text-base sm:text-lg">b. Scheduling an appointment for medical consultation</h3>
                                <div class="space-y-3">
                                    <div class="bg-white rounded-lg p-3 border border-blue-200">
                                        <h4 class="font-semibold text-blue-700 mb-2">Medical Consultation Booking</h4>
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            You can book an appointment for a medical consultation with a healthcare or wellness service provider/doctor/physician listed on the Platform. Medical consultations on the Platform shall be available for multi specialties.
                                        </p>
                                    </div>
                                    
                                    <div class="bg-white rounded-lg p-3 border border-blue-200">
                                        <h4 class="font-semibold text-blue-700 mb-2">Appointment Management</h4>
                                        <p class="text-gray-700 text-sm leading-relaxed mb-2">
                                            You will receive a confirmation of appointment for medical consultation on the Platform and/or via SMS and/or email / online communication messaging services. We reserve the right to reschedule or cancel an appointment without any prior notice. The time provided for a consultation to you is indicative and actual consultation time may change depending on the consulting HSP's discretion or other circumstances, for which You shall be accordingly communicated.
                                        </p>
                                        <p class="text-gray-700 text-sm leading-relaxed mb-2">
                                            You agree that there might be technological/logistic/unforeseen circumstances that might lead to delay or cancellation of the consultation for which appropriate resolution either as rescheduling/ refund shall be provided. For any support related to issue/s faced by You pre/during / post consultation, You can reach Us through various channels as set out on the Platform or the detail as set out in Section 12.8 of this Terms of Use, and Our team shall help You for the same.
                                        </p>
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>Cancellation Policy:</strong> Consultations can be booked, rescheduled, or cancelled free of cost up to 3 (Three) hours prior to the scheduled /booked appointment time.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Platform Use Section -->
                    <div id="platform-use" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-purple-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-laptop-medical text-purple-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">4. Your Use of the Platform</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Conditions and limitations for platform use</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                As an end-user and recipient of Services, when You use the Platform, You agree to the following conditions of use:
                            </p>

                            <!-- Due Diligence Conditions -->
                            <div class="bg-blue-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-blue-700 mb-3 text-base sm:text-lg">A. Due diligence conditions</h3>
                                <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                    <li>You are solely responsible for the medical, health, and personal information you provide on the Platform, and You are requested to use Your discretion in providing such information.</li>
                                    <li>The advice or the Services provided by the HSP will depend upon the information You provide on the Platform. You will provide accurate and complete information everywhere on the Platform, based on which You will receive the Services.</li>
                                    <li>You will be solely responsible for all access to and use of this site by anyone using the password and identification originally assigned to you whether or not such access to and use of this site is actually authorized by you, including without limitation, all communications and transmissions and all obligations (including, without limitation, financial obligations) incurred through such access or use. You are solely responsible for protecting the security and confidentiality of the password and identification assigned to you.</li>
                                    <li>We reserve Our rights to refuse Service or terminate accounts at Our discretion, if we believe that You have violated or are likely to violate applicable law or these Terms of Use.</li>
                                </ul>
                            </div>

                            <!-- Scope of Services -->
                            <div class="bg-green-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-green-700 mb-3 text-base sm:text-lg">B. Scope of Services</h3>
                                <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                    <li>The Services availed by You from a HSP via the Platform are an arrangement between You and the HSP You select. The Platform only facilitates connections between You and the HSP and bears no responsibility for the outcome of any such medical consultation or other Services obtained by You.</li>
                                    <li>We shall not be liable for deficiency or shortfall in Services/ misdiagnosis / faulty judgment/interpretation error/perception error / adverse events/inefficacy of prescribed treatment or advice or investigation reports/validity of the advice or prescription or investigation reports provided by the HSP / unavailability of the recommended or prescribed treatment or medication under any condition or circumstances. Users are advised to use their discretion for following the advice obtained post-medical consultation with HSP via the Platform or post Services.</li>
                                    <li>We only facilitate the connections between You and the HSP established through the Platform and does not in any way facilitate, encourage, permit, or require you to contact the HSP outside the Platform. Any contact between You and the HSP through the Platform, will be subject to these Terms of Use.</li>
                                    <li>You may view and access the content available on the Platform solely for the purposes of availing the Services, and only as per these Terms of Use. You shall not modify any content on the Platform or reproduce, display, publicly perform, distribute, or otherwise use such content in any way for any public or commercial purpose or for personal gain.</li>
                                </ul>
                            </div>

                            <!-- Prohibitions -->
                            <div class="bg-red-50 rounded-lg p-4 sm:p-5 border border-red-200">
                                <h3 class="font-bold text-red-700 mb-3 text-base sm:text-lg">C. Prohibitions</h3>
                                <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                    <li>You may not reproduce, distribute, display, sell, lease, transmit, create derivative works from, translate, modify, reverse-engineer, disassemble, decompile or otherwise exploit the Platform or any portion of it unless expressly permitted by GM(O)PVT. LTD in writing.</li>
                                    <li>You may not make any commercial use of any of the information provided on the Platform.</li>
                                    <li>You may not impersonate any person or entity, or falsely state or otherwise misrepresent your identity, age or affiliation with any person or entity.</li>
                                    <li>You may not upload any content prohibited under applicable law, and/or designated as "Prohibited Content" under Section 5.</li>
                                    <li>You may not contact or make any attempt to contact the concerned HSP for a consultation, follow up to a prior medical consultation or for any other reason outside the Platform via email, SMS, messaging services or any other mode of communication outside the authorized channels.</li>
                                    <li>You may not assign, transfer, or sub-contract any of your rights or obligations under these Terms or any related order for Products to any third party, unless agreed upon in writing by GM(O)PVT. LTD.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Prohibited Content Section -->
                    <div id="prohibited-content" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-red-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-ban text-red-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">5. Prohibited Content</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Content restrictions and community guidelines</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                You shall not upload to, distribute, or otherwise publish through the Platform, the following Prohibited Content, which includes any content, information, or other material that:
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                                <div class="bg-red-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-red-700 mb-2 text-sm sm:text-base">Ownership & Rights Violations</h3>
                                    <ul class="list-disc pl-6 space-y-1 text-gray-700 text-sm sm:text-base">
                                        <li>belongs to another person and which you do not own the rights to;</li>
                                        <li>infringes any patent, trademark, copyright, or other proprietary rights;</li>
                                        <li>contains software viruses or any other computer code and malicious programs;</li>
                                        <li>File or program designed to interrupt, destroy or limit the functionality of any computer resource;</li>
                                    </ul>
                                </div>

                                <div class="bg-orange-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-orange-700 mb-2 text-sm sm:text-base">Harmful Content</h3>
                                    <ul class="list-disc pl-6 space-y-1 text-gray-700 text-sm sm:text-base">
                                        <li>is harmful, harassing, blasphemous, defamatory, obscene, pornographic, pedophilic, invasive of another's privacy, including bodily privacy, insulting or harassing on the basis of gender, libellous, racially or ethnically objectionable, or otherwise inconsistent with or contrary to the laws in force;</li>
                                        <li>harm minors in any way;</li>
                                        <li>communicates any information which is grossly offensive or menacing in nature;</li>
                                    </ul>
                                </div>

                                <div class="bg-yellow-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-yellow-700 mb-2 text-sm sm:text-base">Discriminatory Content</h3>
                                    <ul class="list-disc pl-6 space-y-1 text-gray-700 text-sm sm:text-base">
                                        <li>is hateful, racially or ethnically objectionable, disparaging of any person;</li>
                                        <li>threatens the unity, integrity, defence, security, or sovereignty of India, friendly relations with foreign states, or public order, promoting enmity between different groups on the grounds of religion or caste with the intent to incite violence;</li>
                                        <li>incites any offence or prevents investigation of any offence or insults any other nation;</li>
                                    </ul>
                                </div>

                                <div class="bg-purple-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-purple-700 mb-2 text-sm sm:text-base">Legal Violations</h3>
                                    <ul class="list-disc pl-6 space-y-1 text-gray-700 text-sm sm:text-base">
                                        <li>violates any law in India for the time being in force;</li>
                                        <li>deceives or misleads the addressee about the origin of your message and intentionally communicates any information which is patently false or misleading in nature but may reasonably be perceived as a fact;</li>
                                        <li>is patently false and untrue, and is written or published in any form, with the intent to mislead or harass a person, entity or agency for financial gain or to cause any injury to any person;</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="bg-gray-100 rounded-lg p-4 sm:p-5 border border-gray-300">
                                <h3 class="font-bold text-gray-700 mb-2 text-sm sm:text-base">Additional Restrictions</h3>
                                <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                    <li>relates to or seems to encourage money laundering or gambling,</li>
                                    <li>impersonates another person;</li>
                                    <li>contains software viruses or any other computer code and malicious programs;</li>
                                    <li>File or program designed to interrupt, destroy or limit the functionality of any computer resource;</li>
                                    <li>is abusive or inappropriate to the HSP conducting your medical consultation or any employees, consultants or technicians of GM(O)PVT. LTD or any other Apollo group company or affiliate who you may interact with for availing Services; and</li>
                                    <li>is not relating to the medical consultation or relating to any of the services you avail from us.</li>
                                </ul>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-4 sm:p-5 border border-blue-200">
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    <strong>Enforcement:</strong> You also understand and acknowledge that if you fail to adhere to the above, we have the right to remove such information and/or immediately terminate your access to the Services and/or to the Platform.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Indemnity Section -->
                    <div id="indemnity" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-yellow-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-shield-alt text-yellow-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">6. Indemnity</h2>
                                <p class="text-gray-600 text-sm sm:text-base">User responsibilities and indemnification terms</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                You agree and undertake to indemnify and keep indemnified GM(O)Pvt. Ltd, its affiliates, and any Apollo group companies, the concerned HSP, representatives, and each of their respective directors, officers or employees ("Indemnified Persons") and us for any losses, costs, charges, and expenses including reasonable attorney fees that the concerned Indemnified Persons may suffer on account of:
                            </p>

                            <div class="bg-red-50 rounded-lg p-4 sm:p-5 border border-red-200">
                                <h3 class="font-bold text-red-700 mb-3 text-base sm:text-lg">a. Service Related Issues</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-3">
                                    Deficiency or shortfall in Services/misdiagnosis / faulty judgment/interpretation errors/perception error arising from:
                                </p>
                                <ul class="list-decimal pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                    <li>your failure to provide correct and/or complete clinical information/history about the patient in a timely and clinically appropriate manner; or</li>
                                    <li>suppression of material facts; or your failure to provide relevant clinical information about the patient; or</li>
                                    <li>misinterpretation of the advice/prescription/diagnosis/investigation report by you; or</li>
                                    <li>failure to follow doctor's advice/prescription by you; or</li>
                                    <li>failure to follow instructions of the HSP in respect of the Services or medical procedures prescribed by the HSP by you;</li>
                                </ul>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-blue-700 mb-3 text-base sm:text-lg">b. Payment Related Issues</h3>
                                <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                    <li>incorrect or inaccurate credit/debit card details provided by you; or</li>
                                    <li>using a credit/debit card which is not lawfully owned by you; or</li>
                                </ul>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-yellow-700 mb-3 text-base sm:text-lg">c. Account Security</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    you permitting a third party to use your password or other means to access your account.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Limitation of Liability Section -->
                    <div id="liability" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-orange-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-orange-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">7. Limitation of Liability</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Our liability limitations and disclaimers</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                By using our Services, you confirm that You understand and agree to the following:
                            </p>

                            <div class="space-y-4">
                                <div class="bg-gray-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-gray-700 mb-2 text-sm sm:text-base">a. Service Provider Distinction</h3>
                                    <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                        The Services availed by you from an HSP via the Platform are provided to You by the HSP you select, and not by GM(O)Pvt. Ltd. The limitation of liability specified in this section also applies to any Services availed by You from any third-party seller of services listed on the Platform.
                                    </p>
                                </div>

                                <div class="bg-blue-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-blue-700 mb-2 text-sm sm:text-base">b. Platform Role</h3>
                                    <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                        The Platform only facilitates communications between You and the HSP and as such GM(O)PVT. LTD bears no responsibility for the quality and outcome of any such Services obtained by You from the respective HSP, to the extent permitted by applicable law.
                                    </p>
                                </div>

                                <div class="bg-yellow-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-yellow-700 mb-2 text-sm sm:text-base">c. Medical Services Disclaimer</h3>
                                    <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                        GM(O)PVT. LTD itself does not provide any medical consultation or diagnostic services. If You receive any medical advice/investigation reports from an HSP you have contacted through the Platform, You are responsible for assessing such advice, and reports the consequences of acting on such advice or reports, and all post-consultation follow-up action, including following the HSP's instructions. In the event that GM(O)PVT. LTD markets or promotes any Services to You, please note that such Services will be provided by the relevant HSP, and You are responsible for undertaking an assessment regarding the suitability of such Services and such HSPs for Your purposes. Marketing or promotion of Services should be considered as being for informational purposes only, and does not constitute expert advice on the suitability of such services for Your specific healthcare needs.
                                    </p>
                                </div>

                                <div class="bg-red-50 rounded-lg p-4 sm:p-5 border border-red-200">
                                    <h3 class="font-bold text-red-700 mb-2 text-sm sm:text-base">d. Consultation Limitations</h3>
                                    <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                        The Services provided through the Platform is not intended in any way to be a substitute for face to-face consultation with a doctor. GM(O)PVT. LTD advices the Users to make an independent assessment in respect of its accuracy or usefulness and suitability prior to making any decision in reliance hereof.
                                    </p>
                                </div>

                                <div class="bg-purple-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-purple-700 mb-2 text-sm sm:text-base">e. Damages Limitation</h3>
                                    <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                        To the extent permitted by applicable law, GM(O)PVT. LTD or its affiliates or any Apollo group companies will not be liable to You for any special, indirect, incidental, consequential, punitive, reliance, or exemplary damages arising out of or relating to: (i) these Terms of Use and Privacy Policy; (ii) Your use or inability to use the Platform; (iii) Your use or inability to use the AI assistant (iv) Your use of any third party services including Services provided by any HSP you contacted through the Platform.
                                    </p>
                                </div>
                            </div>

                            <div class="bg-gray-100 rounded-lg p-4 sm:p-5 border border-gray-300">
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed font-medium">
                                    This section shall survive the termination of this Agreement and the termination of Your use of our Services or the Platform.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 8. Platform Modification Section -->
                    <div id="platform-modification" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-indigo-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-tools text-indigo-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">8. Modification of the Platform</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Our rights to modify or discontinue services</p>
                            </div>
                        </div>
                        <div class="bg-indigo-50 rounded-lg p-4 sm:p-5">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                The Company reserves the right to modify or discontinue, temporarily or permanently, the Platform or any features or portions thereof without prior notice. The Users or any other Parties agree that the Company will not be liable for any modification, suspension or discontinuance of the Platform or any other part thereof.
                            </p>
                        </div>
                    </div>

                    <!-- 9. Data & Information Policy Section -->
                    <div id="data-policy" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-green-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-database text-green-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">9. Data & Information Policy</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Data privacy and account management</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <div class="bg-green-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-green-700 mb-2 text-sm sm:text-base">9.1 Privacy Rights</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    We respect your right to privacy in respect of any personal information provided to us for the purposes of availing our Services. To see how we collect and use your personal information, please see our Privacy Policy available at <a href="https://www.medbuzzy.com/privacy" class="text-brand-teal-600 hover:underline">https://www.medbuzzy.com/privacy</a>.
                                </p>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-blue-700 mb-3 text-sm sm:text-base">9.2 Account Deletion</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-3">
                                    Users have the right to delete their GM(O)PVT. LTD account and personal information at any time, in line with GM(O)PVT. LTD's commitment to data privacy and applicable laws. GM(O)PVT. LTD will delete the user's data, and no further communications will be sent. Deletion an account is permanent action and cannot be reversed. In case you want to use our Services again, you will need to create a new account which will have no previous order history.
                                </p>
                                <div class="bg-white rounded-lg p-3 border border-blue-200">
                                    <h4 class="font-semibold text-blue-700 mb-2">Account Deletion Steps:</h4>
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        "Go to My Account > Help/Need Help > Account & Health Records > I want to delete my account > My Issue is still not resolved > type "Delete my account" > raise an enquiry".
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 10. Intellectual Property Section -->
                    <div id="intellectual-property" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-purple-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-copyright text-purple-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">10. Intellectual Property and Ownership</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Rights and ownership of intellectual property</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <div class="bg-purple-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-purple-700 mb-2 text-sm sm:text-base">10.1 Company IP Rights</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    All Confidential Information, including the inherent intellectual properties ("IP") which has been developed by GM(O)PVT. LTD or its affiliates or by third parties under contract to GM(O)PVT. LTD to develop same or which has been purchased by or licensed to GM(O)PVT. LTD, remains the sole and exclusive property of GM(O)PVT. LTD.
                                </p>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-blue-700 mb-3 text-sm sm:text-base">10.2 User IP Obligations</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-3">
                                    You shall be bound by the following obligations with respect to ownership of Intellectual Properties:
                                </p>
                                <div class="space-y-3">
                                    <div class="bg-white rounded-lg p-3 border border-blue-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>(i)</strong> All works materials, software, documentation, methods, apparatus, systems and the like prepared, developed, conceived, or delivered as part of or in connection with the Services and all tangible embodiments thereof, shall be considered IP for any use of Our Platform under this Agreement.
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-blue-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>(ii)</strong> GM(O)PVT. LTD shall have exclusive title and ownership rights, including all intellectual property rights, throughout the world in all Services. To the extent that exclusive title and/or ownership rights may not originally vest in GM(O)PVT. LTD as contemplated herein, You hereby irrevocably assigns all right, title, and interest, including intellectual property and ownership rights, in the Services, medical records, and information to GM(O)PVT. LTD, and shall cause Your representatives to irrevocably assign to GM(O)PVT. LTD all such rights in the IP.
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-blue-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>(iii)</strong> All uses of any trademarks, service marks, and trade names in the Services or in the performance of the Services, and the goodwill associated therewith, whether by You or third parties, inures and shall inure to the benefit of GM(O)PVT. LTD.
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-blue-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>(iv)</strong> You agree not to circumvent, disable or otherwise interfere with security-related features of the Platform or features that prevent or restrict use or copying of any materials or enforce limitations on use of the Platform or the materials therein. The materials on the Platform or otherwise may not be modified, copied, reproduced, distributed, republished, downloaded, displayed, sold, compiled, posted or transmitted in any form or by any means, including but not limited to, electronic, mechanical, photocopying, recording or other means.
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-blue-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>(v)</strong> No use of these may be made without the prior written authorization of GM(O)PVT. LTD.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 11. Other Conditions Section -->
                    <div id="other-conditions" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-cyan-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-cogs text-cyan-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">11. Other Conditions</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Payment policies, AI assistant terms, and information accuracy</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <!-- Payment and Refund -->
                            <div class="bg-green-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-green-700 mb-2 text-sm sm:text-base">11.1 Payment and Refund</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    Please note that your payments are processed in accordance with applicable laws as amended from time to time and You may refer to our Payment and Refunds Policy for details, and such policy available at <a href="https://www.medbuzzy.com/refund-policy" class="text-brand-teal-600 hover:underline">https://www.medbuzzy.com/refund-policy</a>
                                </p>
                            </div>

                            <!-- AI Assistant -->
                            <div class="bg-blue-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-blue-700 mb-3 text-sm sm:text-base">11.2 AI Assistant</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-3">
                                    We use an AI Assistant to guide patients seeking medical help or treatment from the Platform. This AI Assistant's primary purpose is to allow users to book appointments by letting them enter their symptoms, medical conditions, or treatment that they are seeking to consult with an HSP. Further the AI tools developed and provided by GM(O)PVT. LTD are intended to support licensed HSP by offering diagnostic assistance, data analysis, and treatment recommendations of the case which they have full control over to use or discard based on their own assessment. These tools are designed to complement but not replace, the expertise, skill, knowledge, and judgment of HSP.
                                </p>
                                
                                <div class="bg-white rounded-lg p-3 border border-blue-200 mb-3">
                                    <h4 class="font-semibold text-blue-700 mb-2">You understand that:</h4>
                                    <ul class="list-roman pl-6 space-y-1 text-gray-700 text-sm">
                                        <li>You shall never use the AI assistant in a medical or psychiatric emergency;</li>
                                        <li>In case of an emergency, you should dial 112 or visit nearest Hospitals;</li>
                                        <li>You can use this Platform on behalf of other users (third parties) only if you are a legal guardian of such persons, meaning that you have the legal authority to care for the personal and property interests of such persons; and</li>
                                        <li>No content on the Platform, is or should be considered, or used as a substitute for, medical advice, care, diagnosis, or treatment.</li>
                                    </ul>
                                </div>

                                <div class="bg-white rounded-lg p-3 border border-blue-200">
                                    <h4 class="font-semibold text-blue-700 mb-2">Patient Support Escalation</h4>
                                    <p class="text-gray-700 text-sm leading-relaxed mb-2">
                                        The User may be directed to chat or call with our patient support team, in certain cases which include but are not limited to the following:
                                    </p>
                                    <ul class="list-roman pl-6 space-y-1 text-gray-700 text-sm">
                                        <li>Uncertain outcome from the AI assistant;</li>
                                        <li>Change in the schedule of appointments;</li>
                                        <li>Incomplete appointment booking;</li>
                                        <li>Any other case as deemed appropriate by GM(O)PVT. LTD.</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Accuracy of Information -->
                            <div class="bg-yellow-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-yellow-700 mb-3 text-sm sm:text-base">11.3 Accuracy of Information Displayed</h3>
                                <div class="space-y-3">
                                    <div class="bg-white rounded-lg p-3 border border-yellow-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>i.</strong> The AI algorithms are based on current medical research, data, and methodologies. However, due to the complexity of medical science and variability in individual cases, the outcomes generated by these tools may vary and are subject to inaccuracies.
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-yellow-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>ii.</strong> GM(O)PVT. LTD does not guarantee the precision, completeness, or usefulness of the information provided by the AI tools. Further the AI tools are not designed to replace professional(s) medical judgment and this may be used as one of multiple sources of information in the clinical decision-making process, you are advised to consult the HSP.
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-yellow-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>iii.</strong> We have made every effort to display, as accurately as possible, the information provided by the relevant third parties including HSPs. However, we do not undertake any liability in respect of such information and or with respect to any other information in regard to which you are capable of conducting Your own due diligence to ascertain accuracy.
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-yellow-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>iv.</strong> By using the AI tools provided by GM(O)PVT. LTD, you acknowledge that you have read, understood, and agreed to this disclaimer. You accept that these tools are designed to assist, not replace, clinical judgment and that GM(O)PVT. LTD is not liable for any decisions made based on the use of these tools
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 12. Miscellaneous Section -->
                    <div id="miscellaneous" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-gray-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-gavel text-gray-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">12. Miscellaneous</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Legal provisions and dispute resolution</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <!-- Third-Party Links -->
                            <div id="third-party-links" class="bg-blue-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-blue-700 mb-3 text-sm sm:text-base">12.1 Third-Party Links and Resources</h3>
                                <div class="space-y-3">
                                    <div class="bg-white rounded-lg p-3 border border-blue-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>a.</strong> Where the Platform contains links to other sites and resources provided by third parties (including where our social media sharing plug-ins include links to third-party sites), these links are provided for your information only. We have no control over the contents of those websites/platforms (including without limitation APL Platforms) or resources and accept no responsibility for them or for any loss or damage that may arise from your use of them.
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-blue-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>b.</strong> GM(O)PVT. LTD is neither guaranteeing nor making any representation with respect to the goods or services made available or sold by such third-party. GM(O)PVT. LTD does not provide any warranty or recommendation in relation to the products and/or services made available to you by such third parties during your access or use of such third-party website/platform including in relation to delivery, services, suitability, merchantability, reliability, availability or quality of the products and/or services.
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-blue-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>c.</strong> You shall not hold GM(O)PVT. LTD, its group entities, affiliates, or their respective directors, officers, employees, agents, and/or vendors responsible or liable for any actions, claims, demands, losses, damages, personal injury, costs, charges, and expenses which you claim to have suffered, sustained or incurred, or claim to suffer, sustain or incur, directly or indirectly, on account of your use or access of third party website/platform.
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-blue-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>d.</strong> GM(O)PVT. LTD is not a party to any contractual arrangements entered into between you and the third-party website/platform. We are not the agent of the third party and such third-party website/platform is governed exclusively by its respective policies over which GM(O)PVT. LTD has no control.
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-blue-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>e.</strong> The use of such a link to visit the third-party website/platform implies full acceptance of these Terms of Use. GM(O)PVT. LTD shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such content available on or through any such third-party linked website, including without limitation any form of transmission received from any third party website (including without limitation APL) or its server.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Amendments -->
                            <div id="amendments" class="bg-green-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-green-700 mb-2 text-sm sm:text-base">12.2 Amendments</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    We may from time to time update or revise these Terms of Use. Every time you wish to use the Platform, please check the relevant Terms of Use, Privacy Policy, Return Policy and Payment & Refund Policy to ensure you understand the terms that apply at that time.
                                </p>
                            </div>

                            <!-- Force Majeure -->
                            <div id="force-majeure" class="bg-orange-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-orange-700 mb-3 text-sm sm:text-base">12.3 Force Majeure</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-3">
                                    We will not be liable for any non-compliance or delay in compliance with any of the obligations we assume under any contract when caused by events that are beyond our reasonable control ("Force Majeure"). Force Majeure shall include any act, event, failure to exercise, omission or accident that is beyond our reasonable control, including, among others, the following:
                                </p>
                                <div class="bg-white rounded-lg p-3 border border-orange-200">
                                    <ul class="list-disc pl-6 space-y-1 text-gray-700 text-sm">
                                        <li>Strike, lockout or other forms of protest</li>
                                        <li>Civil unrest, revolt, invasion, terrorist attack or terrorist threat, war (declared or not) or threat or preparation for war.</li>
                                        <li>Fire, explosion, storm, flood, earthquake, collapse, epidemic or any other natural disaster.</li>
                                        <li>Inability to use public or private transportation and telecommunication systems.</li>
                                        <li>Acts, decrees, legislation, regulations or restrictions of any government or public authority including any judicial determination.</li>
                                    </ul>
                                </div>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed mt-3">
                                    Our obligations deriving from any contracts should be considered suspended during the period in which Force Majeure remains in effect and we will be given an extension of the period in which to fulfill these obligations by an amount of time we shall communicate to you, not being less than the time that the situation of Force Majeure lasted.
                                </p>
                            </div>

                            <!-- Termination -->
                            <div id="termination" class="bg-red-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-red-700 mb-3 text-sm sm:text-base">12.4 Termination</h3>
                                <div class="space-y-3">
                                    <div class="bg-white rounded-lg p-3 border border-red-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>12.4.1</strong> We may terminate this arrangement at any time, with or without cause. If you wish to terminate this arrangement, you may do so at any time by discontinuing your access or use of this Platform.
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-red-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>12.4.2</strong> We reserve the right to refuse the use of Services immediately in case your conduct is deemed by us to be in contravention of applicable acts, laws, rules, and regulations or these Terms of Use or considered to be unethical/immoral; and
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-red-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>12.4.3</strong> For change in law specifically, we reserve our rights to suspend our obligations under any contract indefinitely, and/or provide Services under revised Terms of Use.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Jurisdiction and Dispute Resolution -->
                            <div id="jurisdiction" class="bg-purple-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-purple-700 mb-3 text-sm sm:text-base">12.5 Applicable Laws, Jurisdiction, and Dispute Resolution</h3>
                                <div class="space-y-3">
                                    <div class="bg-white rounded-lg p-3 border border-purple-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>12.5.1</strong> The use of our Platform shall be governed by the laws applicable in India, without reference to the conflict of laws principles. Any dispute relating to the use of our Services shall be subject to the exclusive jurisdiction of the courts at Chennai, Tamil Nadu, India; and
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-purple-200">
                                        <p class="text-gray-700 text-sm leading-relaxed">
                                            <strong>12.5.2</strong> If any dispute, difference, or claim arises between Us and You in connection with this Terms of Use or the validity, interpretation, implementation, or alleged breach of this Agreement or anything is done, omitted to be done pursuant to this Terms of Use, You shall first endeavor to resolve the same through conciliation and negotiation. However, if the dispute is not resolved through conciliation and negotiation within 30 days after the commencement of such conciliation or within such period mutually agreed in writing, then We may refer the dispute for resolution by arbitration under the Indian Arbitration and Conciliation Act, 1996 as amended from time to time ("the Act") by a sole arbitrator to be appointed mutually by the Parties. In the event the Parties fail to agree on a sole arbitrator, a sole arbitrator shall be appointed in accordance with the Act. The seat and venue of arbitration will be in Chennai, Tamil Nadu. The Arbitration shall be conducted in the English language.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Severability -->
                            <div id="severability" class="bg-gray-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-gray-700 mb-2 text-sm sm:text-base">12.6 Severability</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    If, for any reason, a court of competent jurisdiction finds any provision of these Terms, or portion thereof, to be unenforceable, that provision shall be enforced to the maximum extent permissible so as to give effect to the intent of the Parties as reflected by that provision, and the remainder of the Terms shall continue in full force and effect.
                                </p>
                            </div>

                            <!-- Waiver -->
                            <div id="waiver" class="bg-yellow-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-yellow-700 mb-2 text-sm sm:text-base">12.7 Waiver</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    No provision of these Terms of Use shall be deemed to be waived and no breach excused, unless such waiver or consent shall be in writing and signed by GM(O)PVT. LTD. Any consent by GM(O)PVT. LTD to, or a waiver by GM(O)PVT. LTD of any breach by Other Parties, whether expressed or implied, shall not constitute consent to, waiver of, or excuse for any other different or subsequent breach
                                </p>
                            </div>

                            <!-- Contact and Grievance -->
                            <div id="grievance-contact" class="bg-brand-teal-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-brand-teal-700 mb-2 text-sm sm:text-base">12.8 Contact Us and Grievance Redressal Mechanism</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    In accordance with the Consumer Protection (E-Commerce) Rules, 2020 as amended from the time to time, the Company has designated a Grievance Officer who will be responsible for the Users grievance redressal. Please refer to the Contact & Grievance Redressal section above for complete details on how to reach our designated officers.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Section moved from above -->
                    <div class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-brand-teal-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-envelope text-brand-teal-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Contact & Grievance Redressal</h2>
                                <p class="text-gray-600 text-sm sm:text-base">How to reach us for support and grievances</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-brand-teal-700 mb-4 sm:mb-6">Grievance Officer</h3>
                                <div class="bg-brand-teal-50 rounded-xl p-4 sm:p-5">
                                    <div class="space-y-3">
                                        <div>
                                            <h4 class="font-semibold text-brand-teal-700 mb-2">Ms. Sonali Dhakre</h4>
                                            <p class="text-gray-700 text-sm">Doctor Consultation Bookings</p>
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-gray-700 text-sm sm:text-base flex items-center">
                                                <i class="fas fa-envelope text-brand-teal-600 mr-2 sm:mr-3 w-4 sm:w-5"></i>
                                                <a href="mailto:grievance@apollo247.org" class="hover:text-brand-teal-700 hover:underline">grievance@apollo247.org</a>
                                            </p>
                                            <p class="text-gray-700 text-sm sm:text-base flex items-center">
                                                <i class="fas fa-phone text-brand-teal-600 mr-2 sm:mr-3 w-4 sm:w-5"></i>
                                                <a href="tel:+918045050412" class="hover:text-brand-teal-700 hover:underline">080-45050412</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-brand-teal-700 mb-4 sm:mb-6">Grievance-cum-Nodal Officer</h3>
                                <div class="bg-gray-50 rounded-xl p-4 sm:p-5">
                                    <div class="space-y-3">
                                        <div>
                                            <h4 class="font-semibold text-gray-700 mb-2">Mr. Jehan Jit Singh</h4>
                                            <p class="text-gray-700 text-sm">Consumer Protection Act Compliance</p>
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-gray-700 text-sm sm:text-base flex items-center">
                                                <i class="fas fa-envelope text-brand-teal-600 mr-2 sm:mr-3 w-4 sm:w-5"></i>
                                                <a href="mailto:grievancemedbuzzy@gmail.com" class="hover:text-brand-teal-700 hover:underline">grievancemedbuzzy@gmail.com</a>
                                            </p>
                                            <p class="text-gray-700 text-sm sm:text-base flex items-center">
                                                <i class="fas fa-phone text-brand-teal-600 mr-2 sm:mr-3 w-4 sm:w-5"></i>
                                                <a href="tel:+914041894747" class="hover:text-brand-teal-700 hover:underline">040-41894747</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div class="bg-blue-50 rounded-xl p-4 sm:p-5 border border-blue-200">
                                <h4 class="font-bold text-blue-700 mb-2 text-sm sm:text-base">Response Timeline</h4>
                                <ul class="space-y-2 text-gray-700 text-sm sm:text-base">
                                    <li class="flex justify-between">
                                        <span>Acknowledgment:</span>
                                        <span class="font-medium">48 hours</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span>Resolution:</span>
                                        <span class="font-medium">1 month</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="bg-green-50 rounded-xl p-4 sm:p-5 border border-green-200">
                                <h4 class="font-bold text-green-700 mb-2 text-sm sm:text-base">Tracking System</h4>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    Each User who has filed a complaint with the Grievance Officer shall receive a ticket number for tracking the status of their complaint. The Grievance Officer will undertake best endeavors to redress the grievance of the User expeditiously but in any case, grievances will be addressed within 1 (one) month from the date of receipt of the grievance.
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 bg-yellow-50 rounded-xl p-4 sm:p-5 border border-yellow-200">
                            <h4 class="font-bold text-yellow-700 mb-2 text-sm sm:text-base">Legal Framework</h4>
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                In accordance with the Consumer Protection (E-Commerce) Rules, 2020 as amended from the time to time, the Company has designated a Grievance Officer who will be responsible for the Users grievance redressal. The Company has appointed a resident nodal person ("Grievance-cum-Nodal Officer") who shall be responsible for ensuring compliance with the provisions of the Consumer Protection Act, 2019 and the rules made thereunder.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Top Button -->
            <button id="back-to-top" class="back-to-top">
                <i class="fas fa-arrow-up text-sm sm:text-base"></i>
            </button>
        </div>

        <script>
            // Back to Top button functionality
            document.addEventListener('DOMContentLoaded', () => {
                const backToTopButton = document.getElementById('back-to-top');

                // Show/hide button based on scroll position
                window.addEventListener('scroll', () => {
                    const scrollY = window.scrollY || window.pageYOffset;
                    if (scrollY > 300) {
                        backToTopButton.classList.add('show');
                    } else {
                        backToTopButton.classList.remove('show');
                    }
                });

                // Smooth scroll to top on click
                backToTopButton.addEventListener('click', () => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });

                // Smooth scrolling for anchor links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', (e) => {
                        e.preventDefault();
                        const target = document.querySelector(anchor.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    });
                });
            });
        </script>
    </body>
</div>
