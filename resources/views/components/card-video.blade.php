<div class="col-sm-12 col-md-3 mb-2">
    <div class="card p-2 shadow-lg">

        @if (Storage::disk('image')->has($video->image))
        <div
        class="img-card-video"
        style="background-image: url({{url('/image/'.$video->image)}});
        ">
        </div>
        @endif
        <span class="d-inline-block text-truncate p-2" style="max-width: 2000px;" title="{{$video->title}}">
            {{$video->title}}   <br/>
            Publicado: {{ $video->created_at->diffForHumans()}}
        </span>
        <div class="d-flex">
            @if (Auth::check() && Auth::user()->id == $video->user_id)
                <form action="{{route('destroy-video', $video->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" onclick="return confirm('Esta seguro de elimiar el video.')" class="btn btn-sm btn-light"><i class="bi bi-trash"></i></button>
                </form>
            @endif
            <a href="{{route('edit-video', $video->id)}}"class="btn btn-sm btn-light"><i class="bi bi-pen"></i></a>
            <a href="{{route('show-video', $video->id)}}" class="btn btn-sm btn-light"><i class="bi bi-play-btn"></i></a>
        </div>
    </div>
</div>
