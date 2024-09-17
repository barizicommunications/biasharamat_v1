<div>


    <div class="max-w-screen-2xl mx-auto py-8 px-8">

        <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap mb-8">
            <a href="#" class="text-gray-600 dark:text-gray-200 hover:underline">
                Home
            </a>
            <span class="mx-3 text-gray-500 dark:text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                      clip-rule="evenodd"/>
            </svg>
        </span>

            <a href="#" class="text-primary">
                Register business profile
            </a>
        </div>

        <h2 class="text-primary font-bold text-xl md:text-3xl mb-8">Business profile registration</h2>
        <form wire:submit.prevent="submit" >
            @csrf
            {{ $this->form }}
        </form>

    </div>
</div>
