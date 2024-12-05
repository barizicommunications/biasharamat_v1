<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\Message;

class ConversationMessages extends Component
{
    public $conversationId;
    public $messages = [];
    public $newMessage;
    public $unreadCount;

    public function mount($conversationId)
    {
        $this->conversationId = $conversationId;
        $this->loadMessages();
        $this->updateUnreadCount();
        $this->markMessagesAsRead();
    }

    public function loadMessages()
    {
        // Load all messages in the conversation with sender details
        $conversation = Conversation::with('messages.sender')->findOrFail($this->conversationId);
        $this->messages = $conversation->messages->toArray();
    }

    public function markMessagesAsRead()
    {
        // Mark unread messages in this conversation as read
        Message::where('conversation_id', $this->conversationId)
            ->where('sender_id', '!=', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $this->updateUnreadCount(); // Update unread count after marking as read
    }

    public function sendMessage()
    {
        $this->validate([
            'newMessage' => 'required|string|max:1000',
        ]);

        // Create a new message
        $message = Message::create([
            'conversation_id' => $this->conversationId,
            'sender_id' => auth()->id(),
            'body' => $this->newMessage,
        ]);

        // Add the new message to the messages array
        $this->messages[] = $message->load('sender')->toArray();

        // Clear the input field
        $this->newMessage = '';

        $this->updateUnreadCount(); // Refresh unread count after sending a message
    }

    public function updateUnreadCount()
    {
        // Count unread messages in this specific conversation
        $this->unreadCount = Message::where('conversation_id', $this->conversationId)
            ->where('is_read', false)
            ->where('sender_id', '!=', auth()->id())
            ->count();
    }

    public function render()
    {
        return view('livewire.conversation-messages', [
            'unreadCount' => $this->unreadCount,
        ]);
    }
}
