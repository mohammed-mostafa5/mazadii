<?php

namespace App\Http\Controllers\UsersPanel;

use App\Events\Chat as EventsChat;
use App\Models\Chat;
use App\Models\ChatContent;
use App\Models\Vet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{

    public function rooms()
    {
        return view('usersPanel.page.chat.rooms');
    }

    public function room($id)
    {
        $room = Chat::with('content', 'user')->find($id);
        $room->update(['count_new_message' => 0]);
        $contents = ChatContent::where('chat_id', $room->id)->get();
        $type_chat = 1;
        $channel = 'chat-' . $room->id;
        $room_channel = 'private-chat-' . $room->id;
        $room_append = 'private-chat-' . $room->id;

        return view('usersPanel.page.chat.room', compact('room', 'contents', 'type_chat', 'channel', 'room_channel', 'room_append'));
    }

    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'type_chat' => 'required',
            'content' => '',
            'file' => '',
        ]);

        $userId = auth()->id();

        $room = Chat::find($id);

        $dataRequest = [
            'chat_id'   => $room->id,
            'seen'      => 0, //0=>no, 1=>yes
            'senderable_id'   => $userId,
            'senderable_type'   => 'App\Models\User',
            'content'   => request('content'),
        ];

        if (request()->has('file') || request()->filled('file')) {

            $file = $request->file('file');

            $type = explode('/', $file->getClientMimeType());
            switch ($type[0]) {
                case 'image':
                    $dataRequest['photo'] = $file;
                    break;
                case 'audio':
                    $dataRequest['audio'] = $file;
                    break;
                case 'video':
                    $dataRequest['video'] = $file;
                    break;
                default:
                    $dataRequest['file'] = $file;
                    break;
            }
        }

        $content = ChatContent::create($dataRequest);

        event(new EventsChat(['data_to'=>'chat', 'data'=>$content, 'send_to'=> 'private-chat-'.$room->id, 'channel'=>'chat-'.$room->id]));
        event(new EventsChat(['data_to'=>'chat', 'data'=>$content, 'send_to'=> $room->vet->email .'-'. $room->vet_id, 'channel'=>$room->vet->email .'-'. $room->vet_id]));

        $room->increment('count_new_message_vet');
        $room->update(['count_new_message' => 0]);

        return response()->json(['msg'=>'success', 'data'=>$content]);
    }

    //////////////////////////////////////////////////////
    ////////////////////// Support ///////////////////////
    //////////////////////////////////////////////////////

    public function supportSendMessage(Request $request)
    {
        $request->validate([
            'type_chat'=>'required',
            'content'=>'',
        ]);

        $userId =auth()->id();
        $vet = Vet::where('support',1)->first();
        if($vet){

            $room = Chat::updateOrCreate([
                'vet_id'=>$vet->id,
                'user_id'=>$userId,
                'type'=>2,//1=>chat, 2=>customer service
            ]);

            $dataRequest = [
                'chat_id'   => $room->id,
                'seen'      => 0, //0=>no, 1=>yes
                'senderable_id'   => $userId,
                'senderable_type'   => 'App\Models\User',
                'content'   => request('content'),
            ];

            $content = ChatContent::create($dataRequest);

            event(new EventsChat(['data_to'=>'chat', 'data'=>$content, 'send_to'=> $room->vet->email .'-'. $room->vet_id, 'channel'=>$room->vet->email .'-'. $room->vet_id]));

            $room->update(['count_new_message'=>0]);

            return response()->json(['msg'=>'success', 'data' => $content]);
        }

        return response()->json(['msg'=>'support is not working now'],403);
    }
}
