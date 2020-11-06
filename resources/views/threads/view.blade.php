@extends('layouts.default')

@section('content')
    <div class='container'>
        <h3>{{ $results->title }}</h3>
        <div class="card grey lighten-4">
            <div class="card-content">{{ $results->body }}</div>
            <div class="card-action">
                @can('update', $results)
                <a href="/threads/{{$results->id}}/edit">{{ __('Edit') }}</a>
                @endif
                <a href="/">{{ __('Back') }}</a>
            </div>
        </div>

        <reply-component
            replied="{{ __('replied') }}"
            reply="{{ __('Reply') }}"
            your-answer="{{ __('Your answer') }}"
            send="{{ __('Send') }}"
            thread-id="{{ $results->id  }}"
            is-closed="{{ $results->closed_at  }}"
            fixed="{{ __("Fixed Reply") }}"
        >
            @include('layouts.default.preloader')
        </reply-component>
    </div>
@endsection
@section('scripts')
    <script type='text/javascript' src="{{ asset(mix('js/replies.js')) }}"></script>
@endsection