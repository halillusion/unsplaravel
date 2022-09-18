<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nabla&display=swap" rel="stylesheet">
    <link href="{{ env('APP_ENV') === 'local' ? asset(mix('css/app.css')) : secure_asset(mix('css/app.css')) }}" rel="stylesheet">
    <script src="{{ env('APP_ENV') === 'local' ? asset(mix('js/manifest.js')) : secure_asset(mix('js/manifest.js')) }}" defer></script>
    <script src="{{ env('APP_ENV') === 'local' ? asset(mix('js/vendor.js')) : secure_asset(mix('js/vendor.js')) }}"></script>
    <script src="{{ env('APP_ENV') === 'local' ? asset(mix('js/app.js')) : secure_asset(mix('js/app.js')) }}"></script>
    @inertiaHead
</head>

<body>
    @inertia
</body>

</html>