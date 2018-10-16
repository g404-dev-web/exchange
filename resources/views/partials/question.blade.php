<article class="question single-question question-type-normal">
    <h2>
        <span class="color">{{ $question->title }}</span>
    </h2>
    <div class="question-author-date">
        Requête effectuée <em>{{ $question->created_at->diffForHumans() }}</em> par <span class="color">{{ $question->user->name }}</span>
    </div>
    <div class="question-inner">
        <div class="clearfix"></div>
        <div class="comment-vote">

            <ul class="question-vote">
                <li>
                    {!! Form::open(['action' => 'UpvoteController@store', 'method' => 'post']) !!}
                    {!! Form::hidden('question_id', $question->id) !!}
                    {!! Form::submit('+1', ['class' => 'question-vote-up', "disabled" => in_array($question->id, $userQuestionPreviousVotes)]) !!}
                    {!! Form::close() !!}
                </li>
                <!--<li><a href="#" class="question-vote-down" title="Dislike"></a></li>!-->
            </ul>

            <div class="question-vote-result">
                {{count($question->upvotes)}}
            </div>
        </div>
        <div class="question-desc">
            {!! nl2br($question->description) !!}
        </div>
        <!--<div class="question-details">
            <span class="question-answered question-answered-done"><i class="icon-ok"></i>Résolu</span>
        </div>
        -->
        <span class="question-comment"><a href="#commentlist"><i class="icon-comment"></i>{{ $nbrAnswers }} Réponse(s)</a></span>
        <!--<span class="question-view"><i class="icon-user"></i>70 views</span>!-->
        <div class="question-tags"><i class="icon-tags"></i>
            <a href="#!">{{ $question->category }}</a>
        </div>
        <div class="clearfix"></div>
    </div>
</article>
