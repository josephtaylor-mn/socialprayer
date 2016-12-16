@extends('layouts.app')

@section('head')
<link href="/css/vendor/speech-input.css" rel="stylesheet">
@endsection

@section('content')
	<section class="prayers-section col-centered">

        @include('vendor/flash/message')
        @if (Auth::check() and $createPrayer)
            @include('prayers/create')
        @endif
        @if (isset($titleHeader))
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <h3>{{ $titleHeader }}</h3>
                </div>
            </div>
        @endif
        <div class="prayers">
            @foreach ($prayers as $prayer)
                @include('prayers/prayer')
            @endforeach
        </div>
    </section>
@endsection

@section('footer')
<script src="/js/vendor/jquery.ns-autogrow.js"></script>
<script src="/js/vendor/speech-input.js"></script>
@include('javascript/prayers/list')
@endsection