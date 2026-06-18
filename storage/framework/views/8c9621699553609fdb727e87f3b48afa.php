


<?php $__env->startSection('title', 'Générateur d\'articles IA - NEARSEO'); ?>
<?php $__env->startSection('header-title', 'Générateur d\'articles IA'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-[1400px] mx-auto">
    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <p class="text-gray-600">Créez du contenu stratégique optimisé pour le SEO en quelques secondes.</p>
                <span class="bg-green-100 text-green-700 text-[10px] font-extrabold px-2.5 py-1 rounded-full border border-green-200">3H → 30 SEC</span>
            </div>
        </div>
        <div class="hidden lg:flex items-center gap-2 bg-gray-100 px-4 py-2 rounded-lg border border-gray-200">
            <span class="material-symbols-outlined text-lg text-primary">bolt</span>
            <span class="text-sm font-semibold text-gray-700">Propulsé par l'agent NEARSEO</span>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-8 items-start">
        
        <!-- Left Column: Configuration Form -->
        <div class="col-span-12 lg:col-span-5 space-y-6">
            <div class="bg-white p-6 rounded-xl border shadow-sm">
                <div class="space-y-5">
                    
                    <!-- Mode Selector -->
                    <div class="p-1 bg-gray-100 rounded-xl flex gap-1 mb-2">
                        <button type="button" class="mode-btn flex-1 flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg text-sm transition-all bg-white text-primary shadow-sm ring-1 ring-black/5" data-mode="local" onclick="switchMode('local')">
                            <span class="material-symbols-outlined text-lg text-primary" style="font-variation-settings: 'FILL' 1;">location_on</span>
                            Commerce Local
                        </button>
                        <button type="button" class="mode-btn flex-1 flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg text-sm transition-all text-gray-600" data-mode="online" onclick="switchMode('online')">
                            <span class="material-symbols-outlined text-lg text-gray-500">language</span>
                            Entreprise en ligne
                        </button>
                    </div>

                    <!-- Nom du commerce -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase flex items-center gap-1">
                            Nom du commerce / entreprise <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">storefront</span>
                            <input id="businessName" type="text" 
                                   class="w-full pl-10 pr-4 py-3 border rounded-xl required-field focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                                   placeholder="Ex: La Maison du Pain, Coiffeur Elite">
                        </div>
                        <p class="text-xs text-red-500 hidden" id="businessNameError">Le nom du commerce est obligatoire</p>
                    </div>

                    <!-- Sujet -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase flex items-center gap-1" id="subjectLabel">
                            Sujet de l'article <span class="text-red-500">*</span>
                        </label>
                        <textarea id="subject" rows="3" 
                                  class="w-full rounded-lg border border-gray-300 p-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all resize-none"
                                  placeholder="Ex: Pourquoi choisir notre boulangerie artisanale..."></textarea>
                    </div>

                    <!-- Adresse -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase flex items-center gap-1">
                            Adresse <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">location_on</span>
                            <input id="address" type="text" 
                                   class="w-full pl-10 pr-4 py-3 border rounded-xl required-field focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                                   placeholder="Ex: 123 Avenue Mohammed VI, Guéliz, Marrakech">
                        </div>
                        <p class="text-xs text-red-500 hidden" id="addressError">L'adresse est obligatoire</p>
                    </div>

                    <!-- Site web (optionnel) - CACHÉ PAR DÉFAUT -->
                    <div id="websiteField" class="hidden space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase">Site web (optionnel)</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">public</span>
                            <input id="website" type="url" class="w-full pl-10 pr-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="https://www.maboutique.ma">
                        </div>
                    </div>
                    <button type="button" onclick="toggleWebsiteField()" class="text-primary text-sm flex items-center gap-1 mt-1 hover:underline">
                        <span class="material-symbols-outlined text-sm">add</span>
                         Ajouter un site web existant
                    </button>

                    <!-- Zone géographique d'intervention -->
                    <div id="geoZoneFields" class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase flex items-center gap-1">
                            Zone géographique d'intervention <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-3">
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">radio_button_checked</span>
                                <input type="text" id="geoQuartier" class="w-full pl-9 pr-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Quartier">
                            </div>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">location_city</span>
                                <input type="text" id="geoVille" class="w-full pl-9 pr-3 py-2 border rounded-lg text-sm required-field focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Ville *">
                            </div>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">public</span>
                                <select id="geoPays" class="w-full pl-9 pr-3 py-2 border rounded-lg text-sm bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                                    <option value="Maroc">Maroc</option>
                                    <option value="France">France</option>
                                    <option value="Belgique">Belgique</option>
                                    <option value="Suisse">Suisse</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Sénégal">Sénégal</option>
                                    <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                    <option value="Espagne">Espagne</option>
                                    <option value="Italie">Italie</option>
                                    <option value="Allemagne">Allemagne</option>
                                </select>
                            </div>
                        </div>
                        <p class="text-xs text-red-500 hidden" id="geoVilleError">La ville est obligatoire</p>
                        <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-gray-400">public</span>
                            La carte se met à jour automatiquement lorsque vous changez le pays, la ville ou le quartier
                        </p>
                    </div>

                    <!-- Local Fields -->
                    <div id="localFields" class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm text-gray-400">google</span>
                                Fiche Google (GBP)
                            </label>
                            <select id="gbpOption" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                                <option value="optimize">Optimiser pour GBP</option>
                                <option value="ignore">Ignorer</option>
                            </select>
                        </div>
                        <div class="space-y-2"></div>
                    </div>

                    <!-- Online Fields -->
                    <div id="onlineFields" class="hidden space-y-4">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase flex items-center gap-1">
                                Site Web <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">public</span>
                                <input id="websiteOnline" type="url" class="w-full pl-10 pr-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="https://www.monsite.ma">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm text-gray-400">sell</span>
                                Mots-clés stratégiques
                            </label>
                            <input id="keywords" type="text" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Ex: artisanat, tourisme">
                        </div>
                    </div>

                    <!-- Horaires -->
                    <div id="localDetailsFields" class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-gray-400">schedule</span>
                            Horaires d'ouverture
                        </label>
                        <input id="hours" type="text" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Lun-Sam : 09h00 - 20h00">
                    </div>

                    <!-- Objectifs -->
                    <div id="goalsFields" class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-gray-400">target</span>
                            Objectif(s) de l'article
                        </label>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50 transition-all">
                                <input type="checkbox" value="attirer_boutique" class="goal-checkbox accent-primary"> 
                                <span class="text-sm">🏪 Attirer en boutique</span>
                            </label>
                            <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50 transition-all">
                                <input type="checkbox" value="appels" class="goal-checkbox accent-primary"> 
                                <span class="text-sm">📞 Générer des appels</span>
                            </label>
                            <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50 transition-all">
                                <input type="checkbox" value="promotion" class="goal-checkbox accent-primary"> 
                                <span class="text-sm">🎯 Promouvoir une offre</span>
                            </label>
                            <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50 transition-all">
                                <input type="checkbox" value="reservations" class="goal-checkbox accent-primary"> 
                                <span class="text-sm">📅 Prise de rendez-vous</span>
                            </label>
                            <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50 transition-all col-span-2">
                                <input type="checkbox" value="livraison" class="goal-checkbox accent-primary"> 
                                <span class="text-sm">🚚 Livraison à domicile</span>
                            </label>
                        </div>
                    </div>

                    <!-- Langue & Ton -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm text-gray-400">translate</span>
                                Langue
                            </label>
                            <select id="language" class="w-full rounded-lg border border-gray-300 px-3 py-2 bg-white text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                                <option value="fr">🇫🇷 Français</option>
                                <option value="en">🇬🇧 English</option>
                                <option value="ar">🇲🇦 العربية</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm text-gray-400">record_voice_over</span>
                                Ton
                            </label>
                            <select id="tone" class="w-full rounded-lg border border-gray-300 px-3 py-2 bg-white text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                                <option value="professional">💼 Professionnel & Chaleureux</option>
                                <option value="expert">🎓 Expert / Autorité</option>
                                <option value="storytelling">📖 Storytelling</option>
                            </select>
                        </div>
                    </div>

                    <!-- Length Slider -->
                    <div class="space-y-4 py-2">
                        <div class="flex justify-between items-center">
                            <label class="text-xs font-bold text-gray-500 uppercase flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm text-gray-400">format_size</span>
                                Format SEO
                            </label>
                            <span class="text-primary font-bold text-sm" id="lengthValue">Moyen</span>
                        </div>
                        <input id="lengthSlider" type="range" min="1" max="3" value="2" step="1"
                               class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-primary transition-all"
                               oninput="updateLength(this.value)">
                        <div class="flex justify-between text-[10px] font-bold text-gray-400 uppercase tracking-wider px-1">
                            <span>Court (600 mots)</span>
                            <span>Moyen (1000 mots)</span>
                            <span>Long (1600 mots)</span>
                        </div>
                    </div>

                    <!-- Generate Button -->
                    <button id="generateBtn" onclick="generateArticle()"
                            class="w-full bg-secondary text-white py-4 rounded-xl font-semibold flex items-center justify-center gap-3 hover:shadow-lg active:scale-95 transition-all mt-4 group">
                        <span>Générer l'article avec l'agent NEARSEO</span>
                        <span class="material-symbols-outlined group-hover:rotate-180 transition-transform duration-500 text-white" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                    </button>
                </div>
            </div>

            <!-- Conseils -->
            <div class="border-l-4 border-secondary bg-green-50 p-5 rounded-xl">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-secondary">lightbulb</span>
                    <div>
                        <h4 class="font-semibold text-secondary mb-1" id="tipTitle">Conseil Local</h4>
                        <p class="text-sm text-gray-600" id="tipText">L'agent NEARSEO intègre automatiquement votre zone géographique (quartier/ville/pays) dans l'article pour un ciblage SEO ultra-précis.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: MAP + Preview + Suggestions -->
        <div class="col-span-12 lg:col-span-7 space-y-6">
            
            <!-- Suggestions de sujets - Tendances Google & Événements -->
            <div class="bg-white rounded-xl border shadow-sm p-4">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-bold text-gray-900 flex items-center gap-2 text-sm">
                        <span class="material-symbols-outlined text-primary">trending_up</span>
                         Tendances & Événements
                    </h3>
                    <span class="text-xs text-gray-400">Mise à jour quotidienne</span>
                </div>
                
                <?php if(isset($trends) && !empty($trends)): ?>
                <div class="flex gap-3 overflow-x-auto pb-2" style="scrollbar-width: thin;">
                    <!-- Google Trends -->
                    <?php $__currentLoopData = $trends['google'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div onclick="selectTopic('<?php echo e(addslashes($trend['keyword'])); ?>', '')" 
                         class="min-w-[180px] max-w-[200px] p-3 bg-blue-50 rounded-lg hover:bg-blue-100 cursor-pointer transition-all group flex-shrink-0 border border-blue-100">
                        <div class="flex items-start gap-1.5">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-medium text-gray-900 group-hover:text-primary transition-colors line-clamp-2">
                                    <?php echo e($trend['keyword']); ?>

                                </p>
                                <div class="flex items-center gap-1 mt-1">
                                    <span class="text-[9px] text-gray-400">Volume</span>
                                    <div class="flex-1 h-0.5 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-blue-500 rounded-full" style="width: <?php echo e(min(($trend['volume'] ?? 500) / 1200 * 100, 100)); ?>%"></div>
                                    </div>
                                    <span class="text-[9px] text-gray-500"><?php echo e(number_format($trend['volume'] ?? 0)); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <!-- Événements -->
                    <?php $__currentLoopData = $trends['seasonal'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div onclick="selectTopic('<?php echo e(addslashes($event)); ?>', '')" 
                         class="min-w-[160px] max-w-[180px] p-3 bg-orange-50 rounded-lg hover:bg-orange-100 cursor-pointer transition-all group flex-shrink-0 border border-orange-100">
                        <div class="flex items-start gap-1.5">
                            <span class="text-sm">📅</span>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-medium text-gray-900 group-hover:text-primary transition-colors line-clamp-2">
                                    <?php echo e($event); ?>

                                </p>
                                <span class="text-[9px] text-gray-400 mt-1 inline-block">🎯 Événement</span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <!-- Actualités -->
                    <?php $__currentLoopData = $trends['news'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div onclick="selectTopic('<?php echo e(addslashes($news['title'])); ?>', '')" 
                         class="min-w-[180px] max-w-[200px] p-3 bg-red-50 rounded-lg hover:bg-red-100 cursor-pointer transition-all group flex-shrink-0 border border-red-100">
                        <div class="flex items-start gap-1.5">
                            <span class="text-sm">📰</span>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-medium text-gray-900 group-hover:text-primary transition-colors line-clamp-2">
                                    <?php echo e($news['title']); ?>

                                </p>
                                <span class="text-[9px] text-gray-400 mt-1 inline-block"><?php echo e($news['source'] ?? 'Actualité'); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <div class="text-center py-4">
                    <span class="material-symbols-outlined text-3xl text-gray-300">trending_up</span>
                    <p class="text-xs text-gray-400 mt-1">Aucune tendance disponible</p>
                </div>
                <?php endif; ?>
                
                <!-- Lien vers les tendances -->
                <div class="mt-3 pt-2 border-t border-gray-100 flex items-center justify-end">
                    <a href="<?php echo e(route('trends.index')); ?>" class="text-[10px] text-primary hover:underline flex items-center gap-1">
                        Voir toutes les tendances
                        <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </a>
                </div>
            </div>
            
            <!-- Carte + Aperçu -->
            <div class="bg-white rounded-xl border shadow-sm flex flex-col">
                <!-- MAP SECTION avec barre de recherche -->
                <div class="relative w-full" style="height: 320px;">
                    <div class="absolute top-4 left-4 right-4 z-20">
                        <div class="relative max-w-md">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">search</span>
                            <input type="text" id="mapSearchInput" 
                                   placeholder="Rechercher une adresse, une ville..." 
                                   class="w-full pl-10 pr-4 py-2.5 bg-white rounded-lg shadow-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm transition-all">
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400">⌘K</span>
                        </div>
                    </div>
                    
                    <div id="map" class="w-full h-full rounded-t-xl overflow-hidden bg-gray-100"></div>
                    
                    <div class="absolute bottom-4 left-4 z-20 flex flex-col gap-2">
                        <button onclick="zoomIn()" class="w-10 h-10 bg-white/90 backdrop-blur-sm rounded-lg shadow-md flex items-center justify-center text-gray-600 hover:text-primary hover:bg-white transition-all">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                        <button onclick="zoomOut()" class="w-10 h-10 bg-white/90 backdrop-blur-sm rounded-lg shadow-md flex items-center justify-center text-gray-600 hover:text-primary hover:bg-white transition-all">
                            <span class="material-symbols-outlined">remove</span>
                        </button>
                        <button onclick="getUserLocation()" class="w-10 h-10 bg-white/90 backdrop-blur-sm rounded-lg shadow-md flex items-center justify-center text-gray-600 hover:text-primary hover:bg-white transition-all mt-4">
                            <span class="material-symbols-outlined">my_location</span>
                        </button>
                    </div>
                    
                    <div class="absolute bottom-4 right-4 z-20">
                        <span class="text-xs bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-md text-gray-600 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-primary">location_on</span>
                            <span id="mapStatus">🌍 Carte centrée</span>
                        </span>
                    </div>
                </div>
                
                <!-- Preview Header -->
                <div class="p-4 border-b border-t flex justify-between items-center bg-gray-50">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-gray-500">visibility</span>
                        <h2 class="font-semibold text-lg">Aperçu de l'article</h2>
                    </div>
                    <div class="flex items-center gap-2 bg-green-100 text-green-700 px-3 py-1 rounded-full border border-green-200">
                        <span class="material-symbols-outlined text-base text-green-600" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                        <span class="text-[11px] font-bold uppercase tracking-wider" id="previewBadge">Mode Local Actif</span>
                    </div>
                </div>

                <!-- Empty State -->
                <div id="emptyState" class="flex-1 flex flex-col items-center justify-center p-12 text-center" style="min-height: 300px;">
                    <div class="w-24 h-24 bg-primary/5 rounded-full flex items-center justify-center mb-6 relative">
                        <span class="material-symbols-outlined text-5xl text-primary/30">article</span>
                        <div class="absolute -right-1 -bottom-1 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md border">
                            <span class="material-symbols-outlined text-primary text-xl">auto_awesome</span>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">Agent NEARSEO prêt</h3>
                    <p class="text-gray-500 max-w-sm text-base">
                        Remplissez le formulaire à gauche et cliquez sur "Générer".<br>
                        <span class="text-sm text-primary">Votre article apparaîtra ici</span>
                    </p>
                </div>

                <!-- Article Content -->
                <div id="articleContent" class="hidden p-8 prose max-w-none"></div>

                <!-- Bottom Action Bar -->
                <div id="actionBar" class="p-6 border-t bg-gray-50 rounded-b-xl flex items-center justify-between opacity-50">
                    <div class="flex items-center gap-4">
                        <div class="relative w-14 h-14 flex items-center justify-center">
                            <svg class="w-full h-full -rotate-90">
                                <circle cx="28" cy="28" fill="transparent" r="24" stroke="#e5e7eb" stroke-width="4"></circle>
                                <circle id="seoScoreCircle" cx="28" cy="28" fill="transparent" r="24" stroke="#47664b" stroke-dasharray="150" stroke-dashoffset="150" stroke-width="4"></circle>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span id="seoScore" class="text-xs font-bold text-gray-800">--</span>
                                <span class="text-[8px] uppercase text-gray-400">SEO</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase">Score d'optimisation</p>
                            <p id="seoStatus" class="text-sm font-semibold text-gray-500">Attente de génération...</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button id="rewriteBtn" onclick="rewriteArticle()" disabled class="px-4 py-2 border rounded-lg text-sm font-semibold text-gray-400 cursor-not-allowed flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg text-gray-400">refresh</span> 
                            Reformuler
                        </button>
                        <button id="publishBtn" onclick="publishArticle()" disabled class="px-5 py-2 bg-gray-300 text-white rounded-lg text-sm font-bold cursor-not-allowed flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg text-white">ios_share</span> 
                            Exporter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .marker-pulse::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(140, 74, 47, 0.4);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(3); opacity: 0; }
    }
    .prose {
        max-width: none;
    }
    .prose h1 { font-size: 2rem; font-weight: 700; margin-bottom: 1rem; }
    .prose h2 { font-size: 1.5rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.75rem; }
    .prose h3 { font-size: 1.25rem; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; }
    .prose p { margin-bottom: 1rem; line-height: 1.6; }
    .prose ul, .prose ol { padding-left: 1.5rem; margin-bottom: 1rem; }
    .faq-item { margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #e5e7eb; }
    .faq-item p:first-child { font-weight: 600; }
    .material-symbols-outlined {
        vertical-align: middle;
    }
    .mode-btn {
        transition: all 0.2s ease;
    }
    .mode-btn:hover {
        transform: scale(1.02);
    }
    /* Scrollbar personnalisée */
    .overflow-x-auto::-webkit-scrollbar {
        height: 4px;
    }
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 10px;
    }
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    let map;
    let currentMarker = null;
    let currentMode = 'local';
    let generatedContent = '';
    let currentSeoScore = 0;
    let updateTimeout = null;

    // =============================================
    // CARTE
    // =============================================

    function initMap() {
        const defaultCenter = [31.7917, -7.0926];
        map = L.map('map').setView(defaultCenter, 6);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> & CartoDB',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);
        
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                map.setView([position.coords.latitude, position.coords.longitude], 10);
                document.getElementById('mapStatus').innerHTML = '📍 Votre position';
                addMarker(position.coords.latitude, position.coords.longitude);
            }, error => {
                document.getElementById('mapStatus').innerHTML = '🌍 Carte centrée sur le Maroc';
            });
        }
        updateMapFromGeoZone();
    }
    
    function addMarker(lat, lng) {
        if (currentMarker) map.removeLayer(currentMarker);
        const customIcon = L.divIcon({
            html: '<div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center border-2 border-white shadow-lg"><span class="material-symbols-outlined text-white text-sm">location_on</span></div>',
            iconSize: [32, 32],
            popupAnchor: [0, -16],
            className: 'custom-marker'
        });
        currentMarker = L.marker([lat, lng], { icon: customIcon, draggable: true }).addTo(map);
        currentMarker.bindPopup(`<b>${document.getElementById('businessName').value || 'Votre commerce'}</b>`);
        currentMarker.on('dragend', (e) => reverseGeocode(e.target.getLatLng().lat, e.target.getLatLng().lng));
    }
    
    async function updateMapFromGeoZone() {
        const quartier = document.getElementById('geoQuartier')?.value || '';
        const ville = document.getElementById('geoVille')?.value || '';
        const pays = document.getElementById('geoPays')?.value || '';
        let query = [quartier, ville, pays].filter(Boolean).join(', ');
        if (!query) return;
        
        document.getElementById('mapStatus').innerHTML = '🔍 Recherche...';
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1`);
            const data = await response.json();
            if (data?.length) {
                map.setView([data[0].lat, data[0].lon], 13);
                addMarker(data[0].lat, data[0].lon);
                document.getElementById('mapStatus').innerHTML = `📍 ${ville || pays}`;
            } else {
                document.getElementById('mapStatus').innerHTML = '⚠️ Localisation non trouvée';
            }
        } catch (error) {
            document.getElementById('mapStatus').innerHTML = '❌ Erreur de recherche';
        }
    }
    
    async function reverseGeocode(lat, lng) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`);
            const data = await response.json();
            if (data?.address) {
                const ville = data.address.city || data.address.town || data.address.village || '';
                const quartier = data.address.suburb || data.address.neighbourhood || '';
                const pays = data.address.country || '';
                if (ville) document.getElementById('geoVille').value = ville;
                if (quartier) document.getElementById('geoQuartier').value = quartier;
                if (pays) {
                    let opt = Array.from(document.getElementById('geoPays').options).find(o => o.value === pays);
                    if (opt) document.getElementById('geoPays').value = pays;
                }
                document.getElementById('mapStatus').innerHTML = `📍 ${quartier ? quartier + ', ' : ''}${ville}`;
            }
        } catch (error) { console.error('Reverse geocoding error:', error); }
    }
    
    function setupGeoListeners() {
        ['geoQuartier', 'geoVille', 'geoPays'].forEach(id => {
            let el = document.getElementById(id);
            if (el) el.addEventListener('change', () => {
                clearTimeout(updateTimeout);
                updateTimeout = setTimeout(() => updateMapFromGeoZone(), 500);
            });
        });
    }
    
    function zoomIn() { map?.zoomIn(); }
    function zoomOut() { map?.zoomOut(); }
    
    function getUserLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                map.setView([position.coords.latitude, position.coords.longitude], 14);
                addMarker(position.coords.latitude, position.coords.longitude);
                reverseGeocode(position.coords.latitude, position.coords.longitude);
                document.getElementById('mapStatus').innerHTML = '📍 Votre position';
            }, () => alert('Impossible d\'obtenir votre position'));
        } else alert('Géolocalisation non supportée');
    }
    
    async function searchMapLocation(event) {
        if (event.key !== 'Enter') return;
        const query = event.target.value;
        if (!query) return;
        document.getElementById('mapStatus').innerHTML = '🔍 Recherche...';
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1`);
            const data = await response.json();
            if (data?.length) {
                map.setView([data[0].lat, data[0].lon], 14);
                addMarker(data[0].lat, data[0].lon);
                document.getElementById('mapStatus').innerHTML = `📍 ${data[0].display_name.substring(0, 40)}`;
                let parts = data[0].display_name.split(',');
                if (parts.length >= 2) document.getElementById('geoVille').value = parts[1].trim();
                if (parts.length >= 3) document.getElementById('geoPays').value = parts[2].trim();
            } else document.getElementById('mapStatus').innerHTML = '⚠️ Localisation non trouvée';
        } catch (error) { document.getElementById('mapStatus').innerHTML = '❌ Erreur de recherche'; }
    }
    
    // Attacher l'événement de recherche
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('mapSearchInput')?.addEventListener('keypress', searchMapLocation);
    });
    
    function toggleWebsiteField() {
        let field = document.getElementById('websiteField');
        let btn = event?.target?.closest('button') || document.querySelector('button[onclick="toggleWebsiteField()"]');
        if (field.classList.contains('hidden')) {
            field.classList.remove('hidden');
            if (btn) btn.innerHTML = '<span class="material-symbols-outlined text-sm">remove</span> Supprimer mon site web';
        } else {
            field.classList.add('hidden');
            document.getElementById('website').value = '';
            if (btn) btn.innerHTML = '<span class="material-symbols-outlined text-sm">add</span> Ajouter un site web existant';
        }
    }
    
    function updateLength(val) {
        let values = ["Court", "Moyen", "Long"];
        document.getElementById('lengthValue').innerText = values[val-1];
    }
    
    function validateForm() {
        let isValid = true;
        let businessName = document.getElementById('businessName').value.trim();
        let address = document.getElementById('address').value.trim();
        let geoVille = document.getElementById('geoVille')?.value.trim();
        
        if (!businessName) {
            document.getElementById('businessName').classList.add('border-red-500');
            document.getElementById('businessNameError').classList.remove('hidden');
            isValid = false;
        } else {
            document.getElementById('businessName').classList.remove('border-red-500');
            document.getElementById('businessNameError').classList.add('hidden');
        }
        
        if (!address) {
            document.getElementById('address').classList.add('border-red-500');
            document.getElementById('addressError').classList.remove('hidden');
            isValid = false;
        } else {
            document.getElementById('address').classList.remove('border-red-500');
            document.getElementById('addressError').classList.add('hidden');
        }
        
        if (currentMode === 'local' && !geoVille) {
            document.getElementById('geoVille').classList.add('border-red-500');
            document.getElementById('geoVilleError').classList.remove('hidden');
            isValid = false;
        } else if (document.getElementById('geoVille')) {
            document.getElementById('geoVille').classList.remove('border-red-500');
            document.getElementById('geoVilleError').classList.add('hidden');
        }
        return isValid;
    }
    
    function switchMode(mode) {
        currentMode = mode;
        let localBtn = document.querySelector('[data-mode="local"]');
        let onlineBtn = document.querySelector('[data-mode="online"]');
        let localFields = document.getElementById('localFields');
        let onlineFields = document.getElementById('onlineFields');
        let localDetailsFields = document.getElementById('localDetailsFields');
        let goalsFields = document.getElementById('goalsFields');
        let geoZoneFields = document.getElementById('geoZoneFields');
        let subjectLabel = document.getElementById('subjectLabel');
        let tipTitle = document.getElementById('tipTitle');
        let tipText = document.getElementById('tipText');
        let previewBadge = document.getElementById('previewBadge');
        
        if (mode === 'local') {
            localBtn.classList.add('bg-white', 'text-primary', 'shadow-sm', 'ring-1', 'ring-black/5');
            localBtn.classList.remove('text-gray-600');
            onlineBtn.classList.remove('bg-white', 'text-primary', 'shadow-sm', 'ring-1', 'ring-black/5');
            onlineBtn.classList.add('text-gray-600');
            localFields.classList.remove('hidden');
            onlineFields.classList.add('hidden');
            localDetailsFields.classList.remove('hidden');
            goalsFields.classList.remove('hidden');
            if (geoZoneFields) geoZoneFields.classList.remove('hidden');
            subjectLabel.innerText = "Sujet de l'article local";
            tipTitle.innerText = "Conseil Local";
            tipText.innerHTML = "L'agent NEARSEO intègre automatiquement votre zone géographique (quartier/ville/pays) dans l'article pour un ciblage SEO ultra-précis.";
            previewBadge.innerText = "Mode Local Actif";
            updateMapFromGeoZone();
        } else {
            onlineBtn.classList.add('bg-white', 'text-primary', 'shadow-sm', 'ring-1', 'ring-black/5');
            onlineBtn.classList.remove('text-gray-600');
            localBtn.classList.remove('bg-white', 'text-primary', 'shadow-sm', 'ring-1', 'ring-black/5');
            localBtn.classList.add('text-gray-600');
            onlineFields.classList.remove('hidden');
            localFields.classList.add('hidden');
            localDetailsFields.classList.add('hidden');
            goalsFields.classList.add('hidden');
            if (geoZoneFields) geoZoneFields.classList.add('hidden');
            subjectLabel.innerText = "Sujet de l'article";
            tipTitle.innerText = "Conseil Entreprise";
            tipText.innerHTML = "L'agent NEARSEO va générer un article optimisé pour votre site web avec des backlinks pertinents.";
            previewBadge.innerText = "Mode Global Actif";
        }
    }
    
    function updateSeoScore(score) {
        let circumference = 150;
        let offset = circumference - (score / 100) * circumference;
        let circle = document.getElementById('seoScoreCircle');
        if (circle) circle.style.strokeDashoffset = offset;
        document.getElementById('seoScore').innerText = score;
        let statusEl = document.getElementById('seoStatus');
        if (score >= 80) statusEl.innerHTML = '🏆 Excellent - Prêt à publier';
        else if (score >= 60) statusEl.innerHTML = '👍 Bon - Quelques améliorations possibles';
        else statusEl.innerHTML = '⚠️ À améliorer - Relisez le contenu';
    }
    
    function enableActions() {
        let rewriteBtn = document.getElementById('rewriteBtn');
        let publishBtn = document.getElementById('publishBtn');
        let actionBar = document.getElementById('actionBar');
        if (rewriteBtn) {
            rewriteBtn.disabled = false;
            rewriteBtn.classList.remove('text-gray-400', 'cursor-not-allowed');
            rewriteBtn.classList.add('text-primary', 'cursor-pointer', 'hover:bg-primary/5', 'border-primary/30');
        }
        if (publishBtn) {
            publishBtn.disabled = false;
            publishBtn.classList.remove('bg-gray-300', 'cursor-not-allowed');
            publishBtn.classList.add('bg-secondary', 'cursor-pointer', 'hover:bg-secondary/90', 'shadow-md');
        }
        if (actionBar) actionBar.classList.remove('opacity-50');
    }
    
    // =============================================
    // SÉLECTION D'UN SUJET (Tendances)
    // =============================================

    function selectTopic(topic, keywords) {
        document.getElementById('subject').value = topic;
        if (keywords) {
            document.getElementById('keywords').value = keywords;
        }
        document.getElementById('subject').focus();
        
        // Mettre en évidence le champ
        document.getElementById('subject').style.borderColor = '#8c4a2f';
        document.getElementById('subject').style.backgroundColor = '#f0f7ff';
        setTimeout(() => {
            document.getElementById('subject').style.borderColor = '';
            document.getElementById('subject').style.backgroundColor = '';
        }, 2000);
        
        // Scroll vers le champ sujet
        document.getElementById('subject').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function copyText(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(() => {
                showToast('✅ Copié dans le presse-papier !');
            });
        } else {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            showToast('✅ Copié dans le presse-papier !');
        }
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.textContent = message;
        toast.style.cssText = `
            position: fixed; bottom: 20px; right: 20px;
            background: #1a1a2e; color: white;
            padding: 12px 24px; border-radius: 12px;
            z-index: 9999; font-size: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            animation: slideUp 0.3s ease-out;
        `;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transition = 'opacity 0.3s';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // =============================================
    // GÉNÉRATION D'ARTICLE
    // =============================================
    
    async function generateArticle() {
    // ✅ Validation frontend renforcée
    const businessName = document.getElementById('businessName').value.trim();
    const subject = document.getElementById('subject').value.trim();
    const address = document.getElementById('address').value.trim();
    const geoVille = document.getElementById('geoVille')?.value.trim();
    
    let errors = [];
    if (!businessName) errors.push('Le nom du commerce est obligatoire');
    if (!subject) errors.push('Le sujet de l\'article est obligatoire');
    if (!address) errors.push('L\'adresse est obligatoire');
    if (currentMode === 'local' && !geoVille) errors.push('La ville est obligatoire en mode local');
    
    if (errors.length > 0) {
        showToast('❌ ' + errors.join('<br>'));
        return;
    }
    
    const btn = document.getElementById('generateBtn');
    const originalHtml = btn.innerHTML;
    btn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Génération en cours...';
    btn.disabled = true;
    
    document.getElementById('emptyState').classList.add('hidden');
    document.getElementById('articleContent').classList.remove('hidden');
    document.getElementById('articleContent').innerHTML = `
        <div class="space-y-4 animate-pulse">
            <div class="h-8 bg-gray-200 rounded w-3/4"></div>
            <div class="h-4 bg-gray-200 rounded w-full"></div>
            <div class="h-4 bg-gray-200 rounded w-5/6"></div>
            <div class="h-4 bg-gray-200 rounded w-4/5"></div>
            <div class="h-32 bg-gray-200 rounded w-full"></div>
        </div>
    `;
    
    const payload = {
        mode: currentMode,
        business_name: businessName,
        subject: subject,
        address: address,
        language: document.getElementById('language').value,
        tone: document.getElementById('tone').value,
        format: ['short', 'medium', 'long'][document.getElementById('lengthSlider').value - 1]
    };
    
    if (currentMode === 'local') {
        payload.website = document.getElementById('website').value || '';
        payload.hours = document.getElementById('hours').value || '';
        payload.goals = Array.from(document.querySelectorAll('.goal-checkbox:checked')).map(cb => cb.value);
        payload.geo_quartier = document.getElementById('geoQuartier')?.value || '';
        payload.geo_ville = document.getElementById('geoVille')?.value || '';
        payload.geo_pays = document.getElementById('geoPays')?.value || 'Maroc';
    } else {
        payload.website = document.getElementById('websiteOnline').value || '';
        payload.keywords = document.getElementById('keywords').value || '';
    }
    
    console.log('🔍 Payload envoyé:', payload);
    
    try {
        const response = await fetch('<?php echo e(route("ai.generate")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(payload)
        });
        
        // ✅ Lire la réponse brute pour débogage
        const responseText = await response.text();
        let data;
        try {
            data = JSON.parse(responseText);
        } catch (e) {
            console.error('❌ Réponse non-JSON:', responseText);
            document.getElementById('articleContent').innerHTML = `
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-5xl text-red-500">error</span>
                    <p class="text-red-600 mt-4 font-semibold">❌ Erreur serveur</p>
                    <pre class="mt-4 text-left text-xs bg-gray-100 p-4 rounded-lg overflow-auto max-h-60">${responseText.substring(0, 500)}</pre>
                    <button onclick="generateArticle()" class="mt-4 px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                        Réessayer
                    </button>
                </div>
            `;
            btn.innerHTML = originalHtml;
            btn.disabled = false;
            return;
        }
        
        console.log('📦 Réponse:', data);
        
        // ✅ Gestion des erreurs détaillée
        if (!response.ok) {
            let errorMessage = data.message || 'Erreur inconnue';
            let errorDetails = '';
            
            if (data.errors) {
                errorDetails = Object.entries(data.errors)
                    .map(([field, messages]) => `• ${field}: ${messages.join(', ')}`)
                    .join('<br>');
            }
            
            if (data.error) {
                errorDetails += `<br>💡 ${data.error}`;
            }
            
            if (data.code === 'gemini_unavailable') {
                errorMessage = '⚠️ API Gemini indisponible';
                errorDetails = 'Veuillez réessayer dans quelques instants ou contacter le support.';
            }
            
            document.getElementById('articleContent').innerHTML = `
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-5xl text-red-500">error</span>
                    <p class="text-red-600 mt-4 font-semibold">❌ ${errorMessage}</p>
                    ${errorDetails ? `<div class="text-sm text-gray-600 mt-2">${errorDetails}</div>` : ''}
                    ${data.fallback ? `<p class="text-sm text-yellow-600 mt-2">🔄 Mode dégradé activé</p>` : ''}
                    <button onclick="generateArticle()" class="mt-4 px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                        Réessayer
                    </button>
                </div>
            `;
            btn.innerHTML = originalHtml;
            btn.disabled = false;
            return;
        }
        
        // ✅ Succès
        if (data.success) {
            if (data.is_fallback) {
                showToast('⚠️ Article généré en mode dégradé (API indisponible)');
            } else {
                showToast('✅ Article généré avec succès !');
            }
            
            // ✅ Mettre à jour les variables globales
            generatedContent = data.content || '';
            currentSeoScore = data.seo_score || 0;
            
            // ✅ Redirection ou affichage
            if (data.redirect_url) {
                setTimeout(() => {
                    window.location.href = data.redirect_url;
                }, 1500);
            } else {
                document.getElementById('articleContent').innerHTML = data.content || 'Contenu vide';
                if (data.seo_score) {
                    updateSeoScore(data.seo_score);
                }
                enableActions();
            }
        } else {
            document.getElementById('articleContent').innerHTML = `
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-5xl text-red-500">error</span>
                    <p class="text-red-600 mt-4 font-semibold">❌ ${data.message || 'Génération échouée'}</p>
                    <button onclick="generateArticle()" class="mt-4 px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                        Réessayer
                    </button>
                </div>
            `;
        }
    } catch (error) {
        console.error('❌ Erreur réseau:', error);
        document.getElementById('articleContent').innerHTML = `
            <div class="text-center py-12">
                <span class="material-symbols-outlined text-5xl text-red-500">wifi_off</span>
                <p class="text-red-600 mt-4 font-semibold">❌ Erreur de connexion</p>
                <p class="text-sm text-gray-500 mt-2">${error.message || 'Veuillez vérifier votre connexion internet'}</p>
                <button onclick="generateArticle()" class="mt-4 px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                    Réessayer
                </button>
            </div>
        `;
    } finally {
        btn.innerHTML = originalHtml;
        btn.disabled = false;
    }
}
    
    function rewriteArticle() { 
        alert('🔄 Fonctionnalité à venir : Reformulation de l\'article avec l\'agent NEARSEO'); 
    }
    
    function publishArticle() {
        if (!generatedContent) return;
        let title = prompt('Titre de l\'article :', document.getElementById('subject').value);
        if (!title) return;
        fetch('<?php echo e(route("articles.store")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                title: title,
                content: generatedContent,
                seo_score: currentSeoScore,
                status: 'published',
                address: document.getElementById('address').value,
                business_name: document.getElementById('businessName').value,
                geo_ville: document.getElementById('geoVille')?.value || '',
                geo_pays: document.getElementById('geoPays')?.value || ''
            })
        }).then(response => {
            if (response.ok) {
                alert('✅ Article publié avec succès !');
                window.location.href = '<?php echo e(route("articles.index")); ?>';
            } else alert('Erreur lors de la publication');
        }).catch(error => alert('Erreur de connexion'));
    }
    
    // Événements de validation en temps réel
    document.getElementById('businessName')?.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('border-red-500');
            document.getElementById('businessNameError')?.classList.add('hidden');
        }
    });
    document.getElementById('address')?.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('border-red-500');
            document.getElementById('addressError')?.classList.add('hidden');
        }
    });
    document.getElementById('geoVille')?.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('border-red-500');
            document.getElementById('geoVilleError')?.classList.add('hidden');
        }
    });
    
    // Initialisation
    document.addEventListener('DOMContentLoaded', () => {
        initMap();
        setupGeoListeners();
        updateLength(2);
        switchMode('local');
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/dashboard/ai/create.blade.php ENDPATH**/ ?>