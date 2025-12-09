@extends('layouts.app')

@section('title', 'Court Details - Sports Arena')

@push('styles')
<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #3b82f6;
        --secondary: #64748b;
        --accent: #f59e0b;
        --success: #10b981;
        --danger: #ef4444;
        --dark: #0f172a;
        --light: #f8fafc;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --border-radius: 12px;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
        --shadow-md: 0 4px 12px rgba(0,0,0,0.05);
        --shadow-lg: 0 10px 40px rgba(0,0,0,0.08);
        --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .court-detail-container {
        padding-top: 24px;
        padding-bottom: 48px;
    }

    /* Breadcrumb */
    .breadcrumb-section {
        margin-bottom: 24px;
    }

    .breadcrumb-custom {
        background: transparent;
        padding: 0;
        margin: 0;
    }

    .breadcrumb-custom .breadcrumb-item {
        font-size: 0.875rem;
        color: var(--secondary);
    }

    .breadcrumb-custom .breadcrumb-item a {
        color: var(--secondary);
        text-decoration: none;
        transition: var(--transition);
    }

    .breadcrumb-custom .breadcrumb-item a:hover {
        color: var(--primary);
    }

    .breadcrumb-custom .breadcrumb-item.active {
        color: var(--dark);
        font-weight: 500;
    }

    /* Image Gallery */
    .image-gallery-card {
        border: none;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        margin-bottom: 24px;
    }

    .court-carousel {
        border-radius: var(--border-radius);
        overflow: hidden;
    }

    .court-carousel .carousel-inner {
        border-radius: var(--border-radius);
    }

    .court-carousel .carousel-item img {
        height: 400px;
        object-fit: cover;
        width: 100%;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        margin: 0 16px;
        opacity: 0;
        transition: var(--transition);
    }

    .image-gallery-card:hover .carousel-control-prev,
    .image-gallery-card:hover .carousel-control-next {
        opacity: 1;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background: white;
        box-shadow: var(--shadow-md);
    }

    /* Court Info Card */
    .court-info-card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        margin-bottom: 24px;
        background: white;
    }

    .court-info-header {
        padding: 24px 24px 0;
    }

    .court-title-section {
        margin-bottom: 20px;
    }

    .court-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .court-location {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--secondary);
        font-size: 0.95rem;
        margin-bottom: 12px;
    }

    .court-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .court-tag {
        padding: 6px 12px;
        background: rgba(37, 99, 235, 0.08);
        color: var(--primary);
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .court-price-section {
        text-align: right;
    }

    .court-price {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 4px;
    }

    .price-label {
        font-size: 0.875rem;
        color: var(--secondary);
    }

    /* Rating */
    .rating-section {
        padding: 0 24px;
        margin-bottom: 24px;
    }

    .rating-container {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .rating-stars {
        display: flex;
        gap: 2px;
    }

    .rating-stars .bi-star-fill {
        color: var(--accent);
        font-size: 1.1rem;
    }

    .rating-value {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--dark);
    }

    .rating-count {
        color: var(--secondary);
        font-size: 0.95rem;
    }

    /* Description */
    .description-section {
        padding: 0 24px 24px;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 16px;
        position: relative;
        padding-bottom: 8px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background: var(--primary);
        border-radius: 2px;
    }

    .court-description {
        color: var(--dark);
        line-height: 1.7;
        margin-bottom: 20px;
    }

    .features-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 0;
    }

    .feature-icon {
        width: 24px;
        height: 24px;
        background: rgba(37, 99, 235, 0.1);
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 0.875rem;
    }

    /* Reviews */
    .reviews-section {
        padding: 0 24px 24px;
    }

    .reviews-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .review-card {
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius);
        padding: 20px;
        margin-bottom: 16px;
        background: white;
        transition: var(--transition);
    }

    .review-card:hover {
        box-shadow: var(--shadow-sm);
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .reviewer-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .reviewer-avatar {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1rem;
    }

    .reviewer-name {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 4px;
    }

    .review-date {
        font-size: 0.875rem;
        color: var(--secondary);
    }

    .review-content {
        color: var(--dark);
        line-height: 1.6;
    }

    /* Booking Card */
    .booking-card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-lg);
        position: sticky;
        top: 100px;
        background: white;
    }

    .booking-header {
        padding: 24px;
        border-bottom: 1px solid var(--gray-200);
    }

    .booking-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0;
    }

    .booking-form {
        padding: 24px;
    }

    .form-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 8px;
        display: block;
    }

    .form-control-custom {
        padding: 12px 16px;
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius);
        font-size: 0.95rem;
        color: var(--dark);
        transition: var(--transition);
        width: 100%;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .time-slots-container {
        margin-top: 8px;
    }

    .time-slot {
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius);
        padding: 12px 16px;
        margin-bottom: 8px;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .time-slot:hover:not(.booked) {
        border-color: var(--primary);
        background: rgba(37, 99, 235, 0.04);
    }

    .time-slot.selected {
        border-color: var(--primary);
        background: rgba(37, 99, 235, 0.08);
    }

    .time-slot.booked {
        opacity: 0.6;
        cursor: not-allowed;
        background: var(--gray-50);
    }

    .time-range {
        font-weight: 500;
        color: var(--dark);
    }

    .slot-status {
        font-size: 0.875rem;
        font-weight: 500;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .available {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .booked {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    /* Summary */
    .booking-summary {
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius);
        padding: 20px;
        margin: 24px 0;
        background: var(--gray-50);
    }

    .summary-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 16px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid var(--gray-200);
    }

    .summary-row:last-child {
        border-bottom: none;
        font-weight: 600;
        padding-top: 12px;
        color: var(--primary);
        font-size: 1.1rem;
    }

    /* Operating Hours */
    .hours-card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        margin-top: 24px;
        background: white;
    }

    .hours-body {
        padding: 20px;
    }

    .hours-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 16px;
    }

    .hours-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .hours-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid var(--gray-200);
    }

    .hours-item:last-child {
        border-bottom: none;
    }

    .day {
        color: var(--dark);
        font-weight: 500;
    }

    .time {
        color: var(--primary);
        font-weight: 600;
    }

    /* Buttons */
    .btn-booking {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border: none;
        padding: 16px;
        border-radius: var(--border-radius);
        font-weight: 600;
        font-size: 1rem;
        width: 100%;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-booking:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2);
    }

    .btn-booking:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .btn-login {
        background: var(--primary);
        color: white;
        border: none;
        padding: 16px;
        border-radius: var(--border-radius);
        font-weight: 600;
        font-size: 1rem;
        width: 100%;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-login:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .court-detail-container {
            padding-top: 16px;
            padding-bottom: 32px;
        }

        .court-title {
            font-size: 1.5rem;
        }

        .court-price {
            font-size: 1.75rem;
        }

        .court-carousel .carousel-item img {
            height: 300px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            opacity: 1;
            background: rgba(255, 255, 255, 0.7);
        }

        .features-list {
            grid-template-columns: 1fr;
        }

        .booking-card {
            position: static;
            margin-top: 24px;
        }
    }

    @media (max-width: 576px) {
        .court-info-header {
            padding: 20px 20px 0;
        }

        .rating-section,
        .description-section,
        .reviews-section {
            padding: 0 20px 20px;
        }

        .booking-form {
            padding: 20px;
        }

        .court-carousel .carousel-item img {
            height: 250px;
        }

        .court-price-section {
            text-align: left;
            margin-top: 16px;
        }
    }
