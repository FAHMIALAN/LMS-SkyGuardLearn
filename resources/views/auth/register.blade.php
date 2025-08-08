<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nama Lengkap" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- ================================================== -->
        <!-- === BAGIAN PENTING: PILIHAN PERAN (ROLE) === -->
        <!-- ================================================== -->
        <div class="mt-4">
            <x-input-label value="Saya mendaftar sebagai:" />
            <div class="flex items-center mt-2 space-x-4">
                <label for="role_pengajar" class="flex items-center">
                    <input id="role_pengajar" type="radio" name="role" value="pengajar" class="text-indigo-600 focus:ring-indigo-500" {{ old('role') == 'pengajar' ? 'checked' : '' }} required>
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Pengajar</span>
                </label>
                <label for="role_siswa" class="flex items-center">
                    <input id="role_siswa" type="radio" name="role" value="siswa" class="text-indigo-600 focus:ring-indigo-500" {{ old('role') == 'siswa' ? 'checked' : '' }} required>
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Siswa</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <x-primary-button class="ms-4">
                Register
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>