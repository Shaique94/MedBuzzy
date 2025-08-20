<div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto min-h-screen">
        <div class="container mx-auto px-2 sm:px-4 md:px-6 lg:px-8 py-4 sm:py-6 lg:py-8 max-w-7xl">
            <!-- Enhanced Page Header -->
            <div class="mb-4 sm:mb-6 lg:mb-10">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">
                    <div>
                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-semibold text-gray-900 mb-2">
                            Dashboard Overview
                        </h1>
                        <p class="text-sm text-gray-600 max-w-2xl">
                            Welcome back! Here's a concise overview of your medical practice today.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2 items-start">
                        <div class="text-center bg-white rounded-lg px-2 py-1 border border-gray-100">
                            <div class="text-base sm:text-lg font-semibold text-blue-600" id="current-time">--:--</div>
                            <div class="text-xs text-gray-500">Current Time (IST)</div>
                        </div>
                        <div class="text-center bg-white rounded-lg px-2 py-1 border border-gray-100">
                            <div class="text-base sm:text-lg font-semibold text-green-600">Aug 04</div>
                            <div class="text-xs text-gray-500">Today</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards (flat, no shadows) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-4 sm:mb-6">
                <!-- Appointments Card -->
                <div class="bg-white rounded-lg p-3 sm:p-4 border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <div class="bg-blue-600 p-2 rounded-lg text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-xl sm:text-2xl font-semibold text-gray-800">{{ $appointmentsCount ?? 2 }}
                            </div>
                            <div class="text-xs text-blue-600 font-medium">+2.5% ↗</div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-800 mb-1">Total Appointments</h3>
                        <p class="text-xs text-gray-600">Appointments scheduled</p>
                    </div>
                </div>

                <!-- Patients Card -->
                <div class="bg-white rounded-lg p-3 sm:p-4 border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <div class="bg-green-600 p-2 rounded-lg text-white">
                           <svg class="w-[21px] h-[21px] text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 17v2M12 5.5V10m-6 7v2m15-2v-4c0-1.6569-1.3431-3-3-3H6c-1.65685 0-3 1.3431-3 3v4h18Zm-2-7V8c0-1.65685-1.3431-3-3-3H8C6.34315 5 5 6.34315 5 8v2h14Z"/>
</svg>

                        </div>
                        <div class="text-right">
                            <div class="text-xl sm:text-2xl font-semibold text-gray-800">{{ $patientsCount ?? 2 }}</div>
                            <div class="text-xs text-green-600 font-medium">+5 new ↗</div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-800 mb-1">Total Patients</h3>
                        <p class="text-xs text-gray-600">Registered patients</p>
                    </div>
                </div>

                <!-- Doctors Card -->
                <div class="bg-white rounded-lg p-3 sm:p-4 border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <div class="bg-amber-600 p-2 rounded-lg text-white">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
</svg>

                        </div>
                        <div class="text-right">
                            <div class="text-xl sm:text-2xl font-semibold text-gray-800">{{ $doctorsCount ?? 0 }}</div>
                            <div class="text-xs text-amber-600 font-medium">Available ✓</div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-800 mb-1">Active Doctors</h3>
                        <p class="text-xs text-gray-600">Medical specialists</p>
                    </div>
                </div>

                <!-- Revenue Card -->
                <div class="bg-white rounded-lg p-3 sm:p-4 border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <div class="bg-purple-600 p-2 rounded-lg text-white">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
