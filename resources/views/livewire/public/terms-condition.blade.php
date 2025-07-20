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
            bottom: 2rem;
            right: 2rem;
            z-index: 40;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }
        .back-to-top.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    

    <!-- Hero Section -->
    <div class="bg-teal-700 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Medbuzzy Terms & Conditions</h1>
            <p class="text-xl max-w-3xl mx-auto mb-8">
                Last updated: July 18, 2025. Please read these Terms of Service carefully before using our platform.
            </p>
            <div class="flex justify-center space-x-4">
                <button id="download-pdf" class="bg-white text-brand-teal-700 hover:bg-gray-100 font-bold px-6 py-3 rounded-lg flex items-center">
                    <i class="fas fa-download mr-2"></i> Download PDF
                </button>
                <button class="bg-brand-orange-500 hover:bg-brand-orange-600 text-white font-bold px-6 py-3 rounded-lg flex items-center">
                    <i class="fas fa-print mr-2"></i> Print Version
                </button>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Table of Contents -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-[20px]">
                    <h3 class="text-xl font-bold text-brand-teal-800 mb-4 pb-2 border-b border-gray-200">Contents</h3>
                    <ul class="space-y-3">
                        <li><a href="#privacy-policy" class="toc-item block text-gray-700 hover:text-brand-orange-600">Privacy Policy</a></li>
                        <li><a href="#terms-of-use" class="toc-item block text-gray-700 hover:text-brand-orange-600">Terms of Use</a></li>
                        <li><a href="#data-collection" class="toc-item block text-gray-700 hover:text-brand-orange-600">Data Collection</a></li>
                        <li><a href="#data-usage" class="toc-item block text-gray-700 hover:text-brand-orange-600">Data Usage</a></li>
                        <li><a href="#data-retention" class="toc-item block text-gray-700 hover:text-brand-orange-600">Data Retention</a></li>
                        <li><a href="#user-rights" class="toc-item block text-gray-700 hover:text-brand-orange-600">User Rights</a></li>
                        <li><a href="#ai-assistant" class="toc-item block text-gray-700 hover:text-brand-orange-600">AI Assistant</a></li>
                        <li><a href="#liability" class="toc-item block text-gray-700 hover:text-brand-orange-600">Liability</a></li>
                        <li><a href="#contact" class="toc-item block text-gray-700 hover:text-brand-orange-600">Contact & Support</a></li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:w-3/4">
                <!-- Introduction -->
                <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                    <div class="flex items-center mb-6">
                        <div class="bg-brand-teal-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-file-contract text-brand-teal-600 text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Understanding Our Terms</h2>
                            <p class="text-gray-600">Your agreement with Medbuzzy Healthcare Services</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-700 mb-4">
                        Welcome to Medbuzzy! These Terms of Service govern your use of our website, mobile applications, 
                        and services. By accessing or using our platform, you agree to be bound by these Terms and our Privacy Policy.
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div class="bg-brand-teal-50 rounded-lg p-4 border border-brand-teal-200">
                            <div class="text-brand-teal-600 mb-2">
                                <i class="fas fa-user-shield text-xl"></i>
                            </div>
                            <h3 class="font-bold text-brand-teal-800 mb-1">Your Privacy</h3>
                            <p class="text-sm text-gray-700">We prioritize the security of your personal health data</p>
                        </div>
                        <div class="bg-brand-orange-50 rounded-lg p-4 border border-brand-orange-200">
                            <div class="text-brand-orange-600 mb-2">
                                <i class="fas fa-stethoscope text-xl"></i>
                            </div>
                            <h3 class="font-bold text-brand-orange-800 mb-1">Medical Services</h3>
                            <p class="text-sm text-gray-700">Understanding our role in connecting you with healthcare providers</p>
                        </div>
                        <div class="bg-gray-100 rounded-lg p-4 border border-gray-200">
                            <div class="text-gray-600 mb-2">
                                <i class="fas fa-robot text-xl"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 mb-1">AI Assistant</h3>
                            <p class="text-sm text-gray-700">How our AI technology supports but doesn't replace medical professionals</p>
                        </div>
                    </div>
                </div>

                <!-- Privacy Policy Section -->
                <div id="privacy-policy" class="section-card bg-white rounded-xl shadow-md p-8 mb-8">
                    <div class="flex items-start mb-6">
                        <div class="bg-brand-teal-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-shield-alt text-brand-teal-600 text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Privacy Policy</h2>
                            <p class="text-gray-600">How we collect, use, and protect your information</p>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-semibold text-brand-teal-700 mb-3">1. What is Personal Information</h3>
                            <p class="text-gray-700 mb-3">
                                Personal information is any data that can directly or indirectly identify you. This includes:
                            </p>
                            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                                <li>Contact details (name, address, email, phone)</li>
                                <li>Demographic information (gender, date of birth)</li>
                                <li>Health information (medical records, history)</li>
                                <li>Financial information (payment details)</li>
                                <li>Browsing history and technical data</li>
                            </ul>
                        </div>
                        
                        <div>
                            <h3 class="text-xl font-semibold text-brand-teal-700 mb-3">2. Data Collection Sources</h3>
                            <div class="bg-brand-teal-50 rounded-lg p-5 mb-4">
                                <h4 class="font-bold text-brand-teal-700 mb-2">For Patients:</h4>
                                <ul class="list-disc pl-6 space-y-1 text-gray-700">
                                    <li>Information you voluntarily provide</li>
                                    <li>Data from healthcare providers with your consent</li>
                                    <li>Information from Medbuzzy Group companies</li>
                                </ul>
                            </div>
                            <div class="bg-brand-orange-50 rounded-lg p-5">
                                <h4 class="font-bold text-brand-orange-700 mb-2">For Doctors:</h4>
                                <ul class="list-disc pl-6 space-y-1 text-gray-700">
                                    <li>Professional credentials and experience</li>
                                    <li>Service usage data</li>
                                    <li>Voluntarily provided information</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms of Use Section -->
                <div id="terms-of-use" class="section-card bg-white rounded-xl shadow-md p-8 mb-8">
                    <div class="flex items-start mb-6">
                        <div class="bg-brand-orange-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-file-signature text-brand-orange-600 text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Terms of Use</h2>
                            <p class="text-gray-600">Rules for accessing and using our services</p>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-semibold text-brand-orange-700 mb-3">Eligibility Requirements</h3>
                            <p class="text-gray-700 mb-4">
                                To use Medbuzzy services, you must meet the following criteria:
                            </p>
                            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                                <li>Be at least 18 years old</li>
                                <li>Be legally competent to enter into contracts</li>
                                <li>Not have been previously suspended from our services</li>
                                <li>Provide accurate and truthful information</li>
                                <li>Maintain the security of your account credentials</li>
                            </ul>
                        </div>
                        
                        <div>
                            <h3 class="text-xl font-semibold text-brand-orange-700 mb-3">Prohibited Activities</h3>
                            <div class="border-l-4 border-brand-orange-500 pl-4 py-1 mb-4">
                                <p class="text-gray-700 italic">
                                    You may not use our platform for any unlawful activities or in ways that could harm the service.
                                </p>
                            </div>
                            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                                <li>Reverse-engineer or decompile our platform</li>
                                <li>Impersonate others or misrepresent your identity</li>
                                <li>Upload prohibited content (harassing, illegal, etc.)</li>
                                <li>Contact healthcare providers outside authorized channels</li>
                                <li>Use the platform for commercial purposes without authorization</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Data Usage Section -->
                <div id="data-usage" class="section-card bg-white rounded-xl shadow-md p-8 mb-8">
                    <div class="flex items-start mb-6">
                        <div class="bg-brand-teal-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-database text-brand-teal-600 text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">How We Use Your Data</h2>
                            <p class="text-gray-600">Purposes for processing your information</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-brand-teal-50 rounded-lg p-5">
                            <h3 class="font-bold text-brand-teal-700 mb-2">For All Users</h3>
                            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                                <li>Account registration and identification</li>
                                <li>Providing personalized health insights</li>
                                <li>Responding to your requests and questions</li>
                                <li>Service improvement and development</li>
                                <li>Marketing and promotional communications</li>
                                <li>Legal compliance and fraud prevention</li>
                            </ul>
                        </div>
                        
                        <div class="bg-brand-orange-50 rounded-lg p-5">
                            <h3 class="font-bold text-brand-orange-700 mb-2">Additional Uses for Patients</h3>
                            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                                <li>Creating and maintaining electronic health records</li>
                                <li>Building your unified health profile</li>
                                <li>Sharing information with your healthcare providers</li>
                                <li>Fulfilling your service requests</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <h3 class="font-bold text-gray-800 mb-2 flex items-center">
                            <i class="fas fa-info-circle text-brand-teal-600 mr-2"></i>
                            Important Note
                        </h3>
                        <p class="text-gray-700">
                            We do not use information received from Google APIs for any purposes other than those explicitly 
                            permitted by Google's API Services User Data Policy.
                        </p>
                    </div>
                </div>

                <!-- User Rights Section -->
                <div id="user-rights" class="section-card bg-white rounded-xl shadow-md p-8 mb-8">
                    <div class="flex items-start mb-6">
                        <div class="bg-brand-orange-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-user-lock text-brand-orange-600 text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Your Rights</h2>
                            <p class="text-gray-600">Control over your personal information</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-brand-teal-700 mb-3">Access and Correction</h3>
                            <p class="text-gray-700 mb-3">
                                You have the right to access, update, and correct your personal information. You can do this through:
                            </p>
                            <ul class="list-disc pl-6 space-y-1 text-gray-700">
                                <li>Your account settings page</li>
                                <li>Contacting our support team</li>
                                <li>Emailing: helpdeskmedbuzzy@gmail.com</li>
                            </ul>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-brand-teal-700 mb-3">Account Deletion</h3>
                            <p class="text-gray-700 mb-3">
                                You can delete your Medbuzzy account at any time. This action is permanent and cannot be reversed.
                            </p>
                            <div class="bg-brand-orange-50 rounded-lg p-4">
                                <p class="text-sm font-semibold text-brand-orange-700 mb-2">Steps to delete your account:</p>
                                <ol class="list-decimal pl-5 space-y-1 text-gray-700">
                                    <li>Go to My Account > Help/Need Help</li>
                                    <li>Select Account & Health Records</li>
                                    <li>Choose "I want to delete my account"</li>
                                    <li>Select "My issue is still not resolved"</li>
                                    <li>Type "Delete my account" and raise an enquiry</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 p-5 bg-brand-teal-50 rounded-lg">
                        <h3 class="font-bold text-brand-teal-700 mb-2">Grievance Resolution</h3>
                        <p class="text-gray-700 mb-3">
                            We acknowledge complaints within 24 hours and resolve them within 15 days for issues related to:
                        </p>
                        <ul class="list-disc pl-6 space-y-1 text-gray-700">
                            <li>Information Technology Rules, 2021 compliance</li>
                            <li>Data privacy concerns</li>
                            <li>Service-related issues</li>
                        </ul>
                    </div>
                </div>

                <!-- AI Assistant Section -->
                <div id="ai-assistant" class="section-card bg-white rounded-xl shadow-md p-8 mb-8">
                    <div class="flex items-start mb-6">
                        <div class="bg-gray-200 p-3 rounded-lg mr-4">
                            <i class="fas fa-robot text-gray-700 text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">AI Assistant Terms</h2>
                            <p class="text-gray-600">Understanding our artificial intelligence services</p>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="bg-gray-100 rounded-lg p-5">
                            <h3 class="font-bold text-gray-800 mb-2">Purpose and Limitations</h3>
                            <p class="text-gray-700 mb-3">
                                Our AI Assistant is designed to help patients find appropriate medical services and assist healthcare professionals with diagnostic support. Important limitations:
                            </p>
                            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                                <li>Not for use in medical or psychiatric emergencies</li>
                                <li>Does not replace professional medical judgment</li>
                                <li>Based on current medical research but subject to limitations</li>
                                <li>Accuracy cannot be guaranteed for all cases</li>
                            </ul>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-semibold text-brand-teal-700 mb-3">For Patients</h3>
                                <ul class="list-disc pl-6 space-y-2 text-gray-700">
                                    <li>Helps you find appropriate healthcare providers</li>
                                    <li>Assists in booking appointments</li>
                                    <li>Provides health information (not medical advice)</li>
                                    <li>May connect you with support staff when needed</li>
                                </ul>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-semibold text-brand-teal-700 mb-3">For Healthcare Providers</h3>
                                <ul class="list-disc pl-6 space-y-2 text-gray-700">
                                    <li>Offers diagnostic assistance and data analysis</li>
                                    <li>Provides treatment recommendations</li>
                                    <li>Designed to complement, not replace, expertise</li>
                                    <li>Healthcare providers maintain full control over decisions</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                   <div class="max-w-6xl w-full">
        <div id="contact" class="section-card contact-card bg-white rounded-xl shadow-md p-8">
            <div class="flex flex-col md:flex-row items-start mb-10">
                <div class="bg-brand-teal-100 p-4 rounded-xl mr-6 mb-4 md:mb-0">
                    <i class="fas fa-headset text-brand-teal-600 text-3xl contact-icon"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Contact & Support</h2>
                    <p class="text-gray-600 text-lg max-w-2xl">
                        Our team is ready to assist you with any questions about our terms, services, or platform. 
                        Contact our grievance officers or send us a message directly.
                    </p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div>
                    <h3 class="text-xl font-bold text-brand-teal-700 mb-6 pb-2 border-b border-brand-teal-200">Grievance Officers</h3>
                    
                    <div class="officer-card bg-brand-teal-50 rounded-xl p-6 mb-6">
                        <div class="flex items-start">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 flex items-center justify-center avatar-placeholder">
                                <i class="fas fa-user-md"></i>
                            </div>
                            <div class="ml-5">
                                <h4 class="font-bold text-brand-teal-700 text-lg mb-1">For Doctor Consultation Bookings:</h4>
                                <p class="font-semibold text-gray-800 text-lg">Ms. Sonali Dhakre</p>
                                <div class="mt-3 space-y-2">
                                    <p class="text-gray-700 flex items-center">
                                        <i class="fas fa-envelope text-brand-teal-600 mr-3 w-5"></i>
                                        <a href="mailto:grievance@apollo247.org" class="hover:text-brand-teal-700 hover:underline">
                                            grievance@apollo247.org
                                        </a>
                                    </p>
                                    <p class="text-gray-700 flex items-center">
                                        <i class="fas fa-phone text-brand-teal-600 mr-3 w-5"></i>
                                        <a href="tel:08045050412" class="hover:text-brand-teal-700 hover:underline">
                                            080-45050412
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="officer-card bg-brand-orange-50 rounded-xl p-6">
                        <div class="flex items-start">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 flex items-center justify-center avatar-placeholder">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="ml-5">
                                <h4 class="font-bold text-brand-orange-700 text-lg mb-1">Grievance-cum-Nodal Officer:</h4>
                                <p class="font-semibold text-gray-800 text-lg">Mr. Jehan Jit Singh</p>
                                <div class="mt-3 space-y-2">
                                    <p class="text-gray-700 flex items-center">
                                        <i class="fas fa-envelope text-brand-orange-600 mr-3 w-5"></i>
                                        <a href="mailto:grievancemedbuzzy@gmail.com" class="hover:text-brand-orange-700 hover:underline">
                                            grievancemedbuzzy@gmail.com
                                        </a>
                                    </p>
                                    <p class="text-gray-700 flex items-center">
                                        <i class="fas fa-phone text-brand-orange-600 mr-3 w-5"></i>
                                        <a href="tel:04041894747" class="hover:text-brand-orange-700 hover:underline">
                                            040-41894747
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 bg-white border border-gray-200 rounded-xl p-5">
                        <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-info-circle text-brand-teal-600 mr-2"></i>
                            Grievance Resolution Process
                        </h4>
                        <ul class="list-disc pl-5 space-y-2 text-gray-700">
                            <li>We acknowledge complaints within <span class="font-semibold">24 hours</span></li>
                            <li>Resolution within <span class="font-semibold">15 days</span> for IT-related issues</li>
                            <li>Ticket number provided for tracking</li>
                            <li>All actions taken as deemed necessary</li>
                        </ul>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold text-brand-teal-700 mb-6 pb-2 border-b border-brand-teal-200">Submit a Question</h3>
                    <form class="space-y-5">
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Full Name</label>
                            <div class="relative">
                                <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
                                <input type="text" class="input-field w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="Enter your name">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Email Address</label>
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                                <input type="email" class="input-field w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="your.email@example.com">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Subject</label>
                            <div class="relative">
                                <i class="fas fa-tag absolute left-3 top-3 text-gray-400"></i>
                                <select class="input-field w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none appearance-none bg-white">
                                    <option>Select a subject</option>
                                    <option>Terms of Service Question</option>
                                    <option>Privacy Policy Question</option>
                                    <option>Account Issue</option>
                                    <option>Technical Support</option>
                                    <option>Other Inquiry</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Message</label>
                            <div class="relative">
                                <i class="fas fa-comment-dots absolute left-3 top-3 text-gray-400"></i>
                                <textarea rows="5" class="input-field w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none" placeholder="Type your message here..."></textarea>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="consent" class="mr-3 h-5 w-5 text-brand-teal-600 rounded">
                            <label for="consent" class="text-gray-700 text-sm">
                                I agree to the <a href="#" class="text-brand-teal-600 hover:underline">Terms of Service</a> and 
                                <a href="#" class="text-brand-teal-600 hover:underline">Privacy Policy</a>
                            </label>
                        </div>
                        <button type="submit" class="submit-btn w-full bg-teal-400 py-3 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all">
                            <i class="fas fa-paper-plane mr-2"></i> Submit Question
                        </button>
                    </form>
                    
                    <div class="mt-8 bg-brand-teal-50 rounded-xl p-5 border border-brand-teal-200">
                        <h4 class="font-bold text-brand-teal-700 mb-3 flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            Support Hours
                        </h4>
                        <ul class="space-y-2 text-gray-700">
                            <li class="flex justify-between">
                                <span>Monday-Friday:</span>
                                <span class="font-medium">8:00 AM - 10:00 PM</span>
                            </li>
                            <li class="flex justify-between">
                                <span>Saturday:</span>
                                <span class="font-medium">9:00 AM - 8:00 PM</span>
                            </li>
                            <li class="flex justify-between">
                                <span>Sunday:</span>
                                <span class="font-medium">10:00 AM - 6:00 PM</span>
                            </li>
                        </ul>
                        <div class="mt-4 pt-3 border-t border-brand-teal-200">
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-lightbulb text-brand-orange-500 mr-2"></i>
                                For urgent medical issues, please contact your nearest healthcare facility
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="back-to-top bg-brand-teal-500 text-white p-3 rounded-full shadow-lg hover:bg-brand-teal-600 transition">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Footer -->
  

    <script>
        // Back to top button
        const backToTopButton = document.getElementById('back-to-top');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
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
        
        // PDF download button
        document.getElementById('download-pdf').addEventListener('click', function() {
            alert('PDF download would start here. In a real implementation, this would download the PDF version of the terms.');
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</div>
