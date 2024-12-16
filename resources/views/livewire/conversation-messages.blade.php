<div class="flex flex-col h-[500px] w-full bg-white rounded-lg">
    <!-- Messages Container -->
    <div class="flex-1 overflow-y-auto px-2 py-2 space-y-2" id="messages-container-{{ $conversationId }}">
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
        <form wire:submit.prevent="sendMessage" class="space-y-3">
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-3 rounded-md">
                <p class="text-sm">
                    <strong>Note:</strong> Please avoid including email addresses, phone numbers, or any contact details in your message.
                </p>
            </div>

            <div class="relative">
                <textarea
                    wire:model.defer="newMessage"
                    placeholder="Type your message..."
                    class="w-full p-3 text-sm text-gray-900 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#bf3907] focus:border-[#bf3907] resize-none"
                    rows="2"
                    id="message-input-{{ $conversationId }}"
                ></textarea>

                @error('newMessage')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
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

<!-- JavaScript for Clearing Input and Scrolling -->
<script>
    document.addEventListener('livewire:load', function () {
        const conversationId = @json($conversationId);
        const messagesContainer = document.getElementById(`messages-container-${conversationId}`);
        const scrollAnchor = document.getElementById(`scroll-anchor-${conversationId}`);
        const messageInput = document.getElementById(`message-input-${conversationId}`);

        function scrollToBottom(behavior = 'smooth') {
            if (scrollAnchor) {
                scrollAnchor.scrollIntoView({ behavior: behavior, block: 'end' });
            }
        }

        // Initial scroll to bottom (instant)
        scrollToBottom('instant');

        Livewire.on('messageSent', function () {
            // Clear the input field
            if (messageInput) {
                messageInput.value = '';
            }

            // Scroll to bottom after a brief delay
            setTimeout(() => {
                scrollToBottom();
            }, 100);
        });
    });
    </script>