</svg>

                        </div>
                        <div class="text-right">
                            <div class="text-xl sm:text-2xl font-semibold text-gray-800">
                                ₹{{ number_format($totalRevenue ?? 50000, 0) }}</div>
                            <div class="text-xs text-purple-600 font-medium">+12% ↗</div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-800 mb-1">Total Revenue</h3>
                        <p class="text-xs text-gray-600">Monthly earnings</p>
                    </div>
                </div>
            </div>

			{{-- <!-- Charts and Analytics Section (flat cards) -->
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-3 sm:gap-4 mb-4 sm:mb-6">
				<div class="bg-white rounded-lg p-3 sm:p-4 border border-gray-100">
					<div class="flex items-center justify-between mb-2">
						<h3 class="text-base font-medium text-gray-800">Appointments Overview</h3>
						<div class="flex space-x-1">
							<button class="px-2 py-1 text-xs font-medium bg-blue-50 text-blue-700 rounded">Week</button>
							<button class="px-2 py-1 text-xs font-medium text-gray-600 rounded hover:bg-gray-50">Month</button>
						</div>
					</div>
					<div class="relative h-40 sm:h-48 lg:h-64">
						<canvas id="appointmentsChart" width="400" height="200"></canvas>
					</div>
				</div>

                <div class="bg-white rounded-lg p-3 sm:p-4 border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-base font-medium text-gray-800">Revenue Trends</h3>
                        <div class="flex space-x-1">
                            <button
                                class="px-2 py-1 text-xs font-medium bg-purple-50 text-purple-700 rounded">6M</button>
                            <button
                                class="px-2 py-1 text-xs font-medium text-gray-600 rounded hover:bg-gray-50">1Y</button>
                        </div>
                    </div>
                    <div class="relative h-40 sm:h-48 lg:h-64">
                        <canvas id="revenueChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Panel (flat, responsive, no shadows) -->
            <div class="bg-white rounded-lg p-3 sm:p-4 border border-gray-100 mb-4 sm:mb-6">
                <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-3">Quick Actions</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                    <a wire:navigate href="{{ route('admin.appointment') }}" aria-label="View Appointments"
                        class="flex flex-col items-center p-3 rounded-md border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-colors text-center">
                        <div class="bg-blue-50 text-blue-700 rounded-md p-2 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Appointments</span>
                    </a>

                    <a wire:navigate href="{{ route('admin.add.appointment') }}" aria-label="Add Appointment"
                        class="flex flex-col items-center p-3 rounded-md border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-colors text-center">
                        <div class="bg-green-50 text-green-700 rounded-md p-2 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700">New Appointment</span>
                    </a>

                    <a wire:navigate href="{{ route('admin.manage.doctors') }}" aria-label="Manage Doctors"
                        class="flex flex-col items-center p-3 rounded-md border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-colors text-center">
                        <div class="bg-amber-50 text-amber-700 rounded-md p-2 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Doctors</span>
                    </a>

                    <a wire:navigate href="{{ route('admin.departments') }}" aria-label="Departments"
                        class="flex flex-col items-center p-3 rounded-md border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-colors text-center">
                        <div class="bg-indigo-50 text-indigo-700 rounded-md p-2 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Departments</span>
                    </a>

                    <a wire:navigate href="{{ route('admin.reviewapprovel') }}" aria-label="Reviews"
                        class="flex flex-col items-center p-3 rounded-md border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-colors text-center">
                        <div class="bg-gray-50 text-gray-700 rounded-md p-2 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Reviews</span>
                    </a>

					<a wire:navigate href="{{ route('admin.ManagePayment') }}" aria-label="Manage Payments"
						class="flex flex-col items-center p-3 rounded-md border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-colors text-center">
						<div class="bg-teal-50 text-teal-700 rounded-md p-2 mb-2">
							<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5"></path>
							</svg>
						</div>
						<span class="text-xs font-medium text-gray-700">Payments</span>
					</a>
				</div>
			</div> --}}

            <!-- Upcoming Appointments (compact, flat list) -->
            <div class="bg-white rounded-lg border border-gray-100 overflow-hidden">
                <div
                    class="px-4 py-3 border-b border-gray-200 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14"></path>
                            </svg>
                            Upcoming Appointments
                        </h2>
                        <p class="text-xs text-gray-600 mt-1">Upcoming scheduled visits</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-800">
                            {{ count($appointments) }} Today
                        </span>
                        <a wire:navigate href="{{ route('admin.appointment') }}"
                            class="inline-flex items-center px-2 py-1 border border-blue-200 rounded text-xs font-medium text-blue-700 bg-blue-50">View
                            All</a>
                    </div>
                </div>

                <ul class="divide-y divide-gray-100">
                    @forelse ($appointments as $appointment)
                        <li class="p-3 sm:p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div class="flex items-start sm:items-center gap-3">
                                <div
                                    class="h-10 w-10 rounded-md bg-blue-600 flex items-center justify-center text-white font-semibold text-sm">
                                    {{ substr($appointment->patient->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $appointment->patient->name }}</p>
                                    <p class="text-xs text-gray-500">Dr. {{ $appointment->doctor->user->name }} •
                                        {{ $appointment->doctor->department->name ?? '' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 text-xs text-gray-600">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10"></path>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('D, M d, Y') }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3"></path>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                </div>
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $appointment->status === 'confirmed' ? 'bg-green-50 text-green-800' : ($appointment->status === 'pending' ? 'bg-yellow-50 text-yellow-800' : 'bg-gray-50 text-gray-700') }}">
                                    {{ ucfirst($appointment->status ?? 'pending') }}
                                </span>
                            </div>

                            <div class="flex items-center gap-2">
                                <a wire:navigate
                                    href="{{ route('appointment.receipt', ['appointment' => $appointment->id]) }}"
                                    target="_blank"
                                    class="px-3 py-1 text-xs text-blue-600 border border-transparent rounded hover:bg-blue-50">Details</a>
                                <a wire:navigate href="{{ route('admin.update.appointment', $appointment->id) }}"
                                    class="px-3 py-1 text-xs text-amber-600 border border-transparent rounded hover:bg-amber-50">Edit</a>
                            </div>
                        </li>
                    @empty
                        <li class="p-6 text-center">
                            <p class="text-sm text-gray-500">No appointments scheduled</p>
                            <a wire:navigate href="{{ route('admin.add.appointment') }}"
                                class="inline-flex items-center px-3 py-1.5 mt-3 border border-transparent rounded text-sm font-medium text-white bg-blue-600">Schedule
                                Appointment</a>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

		<!-- JavaScript for Charts and Real-time Updates -->
		{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				// Update current time
				function updateTime() {
					const now = new Date();
					const istOffset = 5.5 * 60 * 60 * 1000; // IST is UTC+5:30
					const istTime = new Date(now.getTime() + istOffset);
					const timeString = istTime.toLocaleTimeString('en-US', { 
						hour: '2-digit', 
						minute: '2-digit',
						hour12: true 
					});
					const timeElement = document.getElementById('current-time');
					if (timeElement) {
						timeElement.textContent = timeString;
					}
				}
				
				updateTime();
				setInterval(updateTime, 1000);

                // Dynamic data from Laravel
                const weeklyAppointments = @json($weeklyAppointments ?? []);
                const monthlyRevenue = @json($monthlyRevenue ?? []);

                // Appointments Chart
                const appointmentsCtx = document.getElementById('appointmentsChart');
                if (appointmentsCtx) {
                    const appointmentLabels = weeklyAppointments.map(item => item.day) || ['Mon', 'Tue', 'Wed', 'Thu',
                        'Fri', 'Sat', 'Sun'
                    ];
                    const appointmentData = weeklyAppointments.map(item => item.count) || [12, 19, 8, 15, 22, 7, 14];

                    new Chart(appointmentsCtx, {
                        type: 'line',
                        data: {
                            labels: appointmentLabels,
                            datasets: [{
                                label: 'Appointments',
                                data: appointmentData,
                                borderColor: 'rgb(59, 130, 246)',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                borderWidth: 3,
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: 'rgb(59, 130, 246)',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                pointHoverRadius: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    titleColor: '#fff',
                                    bodyColor: '#fff',
                                    borderColor: 'rgb(59, 130, 246)',
                                    borderWidth: 1
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.05)'
                                    },
                                    ticks: {
                                        color: '#6B7280',
                                        font: {
                                            size: 10
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        color: '#6B7280',
                                        font: {
                                            size: 10
                                        }
                                    }
                                }
                            },
                            interaction: {
                                mode: 'nearest',
                                axis: 'x',
                                intersect: false
                            }
                        }
                    });
                }

                // Revenue Chart
                const revenueCtx = document.getElementById('revenueChart');
                if (revenueCtx) {
                    const revenueLabels = monthlyRevenue.map(item => item.month) || ['Jan', 'Feb', 'Mar', 'Apr', 'May',
                        'Jun'
                    ];
                    const revenueData = monthlyRevenue.map(item => item.revenue) || [30000, 45000, 28000, 52000, 38000,
                        47000
                    ];

                    new Chart(revenueCtx, {
                        type: 'bar',
                        data: {
                            labels: revenueLabels,
                            datasets: [{
                                label: 'Revenue (₹)',
                                data: revenueData,
                                backgroundColor: revenueData.map((_, index) =>
                                    `rgba(147, 51, 234, ${0.6 + (index * 0.06)})`
                                ),
                                borderColor: 'rgb(147, 51, 234)',
                                borderWidth: 0,
                                borderRadius: 6,
                                borderSkipped: false,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    titleColor: '#fff',
                                    bodyColor: '#fff',
                                    borderColor: 'rgb(147, 51, 234)',
                                    borderWidth: 1,
                                    callbacks: {
                                        label: function(context) {
                                            return 'Revenue: ₹' + context.parsed.y.toLocaleString();
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.05)'
                                    },
                                    ticks: {
                                        color: '#6B7280',
                                        font: {
                                            size: 10
                                        },
                                        callback: function(value) {
                                            if (value >= 1000) {
                                                return '₹' + (value / 1000) + 'k';
                                            }
                                            return '₹' + value;
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        color: '#6B7280',
                                        font: {
                                            size: 10
                                        }
                                    }
                                }
                            },
                            interaction: {
                                mode: 'nearest',
                                axis: 'x',
                                intersect: false
                            }
                        }
                    });
                }

                // Add smooth scroll to anchor links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });

				// Add loading states for quick action buttons
				document.querySelectorAll('[href]').forEach(link => {
					link.addEventListener('click', function() {
						const button = this;
						const originalText = button.textContent;
						
						if (!button.href.includes(window.location.origin)) {
							button.style.opacity = '0.7';
							button.style.pointerEvents = 'none';
							
							setTimeout(() => {
								button.style.opacity = '1';
								button.style.pointerEvents = 'auto';
							}, 2000);
						}
					});
				});
			});
		</script> --}}
	</main>
</div>
