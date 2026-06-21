
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($article->title); ?> | NearSEO</title>
    
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
        .post-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1a1a2e;
            line-height: 1.3;
            margin-bottom: 0.5rem;
        }
        .post-title a {
            color: #1a1a2e;
            text-decoration: none;
        }
        .post-title a:hover {
            color: #8c4a2f;
            text-decoration: underline;
        }
        .post-meta {
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 1.5rem;
        }
        .post-body {
            font-size: 1rem;
            line-height: 1.8;
            color: #1a1a2e;
        }
        .post-body h2 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
            color: #1a1a2e;
        }
        .post-body h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            color: #1a1a2e;
        }
        .post-body p {
            margin-bottom: 1.25rem;
        }
        .post-body ul, .post-body ol {
            margin: 1rem 0;
            padding-left: 1.5rem;
        }
        .post-body li {
            margin-bottom: 0.5rem;
        }
        .post-body img {
            max-width: 100%;
            height: auto;
            border-radius: 0.75rem;
            margin: 1.5rem 0;
        }
        .post-body blockquote {
            border-left: 4px solid #8c4a2f;
            padding-left: 1.5rem;
            margin: 1.5rem 0;
            font-style: italic;
            color: #4b5563;
        }
        .post-body a {
            color: #8c4a2f;
            text-decoration: underline;
        }
        .post-body a:hover {
            color: #6d3a25;
        }
        .post-body .faq-item {
            background: #f3f4f6;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            margin: 1rem 0;
        }
        .post-body .faq-item strong {
            display: block;
            margin-bottom: 0.5rem;
        }
        .post-body .sommaire {
            background: #f3f4f6;
            padding: 1.5rem;
            border-radius: 0.75rem;
            margin: 1.5rem 0;
            border: 1px solid #e5e7eb;
        }
        .post-body .sommaire ul {
            list-style: none;
            padding-left: 0;
            margin: 0.5rem 0;
        }
        .post-body .sommaire li {
            padding: 0.25rem 0;
        }
        .post-body .sommaire a {
            color: #8c4a2f;
            text-decoration: none;
        }
        .post-body .sommaire a:hover {
            text-decoration: underline;
        }
        .post-footer {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }
        .post-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin: 1rem 0;
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
        .comments-section {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }
        .comment {
            padding: 1rem 0;
            border-bottom: 1px solid #f3f4f6;
        }
        .comment-author {
            font-weight: 600;
            font-size: 0.95rem;
        }
        .comment-date {
            font-size: 0.8rem;
            color: #6b7280;
        }
        .comment-text {
            margin-top: 0.25rem;
            font-size: 0.95rem;
            color: #4b5563;
        }
        .comment-form textarea {
            width: 100%;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-size: 0.95rem;
            resize: vertical;
            min-height: 100px;
        }
        .comment-form textarea:focus {
            outline: none;
            border-color: #8c4a2f;
            box-shadow: 0 0 0 3px rgba(140, 74, 47, 0.1);
        }
        .btn-submit {
            background: #8c4a2f;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            font-weight: 600;
            cursor: pointer;
            margin-top: 0.5rem;
        }
        .btn-submit:hover {
            background: #6d3a25;
        }
    </style>
</head>
<body>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- En-tête du blog -->
        <div class="mb-8">
            <h1 class="blog-title">
                <a href="<?php echo e(route('blog.index')); ?>">NearSEO Blog</a>
            </h1>
            <p class="blog-description">Articles, guides et conseils pour votre visibilité locale</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="lg:w-[65%]">
                <!-- Article -->
                <div class="bg-white rounded-xl p-6 border border-gray-100">
                    <h1 class="post-title"><?php echo e($article->title); ?></h1>
                    
                    <div class="post-meta">
                        <?php echo e($article->created_at->format('F d, Y')); ?>

                        <?php if($article->read_time): ?>
                        <span class="mx-2">·</span>
                        <?php echo e($article->read_time); ?> min de lecture
                        <?php endif; ?>
                    </div>

                    <?php if($article->image): ?>
                    <div class="mb-6 overflow-hidden rounded-xl">
                        <img src="<?php echo e(asset('storage/' . $article->image)); ?>" 
                             alt="<?php echo e($article->title); ?>" 
                             class="w-full h-auto object-cover">
                    </div>
                    <?php endif; ?>

                    <div class="post-body">
    <?php
        $content = $article->content;
        
        // Nettoyage sans supprimer les "n" des mots
        $content = trim($content);
        if (substr($content, 0, 1) === '"') $content = substr($content, 1);
        if (substr($content, -1) === '"') $content = substr($content, 0, -1);
        
        $content = stripslashes($content);
        $content = str_replace(['\\n', '\n', '\\r', '\r'], '', $content);
        $content = str_replace('\"', '"', $content);
        $content = str_replace("\'", "'", $content);
        
        // Restaurer les mots coupés
        $corrections = [
            'Introductio' => 'Introduction',
            'Conclusio' => 'Conclusion',
            'aiversaire' => 'anniversaire',
            'persoalisée' => 'personnalisée',
            'persoalisation' => 'personnalisation',
            'sélectioée' => 'sélectionnée',
            'sélectioons' => 'sélectionnons',
            'quotidiees' => 'quotidiennes',
            'exceptioelles' => 'exceptionnelles',
            'professioelles' => 'professionnelles',
            'professioels' => 'professionnels',
            'boutoière' => 'boutonnière',
            'aboements' => 'abonnements',
            'coaissances' => 'connaissances',
            'boe' => 'bonne',
            'aée' => 'année',
            'coaître' => 'connaître',
        ];
        
        foreach ($corrections as $wrong => $correct) {
            $content = str_replace($wrong, $correct, $content);
        }
        
        // Corriger les apostrophes
        $content = str_replace("'est", "n'est", $content);
        $content = str_replace("'hésitez", "n'hésitez", $content);
        $content = str_replace("'a", "n'a", $content);
        
        // Nettoyer les espaces
        $content = preg_replace('/\s+/', ' ', $content);
        $content = trim($content);
    ?>
    <?php echo $content; ?>

</div>

                    <div class="post-footer">
                        <?php if($article->tags): ?>
                        <div class="post-tags">
                            <?php $__currentLoopData = explode(',', $article->tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="#" class="tag"><?php echo e(trim($tag)); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>

                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">visibility</span>
                                <?php echo e($article->views ?? 0); ?> vues
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">comment</span>
                                0 commentaires
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex justify-between gap-4 mt-6">
                    <?php if($previousArticle ?? false): ?>
                    <a href="<?php echo e(route('blog.show', $previousArticle->slug)); ?>" 
                       class="text-sm text-gray-600 hover:text-primary transition-colors">
                        ← Article précédent
                    </a>
                    <?php endif; ?>
                    <?php if($nextArticle ?? false): ?>
                    <a href="<?php echo e(route('blog.show', $nextArticle->slug)); ?>" 
                       class="text-sm text-gray-600 hover:text-primary transition-colors ml-auto">
                        Article suivant →
                    </a>
                    <?php endif; ?>
                </div>

                <!-- Commentaires -->
                <div class="comments-section bg-white rounded-xl p-6 border border-gray-100 mt-6">
                    <h3 class="text-lg font-bold mb-4">Commentaires</h3>
                    
                    <div class="comment-form">
                        <textarea placeholder="Laisser un commentaire..."></textarea>
                        <button class="btn-submit">Publier</button>
                    </div>
                </div>
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
                    <input type="text" class="search-box" placeholder="Rechercher un article...">
                </div>

                <!-- Articles récents -->
                <div class="bg-white p-4 rounded-xl border border-gray-100">
                    <h3 class="sidebar-title">Articles</h3>
                    <?php $__currentLoopData = $recentArticles ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('blog.show', $recent->slug)); ?>" class="sidebar-item">
                        <?php echo e($recent->title); ?>

                        <span class="count"><?php echo e($recent->created_at->format('M d, Y')); ?></span>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Archives -->
                <?php if(isset($archives) && $archives->count() > 0): ?>
                <div class="bg-white p-4 rounded-xl border border-gray-100">
                    <h3 class="sidebar-title">Archiver</h3>
                    <?php $__currentLoopData = $archives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $archive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="#" class="sidebar-item">
                        <?php echo e($archive->year); ?> - <?php echo e(date('F', mktime(0, 0, 0, $archive->month, 1))); ?>

                        <span class=y-sm text-on-surface-variant hover:text-primary transition" href="#">Partenaires</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#">Sales</a>
                </nav>
            </div>
        </div>
        <div class="pt-8 border-t border-outline-variant/20 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="font-body-sm text-on-surface-variant text-center">© <?php echo e(date('Y')); ?> NEARSEO. Votre agent SEO local au Maroc.</p>
            <div class="flex gap-6">
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#"><span class="material-symbols-outlined">language</span></a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#"><span class="material-symbols-outlined">share</span></a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#"><span class="material-symbols-outlined">policy</span></a>
            </div>
        </div>
    </div><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/blog/show.blade.php ENDPATH**/ ?>