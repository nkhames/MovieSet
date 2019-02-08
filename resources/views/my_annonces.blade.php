@extends('layouts.app')
@section('content')
@push('main_class')
bg-dark
@endpush
<div class="pb-2 pt-4 mb-3 border-bottom text-center bg-danger ">
    <h2>Vos annonces !</h2>
    <h4> gérer vos annonces, modfications, suppressions et disponbilités </h4>
</div>
@php ($i = 0)


@if(!empty($annonces))
@foreach($annonces as $annonce)
@php ($i ++)
@php ($src =$annonce->path_to_dir.'\\photo_0.png')
@if ($i == 1)<div class="row mt-3 justify-content-center ">
@endif

<div class="card col-3 px-0 text-center mx-4 mb-2">
    <div class="card-header">
        {{ $annonce->nom}}
    </div>
    <img src="{{$src }}" class="img-fluid" alt="photo">
    <div class="card-body">
    Prix = {{ $annonce->prix }} € / unit.
    </div>
    <div class="card-footer">
    <a href=" {{ route('modifier', $annonce->id) }}" class="btn btn-primary btn-sm">modifier</a>
    <a href=" {{ route('delete', $annonce->id) }}" class="btn btn-danger btn-sm">supprimer</a>
    <a href="" class="btn btn-warning btn-sm">disponbilités</a>
    </div>
</div>
    @if ($i == 3)
    </div class>
    @php ($i = 0)
    @endif
@endforeach
@else
 <h1 class="text-muted"> Vous n'avez pas encore proposer d'annonces !</h4>
@endif

@endsection