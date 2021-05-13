<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\videos as Video;
Use App\Models\comments as Comments;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller
{
    public function channel($user_id)
    {

        $user = User::where('id', $user_id)->get();

        if($user) {
            $videos = Video::where('user_id', $user_id)->paginate(5);
            return view('channel.user', compact('videos', 'user'));
        }
    }
}
