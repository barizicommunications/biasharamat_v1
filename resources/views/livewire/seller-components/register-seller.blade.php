<div>


    <div class="max-w-screen-2xl mx-auto py-8">
        <form wire:submit.prevent="submit" class="px-8">
            @csrf
            {{ $this->form }}
        </form>

    </div>
</div>
