@extends('layouts.default')

@section('content')
    <div class='container'>
        <h3>{{ __('Most recents threads') }}</h3>
        <threads-component 
            title="{{ __('Threads') }}"
            thread="{{ __('Threads') }}"
            reply="{{ __('Reply') }}"
            open="{{ __('Open') }}"
            new_thread="{{ __('New thread') }}"
            thread_title="{{ __('Title') }}"
            thread_body="{{ __('Body') }}"
            send="{{ __('Send') }}"
            fixed="{{ __('Fixed') }}"
            closed="{{ __('Closed Thread') }}"
            reopen="{{ __('Reopen Thread') }}"
        >
            @include('layouts.default.preloader')
        </threads-component>
    </div>
@endsection
@section('scripts')
    <script type='text/javascript' src="{{ asset(mix('js/threads.js')) }}"></script>
@endsection