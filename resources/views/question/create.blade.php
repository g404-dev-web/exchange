@extends('layouts.fullwidth')

@section('title', 'Poser une question')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection

@section('content')

    <div class="page-content ask-question">
        <div class="boxedtitle page-title"><h2>Posez votre question</h2></div>

        <p>La précision et la rapidité de la réponse passe par une question correctement posée. Votre titre doit être explicite, votre question pas globale mais spécifique.</p>
        <p>Si vous faites face à un bug, copier le code nécessaire à la résolution.</p>

        {{-- <input type="text" name="title" value="{{ ($question) ? $question->title : 'test'}}"> --}}

        <div class="form-style form-style-3" id="question-submit">
            {!! Form::open(['action' => $question ? 'AdminController@updateQuestion' : 'QuestionController@store', 'method' => 'post']) !!}
                <div class="form-inputs clearfix">
                    <p>
                        <label class="required">Intitulé de la question<span>*</span></label>

                        {!! Form::text('title',
                                       ($question) ? $question->title : null
                                      ) !!}
                        @if ($errors->has('title'))
                            <span class="color form-description">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @else
                            <span class="form-description">Choisir un titre approprié et explicite est la première étape</span>
                        @endif
                    </p>
                    {{--<p>--}}
                        {{--<label>Tags</label>--}}
                        {{--<input type="text" class="input" name="question_tags" id="question_tags" data-seperator=",">--}}
                        {{--<span class="form-description">Please choose suitable Keywords .</span>--}}
                    {{--</p>--}}
                    <p>
                        <label class="required">Categorie<span>*</span></label>
                        {!! Form::select('category',[
                            'Back-end' => [
                                'php' => 'PHP',
                                'mysql' => 'MySQL',
                                'nodejs' => 'NodeJS',
                                'c#' => 'C#',
                                'python' => 'Python',
                                'ruby' => 'Ruby',
                                'other' => 'Other'
                            ],
                            'Front-end' => [
                                'html' => 'HTML',
                                'css' => 'CSS',
                                'sass' => 'SASS',
                                'js' => 'JS',
                                'other' => 'Other'
                            ],
                            'miscellaneous' => [
                                'agile' => 'Agile',
                                'sysadmin' => 'Admin',
                                'devops' => 'Dev Ops',
                                'other' => 'Other'
                            ],
                        ], $question ? $question->category : null, ['id' => 'question-category', 'placeholder' => ($question) ? $question->category : 'Choisissez une catégorie...']) !!}

                        @if ($errors->has('category'))
                            <span class="color form-description">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                        @else
                            <span class="form-description">Choisir de manière pertinente la catégorie, ne pas tout ranger dans other !</span>
                        @endif

                        @if ($question)
                            {!! Form::hidden('questionId', $question->id ) !!}
                        @endif
                    </p>

                    {{--<label>Attachment</label>--}}
                    {{--<div class="fileinputs">--}}
                        {{--<input type="file" class="file">--}}
                        {{--<div class="fakefile">--}}
                            {{--<button type="button" class="button small margin_0">Select file</button>--}}
                            {{--<span><i class="icon-arrow-up"></i>Browse</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                </div>
                <div id="form-textarea">
                    <p>
                        <label class="required">Details<span>*</span></label>
                        {{--<textarea id="question-details" name="description" aria-required="true" cols="58" rows="8"></textarea>--}}
                        {!! Form::textarea('description', ($question) ? $question->description : null, [
                            'id'      => 'question-details',
                            'cols'    => 58,
                            'rows'    => 8
                        ]) !!}
                        @if ($errors->has('description'))
                            <span class="color form-description">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @else
                            <span class="form-description">Ecrire la description de votre problème en entrant tous les détails possibles qui en permettront la résolutio</span>
                        @endif
                    </p>
                </div>
                <p class="form-submit">
                    {!! Form::submit('Publiez votre question!', ['id' => 'publish-question', 'class' => 'button color small submit']) !!}
                    {{--<input type="submit" id="publish-question" value="Publish Your Question" class="button color small submit">--}}
                </p>
            {!! Form::close() !!}
        </div>
    </div><!-- End page-content -->

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js"></script>

<script>hljs.initHighlightingOnLoad();</script>

<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script>
var simplemde = new SimpleMDE({
	renderingConfig: {
		codeSyntaxHighlighting: true,
	},
	showIcons: ["code", "table"]
});
</script>
@endsection
