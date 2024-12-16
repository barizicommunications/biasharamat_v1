<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-10">
            <div class="grid gap-10 grid-cols-1 md:grid-cols-3">
                <div>
                    <h2 class="text-2xl text-primary font-bold">Create an account</h2>
                    <p class="text-[#9D9D9D] mb-6">Enter your credentials to create your account</p>

                    <form action="{{ route('business.store') }}" method="post">
                        @csrf

                        <!-- Name Input -->
                        <div class="mb-4">
                            <label for="seller_name" class="block mb-3">Buiness name <span class="text-red-600">*</span></label>
                            <input
                                type="text"
                                id="seller_name"
                                name="seller_name"
                                value="{{ old('seller_name') }}"
                                class="w-full border rounded-md p-2 @error('seller_name') border-red-600 @enderror"
                                required
                            >
                            @error('seller_name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div class="mb-4">
                            <label for="seller_email" class="block mb-3">Business email <span class="text-red-600">*</span></label>
                            <input
                                type="email"
                                id="seller_email"
                                name="seller_email"
                                value="{{ old('seller_email') }}"
                                class="w-full border rounded-md p-2 @error('seller_email') border-red-600 @enderror"
                                required
                            >
                            @error('seller_email')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Registration Type (Optional) -->
                        {{--
                        <div class="mb-4">
                            <label for="registration_type" class="block mb-3">Registration type <span class="text-red-600">*</span></label>
                            <select
                                name="registration_type"
                                id="registration_type"
                                class="w-full border rounded-md p-2 @error('registration_type') border-red-600 @enderror"
                                required
                            >
                                <option value="">&mdash; select &mdash;</option>
                                @foreach (['Business Seller', 'Business Buyer'] as $role)
                                    <option value="{{ $role }}" @if (old('registration_type') == $role) selected @endif>{{ $role }}</option>
                                @endforeach
                            </select>
                            @error('registration_type')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        --}}

                        <!-- Password Input with View/Hide Toggle -->
                        <div class="mb-4" x-data="{ showPassword: false }">
                            <label for="seller_password" class="block mb-3">Create a password <span class="text-red-600">*</span></label>
                            <div class="relative">
                                <input
                                    :type="showPassword ? 'text' : 'password'"
                                    id="seller_password"
                                    name="seller_password"
                                    class="w-full border rounded-md p-2 pr-10 @error('seller_password') border-red-600 @enderror"
                                    required
                                >
                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 focus:outline-none"
                                    aria-label="Toggle password visibility"
                                >
                                    <!-- Eye Icon -->
                                    <svg
                                        x-show="!showPassword"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-6 w-6 text-gray-500"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                        />
                                    </svg>
                                    <!-- Eye Slash Icon -->
                                    <svg
                                        x-show="showPassword"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-6 w-6 text-gray-500"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"
                                        />
                                    </svg>
                                </button>
                            </div>
                            @error('seller_password')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password Input with View/Hide Toggle -->
                        <div class="mb-8" x-data="{ showConfirmPassword: false }">
                            <label for="seller_password_confirmation" class="block mb-3">Confirm password <span class="text-red-600">*</span></label>
                            <div class="relative">
                                <input
                                    :type="showConfirmPassword ? 'text' : 'password'"
                                    id="seller_password_confirmation"
                                    name="seller_password_confirmation"
                                    class="w-full border rounded-md p-2 pr-10 @error('seller_password_confirmation') border-red-600 @enderror"
                                    required
                                >
                                <button
                                    type="button"
                                    @click="showConfirmPassword = !showConfirmPassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 focus:outline-none"
                                    aria-label="Toggle confirm password visibility"
                                >
                                    <!-- Eye Icon -->
                                    <svg
                                        x-show="!showConfirmPassword"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-6 w-6 text-gray-500"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                        />
                                    </svg>
                                    <!-- Eye Slash Icon -->
                                    <svg
                                        x-show="showConfirmPassword"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-6 w-6 text-gray-500"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"
                                        />
                                    </svg>
                                </button>
                            </div>
                            @error('seller_password_confirmation')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-2">
                            <button
                                type="submit"
                                class="text-white bg-primary px-8 py-3 block text-center w-full rounded-md hover:bg-primary-dark transition-colors"
                            >
                                Create account
                            </button>
                        </div>

                        {{--
                        <!-- Optional: Sign Up with Google -->
                        <div>
                            <a href="{{ route('business.profile.create') }}"
                               class="text-primary bg-transparent border border-primary px-8 py-3 flex items-center justify-center space-x-3">
                               <img src="{{ asset('images/google-logo.png') }}" alt="Google Logo" class="h-5 w-5">
                               <span>Sign up with Google</span>
                            </a>
                        </div>
                        --}}
                    </form>
                </div>
                <div class="col-span-2 justify-self-end">
                    <img src="{{ asset('images/kinyozi.png') }}" alt="Kinyozi Image" class="w-full h-auto">
                </div>
            </div>
        </article>
    </section>
</x-guest-layout>
