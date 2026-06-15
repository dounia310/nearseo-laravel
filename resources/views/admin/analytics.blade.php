{{-- resources/views/admin/analytics.blade.php --}}
@extends('layouts.app')

@section('title', 'Analytics - Admin')
@section('header-title', 'Tableau de bord analytics')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h1 class="text-2xl font-bold mb-6">📊 Analytics</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-primary/5 rounded-lg p-4 text-center">
                    <div class="text-3xl font-bold text-primary">{{ $stats['total_users'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500">Utilisateurs</div>
                </div>
                <div class="bg-primary/5 rounded-lg p-4 text-center">
                    <div class="text-3xl font-bold text-primary">{{ $stats['total_articles'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500">Articles</div>
                </div>
                <div class="bg-primary/5 rounded-lg p-4 text-center">
                    <div class="text-3xl font-bold text-primary">{{ number_format($stats['total_views'] ?? 0) }}</div>
                    <div class="text-sm text-gray-500">Vues totales</div>
                </div>
                <div class="bg-primary/5 rounded-lg p-4 text-center">
                    <div class="text-3xl font-bold text-primary">{{ $stats['avg_seo_score'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500">Score SEO moyen</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection