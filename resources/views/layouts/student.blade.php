<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

    {{--    <title>{{ config('app.name', 'pluggamatte.se') }}</title>--}}

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    {{-- TODO: add 32x32, 16x16 and .ico favicon --}}
    <link rel="icon" type="image/png" sizes="64x64" href="/favicon.png"/>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>
<body>
<div id="app"></div>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<script>
    @php
        use App\Services\LearnValidationService;use Illuminate\Support\Js;

        $validationRegex = app()->get(LearnValidationService::class)->regex;
    @endphp
        window.VUE_DATA = {
        locale: {{ Js::from(App::getLocale()) }},
        theme: {{ Js::from(optional(Auth::user()->details)->theme ?? 'classic') }},
        user: {{ Js::from(Auth::user()) }},
        selectedClass: {{ Js::from( app('student_class') ) }},
        classes: {{  Js::from( Auth::user()->class_info->pluck('class') ) }},
        message: {{ Js::from($message ?? null) }},
        error: {{ Js::from($error ?? null) }},
        validators: {{ Js::from( $validationRegex ) }}
    }
</script>
</body>
</html>
