<?php

namespace App\Http\Controllers;

use App\chatBox;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function listCount(Request $request)
    {
        $messageCount = chatBox::leftjoin('users', 'users.id', 'chat_boxes.from_user')->where('to_user', Auth::user()->id)->where('read_status', 0)->count();

        return $messageCount;
    }

    public function getLoadMessages(Request $request)
    {

        $messages = chatBox::select('chat_boxes.*', 'users.name')->leftjoin('users', 'users.id', 'chat_boxes.from_user')->where('to_user', Auth::user()->id)->groupBy('chat_boxes.from_user')->get();
        foreach ($messages as $key => $value) {
            // $value['chat'] = chatBox::select('chat_boxes.content','users.name')->leftjoin('users', 'users.id', 'chat_boxes.from_user')->whereIn('users.id', [$value['from_user'],$value['to_user']])->get();
            $from_user = chatBox::where('to_user', '=', Auth::user()->id)
                ->where('from_user', '=', $value['from_user'])->get();
            $to_user = chatBox::select('*', DB::raw("'user' as type"))->where('to_user', '=', $value['from_user'])
                ->where('from_user', '=', Auth::user()
                ->id)->get();
            $list = $from_user->merge($to_user);
            $collection = $list->toArray();
            $sorted = collect($collection)->sortBy('id');
            $value['chat'] =  $sorted->values()->all();

        }
        return $data = array('status' => 'success', 'message' => 'Data Loaded Successfully', 'data' => $messages);
    }

    public function getLoadLatestMessagesChat(Request $request)
    {

    $messages = chatBox::select('chat_boxes.*', 'users.name')->leftjoin('users', 'users.id', 'chat_boxes.from_user')
    ->where('to_user', Auth::user()->id)
    ->orderBy('id', 'desc')
    ->get();
        $collection = $messages->toArray();
        $groups = collect($collection)->groupBy('from_user');
        $results = [];
        foreach ($groups as $group) {
            $chunk = $group->shift();
            $results[] = $chunk;
        }
    return $data = array('status' => 'success', 'message' => 'Data Loaded Successfully', 'data' => $results);

    }

    public function getLoadMessagesUnread(Request $request)
    {
        // $to_user = $request->to_user;
        $messages = chatBox::select('chat_boxes.*', 'users.name')->leftjoin('users', 'users.id', 'chat_boxes.from_user')->where('to_user', Auth::user()->id)->where('read_status', 0)->latest('chat_boxes.created_at')->get();
        $messageCount = chatBox::leftjoin('users', 'users.id', 'chat_boxes.from_user')->where('to_user', Auth::user()->id)->where('read_status', 0)->count();
        return $data = array('status' => 'success', 'message' => 'Data Loaded Successfully', 'data' => $messages, 'count' => $messageCount);
    }

    public function postSendMessage(Request $request)
    {
        $message = new chatBox();
        $message->from_user = Auth::user()->id;
        $message->to_user = $request->to_user;
        $message->content = $request->message;
        $message->save();
        return $data = array('status' => 'success', 'message' => 'Message sent successfully', 'data' => $message);
    }
    public function markRead(Request $request)
    {
        // dd($request->id);
        // chatBox::where('id', $request->id)
        //     ->update([
        //         'read_status' => 1,
        //     ]);
        DB::table('chat_boxes')
            ->where('id', $request->id)
            ->update(['read_status' => "1"]);

        return $data = array('status' => 'success', 'message' => 'Message marked as read');
    }
}
