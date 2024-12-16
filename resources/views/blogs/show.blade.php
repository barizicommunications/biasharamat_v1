<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-8">
            <!-- Breadcrumb Navigation -->
            <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap mb-20">
                <a href="/" class="text-gray-600 hover:underline">Home</a>
                <span class="mx-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <a href="/blogs" class="text-gray-600 hover:underline">Blog</a>
                <span class="mx-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <a href="#" class="text-primary">{{ $blog->title }}</a>
            </div>

            <!-- Blog Title and Excerpt -->
            <div class="text-center mb-10">
                <h1 class="text-primary font-bold text-2xl mb-4">{{ $blog->title }}</h1>
                <p class="text-primary max-w-md mx-auto">{{ $blog->excerpt }}</p>
            </div>

            <!-- Featured Image -->
            <div class="mb-6">
                <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-auto">
            </div>

            <!-- Author and Meta Information -->
            <div class="flex justify-between mb-10">
                <div class="flex">
                    <div>
                        <img src="{{ asset('images/profile-image2.png') }}" alt="Author" class="w-12 h-12 rounded-full">
                    </div>
                    <div class="ml-4">
                        <h3>{{ $blog->author->author_name ?? 'Unknown Author' }}</h3>
                        <h4 class="text-gray-400">{{ $blog->category->category_name }}</h4>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <div>
                        <a href="#" class="flex text-xs items-center border p-4 border-black">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                            </svg>
                            <span class="ml-2">Copy link</span>
                        </a>
                    </div>
                    <div class="flex items-center border border-black px-8 py-2">
                        <ion-icon name="logo-twitter"></ion-icon>
                    </div>
                    <div class="flex items-center border border-black px-8 py-2">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </div>
                    <div class="flex items-center border border-black px-8 py-2">
                        <ion-icon name="logo-linkedin"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- Blog Content -->
            <div class="flex space-x-20 h-full">
                <div class="w-3/5">
                    <div class="prose prose-lg max-w-none text-gray-700">
                        {!! $blog->body !!}
                    </div>
                </div>

              <!-- Contact Form -->
<div class="w-2/5 border h-fit border-gray-400 p-8">
    <h3 class="font-bold text-primary text-2xl mb-6">
        To contact us about this article,<br>
        please fill in the form below.
    </h3>

    <form>
        <div class="mb-3">
            <label for="first_name" class="block mb-2">First name</label>
            <input type="text" placeholder="First name" id="first_name" class="w-full border-gray-300 rounded-md">
        </div>

        <div class="mb-3">
            <label for="last_name" class="block mb-2">Last name</label>
            <input type="text" placeholder="Last name" id="last_name" class="w-full border-gray-300 rounded-md">
        </div>

        <div class="mb-6">
            <label for="email" class="block mb-2">Email</label>
            <input type="email" placeholder="Email" id="email" class="w-full border-gray-300 rounded-md">
        </div>

        <div class="flex items-center space-x-2 mb-10">
            <input type="checkbox" id="privacy_policy" class="rounded-md">
            <label for="privacy_policy" class="text-xs">
                I agree to BiasharaMart’s privacy policy and to receive newsletters.
            </label>
        </div>

        <div>
            <button type="submit" class="bg-primary text-white px-8 py-3 block text-center rounded-md hover:bg-secondary transition-all duration-300">
                Contact Us
            </button>
        </div>
    </form>
</div>

            </div>
        </article>
    </section>
</x-guest-layout>
