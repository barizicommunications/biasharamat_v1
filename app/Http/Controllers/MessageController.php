<?php



namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Function to send a message
    public function sendMessage(Request $request, $recipientId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Create or find an existing conversation between the sender and recipient
        $conversation = Conversation::firstOrCreate(
            [
                'user_one_id' => min(auth()->id(), $recipientId),
                'user_two_id' => max(auth()->id(), $recipientId),
            ]
        );

        // Save the message with 'approved' set to false initially (pending approval)
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => auth()->id(),
            'body' => $request->message,
            'approved' => false,  // Message is pending approval
        ]);

        // Redirect without notification since approval will be managed by the admin
        return redirect()->back();
    }

    // Function to show inbox with only approved messages
    public function inbox()
    {
        // Retrieve only approved messages for the current user
        $conversations = Conversation::where('user_one_id', auth()->id())
            ->orWhere('user_two_id', auth()->id())
            ->with(['messages' => function($query) {
                $query->where('approved', true); // Show only approved messages
            }, 'userOne', 'userTwo'])
            ->get();

        return view('messages.inbox', compact('conversations'));
    }
}
