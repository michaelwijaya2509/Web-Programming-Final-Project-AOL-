@extends('layouts.app')

@section('title', 'Payment - Meraket')

@section('content')

<!-- Hero Section -->
<div class="relative w-full h-[400px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-tr from-gray-900 via-transparent to-orange-900/40 z-0"></div>
    
    <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?q=80&w=2071&auto=format&fit=crop"
        alt="Payment Background" class="absolute inset-0 w-full h-full object-cover filter brightness-[0.4]">
    
    <div class="relative z-10 container mx-auto px-6 md:px-12 text-center">
        <div class="inline-block mb-6 animate-fade-in-down">
            <span class="py-1 px-3 rounded-full bg-orange-500/20 border border-[#FF6700] text-[#FF6700] text-sm font-bold tracking-widest uppercase backdrop-blur-sm">
                Payment Confirmation
            </span>
        </div>
        
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 tracking-tight leading-tight drop-shadow-2xl">
            Selesaikan Pembayaran, <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF6700] to-yellow-400">Konfirmasi Booking.</span>
        </h1>
        
        <p class="text-lg md:text-2xl text-gray-200 mb-10 max-w-3xl mx-auto font-light leading-relaxed">
            Pilih metode pembayaran yang tersedia untuk menyelesaikan booking lapangan Anda.
        </p>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-30">
    <!-- Main Card -->
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 mb-16">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-8 py-8">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
                <div class="mb-6 md:mb-0">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-3">
                        <i class="fas fa-credit-card mr-3 text-[#FF6700]"></i>Payment Details
                    </h2>
                    <p class="text-gray-300 text-lg">
                        Konfirmasi pembayaran untuk booking Anda
                    </p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-4 border border-white/20">
                    <span class="text-sm text-gray-300 font-medium">Booking ID</span>
                    <div class="text-2xl font-bold text-white text-center">#{{ $booking->id }}</div>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-8 md:p-10">
            <!-- Booking Summary -->
            <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-200 p-8 mb-10 shadow-lg hover:shadow-xl transition-all duration-300">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-100 to-red-100 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-calendar-check text-[#FF6700] text-xl"></i>
                    </div>
                    Booking Summary
                </h3>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Venue Info -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white to-gray-50 border border-gray-200 rounded-xl p-6 hover:border-[#FF6700] hover:shadow-xl transition-all duration-300">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-orange-100 rounded-full -mr-12 -mt-12 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-[#FF6700] to-orange-600 flex items-center justify-center mr-4 shadow-md">
                                    <i class="fas fa-map-marker-alt text-white text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900">Venue Details</h4>
                                    <p class="text-sm text-gray-500">Informasi lapangan</p>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Venue:</span>
                                    <span class="font-semibold text-gray-900">{{ $booking->venue->name ?? 'Venue Name' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Location:</span>
                                    <span class="font-semibold text-gray-900">{{ $booking->venue->location ?? 'Location' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Court Type:</span>
                                    <span class="font-semibold text-gray-900">{{ $booking->venue->type ?? 'Court Type' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Info -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white to-gray-50 border border-gray-200 rounded-xl p-6 hover:border-[#FF6700] hover:shadow-xl transition-all duration-300">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-orange-100 rounded-full -mr-12 -mt-12 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-[#FF6700] to-orange-600 flex items-center justify-center mr-4 shadow-md">
                                    <i class="fas fa-clock text-white text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900">Booking Details</h4>
                                    <p class="text-sm text-gray-500">Detail waktu booking</p>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Date:</span>
                                    <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Time:</span>
                                    <span class="font-semibold text-gray-900">{{ $booking->start_time }} - {{ $booking->end_time }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Duration:</span>
                                    <span class="font-semibold text-gray-900">{{ $booking->duration }} hour(s)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Price Summary -->
                <div class="mt-8 pt-8 border-t border-gray-200 border-dashed">
                    <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-xl p-6">
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Price Summary</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Court Price:</span>
                                <span class="font-semibold text-gray-900">Rp {{ number_format($booking->court_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Tax (10%):</span>
                                <span class="font-semibold text-gray-900">Rp {{ number_format($booking->tax, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Service Fee:</span>
                                <span class="font-semibold text-gray-900">Rp {{ number_format($booking->service_fee, 0, ',', '.') }}</span>
                            </div>
                            <div class="pt-4 border-t border-gray-300">
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold text-gray-900">Total Amount:</span>
                                    <span class="text-2xl font-bold text-[#FF6700]">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Method Selection -->
            <form action="{{ route('payment.pay', $booking->id) }}" method="POST" id="paymentForm">
                @csrf
                
                <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl border border-gray-200 p-8 mb-10 shadow-lg hover:shadow-xl transition-all duration-300">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-orange-100 to-red-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-wallet text-[#FF6700] text-xl"></i>
                        </div>
                        Payment Method
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @php
                            $selectedMethod = old('method', 'qris');
                        @endphp

                        <!-- QRIS -->
                        <div class="group cursor-pointer">
                            <input class="hidden" type="radio" name="method" id="qris" value="qris" required 
                                   {{ $selectedMethod == 'qris' ? 'checked' : '' }}>
                            <label for="qris" 
                                   class="group relative flex flex-col items-center bg-white border-2 border-gray-200 rounded-2xl p-6 hover:border-[#FF6700] hover:shadow-xl transition-all duration-300 group-has-[:checked]:border-[#FF6700] group-has-[:checked]:bg-gradient-to-r group-has-[:checked]:from-orange-50 group-has-[:checked]:to-red-50 overflow-hidden">
                                <div class="absolute top-0 right-0 w-20 h-20 bg-orange-100 rounded-full -mr-10 -mt-10 opacity-0 group-has-[:checked]:opacity-100 transition-opacity duration-500"></div>
                                
                                <div class="relative z-10 mb-4">
                                    <div class="w-16 h-16 rounded-xl bg-gradient-to-r from-[#FF6700] to-orange-600 flex items-center justify-center shadow-lg">
                                        <i class="fas fa-qrcode text-white text-2xl"></i>
                                    </div>
                                </div>
                                <div class="relative z-10 flex-grow text-center">
                                    <h4 class="text-lg font-bold text-gray-900 mb-2">QRIS</h4>
                                    <p class="text-sm text-gray-600 mb-4">Scan QR Code</p>
                                    <div class="flex items-center justify-center text-[#FF6700]">
                                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-orange-100">
                                            <i class="fas fa-bolt mr-1"></i>Instant
                                        </span>
                                    </div>
                                </div>
                                <div class="relative z-10 mt-4">
                                    <div class="w-7 h-7 rounded-full border-2 border-gray-300 group-has-[:checked]:border-[#FF6700] group-has-[:checked]:bg-[#FF6700] flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xs hidden group-has-[:checked]:block"></i>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <!-- Bank Transfer -->
                        <div class="group cursor-pointer">
                            <input class="hidden" type="radio" name="method" id="bank_transfer" value="bank_transfer" required 
                                   {{ $selectedMethod == 'bank_transfer' ? 'checked' : '' }}>
                            <label for="bank_transfer" 
                                   class="group relative flex flex-col items-center bg-white border-2 border-gray-200 rounded-2xl p-6 hover:border-[#FF6700] hover:shadow-xl transition-all duration-300 group-has-[:checked]:border-[#FF6700] group-has-[:checked]:bg-gradient-to-r group-has-[:checked]:from-orange-50 group-has-[:checked]:to-red-50 overflow-hidden">
                                <div class="absolute top-0 right-0 w-20 h-20 bg-orange-100 rounded-full -mr-10 -mt-10 opacity-0 group-has-[:checked]:opacity-100 transition-opacity duration-500"></div>
                                
                                <div class="relative z-10 mb-4">
                                    <div class="w-16 h-16 rounded-xl bg-gradient-to-r from-[#FF6700] to-orange-600 flex items-center justify-center shadow-lg">
                                        <i class="fas fa-university text-white text-2xl"></i>
                                    </div>
                                </div>
                                <div class="relative z-10 flex-grow text-center">
                                    <h4 class="text-lg font-bold text-gray-900 mb-2">Bank Transfer</h4>
                                    <p class="text-sm text-gray-600 mb-4">Manual Transfer</p>
                                    <div class="flex items-center justify-center text-gray-600">
                                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-gray-100">
                                            <i class="fas fa-clock mr-1"></i>1-2 Hours
                                        </span>
                                    </div>
                                </div>
                                <div class="relative z-10 mt-4">
                                    <div class="w-7 h-7 rounded-full border-2 border-gray-300 group-has-[:checked]:border-[#FF6700] group-has-[:checked]:bg-[#FF6700] flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xs hidden group-has-[:checked]:block"></i>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <!-- E-Wallet -->
                        <div class="group cursor-pointer">
                            <input class="hidden" type="radio" name="method" id="e_wallet" value="e_wallet" required 
                                   {{ $selectedMethod == 'e_wallet' ? 'checked' : '' }}>
                            <label for="e_wallet" 
                                   class="group relative flex flex-col items-center bg-white border-2 border-gray-200 rounded-2xl p-6 hover:border-[#FF6700] hover:shadow-xl transition-all duration-300 group-has-[:checked]:border-[#FF6700] group-has-[:checked]:bg-gradient-to-r group-has-[:checked]:from-orange-50 group-has-[:checked]:to-red-50 overflow-hidden">
                                <div class="absolute top-0 right-0 w-20 h-20 bg-orange-100 rounded-full -mr-10 -mt-10 opacity-0 group-has-[:checked]:opacity-100 transition-opacity duration-500"></div>
                                
                                <div class="relative z-10 mb-4">
                                    <div class="w-16 h-16 rounded-xl bg-gradient-to-r from-[#FF6700] to-orange-600 flex items-center justify-center shadow-lg">
                                        <i class="fas fa-mobile-alt text-white text-2xl"></i>
                                    </div>
                                </div>
                                <div class="relative z-10 flex-grow text-center">
                                    <h4 class="text-lg font-bold text-gray-900 mb-2">E-Wallet</h4>
                                    <p class="text-sm text-gray-600 mb-4">Gopay, OVO, DANA</p>
                                    <div class="flex items-center justify-center text-[#FF6700]">
                                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-orange-100">
                                            <i class="fas fa-bolt mr-1"></i>Instant
                                        </span>
                                    </div>
                                </div>
                                <div class="relative z-10 mt-4">
                                    <div class="w-7 h-7 rounded-full border-2 border-gray-300 group-has-[:checked]:border-[#FF6700] group-has-[:checked]:bg-[#FF6700] flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xs hidden group-has-[:checked]:block"></i>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Payment Instructions -->
                    <div class="mt-8 pt-8 border-t border-gray-200 border-dashed">
                        <div id="qris-instructions" class="payment-instructions hidden bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6">
                            <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-qrcode text-[#FF6700] mr-2"></i>
                                QRIS Payment Instructions
                            </h4>
                            <ol class="space-y-3 text-gray-700">
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 text-green-800 flex items-center justify-center mr-3">1</span>
                                    <span>Open your banking or e-wallet app</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 text-green-800 flex items-center justify-center mr-3">2</span>
                                    <span>Select "Scan QR Code" feature</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 text-green-800 flex items-center justify-center mr-3">3</span>
                                    <span>Scan the QR code below</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 text-green-800 flex items-center justify-center mr-3">4</span>
                                    <span>Confirm payment amount: <span class="font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span></span>
                                </li>
                            </ol>
                            <div class="mt-6 flex justify-center">
                                <div class="bg-white p-4 rounded-lg shadow-lg">
                                    <!-- Placeholder for QR Code -->
                                    <div class="w-48 h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-qrcode text-gray-400 text-4xl"></i>
                                    </div>
                                    <p class="text-center text-sm text-gray-500 mt-2">Scan this QR code</p>
                                </div>
                            </div>
                        </div>

                        <div id="bank-instructions" class="payment-instructions hidden bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-6">
                            <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-university text-[#FF6700] mr-2"></i>
                                Bank Transfer Instructions
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h5 class="font-bold text-gray-800 mb-3">Transfer to:</h5>
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Bank:</span>
                                            <span class="font-semibold">BCA</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Account Number:</span>
                                            <span class="font-semibold">1234 5678 9012</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Account Name:</span>
                                            <span class="font-semibold">PT. Meraket Indonesia</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="font-bold text-gray-800 mb-3">Instructions:</h5>
                                    <ol class="space-y-2 text-sm text-gray-700">
                                        <li>1. Transfer exact amount: <span class="font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span></li>
                                        <li>2. Use booking ID as reference: <span class="font-bold">#{{ $booking->id }}</span></li>
                                        <li>3. Payment will be verified within 1-2 hours</li>
                                        <li>4. Booking will be confirmed automatically</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div id="ewallet-instructions" class="payment-instructions hidden bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6">
                            <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-mobile-alt text-[#FF6700] mr-2"></i>
                                E-Wallet Instructions
                            </h4>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                        <span class="font-bold text-gray-700">G</span>
                                    </div>
                                    <div class="flex-grow">
                                        <h6 class="font-bold text-gray-800">Gopay</h6>
                                        <p class="text-sm text-gray-600">0821 2345 6789</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <span class="font-bold text-blue-700">O</span>
                                    </div>
                                    <div class="flex-grow">
                                        <h6 class="font-bold text-gray-800">OVO</h6>
                                        <p class="text-sm text-gray-600">0821 2345 6789</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                                        <span class="font-bold text-green-700">D</span>
                                    </div>
                                    <div class="flex-grow">
                                        <h6 class="font-bold text-gray-800">DANA</h6>
                                        <p class="text-sm text-gray-600">0821 2345 6789</p>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mt-4">
                                    <i class="fas fa-info-circle text-[#FF6700] mr-1"></i>
                                    Transfer exact amount: <span class="font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span> and include booking ID: <span class="font-bold">#{{ $booking->id }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="bg-gradient-to-br from-yellow-50 to-orange-50 border border-yellow-200 rounded-2xl p-6 mb-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h4 class="text-lg font-bold text-gray-900 mb-2">Terms & Conditions</h4>
                            <div class="space-y-2 text-gray-700">
                                <div class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-2 flex-shrink-0"></i>
                                    <span>Payment must be completed within 24 hours of booking</span>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-2 flex-shrink-0"></i>
                                    <span>Refund policy: 80% refund for cancellation 24 hours before booking time</span>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-2 flex-shrink-0"></i>
                                    <span>No-show: No refund for missed bookings</span>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-2 flex-shrink-0"></i>
                                    <span>By proceeding, you agree to our Terms of Service</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col lg:flex-row justify-between items-center gap-6 pt-8 border-t border-gray-200 border-dashed">
                    <a href="{{ route('my.bookings') }}" 
                       class="group bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 px-10 py-4 rounded-xl font-bold hover:from-gray-200 hover:to-gray-300 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center w-full lg:w-auto justify-center">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-gray-200 transition-colors">
                            <i class="fas fa-arrow-left text-gray-600"></i>
                        </div>
                        <span>Back to My Bookings</span>
                    </a>
                    
                    <button type="submit" 
                            class="group relative overflow-hidden bg-gradient-to-r from-green-500 to-emerald-600 text-white px-12 py-4 rounded-xl font-bold hover:shadow-[0_0_30px_rgba(5,150,105,0.4)] transition-all duration-300 shadow-lg hover:-translate-y-1 flex items-center w-full lg:w-auto justify-center">
                        <span class="relative z-10 flex items-center">
                            <i class="fas fa-lock mr-3"></i>
                            Confirm Payment
                            <i class="fas fa-arrow-right ml-4 group-hover:translate-x-2 transition-transform duration-300"></i>
                        </span>
                        <div class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Feature Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="group relative p-8 bg-white rounded-3xl border border-gray-100 hover:border-[#FF6700] transition-all duration-500 hover:shadow-2xl hover:shadow-orange-100 hover:-translate-y-2 cursor-default overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-orange-100 rounded-full transition-transform duration-500 group-hover:scale-[10]"></div>
            
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center mb-8 text-3xl text-[#FF6700] group-hover:text-white group-hover:bg-[#FF6700] transition-colors duration-300">
                    <i class="fas fa-shield-alt"></i>
                </div>
                
                <h4 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-gray-800">Secure Payment</h4>
                <p class="text-gray-600 leading-relaxed mb-6 group-hover:text-gray-700">
                    Transaksi aman dengan enkripsi SSL 256-bit dan sistem keamanan terbaru.
                </p>
            </div>
        </div>
        
        <div class="group relative p-8 bg-white rounded-3xl border border-gray-100 hover:border-[#FF6700] transition-all duration-500 hover:shadow-2xl hover:shadow-orange-100 hover:-translate-y-2 cursor-default overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-orange-100 rounded-full transition-transform duration-500 group-hover:scale-[10]"></div>
            
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center mb-8 text-3xl text-[#FF6700] group-hover:text-white group-hover:bg-[#FF6700] transition-colors duration-300">
                    <i class="fas fa-bolt"></i>
                </div>
                
                <h4 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-gray-800">Instant Confirmation</h4>
                <p class="text-gray-600 leading-relaxed mb-6 group-hover:text-gray-700">
                    Booking langsung aktif setelah pembayaran berhasil dengan notifikasi real-time.
                </p>
            </div>
        </div>
        
        <div class="group relative p-8 bg-white rounded-3xl border border-gray-100 hover:border-[#FF6700] transition-all duration-500 hover:shadow-2xl hover:shadow-orange-100 hover:-translate-y-2 cursor-default overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-orange-100 rounded-full transition-transform duration-500 group-hover:scale-[10]"></div>
            
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center mb-8 text-3xl text-[#FF6700] group-hover:text-white group-hover:bg-[#FF6700] transition-colors duration-300">
                    <i class="fas fa-headset"></i>
                </div>
                
                <h4 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-gray-800">24/7 Support</h4>
                <p class="text-gray-600 leading-relaxed mb-6 group-hover:text-gray-700">
                    Tim support siap membantu 24 jam untuk semua masalah pembayaran dan booking.
                </p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-3xl shadow-2xl overflow-hidden p-12 relative">
        <div class="absolute top-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-orange-500/10 rounded-full -ml-32 -mb-32"></div>
        
        <div class="relative z-10 text-center">
            <h3 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Masih ragu dengan pembayaran?
            </h3>
            <p class="text-gray-300 text-lg mb-10 max-w-2xl mx-auto">
                Hubungi customer service kami untuk bantuan lebih lanjut mengenai metode pembayaran atau masalah teknis.
            </p>
            
            <a href="https://wa.me/6281234567890" target="_blank"
               class="inline-flex items-center justify-center px-10 py-5 border border-transparent text-lg font-bold rounded-xl text-white bg-green-500 hover:bg-green-600 transition shadow-[0_0_30px_rgba(34,197,94,0.4)] hover:shadow-[0_0_40px_rgba(34,197,94,0.6)] transform hover:-translate-y-1">
                <i class="fab fa-whatsapp mr-3 text-xl"></i> Chat via WhatsApp
            </a>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show/hide payment instructions based on selected method
        const paymentMethods = document.querySelectorAll('input[name="method"]');
        const instructions = document.querySelectorAll('.payment-instructions');
        
        function showInstructions(method) {
            // Hide all instructions first
            instructions.forEach(instruction => {
                instruction.classList.add('hidden');
            });
            
            // Show selected instruction
            const instructionId = `${method}-instructions`;
            const instructionElement = document.getElementById(instructionId);
            if (instructionElement) {
                instructionElement.classList.remove('hidden');
            }
            
            // Show default if none selected
            if (!method && instructions.length > 0) {
                instructions[0].classList.remove('hidden');
            }
        }
        
        // Set initial state
        const selectedMethod = document.querySelector('input[name="method"]:checked');
        if (selectedMethod) {
            showInstructions(selectedMethod.value);
        } else {
            showInstructions('qris');
        }
        
        // Add event listeners
        paymentMethods.forEach(method => {
            method.addEventListener('change', function() {
                showInstructions(this.value);
            });
        });
        
        // Form submission confirmation
        const paymentForm = document.getElementById('paymentForm');
        if (paymentForm) {
            paymentForm.addEventListener('submit', function(e) {
                const selectedMethod = document.querySelector('input[name="method"]:checked');
                if (!selectedMethod) {
                    e.preventDefault();
                    alert('Please select a payment method');
                    return;
                }
                
                const methodName = selectedMethod.value === 'qris' ? 'QRIS' : 
                                 selectedMethod.value === 'bank_transfer' ? 'Bank Transfer' : 
                                 selectedMethod.value === 'e_wallet' ? 'E-Wallet' : 'selected method';
                
                const confirmation = confirm(`Confirm payment via ${methodName}?\n\nAmount: Rp {{ number_format($booking->total_price, 0, ',', '.') }}\nBooking ID: #{{ $booking->id }}`);
                
                if (!confirmation) {
                    e.preventDefault();
                }
            });
        }
    });
</script>
@endpush

@push('styles')
<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
    
    @keyframes fade-in-down {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-down {
        animation: fade-in-down 0.8s ease-out;
    }
    
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }
    
    .group:hover .group-hover\:-translate-y-1 {
        transform: translateY(-0.25rem);
    }
    
    .group:hover .group-hover\:translate-x-2 {
        transform: translateX(0.5rem);
    }
    
    .border-dashed {
        border-style: dashed;
    }
    
    /* Custom radio button states */
    .group-has-[:checked]:border-\[\#FF6700\] {
        border-color: #FF6700 !important;
    }
    
    .group-has-[:checked]:bg-gradient-to-r.from-orange-50.to-red-50 {
        background-image: linear-gradient(to right, #fff7ed, #fef2f2);
    }
    
    /* Hide all payment instructions by default */
    .payment-instructions {
        display: none;
    }
    
    .payment-instructions:not(.hidden) {
        display: block;
        animation: fadeIn 0.5s ease-in-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush