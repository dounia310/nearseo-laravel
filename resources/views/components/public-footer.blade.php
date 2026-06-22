<footer class="bg-surface-container-lowest w-full py-section-margin border-t border-outline-variant/30">
    <div class="max-w-container-max-width mx-auto px-gutter">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-stack-gap-md mb-12">
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('logo.png') }}" alt="NEARSEO Logo" class="h-12 w-auto" onerror="this.src='{{ asset('images/logo.png') }}'">
                </div>
                <p class="font-body-sm text-on-surface-variant max-w-[200px]">Votre agent SEO local au Maroc.</p>
            </div>

            <div class="flex flex-col gap-4">
                <h5 class="font-label text-primary uppercase">Produit</h5>
                <nav class="flex flex-col gap-2">
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#features">Fonctionnalités</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#pricing">Tarifs</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#">Nouveautés</a>
                </nav>
            </div>

            <div class="flex flex-col gap-4">
                <h5 class="font-label text-primary uppercase">Ressources</h5>
                <nav class="flex flex-col gap-2">
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="{{ route('community') }}">Communauté</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#">Guides SEO</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#">Documentation</a>
                </nav>
            </div>

            <div class="flex flex-col gap-4">
                <h5 class="font-label text-primary uppercase">Contact</h5>
                <nav class="flex flex-col gap-2">
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#">Support</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#">Partenaires</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#">Sales</a>
                </nav>
            </div>
        </div>

        <div class="pt-8 border-t border-outline-variant/20 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="font-body-sm text-on-surface-variant text-center">© {{ date('Y') }} NEARSEO. Votre agent SEO local au Maroc.</p>
            <div class="flex gap-6">
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#"><span class="material-symbols-outlined">language</span></a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#"><span class="material-symbols-outlined">share</span></a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#"><span class="material-symbols-outlined">policy</span></a>
            </div>
        </div>
    </div>
</footer>

