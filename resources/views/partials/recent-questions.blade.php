<div class="widget">
    <h3 class="widget_title">Activité récente</h3>
    <ul class="related-posts">
        @forelse($recentQuestions as $recentQuestion)
            <li class="related-item">
                <h3><a href="{{ route('questions.show', ['id' => $recentQuestion->id]) }}">{{ $recentQuestion->title }}</a></h3>
                <p>{{ str_limit(strip_tags($recentQuestion->description), 120) }}</p>
                <div class="clear"></div><span>{{ $recentQuestion->created_at }}</span>
            </li>
        @empty
            <p>No questions at this moment</p>
        @endforelse
    </ul>
</div>