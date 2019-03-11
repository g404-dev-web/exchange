@extends('layouts.2-columns')

@section('title', 'Mes questions')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">
@endsection


@section('content')
    @forelse($questions as $question)
        @include("partials/question")
    @empty
        <div class="card">
            <div class="card-body">
                <p class="mt-3"> Vous n'avez pas encore posé de questions </p>
            </div>
        </div>

    @endforelse
@endsection

{{--<a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>--}}

{{-- Sidebar --}}
@section('sidebar')
    @parent
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endsection
