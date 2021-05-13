@extends('layouts.app')


@section('content')
    <div class="w-50 mx-auto">
        <div class="row">
            <div class="col-12">
                <h2>Subir Videos</h2>

                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <form action="{{route('upload')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Titulo</label>
                        <input type="text" name="title" id="title"
                        placeholder="Titulo"
                        class="form-control"
                        value="{{ old('title') }}"
                        >
                    </div>

                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <textarea name="description"
                        id="description"
                        cols="30"
                        rows="2"
                        class="form-control"
                        >{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Subir caratula</label>
                        <input name="image"
                        class="form-control"
                        type="file"
                        id="image">
                    </div>

                    <div class="form-group">
                        <label for="video_path" class="form-label">Subir video</label>
                        <input type="file" name="video_path"
                        id="video_path" class="form-control">
                    </div>

                    <div>
                        <button type="submit"
                        class="btn btn-dark btn-sm">Subír</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
