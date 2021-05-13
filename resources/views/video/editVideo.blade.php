@extends('layouts.app')

@section('content')
    <div class="w-50 mx-auto" >
        <h4>Editar datos del video</h4>

        <div>
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <form action="{{route('update', $video->id)}}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" name="title" id="title"
                placeholder="Titulo"
                class="form-control"
                value="{{ $video->title }}"
                >
            </div>

            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea name="description"
                id="description"
                cols="30"
                rows="2"
                class="form-control"
                >{{ $video->description }}</textarea>
            </div>

            <div class="form-group">
                @if (Storage::disk('image')->has($video->image))
                    <img src="{{url('/image/'.$video->image)}}" alt="{{$video->title}}" width="200px"><br/>
                @endif
                <label for="image mt-2">Cambiar caratula:</label>
                <input type="file" name="image" id="image"
                class="form-control">
            </div>

            <div class="form-group">
                <video controls width="250px">
                    <source src="{{url('/video/'.$video->video_path)}}" type="video/mp4">
                </video>
                <br/>
                <label for="video_path mt-2">Cambia video:</label>
                <input type="file" name="video_path"
                id="video_path" class="form-control">
            </div>

            <div>
                <button type="submit"
                class="btn btn-dark btn-sm">Actualizar datos</button>
            </div>
        </form>
        </div>
    </div>
@endsection
