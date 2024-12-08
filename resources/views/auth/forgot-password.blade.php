<x-guest-layout>
    <section class="bg-[#f4f4f4] min-h-screen flex items-center justify-center py-6">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
            <!-- Heading -->
            <h2 class="text-2xl font-bold text-primary mb-6 text-center">
                Forgot Your Password?
            </h2>

            <!-- Description -->
            <p class="text-gray-600 mb-6 text-center leading-relaxed">
                No problem! Just enter your email address below, and we will email you a password reset link to help you set a new one.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Password Reset Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address Field -->
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Email')" class="block mb-2 text-gray-700" />
                    <x-text-input
                        id="email"
                        class="w-full border rounded-md p-2 focus:outline-none focus:ring focus:ring-primary/50"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        placeholder="Enter your email address"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-center">
                    <x-primary-button class="w-full py-3 bg-primary text-white rounded-md hover:bg-primary-dark transition duration-300">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
