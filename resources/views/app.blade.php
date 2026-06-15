<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEARSEO</title>

    <!-- Favicons (nécessaires aussi pour le shell React via app.blade.php) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    @viteReactRefresh
    @vite('resources/js/app.jsx')
</head>
<body>
    <div id="root"></div>
</body>
</html>