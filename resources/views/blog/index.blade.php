{{-- resources/views/blog/index.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog - NearSEO</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            color: #1a1a2e;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .blog-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a1a2e;
            letter-spacing: -0.02em;
        }
        .blog-title a {
            color: #1a1a2e;
            text-decoration: none;
        }
        .blog-title a:hover {
            color: #8c4a2f;
        }
        .blog-description {
            color: #6b7280;
            font-size: 0.95rem;
            margin-top: 0.25rem;
        }
        .search-box {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            width: 100%;
            font-size: 0.9rem;
        }
        .search-box:focus {
            outline: none;
            border-color: #8c4a2f;
            box-shadow: 0 0 0 3px rgba(140, 74, 47, 0.1);
        }
        .article-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #f0f0f0;
            transition: all 0.2s;
        }
        .article-card:hover {
            border-color: #e5e7eb;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .article-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 0.5rem;
        }
        .article-title a {
            color: #1a1a2e;
            text-decoration: none;
        }
        .article-title a:hover {
            color: #8c4a2f;
            text-decoration: underline;
        }
        .article-meta {
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }
        .article-excerpt {
            font-size: 0.95rem;
            color: #4b5563;
            line-height: 1.6;
        }
        .article-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.75rem;
        }
        .tag {
            font-size: 0.75rem;
            color: #6b7280;
            background: #f3f4f6;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            text-decoration: none;
        }
        .tag:hover {
            background: #8c4a2f;
            color: white;
        }
        .sidebar-title {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
            margin-bottom: 0.75rem;
        }
        .sidebar-item {
            display: block;
            padding: 0.5rem 0;
            color: #1a1a2e;
            text-decoration: none;
            font-size: 0.9rem;
            border-bottom: 1px solid #f3f4f6;
        }
        .sidebar-item:hover {
            color: #8c4a2f;
        }
        .sidebar-item .count {
            color: #9ca3af;
            font-size: 0.8rem;
            float: right;
        }
        .profile-card {
            text-align: center;
            padding: 1.5rem;
            background: white;
            border-radius: 0.75rem;
            border: 1px solid #f0f0f0;
        }
        .profile-name {
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 0.5rem;
        }
        .profile-desc {
            font-size: 0.85rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }
        .btn-subscribe {
            background: #8c4a2f;
            color: white;
            padding: 0.5rem 2rem;
            border-radius: 0.5rem;
            border: none;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            margin-top: 0.75rem;
        }
        .btn-subscribe:hover {
            background: #6d3a25;
        }
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }
        .pagination a, .pagination span {
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            color: #1a1a2e;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .pagination a:hover {
            background: #f3f4f6;
        }
        .pagination .active {
            background: #8c4a2f;
            color: white;
        }
        .pagination .disabled {
            color: #d1d5db;
        }
    </style>
