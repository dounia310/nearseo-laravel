{{-- resources/views/blog/user-profile.blade.php --}}
@extends('layouts.blog')

@section('title', $user->name . ' - Profil')
@section('blog-title', $user->name)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Profil Header -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="bg-gradient-to-r from-primary/10 to-secondary/10 dark:from-primary/20 dark:to-secondary/20 px-8 py-12 text-center">
            <!-- Avatar -->
            <div class="w-32 h-32 rounded-full mx-auto mb-4 bg-white dark:bg-gray-800 shadow-lg flex items-center justify-center border-4 border-white dark:border-gray-800">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full rounded-full object-cover">
                @else
                    <span class="material-symbols-outlined text-6xl text-primary">person</span>
                @endif
            </div>
            
            <!-- Nom et bio -->
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">{{ $user->bio ?? 'Auteur sur NEARSEO' }}</p>
            
            <!-- Statistiques -->
            <div class="flex flex-wrap justify-center gap-6 mt-4 text-sm text-gray-500 dark:text-gray-400">
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">article</span>
                    {{ $user->articles()->where('status', 'published')->count() }} articles
                </span>
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">calendar_month</span>
                    Inscrit en {{ $user->created_at->format('F Y') }}
                </span>
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">visibility</span>
                    {{ number_format($user->articles()->where('status', 'published')->sum('views')) }} vues
                </span>
                @auth
                    @if(Auth::id() === $user->id)
                        <a href="{{ route('profile.edit') }}" 
                           class="flex items-center gap-1 text-primary hover:text-primary/80 transition">
                            <span class="material-symbols-outlined text-sm">edit</span>
                            Modifier
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Contenu -->
        <div class="p-8">
            @if($user->bio)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">À propos</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ $user->bio }}</p>
                </div>
            @endif

            <!-- Derniers articles -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Derniers articles
                    @if($articles instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                        <span class="ml-2 text-sm font-normal text-gray-500 dark:text-gray-400">
                            ({{ $articles->total() }})
                        </span>
                    @else
                        <span class="ml-2 text-sm font-normal text-gray-500 dark:text-gray-400">
                            ({{ $articles->count() }})
                        </span>
                    @endif
                </h3>
                
                @if($articles->count() > 0)
                    <div class="space-y-4">
                        @foreach($articles as $article)
                            <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition group">
                                <!-- Image miniature -->
                                <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-primary/10 dark:bg-primary/20 flex items-center justify-center">
                                    @if($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="material-symbols-outlined text-2xl text-primary/40 dark:text-primary/60">article</span>
                                    @endif
                                </div>
                                
                                <!-- Infos article -->
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('blog.user.article', [$user->slug, $article->slug]) }}" 
                                       class="font-semibold text-gray-900 dark:text-white group-hover:text-primary transition">
                                        {{ $article->title }}
                                    </a>
                                    <div class="flex items-center flex-wrap gap-3 text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        <span>{{ $article->created_at->format('d/m/Y') }}</span>
                                        <span>•</span>
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs">visibility</span>
                                            {{ $article->views ?? 0 }} vues
                                        </span>
                                        @if($article->seo_score)
                                            <span>•</span>
                                            <span class="flex items-center gap-1">
                                                <span class="material-symbols-outlined text-xs">trending_up</span>
                                                <span class="{{ $article->seo_score >= 70 ? 'text-green-600 dark:text-green-400' : ($article->seo_score >= 50 ? 'text-yellow-600 dark:text-yellow-400' : 'text-red-600 dark:text-red-400') }}">
                                                    {{ $article->seo_score }}%
                                                </span>
                                            </span>
                                        @endif
                                        @if($article->status === 'published')
                                            <span class="px-2 py-0.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-xs">
                                                Publié
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <a href="{{ route('blog.user.article', [$user->slug, $article->slug]) }}" 
                                   class="text-primary hover:text-primary/80 text-sm font-medium flex items-center gap-1">
                                    Lire
                                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    @if($articles instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                        <div class="mt-6">
                            {{ $articles->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-8">
                        <span class="material-symbols-outlined text-4xl text-gray-300 dark:text-gray-600">article</span>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">Aucun article publié</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection