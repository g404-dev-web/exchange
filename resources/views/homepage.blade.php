@extends('layouts.2-columns')

@section('title', 'Questions/réponses pour les promotions Simplon')

{{-- Search form section --}}
@section('search-form')
    @include('partials/search')
@endsection

@section('styles')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/solarized-light.min.css">

@endsection

@section('content')

        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link {{request('filter') == 0 ? 'active' : ''}}" href="/">Simplon</a>
            </li>
            @foreach ($fabrics as $fabric)
                <li class="nav-item">
                    <a class="nav-link {{request('filter') == $fabric->id ? 'active' : ''}}" href="/?filter={{ $fabric->id }}">{{ $fabric->name }}</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-inner-warp">
            <div class="tab-inner">
                @forelse($questions as $question)
                    @include("partials/question")
                @empty
                    <div class="card">
                        <div class="card-body">
                            Pas encore de questions posées.
                        </div>
                    </div>
                @endforelse
                {{--<a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>--}}
            </div>
        </div>


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