</style>
@endpush

@section('content')
<div class="court-detail-container">
    <!-- Breadcrumb -->
    <div class="container">
        <div class="breadcrumb-section">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/courts">Courts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Court Details</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Image Gallery -->
                <div class="image-gallery-card">
                    <div id="courtImages" class="court-carousel carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://images.unsplash.com/photo-1518609878373-06d740f60d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                                     class="d-block w-100" alt="Court Main View">
                            </div>
                            <div class="carousel-item">
                                <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                                     class="d-block w-100" alt="Court Overview">
                            </div>
                            <div class="carousel-item">
                                <img src="https://images.unsplash.com/photo-1521412644187-c49fa049e84d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                                     class="d-block w-100" alt="Court Facilities">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#courtImages" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#courtImages" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Court Info -->
                <div class="court-info-card">
                    <div class="court-info-header">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="court-title-section">
                                    <h1 class="court-title">Premium Futsal Court {{ $courtId ?? 1 }}</h1>
                                    <div class="court-location">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>Sudirman Street No.123, Central Jakarta</span>
                                    </div>
                                    <div class="court-tags">
                                        <span class="court-tag">Futsal</span>
                                        <span class="court-tag">Indoor</span>
                                        <span class="court-tag">Premium</span>
                                        <span class="court-tag">Air Conditioned</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="court-price-section">
                                    <div class="court-price">Rp 200.000</div>
                                    <div class="price-label">per hour (incl. tax)</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rating -->
                    <div class="rating-section">
                        <div class="rating-container">
                            <div class="rating-stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <span class="rating-value">4.5</span>
                            <span class="rating-count">(128 reviews)</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="description-section">
                        <h3 class="section-title">Description</h3>
                        <p class="court-description">
                            International standard futsal court featuring the latest synthetic turf for safe gameplay. 
                            Equipped with 500 lux LED lighting for comfortable night play. Perfect for tournaments 
                            and casual games.
                        </p>
                        
                        <ul class="features-list">
                            <li class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-rulers"></i>
                                </div>
                                <span>Size: 25m × 15m</span>
                            </li>
                            <li class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-flower1"></i>
                                </div>
                                <span>Grade A Synthetic Turf</span>
                            </li>
                            <li class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-lightbulb"></i>
                                </div>
                                <span>500 Lux LED Lighting</span>
                            </li>
                            <li class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-display"></i>
                                </div>
                                <span>Digital Scoreboard</span>
                            </li>
                            <li class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-droplet"></i>
                                </div>
                                <span>Clean Toilet & Shower</span>
                            </li>
                            <li class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-p-square"></i>
                                </div>
                                <span>Parking (50 cars capacity)</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Reviews -->
                    <div class="reviews-section">
                        <div class="reviews-header">
                            <h3 class="section-title">Reviews</h3>
                            <button class="btn btn-outline-primary btn-sm">Write Review</button>
                        </div>

                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer-info">
                                    <div class="reviewer-avatar">BS</div>
                                    <div>
                                        <div class="reviewer-name">Budi Santoso</div>
                                        <div class="rating-stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-date">2 days ago</div>
                            </div>
                            <p class="review-content">
                                Excellent court with comfortable turf. Service is very friendly and professional. 
                                Will definitely come back!
                            </p>
                        </div>

                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer-info">
                                    <div class="reviewer-avatar">AW</div>
                                    <div>
                                        <div class="reviewer-name">Andi Wijaya</div>
                                        <div class="rating-stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-date">1 week ago</div>
                            </div>
                            <p class="review-content">
                                Complete facilities, clean toilets, and spacious parking. Highly recommended for 
                                serious players and tournaments!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Sidebar -->
            <div class="col-lg-4">
                <!-- Booking Card -->
                <div class="booking-card">
                    <div class="booking-header">
                        <h3 class="booking-title">Book This Court</h3>
                    </div>

                    <form id="bookingForm" class="booking-form">
                        <!-- Date Picker -->
                        <div class="mb-4">
                            <label class="form-label">Select Date</label>
                            <input type="date" class="form-control-custom" id="bookingDate" required>
                        </div>

                        <!-- Time Slots -->
                        <div class="mb-4">
                            <label class="form-label">Choose Time Slot</label>
                            <div class="time-slots-container">
                                @php
                                    $timeSlots = [
                                        ['time' => '08:00 - 10:00', 'status' => 'available'],
                                        ['time' => '10:00 - 12:00', 'status' => 'booked'],
                                        ['time' => '12:00 - 14:00', 'status' => 'available'],
                                        ['time' => '14:00 - 16:00', 'status' => 'available'],
                                        ['time' => '16:00 - 18:00', 'status' => 'available'],
                                        ['time' => '18:00 - 20:00', 'status' => 'available'],
                                        ['time' => '20:00 - 22:00', 'status' => 'available']
                                    ];
                                @endphp
                                
                                @foreach($timeSlots as $index => $slot)
                                <div class="time-slot {{ $slot['status'] === 'booked' ? 'booked' : '' }}" 
                                     data-slot="{{ $index }}"
                                     onclick="{{ $slot['status'] !== 'booked' ? "selectTimeSlot(this, {$index})" : '' }}">
                                    <span class="time-range">{{ $slot['time'] }}</span>
                                    <span class="slot-status {{ $slot['status'] }}">
                                        {{ $slot['status'] === 'available' ? 'Available' : 'Booked' }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Duration -->
                        <div class="mb-4">
                            <label class="form-label">Duration</label>
                            <select class="form-control-custom" id="duration">
                                <option value="1">1 hour</option>
                                <option value="2" selected>2 hours</option>
                                <option value="3">3 hours</option>
                                <option value="4">4 hours</option>
                            </select>
                        </div>

                        <!-- Summary -->
                        <div class="booking-summary">
                            <div class="summary-title">Booking Summary</div>
                            <div class="summary-row">
                                <span>Price per hour</span>
                                <span>Rp 200.000</span>
                            </div>
                            <div class="summary-row">
                                <span>Duration</span>
                                <span>2 hours</span>
                            </div>
                            <div class="summary-row">
                                <span>Tax (10%)</span>
                                <span>Rp 40.000</span>
                            </div>
                            <div class="summary-row">
                                <span>Total</span>
                                <span>Rp 440.000</span>
                            </div>
                        </div>

                        <!-- Action Button -->
                        @auth
                            <button type="submit" class="btn-booking">
                                <i class="bi bi-calendar-check"></i>
                                Book Now
                            </button>
                        @else
                            <a href="/login" class="btn-login">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Login to Book
                            </a>
                        @endauth

                        <!-- Info Text -->
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i> Free cancellation 24 hours before booking
                            </small>
                        </div>
                    </form>
                </div>

                <!-- Operating Hours -->
                <div class="hours-card">
                    <div class="hours-body">
                        <h6 class="hours-title">Operating Hours</h6>
                        <ul class="hours-list">
                            <li class="hours-item">
                                <span class="day">Monday - Friday</span>
                                <span class="time">08:00 - 22:00</span>
                            </li>
                            <li class="hours-item">
                                <span class="day">Saturday</span>
                                <span class="time">07:00 - 23:00</span>
                            </li>
                            <li class="hours-item">
                                <span class="day">Sunday</span>
                                <span class="time">07:00 - 22:00</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('bookingDate').min = today;
    document.getElementById('bookingDate').value = today;

    // Time slot selection
    let selectedSlot = null;
    
    function selectTimeSlot(element, slotIndex) {
        // Remove previous selection
        if (selectedSlot !== null) {
            document.querySelector(`.time-slot[data-slot="${selectedSlot}"]`).classList.remove('selected');
        }
        
        // Add new selection
        element.classList.add('selected');
        selectedSlot = slotIndex;
        
        // Enable booking button
        document.querySelector('.btn-booking').disabled = false;
    }

    // Update booking summary when duration changes
    document.getElementById('duration').addEventListener('change', function() {
        updateBookingSummary();
    });

    function updateBookingSummary() {
        const pricePerHour = 200000;
        const duration = parseInt(document.getElementById('duration').value);
        const taxRate = 0.1;
        
        const subtotal = pricePerHour * duration;
        const tax = subtotal * taxRate;
        const total = subtotal + tax;

        const summaryElement = document.querySelector('.booking-summary');
        summaryElement.innerHTML = `
            <div class="summary-title">Booking Summary</div>
            <div class="summary-row">
                <span>Price per hour</span>
                <span>Rp ${pricePerHour.toLocaleString('id-ID')}</span>
            </div>
            <div class="summary-row">
                <span>Duration</span>
                <span>${duration} hour${duration > 1 ? 's' : ''}</span>
            </div>
            <div class="summary-row">
                <span>Tax (10%)</span>
                <span>Rp ${Math.round(tax).toLocaleString('id-ID')}</span>
            </div>
            <div class="summary-row">
                <span>Total</span>
                <span>Rp ${Math.round(total).toLocaleString('id-ID')}</span>
            </div>
        `;
    }

    // Initialize booking summary
    updateBookingSummary();

    // Form submission
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const date = document.getElementById('bookingDate').value;
        const duration = document.getElementById('duration').value;
        
        if (!selectedSlot) {
            alert('Please select a time slot');
            return;
        }
        
        // Simulate booking process
        const bookingData = {
            courtId: {{ $courtId ?? 1 }},
            date: date,
            timeSlot: selectedSlot,
            duration: duration
        };
        
        // Show loading state
        const btn = document.querySelector('.btn-booking');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing...';
        btn.disabled = true;
        
        // Simulate API call
        setTimeout(() => {
            // In real app, redirect to booking confirmation page
            window.location.href = `/booking/confirm?court=1&date=${date}&duration=${duration}`;
        }, 1000);
    });

    // Carousel auto-play
    const courtCarousel = document.getElementById('courtImages');
    if (courtCarousel) {
        new bootstrap.Carousel(courtCarousel, {
            interval: 4000,
            wrap: true
        });
    }
</script>
@endpush
@endsection