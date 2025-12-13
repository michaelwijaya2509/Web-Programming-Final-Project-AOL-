@extends('layouts.app')

@section('title', 'Booking Cart')

@push('styles')
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
        --border-radius: 12px;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
        --shadow-md: 0 4px 12px rgba(0,0,0,0.05);
        --shadow-lg: 0 10px 40px rgba(0,0,0,0.08);
        --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        background-color: var(--light);
    }

    .cart-container {
        padding: 40px 0;
        min-height: calc(100vh - 300px);
    }

    .cart-header {
        margin-bottom: 32px;
    }

    .cart-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 8px;
    }

    .cart-subtitle {
        color: var(--secondary);
        font-size: 1rem;
    }

    .cart-items-wrapper {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 24px;
        align-items: start;
    }

    @media (max-width: 992px) {
        .cart-items-wrapper {
            grid-template-columns: 1fr;
        }
    }

    /* Cart Items */
    .cart-items {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .cart-item {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        padding: 24px;
        border: 1px solid transparent;
        transition: var(--transition);
    }

    .cart-item:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-lg);
    }

    .item-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--gray-200);
    }

    .item-info {
        flex: 1;
    }

    .venue-name {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 4px;
    }

    .item-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        background: rgba(37, 99, 235, 0.1);
        color: var(--primary);
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-top: 4px;
    }

    .remove-btn {
        background: transparent;
        border: 1px solid var(--gray-300);
        color: var(--danger);
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 0.875rem;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .remove-btn:hover {
        background: rgba(239, 68, 68, 0.1);
        border-color: var(--danger);
    }

    .item-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 16px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .detail-icon {
        width: 36px;
        height: 36px;
        background: var(--gray-50);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1rem;
    }

    .detail-text {
        flex: 1;
    }

    .detail-label {
        font-size: 0.75rem;
        color: var(--secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .detail-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--dark);
    }

    .item-pricing {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 16px;
        border-top: 1px solid var(--gray-200);
    }

    .pricing-breakdown {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .price-row {
        display: flex;
        gap: 8px;
        font-size: 0.875rem;
    }

    .price-label {
        color: var(--secondary);
    }

    .price-value {
        font-weight: 500;
        color: var(--dark);
    }

    .item-total {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
    }

    /* Summary Card */
    .summary-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-lg);
        padding: 24px;
        position: sticky;
        top: 120px;
    }

    .summary-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--gray-200);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        font-size: 0.95rem;
    }

    .summary-row:not(:last-child) {
        border-bottom: 1px solid var(--gray-100);
    }

    .summary-label {
        color: var(--secondary);
    }

    .summary-value {
        font-weight: 600;
        color: var(--dark);
    }

    .summary-total {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 2px solid var(--gray-200);
    }

    .summary-total .summary-label {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
    }

    .summary-total .summary-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary);
    }

    .confirm-btn {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border: none;
        border-radius: var(--border-radius);
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        margin-top: 20px;
        box-shadow: 0 4px 12px rgba(255, 103, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .confirm-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 103, 0, 0.4);
    }

    .continue-shopping {
        width: 100%;
        padding: 12px;
        background: transparent;
        color: var(--primary);
        border: 1px solid var(--primary);
        border-radius: var(--border-radius);
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        margin-top: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .continue-shopping:hover {
        background: rgba(255, 103, 0, 0.05);
    }

    /* Empty State */
    .empty-cart {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
    }

    .empty-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 24px;
        background: var(--gray-50);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: var(--gray-300);
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 8px;
    }

    .empty-subtitle {
        color: var(--secondary);
        margin-bottom: 24px;
    }

    .browse-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 32px;
        background: var(--primary);
        color: white;
        text-decoration: none;
        border-radius: var(--border-radius);
        font-weight: 600;
        transition: var(--transition);
    }

    .browse-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    /* Info Box */
    .info-box {
        background: rgba(37, 99, 235, 0.05);
        border-left: 4px solid var(--primary);
        padding: 16px;
        border-radius: 8px;
        margin-top: 20px;
        display: flex;
        gap: 12px;
    }

    .info-icon {
        color: var(--primary);
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .info-text {
        font-size: 0.875rem;
        color: var(--dark);
        line-height: 1.5;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .cart-title {
            font-size: 1.5rem;
        }

        .cart-item {
            padding: 16px;
        }

        .item-details {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .item-pricing {
            flex-direction: column;
            gap: 12px;
            align-items: flex-start;
        }

        .summary-card {
            position: static;
        }
    }
</style>
@endpush

@section('content')
<div class="cart-container">
    <div class="container">
        <div class="cart-header">
            <h1 class="cart-title">
                <i class="bi bi-cart3"></i> Your Booking Cart
            </h1>
            <p class="cart-subtitle">Review your selected bookings before confirmation</p>
        </div>

        @if(empty($cart))
            <!-- Empty State -->
            <div class="empty-cart">
                <div class="empty-icon">
                    <i class="bi bi-cart-x"></i>
                </div>
                <h2 class="empty-title">Your cart is empty</h2>
                <p class="empty-subtitle">Start exploring venues and add bookings to your cart</p>
                <a href="{{ route('venues.index') }}" class="browse-btn">
                    <i class="bi bi-search"></i>
                    Browse Venues
                </a>
            </div>
        @else
            <!-- Cart Items & Summary -->
            <div class="cart-items-wrapper">
                <!-- Cart Items -->
                <div class="cart-items">
                    @foreach($cart as $index => $item)
                    <div class="cart-item">
                        <div class="item-header">
                            <div class="item-info">
                                <h3 class="venue-name">{{ $item['venue_name'] }}</h3>
                                <span class="item-badge">
                                    <i class="bi bi-basket"></i> Booking #{{ $index + 1 }}
                                </span>
                            </div>
                            <form action="{{ route('booking.removeFromCart', $index) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-btn" onclick="return confirm('Remove this item from cart?')">
                                    <i class="bi bi-trash"></i>
                                    Remove
                                </button>
                            </form>
                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="bi bi-calendar-event"></i>
                                </div>
                                <div class="detail-text">
                                    <div class="detail-label">Date</div>
                                    <div class="detail-value">{{ \Carbon\Carbon::parse($item['date'])->format('D, M d, Y') }}</div>
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div class="detail-text">
                                    <div class="detail-label">Time Slot</div>
                                    <div class="detail-value">{{ $item['start_time'] }} - {{ $item['end_time'] }}</div>
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="bi bi-hourglass-split"></i>
                                </div>
                                <div class="detail-text">
                                    <div class="detail-label">Duration</div>
                                    <div class="detail-value">{{ $item['duration'] }} hour{{ $item['duration'] > 1 ? 's' : '' }}</div>
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="bi bi-tag"></i>
                                </div>
                                <div class="detail-text">
                                    <div class="detail-label">Price/Hour</div>
                                    <div class="detail-value">Rp {{ number_format($item['price_per_hour'], 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="item-pricing">
                            <div class="pricing-breakdown">
                                <div class="price-row">
                                    <span class="price-label">Subtotal:</span>
                                    <span class="price-value">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span class="price-label">Tax (10%):</span>
                                    <span class="price-value">Rp {{ number_format($item['tax'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="item-total">
                                Rp {{ number_format($item['total'], 0, ',', '.') }}
                            </div>
                        </div>

                        <!-- Pay Now Button per Item -->
                        <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid var(--gray-200);">
                            <form action="{{ route('booking.createSingle', $index) }}" method="POST" style="display: block;">
                                @csrf
                                <button type="submit" class="confirm-btn" style="margin-top: 0;">
                                    <i class="fas fa-credit-card"></i>
                                    <span>Pay This Booking Now</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Summary Card -->
                <div class="summary-card">
                    <h3 class="summary-title">Order Summary</h3>
                    
                    <div class="summary-row">
                        <span class="summary-label">Total Items</span>
                        <span class="summary-value">{{ count($cart) }} booking{{ count($cart) > 1 ? 's' : '' }}</span>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">Subtotal</span>
                        <span class="summary-value">Rp {{ number_format(array_sum(array_column($cart, 'subtotal')), 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">Tax (10%)</span>
                        <span class="summary-value">Rp {{ number_format(array_sum(array_column($cart, 'tax')), 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row summary-total">
                        <span class="summary-label">Grand Total</span>
                        <span class="summary-value">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('venues.index') }}" class="continue-shopping" style="margin-top: 20px;">
                        <i class="bi bi-arrow-left"></i>
                        Continue Shopping
                    </a>

                    <div class="info-box">
                        <i class="bi bi-info-circle info-icon"></i>
                        <div class="info-text">
                            <strong>Note:</strong> Klik tombol "Pay This Booking Now" pada setiap booking untuk melakukan pembayaran satu per satu. Court akan otomatis di-assign berdasarkan ketersediaan.
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
