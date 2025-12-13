<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Meraket Booking</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary: #FF6700;
            --primary-dark: #E65C00;
            --primary-light: #FF9F66;
            --secondary: #64748b;
            --accent: #2563eb;
            --success: #10b981;
            --danger: #ef4444;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --border-radius: 10px;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.08);
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }

        /* ===== NAVBAR ===== */
        .navbar-main {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: var(--shadow-sm);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 0;
            height: 70px;
            display: flex;
            align-items: center;
            transition: var(--transition);
        }

        .navbar-main.scrolled {
            box-shadow: var(--shadow-md);
            height: 65px;
        }

        .navbar-container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        @media (max-width: 768px) {
            .navbar-container {
                padding: 0 1rem;
            }
        }

        .navbar-content {
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            height: 100%;
            width: 100%;
            gap: 2rem;
        }

        /* Brand Logo - tetap di kiri */
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: var(--dark);
            font-weight: 700;
            font-size: 1.5rem;
            white-space: nowrap;
            padding: 0.5rem 0;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 10px;
            color: white;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        /* Logo Image Styling */
        .navbar-brand img {
            height: 100px;
            width: auto;
            max-width: 200px;
            object-fit: contain;
        }

        .brand-name {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Navigation Center - Menu Links */
        .nav-center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            list-style: none;
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .nav-item {
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem;
            text-decoration: none;
            color: var(--secondary);
            font-weight: 500;
            font-size: 0.95rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            white-space: nowrap;
            height: 44px;
        }

        .nav-link:hover {
            color: var(--primary);
            background: rgba(37, 99, 235, 0.04);
        }

        .nav-link.active {
            color: var(--primary);
            background: rgba(37, 99, 235, 0.08);
            font-weight: 600;
        }

        .nav-icon {
            font-size: 1.1rem;
            opacity: 0.8;
            flex-shrink: 0;
        }

        .nav-text {
            flex-shrink: 0;
        }

        /* Right Actions */
        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            justify-content: flex-end;
        }

        /* Search Bar */
        .search-wrapper {
            position: relative;
            width: 280px;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius);
            background: var(--gray-50);
            font-size: 0.9rem;
            color: var(--dark);
            transition: var(--transition);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
            font-size: 1rem;
        }

        /* Auth Buttons */
        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-auth {
            padding: 0.6rem 1.25rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            font-size: 0.875rem;
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .btn-login {
            color: var(--primary);
            background: transparent;
            border: 1px solid var(--gray-200);
        }

        .btn-login:hover {
            background: rgba(37, 99, 235, 0.04);
            border-color: var(--primary);
            transform: translateY(-1px);
        }

        .btn-register {
            color: white;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        }

        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2);
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
        }

        .user-dropdown-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 0.75rem;
            background: transparent;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius);
            color: var(--dark);
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
        }

        .user-dropdown-btn:hover {
            background: var(--gray-50);
            border-color: var(--gray-300);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .user-info {
            text-align: left;
            flex-shrink: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            margin: 0;
            line-height: 1.2;
            white-space: nowrap;
        }

        .user-status {
            font-size: 0.75rem;
            color: var(--success);
            margin: 0;
            line-height: 1.2;
            white-space: nowrap;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            padding: 0.5rem;
            min-width: 240px;
            margin-top: 0.75rem;
            border: 1px solid var(--gray-200);
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            color: var(--dark);
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: var(--transition);
        }

        .dropdown-item:hover {
            background: rgba(37, 99, 235, 0.06);
            color: var(--primary);
        }

        .dropdown-divider {
            margin: 0.5rem 0;
            border-color: var(--gray-200);
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            width: 44px;
            height: 44px;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius);
            background: transparent;
            color: var(--dark);
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            flex-shrink: 0;
        }

        .mobile-menu-btn:hover {
            background: var(--gray-50);
        }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            background: white;
            box-shadow: var(--shadow-md);
            padding: 1.5rem;
            z-index: 999;
        }

        .mobile-menu.active {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mobile-nav-links {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .mobile-nav-item {
            margin-bottom: 0.5rem;
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .mobile-nav-link:hover,
        .mobile-nav-link.active {
            background: var(--gray-50);
            color: var(--primary);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .search-wrapper {
                width: 240px;
            }

            .nav-link {
                padding: 0.75rem 1rem;
            }
        }

        @media (max-width: 1024px) {
            .search-wrapper {
                width: 200px;
            }

            .nav-text {
                display: none;
            }

            .nav-link {
                padding: 0.75rem;
            }

            .nav-icon {
                margin: 0;
            }
        }

        @media (max-width: 900px) {
            .navbar-content {
                grid-template-columns: auto 1fr auto;
            }

            .nav-center {
                display: none;
            }

            .nav-right {
                display: none;
            }

            .mobile-menu-btn {
                display: flex;
            }

            .mobile-menu {
                display: none;
            }

            .mobile-menu.active {
                display: block;
            }
        }

        @media (max-width: 480px) {
            .navbar-container {
                padding: 0 1rem;
            }

            .navbar-brand {
                font-size: 1.25rem;
            }

            .navbar-brand img {
                height: 55px;
                max-width: 160px;
            }

            .brand-logo {
                width: 32px;
                height: 32px;
                font-size: 1rem;
            }

            .mobile-menu {
                top: 65px;
            }
        }

        /* ===== MAIN CONTENT ===== */
        main {
            min-height: calc(100vh - 400px);
            padding: 2rem 0;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: var(--dark);
            color: white;
            padding: 4rem 0 2rem;
            margin-top: 4rem;
        }

        .footer-container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        @media (max-width: 768px) {
            .footer-container {
                padding: 0 1rem;
            }
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 3rem;
            margin-bottom: 3rem;
        }

        @media (max-width: 900px) {
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 2rem;
            }
        }

        @media (max-width: 480px) {
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        .footer-brand {
            margin-bottom: 1.5rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .footer-description {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            font-size: 1rem;
            transition: var(--transition);
        }

        .social-link:hover {
            background: var(--primary);
            transform: translateY(-2px);
        }

        .footer-heading {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: white;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-link-item {
            margin-bottom: 0.75rem;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-link:hover {
            color: white;
            transform: translateX(4px);
        }

        .footer-contact {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .contact-icon {
            color: var(--primary-light);
            font-size: 1.1rem;
            margin-top: 0.25rem;
        }

        .contact-info {
            flex: 1;
        }

        .contact-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0.25rem;
        }

        .contact-value {
            font-size: 0.95rem;
            color: white;
            font-weight: 500;
            text-decoration: none;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        @media (max-width: 768px) {
            .footer-bottom {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }

        .copyright {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.875rem;
        }

        .legal-links {
            display: flex;
            gap: 1.5rem;
        }

        @media (max-width: 768px) {
            .legal-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }
        }

        .legal-link {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            font-size: 0.875rem;
            transition: var(--transition);
        }

        .legal-link:hover {
            color: white;
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Professional Navigation -->
    <nav class="navbar-main">
        <div class="navbar-container">
            <div class="navbar-content">
                <!-- Brand Logo -->
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('images/logo meraket.png') }}" alt="Logo">
                </a>

                <!-- Desktop Navigation Links - Center -->
                <div class="nav-center">
                    <ul class="nav-links">
                        <li class="nav-item">
                            <a class="nav-link active" href="/">
                                <i class="bi bi-house-door nav-icon"></i>
                                <span class="nav-text">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/venue">
                                <i class="bi bi-basket nav-icon"></i>
                                <span class="nav-text">Venues</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/scoreboard">
                                <i class="bi bi-trophy nav-icon"></i>
                                <span class="nav-text">Scoreboard</span>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="/shuffle">
                                <i class="bi bi-shuffle nav-icon"></i>
                                <span class="nav-text">Shuffle</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>

                <!-- Right Actions -->
                <div class="nav-right">

                    <!-- Auth Buttons / User Menu -->
                    @auth
                        <!-- User Dropdown -->
                        <div class="user-dropdown dropdown">
                            <button class="user-dropdown-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <div class="user-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="user-info">
                                    <p class="user-name">{{ Auth::user()->name }}</p>
                                    <p class="user-status">
                                        <i class="bi bi-check-circle-fill"></i> Premium
                                    </p>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="/profile">
                                        <i class="bi bi-person"></i>
                                        <span>My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/my-bookings">
                                        <i class="bi bi-calendar-check"></i>
                                        <span>My Bookings</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/settings">
                                        <i class="bi bi-gear"></i>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/help">
                                        <i class="bi bi-question-circle"></i>
                                        <span>Help Center</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <!-- Login/Register Buttons -->
                        <div class="auth-buttons">
                            <a href="/login" class="btn-auth btn-login">
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>Login</span>
                            </a>
                            <a href="/register" class="btn-auth btn-register">
                                <i class="bi bi-person-plus"></i>
                                <span>Register</span>
                            </a>
                        </div>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button class="mobile-menu-btn" id="mobileMenuBtn">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <ul class="mobile-nav-links">
            <li class="mobile-nav-item">
                <a class="mobile-nav-link active" href="/">
                    <i class="bi bi-house-door"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="/courts">
                    <i class="bi bi-basket"></i>
                    <span>Courts</span>
                </a>
            </li>
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="/scoreboard">
                    <i class="bi bi-trophy"></i>
                    <span>Scoreboard</span>
                </a>
            </li>
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="/shuffle">
                    <i class="bi bi-shuffle"></i>
                    <span>Shuffle Player</span>
                </a>
            </li>
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="/tournaments">
                    <i class="bi bi-people-fill"></i>
                    <span>Tournaments</span>
                </a>
            </li>

            @auth
                <li class="mobile-nav-item">
                    <a class="mobile-nav-link" href="/my-bookings">
                        <i class="bi bi-calendar-check"></i>
                        <span>My Bookings</span>
                    </a>
                </li>
                <li class="mobile-nav-item">
                    <a class="mobile-nav-link" href="/profile">
                        <i class="bi bi-person"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="mobile-nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="mobile-nav-link"
                            style="width: 100%; text-align: left; border: none; background: none;">
                            <i class="bi bi-box-arrow-right text-danger"></i>
                            <span class="text-danger">Logout</span>
                        </button>
                    </form>
                </li>
            @else
                <li class="mobile-nav-item">
                    <a href="/login" class="mobile-nav-link">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Login</span>
                    </a>
                </li>
                <li class="mobile-nav-item">
                    <a href="/register" class="mobile-nav-link">
                        <i class="bi bi-person-plus"></i>
                        <span>Register</span>
                    </a>
                </li>
            @endauth
        </ul>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Professional Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <!-- Brand Column -->
                <div>
                    <div class="footer-brand">
                        <a href="/" class="footer-logo">
                            <i class="bi bi-trophy-fill"></i>
                            <span>Meraket</span>
                        </a>
                        <p class="footer-description">
                            Platform booking lapangan olahraga premium dengan pengalaman terbaik untuk atlet dan
                            komunitas.
                        </p>
                    </div>
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="footer-heading">Quick Links</h3>
                    <ul class="footer-links">
                        <li class="footer-link-item">
                            <a href="/" class="footer-link">
                                <i class="bi bi-chevron-right"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/courts" class="footer-link">
                                <i class="bi bi-chevron-right"></i>
                                <span>Find Courts</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/tournaments" class="footer-link">
                                <i class="bi bi-chevron-right"></i>
                                <span>Tournaments</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/shuffle" class="footer-link">
                                <i class="bi bi-chevron-right"></i>
                                <span>Shuffle Player</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="footer-heading">Support</h3>
                    <ul class="footer-links">
                        <li class="footer-link-item">
                            <a href="/help" class="footer-link">
                                <i class="bi bi-question-circle"></i>
                                <span>Help Center</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/contact" class="footer-link">
                                <i class="bi bi-envelope"></i>
                                <span>Contact Us</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/faq" class="footer-link">
                                <i class="bi bi-info-circle"></i>
                                <span>FAQ</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/privacy" class="footer-link">
                                <i class="bi bi-shield-check"></i>
                                <span>Privacy Policy</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="footer-heading">Contact Info</h3>
                    <div class="footer-contact">
                        <div class="contact-item">
                            <i class="bi bi-geo-alt contact-icon"></i>
                            <div class="contact-info">
                                <div class="contact-label">Address</div>
                                <div class="contact-value">Jl. Olahraga No. 123, Jakarta</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-telephone contact-icon"></i>
                            <div class="contact-info">
                                <div class="contact-label">Phone</div>
                                <a href="tel:+6281234567890" class="contact-value">+62 812 3456 7890</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-envelope contact-icon"></i>
                            <div class="contact-info">
                                <div class="contact-label">Email</div>
                                <a href="mailto:info@meraket.com" class="contact-value">info@meraket.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="copyright">
                    &copy; 2025 Meraket. All rights reserved.
                </div>
                <div class="legal-links">
                    <a href="/privacy" class="legal-link">Privacy Policy</a>
                    <a href="/terms" class="legal-link">Terms of Service</a>
                    <a href="/cookies" class="legal-link">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('active');
                mobileMenuBtn.innerHTML = mobileMenu.classList.contains('active') ?
                    '<i class="bi bi-x-lg"></i>' :
                    '<i class="bi bi-list"></i>';
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', (event) => {
                if (!mobileMenu.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                    mobileMenu.classList.remove('active');
                    mobileMenuBtn.innerHTML = '<i class="bi bi-list"></i>';
                }
            });
        }

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-main');
            if (navbar) {
                if (window.scrollY > 20) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });

        // Set active nav link based on current URL
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });

            // If on home page, make home link active
            if (currentPath === '/') {
                document.querySelectorAll('.nav-link[href="/"], .mobile-nav-link[href="/"]')
                    .forEach(link => link.classList.add('active'));
            }

            // Close mobile menu when clicking a link
            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.remove('active');
                    mobileMenuBtn.innerHTML = '<i class="bi bi-list"></i>';
                });
            });

            // Add active class to parent nav-item
            document.querySelectorAll('.nav-link.active').forEach(activeLink => {
                const parentItem = activeLink.closest('.nav-item');
                if (parentItem) {
                    parentItem.classList.add('active');
                }
            });
        });

        // Initialize Bootstrap dropdowns
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            new bootstrap.Dropdown(dropdown);
        });

        // Search functionality
        const searchInput = document.querySelector('.search-input');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const query = this.value.trim();
                    if (query) {
                        window.location.href = `/courts?search=${encodeURIComponent(query)}`;
                    }
                }
            });
        }
    </script>
    @stack('scripts')
    @auth
        @include('partials.cart-popup')
@endauth
</body>

</html>
