@extends('layouts.2-columns')

@section('title', 'Questions/réponses pour les promotions Simplon')

{{-- Search form section --}}
@section('search-form')
    @include('partials/search')
@endsection

@section('styles')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">

@endsection

@section('content')

    <div class="tabs-warp question-tab">
        
        {{-- <ul class="tabs">
            <li class="tab"><a href="#" class="current">Recent Questions</a></li>
            <li class="tab"><a href="#">Most Responses</a></li>
            <li class="tab"><a href="#">Recently Answered</a></li>
            <li class="tab"><a href="#">No answers</a></li>
        </ul> --}}
        {{-- <form action="filter">
            {{ csrf_field() }}
            <label>Sélection par fabrique Simplon</label>
            <select name="fabric_id" required >
                <option value="" disabled selected>Tous les Simplon </option>
                @foreach ( $fabrics as $fabric )
                    <option value="{{ $fabric->id }}">{{ $fabric->name }}</option>
                @endforeach
            </select>
        </form> --}}
        
        
        <div class="tabs">
            <li class="tab"><a class="current" href="#">Toutes les fabriques</a></li>
            @foreach ($fabrics as $fabric)
                <a type="" href="/filter/{{ $fabric->id }}">{{ $fabric->name }}</a>
            @endforeach
        </div>
        <div class="tab-inner-warp">
            <div class="tab-inner">
                @if($fabricId === 0)
                    @forelse($questions as $question)
                        @include("partials/question")
                    @empty
                        <p>Pas encore de questions</p>
                    @endforelse
                @else
                    @forelse($questions as $question)
                        @include("partials/question")
                    @empty
                        <p>Pas encore de questions</p>
                    @endforelse
                @endif
                {{--<a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>--}}
            </div>
        </div>
    </div><!-- End page-content -->

@endsection


{{-- Sidebar --}}
@section('sidebar')
    @include("partials/recent-questions")

    @parent
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js"></script>

<script>hljs.initHighlightingOnLoad();</script>
@endsection

