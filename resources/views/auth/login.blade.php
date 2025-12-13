<x-guest-layout>
    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-hidden">
        
        <div class="absolute inset-0 scale-105"
             style="
                background-image: url('https://media.istockphoto.com/id/1049727980/id/foto/lapangan-tenis-indoor.jpg?s=170667a&w=0&k=20&c=lo_KHBEnW5GiqWNYcJ3CL_7UJnkXXDBTplXzirRIclo='); 
                background-size: cover; 
                background-repeat: no-repeat; 
                background-position: center;
                filter: blur(5px); /* EFEK BLUR DISINI */
             ">
        </div>

        <div class="absolute inset-0 bg-black/10"></div>

        <div class="relative z-10 w-full max-w-md bg-white rounded-3xl shadow-2xl p-8">

            <a href="/"
               class="absolute top-5 right-5 text-gray-400 hover:text-black transition cursor-pointer">
                ✕
            </a>

            <div class="flex justify-center mb-6">
                <a href="/" class="transition hover:opacity-80">
                    <img src="{{ asset('images/logo meraket.png') }}" class="h-10" alt="Meraket">
                </a>
            </div>

            <h2 class="text-3xl font-extrabold text-gray-900 text-center">
                Selamat Datang 👋
            </h2>
            <p class="text-sm text-gray-500 text-center mt-2">
                Login untuk mulai booking lapangan favoritmu
            </p>

            <form method="POST" action="{{ route('login') }}" class="mt-8">
                @csrf

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Email
                    </label>
                    <input type="email" name="email" required autofocus
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-300 
                               focus:outline-none focus:ring-2 focus:ring-black"
                        placeholder="nama@email.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Password
                    </label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-300 
                               focus:outline-none focus:ring-2 focus:ring-black"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 text-black focus:ring-black">
                        Ingat saya
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-gray-500 hover:text-black">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full bg-black hover:bg-gray-800 
                           text-white font-bold py-3 rounded-xl 
                           transition shadow-lg hover:shadow-xl">
                    MASUK
                </button>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                       class="font-semibold text-black hover:underline">
                        Daftar sekarang
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>