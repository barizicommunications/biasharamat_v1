<div class="flex flex-col h-[500px] w-full bg-white rounded-lg" x-data="conversationHandler">
    <!-- Messages Container -->
    <div class="flex-1 overflow-y-auto px-2 py-2 space-y-2" id="messages-container-{{ $conversationId }}" x-ref="messagesContainer">
        @foreach ($messages as $message)
            <div class="flex {{ $message['sender_id'] == auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="flex flex-col max-w-[85%] {{ $message['sender_id'] == auth()->id() ? 'items-end' : 'items-start' }}">
                    <div class="flex flex-col px-2 py-1 rounded-lg {{ $message['sender_id'] == auth()->id()
                        ? 'bg-[#bf3907] text-white rounded-br-none'
                        : 'bg-[#030e4f] text-white rounded-bl-none'
                    }}">
                        <p class="text-xs whitespace-pre-wrap break-words text-white leading-tight">
                            {{ $message['body'] }}
                        </p>
                    </div>
                    @if ($message['sender_id'] == auth()->id() && $message['status'] === 'pending')
                        <span class="text-[10px] text-yellow-400">Pending</span>
                    @endif
                    <span class="text-[10px] text-gray-500">
                        {{ \Carbon\Carbon::parse($message['created_at'])->format('g:i A') }}
                    </span>
                </div>
            </div>
        @endforeach
        <div id="scroll-anchor-{{ $conversationId }}"></div>
    </div>

    <!-- Message Input Form -->
    <div class="border-t border-gray-100 p-4 bg-gray-50 rounded-b-lg">
        <form wire:submit.prevent="sendMessage" @submit="clearInput" class="space-y-3">
            <div class="relative">
                <textarea
                    wire:model.defer="newMessage"
                    x-ref="messageInput"
                    placeholder="Type your message..."
                    class="w-full p-3 text-sm text-gray-900 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#bf3907] focus:border-[#bf3907] resize-none"
                    rows="2"
                ></textarea>

                @error('newMessage')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <button
                    type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-[#bf3907] rounded-lg hover:bg-[#a33206] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#bf3907] disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Send</span>
                    <span wire:loading>Sending...</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Alpine.js Component Definition -->
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('conversationHandler', () => ({
        clearInput() {
            this.$refs.messageInput.value = '';
            this.$nextTick(() => {
                this.scrollToBottom();
            });
        },
        scrollToBottom() {
            this.$nextTick(() => {
                const container = this.$refs.messagesContainer;
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            });
        },
        init() {
            // Scroll to the bottom on component initialization
            this.scrollToBottom();
        }
    }));
});

// Livewire hook to scroll after the DOM updates
document.addEventListener('livewire:update', () => {
    const container = document.querySelector('[x-ref="messagesContainer"]');
    if (container) {
        container.scrollTop = container.scrollHeight;
    }
});
</script>
