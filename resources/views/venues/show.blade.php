@extends('layouts.app')

@section('title', 'Court Details - Sports Arena')

@push('styles')
<style>
    :root {
        --primary: #FF6700;
        --primary-dark: #E65C00;
        --primary-light: #FF9F66;
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
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Image Gallery -->
                <div class="image-gallery-card">
                    @if($venue->venue_image)
                        <img src="{{ $venue->venue_image }}"
                                 alt="{{ $venue->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <img src="https://images.unsplash.com/photo-1518609878373-06d740f60d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                             class="d-block w-100" 
                             alt="Default Court Image"
                             style="height: 400px; object-fit: cover; border-radius: 12px;">
                    @endif
                </div>

                <!-- Court Info -->
                <div class="court-info-card">
                    <div class="court-info-header">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="court-title-section">
                                    <h1 class="court-title">{{ $venue->name }}</h1>
                                    <div class="court-location">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>{{ $venue->location }}</span>
                                    </div>
                                    <div class="court-tags">
                                        <span class="court-tag">{{ $venue->type }}</span>
                                        <span class="court-tag">{{ $venue->space }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="court-price-section">
                                    <div class="court-price">Rp {{ number_format($venue->price_per_hour, 0, ',', '.') }}</div>
                                    <div class="price-label">per hour (incl. tax)</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rating -->
                    <div class="rating-section">
                        <div class="rating-container">
                            <div class="rating-stars">
                                @php
                                    $avgRating = $venue->averageRating() ?? 0;
                                    $fullStars = floor($avgRating);
                                    $hasHalfStar = ($avgRating - $fullStars) >= 0.5;
                                @endphp
                                
                                @for($i = 0; $i < $fullStars; $i++)
                                    <i class="bi bi-star-fill"></i>
                                @endfor
                                
                                @if($hasHalfStar)
                                    <i class="bi bi-star-half"></i>
                                @endif
                                
                                @for($i = 0; $i < (5 - $fullStars - ($hasHalfStar ? 1 : 0)); $i++)
                                    <i class="bi bi-star"></i>
                                @endfor
                            </div>
                            <span class="rating-value">{{ number_format($avgRating, 1) }}</span>
                            <span class="rating-count">({{ $venue->ratings()->count() }} reviews)</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="description-section">
                        <h3 class="section-title">Description</h3>
                        <p class="court-description">
                           {{ $venue->description ?? 'No description available for this venue.' }}
                        </p>
                        </p>
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
                        @if(session('booking_cart'))
                            <span class="badge bg-primary">{{ count(session('booking_cart')) }} in cart</span>
                        @endif
                    </div>

                    <form action="{{ route('booking.addToCart') }}" method="POST" id="bookingForm" class="booking-form">
                        @csrf
                        <input type="hidden" name="venue_id" value="{{ $venue->id }}">
                        <input type="hidden" name="start_time" id="selectedStartTime">
                        <input type="hidden" name="end_time" id="selectedEndTime">

                        <!-- Date Picker -->
                        <div class="mb-4">
                            <label class="form-label">Select Date</label>
                            <input type="date" 
                                   class="form-control-custom" 
                                   name="date"
                                   id="bookingDate" 
                                   value="{{ $date }}"
                                   min="{{ now()->toDateString() }}"
                                   required
                                   onchange="this.form.action='{{ route('venues.show', $venue->id) }}'; this.form.method='GET'; this.form.submit();">
                        </div>

                        <!-- Time Slots -->
                        <div class="mb-4">
                            <label class="form-label">Choose Time Slot</label>
                            <div class="time-slots-container" id="timeSlotsContainer">
                                @foreach($availableSlots as $index => $slot)
                                <div class="time-slot {{ !$slot['is_available'] ? 'booked' : '' }}" 
                                     data-slot="{{ $index }}"
                                     data-start="{{ $slot['start'] }}"
                                     data-end="{{ $slot['end'] }}"
                                     onclick="{{ $slot['is_available'] ? "selectTimeSlot(this, '$slot[start]', '$slot[end]')" : '' }}">
                                    <span class="time-range">{{ $slot['display'] }}</span>
                                    <span class="slot-status {{ $slot['is_available'] ? 'available' : 'booked' }}">
                                        {{ $slot['is_available'] ? $slot['available_courts'] . ' Available' : 'Full' }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Duration -->
                        <div class="mb-4">
                            <label class="form-label">Duration</label>
                            <select class="form-control-custom" id="duration" onchange="updateEndTime()">
                                <option value="1">1 hour</option>
                                <option value="2" selected>2 hours</option>
                                <option value="3">3 hours</option>
                                <option value="4">4 hours</option>
                            </select>
                        </div>

                        <!-- Summary -->
                        <div class="booking-summary" id="bookingSummary">
                            <div class="summary-title">Booking Summary</div>
                            <div class="summary-row">
                                <span>Price per hour</span>
                                <span>Rp {{ number_format($venue->price_per_hour, 0, ',', '.') }}</span>
                            </div>
                            <div class="summary-row">
                                <span>Duration</span>
                                <span id="durationText">2 hours</span>
                            </div>
                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span id="subtotalText">Rp {{ number_format($venue->price_per_hour * 2, 0, ',', '.') }}</span>
                            </div>
                            <div class="summary-row">
                                <span>Tax (10%)</span>
                                <span id="taxText">Rp {{ number_format($venue->price_per_hour * 2 * 0.1, 0, ',', '.') }}</span>
                            </div>
                            <div class="summary-row">
                                <span>Total</span>
                                <span id="totalText">Rp {{ number_format($venue->price_per_hour * 2 * 1.1, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        @auth
                            <button type="submit" class="btn-booking" id="addToCartBtn" disabled>
                                <i class="bi bi-cart-plus"></i>
                                Add to Cart
                            </button>
                            
                            @if(session('booking_cart'))
                                <a href="{{ route('booking.cart') }}" class="btn btn-outline-primary w-100 mt-2">
                                    <i class="bi bi-cart3"></i>
                                    View Cart ({{ count(session('booking_cart')) }})
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn-login">
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
                                <span class="time">08:00 - 21:00</span>
                            </li>
                            <li class="hours-item">
                                <span class="day">Saturday - Sunday</span>
                                <span class="time">08:00 - 21:00</span>
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
    const pricePerHour = {{ $venue->price_per_hour }};
    let selectedStartTime = null;
    let selectedEndTime = null;
    
    function selectTimeSlot(element, startTime, endTime) {
        // Remove previous selection
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.classList.remove('selected');
        });
        
        // Add new selection
        element.classList.add('selected');
        selectedStartTime = startTime;
        
        // Update hidden inputs
        document.getElementById('selectedStartTime').value = startTime;
        
        // Update end time based on duration
        updateEndTime();
        
        // Enable button
        document.getElementById('addToCartBtn').disabled = false;
    }

    function updateEndTime() {
        if (!selectedStartTime) return;
        
        const duration = parseInt(document.getElementById('duration').value);
        const [hours, minutes] = selectedStartTime.split(':');
        const startHour = parseInt(hours);
        const endHour = startHour + duration;
        
        // Check if end time exceeds operating hours
        if (endHour > 21) {
            alert('Duration exceeds operating hours. Please select earlier time slot or shorter duration.');
            return;
        }
        
        selectedEndTime = `${String(endHour).padStart(2, '0')}:00`;
        document.getElementById('selectedEndTime').value = selectedEndTime;
        
        updateBookingSummary();
    }

    function updateBookingSummary() {
        const duration = parseInt(document.getElementById('duration').value);
        const subtotal = pricePerHour * duration;
        const tax = subtotal * 0.1;
        const total = subtotal + tax;

        document.getElementById('durationText').textContent = `${duration} hour${duration > 1 ? 's' : ''}`;
        document.getElementById('subtotalText').textContent = `Rp ${Math.round(subtotal).toLocaleString('id-ID')}`;
        document.getElementById('taxText').textContent = `Rp ${Math.round(tax).toLocaleString('id-ID')}`;
        document.getElementById('totalText').textContent = `Rp ${Math.round(total).toLocaleString('id-ID')}`;
    }

    // Initialize
    updateBookingSummary();
</script>
@endpush
@endsection