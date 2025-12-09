@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@push('styles')
<style>
    /* Custom Dashboard Styles */
    .welcome-card {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        border-radius: 20px;
        color: white;
        padding: 35px;
        position: relative;
        overflow: hidden;
    }
    
    .welcome-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .welcome-card::after {
        content: '';
        position: absolute;
        bottom: -30%;
        right: 10%;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }
    
    .performance-indicator {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.1);
        padding: 8px 15px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
    }
    
    .chart-container {
        position: relative;
        height: 300px;
    }
    
    .live-indicator {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.85rem;
    }
    
    .live-dot {
        width: 8px;
        height: 8px;
        background: #ef4444;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }
    
    .quick-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
    
    .quick-stat-item {
        background: white;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .quick-stat-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .quick-stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #4361ee;
        margin-bottom: 5px;
    }
    
    .quick-stat-label {
        font-size: 0.85rem;
        color: #64748b;
    }
    
    .booking-calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
        margin-top: 20px;
    }
    
    .calendar-day-cell {
        aspect-ratio: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 5px;
    }
    
    .calendar-day-cell:hover {
        background: #f1f5f9;
    }
    
    .calendar-day-cell.today {
        background: #4361ee;
        color: white;
    }
    
    .calendar-day-cell.has-bookings {
        background: #4cc9f0;
        color: white;
        position: relative;
    }
    
    .booking-count {
        position: absolute;
        top: 5px;
        right: 5px;
        background: white;
        color: #4361ee;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .activity-timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .activity-timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e2e8f0;
    }
    
    .activity-item {
        position: relative;
        padding: 15px 0;
        padding-left: 30px;
    }
    
    .activity-item::before {
        content: '';
        position: absolute;
        left: -30px;
        top: 20px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #4361ee;
        border: 3px solid white;
    }
    
    .activity-time {
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 5px;
    }
    
    .activity-content {
        font-weight: 500;
    }
    
    .court-availability {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .availability-bar {
        height: 8px;
        background: #e2e8f0;
        border-radius: 4px;
        overflow: hidden;
    }
    
    .availability-fill {
        height: 100%;
        border-radius: 4px;
        transition: width 1s ease;
    }
    
    .availability-fill.available {
        background: #10b981;
    }
    
    .availability-fill.occupied {
        background: #ef4444;
    }
    
    .availability-fill.maintenance {
        background: #f59e0b;
    }
    
    /* Loading Animation */
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #4361ee;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .welcome-card {
            padding: 25px;
        }
        
        .quick-stats {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .booking-calendar {
            gap: 5px;
        }
        
        .calendar-day-cell {
            font-size: 0.85rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-card position-relative overflow-hidden">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-6 fw-bold mb-3">Welcome back, <span class="text-warning">Admin!</span> 👋</h1>
                        <p class="lead opacity-90 mb-4">Here's what's happening with your sports arena today.</p>
                        
                        <div class="performance-indicator d-inline-flex align-items-center">
                            <span class="d-flex align-items-center">
                                <i class="bi bi-graph-up-arrow text-success me-2"></i>
                                <span class="fw-semibold">Revenue up 24%</span>
                            </span>
                            <span class="opacity-75">this week</span>
                        </div>
                    </div>
                    <div class="col-md-4 text-end d-none d-md-block">
                        <div class="position-relative z-2">
                            <div class="mb-3">
                                <div class="fs-6 opacity-75">Current Time</div>
                                <div class="h3 fw-bold" id="currentDateTime">Loading...</div>
                            </div>
                            <button class="btn btn-light rounded-pill px-4">
                                <i class="bi bi-download me-2"></i>Export Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="quick-stats">
                <div class="quick-stat-item">
                    <div class="quick-stat-value">24</div>
                    <div class="quick-stat-label">Active Courts</div>
                </div>
                <div class="quick-stat-item">
                    <div class="quick-stat-value">156</div>
                    <div class="quick-stat-label">Today's Bookings</div>
                </div>
                <div class="quick-stat-item">
                    <div class="quick-stat-value">Rp 12.5M</div>
                    <div class="quick-stat-label">Daily Revenue</div>
                </div>
                <div class="quick-stat-item">
                    <div class="quick-stat-value">98%</div>
                    <div class="quick-stat-label">Occupancy Rate</div>
                </div>
                <div class="quick-stat-item">
                    <div class="quick-stat-value">18</div>
                    <div class="quick-stat-label">Pending Approvals</div>
                </div>
                <div class="quick-stat-item">
                    <div class="quick-stat-value">4.8★</div>
                    <div class="quick-stat-label">Avg. Rating</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Grid -->
    <div class="row g-4">
        <!-- Left Column: Charts & Stats -->
        <div class="col-lg-8">
            <!-- Revenue Chart -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="chart-card">
                        <div class="chart-header">
                            <div>
                                <h5 class="fw-bold mb-1">Revenue Overview</h5>
                                <p class="text-muted mb-0">Last 30 days performance</p>
                            </div>
                            <div class="live-indicator">
                                <span class="live-dot"></span>
                                <span class="text-danger fw-semibold">LIVE</span>
                            </div>
                        </div>
                        <div class="chart-container" id="revenueChart"></div>
                    </div>
                </div>
            </div>

            <!-- Court Availability -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="chart-card">
                        <div class="chart-header">
                            <div>
                                <h5 class="fw-bold mb-1">Court Availability</h5>
                                <p class="text-muted mb-0">Real-time status</p>
                            </div>
                            <select class="form-select form-select-sm w-auto">
                                <option>All Courts</option>
                                <option>Futsal</option>
                                <option>Badminton</option>
                                <option>Basketball</option>
                            </select>
                        </div>
                        <div class="court-availability">
                            @foreach([1,2,3,4,5,6,7,8] as $court)
                            <div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fw-semibold">Court {{$court}} - {{['Futsal','Badminton','Basketball','Tennis'][$court%4]}}</span>
                                    <span class="text-muted">{{rand(70, 95)}}% available</span>
                                </div>
                                <div class="availability-bar">
                                    <div class="availability-fill {{['available','occupied','maintenance'][$court%3]}}" 
                                         style="width: {{rand(70, 95)}}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings Table -->
            <div class="row">
                <div class="col-12">
                    <div class="data-table">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="fw-bold mb-1">Recent Bookings</h5>
                                <p class="text-muted mb-0">Latest booking requests</p>
                            </div>
                            <a href="/admin/bookings" class="btn btn-sm btn-primary">
                                View All <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Court</th>
                                        <th>Date & Time</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 1; $i <= 5; $i++)
                                    <tr>
                                        <td class="fw-semibold">#B{{str_pad($i, 4, '0', STR_PAD_LEFT)}}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                                                     style="width: 32px; height: 32px; font-size: 0.85rem; margin-right: 10px;">
                                                    {{substr(['John','Sarah','Mike','Lisa','David'][$i-1], 0, 1)}}
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">{{['John Doe','Sarah Smith','Mike Johnson','Lisa Brown','David Wilson'][$i-1]}}</div>
                                                    <small class="text-muted">{{['john@email.com','sarah@email.com','mike@email.com','lisa@email.com','david@email.com'][$i-1]}}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">Court {{$i}}</div>
                                            <small class="text-muted">{{['Futsal','Badminton','Basketball','Tennis','Volleyball'][$i-1]}}</small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{date('d M')}}</div>
                                            <small class="text-muted">{{['14:00-16:00','10:00-12:00','18:00-20:00','08:00-10:00','16:00-18:00'][$i-1]}}</small>
                                        </td>
                                        <td class="fw-bold">Rp {{number_format([440000, 330000, 550000, 220000, 385000][$i-1], 0, ',', '.')}}</td>
                                        <td>
                                            @php
                                                $statuses = ['pending', 'confirmed', 'completed', 'pending', 'cancelled'];
                                                $statusColors = ['status-pending', 'status-confirmed', 'status-completed', 'status-pending', 'status-cancelled'];
                                            @endphp
                                            <span class="status-badge {{$statusColors[$i-1]}}">
                                                {{ucfirst($statuses[$i-1])}}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-check-circle me-2"></i>Approve</a></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-x-circle me-2"></i>Reject</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Sidebar Content -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="chart-card">
                        <h5 class="fw-bold mb-4">Quick Actions</h5>
                        <div class="quick-actions">
                            <a href="/admin/bookings/create" class="action-btn">
                                <i class="bi bi-plus-circle"></i>
                                <span>New Booking</span>
                            </a>
                            <a href="/admin/courts/create" class="action-btn">
                                <i class="bi bi-house-add"></i>
                                <span>Add Court</span>
                            </a>
                            <a href="/admin/reports" class="action-btn">
                                <i class="bi bi-graph-up"></i>
                                <span>View Reports</span>
                            </a>
                            <a href="/admin/monitoring" class="action-btn">
                                <i class="bi bi-tv"></i>
                                <span>Live Monitoring</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Calendar -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="calendar-card">
                        <div class="calendar-header">
                            <div>
                                <h5 class="fw-bold mb-1">Booking Calendar</h5>
                                <p class="text-muted mb-0">{{date('F Y')}}</p>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="booking-calendar">
                            @php
                                $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                                $today = date('j');
                            @endphp
                            
                            <!-- Day headers -->
                            @foreach($days as $day)
                            <div class="calendar-day text-center fw-semibold text-muted">{{$day}}</div>
                            @endforeach
                            
                            <!-- Calendar dates -->
                            @for($day = 1; $day <= 31; $day++)
                            <div class="calendar-day-cell {{$day == $today ? 'today' : ''}} {{rand(0, 1) ? 'has-bookings' : ''}}">
                                <span>{{$day}}</span>
                                @if(rand(0, 1))
                                <span class="booking-count">{{rand(1, 5)}}</span>
                                @endif
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="row">
                <div class="col-12">
                    <div class="chart-card">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">Recent Activity</h5>
                            <span class="badge bg-primary rounded-pill">New</span>
                        </div>
                        
                        <div class="activity-timeline">
                            @php
                                $activities = [
                                    ['time' => 'Just now', 'icon' => 'bi-calendar-check', 'color' => 'primary', 'text' => 'New booking from John Doe'],
                                    ['time' => '5 mins ago', 'icon' => 'bi-credit-card', 'color' => 'success', 'text' => 'Payment received Rp 450,000'],
                                    ['time' => '1 hour ago', 'icon' => 'bi-star', 'color' => 'warning', 'text' => 'New 5-star review received'],
                                    ['time' => '2 hours ago', 'icon' => 'bi-exclamation-triangle', 'color' => 'danger', 'text' => 'Maintenance scheduled for Court #5'],
                                    ['time' => '3 hours ago', 'icon' => 'bi-person-plus', 'color' => 'info', 'text' => 'New user registration'],
                                ];
                            @endphp
                            
                            @foreach($activities as $activity)
                            <div class="activity-item">
                                <div class="activity-time">
                                    <i class="bi bi-clock me-1"></i>{{$activity['time']}}
                                </div>
                                <div class="activity-content">
                                    <i class="bi {{$activity['icon']}} me-2 text-{{$activity['color']}}"></i>
                                    {{$activity['text']}}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Stats -->
    <div class="row mt-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon stats-icon-primary">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="ms-3">
                        <div class="stats-number">1,248</div>
                        <div class="text-muted">Active Users</div>
                        <small class="trend-up">+12.5% this month</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon stats-icon-success">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="ms-3">
                        <div class="stats-number">3,456</div>
                        <div class="text-muted">Monthly Bookings</div>
                        <small class="trend-up">+8.2% from last month</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon stats-icon-warning">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <div class="ms-3">
                        <div class="stats-number">Rp 245M</div>
                        <div class="text-muted">Monthly Revenue</div>
                        <small class="trend-up">+24.7% growth</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon stats-icon-info">
                        <i class="bi bi-star"></i>
                    </div>
                    <div class="ms-3">
                        <div class="stats-number">4.8</div>
                        <div class="text-muted">Average Rating</div>
                        <small class="trend-up">+0.3 this month</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Initialize ApexCharts
    document.addEventListener('DOMContentLoaded', function() {
        // Revenue Chart
        const revenueChartOptions = {
            series: [{
                name: 'Revenue',
                data: [4500000, 5200000, 3800000, 4100000, 5600000, 6200000, 7500000, 
                       8200000, 7800000, 9100000, 8900000, 9500000, 10200000, 11500000, 
                       10800000, 12500000, 11800000, 13200000, 14500000, 13800000, 
                       15200000, 16500000, 15800000, 17200000, 18500000, 17800000, 
                       19200000, 20500000, 19800000, 21500000]
            }],
            chart: {
                type: 'area',
                height: '100%',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                animations: {
                    enabled: true,
                    speed: 800
                }
            },
            colors: ['#4361ee'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.3,
                    stops: [0, 90, 100]
                }
            },
            grid: {
                borderColor: '#e2e8f0',
                strokeDashArray: 3,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            xaxis: {
                type: 'datetime',
                categories: Array.from({length: 30}, (_, i) => {
                    const date = new Date();
                    date.setDate(date.getDate() - (29 - i));
                    return date.toISOString().split('T')[0];
                }),
                labels: {
                    format: 'dd MMM',
                    style: {
                        colors: '#64748b',
                        fontSize: '12px'
                    }
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                    },
                    style: {
                        colors: '#64748b',
                        fontSize: '12px'
                    }
                }
            },
            tooltip: {
                x: {
                    format: 'dd MMM yyyy'
                },
                y: {
                    formatter: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            },
            markers: {
                size: 4,
                colors: ['#4361ee'],
                strokeColors: '#fff',
                strokeWidth: 2,
                hover: {
                    size: 6
                }
            }
        };

        const revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueChartOptions);
        revenueChart.render();

        // Court Status Simulation
        function simulateCourtStatus() {
            const bars = document.querySelectorAll('.availability-fill');
            bars.forEach(bar => {
                const currentWidth = parseInt(bar.style.width);
                const newWidth = Math.max(60, Math.min(95, currentWidth + (Math.random() * 10 - 5)));
                bar.style.width = newWidth + '%';
            });
        }

        // Simulate court status changes every 30 seconds
        setInterval(simulateCourtStatus, 30000);

        // Real-time booking counter
        function updateBookingCounter() {
            const counter = document.querySelector('[data-target="booking-counter"]');
            if (counter) {
                const current = parseInt(counter.textContent);
                const increment = Math.floor(Math.random() * 3);
                counter.textContent = current + increment;
            }
        }

        setInterval(updateBookingCounter, 10000);

        // Live date time update
        function updateLiveDateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            const dateTimeStr = now.toLocaleDateString('id-ID', options);
            
            const dateTimeElement = document.getElementById('currentDateTime');
            if (dateTimeElement) {
                dateTimeElement.textContent = dateTimeStr;
            }
        }

        // Update every second for live feel
        setInterval(updateLiveDateTime, 1000);
        updateLiveDateTime();

        // Calendar interaction
        document.querySelectorAll('.calendar-day-cell').forEach(cell => {
            cell.addEventListener('click', function() {
                const date = this.querySelector('span').textContent;
                alert(`Viewing bookings for ${date} ${new Date().toLocaleString('id-ID', {month: 'long', year: 'numeric'})}`);
            });
        });

        // Quick action animations
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Table row hover effect
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f8fafc';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
            });
        });

        // Auto-refresh data every 2 minutes
        setInterval(() => {
            console.log('Refreshing dashboard data...');
            // In real implementation, fetch new data via AJAX
        }, 120000);

        // Export functionality
        document.querySelector('.btn-light.rounded-pill')?.addEventListener('click', function(e) {
            e.preventDefault();
            this.innerHTML = '<span class="loading-spinner"></span> Generating...';
            
            setTimeout(() => {
                this.innerHTML = '<i class="bi bi-download me-2"></i>Export Report';
                alert('Report generated successfully! Download will start shortly.');
            }, 1500);
        });
    });
</script>
@endpush