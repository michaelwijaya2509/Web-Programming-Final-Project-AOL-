@extends('layouts.app')

@section('title', 'Change Password - Update Security Settings')

@section('content')

<!-- Hero Section -->
<div class="relative w-full h-[400px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-tr from-gray-900 via-transparent to-orange-900/40 z-0"></div>
    
    <img src="https://plus.unsplash.com/premium_photo-1708692919998-e3dc853ef8a8?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        alt="Security Background" class="absolute inset-0 w-full h-full object-cover filter brightness-[0.4]">
    
    <div class="relative z-10 container mx-auto px-6 md:px-12 text-center">
        <div class="inline-block mb-8 animate-fade-in-down">
            
        </div>
        
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 tracking-tight leading-tight drop-shadow-2xl">
            Secure Your <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF6700] to-yellow-400">Account Access</span>
        </h1>
        
        <p class="text-lg md:text-2xl text-gray-200 mb-10 max-w-3xl mx-auto font-light leading-relaxed">
            Update your password to keep your account protected and secure
        </p>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-16 relative z-30">
    <!-- Success Message -->
    @if (session('status') === 'password-updated')
        <div class="mb-8 bg-gradient-to-r from-orange-500 to-red-600 text-white px-6 py-4 rounded-xl shadow-lg flex items-center justify-between animate-fade-in">
            <div class="flex items-center">
                <div class="bg-white/20 p-2 rounded-lg mr-3">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div>
                    <p class="font-bold">Password Updated Successfully!</p>
                    <p class="text-sm text-orange-100">Your password has been updated.</p>
                </div>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-orange-100 hover:text-white ml-4 transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Security Stats & Info -->
        <div class="lg:col-span-1 space-y-8">
            <!-- Security Status Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover-lift">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-5">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-shield-check mr-3"></i>
                        Security Status
                    </h3>
                </div>
                
                <div class="p-6">
                    <!-- Security Score -->
                    <div class="flex flex-col items-center mb-6">
                        <div class="relative mb-4">
                            <div class="w-28 h-28 rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center text-white text-4xl font-bold shadow-2xl">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="absolute -bottom-2 -right-2 bg-green-500 text-white p-3 rounded-full shadow-lg">
                                <i class="fas fa-check text-sm"></i>
                            </div>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-900 mb-1">Strong Security</h4>
                        <p class="text-gray-600 flex items-center">
                            <i class="fas fa-clock text-orange-500 mr-2 text-sm"></i>
                            Last updated {{ $user->updated_at?->diffForHumans() }}
                        </p>
                    </div>
                    
                    <!-- Security Stats -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:shadow-sm transition-shadow duration-200">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center mr-3">
                                    <i class="fas fa-key text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Password Strength</p>
                                    <p class="text-lg font-bold text-gray-900">Strong</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:shadow-sm transition-shadow duration-200">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar-alt text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Last Changed</p>
                                    <p class="text-lg font-bold text-gray-900">{{ $user->updated_at?->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:shadow-sm transition-shadow duration-200">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-history text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Account Age</p>
                                    <p class="text-lg font-bold text-gray-900">{{ $user->created_at?->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover-lift">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-5">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-bolt mr-3"></i>
                        Quick Actions
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-3">
                        <a href="{{ route('profile.edit') }}" 
                           class="group flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl hover:border-blue-300 hover:shadow-md transition-all duration-200">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center mr-4">
                                    <i class="fas fa-user-edit text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Edit Profile</p>
                                    <p class="text-sm text-gray-600">Update personal information</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-blue-500 text-lg group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        
                        <a href="{{ route('profile.show') }}" 
                           class="group flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-purple-100 border border-purple-200 rounded-xl hover:border-purple-300 hover:shadow-md transition-all duration-200">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 flex items-center justify-center mr-4">
                                    <i class="fas fa-user-circle text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">View Profile</p>
                                    <p class="text-sm text-gray-600">Profile overview</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-purple-500 text-lg group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        
                        <a href="{{ route('profile.delete') }}" 
                           class="group flex items-center justify-between p-4 bg-gradient-to-r from-red-50 to-red-100 border border-red-200 rounded-xl hover:border-red-300 hover:shadow-md transition-all duration-200">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-red-500 to-red-600 flex items-center justify-center mr-4">
                                    <i class="fas fa-trash-alt text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Delete Account</p>
                                    <p class="text-sm text-gray-600">Remove account permanently</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-red-500 text-lg group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Password Form -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Change Password Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover-lift">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-8 py-6">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-xl mr-4">
                            <i class="fas fa-key text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">Change Password</h2>
                            <p class="text-orange-100 mt-1">Update your password to keep your account secure</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <!-- Update Form -->
                    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
                        @csrf
                        @method('put')

                        <!-- Current Password -->
                        <div class="space-y-6">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center mr-3">
                                    <i class="fas fa-unlock-alt text-white text-sm"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Current Password</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <label for="current_password" class="block text-sm font-semibold text-gray-900">
                                        Current Password <span class="text-red-500">*</span>
                                    </label>
                                    <button type="button" onclick="togglePassword('current_password')" class="text-xs text-orange-600 hover:text-orange-700 font-medium flex items-center">
                                        <i class="fas fa-eye mr-1"></i>
                                        <span id="toggle-current-text">Show</span>
                                    </button>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password" 
                                           id="current_password" 
                                           name="current_password" 
                                           required 
                                           autofocus
                                           class="pl-12 w-full px-6 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 @error('current_password') border-red-500 @enderror"
                                           placeholder="Enter your current password">
                                    @error('current_password')
                                        <div class="absolute right-4 top-3.5 text-red-500">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                    @enderror
                                </div>
                                @error('current_password')
                                    <p class="text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="space-y-6">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center mr-3">
                                    <i class="fas fa-key text-white text-sm"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">New Password</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <label for="password" class="block text-sm font-semibold text-gray-900">
                                        New Password <span class="text-red-500">*</span>
                                    </label>
                                    <button type="button" onclick="togglePassword('password')" class="text-xs text-orange-600 hover:text-orange-700 font-medium flex items-center">
                                        <i class="fas fa-eye mr-1"></i>
                                        <span id="toggle-new-text">Show</span>
                                    </button>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-key text-gray-400"></i>
                                    </div>
                                    <input type="password" 
                                           id="password" 
                                           name="password" 
                                           required
                                           autocomplete="new-password"
                                           class="pl-12 w-full px-6 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 @error('password') border-red-500 @enderror"
                                           placeholder="Enter your new password">
                                    @error('password')
                                        <div class="absolute right-4 top-3.5 text-red-500">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Password Strength Meter -->
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-medium text-gray-700">Password Strength</span>
                                        <span id="strength-text" class="text-xs font-medium">Weak</span>
                                    </div>
                                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div id="strength-meter" class="h-full bg-red-500 w-0 transition-all duration-300"></div>
                                    </div>
                                    <div id="password-hints" class="grid grid-cols-2 gap-2 mt-2">
                                        <div class="flex items-center">
                                            <i class="fas fa-check text-gray-300 text-xs mr-2"></i>
                                            <span class="text-xs text-gray-500">8+ characters</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-check text-gray-300 text-xs mr-2"></i>
                                            <span class="text-xs text-gray-500">Uppercase</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-check text-gray-300 text-xs mr-2"></i>
                                            <span class="text-xs text-gray-500">Lowercase</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-check text-gray-300 text-xs mr-2"></i>
                                            <span class="text-xs text-gray-500">Number</span>
                                        </div>
                                    </div>
                                </div>
                                
                                @error('password')
                                    <p class="text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-6">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center mr-3">
                                    <i class="fas fa-check-double text-white text-sm"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Confirm Password</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-900">
                                        Confirm New Password <span class="text-red-500">*</span>
                                    </label>
                                    <button type="button" onclick="togglePassword('password_confirmation')" class="text-xs text-orange-600 hover:text-orange-700 font-medium flex items-center">
                                        <i class="fas fa-eye mr-1"></i>
                                        <span id="toggle-confirm-text">Show</span>
                                    </button>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           required
                                           autocomplete="new-password"
                                           class="pl-12 w-full px-6 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200"
                                           placeholder="Confirm your new password">
                                </div>
                                <p class="text-xs text-gray-500 flex items-center">
                                    <i class="fas fa-lightbulb text-orange-500 mr-2"></i>
                                    Re-enter your new password to confirm
                                </p>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="pt-8 border-t border-gray-200">
                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-info-circle text-orange-500 mr-2"></i>
                                    <span>All fields marked with * are required</span>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                                    <button type="reset" 
                                            class="w-full sm:w-auto px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:border-gray-400 hover:bg-gray-50 transition-all duration-200 flex items-center justify-center">
                                        <i class="fas fa-redo mr-2"></i>
                                        Clear
                                    </button>
                                    
                                    <button type="submit" 
                                            class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-xl hover:from-orange-600 hover:to-red-600 hover:shadow-lg transition-all duration-200 flex items-center justify-center group">
                                        <i class="fas fa-save mr-2"></i>
                                        Update Password
                                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Security Guidelines Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover-lift">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-8 py-6">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-xl mr-4">
                            <i class="fas fa-shield-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">Password Guidelines</h2>
                            <p class="text-gray-300 mt-1">Follow these rules for a strong password</p>
                        </div>
                    </div>
                </div>

                <!-- Guidelines Content -->
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center mr-3">
                                    <i class="fas fa-check-circle text-white"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">Strong Password</h4>
                            </div>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-orange-500 mr-2 mt-0.5"></i>
                                    <span>Minimum 8 characters</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-orange-500 mr-2 mt-0.5"></i>
                                    <span>Mix uppercase & lowercase</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-orange-500 mr-2 mt-0.5"></i>
                                    <span>Include numbers (0-9)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-orange-500 mr-2 mt-0.5"></i>
                                    <span>Special characters (@#$%)</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-red-500 to-red-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-times-circle text-white"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">Avoid These</h4>
                            </div>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-times text-red-500 mr-2 mt-0.5"></i>
                                    <span>Personal information</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-times text-red-500 mr-2 mt-0.5"></i>
                                    <span>Common words (password123)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-times text-red-500 mr-2 mt-0.5"></i>
                                    <span>Sequential numbers (12345)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-times text-red-500 mr-2 mt-0.5"></i>
                                    <span>Reusing old passwords</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    
    /* Animations */
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }
    
    .animate-fade-in-down {
        animation: fadeInDown 0.6s ease-out;
    }
    
    .animate-slide-up {
        animation: slideUp 0.3s ease-out;
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
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideUp {
        from { 
            opacity: 0; 
            transform: translateY(20px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }
    
    /* Smooth transitions */
    * {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #FF6700, #FF4500);
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #FF4500, #FF3000);
    }
    
    /* Form focus effects */
    input:focus {
        box-shadow: 0 0 0 3px rgba(255, 103, 0, 0.1);
        outline: none;
    }
    
    /* Gradient text animation */
    .gradient-text {
        background: linear-gradient(45deg, #FF6700, #FF4500, #FF3000);
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
    }
    
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Card hover effects */
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }
    
    /* Password strength colors */
    .strength-weak {
        background-color: #EF4444 !important;
    }
    
    .strength-fair {
        background-color: #F59E0B !important;
    }
    
    .strength-good {
        background-color: #3B82F6 !important;
    }
    
    .strength-strong {
        background-color: #10B981 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide success message after 5 seconds
        const successMessage = document.querySelector('.animate-fade-in');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.opacity = '0';
                successMessage.style.transition = 'opacity 0.5s ease';
                setTimeout(() => {
                    successMessage.remove();
                }, 500);
            }, 5000);
        }

        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggleText = document.getElementById(`toggle-${fieldId.replace('password', 'new').replace('current_password', 'current').replace('password_confirmation', 'confirm')}-text`);
            
            if (field.type === 'password') {
                field.type = 'text';
                toggleText.textContent = 'Hide';
                toggleText.parentElement.innerHTML = '<i class="fas fa-eye-slash mr-1"></i>Hide';
            } else {
                field.type = 'password';
                toggleText.textContent = 'Show';
                toggleText.parentElement.innerHTML = '<i class="fas fa-eye mr-1"></i>Show';
            }
        }

        // Password strength checker
        const passwordInput = document.getElementById('password');
        const strengthMeter = document.getElementById('strength-meter');
        const strengthText = document.getElementById('strength-text');
        const passwordHints = document.querySelectorAll('#password-hints .fa-check');
        
        if (passwordInput) {
            const updatePasswordStrength = () => {
                const password = passwordInput.value;
                let strength = 0;
                
                // Reset hints
                passwordHints.forEach(hint => {
                    hint.className = 'fas fa-check text-gray-300 text-xs mr-2';
                });
                
                // Length check
                if (password.length >= 8) {
                    strength += 1;
                    passwordHints[0].className = 'fas fa-check text-orange-500 text-xs mr-2';
                }
                
                // Uppercase check
                if (/[A-Z]/.test(password)) {
                    strength += 1;
                    passwordHints[1].className = 'fas fa-check text-orange-500 text-xs mr-2';
                }
                
                // Lowercase check
                if (/[a-z]/.test(password)) {
                    strength += 1;
                    passwordHints[2].className = 'fas fa-check text-orange-500 text-xs mr-2';
                }
                
                // Number check
                if (/[0-9]/.test(password)) {
                    strength += 1;
                    passwordHints[3].className = 'fas fa-check text-orange-500 text-xs mr-2';
                }
                
                // Special character check (bonus)
                if (/[^A-Za-z0-9]/.test(password)) {
                    strength += 1;
                }
                
                // Update strength meter
                const percentages = [0, 20, 40, 60, 80, 100];
                const colors = [
                    '#EF4444', // red-500
                    '#F59E0B', // amber-500
                    '#3B82F6', // blue-500
                    '#10B981', // emerald-500
                    '#10B981', // emerald-500
                    '#10B981'  // emerald-500
                ];
                const texts = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong', 'Very Strong'];
                
                strengthMeter.style.width = `${percentages[strength]}%`;
                strengthMeter.style.backgroundColor = colors[strength];
                strengthText.textContent = texts[strength];
                strengthText.className = 'text-xs font-medium';
                
                // Add color class to text
                if (strength <= 1) {
                    strengthText.classList.add('text-red-500');
                } else if (strength <= 2) {
                    strengthText.classList.add('text-amber-500');
                } else if (strength <= 3) {
                    strengthText.classList.add('text-blue-500');
                } else {
                    strengthText.classList.add('text-green-500');
                }
            };
            
            passwordInput.addEventListener('input', updatePasswordStrength);
            updatePasswordStrength(); // Initial check
        }

        // Form validation feedback
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const currentPassword = this.querySelector('#current_password');
                const newPassword = this.querySelector('#password');
                const confirmPassword = this.querySelector('#password_confirmation');
                let isValid = true;
                
                // Clear previous errors
                document.querySelectorAll('.validation-error').forEach(el => el.remove());
                
                // Check if current password is entered
                if (!currentPassword.value.trim()) {
                    showValidationError(currentPassword, 'Current password is required');
                    isValid = false;
                }
                
                // Check new password length
                if (newPassword.value.trim().length < 8) {
                    showValidationError(newPassword, 'Password must be at least 8 characters long');
                    isValid = false;
                }
                
                // Check if passwords match
                if (newPassword.value !== confirmPassword.value) {
                    showValidationError(confirmPassword, 'Passwords do not match');
                    isValid = false;
                }
                
                if (!isValid) {
                    e.preventDefault();
                    // Scroll to first error
                    document.querySelector('.validation-error')?.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            });
        }

        function showValidationError(input, message) {
            // Remove error styling
            input.classList.remove('border-red-500');
            void input.offsetWidth; // Trigger reflow
            
            // Add error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'validation-error mt-2 text-sm text-red-600 flex items-center animate-slide-up';
            errorDiv.innerHTML = `
                <i class="fas fa-exclamation-circle mr-2"></i>
                ${message}
            `;
            
            // Insert after input container
            input.parentNode.parentNode.appendChild(errorDiv);
            
            // Highlight input
            input.classList.add('border-red-500');
            input.focus();
            
            // Remove error after 5 seconds if user hasn't interacted
            const removeError = () => {
                if (errorDiv.parentNode) {
                    errorDiv.style.opacity = '0';
                    errorDiv.style.transition = 'opacity 0.3s ease';
                    setTimeout(() => {
                        if (errorDiv.parentNode) {
                            errorDiv.remove();
                            input.classList.remove('border-red-500');
                        }
                    }, 300);
                }
            };
            
            // Remove on input
            input.addEventListener('input', () => {
                const password = document.getElementById('password')?.value;
                const confirmPassword = document.getElementById('password_confirmation')?.value;
                
                if (input.id === 'password' && input.value.trim().length >= 8) {
                    removeError();
                } else if (input.id === 'password_confirmation' && password === confirmPassword) {
                    removeError();
                } else if (input.id === 'current_password' && input.value.trim()) {
                    removeError();
                }
            });
            
            // Auto-remove after 5 seconds
            setTimeout(removeError, 5000);
        }

        // Reset form button
        const resetButton = document.querySelector('button[type="reset"]');
        if (resetButton) {
            resetButton.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                
                // Reset all password fields
                const inputs = form.querySelectorAll('input[type="password"], input[type="text"]');
                inputs.forEach(input => {
                    input.value = '';
                });
                
                // Reset strength meter
                if (strengthMeter) {
                    strengthMeter.style.width = '0%';
                    strengthText.textContent = 'Weak';
                    strengthText.className = 'text-xs font-medium text-red-500';
                }
                
                // Reset password hints
                if (passwordHints) {
                    passwordHints.forEach(hint => {
                        hint.className = 'fas fa-check text-gray-300 text-xs mr-2';
                    });
                }
                
                // Show reset confirmation
                const resetAlert = document.createElement('div');
                resetAlert.className = 'mb-6 bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-4 animate-fade-in';
                resetAlert.innerHTML = `
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Form Cleared</p>
                            <p class="text-sm text-gray-600">All password fields have been cleared</p>
                        </div>
                    </div>
                `;
                
                // Insert after the form's parent or before the form
                form.parentNode.insertBefore(resetAlert, form);
                setTimeout(() => {
                    resetAlert.style.opacity = '0';
                    resetAlert.style.transition = 'opacity 0.3s ease';
                    setTimeout(() => resetAlert.remove(), 300);
                }, 3000);
            });
        }
    });
</script>
@endpush