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

    // public function loadMessages()
    // {
    //     // Load all messages in the conversation with sender details
    //     $conversation = Conversation::with('messages.sender')->findOrFail($this->conversationId);
    //     $this->messages = $conversation->messages->toArray();
    // }

    public function loadMessages()
{
    $conversation = Conversation::with(['messages' => function ($query) {
        $query->where('status', 'approved');
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

    // public function sendMessage()
    // {
    //     $this->validate([
    //         'newMessage' => [
    //             'required',
    //             'string',
    //             'max:1000',
    //             function ($attribute, $value, $fail) {
    //                 // Regular expressions to detect email addresses and phone numbers
    //                 if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $value)) {
    //                     $fail('Providing email addresses in the message is not allowed.');
    //                 }
    //                 if (preg_match('/\+?\d{10,15}/', $value) || preg_match('/\b\d{3}[-.\s]?\d{3}[-.\s]?\d{4}\b/', $value)) {
    //                     $fail('Providing phone numbers in the message is not allowed.');
    //                 }
    //             },
    //         ],
    //     ]);

    //     // Create a new message
    //     $message = Message::create([
    //         'conversation_id' => $this->conversationId,
    //         'sender_id' => auth()->id(),
    //         'body' => $this->newMessage,
    //     ]);

    //     // Add the new message to the messages array
    //     $this->messages[] = $message->load('sender')->toArray();

    //     // Reset the input
    //     $this->reset('newMessage');

    //     // Dispatch browser event for JavaScript handling
    //     $this->dispatch('messageSent');

    //     $this->updateUnreadCount(); // Refresh unread count after sending a message
    // }



// public function sendMessage()
// {
//     $this->validate([
//         'newMessage' => [
//             'required',
//             'string',
//             'max:1000',
//             function ($attribute, $value, $fail) {
//                 // Detect email addresses or phone numbers
//                 if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $value) ||
//                     preg_match('/\+?\d{10,15}/', $value) ||
//                     preg_match('/\b\d{3}[-.\s]?\d{3}[-.\s]?\d{4}\b/', $value)) {

//                     // Get the admin user
//                     $admin = User::where('registration_type', 'Admin')->first();

//                     // Send a Filament database notification to the admin
//                     if ($admin) {
//                         Notification::make()
//                             ->title('Contact Details Attempted')
//                             ->body(Auth::user()->first_name . ' attempted to send contact details.')
//                             ->icon('heroicon-o-exclamation-triangle')
//                             ->color('warning')
//                             ->sendToDatabase($admin);
//                     }

//                     // Fail the validation
//                     $fail('Providing email addresses or phone numbers in the message is not allowed.');
//                 }
//             },
//         ],
//     ]);

//     // Create a new message
//     $message = Message::create([
//         'conversation_id' => $this->conversationId,
//         'sender_id' => auth()->id(),
//         'body' => $this->newMessage,
//         'status' => 'pending',
//     ]);

//     // Add the new message to the messages array
//     $this->messages[] = $message->load('sender')->toArray();

//     // Reset the input
//     $this->reset('newMessage');

//     // Dispatch browser event for JavaScript handling
//     $this->dispatch('messageSent');

//     $this->updateUnreadCount(); // Refresh unread count after sending a message
// }


public function sendMessage()
{
    $this->validate([
        'newMessage' => [
            'required',
            'string',
            'max:1000',
            function ($attribute, $value, $fail) {
                // Detect email addresses or phone numbers
                if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $value) ||
                    preg_match('/\+?\d{10,15}/', $value) ||
                    preg_match('/\b\d{3}[-.\s]?\d{3}[-.\s]?\d{4}\b/', $value)) {

                    // Get the admin user
                    $admin = User::where('registration_type', 'Admin')->first();

                    // Send a Filament database notification to the admin
                    if ($admin) {
                        Notification::make()
                            ->title('Contact Details Attempted')
                            ->body(Auth::user()->first_name . ' attempted to send contact details.')
                            ->icon('heroicon-o-exclamation-triangle')
                            ->color('warning')
                            ->sendToDatabase($admin);
                    }

                    // Fail the validation
                    $fail('Providing email addresses or phone numbers in the message is not allowed.');
                }
            },
        ],
    ]);

    // Find the conversation and determine the recipient
    $conversation = Conversation::findOrFail($this->conversationId);
    $recipientId = $conversation->user_one_id === auth()->id()
        ? $conversation->user_two_id
        : $conversation->user_one_id;

    // Create a new message
    $message = Message::create([
        'conversation_id' => $this->conversationId,
        'sender_id' => auth()->id(),
        'recipient_id' => $recipientId, // Set the recipient ID
        'body' => $this->newMessage,
        'status' => 'pending', // Set status to pending for admin approval
    ]);

    // Add the new message to the messages array
    $this->messages[] = $message->load('sender')->toArray();

    // Reset the input
    $this->reset('newMessage');

    // Dispatch browser event for JavaScript handling
    $this->dispatch('messageSent');

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
