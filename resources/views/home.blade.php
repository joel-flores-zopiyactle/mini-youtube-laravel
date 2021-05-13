@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Filtros de busqueda --}}
    @if (isset($search) && $search['status'])
        <div class="d-flex justify-content-between">
            <div>
                <p>Resulatdos de su busqueda: <strong>{{$search['param']}}</strong>
                <br/>Total:<b>{{count($videos)}}</b></p>
            </div>

            <div>
                <form action="{{route('search')}}" method="get">
                    <div class="d-flex">
                        <input type="hidden" name="search" value="{{$search['param']}}">
                        <select name="filter" id="filter" class="form-control">
                            <optgroup>
                                <option selected>Seleccione un filtro de busqueda</option>
                                <option value="nuevos">Ver los últimos agregados</option>
                                <option value="old">Ver lo más antiguas</option>
                                <option value="a-z">ver en order de a-z</option>
                            </optgroup>
                        </select>

                        <button class="btn btn-sm btn-dark">Filtrar</button>
                    </div>
                </form>
            </div>
        </div>
    @endif


    {{-- Notification of upload video succesfull --}}
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {{-- Lista de videos --}}
    <div class="row mb-4">
        @foreach ($videos as $video)
            <x-card-video  :video="$video"></x-card-video>
        @endforeach
    </div>

    <div class="d-flex">{{ $videos->links() }}</div>
</div>
@endsection
