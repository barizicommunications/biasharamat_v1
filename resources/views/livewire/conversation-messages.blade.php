<div class="flex flex-col h-[500px] w-full bg-white rounded-lg">
    <!-- Messages Container -->
    <div class="flex-1 overflow-y-auto px-4 py-3 space-y-4" id="messages-container-{{ $conversationId }}">
        @foreach ($messages as $message)
            <div class="flex {{ $message['sender_id'] == auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="flex flex-col max-w-[70%] {{ $message['sender_id'] == auth()->id() ? 'items-end' : 'items-start' }}">
                    <div class="flex flex-col p-3 rounded-2xl {{ $message['sender_id'] == auth()->id()
                        ? 'bg-[#bf3907] text-white rounded-br-none'
                        : 'bg-[#030e4f] text-white rounded-bl-none'
                    }}">
                        {{-- <span class="font-medium text-sm mb-1">
                            {{ $message['sender_id'] == auth()->id() ? 'You' : $message['sender']['first_name'] }}
                        </span> --}}
                        <p class="text-sm whitespace-pre-wrap break-words text-white">
                            {{ $message['body'] }}
                        </p>
                    </div>
                    <span class="text-xs text-gray-500 mt-1">
                        {{ \Carbon\Carbon::parse($message['created_at'])->format('g:i A') }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Message Input Form -->
    <div class="border-t border-gray-100 p-4 bg-gray-50 rounded-b-lg">
        <form wire:submit.prevent="sendMessage" class="space-y-3">
            <div class="relative">
                <textarea
                    wire:model="newMessage"
                    placeholder="Type your message..."
                    class="w-full p-3 text-sm text-gray-900 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#bf3907] focus:border-[#bf3907] resize-none"
                    rows="2"
                ></textarea>
            </div>
            <div class="flex justify-end space-x-3">
                <button
                    type="button"
                    wire:click="$set('newMessage', '')"
                    class="px-4 py-2 text-sm font-medium text-[#030e4f] bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#030e4f]"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-[#bf3907] rounded-lg hover:bg-[#a33206] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#bf3907] disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50"
                >
                    <span wire:loading.remove>Send</span>
                    <span wire:loading>Sending...</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto-scroll to bottom when new messages arrive
    document.addEventListener('livewire:load', function () {
        const conversationId = @this.conversationId;
        const messagesContainer = document.getElementById(`messages-container-${conversationId}`);

        // Initial scroll to bottom
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Scroll to bottom when new messages are added
        Livewire.on('messageSent', function () {
            if (messagesContainer) {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        });

        // Add smooth scrolling behavior
        if (messagesContainer) {
            messagesContainer.style.scrollBehavior = 'smooth';
        }
    });
</script>