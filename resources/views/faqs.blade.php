<x-guest-layout>
   <section class="bg-[#f4f4f4]">

    <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-8">

        <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap mb-8">


            <a href="#" class="text-gray-600 dark:text-gray-200 hover:underline">
                Home
            </a>
            <span class="mx-3 text-gray-500 dark:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </span>

            <a href="#" class="text-primary">
                FAQs
            </a>
        </div>

    </article>

   </section>

   <section class="bg-white">
    <div class="container max-w-4xl px-6 py-10 mx-auto">
        <h1 class="text-2xl font-semibold text-center text-[#071251] lg:text-3xl">Frequently Asked Questions</h1>

        <div class="mt-12 space-y-8">
            <div x-data="{ open: false }" class="border-2 border-[#071251] rounded-lg">
                <button @click="open = !open" class="flex items-center justify-between w-full p-8">
                    <h1 class="font-semibold text-[#071251]">How do I get started with selling my business?</h1>

                    <span class="text-white bg-[#030e4f] rounded-full w-8 h-8 flex items-center justify-center">
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: block;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                        </svg>
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                        </svg>
                    </span>
                </button>

                <div x-show="open" class="overflow-hidden transition-all duration-300" style="display: none;">
                    <hr class="border-[#071251]">
                    <p class="p-8 text-sm text-gray-600">
                        To get started, you can contact us directly or fill out our seller inquiry form. We will guide you through the valuation and listing process to ensure a seamless experience.
                    </p>
                </div>
            </div>

            <div x-data="{ open: false }" class="border-2 border-[#071251] rounded-lg">
                <button @click="open = !open" class="flex items-center justify-between w-full p-8">
                    <h1 class="font-semibold text-[#071251]">What types of businesses do you help sell or buy?</h1>

                    <span class="text-white bg-[#030e4f] rounded-full w-8 h-8 flex items-center justify-center">
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: block;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                        </svg>
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                        </svg>
                    </span>
                </button>

                <div x-show="open" class="overflow-hidden transition-all duration-300" style="display: none;">
                    <hr class="border-[#071251]">
                    <p class="p-8 text-sm text-gray-600">
                        We specialize in a variety of industries, including retail, hospitality, manufacturing, and more. Contact us for details on whether your business fits our portfolio.
                    </p>
                </div>
            </div>

            <div x-data="{ open: false }" class="border-2 border-[#071251] rounded-lg">
                <button @click="open = !open" class="flex items-center justify-between w-full p-8">
                    <h1 class="font-semibold text-[#071251]">How do you determine the value of a business?</h1>

                    <span class="text-white bg-[#030e4f] rounded-full w-8 h-8 flex items-center justify-center">
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: block;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                        </svg>
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                        </svg>
                    </span>
                </button>

                <div x-show="open" class="overflow-hidden transition-all duration-300" style="display: none;">
                    <hr class="border-[#071251]">
                    <p class="p-8 text-sm text-gray-600">
                        Business valuations are based on various factors, including revenue, profitability, market trends, and industry benchmarks. Our experienced team ensures a fair and competitive valuation.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

</x-guest-layout>