<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title inertia>{{ 'BTH.SU' }}</title>
    @routes
    @vite('resources/js/app.js')
    @stack('styles')
    @inertiaHead
</head>
<body>
@inertia
@stack('vendors')
@stack('scripts')
</body>
</html>
