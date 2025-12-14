@extends('layouts.app')

@section('title', 'Delete Account - Permanent Account Removal')

@section('content')

<!-- Hero Section -->
<div class="relative w-full h-[400px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-tr from-gray-900 via-transparent to-red-900/40 z-0"></div>
    
    <img src="https://plus.unsplash.com/premium_photo-1708692919998-e3dc853ef8a8?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        alt="Delete Account Background" class="absolute inset-0 w-full h-full object-cover filter brightness-[0.4]">
    
    <div class="relative z-10 container mx-auto px-6  md:px-12 text-center">
        <div class="inline-block mb-8 animate-fade-in-down">
            
        </div>
        
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 tracking-tight leading-tight drop-shadow-2xl">
            Delete Your <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF4500] to-red-600">Account Permanently</span>
        </h1>
        
        <p class="text-lg md:text-2xl text-gray-200 mb-10 max-w-3xl mx-auto font-light leading-relaxed">
            This action cannot be undone. All your data will be permanently deleted.
        </p>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-16 relative z-30">
    <!-- Danger Warning -->
    <div class="mb-8 bg-gradient-to-r from-red-500 to-orange-600 text-white px-6 py-4 rounded-xl shadow-lg animate-fade-in animate-pulse">
        <div class="flex items-center">
            <div class="bg-white/20 p-2 rounded-lg mr-3">
                <i class="fas fa-exclamation-triangle text-xl"></i>
            </div>
            <div>
                <p class="font-bold text-lg">⚠️ Irreversible Action Warning</p>
                <p class="text-sm text-red-100 mt-1">This action cannot be undone. All data will be permanently deleted with no recovery option.</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Account Info & Alternatives -->
        <div class="lg:col-span-1 space-y-8">
            <!-- Account Status Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover-lift">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-5">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-user-circle mr-3"></i>
                        Account Information
                    </h3>
                </div>
                
                <div class="p-6">
                    <!-- Current User Info -->
                    <div class="flex flex-col items-center mb-6">
                        <div class="relative mb-4">
                            <div class="w-28 h-28 rounded-full bg-gradient-to-br from-red-500 to-orange-600 flex items-center justify-center text-white text-4xl font-bold shadow-2xl">
                                <i class="fas fa-user-slash"></i>
                            </div>
                            <div class="absolute -bottom-2 -right-2 bg-red-500 text-white p-3 rounded-full shadow-lg animate-pulse">
                                <i class="fas fa-exclamation text-sm"></i>
                            </div>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-900 mb-1">{{ $user->name }}</h4>
                        <p class="text-gray-600 flex items-center">
                            <i class="fas fa-envelope text-red-500 mr-2 text-sm"></i>
                            {{ $user->email }}
                        </p>
                    </div>
                    
                    <!-- Account Stats -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-red-500 to-orange-500 flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar-times text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Member Since</p>
                                    <p class="text-lg font-bold text-gray-900">{{ $user->created_at?->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center mr-3">
                                    <i class="fas fa-database text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Data Stored</p>
                                    <p class="text-lg font-bold text-gray-900">All Data</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-gray-500 to-gray-600 flex items-center justify-center mr-3">
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

            <!-- Alternatives Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover-lift">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-5">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-life-ring mr-3"></i>
                        Consider Alternatives
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl">
                            <div class="flex items-center mb-2">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-user-edit text-white"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">Update Profile</h4>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">
                                Update your personal information instead of deleting your account.
                            </p>
                            <a href="{{ route('profile.edit') }}" 
                               class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700 font-medium">
                                <i class="fas fa-arrow-right mr-2"></i>
                                Edit Profile
                            </a>
                        </div>
                        
                        <!-- <div class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl">
                            <div class="flex items-center mb-2">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center mr-3">
                                    <i class="fas fa-shield-alt text-white"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">Security Settings</h4>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">
                                Update your password or security settings for better protection.
                            </p>
                            <a href="{{ route('password.edit') }}" 
                               class="inline-flex items-center text-sm text-green-600 hover:text-green-700 font-medium">
                                <i class="fas fa-arrow-right mr-2"></i>
                                Security Settings
                            </a>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-200 rounded-xl">
                            <div class="flex items-center mb-2">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-yellow-500 to-amber-500 flex items-center justify-center mr-3">
                                    <i class="fas fa-ban text-white"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">Temporary Deactivation</h4>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">
                                Temporarily deactivate your account instead of permanent deletion.
                            </p>
                            <button type="button" 
                                    onclick="showDeactivateInfo()"
                                    class="inline-flex items-center text-sm text-yellow-600 hover:text-yellow-700 font-medium">
                                <i class="fas fa-info-circle mr-2"></i>
                                Learn More
                            </button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Delete Confirmation -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Delete Account Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover-lift">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-red-500 to-orange-600 px-8 py-6">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-xl mr-4">
                            <i class="fas fa-trash-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">Delete Account</h2>
                            <p class="text-red-100 mt-1">Permanently delete your account and all associated data</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <!-- Warning Message -->
                    <div class="mb-8 bg-gradient-to-r from-red-50 to-orange-50 border border-red-200 rounded-xl p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-red-500 to-orange-500 flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-red-800 mb-3">⚠️ Final Warning</h3>
                                <div class="space-y-2 text-red-700">
                                    <p class="flex items-start">
                                        <i class="fas fa-times-circle mt-1 mr-2 flex-shrink-0"></i>
                                        <span>This action <strong>cannot be undone</strong>. All data will be permanently deleted.</span>
                                    </p>
                                    <p class="flex items-start">
                                        <i class="fas fa-times-circle mt-1 mr-2 flex-shrink-0"></i>
                                        <span>You will lose access to all services and features immediately.</span>
                                    </p>
                                    <p class="flex items-start">
                                        <i class="fas fa-times-circle mt-1 mr-2 flex-shrink-0"></i>
                                        <span>No data recovery option is available after deletion.</span>
                                    </p>
                                    <p class="flex items-start">
                                        <i class="fas fa-times-circle mt-1 mr-2 flex-shrink-0"></i>
                                        <span>Your account cannot be restored or reactivated.</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                   

                    <!-- Delete Confirmation Form -->
                    <div class="border-t border-gray-200 pt-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-user-slash text-red-500 mr-2"></i>
                            Confirm Account Deletion
                        </h3>
                        
                        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-8" id="deleteForm" onsubmit="return validateDelete()">
                            @csrf
                            @method('delete')

                            <!-- Password Confirmation -->
                            <div class="space-y-6">
                                <div class="flex items-center mb-2">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-red-500 to-orange-500 flex items-center justify-center mr-3">
                                        <i class="fas fa-lock text-white text-sm"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Password Verification</h3>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <label for="password" class="block text-sm font-semibold text-gray-900">
                                            Your Password <span class="text-red-500">*</span>
                                        </label>
                                        <button type="button" onclick="togglePassword('password')" class="text-xs text-orange-600 hover:text-orange-700 font-medium flex items-center">
                                            <i class="fas fa-eye mr-1"></i>
                                            <span id="toggle-password-text">Show</span>
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
                                               class="pl-12 w-full px-6 py-3.5 border border-red-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 bg-red-50"
                                               placeholder="Enter your current password to confirm">
                                        @error('password')
                                            <div class="absolute right-4 top-3.5 text-red-500">
                                                <i class="fas fa-exclamation-circle"></i>
                                            </div>
                                        @enderror
                                    </div>
                                    @error('password')
                                        <p class="text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirmation Checkbox -->
                            <div class="space-y-6">
                                <div class="flex items-center mb-2">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-red-500 to-orange-500 flex items-center justify-center mr-3">
                                        <i class="fas fa-exclamation-triangle text-white text-sm"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Acknowledgement</h3>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="flex items-start p-4 bg-gradient-to-r from-red-50 to-orange-50 border border-red-200 rounded-xl">
                                        <div class="flex items-center h-5 mr-4">
                                            <input id="understand" 
                                                   name="understand" 
                                                   type="checkbox" 
                                                   required
                                                   onchange="checkConfirmation()"
                                                   class="w-5 h-5 text-red-600 border-red-300 rounded focus:ring-red-500 focus:ring-2">
                                        </div>
                                        <div class="flex-1">
                                            <label for="understand" class="font-semibold text-gray-900">
                                                I understand the consequences
                                            </label>
                                            <p class="text-sm text-gray-600 mt-1">
                                                I acknowledge that this action cannot be undone, all my data will be permanently deleted, and I will lose access to all services immediately.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Type Confirmation -->
                            <div class="space-y-6">
                                <div class="flex items-center mb-2">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-red-500 to-orange-500 flex items-center justify-center mr-3">
                                        <i class="fas fa-keyboard text-white text-sm"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Final Confirmation</h3>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <label for="delete_confirmation" class="block text-sm font-semibold text-gray-900">
                                            Type "DELETE" to confirm <span class="text-red-500">*</span>
                                        </label>
                                        <span class="text-xs text-gray-500" id="charCount">0/6</span>
                                    </div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i class="fas fa-keyboard text-gray-400"></i>
                                        </div>
                                        <input type="text" 
                                               id="delete_confirmation" 
                                               name="delete_confirmation" 
                                               required 
                                               oninput="checkConfirmation()"
                                               class="pl-12 w-full px-6 py-3.5 border border-red-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 bg-red-50"
                                               placeholder="Type DELETE exactly as shown">
                                    </div>
                                    <p class="text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-lightbulb text-orange-500 mr-2"></i>
                                        This extra step helps prevent accidental deletion
                                    </p>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="pt-8 border-t border-gray-200">
                                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-info-circle text-red-500 mr-2"></i>
                                        <span>All confirmation steps must be completed</span>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                                        <a href="{{ route('profile.edit') }}" 
                                           class="w-full sm:w-auto px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:border-gray-400 hover:bg-gray-50 transition-all duration-200 flex items-center justify-center">
                                            <i class="fas fa-arrow-left mr-2"></i>
                                            Cancel
                                        </a>
                                        
                                        <button type="submit" 
                                                id="deleteButton"
                                                disabled
                                                class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-red-500 to-orange-600 text-white font-semibold rounded-xl hover:from-red-600 hover:to-orange-700 hover:shadow-lg transition-all duration-200 flex items-center justify-center group opacity-50 cursor-not-allowed">
                                            <i class="fas fa-trash-alt mr-2"></i>
                                            Delete Account
                                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
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
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.7;
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
        background: linear-gradient(to bottom, #FF4500, #FF3000);
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #FF3000, #FF2000);
    }
    
    /* Form focus effects */
    input:focus {
        box-shadow: 0 0 0 3px rgba(255, 69, 0, 0.1);
        outline: none;
    }
    
    /* Gradient text animation */
    .gradient-text {
        background: linear-gradient(45deg, #FF4500, #FF3000, #FF2000);
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

        // Character count for delete confirmation
        const confirmationInput = document.getElementById('delete_confirmation');
        const charCount = document.getElementById('charCount');
        
        if (confirmationInput) {
            confirmationInput.addEventListener('input', function() {
                const length = this.value.length;
                charCount.textContent = `${length}/6`;
                
                if (this.value.toUpperCase() === 'DELETE') {
                    charCount.className = 'text-xs font-medium text-green-500';
                } else {
                    charCount.className = 'text-xs font-medium text-red-500';
                }
                
                checkConfirmation();
            });
        }

        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggleText = document.getElementById(`toggle-${fieldId}-text`);
            
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

        // Add hover effects to cards
        const cards = document.querySelectorAll('.bg-white.rounded-2xl');
        cards.forEach(card => {
            card.classList.add('hover-lift');
        });
    });

    function checkConfirmation() {
        const confirmationInput = document.getElementById('delete_confirmation');
        const understandCheckbox = document.getElementById('understand');
        const deleteButton = document.getElementById('deleteButton');
        
        const isConfirmed = confirmationInput.value.toUpperCase() === 'DELETE';
        const isUnderstood = understandCheckbox.checked;
        
        if (isConfirmed && isUnderstood) {
            deleteButton.disabled = false;
            deleteButton.classList.remove('opacity-50', 'cursor-not-allowed');
            deleteButton.classList.add('opacity-100', 'cursor-pointer');
        } else {
            deleteButton.disabled = true;
            deleteButton.classList.remove('opacity-100', 'cursor-pointer');
            deleteButton.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    function validateDelete() {
        const confirmationInput = document.getElementById('delete_confirmation');
        const understandCheckbox = document.getElementById('understand');
        const passwordInput = document.getElementById('password');
        
        if (!understandCheckbox.checked) {
            alert('❌ Please check the box to acknowledge that you understand this action cannot be undone.');
            understandCheckbox.focus();
            return false;
        }
        
        if (confirmationInput.value.toUpperCase() !== 'DELETE') {
            alert('❌ Please type "DELETE" exactly as shown to confirm account deletion.');
            confirmationInput.focus();
            return false;
        }
        
        if (!passwordInput.value) {
            alert('❌ Please enter your password to confirm.');
            passwordInput.focus();
            return false;
        }
        
        // Final confirmation with modal-like dialog
        return showFinalConfirmation();
    }

    function showFinalConfirmation() {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/70 flex items-center justify-center z-50 p-4';
        modal.innerHTML = `
            <div class="bg-white rounded-2xl max-w-md w-full overflow-hidden shadow-2xl animate-slide-up">
                <div class="bg-gradient-to-r from-red-500 to-orange-600 px-6 py-4">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-exclamation-triangle mr-3"></i>
                        🚨 FINAL WARNING
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-red-500 to-red-600 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-times text-white"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">This action CANNOT be undone</p>
                                <p class="text-sm text-gray-600 mt-1">No recovery option is available</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-database text-white"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">All data will be permanently deleted</p>
                                <p class="text-sm text-gray-600 mt-1">Profile, files, history, everything</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-red-600 to-red-700 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-user-slash text-white"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Immediate access loss</p>
                                <p class="text-sm text-gray-600 mt-1">All services will be unavailable</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <p class="text-center font-bold text-red-600 mb-4">
                            Are you absolutely sure you want to proceed?
                        </p>
                        <div class="flex space-x-3">
                            <button type="button" onclick="this.closest('.fixed').remove()" 
                                    class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">
                                Cancel
                            </button>
                            <button type="button" onclick="proceedWithDeletion()" 
                                    class="flex-1 px-4 py-2 bg-gradient-to-r from-red-500 to-orange-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-orange-700 transition-all">
                                Yes, Delete Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // Prevent form submission for now
        return false;
    }

    function proceedWithDeletion() {
        // Remove the modal
        document.querySelector('.fixed.bg-black\\/70').remove();
        
        // Submit the form
        document.getElementById('deleteForm').submit();
    }

    function showDeactivateInfo() {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/70 flex items-center justify-center z-50 p-4';
        modal.innerHTML = `
            <div class="bg-white rounded-2xl max-w-md w-full overflow-hidden shadow-2xl animate-slide-up">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-info-circle mr-3"></i>
                        Account Deactivation
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Temporary Solution</p>
                                <p class="text-sm text-gray-600 mt-1">Deactivate instead of deleting permanently</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-yellow-500 to-amber-500 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-undo text-white"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Reversible Action</p>
                                <p class="text-sm text-gray-600 mt-1">Can be reactivated anytime</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-shield-alt text-white"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Data Preservation</p>
                                <p class="text-sm text-gray-600 mt-1">All your data remains safe</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <p class="text-center text-gray-600 mb-4">
                            Contact support to learn more about temporary deactivation options.
                        </p>
                        <div class="flex space-x-3">
                            <button type="button" onclick="this.closest('.fixed').remove()" 
                                    class="w-full px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
    }

    // Add event listeners
    document.getElementById('understand')?.addEventListener('change', checkConfirmation);
    document.getElementById('delete_confirmation')?.addEventListener('input', checkConfirmation);
</script>
@endpush