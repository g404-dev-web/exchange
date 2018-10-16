@extends('layouts.2-columns')

@section('title', 'Questions/réponses pour les promotions Simplon')

{{-- Search form section --}}
@section('search-form')
    @include('partials/search')
@endsection

@section('content')

    <div class="tabs-warp question-tab">
        <!--
        <ul class="tabs">
            <li class="tab"><a href="#" class="current">Recent Questions</a></li>
            <li class="tab"><a href="#">Most Responses</a></li>
            <li class="tab"><a href="#">Recently Answered</a></li>
            <li class="tab"><a href="#">No answers</a></li>
        </ul>
        !-->
        <div class="tab-inner-warp">
            <div class="tab-inner">
                @forelse($questions as $question)
                    <article class="question question-type-normal">
                        <h2>
                            <a href="{{ route('questions.show', ['id' => $question->id]) }}">{{ $question->title }}</a>
                        </h2>
                        <div class="question-author-date">
                            Requête posée <em>{{ $question->created_at }}</em> par <span class="color">{{ $question->user->name }}</span>
                        </div>
                        <div class="question-inner">
                            <div class="clearfix"></div>
                            <p class="question-desc">{{ $question->description }}</p>
                            {{--<div class="question-details">--}}
                                {{--<span class="question-answered question-answered-done"><i class="icon-ok"></i>solved</span>--}}
                            {{--</div>--}}
                            <span class="question-comment"><a href="{{ route('questions.show', ['id' => $question->id]) }}"><i class="icon-comment"></i>{{-- $nbrAnswersFromQuestion --}} Answer</a></span>
                            <span class="question-view"><i class="icon-user"></i>70 views</span>
                            <div class="question-tags"><i class="icon-tags"></i>
                                <a href="#!">{{ $question->category }}</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </article>
                @empty
                    <p>Pas encore de questions</p>
                @endforelse
                {{--<a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>--}}
            </div>
        </div>
    </div><!-- End page-content -->

    {{-- Sidebar --}}
    @section('sidebar')
        <div class="widget">
            <h3 class="widget_title">Recent Questions</h3>
            <ul class="related-posts">
                @forelse($recentQuestions as $recentQuestion)
                    <li class="related-item">
                        <h3><a href="{{ route('questions.show', ['id' => $recentQuestion->id]) }}">{{ $recentQuestion->title }}</a></h3>
                        <p>{{ str_limit($recentQuestion->description, 120) }}</p>
                        <div class="clear"></div><span>{{ $recentQuestion->created_at }}</span>
                    </li>
                @empty
                    <p>No questions at this moment</p>
                @endforelse
            </ul>
        </div>

        @parent
    @endsection

@endsection