<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request, $recipientId)
{

    $request->validate([
        'message' => 'required|string|max:1000', // Ensure message is not null and within a reasonable length
    ]);
    // Find or create a conversation between current user and the profile owner
    $conversation = Conversation::firstOrCreate(
        [
            'user_one_id' => min(auth()->id(), $recipientId), // Ensures smaller ID is first
            'user_two_id' => max(auth()->id(), $recipientId),
        ]
    );

    // Save the message
    $message = Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => auth()->id(),
        'body' => $request->message,
    ]);

    return redirect()->back()->with('status', 'Message sent successfully.');
}

public function inbox()
{
    $conversations = Conversation::where('user_one_id', auth()->id())
        ->orWhere('user_two_id', auth()->id())
        ->with(['messages', 'userOne', 'userTwo'])
        ->get();

    return view('messages.inbox', compact('conversations'));
}

public function replyMessage(Request $request, $conversationId)
{
    $conversation = Conversation::findOrFail($conversationId);

    $message = $conversation->messages()->create([
        'sender_id' => auth()->id(),
        'body' => $request->message,
    ]);

    return redirect()->route('messages.view', $conversationId)->with('status', 'Reply sent successfully.');
}


}
