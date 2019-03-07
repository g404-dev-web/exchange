<div class="card activite-recent shadow-sm">
    <div class="card-body">
        <h5 class="card-title colorTextSimplon">Activité récente</h5>
        @forelse($recentQuestions as $recentQuestion)
            <hr>
            <h6 class="card-subtitle mt-3 mb-2">
                <a href="{{ route('questions.show', ['id' => $recentQuestion->id]) }}">{{ $recentQuestion->title }}</a>
            </h6>
            <p class="card-text text-muted">{{ str_limit(strip_tags($recentQuestion->description), 120) }}</p>
            <p class="card-text"><small class="text-muted">{{ $recentQuestion->created_at }}</small></p>
            
        @empty
            <p>Pas de questions posés.</p>
        @endforelse
    </div>
</div>