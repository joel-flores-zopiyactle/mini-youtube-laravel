<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;
//use Illuminate\Support\Facades\Response;

use App\Models\videos as Video;
Use App\Models\comments as Comments;
use Illuminate\Support\Facades\Auth;
class VideoController extends Controller
{
    public function index()
    {
        return view('video.index');
    }

    public function saveVideo(Request $request)
    {

        //return $request->all();

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'image' => 'mimes:jpg,bmp,png',
            'video_path' => 'mimetypes:video/avi,video/mp4'
        ]);


        $video = new Video;

        $video->user_id = Auth::user()->id;
        $video->title = $request->title;
        $video->description = $request->description;
        $video->status = 1;

        if($request->file('image')){
            $name_image = time().$request->file('image')->getClientOriginalName();

              //indicamos que queremos guardar un nuevo archivo en el disco local
            Storage::disk('image')->put($name_image,  File::get($request->file('image')));
            $video->image = $name_image; //time() asigna un time para el name archivo
        }

        if($request->file('video_path')){
            $name_video = time().$request->file('video_path')->getClientOriginalName();

              //indicamos que queremos guardar un nuevo archivo en el disco local
            Storage::disk('videos')->put($name_video,  File::get($request->file('video_path')));
            $video->video_path  = $name_video; //time() asigna un time para el name archivo
        }

        if ($video->save()) {
            return redirect('home')->with('status', 'Su videos se a subido correctamente!');
        }

    }


    public function imageShow($fileImage)
    {

        $image = Storage::disk('image')->get($fileImage);
        return response($image , 200);

        /*

        return Response($image);*/
    }

    public function showVideo($id_video)
    {
        $video = Video::find($id_video);
        $comments  = Comments::where('video_id', $id_video)->orderBy('id', 'desc')->paginate(30);
        return view('video.showVideo', compact('video', 'comments'));
    }

    public function getVideo($fileVideo)
    {
        $file = Storage::disk('videos')->get($fileVideo);
        return response($file, 200);
    }

    public function getVideoEdit($id_video)
    {
        $video = Video::find($id_video);
        return view('video.editVideo', compact('video'));
    }

    public function update(Request $request, $id_video)
    {
        //return $request->all();

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'image' => 'mimes:jpg,bmp,png',
            'video_path' => 'mimetypes:video/avi,video/mp4'
        ]);

        $video = Video::find($id_video);

        $video->title = $request->title;
        $video->description = $request->description;

        if($request->file('image')){
            //  Eliminamos file Images
            Storage::disk('image')->delete($video->image);

            // NUEVO IMAGE
            $name_image = time().$request->file('image')->getClientOriginalName();

              //indicamos que queremos guardar un nuevo archivo en el disco local
            Storage::disk('image')->put($name_image,  File::get($request->file('image')));
            $video->image = $name_image; //time() asigna un time para el name archivo
        }

        if($request->file('video_path')){
            //  Eliminamos file Video
            Storage::disk('videos')->delete($video->video_path);

            // NUEVO VIDEO
            $name_video = time().$request->file('video_path')->getClientOriginalName();

            //indicamos que queremos guardar un nuevo archivo en el disco local
            Storage::disk('videos')->put($name_video,  File::get($request->file('video_path')));
            $video->video_path  = $name_video; //time() asigna un time para el name archivo
        }

        if ($video->save()) {
            return back()->with('status', 'Video actualizado correctamente!');
        } else {
            return back()->with('status', 'Hubo un error al actualizar el video!');
        }


    }

    public function destroy($id_video)
    {
        $comments = Comments::all()->where('video_id', $id_video);
        $video = Video::find($id_video);

        if(Auth::check() && Auth::user()->id == $video->user_id) {
            foreach ($comments as $comment) {
                 $comment->delete();
            }

            //  Eliminamos file Images
            Storage::disk('image')->delete($video->image);

            //  Eliminamos file Video
            Storage::disk('videos')->delete($video->video_path);

            if($video->delete()) {
                return redirect('home')->with('status', 'Video removido correctamente!');
            } else {
                return redirect('home')->with('status', 'Fallo al remover el video. Intenta otra vez!');
            }
        } else {
            return redirect('home')->with('status', 'No tiene permiso para remover el video!');
        }

    }

    public function search(Request $request)
    {
        if(isset($request->filter) && $request->filter === "a-z") {
            $videos = Video::where('title', 'LIKE', "%".$request->search."%")->orderBy('title')->paginate(5);
        }
        if(isset($request->filter) && $request->filter === "old") {
            $videos = Video::where('title', 'LIKE', "%".$request->search."%")->orderBy('id', 'asc')->paginate(5);
        }
        else {
            $videos = Video::where('title', 'LIKE', "%".$request->search."%")->orderBy('id', 'desc')->paginate(5);
        }
        $search = [
            "status" => true,
            "param" => $request->search
        ];

        return view('home', compact('videos', 'search'));
    }

    /* public function filterDesc(Request $request)
    {
        $videos = Video::where('title', 'LIKE', "%".$request->search."%")->order->paginate(5);
        $search = [
            "status" => true,
            "param" => $request->search
        ];

        return view('home', compact('videos', 'search'));
    } */
}
