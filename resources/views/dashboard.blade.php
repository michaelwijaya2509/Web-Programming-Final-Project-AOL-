<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> -->

@extends('layouts.app')

@section('title', 'Home - Sports Arena Booking')

@push('styles')
<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #3b82f6;
        --secondary: #64748b;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --dark: #1e293b;
        --light: #f8fafc;
        --glass-bg: rgba(255, 255, 255, 0.92);
        --glass-border: rgba(255, 255, 255, 0.2);
    }

    /* Professional Hero Section with Parallax */
    .hero-section {
        position: relative;
        overflow: hidden;
        min-height: 90vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, 
                    rgba(37, 99, 235, 0.95) 0%, 
                    rgba(29, 78, 216, 0.95) 100%),
                    url('https://images.unsplash.com/photo-1546519638-68e109498ffc?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        margin: 1rem;
        border-radius: 24px;
        isolation: isolate;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            linear-gradient(45deg, 
                transparent 45%,
                rgba(255, 255, 255, 0.1) 50%,
                transparent 55%);
        background-size: 300% 300%;
        animation: subtle-shimmer 8s ease-in-out infinite;
        z-index: -1;
    }

    @keyframes subtle-shimmer {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .hero-gradient-overlay {
        position: absolute;
        inset: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 40%),
            radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.08) 0%, transparent 40%);
        z-index: -1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        animation: fade-in-up 1s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-badge {
        background: linear-gradient(135deg, var(--warning), #fbbf24);
        color: var(--dark);
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        animation: float-badge 6s ease-in-out infinite;
    }

    @keyframes float-badge {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        33% { transform: translateY(-8px) rotate(-1deg); }
        66% { transform: translateY(-4px) rotate(1deg); }
    }

    .hero-badge::before {
        content: '';
        width: 8px;
        height: 8px;
        background: var(--danger);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.2); }
    }

    .hero-stats {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 1.5rem;
        margin-top: 3rem;
    }

    .stat-item {
        text-align: center;
        padding: 0 1.5rem;
        position: relative;
    }

    .stat-item:not(:last-child)::after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 1px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        line-height: 1;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.8);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Professional Booking Card */
    .booking-section {
        position: relative;
        z-index: 20;
        margin-top: -80px;
    }

    .booking-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        box-shadow: 
            0 20px 60px rgba(37, 99, 235, 0.1),
            0 10px 30px rgba(0, 0, 0, 0.05),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
        overflow: hidden;
        position: relative;
    }

    .booking-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--primary) 0%, 
            var(--primary-light) 50%, 
            var(--primary) 100%);
        background-size: 200% 100%;
        animation: shimmer-line 3s infinite linear;
    }

    @keyframes shimmer-line {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }

    .section-header::after {
        content: '';
        position: absolute;
        bottom: -1rem;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: var(--primary);
        border-radius: 2px;
    }

    .form-group-enhanced {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--dark);
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .form-control-pro {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        background: white;
        color: var(--dark);
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    .form-control-pro:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        transform: translateY(-1px);
    }

    .form-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary);
        font-size: 1.25rem;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .form-control-pro:focus + .form-icon {
        color: var(--primary-dark);
        transform: translateY(-50%) scale(1.1);
    }

    .btn-primary-pro {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 1rem 2rem;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        height: 56px;
    }

    .btn-primary-pro:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
    }

    .btn-primary-pro:active:not(:disabled) {
        transform: translateY(0);
    }

    .btn-primary-pro:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Quick Filters */
    .quick-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e2e8f0;
    }

    .filter-chip {
        padding: 0.5rem 1.25rem;
        border: 2px solid #e2e8f0;
        border-radius: 50px;
        background: white;
        color: var(--secondary);
        font-weight: 500;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-chip:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);
    }

    .filter-chip.active {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-color: transparent;
        color: white;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    /* Sports Categories */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .category-card-pro {
        position: relative;
        height: 180px;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .category-card-pro:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .category-image {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        transform: scale(1.1);
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .category-card-pro:hover .category-image {
        transform: scale(1);
    }

    .category-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, 
            rgba(0, 0, 0, 0.8) 0%, 
            rgba(0, 0, 0, 0.4) 50%, 
            transparent 100%);
        z-index: 1;
    }

    .category-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1.5rem;
        z-index: 2;
        color: white;
    }

    .category-icon {
        font-size: 3rem;
        margin-bottom: 0.5rem;
        opacity: 0.9;
        transition: all 0.3s ease;
    }

    .category-card-pro:hover .category-icon {
        transform: scale(1.1) rotate(5deg);
        opacity: 1;
    }

    /* How It Works */
    .how-it-works-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .step-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        position: relative;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
    }

    .step-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .step-number {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0 auto 1.5rem;
        position: relative;
        z-index: 1;
    }

    .step-number::before {
        content: '';
        position: absolute;
        inset: -6px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 50%;
        opacity: 0.2;
        z-index: -1;
        animation: pulse-ring 2s infinite;
    }

    @keyframes pulse-ring {
        0% { transform: scale(0.8); opacity: 0.5; }
        70%, 100% { transform: scale(1.2); opacity: 0; }
    }

    .step-icon {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 1.5rem;
    }

    /* Featured Courts */
    .courts-carousel {
        position: relative;
        margin-top: 3rem;
    }

    .court-card-pro {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
    }

    .court-card-pro:hover {
        transform: translateY(-12px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.1);
    }

    .court-image-pro {
        height: 200px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .court-card-pro:hover .court-image-pro {
        transform: scale(1.05);
    }

    .court-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: linear-gradient(135deg, var(--danger), #dc2626);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.05em;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .court-rating {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning);
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .court-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-top: 0.5rem;
    }

    /* Trust Indicators Section (Unchanged) */
    .trust-section {
        background: linear-gradient(rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.85)), 
                    url('https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 5rem 0;
        border-radius: 24px;
        margin: 4rem 0;
        color: white;
    }

    /* Testimonials */
    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .testimonial-card-pro {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        position: relative;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
    }

    .testimonial-card-pro:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .testimonial-card-pro::before {
        content: '"';
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        font-size: 4rem;
        color: rgba(37, 99, 235, 0.1);
        font-family: Georgia, serif;
        line-height: 1;
    }

    .testimonial-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 24px;
        padding: 5rem 2rem;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin-top: 4rem;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: 
            radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 70% 70%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        animation: cta-bg-float 20s ease-in-out infinite alternate;
    }

    @keyframes cta-bg-float {
        0% { transform: translate(0, 0); }
        100% { transform: translate(30px, 30px); }
    }

    .cta-content {
        position: relative;
        z-index: 2;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            min-height: 70vh;
            margin: 0.5rem;
            background-attachment: scroll;
        }

        .hero-section h1 {
            font-size: 2.5rem;
        }

        .booking-section {
            margin-top: -40px;
        }

        .booking-card {
            margin: 0 1rem;
        }

        .stat-item {
            padding: 0 1rem;
        }

        .stat-number {
            font-size: 2rem;
        }

        .categories-grid,
        .how-it-works-grid,
        .testimonials-grid {
            grid-template-columns: 1fr;
        }

        .category-card-pro {
            height: 160px;
        }

        .trust-section {
            padding: 3rem 1rem;
            margin: 2rem 0;
            background-attachment: scroll;
        }

        .cta-section {
            padding: 3rem 1rem;
            margin: 2rem 0;
        }
    }

    @media (max-width: 480px) {
        .hero-section {
            min-height: 60vh;
        }

        .hero-section h1 {
            font-size: 2rem;
        }

        .hero-badge {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }

        .form-group-enhanced {
            margin-bottom: 1rem;
        }

        .btn-primary-pro {
            padding: 0.875rem 1.5rem;
            font-size: 0.875rem;
        }

        .step-card,
        .testimonial-card-pro {
            padding: 1.5rem;
        }
    }

    /* Accessibility */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    /* Loading States */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .spinner {
        width: 24px;
        height: 24px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Utility Classes */
    .text-gradient {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .shadow-subtle {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .border-light {
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-0">
    <!-- Professional Hero Section with Parallax -->
    <section class="hero-section">
        <div class="hero-gradient-overlay"></div>
        
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-12 hero-content">
                    <!-- Premium Badge -->
                    <div class="hero-badge mb-4">
                        <span>#1 Sports Booking Platform 2024</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="display-3 fw-bold text-white mb-4">
                        Book Premium <span class="text-warning">Sports Facilities</span> Instantly
                    </h1>
                    
                    <!-- Description -->
                    <p class="lead text-white opacity-90 mb-5 fs-4">
                        Discover and book top-rated sports courts with real-time availability. 
                        Seamless experience from booking to play.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="d-flex flex-wrap gap-3 mb-5">
                        <a href="/courts" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-semibold shadow-lg">
                            <i class="bi bi-search me-2"></i>Explore Courts
                        </a>
                        <a href="#booking-section" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-semibold">
                            <i class="bi bi-lightning me-2"></i>Quick Booking
                        </a>
                    </div>

                    <!-- Live Stats -->
                    <div class="hero-stats">
                        <div class="row">
                            <div class="col-4 stat-item">
                                <div class="stat-number" data-count="500">500+</div>
                                <div class="stat-label">Courts</div>
                            </div>
                            <div class="col-4 stat-item">
                                <div class="stat-number" data-count="15000">15K+</div>
                                <div class="stat-label">Active Users</div>
                            </div>
                            <div class="col-4 stat-item">
                                <div class="stat-number" data-count="98">98%</div>
                                <div class="stat-label">Satisfaction</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1549060279-7e168fce7090?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                             class="img-fluid rounded-4 shadow-lg"
                             alt="Premium Sports Facilities"
                             loading="lazy">
                       
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Professional Booking Section -->
    <section class="booking-section" id="booking-section">
        <div class="container">
            <div class="booking-card p-4 p-lg-5">
                <!-- Section Header -->
                <div class="section-header">
                    <h2 class="fw-bold mb-2">Find Your Perfect Court</h2>
                    <p class="text-muted">Select your preferences and discover premium facilities</p>
                </div>

                <!-- Booking Form -->
                <form action="/courts/search" method="GET" id="bookingForm">
                    <div class="row g-4">
                        <!-- Sport Type -->
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group-enhanced">
                                <label class="form-label">Sport Type</label>
                                <div class="position-relative">
                                    <i class="form-icon bi bi-sports-football"></i>
                                    <select class="form-control-pro" name="sport" id="sportSelect">
                                        <option value="">All Sports</option>
                                        <option value="futsal">Futsal</option>
                                        <option value="badminton">Badminton</option>
                                        <option value="basketball">Basketball</option>
                                        <option value="tennis">Tennis</option>
                                        <option value="volleyball">Volleyball</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group-enhanced">
                                <label class="form-label">Location</label>
                                <div class="position-relative">
                                    <i class="form-icon bi bi-geo-alt"></i>
                                    <input type="text" 
                                           class="form-control-pro" 
                                           placeholder="Enter city or venue"
                                           name="location"
                                           id="locationInput"
                                           autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="col-lg-2 col-md-6">
                            <div class="form-group-enhanced">
                                <label class="form-label">Date</label>
                                <div class="position-relative">
                                    <i class="form-icon bi bi-calendar3"></i>
                                    <input type="date" 
                                           class="form-control-pro" 
                                           name="date"
                                           id="dateInput">
                                </div>
                            </div>
                        </div>

                        <!-- Time Slot -->
                        <div class="col-lg-2 col-md-6">
                            <div class="form-group-enhanced">
                                <label class="form-label">Time Slot</label>
                                <div class="position-relative">
                                    <i class="form-icon bi bi-clock"></i>
                                    <select class="form-control-pro" name="time" id="timeSelect">
                                        <option value="">Any Time</option>
                                        <option value="06:00-12:00">Morning (6AM-12PM)</option>
                                        <option value="12:00-18:00">Afternoon (12PM-6PM)</option>
                                        <option value="18:00-24:00">Evening (6PM-12AM)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="col-lg-2 d-flex align-items-end">
                            <button type="submit" class="btn-primary-pro w-100" id="searchButton">
                                <span class="btn-content">
                                    <i class="bi bi-search me-2"></i>
                                    Search
                                </span>
                                <span class="spinner" style="display: none;"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Quick Filters -->
                    <div class="quick-filters">
                        <div class="text-muted mb-2 fw-semibold">Popular Categories:</div>
                        <div>
                            <button type="button" class="filter-chip" data-sport="futsal">
                                ⚽ Futsal Courts
                            </button>
                            <button type="button" class="filter-chip" data-sport="badminton">
                                🏸 Badminton
                            </button>
                            <button type="button" class="filter-chip" data-sport="basketball">
                                🏀 Basketball
                            </button>
                            <button type="button" class="filter-chip" data-filter="indoor">
                                🏢 Indoor Facilities
                            </button>
                            <button type="button" class="filter-chip" data-filter="lighting">
                                💡 Professional Lighting
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Sports Categories -->
    <section class="container my-5 py-5">
        <div class="section-header">
            <h2 class="fw-bold mb-2">Popular Sports Categories</h2>
            <p class="text-muted">Browse courts by sport type</p>
        </div>

        <div class="categories-grid">
            @php
                $categories = [
                    ['name' => 'Futsal', 'count' => '150+ Courts', 'icon' => '⚽', 'img' => 'photo-1495568995593-8b4b1786d0c7'],
                    ['name' => 'Badminton', 'count' => '120+ Courts', 'icon' => '🏸', 'img' => 'photo-1626224583764-f87db24ac4ea'],
                    ['name' => 'Basketball', 'count' => '80+ Courts', 'icon' => '🏀', 'img' => 'photo-1546519638-68e109498ffc'],
                    ['name' => 'Tennis', 'count' => '60+ Courts', 'icon' => '🎾', 'img' => 'photo-1554068865-24cecd4e34b8'],
                    ['name' => 'Volleyball', 'count' => '45+ Courts', 'icon' => '🏐', 'img' => 'photo-1612872087720-bb876e2e67d1'],
                    ['name' => 'Swimming', 'count' => '25+ Pools', 'icon' => '🏊', 'img' => 'photo-1544620347-c4fd4a3d5957'],
                ];
            @endphp

            @foreach($categories as $category)
            <a href="/courts?sport={{ strtolower($category['name']) }}" class="text-decoration-none">
                <div class="category-card-pro">
                    <div class="category-image" 
                         style="background-image: url('https://images.unsplash.com/{{$category['img']}}?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80')">
                    </div>
                    <div class="category-overlay"></div>
                    <div class="category-content">
                        <div class="category-icon">{{$category['icon']}}</div>
                        <h4 class="fw-bold mb-1">{{$category['name']}}</h4>
                        <p class="mb-0 opacity-75">{{$category['count']}}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <!-- How It Works -->
    <section class="container my-5 py-5 bg-light rounded-4">
        <div class="section-header">
            <h2 class="fw-bold mb-2">How It Works</h2>
            <p class="text-muted">Book your court in three simple steps</p>
        </div>

        <div class="how-it-works-grid">
            <div class="step-card">
                <div class="step-number">1</div>
                <div class="step-icon">
                    <i class="bi bi-search"></i>
                </div>
                <h5 class="fw-bold mb-3">Search & Select</h5>
                <p class="text-muted mb-0">
                    Find your preferred court using our advanced filters and real-time availability system.
                </p>
            </div>

            <div class="step-card">
                <div class="step-number">2</div>
                <div class="step-icon">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <h5 class="fw-bold mb-3">Book & Confirm</h5>
                <p class="text-muted mb-0">
                    Select your time slot and confirm booking with secure payment options.
                </p>
            </div>

            <div class="step-card">
                <div class="step-number">3</div>
                <div class="step-icon">
                    <i class="bi bi-trophy"></i>
                </div>
                <h5 class="fw-bold mb-3">Play & Enjoy</h5>
                <p class="text-muted mb-0">
                    Receive instant confirmation and enjoy your game at premium facilities.
                </p>
            </div>
        </div>
    </section>

    <!-- Featured Courts -->
    <section class="container my-5 py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-2">Featured Courts</h2>
                <p class="text-muted mb-0">Top-rated facilities this week</p>
            </div>
            <a href="/courts" class="btn btn-link text-decoration-none">
                View All <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="courts-carousel">
            <div class="row g-4">
                @php
                    $courts = [
                        ['name' => 'Pro Futsal Arena', 'type' => 'Futsal', 'location' => 'Central Jakarta', 'price' => 200000, 'rating' => 4.9, 'badge' => 'PREMIUM', 'img' => 'photo-1551958219-acbc608c6377', 'reviews' => 245],
                        ['name' => 'Elite Badminton Center', 'type' => 'Badminton', 'location' => 'South Jakarta', 'price' => 150000, 'rating' => 4.8, 'badge' => 'BEST SELLER', 'img' => 'photo-1626224583764-f87db24ac4ea', 'reviews' => 189],
                        ['name' => 'Max Basketball Court', 'type' => 'Basketball', 'location' => 'West Jakarta', 'price' => 250000, 'rating' => 4.7, 'badge' => 'NEW', 'img' => 'photo-1546519638-68e109498ffc', 'reviews' => 156],
                    ];
                @endphp

                @foreach($courts as $court)
                <div class="col-lg-4 col-md-6">
                    <div class="court-card-pro">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/{{$court['img']}}?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 class="court-image-pro"
                                 alt="{{$court['name']}}"
                                 loading="lazy">
                            <div class="court-badge">{{$court['badge']}}</div>
                        </div>
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="fw-bold mb-1">{{$court['name']}}</h5>
                                    <p class="text-muted mb-2">
                                        <i class="bi bi-geo-alt me-1"></i>{{$court['location']}}
                                    </p>
                                </div>
                                <div class="court-rating">
                                    <i class="bi bi-star-fill"></i>
                                    {{$court['rating']}}
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                    <i class="bi bi-wifi me-1"></i> Free WiFi
                                </span>
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                    <i class="bi bi-droplet me-1"></i> Air Conditioned
                                </span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small">Starting from</div>
                                    <div class="court-price">Rp {{number_format($court['price'], 0, ',', '.')}}/hour</div>
                                </div>
                                <a href="/courts/1" class="btn btn-primary rounded-pill px-4">
                                    <i class="bi bi-calendar-plus me-1"></i> Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Trust Indicators Section (Unchanged as requested) -->
    <section class="trust-section text-white text-center">
        <div class="container">
            <h2 class="fw-bold mb-4">Trusted by Thousands of Athletes</h2>
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="p-3">
                        <div class="display-4 fw-bold mb-2">15K+</div>
                        <p class="mb-0 opacity-75">Monthly Active Users</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3">
                        <div class="display-4 fw-bold mb-2">98%</div>
                        <p class="mb-0 opacity-75">Satisfaction Rate</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3">
                        <div class="display-4 fw-bold mb-2">24/7</div>
                        <p class="mb-0 opacity-75">Customer Support</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3">
                        <div class="display-4 fw-bold mb-2">4.8★</div>
                        <p class="mb-0 opacity-75">Average Rating</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="container my-5 py-5">
        <div class="section-header">
            <h2 class="fw-bold mb-2">Client Testimonials</h2>
            <p class="text-muted">What our users say about us</p>
        </div>

        <div class="testimonials-grid">
            @php
                $testimonials = [
                    ['name' => 'Alex Johnson', 'role' => 'Professional Athlete', 'rating' => 5, 'text' => 'The platform transformed how I book training facilities. Real-time availability and instant confirmation are game-changers.', 'avatar' => 'AJ'],
                    ['name' => 'Maria Garcia', 'role' => 'Fitness Coach', 'rating' => 5, 'text' => 'As a coach managing multiple teams, this platform has streamlined our booking process dramatically.', 'avatar' => 'MG'],
                    ['name' => 'David Chen', 'role' => 'Sports Director', 'rating' => 5, 'text' => 'Professional, reliable, and efficient. The best sports booking platform I have used.', 'avatar' => 'DC'],
                ];
            @endphp

            @foreach($testimonials as $testimonial)
            <div class="testimonial-card-pro">
                <div class="testimonial-avatar">{{$testimonial['avatar']}}</div>
                <div class="star-rating mb-3">
                    @for($i = 1; $i <= $testimonial['rating']; $i++)
                    <i class="bi bi-star-fill text-warning"></i>
                    @endfor
                </div>
                <p class="mb-4 fst-italic">"{{$testimonial['text']}}"</p>
                <div>
                    <h6 class="fw-bold mb-1">{{$testimonial['name']}}</h6>
                    <small class="text-muted">{{$testimonial['role']}}</small>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Final CTA -->
    <section class="cta-section">
        <div class="cta-content">
            <h2 class="display-5 fw-bold mb-3">Ready to Get Started?</h2>
            <p class="lead mb-4 opacity-90">
                Join thousands of athletes and teams booking premium sports facilities
            </p>
            <div class="d-flex flex-wrap gap-3 justify-content-center">
                <a href="/register" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-semibold">
                    <i class="bi bi-person-plus me-2"></i>Start Free Trial
                </a>
                <a href="/contact" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-semibold">
                    <i class="bi bi-chat-left-text me-2"></i>Contact Sales
                </a>
            </div>
            <p class="mt-4 mb-0 opacity-75 small">
                No credit card required • Cancel anytime • 24/7 Support
            </p>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    class SportsBookingApp {
        constructor() {
            this.init();
        }

        init() {
            this.initCounters();
            this.initForm();
            this.initFilters();
            this.initDate();
            this.initParallax();
            this.initAnimations();
        }

        initCounters() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            });

            document.querySelectorAll('.stat-number').forEach(counter => {
                observer.observe(counter);
            });
        }

        animateCounter(element) {
            const target = parseInt(element.getAttribute('data-count'));
            const suffix = element.textContent.includes('+') ? '+' : 
                          element.textContent.includes('%') ? '%' : '';
            const duration = 1500;
            const start = 0;
            const startTime = performance.now();

            const updateCounter = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                // Easing function
                const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                const value = Math.floor(easeOutQuart * target);
                
                element.textContent = value + suffix;
                
                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                }
            };

            requestAnimationFrame(updateCounter);
        }

        initForm() {
            const form = document.getElementById('bookingForm');
            const button = document.getElementById('searchButton');
            const buttonContent = button.querySelector('.btn-content');
            const spinner = button.querySelector('.spinner');

            if (form) {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    
                    // Show loading state
                    button.disabled = true;
                    buttonContent.style.opacity = '0';
                    spinner.style.display = 'block';
                    
                    // Simulate API call
                    await new Promise(resolve => setTimeout(resolve, 1000));
                    
                    // Submit form
                    form.submit();
                });

                // Form validation
                const inputs = form.querySelectorAll('.form-control-pro');
                inputs.forEach(input => {
                    input.addEventListener('blur', () => {
                        this.validateInput(input);
                    });
                });
            }
        }

        validateInput(input) {
            if (!input.value.trim()) {
                input.style.borderColor = 'var(--danger)';
                input.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
            } else {
                input.style.borderColor = 'var(--primary)';
                input.style.boxShadow = '0 0 0 3px rgba(37, 99, 235, 0.1)';
            }
        }

        initFilters() {
            document.querySelectorAll('.filter-chip').forEach(chip => {
                chip.addEventListener('click', () => {
                    // Remove active class from all chips
                    document.querySelectorAll('.filter-chip').forEach(c => {
                        c.classList.remove('active');
                    });
                    
                    // Add active class to clicked chip
                    chip.classList.add('active');
                    
                    // Update form values
                    const sport = chip.dataset.sport;
                    const filter = chip.dataset.filter;
                    
                    if (sport) {
                        const sportSelect = document.getElementById('sportSelect');
                        if (sportSelect) sportSelect.value = sport;
                    }
                    
                    // Animate chip
                    chip.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        chip.style.transform = '';
                    }, 150);
                });
            });
        }

        initDate() {
            const dateInput = document.getElementById('dateInput');
            if (dateInput) {
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                
                const today = new Date().toISOString().split('T')[0];
                const tomorrowStr = tomorrow.toISOString().split('T')[0];
                
                dateInput.min = today;
                dateInput.value = tomorrowStr;
            }
        }

        initParallax() {
            // Check for reduced motion preference
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            
            if (prefersReducedMotion) return;
            
            // Parallax effect for hero section
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const heroSection = document.querySelector('.hero-section');
                const trustSection = document.querySelector('.trust-section');
                
                if (heroSection) {
                    const rate = scrolled * 0.5;
                    heroSection.style.backgroundPositionY = `${rate * 0.5}px`;
                }
                
                if (trustSection) {
                    const rate = scrolled * 0.3;
                    trustSection.style.backgroundPositionY = `${rate * 0.3}px`;
                }
            });
        }

        initAnimations() {
            // Intersection Observer for scroll animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            // Observe elements for animation
            document.querySelectorAll('.category-card-pro, .step-card, .court-card-pro, .testimonial-card-pro')
                .forEach(el => observer.observe(el));
        }
    }

    // Initialize the application
    document.addEventListener('DOMContentLoaded', () => {
        new SportsBookingApp();
    });

    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            // Re-initialize any layout-dependent features
        }, 250);
    });
</script>
@endpush