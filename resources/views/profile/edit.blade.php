@extends('layouts.app')

@section('title', 'Edit Profile - Update Personal Information')

@section('content')

<!-- Hero Section -->
<div class="relative w-full h-[400px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-tr from-gray-900 via-transparent to-orange-900/40 z-0"></div>
    
    <img src="https://plus.unsplash.com/premium_photo-1708692919998-e3dc853ef8a8?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        alt="Edit Profile Background" class="absolute inset-0 w-full h-full object-cover filter brightness-[0.4]">
    
    <div class="relative z-10 container mx-auto px-6 md:px-12 text-center">
        <div class="inline-block mb-8 animate-fade-in-down">
            
        </div>
        
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 tracking-tight leading-tight drop-shadow-2xl">
            Edit Your <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF6700] to-yellow-400">Profile Information</span>
        </h1>
        
        <p class="text-lg md:text-2xl text-gray-200 mb-10 max-w-3xl mx-auto font-light leading-relaxed">
            Update your personal details and keep your account information current
        </p>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-16 relative z-30">
    <!-- Success Message -->
    @if (session('status') === 'profile-updated')
        <div class="mb-8 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl shadow-lg flex items-center justify-between animate-fade-in">
            <div class="flex items-center">
                <div class="bg-white/20 p-2 rounded-lg mr-3">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div>
                    <p class="font-bold">Profile Updated Successfully!</p>
                    <p class="text-sm text-green-100">Your profile information has been updated.</p>
                </div>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-green-100 hover:text-white ml-4 transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Current Profile & Stats -->
        <div class="lg:col-span-1 space-y-8">
            <!-- Current Profile Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-5">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-user-circle mr-3"></i>
                        Current Profile
                    </h3>
                </div>
                
                <div class="p-6">
                    <!-- Avatar -->
                    <div class="flex flex-col items-center mb-6">
                        <div class="relative mb-4">
                            <div class="w-28 h-28 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white text-4xl font-bold shadow-2xl">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            @if ($user->email_verified_at)
                                <div class="absolute -bottom-2 -right-2 bg-green-500 text-white p-3 rounded-full shadow-lg">
                                    <i class="fas fa-check text-sm"></i>
                                </div>
                            @endif
                        </div>
                        <h4 class="text-2xl font-bold text-gray-900 mb-1">{{ $user->name }}</h4>
                        <p class="text-gray-600 flex items-center">
                            <i class="fas fa-envelope text-orange-500 mr-2 text-sm"></i>
                            {{ $user->email }}
                        </p>
                    </div>
                    
                    <!-- Profile Stats -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center mr-3">
                                    <i class="fas fa-hashtag text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">User ID</p>
                                    <p class="text-lg font-bold text-gray-900">#{{ $user->id }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar-alt text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Member Since</p>
                                    <p class="text-lg font-bold text-gray-900">{{ $user->created_at?->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center mr-3">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Last Updated</p>
                                    <p class="text-lg font-bold text-gray-900">{{ $user->updated_at?->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-5">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-bolt mr-3"></i>
                        Quick Actions
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-3">
                        <a href="{{ route('profile.show') }}" 
                           class="group flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl hover:border-blue-300 hover:shadow-md transition-all duration-200">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center mr-4">
                                    <i class="fas fa-user-circle text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">View Profile</p>
                                    <p class="text-sm text-gray-600">Back to profile overview</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-blue-500 text-lg group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        
                        <a href="{{ route('password.edit') }}" 
                           class="group flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl hover:border-green-300 hover:shadow-md transition-all duration-200">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center mr-4">
                                    <i class="fas fa-shield-alt text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Change Password</p>
                                    <p class="text-sm text-gray-600">Update security settings</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-green-500 text-lg group-hover:translate-x-1 transition-transform"></i>
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

        <!-- Right Column - Edit Form -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Edit Profile Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-8 py-6">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-xl mr-4">
                            <i class="fas fa-user-edit text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">Edit Profile Information</h2>
                            <p class="text-orange-100 mt-1">Update your personal information and email address</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <!-- Update Form -->
                    <form method="post" action="{{ route('profile.update') }}" class="space-y-8">
                        @csrf
                        @method('patch')

                        <!-- Name Section -->
                        <div class="space-y-6">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Personal Information</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <label for="name" class="block text-sm font-semibold text-gray-900">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <span class="text-xs text-gray-500" id="name-counter">0/50</span>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-user-tag text-gray-400"></i> 
                                    </div>
                                    <input type="text" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $user->name) }}" 
                                           required 
                                           autofocus 
                                           autocomplete="name"
                                           maxlength="50"
                                           class="pl-12 w-full px-6 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 @error('name') border-red-500 @enderror"
                                           placeholder="Enter your full name">
                                    @error('name')
                                        <div class="absolute right-4 top-3.5 text-red-500">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                    @enderror
                                </div>
                                @error('name')
                                    <p class="text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                                <p class="text-xs text-gray-500 flex items-center">
                                    <i class="fas fa-lightbulb text-orange-500 mr-2"></i>
                                    Your name should be between 3-50 characters
                                </p>
                            </div>
                        </div>

                        <!-- Email Section -->
                        <div class="space-y-6">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-envelope text-white text-sm"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Contact Information</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <label for="email" class="block text-sm font-semibold text-gray-900">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-exclamation-circle mr-1"></i> Unverified
                                        </span>
                                    @endif
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-at text-gray-400"></i>
                                    </div>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $user->email) }}" 
                                           required 
                                           autocomplete="email"
                                           class="pl-12 w-full px-6 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 @error('email') border-red-500 @enderror"
                                           placeholder="Enter your email address">
                                    @error('email')
                                        <div class="absolute right-4 top-3.5 text-red-500">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                    @enderror
                                </div>
                                @error('email')
                                    <p class="text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                                
                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-xl p-5">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-yellow-500 to-orange-500 flex items-center justify-center">
                                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <h4 class="font-semibold text-gray-900 mb-1">Email Verification Required</h4>
                                                <p class="text-sm text-gray-600 mb-3">
                                                    Your email address needs to be verified. Please check your inbox for the verification email.
                                                </p>
                                                <a href="{{ route('verification.send') }}" 
                                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 text-white font-medium rounded-lg hover:from-yellow-600 hover:to-orange-600 transition-all duration-200">
                                                    <i class="fas fa-paper-plane mr-2"></i>
                                                    Resend Verification Email
                                                </a>
                                                @if (session('status') === 'verification-link-sent')
                                                    <p class="mt-3 text-sm text-green-600 flex items-center">
                                                        <i class="fas fa-check-circle mr-2"></i>
                                                        A new verification link has been sent to your email address.
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
                                        Reset
                                    </button>
                                    
                                    <button type="submit" 
                                            class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-xl hover:from-orange-600 hover:to-red-600 hover:shadow-lg transition-all duration-200 flex items-center justify-center">
                                        <i class="fas fa-save mr-2"></i>
                                        Save Changes
                                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Guidelines Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-8 py-6">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-xl mr-4">
                            <i class="fas fa-lightbulb text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">Update Guidelines</h2>
                            <p class="text-gray-300 mt-1">Important information about updating your profile</p>
                        </div>
                    </div>
                </div>

                <!-- Guidelines Content -->
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center mr-3">
                                    <i class="fas fa-user-check text-white"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">Real Information</h4>
                            </div>
                            <p class="text-sm text-gray-600">
                                Use your real name and valid email address for account verification and security purposes.
                            </p>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-envelope-open-text text-white"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">Email Verification</h4>
                            </div>
                            <p class="text-sm text-gray-600">
                                After changing your email, you'll need to verify it to maintain full account access.
                            </p>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-history text-white"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">Update History</h4>
                            </div>
                            <p class="text-sm text-gray-600">
                                All profile changes are logged and can be reviewed in your account activity.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Tips -->
            <div class="bg-gradient-to-r from-orange-50 to-red-50 border border-orange-200 rounded-2xl p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center mr-4">
                            <i class="fas fa-shield-alt text-white text-lg"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Security Tips</h3>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                <span>Always use a unique email address for your account</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                <span>Keep your personal information up to date</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                <span>Verify your email address for enhanced security</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                <span>Review your profile information regularly</span>
                            </li>
                        </ul>
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
    
    /* Section dividers */
    .section-divider {
        position: relative;
    }
    
    .section-divider::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(to right, transparent, #e5e7eb, transparent);
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

        // Character counter for name field
        const nameInput = document.getElementById('name');
        const nameCounter = document.getElementById('name-counter');
        
        if (nameInput && nameCounter) {
            const updateCounter = () => {
                const length = nameInput.value.length;
                const maxLength = nameInput.getAttribute('maxlength') || 50;
                nameCounter.textContent = `${length}/${maxLength}`;
                
                if (length > maxLength * 0.8) {
                    nameCounter.classList.remove('text-gray-500', 'text-yellow-500');
                    nameCounter.classList.add('text-red-500', 'font-semibold');
                } else if (length > maxLength * 0.6) {
                    nameCounter.classList.remove('text-gray-500', 'text-red-500');
                    nameCounter.classList.add('text-yellow-500', 'font-medium');
                } else {
                    nameCounter.classList.remove('text-yellow-500', 'text-red-500', 'font-semibold', 'font-medium');
                    nameCounter.classList.add('text-gray-500');
                }
            };
            
            updateCounter();
            nameInput.addEventListener('input', updateCounter);
        }

        // Reset form button
        const resetButton = document.querySelector('button[type="reset"]');
        if (resetButton) {
            resetButton.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                
                // Reset to original values
                const nameInput = form.querySelector('#name');
                const emailInput = form.querySelector('#email');
                
                if (nameInput) nameInput.value = nameInput.defaultValue;
                if (emailInput) emailInput.value = emailInput.defaultValue;
                
                // Update counter
                if (nameCounter) updateCounter();
                
                // Show reset confirmation
                const resetAlert = document.createElement('div');
                resetAlert.className = 'mb-6 bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-4 animate-fade-in';
                resetAlert.innerHTML = `
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Form Reset Complete</p>
                            <p class="text-sm text-gray-600">All fields have been reset to their original values</p>
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

        // Form validation feedback
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const nameInput = this.querySelector('#name');
                const emailInput = this.querySelector('#email');
                let isValid = true;
                
                // Clear previous errors
                document.querySelectorAll('.validation-error').forEach(el => el.remove());
                
                // Validate name
                if (nameInput.value.trim().length < 3) {
                    showValidationError(nameInput, 'Name must be at least 3 characters long');
                    isValid = false;
                }
                
                // Validate email format
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value.trim())) {
                    showValidationError(emailInput, 'Please enter a valid email address');
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
                if (input.value.trim().length >= 3 || input.value.includes('@')) {
                    removeError();
                }
            });
            
            // Auto-remove after 5 seconds
            setTimeout(removeError, 5000);
        }

        // Add hover effects to cards
        const cards = document.querySelectorAll('.bg-white.rounded-2xl');
        cards.forEach(card => {
            card.classList.add('hover-lift');
        });
    });
</script>
@endpush