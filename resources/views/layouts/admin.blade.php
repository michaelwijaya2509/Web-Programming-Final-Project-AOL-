<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin Meraket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --sidebar-width: 280px;
            --primary-color: #FF6700;
            --primary-hover: #ff8533;
            --sidebar-bg-start: #0f172a;
            --sidebar-bg-end: #1e293b;
            --glass-bg: rgba(255, 255, 255, 0.7);
            --text-main: #334155;
            --bg-body: #f1f5f9;
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* --- 1. SIDEBAR PREMIUM --- */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--sidebar-bg-start) 0%, var(--sidebar-bg-end) 100%);
            color: white;
            z-index: 1000;
            transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .sidebar-header {
            padding: 24px;
            background: rgba(0, 0, 0, 0.2);
        }

        .sidebar-brand {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .brand-icon-box {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #FF6700, #ff9100);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: white;
            box-shadow: 0 0 15px rgba(255, 103, 0, 0.4);
            transition: transform 0.3s ease;
        }

        .sidebar-brand:hover .brand-icon-box {
            transform: rotate(10deg) scale(1.05);
        }

        .brand-text h4 {
            font-weight: 800;
            margin: 0;
            color: white;
            font-size: 1.25rem;
            letter-spacing: -0.5px;
        }

        .sidebar-menu {
            padding: 20px 16px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .nav-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #94a3b8;
            font-weight: 700;
            margin: 20px 0 10px 10px;
        }

        .nav-link {
            color: #cbd5e1;
            padding: 13px 16px;
            border-radius: 12px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            /* Penting untuk button looks like link */
        }

        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(3px);
        }

        .nav-link.active {
            background: linear-gradient(90deg, rgba(255, 103, 0, 0.15), transparent);
            color: #FF6700;
            border-left: 3px solid #FF6700;
            border-radius: 4px 12px 12px 4px;
        }

        .nav-link i {
            font-size: 1.15rem;
            transition: 0.3s;
        }

        .nav-link.active i {
            color: #FF6700;
            transform: scale(1.1);
        }

        /* --- 2. GLASS NAVBAR --- */
        .navbar-admin {
            margin-left: var(--sidebar-width);
            padding: 18px 30px;
            position: sticky;
            top: 0;
            z-index: 100;
            transition: all 0.3s ease;
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }

        /* Search Bar */
        .search-group {
            position: relative;
            width: 280px;
            transition: width 0.4s ease;
        }

        .search-group:focus-within {
            width: 380px;
        }

        .search-group input {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 10px 10px 10px 45px;
            border-radius: 50px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
            transition: all 0.3s;
        }

        .search-group input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(255, 103, 0, 0.15);
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }

        /* --- 3. MAIN CONTENT --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            min-height: 100vh;
            animation: fadeInUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* --- 4. EXTRAS --- */
        .btn-icon-hover {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            background: transparent;
            color: #64748b;
        }

        .btn-icon-hover:hover {
            background: #fff0e6;
            color: #FF6700;
            transform: translateY(-2px);
        }

        .user-profile-btn {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 6px 15px 6px 6px;
            border-radius: 50px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .user-profile-btn:hover {
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .avatar-circle {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #1e293b, #334155);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background-color: #ef4444;
            border-radius: 50%;
            position: absolute;
            top: 10px;
            right: 12px;
            animation: pulse-red 2s infinite;
        }

        @keyframes pulse-red {
            0% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            }

            70% {
                box-shadow: 0 0 0 6px rgba(239, 68, 68, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content,
            .navbar-admin {
                margin-left: 0;
            }

            .search-group {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ url('admin/') }}" class="sidebar-brand">
                <div class="brand-icon-box">
                    <i class="bi bi-trophy-fill"></i>
                </div>
                <div class="brand-text">
                    <h4>Meraket</h4>
                    <small style="color: #94a3b8; font-weight: 500;">Admin Dashboard</small>
                </div>
            </a>
        </div>

        <div class="sidebar-menu">
            <div class="nav-title">Menu Utama</div>
            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}" href="{{ url('/admin') }}">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/bookings*') ? 'active' : '' }}"
                        href="{{ url('/admin/bookings') }}">
                        <i class="bi bi-calendar2-check-fill"></i>
                        <span>Bookings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/venue*') ? 'active' : '' }}"
                        href="{{ url('/admin/venue') }}">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Venues</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/transactions*') ? 'active' : '' }}"
                        href="{{ url('/admin/transactions') }}">
                        <i class="bi bi-credit-card-fill"></i>
                        <span>Transactions</span>
                    </a>
                </li>
                <div class="nav-title mt-4">Lainnya</div>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/settings*') ? 'active' : '' }}" href="#">
                        <i class="bi bi-gear-fill"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <nav class="navbar-admin d-flex justify-content-between align-items-center" id="navbarAdmin">
        <div class="d-flex align-items-center gap-4">
            <button class="btn border-0 d-lg-none p-0" id="sidebarToggle">
                <i class="bi bi-list fs-2 text-dark"></i>
            </button>
            <div class="search-group d-none d-md-block">
                <i class="bi bi-search search-icon"></i>
                <input type="text" placeholder="Cari booking, nama, atau ID..." aria-label="Search">
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <a href="{{ url('/') }}" class="btn-icon-hover" data-bs-toggle="tooltip" title="Lihat Website">
                <i class="bi bi-globe2 fs-5"></i>
            </a>

            <div class="dropdown">
                <button class="btn-icon-hover border-0 position-relative" data-bs-toggle="dropdown">
                    <i class="bi bi-bell fs-5"></i>
                    <div class="status-dot"></div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-3 rounded-4 mt-2" style="width: 300px;">
                    <li>
                        <h6 class="dropdown-header text-uppercase fw-bold text-muted small">Notifikasi</h6>
                    </li>
                    <li><a class="dropdown-item p-2 rounded-3 mb-1" href="#">Booking Baru #ORD-99</a></li>
                </ul>
            </div>

            <div style="width: 1px; height: 24px; background: #e2e8f0;"></div>

            <div class="dropdown">
                <div class="user-profile-btn d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                    <div class="avatar-circle">A</div>
                    <div class="d-none d-sm-block text-start me-1">
                        <div class="fw-bold text-dark" style="font-size: 0.85rem; line-height: 1.2;">{{ Auth::user()->name }}</div>
                        <div class="text-muted" style="font-size: 0.7rem;">Admin</div>
                    </div>
                    <i class="bi bi-chevron-down text-muted" style="font-size: 0.8rem;"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 rounded-4 mt-2">
                    <li><a class="dropdown-item rounded-3" href="#"><i class="bi bi-person me-2"></i> Profile</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        {{-- FIXED: Button Logout Navbar (Form langsung) --}}
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="dropdown-item text-danger rounded-3 w-100 text-start border-0 bg-transparent">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content" id="mainContent">
        @yield('content')
    </main>

    {{-- form id="logout-form" SUDAH DIHAPUS --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        sidebarToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        document.addEventListener('click', (e) => {
            if (window.innerWidth < 992) {
                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
