<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-10">

            <div class="grid gap-10 grid-cols-1 md:grid-cols-3">
                <div>
                    <h2 class="text-2xl text-primary font-bold">Create an account</h2>
                    <p class="text-[#9D9D9D] mb-6">Enter your credentials to create your account</p>

                    <form action="{{ route('investor.store') }}" method="post">
                        @csrf

                        <div class="mb-4">
                            <label for="buyer_name" class="block mb-3 ">Your name</label>
                            <input type="text" id="buyer_name" name="buyer_name" class="w-full">
                        </div>
                        <div class="mb-4">
                            <label for="buyer_email" class="block mb-3 ">Your email</label>
                            <input type="email" id="buyer_email" name="buyer_email" class="w-full">
                        </div>

                        <div class="mb-8">
                            <label for="buyer_password" class="block mb-3 ">Your password</label>
                            <input type="password"  id="buyer_password"  name="buyer_password" class="w-full">
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="text-white bg-primary px-8 py-3 block text-center w-full">
                                Create account
                            </button>
                        </div>
                        {{-- <div>
                            <a href="#" class="text-primary bg-transparent border border-primary px-8 py-3 block text-center">

                               <span class="inline-block align-middle"><img src="{{ asset('images/google-logo.png') }}" alt=""></span>
                               <span class="inline-block align-middle ml-3">Sign up with google</span>
                            </a>
                        </div> --}}

                    </form>
                </div>
                <div class=" col-span-2 justify-self-end ">

                    <img src="{{ asset('images/investor.png') }}" alt="">

                </div>
            </div>

        </article>
    </section>
</x-guest-layout>