</head>
<body>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- En-tête du blog -->
        <div class="mb-8">
            <h1 class="blog-title">
                <a href="{{ route('blog.index') }}">NearSEO Blog</a>
            </h1>
            <p class="blog-description">Articles, guides et conseils pour votre visibilité locale</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="lg:w-[65%]">
                <!-- Articles -->
                @forelse($articles as $article)
                <div class="article-card">
                    @if($article->image)
                    <div class="mb-3 overflow-hidden rounded-lg">
                        <img src="{{ asset('storage/' . $article->image) }}" 
                             alt="{{ $article->title }}" 
                             class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    @endif
                    
                    <h2 class="article-title">
                        <a href="{{ route('blog.show', $article->slug) }}">
                            {{ $article->title }}
                        </a>
                    </h2>
                    
                    <div class="article-meta">
                        {{ $article->created_at->format('F d, Y') }}
                        @if($article->read_time)
                        <span class="mx-2">·</span>
                        {{ $article->read_time }} min de lecture
                        @endif
                    </div>
                    
                    <p class="article-excerpt">
                        {{ Str::limit(strip_tags($article->content), 160) }}
                    </p>
                    
                    @if($article->tags)
                    <div class="article-tags">
                        @foreach(explode(',', $article->tags) as $tag)
                        <a href="#" class="tag">{{ trim($tag) }}</a>
                        @endforeach
                    </div>
                    @endif
                    
                    <div class="mt-3 text-sm text-gray-400">
                        <span class="material-symbols-outlined text-sm">visibility</span>
                        {{ $article->views ?? 0 }} vues
                        <span class="mx-2">·</span>
                        <span class="material-symbols-outlined text-sm">comment</span>
                        0 commentaires
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-6xl text-gray-300">article</span>
                    <h3 class="text-xl font-semibold text-gray-600 mt-4">Aucun article publié</h3>
                    <p class="text-gray-400">Revenez plus tard pour découvrir de nouveaux articles.</p>
                </div>
                @endforelse

                <!-- Pagination -->
                @if($articles->hasPages())
                <div class="pagination">
                    {{ $articles->links() }}
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="lg:w-[35%] space-y-6">
                <!-- Profil -->
                <div class="profile-card">
                    <div class="w-20 h-20 rounded-full bg-gray-200 mx-auto flex items-center justify-center">
                        <span class="material-symbols-outlined text-4xl text-gray-400">person</span>
                    </div>
                    <div class="profile-name">NearSEO</div>
                    <div class="profile-desc">Stratégies et conseils pour booster votre visibilité locale</div>
                    <button class="btn-subscribe">S'abonner</button>
                </div>

                <!-- Recherche -->
                <div class="bg-white p-4 rounded-xl border border-gray-100">
                    <h3 class="sidebar-title">Rechercher dans ce blog</h3>
                    <input type="text" id="searchInput" class="search-box" placeholder="Rechercher un article...">
                </div>

                <!-- Articles -->
                <div class="bg-white p-4 rounded-xl border border-gray-100">
                    <h3 class="sidebar-title">Articles</h3>
                    @foreach($recentArticles ?? [] as $recent)
                    <a href="{{ route('blog.show', $recent->slug) }}" class="sidebar-item">
                        {{ $recent->title }}
                        <span class="count">{{ $recent->created_at->format('M d, Y') }}</span>
                    </a>
                    @endforeach
                </div>

                <!-- Archives -->
                @if(isset($archives) && $archives->count() > 0)
                <div class="bg-white p-4 rounded-xl border border-gray-100">
                    <h3 class="sidebar-title">Archiver</h3>
                    @foreach($archives as $archive)
                    <a href="#" class="sidebar-item">
                        {{ $archive->year }} - {{ date('F', mktime(0, 0, 0, $archive->month, 1)) }}
                        <span class="count">({{ $archive->count }})</span>
                    </a>
                    @endforeach
                </div>
                @endif

                <!-- Tags -->
                @if(isset($allTags) && $allTags->count() > 0)
                <div class="bg-white p-4 rounded-xl border border-gray-100">
                    <h3 class="sidebar-title">Libellés</h3>
                    <div class="flex flex-wrap gap-1">
                        @foreach($allTags as $tag => $count)
                        <a href="#" class="tag">
                            {{ $tag }} ({{ $count }})
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Footer blog -->
                <div class="text-xs text-gray-400 text-center pt-4 border-t border-gray-100">
                    Fourni par NearSEO
                </div>
            </aside>
        </div>
    </div>

    <script>
        // Recherche en temps réel
        document.getElementById('searchInput')?.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const articles = document.querySelectorAll('.article-card');
            
            articles.forEach(article => {
                const title = article.querySelector('.article-title')?.textContent?.toLowerCase() || '';
                const content = article.querySelector('.article-excerpt')?.textContent?.toLowerCase() || '';
                
                if (title.includes(query) || content.includes(query)) {
                    article.style.display = '';
                } else {
                    article.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>