<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cart Popup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #FF6700;
            --primary-dark: #E65C00;
            --primary-light: #FF9F66;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-700: #374151;
            --border-radius: 12px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 40px rgba(0,0,0,0.15);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Floating Cart Button */
        .cart-floating-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            transition: var(--transition);
        }

        .cart-btn-main {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(255, 103, 0, 0.4);
            border: 3px solid white;
            position: relative;
            transition: var(--transition);
        }

        .cart-btn-main:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 30px rgba(255, 103, 0, 0.6);
        }

        .cart-icon {
            color: white;
            font-size: 1.5rem;
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            font-size: 0.75rem;
            font-weight: bold;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Cart Popup Container */
        .cart-popup-container {
            position: fixed;
            bottom: 100px;
            right: 30px;
            width: 380px;
            max-height: 600px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px) scale(0.95);
            transition: var(--transition);
            overflow: hidden;
            border: 1px solid var(--gray-200);
        }

        .cart-popup-container.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        /* Cart Header */
        .cart-popup-header {
            padding: 20px;
            background: linear-gradient(135deg, var(--dark), #1e293b);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-popup-title {
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cart-popup-close {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .cart-popup-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Cart Content */
        .cart-popup-content {
            max-height: 400px;
            overflow-y: auto;
            padding: 0;
        }

        /* Empty State */
        .cart-empty {
            padding: 40px 20px;
            text-align: center;
        }

        .cart-empty-icon {
            font-size: 3rem;
            color: var(--gray-300);
            margin-bottom: 15px;
        }

        .cart-empty-text {
            color: var(--gray-700);
            font-size: 0.95rem;
        }

        /* Cart Items */
        .cart-popup-item {
            padding: 16px;
            border-bottom: 1px solid var(--gray-200);
            transition: var(--transition);
            cursor: pointer;
        }

        .cart-popup-item:hover {
            background: var(--gray-100);
            transform: translateX(4px);
        }

        .cart-item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .cart-item-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark);
            margin: 0;
            line-height: 1.3;
        }

        .cart-item-remove {
            background: none;
            border: none;
            color: #ef4444;
            font-size: 0.875rem;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 4px;
            transition: var(--transition);
        }

        .cart-item-remove:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        .cart-item-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 10px;
        }

        .cart-item-detail {
            font-size: 0.8rem;
            color: var(--gray-700);
        }

        .cart-item-detail strong {
            color: var(--dark);
            font-weight: 500;
        }

        .cart-item-price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
        }

        .cart-item-total {
            font-weight: 600;
            color: var(--primary);
        }

        /* Cart Footer */
        .cart-popup-footer {
            padding: 20px;
            background: var(--gray-100);
            border-top: 1px solid var(--gray-200);
        }

        .cart-summary {
            margin-bottom: 15px;
        }

        .cart-summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            font-size: 0.9rem;
        }

        .cart-summary-label {
            color: var(--gray-700);
        }

        .cart-summary-value {
            font-weight: 500;
            color: var(--dark);
        }

        .cart-grand-total {
            padding-top: 10px;
            border-top: 2px solid var(--gray-300);
            font-weight: 600;
            color: var(--dark);
        }

        .cart-grand-total .cart-summary-value {
            font-size: 1.1rem;
            color: var(--primary);
        }

        .cart-actions {
            display: flex;
            gap: 10px;
        }

        .cart-btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .cart-btn-view {
            background: white;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .cart-btn-view:hover {
            background: rgba(255, 103, 0, 0.05);
        }

        .cart-btn-checkout {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 2px 10px rgba(255, 103, 0, 0.3);
        }

        .cart-btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 103, 0, 0.4);
        }

        /* Backdrop */
        .cart-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .cart-backdrop.show {
            opacity: 1;
            visibility: visible;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .cart-floating-btn {
                bottom: 20px;
                right: 20px;
            }

            .cart-popup-container {
                width: calc(100vw - 40px);
                right: 20px;
                left: 20px;
                bottom: 80px;
            }

            .cart-btn-main {
                width: 50px;
                height: 50px;
            }

            .cart-icon {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .cart-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Cart Button -->
    <div class="cart-floating-btn">
        <div class="cart-btn-main" id="cartToggle">
            <i class="fas fa-shopping-cart cart-icon"></i>
            @if(!empty($cart))
                <span class="cart-count" id="cartCount">{{ count($cart) }}</span>
            @endif
        </div>
    </div>

    <!-- Cart Backdrop -->
    <div class="cart-backdrop" id="cartBackdrop"></div>

    <!-- Cart Popup -->
    <div class="cart-popup-container" id="cartPopup">
        <div class="cart-popup-header">
            <h3 class="cart-popup-title">
                <i class="fas fa-shopping-cart"></i>
                Booking Cart
            </h3>
            <button class="cart-popup-close" id="cartClose">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="cart-popup-content" id="cartContent">
            @if(empty($cart))
                <div class="cart-empty">
                    <div class="cart-empty-icon">
                        <i class="fas fa-cart-shopping"></i>
                    </div>
                    <p class="cart-empty-text">Your cart is empty</p>
                </div>
            @else
                @php
                    $grandTotal = 0;
                @endphp
                
                @foreach($cart as $index => $item)
                    @php
                        $grandTotal += $item['total'] ?? 0;
                    @endphp
                    <div class="cart-popup-item">
                        <div class="cart-item-header">
                            <h4 class="cart-item-title">{{ $item['venue_name'] ?? 'Venue Name' }}</h4>
                            <form action="{{ route('booking.removeFromCart', $index) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cart-item-remove" onclick="return confirm('Remove this item?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        
                        <div class="cart-item-details">
                            <div class="cart-item-detail">
                                <strong>Date:</strong> {{ isset($item['date']) ? \Carbon\Carbon::parse($item['date'])->format('M d') : 'N/A' }}
                            </div>
                            <div class="cart-item-detail">
                                <strong>Time:</strong> {{ $item['start_time'] ?? '' }} - {{ $item['end_time'] ?? '' }}
                            </div>
                            <div class="cart-item-detail">
                                <strong>Duration:</strong> {{ $item['duration'] ?? 1 }}h
                            </div>
                            <div class="cart-item-detail">
                                <strong>Price:</strong> Rp {{ number_format($item['price_per_hour'] ?? 0, 0, ',', '.') }}/h
                            </div>
                        </div>
                        
                        <div class="cart-item-price">
                            <span>Item Total:</span>
                            <span class="cart-item-total">Rp {{ number_format($item['total'] ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        @if(!empty($cart))
            <div class="cart-popup-footer">
                <div class="cart-summary">
                    <div class="cart-summary-row">
                        <span class="cart-summary-label">Subtotal:</span>
                        <span class="cart-summary-value">Rp {{ number_format(array_sum(array_column($cart, 'subtotal')), 0, ',', '.') }}</span>
                    </div>
                    <div class="cart-summary-row">
                        <span class="cart-summary-label">Tax (10%):</span>
                        <span class="cart-summary-value">Rp {{ number_format(array_sum(array_column($cart, 'tax')), 0, ',', '.') }}</span>
                    </div>
                    <div class="cart-summary-row cart-grand-total">
                        <span class="cart-summary-label">Grand Total:</span>
                        <span class="cart-summary-value">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <div class="cart-actions">
                    <a href="{{ route('booking.cart') }}" class="cart-btn cart-btn-view">
                        <i class="fas fa-eye"></i>
                        View Full Cart
                    </a>
                    <form action="{{ route('booking.confirm') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="cart-btn cart-btn-checkout">
                            <i class="fas fa-credit-card"></i>
                            Checkout
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <script>
        // Function to navigate to cart page
        function navigateToCart(event) {
            // Don't navigate if clicking on remove button
            if (event.target.closest('.cart-item-remove')) {
                return;
            }
            
            // Navigate to cart page
            window.location.href = '/booking/cart';
        }

        // Function to refresh cart data from server
        async function refreshCartData() {
            try {
                const response = await fetch('/api/cart/data', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                if (response.ok) {
                    const data = await response.json();
                    if (data.success) {
                        updateCartUI(data.cart);
                    }
                }
            } catch (error) {
                console.error('Error refreshing cart:', error);
            }
        }

        // Function to update cart UI
        function updateCartUI(cart) {
            const cartContent = document.getElementById('cartContent');
            const cartCount = document.getElementById('cartCount');
            const cartFooter = document.querySelector('.cart-popup-footer');
            
            // Update count badge
            if (cartCount) {
                if (cart.length > 0) {
                    cartCount.textContent = cart.length;
                    cartCount.style.display = 'flex';
                } else {
                    cartCount.style.display = 'none';
                }
            }
            
            // Update content
            if (cart.length === 0) {
                cartContent.innerHTML = `
                    <div class="cart-empty">
                        <div class="cart-empty-icon">
                            <i class="fas fa-cart-shopping"></i>
                        </div>
                        <p class="cart-empty-text">Your cart is empty</p>
                    </div>
                `;
                if (cartFooter) {
                    cartFooter.style.display = 'none';
                }
            } else {
                let cartHTML = '';
                let grandTotal = 0;
                
                cart.forEach((item, index) => {
                    const itemTotal = item.total || 0;
                    grandTotal += itemTotal;
                    
                    const formattedDate = new Date(item.date).toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric'
                    });
                    
                    cartHTML += `
                        <div class="cart-popup-item" onclick="navigateToCart(event)">
                            <div class="cart-item-header">
                                <h4 class="cart-item-title">${item.venue_name || 'Venue Name'}</h4>
                                <button type="button" class="cart-item-remove" data-index="${index}" onclick="removeCartItem(event, ${index})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            
                            <div class="cart-item-details">
                                <div class="cart-item-detail">
                                    <strong>Date:</strong> ${formattedDate}
                                </div>
                                <div class="cart-item-detail">
                                    <strong>Time:</strong> ${item.start_time} - ${item.end_time}
                                </div>
                                <div class="cart-item-detail">
                                    <strong>Duration:</strong> ${item.duration}h
                                </div>
                                <div class="cart-item-detail">
                                    <strong>Price:</strong> Rp ${Number(item.price_per_hour).toLocaleString('id-ID')}
                                </div>
                            </div>
                            
                            <div class="cart-item-price">
                                <span>Item Total:</span>
                                <span class="cart-item-total">Rp ${Number(itemTotal).toLocaleString('id-ID')}</span>
                            </div>
                        </div>
                    `;
                });
                
                cartContent.innerHTML = cartHTML;
                
                // Update footer
                if (cartFooter) {
                    const subtotal = cart.reduce((sum, item) => sum + (item.subtotal || 0), 0);
                    const tax = cart.reduce((sum, item) => sum + (item.tax || 0), 0);
                    
                    cartFooter.innerHTML = `
                        <div class="cart-summary">
                            <div class="cart-summary-row">
                                <span class="cart-summary-label">Subtotal:</span>
                                <span class="cart-summary-value">Rp ${subtotal.toLocaleString('id-ID')}</span>
                            </div>
                            <div class="cart-summary-row">
                                <span class="cart-summary-label">Tax (10%):</span>
                                <span class="cart-summary-value">Rp ${tax.toLocaleString('id-ID')}</span>
                            </div>
                            <div class="cart-summary-row cart-grand-total">
                                <span class="cart-summary-label">Grand Total:</span>
                                <span class="cart-summary-value">Rp ${grandTotal.toLocaleString('id-ID')}</span>
                            </div>
                        </div>
                        
                        <div class="cart-actions">
                            <a href="/booking/cart" class="cart-btn cart-btn-view">
                                <i class="fas fa-eye"></i>
                                View Full Cart
                            </a>
                            <form action="/booking/confirm" method="POST" class="d-inline">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                                <button type="submit" class="cart-btn cart-btn-checkout">
                                    <i class="fas fa-credit-card"></i>
                                    Checkout
                                </button>
                            </form>
                        </div>
                    `;
                    cartFooter.style.display = 'block';
                }
            }
            
            // Re-attach remove button listeners
            attachRemoveListeners();
        }

        // Function to remove item from cart
        async function removeCartItem(event, index) {
            event.preventDefault();
            
            if (!confirm('Remove this item from cart?')) {
                return;
            }
            
            try {
                const response = await fetch(`/booking/cart/${index}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                if (response.ok) {
                    const data = await response.json();
                    if (data.success) {
                        await refreshCartData();
                    }
                }
            } catch (error) {
                console.error('Error removing item:', error);
                alert('Failed to remove item');
            }
        }

        // Function to attach remove button listeners
        function attachRemoveListeners() {
            document.querySelectorAll('.cart-item-remove').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const index = this.getAttribute('data-index');
                    removeCartItem(e, index);
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const cartToggle = document.getElementById('cartToggle');
            const cartPopup = document.getElementById('cartPopup');
            const cartBackdrop = document.getElementById('cartBackdrop');
            const cartClose = document.getElementById('cartClose');
            
            // Toggle cart popup
            function toggleCart() {
                cartPopup.classList.toggle('show');
                cartBackdrop.classList.toggle('show');
                document.body.style.overflow = cartPopup.classList.contains('show') ? 'hidden' : '';
            }
            
            // Event listeners
            cartToggle.addEventListener('click', toggleCart);
            cartClose.addEventListener('click', toggleCart);
            cartBackdrop.addEventListener('click', toggleCart);
            
            // Close cart with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && cartPopup.classList.contains('show')) {
                    toggleCart();
                }
            });
            
            // Prevent closing when clicking inside cart
            cartPopup.addEventListener('click', function(e) {
                e.stopPropagation();
            });
            
            // Refresh cart data on page load
            refreshCartData();
            
            // Auto-refresh cart every 2 seconds (untuk sync across tabs/pages)
            setInterval(refreshCartData, 2000);
        });
    </script>
</body>
</html>