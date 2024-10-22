<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Message;
use App\Events\SendMessage;

class Chat extends Component
{
    public $user;
    public $sender_id;
    public $receiver_id;
    public $message = '';
    public $messages = [];
    public function render()
    {
        return view('livewire.chat');
    }

    public function mount($user_id)
    {
        $this->sender_id = auth()->user()->id;
        $this->receiver_id = $user_id;

        $messages = Message::where(function ($query) {
            $query->where('sender_id', $this->sender_id)
                ->where('receiver_id', $this->receiver_id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver_id)
                ->where('receiver_id', $this->sender_id);
        })
            ->with('sender:id,name', 'receiver:id,name')
            ->get();
        $this->user = User::whereId($user_id)->first();

        foreach($messages as $message){
            $this->appendChatMessage($message);
        }
    }

    public function sendMessage()
    {
        $chatMessage = new Message();
        $chatMessage->sender_id = $this->sender_id;
        $chatMessage->receiver_id = $this->receiver_id;
        $chatMessage->message = $this->message;
        $chatMessage->save();

        broadcast(new SendMessage($chatMessage))->toOthers();

        $this->message = '';

    }

    public function appendChatMessage($message)
    {
        $this->messages[] = [
            'id' => $message->id,
            'sender' => $message->sender_id,
            'receiver' => $message->receiver_id,
            'message' => $message->message,
            'created_at' => $message->created_at,
        ];
    }
}
