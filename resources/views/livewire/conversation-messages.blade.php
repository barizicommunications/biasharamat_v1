<div>
    <!-- Message List -->
    <div class="space-y-4 max-h-64 overflow-y-auto" id="messages-container">
        @foreach ($messages as $message)
            <div class="flex flex-col {{ $message['sender_id'] == auth()->id() ? 'items-end' : 'items-start' }}">
                <div class="p-3 rounded-lg {{ $message['sender_id'] == auth()->id() ? 'bg-blue-100' : 'bg-gray-100' }} max-w-md">
                    <p class="font-medium text-sm">
                        {{ $message['sender_id'] == auth()->id() ? 'You' : $message['sender']['first_name'] }}
                    </p>
                    <p class="text-sm">{{ $message['body'] }}</p>
                </div>
                <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($message['created_at'])->diffForHumans() }}</p>
            </div>
        @endforeach
    </div>

    <!-- Reply Form -->
    <form wire:submit.prevent="sendMessage" class="mt-6">
        <textarea wire:model="newMessage" rows="3" class="w-full border rounded-lg p-2 text-sm" placeholder="Write your reply here..."></textarea>
        <div class="flex justify-end space-x-4 mt-2">
            <button type="button" class="px-4 py-2 text-gray-500 border rounded-lg hover:bg-gray-100">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Reply</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('messageSent', function () {
            const container = document.getElementById('messages-container');
            container.scrollTop = container.scrollHeight; // Scroll to the latest message
        });
    });
</script>
