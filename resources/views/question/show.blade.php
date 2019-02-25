@extends('layouts.2-columns')

@section('title', 'Poser une question')

{{-- Search form section --}}
@section('search-form')
    <div class="clearfix"></div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection

@section('content')
    @include("partials/question")
    <div class="post-next-prev clearfix">
        <p class="prev-post">
            <a href="{{ url('questions/'.$previousQuestionId) }}"><i class="icon-double-angle-left"></i>&nbsp;Question
                Précédente</a>
        </p>
        <p class="next-post">
            <a href="{{ url('questions/'.$nextQuestionId) }}">Question Suivante&nbsp;<i
                        class="icon-double-angle-right"></i></a>
        </p>
    </div><!-- End post-next-prev -->

    <div id="commentlist" class="page-content">
        <div class="boxedtitle page-title"><h2>Réponses ( <span class="color">{{ $nbrAnswers }}</span> )</h2></div>
        <ol class="commentlist clearfix">
            @forelse($answers as $answer)
                <li class="comment" id="comment-{{$answer->id}}">
                    <div class="comment-body comment-body-answered clearfix">
                       
                        @if(Auth::check() && Auth::user()->is_admin == 1 && Auth::user()->fabric_id == $question->user->fabric_id)
                        <form method="POST" action=" {{route('deleteAnswer')}} ">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$answer->id}}" name="answerId">
                            <button type="submit" onclick="return confirm('Confirmer la suppression ?')" class="button question-report delete-button ">Supprimer</button>
                        </form>
                        @endif

                        <div class="comment-text">
                            <div class="author clearfix">
                                <div class="comment-author">
                                    <span class="color">{{ $answer->user->name }} </span>
                                    <span class="karma">Karma : {{ $answer->user->points }}</span>
                                </div>
                                <div class="comment-vote">

                                    <ul class="question-vote">
                                        @if($currentUser && $question->user_id === $currentUser->id && !$hasSelectedAnswer)
                                            <li class="select-answer">

                                                {!! Form::open(['action' => 'UpvoteController@select', 'method' => 'post']) !!}
                                                {!! Form::hidden('answer_id', $answer->id) !!}
                                                {!! Form::submit('✔️', ['class' => 'question-vote-up']) !!}
                                                {!! Form::close() !!}
                                            </li>
                                        @elseif($answer->is_selected)
                                            <li class="is-selected-answer">
                                                <span>✔</span>
                                            </li>
                                        @endif


                                        @if(in_array($answer->id, $userAnswerPreviousVotes))
                                            <li>
                                                <input type="submit" value="▲"
                                                       class="question-vote-up tooltip-n"
                                                       title='Vous avez déjà upvoté cette réponse'>
                                            </li>
                                        @else
                                            <li>
                                                {!! Form::open(['action' => 'UpvoteController@store', 'method' => 'post']) !!}
                                                {!! Form::hidden('answer_id', $answer->id) !!}
                                                {!! Form::submit('▲', [
                                                    'class' => 'question-vote-up',
                                                ]) !!}
                                                {!! Form::close() !!}
                                            </li>
                                    @endif
                                    <!--<li><a href="#" class="question-vote-down" title="Dislike"></a></li>!-->
                                    </ul>

                                    <div class="question-vote-result">
                                        {{count($answer->upvotes)}}
                                    </div>
                                </div>
                                {{--<a class="comment-reply" href="#"><i class="icon-reply"></i>Reply</a>--}}
                            </div>
                            <div class="comment-meta">
                                <a href="#comment-{{$answer->id}}" style="float: right;font-size: 12px;position: relative;top: 5px;margin-left: 10px;">🔗</a>
                                <div class="date"><i class="icon-time"></i>{{ $answer->created_at }}</div>
                            </div>

                            <div class="text"><p>{!! strip_tags($answer->description, '<a><b><blockquote><code><del><dd><dl><dt><em><h1><h2><h3><i><kbd><li><ol><p><pre><s><sup><sub><strong><strike><ul><br><hr>')!!}</p>
                            </div>
                            {{--<div class="question-answered question-answered-done"><i class="icon-ok"></i>Best Answer</div>--}}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </li>
            @empty
                <p class="text-center">Il n'y a pas encore de réponse</p>
            @endforelse
        </ol><!-- End commentlist -->
    </div><!-- End page-content -->

    @if (Auth::check() && Auth::user()->is_admin == 1 )
        <div id="lock-button" class="page-content clearfix">
            {!! Form::open(['action' => 'AdminController@lockQuestion', 'method' => 'post']) !!}
            {!! Form::hidden('question_id', $question->id) !!}
            {!! Form::submit('Fermer cette question', ['id' => 'submit', 'class' => 'button color small']) !!}
        </div>
    @endif

    @if ($question->is_locked)
        <div class="comment-respond page-content clearfix">
            <p> Cette question est fermé</p>
        </div>
    @elseif (Auth::check())
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div id="respond" class="comment-respond page-content clearfix">
            <div class="boxedtitle page-title"><h2>Répondre</h2></div>
            {!! Form::open(['action' => 'AnswerController@store', 'method' => 'post']) !!}
            {!! Form::hidden('question_id', $question->id) !!}
            <div id="respond-textarea">
                <p>
                    <label class="required" for="description">Votre réponse<span>*</span></label>
                    {!! Form::textarea('description', null, [
                        'id'      => 'description',
                        'cols'    => 58,
                        'rows'    => 8
                    ]) !!}
                    @if ($errors->has('description'))
                        <span class="color form-description">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </p>
            </div>
            <p class="form-submit">
                {!! Form::submit('Postez votre Réponse', ['id' => 'submit', 'class' => 'button color small']) !!}
            </p>
            {!! Form::close() !!}
        </div>
    @else
        <a class="button color large" href="{{route('login')}}">Connectez vous pour répondre</a>
    @endif
@endsection

{{-- Sidebar --}}
@section('sidebar')
    <div class="widget">
        <h3 class="widget_title">Related Questions</h3>
        <ul class="related-posts">
            @foreach($relatedQuestions as $relatedQuestion)
                <li class="related-item"><h3><a href="/questions/{{$relatedQuestion->id}}"><i
                                    class="icon-double-angle-right"></i>{{ $relatedQuestion->title }}</a></h3></li>
            @endforeach
        </ul>
    </div>

    @parent
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>

    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
        var simplemde = new SimpleMDE({
            renderingConfig: {
                singleLineBreaks: true,
                codeSyntaxHighlighting: true,
            },
            showIcons: ["code", "table"]
        });
        let hash = location.hash;
        if(hash !== "" && hash !== "#") {
            let comment = document.querySelector(hash);

            if(comment) {
                comment.style.backgroundColor = "#ffffb3";
            }
        }
    </script>
@endsection
