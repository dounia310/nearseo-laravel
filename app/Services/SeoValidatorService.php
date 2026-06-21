<?php

namespace App\Services;

class SeoValidatorService
{

    /**
     * Valider et corriger un article généré (HTML Editor.js / HTML).
     *
     * @param array{title:string,content:string,meta_description:?string,focus_keyword:?string} $article
     * @return array{title:string,content:string,meta_description:string,focus_keyword:string,corrections_appliquees:bool}
     */
    public function validateAndFix(array $article): array
    {
        $originalTitle = (string)($article['title'] ?? '');
        $content = (string)($article['content'] ?? '');
        $meta = (string)($article['meta_description'] ?? '');
        $focusKeyword = trim((string)($article['focus_keyword'] ?? ''));

        if ($focusKeyword === '') {
            $focusKeyword = $this->guessKeywordFromTitle($originalTitle) ?: 'mot-clé';
        }

        $corrections = false;

        $fixedTitle = $this->fixTitle($originalTitle, $focusKeyword, $corrections);
        $fixedMeta = $this->fixMetaDescription($meta, $fixedTitle, $focusKeyword, $corrections);
        $fixedContent = $this->ensureKeywordInContent($content, $fixedTitle, $fixedMeta, $focusKeyword, $corrections);
        $fixedContent = $this->ensureHeadings($fixedContent, $focusKeyword, $corrections);
        $fixedContent = $this->ensureImages($fixedContent, $focusKeyword, $corrections);

        return [
            'title' => $fixedTitle,
            'content' => $fixedContent,
            'meta_description' => $fixedMeta,
            'focus_keyword' => $focusKeyword,
            'corrections_appliquees' => $corrections,
        ];
    }

    private function guessKeywordFromTitle(string $title): ?string
    {
        $title = trim($title);
        if ($title === '') return null;
        $words = preg_split('/\s+/u', strip_tags($title), -1, PREG_SPLIT_NO_EMPTY);
        return $words[0] ?? null;
    }

    private function normalizeSpaces(string $s): string
    {
        return trim(preg_replace('/\s+/u', ' ', $s));
    }

    private function fixTitle(string $title, string $keyword, bool &$corrections): string
    {
        $title = $this->normalizeSpaces($title);

        if ($title === '') {
            $corrections = true;
            return "Découvrez {$keyword} : guide complet";
        }

        if (stripos($title, $keyword) === false) {
            $corrections = true;
            $title = "{$keyword} : {$title}";
        }

        $max = 60;
        if (mb_strlen($title, 'UTF-8') > $max) {
            $corrections = true;
            $truncated = mb_substr($title, 0, $max, 'UTF-8');
            $truncated = preg_replace('/\s+\S*$/u', '', $truncated);
            $title = $this->normalizeSpaces($truncated);
        }

        if (stripos($title, $keyword) === false) {
            $corrections = true;
            $title = $keyword . ' - ' . $this->truncateWords($title, 8);
        }

        // final clamp if still too long
        if (mb_strlen($title, 'UTF-8') > $max) {
            $corrections = true;
            $title = rtrim(mb_substr($title, 0, $max, 'UTF-8'));
        }

        return $title;
    }

