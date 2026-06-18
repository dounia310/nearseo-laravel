{{-- resources/views/blog/show.blade.php --}}
@extends('layouts.blog')

@section('title', $article->title . ' | Wanderly')

@section('content')
<div class="flex flex-col lg:flex-row gap-12">
    <!-- Main Content -->
    <article class="lg:w-[70%] bg-surface-container-lowest p-card-padding rounded-xl shadow-sm border border-outline-variant">
        <!-- Back Button -->
        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-primary font-bold hover:opacity-70 transition-opacity mb-8 group">
            <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1">arrow_back</span>
            <span class="font-label text-label">Retour au blog</span>
        </a>

        <!-- Hero Image -->
        @if($article->image)
        <div class="relative w-full aspect-[21/9] rounded-xl overflow-hidden mb-section-margin">
            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
            <!-- Gradient overlay pour le texte -->
            <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/60 to-transparent">
                <h1 class="text-white text-2xl md:text-3xl font-bold">{{ $article->title }}</h1>
            </div>
        </div>
        @else
        <!-- Titre sans image -->
        <header class="mb-section-margin">
            <h1 class="font-h1 text-h1 mb-4">{{ $article->title }}</h1>
        </header>
        @endif

        <!-- Article Header -->
        <header class="mb-section-margin">
            @if(!$article->image)
            <h1 class="font-h1 text-h1 mb-4">{{ $article->title }}</h1>
            @endif
            
            <!-- Auteur et métadonnées -->
            <div class="flex items-center gap-4 text-on-surface-variant">
                <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary">person</span>
                </div>
                <div>
                    <p class="font-bold text-on-surface">{{ $article->user->name ?? 'Youssef Amrani' }}</p>
                    <div class="flex items-center gap-2 text-body-sm">
                        <span>{{ $article->created_at->format('d F Y') }}</span>
                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                        <span>{{ $article->read_time ?? 5 }} min de lecture</span>
                    </div>
                </div>
            </div>

            <!-- Tags / Mot-clé -->
            @if($article->focus_keyword)
            <div class="flex flex-wrap items-center gap-2 mt-4">
                <span class="text-xs font-medium text-gray-500 uppercase">Mot-clé :</span>
                <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-medium border border-primary/20">
                    #{{ $article->focus_keyword }}
                </span>
            </div>
            @endif
        </header>

        <!-- Article Body -->
        <div class="prose max-w-none text-on-surface-variant font-body">
            {!! $article->content !!}
        </div>

        <!-- Engagement Metrics -->
        <footer class="mt-section-margin pt-8 border-t border-outline-variant flex flex-wrap items-center justify-between gap-4">
            <div class="flex gap-6">
                <button class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors group">
                    <span class="material-symbols-outlined group-hover:text-red-500 transition-colors">favorite</span>
                    <span class="font-label">{{ number_format($article->likes ?? 0) }}</span>
                </button>
                <div class="flex items-center gap-2 text-on-surface-variant">
                    <span class="material-symbols-outlined">visibility</span>
                    <span class="font-label">{{ number_format($article->views ?? 0) }}</span>
                </div>
            </div>
            <div class="flex gap-3">
                <button onclick="shareArticle()" class="p-2 rounded-full border border-outline-variant hover:bg-surface-container transition-colors">
                    <span class="material-symbols-outlined">share</span>
                </button>
                <button onclick="bookmarkArticle({{ $article->id }})" class="p-2 rounded-full border border-outline-variant hover:bg-surface-container transition-colors">
                    <span class="material-symbols-outlined">bookmark</span>
                </button>
            </div>
        </footer>
    </article>

    <!-- Sidebar -->
    <aside class="lg:w-[30%] flex flex-col gap-stack-gap-md">
        <!-- Author Bio -->
        <div class="bg-surface-container-lowest p-card-padding rounded-xl shadow-sm border border-outline-variant">
            <div class="flex flex-col items-center text-center">
                <div class="w-24 h-24 rounded-full bg-primary/20 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-4xl text-primary">person</span>
                </div>
                <h3 class="font-h3 text-h3 text-on-surface mb-2">{{ $article->user->name ?? 'Youssef Amrani' }}</h3>
                <p class="text-body-sm text-on-surface-variant mb-6 italic">Guide de montagne certifié et photographe passionné.</p>
                <button class="w-full py-3 bg-primary text-on-primary rounded-lg font-bold hover:opacity-90 active:scale-95 transition-all">S'abonner</button>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="bg-surface-container-lowest p-card-padding rounded-xl shadow-sm border border-outline-variant">
            <div class="relative">
                <input class="w-full bg-background border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary rounded-lg pl-10 py-3 text-body-sm" 
                       placeholder="Rechercher un article..." type="text"/>
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
            </div>
        </div>

        <!-- Articles récents -->
        @if(isset($recentArticles) && $recentArticles->count() > 0)
        <div class="bg-surface-container-lowest p-card-padding rounded-xl shadow-sm border border-outline-variant">
            <h3 class="font-h3 text-h3 text-on-surface mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">recent_actors</span>
                Articles récents
            </h3>
            <div class="space-y-3">
                @foreach($recentArticles as $recent)
                <a href="{{ route('blog.show', $recent->slug) }}" 
                   class="block hover:bg-surface-container rounded-lg p-2 transition-colors group">
                    <p class="text-body-sm font-medium text-on-surface group-hover:text-primary transition-colors">
                        {{ $recent->title }}
                    </p>
                    <p class="text-body-sm text-on-surface-variant">{{ $recent->created_at->format('d/m/Y') }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Tags Populaires -->
        @if(isset($allTags) && $allTags->count() > 0)
        <div class="bg-surface-container-lowest p-card-padding rounded-xl shadow-sm border border-outline-variant">
            <h3 class="font-h3 text-h3 text-on-surface mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">sell</span>
                Tags populaires
            </h3>
            <div class="flex flex-wrap gap-2">
                @foreach($allTags as $tag => $count)
                <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-full text-label font-bold cursor-pointer hover:bg-primary hover:text-white transition-colors">
                    {{ $tag }}
                    <span class="text-xs opacity-60">({{ $count }})</span>
                </span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Newsletter -->
        <div class="bg-secondary p-card-padding rounded-xl shadow-sm border border-secondary text-white">
            <span class="material-symbols-outlined text-4xl mb-4">mail</span>
            <h3 class="font-h3 text-h3 mb-2">Restez inspiré</h3>
            <p class="text-body-sm opacity-90 mb-4">Recevez nos meilleurs récits de voyage directement dans votre boîte mail.</p>
            <div class="space-y-2">
                <input class="w-full bg-white/10 border-white/20 text-white placeholder:text-white/60 rounded-lg py-2 px-3 text-body-sm focus:ring-white" 
                       placeholder="Votre email" type="email"/>
                <button class="w-full py-2 bg-white text-secondary font-bold rounded-lg hover:bg-opacity-90 transition-all">S'inscrire</button>
            </div>
        </div>
    </aside>
</div>

@push('scripts')
<script>
    function shareArticle() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $article->title }}',
                text: '{{ $article->meta_description ?? "Découvrez cet article sur Wanderly" }}',
                url: window.location.href
            }).catch(() => {});
        } else {
            navigator.clipboard.writeText(window.location.href).then(() => {
                alert('Lien copié dans le presse-papier !');
            });
        }
    }

    function bookmarkArticle(articleId) {
        fetch(`/api/articles/${articleId}/bookmark`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
            }
        })
        .catch(error => console.error('Erreur:', error));
    }
</script>
@endpush