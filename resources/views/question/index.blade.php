@extends('layouts.2-columns')

@section('title', 'Poser une question')

{{-- Search form section --}}
@section('search-form')
    @include('partials/search')
@endsection


@section('content')
    @foreach($questions as $question)
        <article class="question question-type-normal">
            <h2>
                <a href="{{ route('questions.show', ['id' => $question->id]) }}">{{ $question->title }}</a>
            </h2>
            <div class="question-author-date">
                Requête posée <em>{{ $question->created_at->diffForHumans() }}</em> par <span class="color">{{ $question->user->name }}</span>
            </div>
            <div class="question-inner">
                <div class="clearfix"></div>
                <p class="question-desc">{{ $question->description }}</p>
                {{--<div class="question-details">--}}
                    {{--<span class="question-answered question-answered-done"><i class="icon-ok"></i>solved</span>--}}
                {{--</div>--}}
                <span class="question-comment"><a href="{{ route('questions.show', ['id' => $question->id]) }}"><i class="icon-comment"></i>6 Réponse(s)</a></span>
                <!--<span class="question-view"><i class="icon-user"></i>70 views</span>!-->
                <div class="question-tags"><i class="icon-tags"></i>
                    <a href="#!">{{ $question->category }}</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </article>
    @endforeach

    {{--<a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>--}}

    {{-- Sidebar --}}
    @section('sidebar')
        @parent
    @endsection

@endsection