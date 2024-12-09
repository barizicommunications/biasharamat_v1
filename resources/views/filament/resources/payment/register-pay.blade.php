<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-8">

<div>
    <div class="bg-white p-6  shadow-sm">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Payment Details</h2>
        <div class="space-y-3">
            <div class="flex items-center justify-between border-b border-gray-100 pb-2">
                <span class="text-gray-600 font-medium">Amount</span>
                <span class="text-lg font-semibold text-gray-900">{{ $amount }}</span>
            </div>
            <div class="flex items-center justify-between border-b border-gray-100 pb-2">
                <span class="text-gray-600 font-medium">Description</span>
                <span class="text-gray-900">{{ $description }}</span>
            </div>
        </div>
    </div>

    {!! (new \App\Services\PesapalService())->customerTransaction(
        $amount,
        $description,
        Auth::user()->name,
        '', // Email (if applicable)
        '', // Phone (if applicable)
        '', // Additional parameter (if applicable)
        'reference', // Reference number
        $callback, // Callback URL
        1 // Other parameter (e.g., payment type or method)
    ) !!}
</div>
        </article>

    </section>

</x-guest-layout>
