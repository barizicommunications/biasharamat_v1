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

        // $request->validate([
        //     'message' => 'required|string|max:1000',
        // ]);


          // Custom validation logic
    $validator = Validator::make($request->all(), [
        'message' => [
            'required',
            'string',
            'max:1000',
            function ($attribute, $value, $fail) {
                // Regular expressions to detect email addresses and phone numbers
                if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $value)) {
                    $fail('Providing email addresses in the message is not allowed.');
                }
                if (preg_match('/\+?\d{10,15}/', $value) || preg_match('/\b\d{3}[-.\s]?\d{3}[-.\s]?\d{4}\b/', $value)) {
                    $fail('Providing phone numbers in the message is not allowed.');
                }
            },
        ],
    ]);

    // Handle validation failure
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

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
        $conversations = Conversation::with(['messages' => function ($query) {
            $query->latest();
        }, 'userOne', 'userTwo'])
        ->get()
        ->map(function ($conversation) {
            $conversation->unread_count = $conversation->messages()
                ->where('is_read', false)
                ->where('sender_id', '!=', auth()->id())
                ->count();
            return $conversation;
        });

        return view('inbox', compact('conversations'));
    }


}
