<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- ApexCharts -->
    <link href="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0/dist/apexcharts.css" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 280px;
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --success-color: #4cc9f0;
            --warning-color: #f72585;
            --info-color: #7209b7;
            --light-bg: #f8fafc;
        }
        
        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #1a237e 0%, #283593 100%);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 5px 0 25px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .sidebar-brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(45deg, #4361ee, #3a0ca3);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .sidebar-menu {
            padding: 20px 0;
            height: calc(100vh - 130px);
            overflow-y: auto;
        }
        
        .sidebar-menu::-webkit-scrollbar {
            width: 5px;
        }
        
        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }
        
        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
        
        .nav-item {
            margin-bottom: 5px;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 15px 25px;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .nav-link:hover, .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            border-left-color: #4cc9f0;
        }
        
        .nav-link i {
            font-size: 1.2rem;
            width: 25px;
        }
        
        .badge-notification {
            background: linear-gradient(45deg, #f72585, #b5179e);
            color: white;
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 20px;
            margin-left: auto;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        
        /* Navbar Styling */
        .navbar-admin {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 15px 30px;
            margin-left: var(--sidebar-width);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
            transition: all 0.3s ease;
        }
        
        .search-box {
            position: relative;
            max-width: 400px;
        }
        
        .search-box input {
            padding-left: 45px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .search-box input:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(45deg, #f72585, #b5179e);
            color: white;
            font-size: 0.7rem;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .user-dropdown-toggle {
            border: none;
            background: transparent;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .user-dropdown-toggle:hover {
            background: #f1f5f9;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(45deg, #4361ee, #3a0ca3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        /* Dashboard Cards */
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }
        
        .stats-icon-primary {
            background: linear-gradient(45deg, #4361ee, #3a0ca3);
            color: white;
        }
        
        .stats-icon-success {
            background: linear-gradient(45deg, #4cc9f0, #4895ef);
            color: white;
        }
        
        .stats-icon-warning {
            background: linear-gradient(45deg, #f72585, #b5179e);
            color: white;
        }
        
        .stats-icon-info {
            background: linear-gradient(45deg, #7209b7, #560bad);
            color: white;
        }
        
        .stats-number {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 5px;
            background: linear-gradient(45deg, #1a237e, #283593);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .trend-up {
            color: #10b981;
            font-weight: 600;
        }
        
        .trend-down {
            color: #ef4444;
            font-weight: 600;
        }
        
        /* Charts */
        .chart-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            height: 100%;
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        /* Tables */
        .data-table {
            background: white;
            border-radius: 15px;
            padding: 25px;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            border-bottom: 2px solid #e2e8f0;
            font-weight: 600;
            color: #475569;
            padding: 15px;
            background: #f8fafc;
        }
        
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .status-badge {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }
        
        .status-confirmed {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-completed {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }
        
        /* Quick Actions */
        .quick-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .action-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px 20px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            color: #475569;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            flex: 1;
            min-width: 200px;
        }
        
        .action-btn:hover {
            background: #4361ee;
            color: white;
            border-color: #4361ee;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .action-btn i {
            font-size: 1.2rem;
        }
        
        /* Court Status Cards */
        .court-status-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border-left: 5px solid;
            transition: all 0.3s ease;
        }
        
        .court-status-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .court-status-available {
            border-left-color: #10b981;
        }
        
        .court-status-occupied {
            border-left-color: #ef4444;
        }
        
        .court-status-maintenance {
            border-left-color: #f59e0b;
        }
        
        .court-progress {
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
        }
        
        .court-progress-bar {
            height: 100%;
            border-radius: 3px;
        }
        
        /* Calendar */
        .calendar-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            height: 100%;
        }
        
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            margin-bottom: 10px;
        }
        
        .calendar-day {
            text-align: center;
            padding: 10px;
            font-weight: 600;
            color: #64748b;
        }
        
        .calendar-dates {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }
        
        .calendar-date {
            text-align: center;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .calendar-date:hover {
            background: #f1f5f9;
        }
        
        .calendar-date.today {
            background: #4361ee;
            color: white;
        }
        
        .calendar-date.has-booking {
            background: #4cc9f0;
            color: white;
        }
        
        .calendar-date.other-month {
            color: #cbd5e1;
        }
        
        /* Mobile Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content, .navbar-admin {
                margin-left: 0;
            }
            
            .action-btn {
                min-width: 100%;
            }
        }
        
        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #1e293b;
            }
            
            .stats-card,
            .chart-card,
            .data-table,
            .calendar-card,
            .court-status-card {
                background: #334155;
                color: #e2e8f0;
            }
            
            .navbar-admin {
                background: #334155;
                border-bottom-color: #475569;
            }
            
            .search-box input {
                background: #475569;
                border-color: #64748b;
                color: #e2e8f0;
            }
            
            .search-icon {
                color: #94a3b8;
            }
            
            .table {
                color: #e2e8f0;
            }
            
            .table thead th {
                background: #475569;
                border-bottom-color: #64748b;
            }
            
            .table tbody td {
                border-bottom-color: #475569;
            }
            
            .action-btn {
                background: #475569;
                border-color: #64748b;
                color: #e2e8f0;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <div class="sidebar-brand-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <div>
                    <h4 class="mb-0">ArenaAdmin</h4>
                    <small class="opacity-75">Sports Booking System</small>
                </div>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="/admin">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/admin/bookings">
                        <i class="bi bi-calendar-check"></i>
                        <span>Bookings</span>
                        <span class="badge-notification">12</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/admin/courts">
                        <i class="bi bi-house-door"></i>
                        <span>Courts</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/admin/monitoring">
                        <i class="bi bi-tv"></i>
                        <span>Monitoring</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/admin/transactions">
                        <i class="bi bi-cash-stack"></i>
                        <span>Transactions</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/admin/users">
                        <i class="bi bi-people"></i>
                        <span>Users</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/admin/reports">
                        <i class="bi bi-graph-up"></i>
                        <span>Reports</span>
                    </a>
                </li>
                
                <hr class="opacity-25 mx-3 my-4">
                
                <li class="nav-item">
                    <a class="nav-link" href="/admin/settings">
                        <i class="bi bi-gear"></i>
                        <span>Settings</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back to Site</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/admin/logout">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar-admin" id="navbarAdmin">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center w-100">
                <!-- Left: Toggle Button & Search -->
                <div class="d-flex align-items-center gap-4">
                    <button class="btn btn-outline-primary d-lg-none" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    
                    <div class="search-box d-none d-lg-block">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" class="form-control" placeholder="Search bookings, users, courts...">
                    </div>
                </div>
                
                <!-- Right: Notifications & User -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Notifications -->
                    <div class="dropdown">
                        <button class="btn btn-link text-dark position-relative" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell fs-5"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="width: 320px;">
                            <li class="dropdown-header">
                                <h6 class="mb-0">Notifications</h6>
                                <small>3 new notifications</small>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-3" href="#">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-primary text-white p-2">
                                            <i class="bi bi-calendar-check"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="fw-semibold">New Booking Request</div>
                                        <small class="text-muted">Court #12 • 2 mins ago</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-3" href="#">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-success text-white p-2">
                                            <i class="bi bi-credit-card"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="fw-semibold">Payment Received</div>
                                        <small class="text-muted">Rp 450,000 • 1 hour ago</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-3" href="#">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-warning text-white p-2">
                                            <i class="bi bi-exclamation-triangle"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="fw-semibold">Maintenance Alert</div>
                                        <small class="text-muted">Court #5 • 3 hours ago</small>
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-center text-primary" href="#">
                                    View all notifications
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <button class="user-dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <div class="user-avatar">
                                A
                            </div>
                            <div class="text-start d-none d-lg-block">
                                <div class="fw-semibold">Admin User</div>
                                <small class="text-muted">Administrator</small>
                            </div>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li>
                                <a class="dropdown-item" href="/admin/profile">
                                    <i class="bi bi-person me-2"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/admin/settings">
                                    <i class="bi bi-gear me-2"></i>Settings
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="/admin/logout">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- main content -->
    <main class="main-content" id="mainContent">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>
    
    <script>
        // Sidebar 
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnToggle = toggleBtn?.contains(event.target);
            
            if (window.innerWidth < 992 && !isClickInsideSidebar && !isClickOnToggle) {
                sidebar.classList.remove('active');
            }
        });
        
        // Update current date and time
        function updateDateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            const dateTimeStr = now.toLocaleDateString('id-ID', options);
            
            const dateTimeElement = document.getElementById('currentDateTime');
            if (dateTimeElement) {
                dateTimeElement.textContent = dateTimeStr;
            }
        }
        
        updateDateTime();
        setInterval(updateDateTime, 60000);
    </script>
    
    @stack('scripts')
</body>
</html>