    private function truncateWords(string $text, int $maxWords): string
    {
        $text = $this->normalizeSpaces(strip_tags($text));
        $words = preg_split('/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY);
        if (!$words) return '';
        $words = array_slice($words, 0, $maxWords);
        return implode(' ', $words);
    }

    private function fixMetaDescription(string $meta, string $title, string $keyword, bool &$corrections): string
    {
        $meta = $this->normalizeSpaces(strip_tags($meta));

        $min = 120;
        $max = 160;

        if ($meta === '' || mb_strlen($meta, 'UTF-8') < $min || mb_strlen($meta, 'UTF-8') > $max || stripos($meta, $keyword) === false) {
            $corrections = true;
            $base = "Découvrez {$keyword} : {$title}.";
            $base = preg_replace('/\s+/u', ' ', $base);

            if (mb_strlen($base, 'UTF-8') > $max) {
                $base = mb_substr($base, 0, $max, 'UTF-8');
                $base = preg_replace('/\s+\S*$/u', '', $base);
                $base = rtrim($base);
            }

            if (stripos($base, $keyword) === false) {
                $base = "Découvrez {$keyword} et profitez de nos conseils";
            }

            if (mb_strlen($base, 'UTF-8') < $min) {
                $base .= ' Astuce pratique et informations essentielles.';
                if (mb_strlen($base, 'UTF-8') > $max) {
                    $base = mb_substr($base, 0, $max, 'UTF-8');
                    $base = preg_replace('/\s+\S*$/u', '', $base);
                    $base = rtrim($base);
                }
            }

            $meta = $base;
        }

        if (mb_strlen($meta, 'UTF-8') > $max) {
            $corrections = true;
            $meta = mb_substr($meta, 0, $max, 'UTF-8');
            $meta = preg_replace('/\s+\S*$/u', '', $meta);
            $meta = rtrim($meta);
        }

        return $meta;
    }

    private function ensureKeywordInContent(string $content, string $title, string $meta, string $keyword, bool &$corrections): string
    {
        $fixed = $content;

        // Update meta block if present
        if (preg_match('/<div class="meta">(.*?)<\/div>/si', $fixed, $m)) {
            $innerNew = $m[1];

            $innerNew = preg_replace(
                '/(<p><strong>Meta description\s*:<\/strong>\s*)(.*?)(<\/p>)/is',
                '$1' . htmlspecialchars($meta, ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8') . '$3',
                $innerNew
            );

            $innerNew = preg_replace(
                '/(<p><strong>Mot-clé principal\s*:<\/strong>\s*)(.*?)(<\/p>)/is',
                '$1' . htmlspecialchars($keyword, ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8') . '$3',
                $innerNew
            );

            $fixed = preg_replace('/<div class="meta">.*?<\/div>/si', '<div class="meta">' . $innerNew . '</div>', $fixed, 1);
            $corrections = true;
        }

        // Ensure H1 contains keyword
        if (preg_match('/<h1[^>]*>.*?<\/h1>/si', $fixed)) {
            $fixed = preg_replace(
                '/<h1[^>]*>.*?<\/h1>/si',
                '<h1>' . htmlspecialchars($title, ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</h1>',
                $fixed,
                1
            );
        } else {
            $corrections = true;
            $fixed = '<h1>' . htmlspecialchars($title, ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</h1>' . "\n" . $fixed;
        }

        // Ensure keyword in first paragraph visible text
        $text = strip_tags($fixed);
        $firstChunk = mb_substr($text, 0, 220, 'UTF-8');
        if (stripos($firstChunk, $keyword) === false) {
            $corrections = true;
            if (preg_match('/<p[^>]*>(.*?)<\/p>/is', $fixed, $p)) {
                $orig = $p[1];
                $replacement = '<p>' . htmlspecialchars($keyword, ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8') . ' : ' . $orig . '</p>';
                $fixed = preg_replace('/<p[^>]*>.*?<\/p>/is', $replacement, $fixed, 1);
            }
        }

        // Ensure keyword appears somewhere
        if (stripos(strip_tags($fixed), $keyword) === false) {
            $corrections = true;
            $fixed .= "\n<p><strong>{$keyword}</strong> : informations clés pour bien choisir.</p>";
        }

        return $fixed;
    }

    private function ensureHeadings(string $content, string $keyword, bool &$corrections): string
    {
        $fixed = $content;
        $h2Count = preg_match_all('/<h2\b/i', $fixed);
        $h3Count = preg_match_all('/<h3\b/i', $fixed);

        $needH2 = max(0, 3 - $h2Count);
        $needH3 = max(0, 2 - $h3Count);
        if ($needH2 === 0 && $needH3 === 0) return $fixed;

        $corrections = true;

        $insertPoint = null;
        if (preg_match('/<h2[^>]*id="conclusion"[^>]*>/i', $fixed, $m, PREG_OFFSET_CAPTURE)) {
            $insertPoint = $m[0][1];
        } elseif (preg_match('/<h2\b/i', $fixed, $m, PREG_OFFSET_CAPTURE)) {
            $insertPoint = $m[0][1];
        }

        $blocks = '';
        for ($i = 0; $i < $needH2; $i++) {
            $blocks .= "\n<h2 id=\"section-extra-{$i}\">" . htmlspecialchars($keyword, ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8') . " : conseils et bénéfices</h2>\n";
            $blocks .= '<p>' . htmlspecialchars($keyword, ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8') . ' vous aide à choisir la bonne approche : priorisez la qualité, la proximité et une expérience client mémorable.</p>\n';

            if ($needH3 > 0) {
                $blocks .= "<h3>Étape clé pour optimiser</h3>\n";
                $blocks .= '<p>Un plan simple : identifiez votre besoin, intégrez le mot-clé et structurez votre contenu pour améliorer la pertinence.</p>\n';
                $needH3--;
            }
        }

        if ($needH3 > 0) {
            $blocks .= "\n<h3>Bonnes pratiques supplémentaires</h3>\n";
            $blocks .= '<p>Ajoutez des exemples concrets, renforcez la cohérence du ton et assurez-vous que chaque section répond à une intention de recherche.</p>\n';
        }

        if ($insertPoint !== null) {
            $fixed = substr($fixed, 0, $insertPoint) . $blocks . substr($fixed, $insertPoint);
        } else {
            $fixed .= $blocks;
        }

        return $fixed;
    }

    private function ensureImages(string $content, string $keyword, bool &$corrections): string
    {
        $fixed = $content;
        $imgCount = preg_match_all('/<img\b/i', $fixed);
        if ($imgCount >= 3) return $fixed;

        $corrections = true;
        $need = 3 - $imgCount;

        $altKeyword = htmlspecialchars($keyword, ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $placeholders = '';
        for ($i = 0; $i < $need; $i++) {
            $placeholders .= "\n<p><img src=\"https://via.placeholder.com/900x500.png?text=" . $this->slugify($keyword) . "\" alt=\"{$altKeyword} - image illustratrice\" /></p>\n";
        }

        if (preg_match('/<h2\b[^>]*>/i', $fixed, $m, PREG_OFFSET_CAPTURE)) {
            $pos = $m[0][1];
            if (preg_match('/<h2\b[^>]*>.*?<\/h2>.*?(<\/p>)/is', $fixed, $p, PREG_OFFSET_CAPTURE)) {
                $end = $p[0][1] + strlen($p[0][0]);
                $fixed = substr($fixed, 0, $end) . $placeholders . substr($fixed, $end);
            } else {
                $fixed = substr($fixed, 0, $pos) . $placeholders . substr($fixed, $pos);
            }
        } else {
            $fixed = $placeholders . $fixed;
        }

        return $fixed;
    }

    private function slugify(string $s): string
    {
        $s = trim($s);
        $s = mb_strtolower($s, 'UTF-8');
        $s = preg_replace('/[^\p{L}\p{N}]+/u', '-', $s);
        $s = trim($s, '-');
        return $s ?: 'mot-cle-principal';
    }
}
