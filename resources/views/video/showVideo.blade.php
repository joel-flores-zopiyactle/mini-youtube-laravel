@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" >
            <div class="col-7">
                <h1>{{$video->title}}</h1>

                <div>
                    <video controls>
                        <source src="{{url('/video/'.$video->video_path)}}" type="video/mp4">
                    </video>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Subido por: <a class="text-decoration-line-through" href="{{route('channel', $video->user_id)}}">{{ $video->user->name }}</a> {{ $video->created_at->diffForHumans()}}
                        </h5>
                        {{ $video->description}}
                    </div>
                </div>


                {{-- {{$comments}} --}}
            </div>

            <div class="col-5">
                <x-comments :videoId="$video->id" :comment="$comments"></x-comments>
            </div>
        </div>
    </div>
@endsection
