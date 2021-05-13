<div class="mt-2">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{route('comment')}}" method="post">
        @csrf
        <input type="hidden" name="video_id" value="{{ $videoId}}">
        <label for="body">Añadir comentario...</label>
        <textarea
        class="form-control"
        id="body"
        name="body"
        cols="1"
        rows="1"
        ></textarea>
       <div class="form-group mt-2">
        <button
        class="btn btn-sm btn-success"
        >Enviar</button>
       </div>
    </form>

    <div>
        <small>Total: <b>{{count($comment)}}</b></small>
        <ul class="list-group">
            @foreach ($comment as $comm )

                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div>
                                {{$comm->body}}
                            </div>

                            <div>
                                <small>Publicado: {{$comm->created_at->diffForHumans()}}</small>
                            </div>
                        </div>

                        <div>
                            @auth
                                @if (Auth::user()->id == $comm->user_id)
                                    <form action="{{ route('destroy', $comm->id )}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                        onclick="return confirm('¿Esta seguro de eliminar el cometario?')"
                                        class="btn btn-sm btn-dark"
                                        type="submit"

                                        ><i class="bi bi-trash"></i></button>
                                    </form>
                                @endif
                            @endauth

                        </div>
                    </div>
                </li>

            @endforeach
        </ul>

        <div class="d-flex">{{ $comment->links() }}</div>
    </div>

    {{-- Modal --}}


    {{-- Fin Modal --}}
</div>


