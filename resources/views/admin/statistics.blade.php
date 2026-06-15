@extends('layouts.app')

@section('title', 'Statistiques globales')
@section('header-title', '📊 Statistiques')

@section('content')
<div class="space-y-6">
    <!-- Cartes stats -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-xl shadow-sm p-5 text-center">
            <span class="material-symbols-outlined text-3xl text-blue-500">people</span>
            <p class="text-2xl font-bold">{{ $stats['total_users'] }}</p>
            <p class="text-sm text-gray-500">Utilisateurs</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 text-center">
            <span class="material-symbols-outlined text-3xl text-green-500">article</span>
            <p class="text-2xl font-bold">{{ $stats['total_articles'] }}</p>
            <p class="text-sm text-gray-500">Articles</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 text-center">
            <span class="material-symbols-outlined text-3xl text-purple-500">visibility</span>
            <p class="text-2xl font-bold">{{ number_format($stats['total_views']) }}</p>
            <p class="text-sm text-gray-500">Vues</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 text-center">
            <span class="material-symbols-outlined text-3xl text-orange-500">trending_up</span>
            <p class="text-2xl font-bold">{{ $stats['avg_seo_score'] }}</p>
            <p class="text-sm text-gray-500">Score SEO moyen</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 text-center">
            <span class="material-symbols-outlined text-3xl text-green-500">check_circle</span>
            <p class="text-2xl font-bold">{{ $stats['published_articles'] }}</p>
            <p class="text-sm text-gray-500">Publiés</p>
        </div>
    </div>
    
    <!-- Articles par ville -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-bold mb-4">📍 Articles par ville</h3>
        <div class="space-y-2">
            @foreach($articlesByCity as $city)
            <div class="flex justify-between items-center p-2 hover:bg-gray-50 rounded">
                <span>📍 {{ $city->address }}</span>
                <span class="font-semibold">{{ $city->count }} articles</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection