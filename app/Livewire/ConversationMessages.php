<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

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
    $conversation = Conversation::with(['messages' => function ($query) {
        $query->where('status', 'approved') // Only approved messages
              ->orWhere('sender_id', auth()->id()) // Allow the sender to see their own messages
              ->orderBy('created_at', 'asc');
    }, 'messages.sender'])->findOrFail($this->conversationId);

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
    \Log::info('Livewire sendMessage called', [
        'sender_id' => auth()->id(),
        'conversation_id' => $this->conversationId,
    ]);

    // Find the conversation and determine the recipient
    $conversation = Conversation::findOrFail($this->conversationId);
    $recipientId = $conversation->user_one_id === auth()->id()
        ? $conversation->user_two_id
        : $conversation->user_one_id;

    \Log::info('Recipient determined', [
        'recipient_id' => $recipientId,
    ]);

    // Create a new message
    $message = Message::create([
        'conversation_id' => $this->conversationId,
        'sender_id' => auth()->id(),
        'recipient_id' => $recipientId,
        'body' => $this->newMessage,
        'status' => 'pending',
    ]);

    \Log::info('Message created', [
        'message_id' => $message->id,
        'sender_id' => $message->sender_id,
        'recipient_id' => $message->recipient_id,
        'body' => $message->body,
        'status' => $message->status,
    ]);

    // Reset the input
    $this->reset('newMessage');

    // Dispatch browser event for JavaScript handling
    $this->dispatch('messageSent');

    $this->updateUnreadCount();
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

        \Log::info('Rendering conversation messages', [
            'conversation_id' => $this->conversationId,
            'logged_in_user' => auth()->id(),
        ]);
        return view('livewire.conversation-messages', [
            'unreadCount' => $this->unreadCount,
        ]);
    }
}
