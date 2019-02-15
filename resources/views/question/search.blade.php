@extends('layouts.fullwidth')

@section('content')


    @if($questions->count() > 0)
        <h1>Les résulats de votre recherche : </h1>

        @foreach($questions as $question)
            @include("partials/question")
        @endforeach
    @else
        <h2> Aucun résultats ne correspond à votre recherche.</h2>
    @endif
    
@endsection

