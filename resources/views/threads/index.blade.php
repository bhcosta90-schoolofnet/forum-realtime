@extends('layouts.default')

@section('content')
    <div class='container'>
        <h3>{{ __('Most recents threads') }}</h3>
        <threads-component 
            title="{{ __('Threads') }}"
            thread="{{ __('Threads') }}"
            reply="{{ __('Reply') }}"
            open="{{ __('Open') }}"
        >
            @include('layouts.default.preloader')
        </threads-component>
    </div>
@endsection
@section('scripts')
    <script type='text/javascript' src="{{ asset(mix('js/threads.js')) }}"></script>
@endsection