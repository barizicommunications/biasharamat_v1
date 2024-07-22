<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-10">

            <div class="grid gap-10 grid-cols-1 md:grid-cols-3">
                <div>
                    <h2 class="text-2xl text-primary font-bold">Welcome back!</h2>
                    <p class="text-[#9D9D9D] mb-6">Enter your credentials to login to your account.</p>

                    <form action="{{ route('authenticate') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block mb-3 ">Your email <span
                                        class="text-red-600">*</span></label>
                            <input type="email" id="email" class="w-full" name="email"
                                   value="{{ old('email') }}">
                            @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-8">
                            <label for="password" class="block mb-3 ">Your password <span
                                        class="text-red-600">*</span></label>
                            <input type="password" id="password" class="w-full" name="password">
                            @error('password') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="text-white bg-primary px-8 py-3 block text-center w-full">
                                Login
                            </button>
                        </div>
                        {{-- <div>
                            <a href="{{ route('business.profile.create') }}"
                               class="text-primary bg-transparent border border-primary px-8 py-3 block text-center">
                                <span class="inline-block align-middle"><img src="{{ asset('images/google-logo.png') }}"
                                                                             alt=""></span>
                                <span class="inline-block align-middle ml-3">Log in with google</span>
                            </a>
                        </div> --}}
                    </form>
                </div>
                <div class=" col-span-2 justify-self-end ">

                    <img src="{{ asset('images/kinyozi.png') }}" alt="">

                </div>
            </div>

        </article>
    </section>
</x-guest-layout>