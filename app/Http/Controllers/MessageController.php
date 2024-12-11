<?php



namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    // Function to send a message


public function sendMessage(Request $request, $recipientId)
{
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to send a message.');
    }

    // Log the sender and recipient
    \Log::info('Attempting to send message', [
        'sender_id' => auth()->id(),
        'recipient_id' => $recipientId,
    ]);

    // Validate message content
    $validator = Validator::make($request->all(), [
        'message' => [
            'required',
            'string',
            'max:1000',
            function ($attribute, $value, $fail) {
                if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $value)) {
                    $fail('Providing email addresses in the message is not allowed.');
                }
                if (preg_match('/\+?\d{10,15}/', $value) || preg_match('/\b\d{3}[-.\s]?\d{3}[-.\s]?\d{4}\b/', $value)) {
                    $fail('Providing phone numbers in the message is not allowed.');
                }
            },
        ],
    ]);

    if ($validator->fails()) {
        \Log::error('Validation failed', ['errors' => $validator->errors()]);
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Create or find an existing conversation
    $conversation = Conversation::firstOrCreate([
        'user_one_id' => min(auth()->id(), $recipientId),
        'user_two_id' => max(auth()->id(), $recipientId),
    ]);

    \Log::info('Conversation found or created', [
        'conversation_id' => $conversation->id,
        'user_one_id' => $conversation->user_one_id,
        'user_two_id' => $conversation->user_two_id,
    ]);

    // Save the message
    $message = Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => auth()->id(),
        'recipient_id' => $recipientId,
        'body' => $request->message,
        'status' => 'pending',
    ]);

    \Log::info('Message created', [
        'message_id' => $message->id,
        'sender_id' => $message->sender_id,
        'recipient_id' => $message->recipient_id,
        'body' => $message->body,
        'status' => $message->status,
    ]);

    return redirect()->back()->with('success', 'Your message has been sent and is pending admin approval.');
}


    public function inbox()
{
    $conversations = Conversation::with(['messages' => function ($query) {
            $query->where('status', 'approved')->latest();
        }, 'userOne', 'userTwo'])
        ->where(function ($query) {
            $query->where('user_one_id', auth()->id())
                  ->orWhere('user_two_id', auth()->id());
        })
        ->whereHas('messages', function ($query) {
            $query->where('status', 'approved');
        })
        ->get();

    return view('inbox', compact('conversations'));
}



}
