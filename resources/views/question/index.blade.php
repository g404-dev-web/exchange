@extends('layouts.2-columns')

@section('title', 'Poser une question')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">
@endsection


@section('content')

    @foreach($questions as $question)
        @include("partials/question")
    @endforeach

@endsection

{{--<a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>--}}

{{-- Sidebar --}}
@section('sidebar')
    @include("partials/recent-questions")
    @parent
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endsection
