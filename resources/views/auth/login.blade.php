<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-10">
            <div class="grid gap-10 grid-cols-1 md:grid-cols-3">
                <div>
                    <h2 class="text-2xl text-primary font-bold">Welcome back!</h2>
                    <p class="text-[#9D9D9D] mb-6">Enter your credentials to login to your account.</p>

                    <form action="{{ route('authenticate') }}" method="post">
                        @csrf

                        <!-- Email Input -->
                        <div class="mb-4">
                            <label for="email" class="block mb-3">Your email <span class="text-red-600">*</span></label>
                            <input type="email" id="email" class="w-full border rounded-md p-2" name="email" value="{{ old('email') }}">
                            @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password Input with View Icon -->
                        <div class="mb-8" x-data="{ showPassword: false }">
                            <label for="password" class="block mb-3">Your password <span class="text-red-600">*</span></label>
                            <div class="relative">
                                <input :type="showPassword ? 'text' : 'password'" id="password" class="w-full border rounded-md p-2 pr-10" name="password">
                                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                            </div>
                            @error('password') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-2">
                            <button type="submit" class="text-white bg-primary px-8 py-3 block text-center w-full rounded-md">
                                Login
                            </button>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="text-center mt-4">
                            <a href="{{ route('password.request') }}" class="text-primary hover:underline">
                                Forgot your password?
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Image Section -->
                <div class="col-span-2 justify-self-end">
                    <img src="{{ asset('images/kinyozi.png') }}" alt="">
                </div>
            </div>
        </article>
    </section>
</x-guest-layout>
