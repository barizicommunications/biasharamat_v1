<div>
    <!-- Category Filter Tabs -->
    <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 mb-10">
        <ul class="flex flex-wrap -mb-px">
            @foreach ($categories as $category)
                <li class="mr-2">
                    <a href="#"
                       wire:click.prevent="selectCategory('{{ $category }}')"
                       class="inline-block p-4 border-b-2 {{ $selectedCategory === $category ? 'text-primary border-primary font-bold' : 'border-transparent text-primary font-medium hover:text-gray-600 hover:border-gray-300' }}">
                        {{ $category }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Blog Grid -->
    <div class="grid grid-cols-1 gap-8 md:grid-cols-3 mb-16">
        @forelse ($blogs as $blog)
            <div>
                <div class="mb-8">
                    <img src="{{ Storage::url($blog->featured_image) }}" alt="" class="w-full h-48 object-cover">

                </div>
                <div class="mb-2">
                    <h3 class="font-bold text-xl">{{ $blog->title }}</h3>
                </div>
                <div class="mb-6">
                    <p class="text-primary">{{ $blog->excerpt }}</p>
                </div>
                <div>
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="underline text-primary text-lg">Read more</a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">
                No blogs available in this category.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
        {{ $blogs->links() }}
    </div>
</div>
