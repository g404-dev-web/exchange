<article class="question single-question question-type-normal">
    {!!   $routeIsQuestionShow ? '':'<a href="/questions/'.$question->id.'">' !!}
        <h2>
            <span class="color">{{ $question->title }}</span>
        </h2>
    {!!  $routeIsQuestionShow ? '':'</a>' !!}
    <div class="question-author-date">
        <em>{{ $question->created_at->diffForHumans() }}</em> par <span class="color">{{ $question->user->name }}</span>
    </div>
    <div class="question-inner">
        <div class="clearfix"></div>
        <div class="comment-vote">
            <ul class="question-vote">

                @if(in_array($question->id, $userQuestionPreviousVotes))
                    <li>
                        <input type="submit" value="▲"
                               class="question-vote-up tooltip-n"
                               title='Vous avez déjà upvoté cette question'>
                    </li>
                @else
                    <li>
                        {!! Form::open(['action' => 'UpvoteController@store', 'method' => 'post']) !!}
                        {!! Form::hidden('question_id', $question->id) !!}
                        {!! Form::submit('▲', ['class' => 'question-vote-up']) !!}
                        {!! Form::close() !!}
                    </li>
                @endif
                <!--<li><a href="#" class="question-vote-down" title="Dislike"></a></li>!-->
            </ul>

            <div class="question-vote-result">
                {{count($question->upvotes)}}
            </div>
        </div>
        <div class="question-desc">
            {!! strip_tags($question->description, '<a><b><blockquote><code><del><dd><dl><dt><em><h1><h2><h3><i><kbd><li><ol><p><pre><s><sup><sub><strong><strike><ul><br><hr>') !!}
        </div>
        <!--<div class="question-details">
            <span class="question-answered question-answered-done"><i class="icon-ok"></i>Résolu</span>
        </div>
        -->
        <span class="question-comment"><a href="/questions/{{$question->id}}#commentlist"><i class="icon-comment"></i>{{ count($question->answers) }} Réponse(s)</a></span>
        <span class="question-view">👁 {{ $question->views }} vues</span>
        @if($question->hasSelectedAnswer)
            <span class="question-answered">✔️ Solution trouvée</span>
        @endif
        <!--<span class="question-view"><i class="icon-user"></i>70 views</span>!-->
        <div class="question-tags"><i class="icon-tags"></i>
            <a href="#!">{{ $question->category }}</a>
        </div>
        <div class="clearfix"></div>
    </div>
</article>
