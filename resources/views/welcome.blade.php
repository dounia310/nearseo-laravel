<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEARSEO - Accueil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</head>
<body class="font-['Inter']">
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto px-4 py-16 text-center">
            <h1 class="text-5xl font-bold text-amber-800 mb-4">NEARSEO</h1>
            <p class="text-xl text-gray-600 mb-8">Le SEO local propulsé par l'IA</p>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="inline-block bg-amber-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-amber-700">Connexion</a>
                <a href="{{ route('register') }}" class="inline-block bg-gray-200 text-gray-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300">Inscription</a>
            </div>
        </div>
    </div>
</body>
</html>