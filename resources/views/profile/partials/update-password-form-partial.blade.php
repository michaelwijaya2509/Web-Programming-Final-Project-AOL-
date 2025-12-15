<form method="post" action="{{ route('profile.password.update') }}" class="space-y-6" id="passwordForm">
    @csrf
    @method('PUT')

    <!-- Current Password -->
    <div class="group">
        <label for="current_password" class="block text-sm font-semibold text-gray-900 mb-2 flex items-center">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-green-100 to-emerald-100 flex items-center justify-center mr-2">
                <i class="fas fa-lock text-green-600"></i>
            </div>
            Current Password
            <span class="text-red-500 ml-1">*</span>
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-key text-gray-400"></i>
            </div>
            <input type="password" 
                   id="current_password" 
                   name="current_password" 
                   required 
                   autocomplete="current-password"
                   class="pl-10 w-full px-4 py-3 border @error('current_password') border-red-500 @else border-gray-300 @endif rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                   placeholder="Enter your current password">
        </div>
        @error('current_password')
            <p class="mt-2 text-sm text-red-500 flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- New Password -->
    <div class="group">
        <label for="password" class="block text-sm font-semibold text-gray-900 mb-2 flex items-center">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-green-100 to-emerald-100 flex items-center justify-center mr-2">
                <i class="fas fa-lock text-green-600"></i>
            </div>
            New Password
            <span class="text-red-500 ml-1">*</span>
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-shield-alt text-gray-400"></i>
            </div>
            <input type="password" 
                   id="password" 
                   name="password" 
                   required 
                   autocomplete="new-password"
                   oninput="checkPasswordStrength()"
                   class="pl-10 w-full px-4 py-3 border @error('password') border-red-500 @else border-gray-300 @endif rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                   placeholder="Enter a new password (min 8 characters)">
        </div>
        
        <!-- Password Strength Indicator -->
        <div class="mt-3">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm text-gray-600">Password Strength:</span>
                <span class="text-sm font-medium" id="strengthText">—</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div id="strengthBar" class="h-2 rounded-full transition-all duration-300" style="width: 0%; background-color: #d1d5db;"></div>
            </div>
        </div>

        @error('password')
            <p class="mt-2 text-sm text-red-500 flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="group">
        <label for="password_confirmation" class="block text-sm font-semibold text-gray-900 mb-2 flex items-center">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-green-100 to-emerald-100 flex items-center justify-center mr-2">
                <i class="fas fa-lock text-green-600"></i>
            </div>
            Confirm New Password
            <span class="text-red-500 ml-1">*</span>
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-check-circle text-gray-400"></i>
            </div>
            <input type="password" 
                   id="password_confirmation" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   class="pl-10 w-full px-4 py-3 border @error('password_confirmation') border-red-500 @else border-gray-300 @endif rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                   placeholder="Confirm your new password">
        </div>
        @error('password_confirmation')
            <p class="mt-2 text-sm text-red-500 flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Form Actions -->
    <div class="flex flex-col sm:flex-row items-center justify-between pt-8 border-t border-gray-200 mt-8">
        <a href="{{ route('profile.show') }}" 
           class="group bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:from-gray-200 hover:to-gray-300 transition-all duration-300 shadow-sm hover:shadow flex items-center mb-4 sm:mb-0">
            <i class="fas fa-arrow-left mr-2"></i>
            Cancel
        </a>
        
        <button type="submit" 
                class="group bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-green-600 hover:to-emerald-700 transition-all duration-300 shadow-md hover:shadow-lg flex items-center">
            <i class="fas fa-save mr-2"></i>
            Update Password
        </button>
    </div>
</form>

<script>
function checkPasswordStrength() {
    const password = document.getElementById('password').value;
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    
    let strength = 0;
    let strengthLevel = 'Weak';
    let color = '#ef4444';
    
    if (password.length >= 8) strength++;
    if (password.length >= 12) strength++;
    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
    if (/\d/.test(password)) strength++;
    if (/[^a-zA-Z\d]/.test(password)) strength++;
    
    switch(strength) {
        case 0:
        case 1:
            strengthLevel = 'Weak';
            color = '#ef4444';
            break;
        case 2:
            strengthLevel = 'Fair';
            color = '#f97316';
            break;
        case 3:
            strengthLevel = 'Good';
            color = '#eab308';
            break;
        case 4:
            strengthLevel = 'Strong';
            color = '#22c55e';
            break;
        case 5:
            strengthLevel = 'Very Strong';
            color = '#10b981';
            break;
    }
    
    strengthBar.style.width = (strength * 20) + '%';
    strengthBar.style.backgroundColor = color;
    strengthText.textContent = strengthLevel;
    strengthText.style.color = color;
}
</script>
