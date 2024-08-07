<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Conversation;

class ConversationController extends Controller
{
    public function store(Request $request)
    {
        $existingConversation = Conversation::where('user_id', $request->user_id)
            ->where('company_id', $request->company_id)
            ->where('offer_id', $request->offer_id)
            ->first();

        if ($existingConversation) {
            return redirect()->route('conversations.show', $existingConversation);
        }

        $conversation = Conversation::create([
            'user_id' => $request->user_id,
            'company_id' => $request->company_id,
            'offer_id' => $request->offer_id,
        ]);

        return redirect()->route('conversations.show', $conversation);
    }

    public function showAdmin()
    {
        $conversations = Conversation::where('company_id', auth()->user()->company->id)->get();
        return view('dashboard.conversations', [
            'conversations' => $conversations
        ]);
    }

    public function createMessage(Request $request)
    {
        $message = new Message();
        $message->conversation_id = $request->conversation_id;
        $message->user_id = auth()->id();
        $message->message = $request->message;
        $message->save();

        $user = auth()->user();

        if($user->role === 'entreprise') {
            return redirect()->route('conversations.show', ['id' => $request->conversation_id]);
        }elseif($user->role === 'candidat'){
            return redirect()->route('user.panel', ['id' => auth()->id(), 'conv_id' => $request->conversation_id]);
        }
    }

    public function seen($id)
    {
        $message = Message::find($id);

        if ($message->user_id != auth()->id()) {
            $message->seen = 1;
            $message->save();
        }
        return response()->json(['success' => 'Message seen status updated successfully']);
    }

}
