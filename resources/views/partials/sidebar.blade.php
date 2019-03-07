<div class="card mt-4 shadow-sm stats">
    <div class="card-body">
        <h5 class="card-title colorTextSimplon">Stats</h5>
        <hr>
        <p class="card-text text-center">
            <i class="far fa-question-circle"></i> 
            Questions ({{ isset($questionsCount) ? $questionsCount : \App\Question::count() }})
        </p>
        <p class="card-text text-center">
            <i class="far fa-comment "></i> 
            Réponses ({{ isset($answersCount) ? $answersCount : \App\Answer::count() }})
        </p>
    </div>
</div>

<!--
<div class="widget widget_tag_cloud">
    <h3 class="widget_title">Tags</h3>
    <a href="#">projects</a>
    <a href="#">Portfolio</a>
    <a href="#">Wordpress</a>
    <a href="#">Html</a>
    <a href="#">Css</a>
    <a href="#">jQuery</a>
    <a href="#">2code</a>
    <a href="#">vbegy</a>
</div>
!-->