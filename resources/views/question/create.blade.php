@extends('layouts.fullwidth')

@section('title', 'Poser une question')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection

@section('content')

    <div class="card create-question mx-4">
        <div class="card-body">
            <h4 class="card-title colorTextSimplon">Posez votre question</h4>
            <hr>
            <p class="card-text my-4">La précision et la rapidité de la réponse passe par une question correctement posée. Votre titre doit être explicite, votre question pas globale mais spécifique.</p>
            <p class="card-text my-4">Si vous faites face à un bug, copiez le code nécessaire à la résolution.</p>

            {!! Form::open(['action' => $question ? 'AdminController@updateQuestion' : 'QuestionController@store', 'method' => 'post', 'id' => 'registerForm']) !!}

            <div class="form-group my-4">
                {{-- <label class="required">Intitulé de la question<span class="colorTextSimplon"> *</span></label> --}}
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text required" for="inputGroupSelect01">Intitulé de la question<span class="colorTextSimplon pl-2">*</span></label>
                    </div>
                    {!! Form::text('title', ($question) ? $question->title : null, ['class' => 'form-control', 'id' => 'inputGroupSelect01'] ) !!}
                </div>

                @if ($errors->has('title'))
                    <span class="color form-description">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @else
                    <div class="small mt-2 text-muted">Choisir un titre approprié et explicite est la première étape</div>
                @endif
            </div>
            <div class="form-group my-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text required" for="inputGroupSelect02">Catégories<span class="colorTextSimplon pl-2">*</span></label>
                    </div>
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
                            ], $question ? $question->category : null, ['id' => 'inputGroupSelect02', 'class' => 'custom-select', 'placeholder' => ($question) ? $question->category : 'Choisissez une catégorie...']) !!}
                </div>
                @if ($errors->has('category'))
                    <div class="color form-description">
                        <strong>{{ $errors->first('category') }}</strong>
                    </div>
                @else
                    <div class="small mt-2 text-muted">Choisir de manière pertinente la catégorie, ne pas tout ranger dans other !</div>
                @endif

                @if ($question)
                    {!! Form::hidden('questionId', $question->id ) !!}
                @endif
            </div>


            <div id="form-group">
                <label class="required">Details<span class="pl-2 colorTextSimplon">*</span></label>
                {{--<textarea id="question-details" name="description" aria-required="true" cols="58" rows="8"></textarea>--}}
                {!! Form::textarea('description', ($question) ? $question->description : null, [
                    'id'      => 'question-details',
                    'cols'    => 58,
                    'rows'    => 8
                ]) !!}
                @if($errors->has('description'))
                    <span class="color form-description">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @else
                    <div class="small text-center text-muted mb-4">Ecrire la description de votre problème en entrant tous les détails possibles qui en permettront la résolution.</div>
                @endif
            </div>

            <div class="form-control py-2">
                <div class="custom-control custom-checkbox">
                    <input autocomplete="off" class="custom-control-input " type="checkbox"  onclick="enableNotifications({type:'question'})" id="checkboxNotification">
                    <label class="custom-control-label " for="checkboxNotification">Voulez-vous recevoir des notifications quand une réponse est publiée ?</label>
                </div>
            </div>

            {!! Form::submit('Publiez votre question!', ['class' => 'my-3 btn btn-custom colorBackgroundSimplon col-12']) !!}

            {!! Form::close() !!}
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
		codeSyntaxHighlighting: true,
	},
    showIcons: ["code", "table"],
    // status: ["autosave", "lines", "words", "cursor", {
	// 	className: "characters",
	// 	defaultValue: function(el) {
	// 		el.innerHTML = "0";
	// 	},
	// 	onUpdate: function(el) {
	// 		el.innerHTML = simplemde.value().length;
	// 	}
    // }]
    status: [ {
                className: "chars",
                defaultValue: function(el) {
                    el.innerHTML = "0 / "+char_limit;
                },
                onUpdate: function(el) {
                    el.innerHTML = simplemde.value().length + " / "+char_limit;
                    limit_characters()
                }
            }]

});

function limit_characters() {
            character_count = simplemde.value().length

            if (character_count > char_limit) {
                $('#submitBtn').attr("disabled", true);
            } else {
                $('#submitBtn').attr("disabled", false);
            }
        }
</script>
@endsection
