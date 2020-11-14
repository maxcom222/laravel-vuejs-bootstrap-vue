@php
    $config = [
        'appName' => "Laravel7 vue vue-router bootstrap",
        'locale' => "en",
        'locales' => ['en' => 'EN']
    ];
@endphp
    <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">
</head>
<body>
<div id="app"></div>

{{-- Global configuration object --}}
<script>
    window.config = @json($config);
</script>

{{-- Load the application scripts --}}
<script src="{{ mix('dist/js/app.js') }}"></script>
</body>
</html>
