<script type='text/javascript' src="{{ asset(mix('js/manifest.js')) }}"></script>
<script type='text/javascript' src="{{ asset(mix('js/vendor.js')) }}"></script>
<script type='text/javascript' src="{{ asset(mix('js/bootstrap.js')) }}"></script>

@if(\Auth::check())
    <script>
    window.user = {!! \Auth::user() !!};
    </script>
@endif

{{ $slot }}