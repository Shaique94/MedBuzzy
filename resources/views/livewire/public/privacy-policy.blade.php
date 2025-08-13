<div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        .sticky-nav {
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .section-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .highlight {
            position: relative;
            z-index: 1;
        }

        .highlight::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 35%;
            background-color: rgba(249, 115, 22, 0.2);
            z-index: -1;
            transform: skewY(-1deg);
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
                    Medbuzzy Privacy Policy
                </h1>
                <p class="text-base sm:text-lg md:text-xl max-w-3xl mx-auto mb-6 sm:mb-8 leading-relaxed">
                    Last updated: August 1, 2025. Learn how we collect, use, and protect your personal information.
                </p>
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 py-8 sm:py-10 md:py-12">
            <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">
                <!-- Table of Contents -->
                <div class="lg:w-1/4">
                    <div class="bg-white rounded-xl shadow-lg p-5 sm:p-6 lg:sticky lg:top-6 max-h-[calc(100vh-8rem)] overflow-hidden">
                        <h3 class="text-lg sm:text-xl font-bold text-brand-blue-800 mb-4 pb-2 border-b border-gray-200">
                            Contents</h3>
                        <div class="overflow-y-auto max-h-[calc(100vh-12rem)] pr-2 scrollbar-thin scrollbar-thumb-brand-blue-300 scrollbar-track-gray-100">
                            <ul class="space-y-2 sm:space-y-3 text-sm sm:text-base">
                                <li><a wire:navigate href="#overview"
                                        class="toc-item block text-gray-700 hover:text-brand-orange-600">1. Overview</a>
                                </li>
                                <li><a wire:navigate href="#data-collection"
                                        class="toc-item block text-gray-700 hover:text-brand-orange-600">2. Personal Information</a>
                                </li>
                                <li><a wire:navigate href="#data-usage"
                                        class="toc-item block text-gray-700 hover:text-brand-orange-600">3. How We Use Data</a></li>
                                <li><a wire:navigate href="#data-retention"
                                        class="toc-item block text-gray-700 hover:text-brand-orange-600">4. Data Retention</a>
                                </li>
                                <li><a wire:navigate href="#data-sharing"
                                        class="toc-item block text-gray-700 hover:text-brand-orange-600">5. Data Sharing</a>
                                </li>
                                <li><a wire:navigate href="#security"
                                        class="toc-item block text-gray-700 hover:text-brand-orange-600">6. Data Protection</a></li>
                                <li><a wire:navigate href="#user-rights"
                                        class="toc-item block text-gray-700 hover:text-brand-orange-600">7. Your Rights</a>
                                </li>
                                <li><a wire:navigate href="#access-rights"
                                        class="toc-item block text-gray-700 hover:text-brand-orange-600 ml-4">• Access & Correction</a>
                                </li>
                                <li><a wire:navigate href="#consent-withdrawal"
                                        class="toc-item block text-gray-700 hover:text-brand-orange-600 ml-4">• Consent Withdrawal</a>
                                </li>
                                <li><a wire:navigate href="#account-deletion"
                                        class="toc-item block text-gray-700 hover:text-brand-orange-600 ml-4">• Account Deletion</a>
                                </li>
                                <li><a wire:navigate href="#third-party"
                                        class="toc-item block text-gray-700 hover:text-brand-orange-600">8. Third-Party Services</a></li>
                                <li><a wire:navigate href="#google-api"
                                        class="toc-item block text-gray-700 hover:text-brand-orange-600">9. Google API Policy</a></li>
                                <li><a wire:navigate href="#policy-changes"
                                        class="toc-item block text-gray-700 hover:text-brand-orange-600">10. Policy Changes</a></li>
                                <li><a wire:navigate href="#contact"
                                        class="toc-item block text-gray-700 hover:text-brand-orange-600">11. Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:w-3/4">
                    <!-- Overview -->
                    <div id="overview" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-center mb-4 sm:mb-6">
                            <div class="bg-brand-blue-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-shield-alt text-brand-blue-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Privacy Overview</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Our commitment to protecting your privacy</p>
                            </div>
                        </div>
                        <p class="text-gray-700 text-sm sm:text-base mb-4 leading-relaxed">
                            This Privacy Policy outlines how GAURIRAM MEDBUZZY (OPC) PRIVATE LIMITED, a business duly incorporated under the Companies Act, 2013, with its registered office at Gurudwara Road, Bhatta Bazar, Purnia-854301 Bihar, India (collectively, "GM(O)Pvt. Ltd", "Medbuzzy", "Company", "we," "us", or "our"), gathers, uses, shares, and processes the information you give us when using the Medbuzzy app and website to access our services.
                        </p>
                        <p class="text-gray-700 text-sm sm:text-base mb-4 leading-relaxed">
                            Regarding data collection, processing, and transfer, GM(O)Pvt. Ltd, the owner of the Medbuzzy website and app, honors your privacy and works to adhere to all relevant legal requirements, such as the Information Technology Act of 2000 and the Information Technology (Reasonable Security Practices and Procedures and Sensitive Personal Information) Rules, 2011 (the "SPDI Rules"), as amended from time to time.
                        </p>
                        <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200 mt-4">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                <strong>Important:</strong> Please carefully read our privacy statement. By visiting or using this website or app, you accept the conditions stated above and all other terms included by reference. Do not use this website or app if you disagree with any of these terms.
                            </p>
                        </div>
                    </div>

                    <!-- Data Collection Section -->
                    <div id="data-collection"
                        class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-brand-blue-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-clipboard-list text-brand-blue-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">1. What is Personal Information</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Definition and types of information we collect</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <div class="bg-blue-50 rounded-lg p-4 sm:p-5">
                                <h3 class="text-lg font-semibold text-blue-700 mb-2 sm:mb-3">A) Personal Information Definition</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    Any information that may be used to directly or indirectly identify you is considered personal information. It contains de-identified information that would allow us to identify you when combined with other data we have. Even when combined with additional information, data that has been irrevocably anonymized or aggregated so that we are unable to identify you is not considered personal data.
                                </p>
                            </div>
                            
                            <div class="bg-red-50 rounded-lg p-4 sm:p-5">
                                <h3 class="text-lg font-semibold text-red-700 mb-2 sm:mb-3">B) Sensitive Personal Data</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-3">
                                    "Sensitive Personal Data or Information" refers to any personal information about an individual that is provided to or received by us for processing or storage, including:
                                </p>
                                <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                    <li>Health information like medical records and history</li>
                                    <li>Biometric information</li>
                                    <li>Financial information like bank account, credit card, debit card, or other payment instrument details</li>
                                    <li>Sexual orientation</li>
                                    <li>Physical, physiological, and mental health conditions</li>
                                    <li>Passwords</li>
                                </ul>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed mt-3">
                                    <strong>Note:</strong> Sensitive personal data does not include any information that is publicly available or accessible or provided in accordance with the Right to Information Act of 2005 or any other law.
                                </p>
                            </div>

                            <div class="bg-green-50 rounded-lg p-4 sm:p-5">
                                <h3 class="text-lg font-semibold text-green-700 mb-2 sm:mb-3">C) Your Consent</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    By registering on the App, visiting the Website, and/or using our services, you attest that you willingly give us personal information, including financial and medical data, and that you agree to its collection, use, and dissemination in line with this privacy statement. Additionally, you affirm that any third person (such as a child or an employee) whose information you provide to us has given you the proper authorization. We will operate in accordance with your representation of authority and won't do any independent research to confirm the authenticity of your consent.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Types of Data We Collect -->
                    <div class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-brand-orange-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-database text-brand-orange-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">2. What Types of Data Do We Collect</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Information we gather when you use our services</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <div class="bg-yellow-50 rounded-lg p-4 sm:p-5 border border-yellow-200">
                                <h3 class="font-bold text-yellow-700 mb-2 text-sm sm:text-base">Cookies Notice</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    Like many other websites, our website/app makes use of "cookies." Cookies are little data files that are stored in your browser by websites. These are used to monitor and profile your behavior on our website, store your preferences, and store your past browsing activity. You fully consent to the installation of cookies on your web browser by using the app or website. We advise you to periodically delete the cookies that are stored in your browser.
                                </p>
                            </div>

                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                We will gather the following kinds of information when you register or sign up on the App or Website to use our services, as well as when you actually use our services:
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                                <div class="bg-brand-blue-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-brand-blue-700 mb-2 text-sm sm:text-base">Contact Information</h3>
                                    <ul class="list-disc pl-6 space-y-1 text-gray-700 text-sm sm:text-base">
                                        <li>Name</li>
                                        <li>Address</li>
                                        <li>Contact details</li>
                                        <li>Email ID</li>
                                        <li>Phone Number</li>
                                    </ul>
                                </div>
                                <div class="bg-brand-orange-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-brand-orange-700 mb-2 text-sm sm:text-base">Demographic Information</h3>
                                    <ul class="list-disc pl-6 space-y-1 text-gray-700 text-sm sm:text-base">
                                        <li>Gender</li>
                                        <li>Date of Birth</li>
                                        <li>Nationality</li>
                                    </ul>
                                </div>
                                <div class="bg-purple-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-purple-700 mb-2 text-sm sm:text-base">Technical Information</h3>
                                    <ul class="list-disc pl-6 space-y-1 text-gray-700 text-sm sm:text-base">
                                        <li>Browsing history</li>
                                        <li>URL of visited sites</li>
                                        <li>IP address</li>
                                        <li>Operating system</li>
                                        <li>Web browser type</li>
                                        <li>ISP information</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Where We Collect Data -->
                    <div class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-green-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-green-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">3. Where Do We Collect Your Data From</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Sources of your information</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <div class="bg-blue-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-blue-700 mb-2 text-sm sm:text-base">For End Users:</h3>
                                <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                    <li>Any information you voluntarily decide to give us via the website, app, email, chat, phone, or other means of communication</li>
                                    <li>Data that we get from healthcare service providers ("HSPs") in the Medbuzzy Group, including physicians, hospitals, diagnostic facilities, chemists, etc., to whom you have given permission to share your personal data</li>
                                    <li>Information that you have supplied to any of the company's group companies, affiliates, associates, subsidiaries, holding companies, and associates and subsidiaries of holding companies, to whom you have granted permission to share such information</li>
                                </ul>
                            </div>

                            <div class="bg-green-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-green-700 mb-2 text-sm sm:text-base">For Doctors:</h3>
                                <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                    <li>We may ask for details about your credentials, experience, public profile, and statements you have made to us before onboarding you</li>
                                    <li>We could gather data about how you utilize the services when using the app or website</li>
                                    <li>We might also gather additional information that you voluntarily choose to give us via the App, Website, email, phone conversations, chat, and other channels of communication</li>
                                    <li>We might gather information from any group company, affiliates, associates, subsidiary, holding company, or holding company of the company to which you have granted permission to share information in order to receive value-added services</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Data Usage Section -->
                    <div id="data-usage"
                        class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-brand-orange-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-cogs text-brand-orange-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">4. How Do We Use Your Data</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Purposes for processing your information</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                We use your personal information except information received from Google APIs for purposes that include the following:
                            </p>

                            <!-- General Users and Doctors -->
                            <div class="bg-brand-blue-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-brand-blue-700 mb-3 text-base sm:text-lg">4.1. General (End Users and Doctors)</h3>
                                <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                    <li>Your registration to receive our services, identify you, communicate with you, notify you, and fulfill the terms of use</li>
                                    <li>To provide you with tailored health insights and personalized services, including targeted advertisements for different wellness and healthcare plans</li>
                                    <li>Responding to your requests, questions, and grievances, if any, regarding our services; collecting feedback; helping you with transactions or other problems with the usage of services; and doing other tasks associated with customer care</li>
                                    <li>Making use of Medbuzzy Group firms' services and tailoring recommendations for suitable medical goods and services</li>
                                    <li>Developing insights for Medbuzzy Group firms' marketing activities and corporate/business strategy</li>
                                    <li>Creating machine learning tools and algorithms to enhance service targeting, treatment and diagnostic procedures, and other goods and services</li>
                                    <li>Reaching out to you with information about new services, features, goods, exclusive deals, and promotions from the Medbuzzy Group, its affiliates, and third-party companies that we have partnerships with and that are pertinent to using the Services</li>
                                    <li>Website technical management and customization, as well as other general administrative and commercial objectives</li>
                                    <li>Research (internal or external), fraud, security, risk management, and analysis for the creation and enhancement of goods and services, such as card networks' and payment aggregators' tokenization services, in accordance with card network regulations</li>
                                    <li>Disclosure as mandated by relevant law to government authorities</li>
                                    <li>Fulfilling our responsibilities under any agreements we have with affiliate companies, Medbuzzy group companies, our business partners, or contractors, including but not limited to offering tokenization services to Payment Aggregators, Card Networks, and Card Issuers globally as needed to accomplish the tokenization services or to comply with applicable laws, regulations, or investigations</li>
                                    <li>Investigating, enforcing, and resolving any disputes or grievances</li>
                                    <li>Publishing the data on the medbuzzy Website</li>
                                    <li>Any other purpose required by applicable law</li>
                                </ul>
                            </div>

                            <!-- End Users Only -->
                            <div class="bg-brand-orange-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-brand-orange-700 mb-3 text-base sm:text-lg">4.2. For End Users Only</h3>
                                <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                    <li>Creating and keeping up-to-date electronic health records in the Personal Health Record (PHR) database so that we and the Apollo group firms, affiliates, etc., may utilize them to offer pertinent services</li>
                                    <li>Construct your unified profile using the insights and analytics produced by processing your personal data</li>
                                    <li>To share with your selected Apollo Group HSP, including as physicians, hospitals, diagnostic facilities, and pharmacists, who could offer you services through the app or website</li>
                                    <li>Fulfilling any requests or orders you might make through our services</li>
                                </ul>
                            </div>

                            <!-- Doctors Only -->
                            <div class="bg-green-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-green-700 mb-3 text-base sm:text-lg">4.3. For Doctors Only</h3>
                                <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm sm:text-base">
                                    <li>For verifying your professional credentials and any representations you have made to us</li>
                                    <li>For processing any payments made to you</li>
                                    <li>For providing recommendations to end users based on your expertise and specializations</li>
                                    <li>For providing any other service to you</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Data Retention Section -->
                    <div id="data-retention"
                        class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-purple-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-clock text-purple-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">5. How Long Will We Retain Your Data</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Data retention policies and timeframes</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <div class="bg-purple-50 rounded-lg p-4 sm:p-5">
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    We maintain your data for as long as it takes to deliver our services to you or as required by law, maintaining your personal information in compliance with relevant regulations. Your personal information will only be kept for legitimate purposes. For a longer time, we retain de-identified data for statistical and research reasons.
                                </p>
                            </div>
                            
                            <div class="bg-yellow-50 rounded-lg p-4 sm:p-5 border border-yellow-200">
                                <h3 class="font-bold text-yellow-700 mb-2 text-sm sm:text-base">Account Termination</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    We are under no duty to keep your data after you end your account, and we are free to remove some or all of it without incurring any fees. However, if we think it would be important to stop fraud or potential misuse, if the law requires it, or for other justifiable reasons, we might keep your data. Anonymized or de-identified data may still be kept by us for analysis, research, or other uses for which your information was originally gathered.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Sharing Section -->
                    <div id="data-sharing"
                        class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-yellow-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-share-alt text-yellow-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">6. Disclosure and Transfer of Your Data</h2>
                                <p class="text-gray-600 text-sm sm:text-base">When and how we share your information</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                To the extent allowed by applicable law, we may share, disclose, and in certain situations transfer your personal information—apart from information obtained from Google APIs—with the organizations needed to deliver services to you, enhance our services, and offer value-added services or other third-party goods and services. You hereby agree that these entities may be based outside of India. We demand that these organizations use the same security procedures that we would use to safeguard your information.
                            </p>

                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                Below is an illustrative list of companies to which we may disclose or transfer information, with the exception of information obtained through Google APIs:
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                                <div class="bg-blue-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-blue-700 mb-2 text-sm sm:text-base">Service Providers</h3>
                                    <p class="text-gray-700 text-sm sm:text-base">Organizations that help us operate our platform and deliver services to you.</p>
                                </div>
                                <div class="bg-green-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-green-700 mb-2 text-sm sm:text-base">Business Affiliates</h3>
                                    <p class="text-gray-700 text-sm sm:text-base">Our group companies, subsidiaries, and business partners.</p>
                                </div>
                                <div class="bg-red-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-red-700 mb-2 text-sm sm:text-base">Law Enforcement Agencies</h3>
                                    <p class="text-gray-700 text-sm sm:text-base">When required by law or to protect rights and safety.</p>
                                </div>
                                <div class="bg-purple-50 rounded-lg p-4 sm:p-5">
                                    <h3 class="font-bold text-purple-700 mb-2 text-sm sm:text-base">Other Third Parties</h3>
                                    <p class="text-gray-700 text-sm sm:text-base">As necessary for business operations and service delivery.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                                      <!-- Security Section -->
                    <div id="security"
                        class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-red-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-shield-virus text-red-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">7. How Do We Protect Your Data</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Our security measures and your role</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <div class="bg-green-50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-bold text-green-700 mb-2 text-sm sm:text-base">Our Security Commitment</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-3">
                                    In order to secure the Website and the information you submit or upload, we are dedicated to protecting the privacy of the data you put on it and adhering to industry-standard security measures.
                                </p>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    To protect all of the information you give us, we employ appropriate administrative, technical, and physical security measures. Additionally, we have thorough internal measures in place to guard against unwanted access to your information. We take the necessary precautions to guarantee that third parties with which we exchange data implement appropriate security standards and processes to protect the confidentiality and integrity of your data.
                                </p>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-4 sm:p-5 border border-yellow-200">
                                <h3 class="font-bold text-yellow-700 mb-2 text-sm sm:text-base">Limitation of Liability</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    Nevertheless, unless it is a direct and predictable result of our own carelessness and noncompliance, we disclaim all liability for any loss, illegal access, safety concern, or injury brought on by any abuse of your personal information. By signing this, you agree that we are not liable for any actions taken by third parties or by you that result in hurt, loss, or damage to you or anyone else.
                                </p>
                            </div>

                            <div class="bg-red-50 rounded-lg p-4 sm:p-5 border border-red-200">
                                <h3 class="font-bold text-red-700 mb-2 text-sm sm:text-base">Your Responsibility</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    The company will not be responsible for any losses you may sustain if your electronic equipment, via which you use our services, are accessed without authorization and cause data loss or theft. In accordance with the Terms of Use, you are also responsible for compensating the company.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- User Rights Section -->
                    <div id="user-rights"
                        class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-brand-orange-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-user-lock text-brand-orange-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">8. What Are Your Rights</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Your rights regarding personal information</p>
                            </div>
                        </div>
                        <div class="space-y-4 sm:space-y-6">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                We take appropriate measures to guarantee the accuracy, completeness, and timeliness of your personal data. However, it is entirely your duty to check the authenticity of the information you have supplied and get in touch with us if there are any inconsistencies or if you want to stop using our services. When it comes to your personal data, you have the following rights:
                            </p>

                            <div class="bg-blue-50 rounded-lg p-4 sm:p-5">
                                <h3 id="access-rights" class="font-bold text-blue-700 mb-2 text-sm sm:text-base">a) Access, Update and Correction Rights</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-3">
                                    You have the right to access your personal information, request updation, correction, and deletion. If your personal information changes, you may correct, delete inaccuracies, or amend information by making the change on our member information page or by contacting us through <a wire:navigate href="mailto:helpdeskmedbuzzy@gmail.com" class="text-blue-600 hover:underline">helpdeskmedbuzzy@gmail.com</a>.
                                </p>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    We will make good faith efforts to make requested changes in our then active databases as soon as reasonably practicable. If you provide any information that is untrue, inaccurate, out of date, or incomplete (or subsequently becomes untrue, inaccurate, out of date or incomplete), or we have reasonable grounds to suspect that the information provided by you is untrue, inaccurate, out of date or incomplete, we may, at our sole discretion, discontinue the provision of the Services to you.
                                </p>
                            </div>

                            <div class="bg-green-50 rounded-lg p-4 sm:p-5">
                                <h3 id="consent-withdrawal" class="font-bold text-green-700 mb-2 text-sm sm:text-base">b) Consent Withdrawal</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    You are free not to share any medical or other information that you consider confidential and withdraw consent for us to use data that you have already provided. In the event that you refuse to share any information or withdraw consent to process information that you have previously given to us, we reserve the right to restrict or deny the provision of our Services for which we consider such information to be necessary.
                                </p>
                            </div>

                            <div class="bg-red-50 rounded-lg p-4 sm:p-5">
                                <h3 id="account-deletion" class="font-bold text-red-700 mb-2 text-sm sm:text-base">c) Account Deletion</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-3">
                                    Users have the right to delete their Medbuzzy account and personal information at any time, in line with Medbuzzy commitment to data privacy and applicable laws. Medbuzzy will delete the user's data, and no further communications will be sent. Deletion an account is permanent action and cannot be reversed. In case you want to use our Services again, you will need to create a new account which will have no previous order history.
                                </p>
                                <div class="bg-white rounded-lg p-3 border border-red-200">
                                    <h4 class="font-semibold text-red-700 mb-2">Steps to delete your account:</h4>
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        "Go to My Account > Help/Need Help > Account & Health Records > I want to delete my account > My Issue is still not resolved > type "Delete my account" > raise an enquiry"
                                    </p>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-4 sm:p-5 border border-yellow-200">
                                <h3 class="font-bold text-yellow-700 mb-2 text-sm sm:text-base">d) Grievance Resolution</h3>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    In case of grievance is in relation to Information Technology (Intermediary Guidelines and Digital Media Ethics Code) Rules, 2021, we shall acknowledge your complaint within twenty-four hours and dispose of such the complaint within a period of fifteen days from the date of its receipt. Disposal of complaint shall include all actions as considered necessary by the Company.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Third Party Websites -->
                    <div id="third-party" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-purple-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-external-link-alt text-purple-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">9. Third-Party Websites and Services</h2>
                                <p class="text-gray-600 text-sm sm:text-base">External links and services</p>
                            </div>
                        </div>
                        <div class="bg-purple-50 rounded-lg p-4 sm:p-5">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                Our Website and App may contain links to third-party services, and give you the ability to access such third-party websites, products, and services. Please note that you may proceed to the use of such third-party websites or services at your own risk and the Company will not be held liable for any outcome or harm arising as a result of your use of such third-party websites or services. Please read the privacy policies of any third party before proceeding to use their websites, products, or services.
                            </p>
                        </div>
                    </div>

                    <!-- Google API Compliance -->
                    <div id="google-api" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-blue-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fab fa-google text-blue-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">10. Compliance with Google User Data Policy</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Our commitment to Google API policies</p>
                            </div>
                        </div>
                        <div class="bg-blue-50 rounded-lg p-4 sm:p-5">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                GM(O)Pvt. Ltd use of information received from Google APIs will adhere to Google API Services User Data Policy including the Limited Use requirements and Limited Use Requirements shall apply to both raw data obtained from Restricted and Sensitive Scopes and data aggregated, anonymized, or otherwise derived from that raw data. Google API Services User Data Policy is available at <a wire:navigate href="https://developers.google.com/terms/api-services-user-data-policy" class="text-blue-600 hover:underline" target="_blank">Google API Services User Data Policy | Google for Developers</a>
                            </p>
                        </div>
                    </div>

                    <!-- Policy Changes -->
                    <div id="policy-changes" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-orange-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-edit text-orange-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">11. Changes to This Privacy Policy</h2>
                                <p class="text-gray-600 text-sm sm:text-base">How we handle policy updates</p>
                            </div>
                        </div>
                        <div class="bg-orange-50 rounded-lg p-4 sm:p-5">
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                Any changes to our Privacy Policy will be posted on the Website/App and will become effective as of the date of posting. Please review the Privacy Policy from time to time to make sure you are aware of any changes. If you do not agree with any such revised terms, please refrain from using our Services and contact us to close any account you may have created.
                            </p>
                        </div>
                    </div>

                  

                    <!-- Contact Section -->
                    <div id="contact" class="section-card bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 mb-6 sm:mb-8">
                        <div class="flex items-start mb-4 sm:mb-6">
                            <div class="bg-brand-blue-100 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-envelope text-brand-blue-600 text-lg sm:text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Contact Us About Privacy</h2>
                                <p class="text-gray-600 text-sm sm:text-base">Questions about our privacy practices</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-brand-blue-700 mb-4 sm:mb-6">Privacy Contact Information</h3>
                                <div class="bg-brand-blue-50 rounded-xl p-4 sm:p-5">
                                    <div class="space-y-3">
                                        <div>
                                            <h4 class="font-semibold text-brand-blue-700 mb-2">GAURIRAM MEDBUZZY (OPC) PRIVATE LIMITED</h4>
                                            <p class="text-gray-700 text-sm">Registered Office</p>
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-gray-700 text-sm sm:text-base flex items-center">
                                                <i class="fas fa-envelope text-brand-blue-600 mr-2 sm:mr-3 w-4 sm:w-5"></i>
                                                <a wire:navigate href="mailto:helpdeskmedbuzzy@gmail.com" class="hover:text-brand-blue-700 hover:underline">helpdeskmedbuzzy@gmail.com</a>
                                            </p>
                                            <p class="text-gray-700 text-sm sm:text-base flex items-center">
                                                <i class="fas fa-phone text-brand-blue-600 mr-2 sm:mr-3 w-4 sm:w-5"></i>
                                                <a wire:navigate href="tel:+919430808079" class="hover:text-brand-blue-700 hover:underline">+91 9430808079</a>
                                            </p>
                                            <p class="text-gray-700 text-sm sm:text-base flex items-start">
                                                <i class="fas fa-map-marker-alt text-brand-blue-600 mr-2 sm:mr-3 w-4 sm:w-5 mt-1"></i>
                                                <span>Gurudwara Road, Bhatta Bazar, Purnia-854301, Bihar, India</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-brand-blue-700 mb-4 sm:mb-6">Privacy Support</h3>
                                <div class="bg-gray-50 rounded-xl p-4 sm:p-5">
                                    <ul class="space-y-3 text-gray-700 text-sm sm:text-base">
                                        <li class="flex justify-between">
                                            <span>Privacy inquiries:</span>
                                            <span class="font-medium">24 hours</span>
                                        </li>
                                        <li class="flex justify-between">
                                            <span>Data access requests:</span>
                                            <span class="font-medium">5-10 days</span>
                                        </li>
                                        <li class="flex justify-between">
                                            <span>Account deletion:</span>
                                            <span class="font-medium">15 days</span>
                                        </li>
                                        <li class="flex justify-between">
                                            <span>Grievance resolution:</span>
                                            <span class="font-medium">15 days</span>
                                        </li>
                                    </ul>
                                    <div class="mt-4 pt-3 border-t border-gray-200">
                                        <p class="text-xs sm:text-sm text-gray-600">
                                            <i class="fas fa-info-circle text-brand-orange-500 mr-2"></i>
                                            For urgent matters, please call our support line directly
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="mt-4 bg-blue-50 rounded-xl p-4 sm:p-5 border border-blue-200">
                                    <h4 class="font-bold text-blue-700 mb-2 text-sm sm:text-base">Legal Compliance</h4>
                                    <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                        We comply with the Information Technology Act of 2000 and the Information Technology (Reasonable Security Practices and Procedures and Sensitive Personal Information) Rules, 2011, as amended from time to time.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Top Button -->
        <button id="back-to-top" class="back-to-top">
            <i class="fas fa-arrow-up text-sm sm:text-base"></i>
        </button>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const backToTopButton = document.getElementById('back-to-top');

                window.addEventListener('scroll', () => {
                    const scrollY = window.scrollY || window.pageYOffset;
                    if (scrollY > 300) {
                        backToTopButton.classList.add('show');
                    } else {
                        backToTopButton.classList.remove('show');
                    }
                });

                backToTopButton.addEventListener('click', () => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });

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
