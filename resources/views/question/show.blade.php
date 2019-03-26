@extends('layouts.fullwidth')

@section('title', 'Poser une question')

{{-- Search form section --}}
@section('search-form')
    <div class="clearfix"></div>
@endsection

@section('styles')
    {{-- <!-- other link --> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/solarized-light.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection

@section('content')
    @include("partials/question")

    <div class="prev my-3">
        <a href="{{ url('questions/'.$previousQuestionId) }}" class="btn pl-0 colorTextSimplon">
            <i class="fas fa-angle-double-left"></i>&nbsp;Question Précédente
        </a>
    </div>
    <div class="next my-3">
        <a href="{{ url('questions/'.$nextQuestionId) }}" class="btn pr-0 colorTextSimplon">
            Question Suivante&nbsp;<i class="fas fa-angle-double-right"></i>
        </a>
    </div>

    <div class="clearfix"></div>

    <div class="card my-3">
        <div class="card-body">
            <h4 class="card-title colorTextSimplon">Réponses ({{ $nbrAnswers }})</h4>

            @forelse ($answers as $answer)
                <hr>
                <div>
                    @if(Auth::check() && Auth::user()->is_admin == 1 && Auth::user()->fabric_id == $question->user->fabric_id)
                        <form method="POST" action="{{ route('deleteAnswer') }}" class="btn-block-admin">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$answer->id}}" name="answerId">
                            <button class="btn btn-admin mb-2" type="submit" onclick="return confirm('Confirmer la suppression ?')" class="button question-report delete-button ">Supprimer</button>
                        </form>
                    @endif

                    <div class="clearfix"></div>

                    <div class="d-inline-flex flex-column">
                        <div class="font-weight-bold">{{ $answer->user->name }}</div>
                        <div class="text-muted mt-0 mb-1">Karma : {{ $answer->user->points }}</div>
                    </div>

                     <div class="date-answer"  >
                        <div class="text-muted">
                            <i class="far fa-clock"></i> {{ $answer->created_at }}<a href="#comment-{{$answer->id}}" > <i class="fas fa-link"></i></a>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="card-text d-inline-flex flex-column align-middle mb-2">
                        @if($currentUser && $question->user_id === $currentUser->id && !$hasSelectedAnswer)
                            <li class="list-unstyled ">
                                {!! Form::open(['action' => 'UpvoteController@select', 'method' => 'post']) !!}
                                {!! Form::hidden('answer_id', $answer->id) !!}
                                {!! Form::submit('', ['class' => 'my-1 fas fa-check']) !!}
                                {!! Form::close() !!}
                            </li>
                        @elseif($answer->is_selected)
                            <li class="list-unstyled">
                                <span><i class="my-1 fas fa-check"></i></span>
                            </li>
                        @endif

                        @if(in_array($answer->id, $userQuestionPreviousVotes))
                            <li class="list-unstyled my-1">
                                <input type="submit" value="▲"
                                       class=""
                                       title='Vous avez déjà upvoté cette réponse'>
                            </li>
                        @else
                            <li class="list-unstyled my-1">
                                {!! Form::open(['action' => 'UpvoteController@store', 'method' => 'post']) !!}
                                {!! Form::hidden('answer_id', $answer->id) !!}
                                {!! Form::submit('▲', ['class' => 'upvote']) !!}
                                {!! Form::close() !!}
                            </li>
                        @endif

                        <div class="text-center nbVotes">
                            {{ count($answer->upvotes) }}
                        </div>
                    </div>

                    <div class="card-text d-inline-block col-11 align-middle mt-2">
                        <p>{!! strip_tags($answer->description, '<a><b><blockquote><code><del><dd><dl><dt><em><h1><h2><h3><i><kbd><li><ol><p><pre><s><sup><sub><strong><strike><ul><br><hr>')!!}</p>
                    </div>
                </div>

            @empty
                <p class="mt-4">Il n'y a pas encore de réponse pour cette question.</p>
            @endforelse
        </div>
      </div>

    <div class="card">
        <div class="card-body">

            @if ($question->is_locked)
                <div class="mt-3">
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
                    <h4 class="colorTextSimplon">Répondre</h4>
                    {!! Form::open(['action' => 'AnswerController@store', 'method' => 'post']) !!}
                    {!! Form::hidden('question_id', $question->id) !!}
                    {!! Form::hidden('question_user_id', $question->user_id) !!}

                    <label class="required mt-3" for="description">Votre réponse<span class="colorTextSimplon"> *</span></label>
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
                    {!! Form::submit('Postez votre Réponse', ['id' => 'submit', 'class' => 'btn btn-custom btn-block colorBackgroundSimplon my-3']) !!}
                    {!! Form::close() !!}

            @else
                <a class="btn btn-custom colorBackgroundSimplon col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4" href="{{route('login')}}">Connectez vous pour répondre</a>
            @endif
        </div>
    </div>
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
