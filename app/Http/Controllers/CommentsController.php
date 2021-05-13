<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Models\comments as Comments;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        //  return $request->all();

        if (Auth::check()) {
            $validated = $request->validate([
                'video_id' => 'required',
                'body' => 'required|max:255'
            ]);

            $comment = new Comments();

            $comment->user_id = Auth::user()->id;
            $comment->video_id = $request->video_id;
            $comment->body = $request->body;

            if ($comment->save()) {
                return redirect()->route('show-video', $comment->video_id)->with('status', 'Su comentario se ha publicado correctamente!'); // back()->with('status', 'Su comentario se ha publicado correctamente!');
            }

        } else {
            return back()->with('status', 'Debes iniciar sesión para poder comentar!');
        }

    }

    // Eliminamos comentarios
    public function destroy($id)
    {
        if (Auth::check()) {
            $comment = Comments::find($id);
            $user_id = Auth::user()->id;

            if($user_id == $comment->user_id) {
                $comment->delete();
                return back()->with('status', 'Comentario elimiando correctamente!');
            }
        } else {
            return back()->with('status', 'Debes iniciar sesión para poder eliminar!');
        }
    }
}
