@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Canal de: {{$user[0]->username}} </h3>

        <div>
            <h3>Lista de videos subidos.</h3>

            <div class="row mb-4">
                @foreach ($videos as $video)
                <x-card-video  :video="$video"></x-card-video>
                @endforeach
            </div>

            <div class="d-flex">{{ $videos->links() }}</div>
        </div>
    </div>
@endsection
