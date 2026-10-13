<?php

namespace App\Services;

class ContentCleanerService
{
    /**
     * Nettoyer complètement le contenu HTML
     * ✅ PRÉSERVE LA STRUCTURE (h1, h2, h3, p, ul, ol, li, strong, em, a, img)
     */
    public function clean(string $content): string
    {
        if (empty($content)) {
            return '';
        }

        // 1. Corriger les apostrophes
        $content = $this->fixApostrophes($content);
        
        // 2. Corriger les guillemets
        $content = $this->fixQuotes($content);
        
        // 3. Supprimer les caractères invisibles
        $content = $this->removeInvisibleChars($content);
        
        // 4. Supprimer les balises vides
        $content = $this->removeEmptyTags($content);
        
        // 5. Corriger les coupures de mots
        $content = $this->fixWordBreaks($content);
        
        // 6. Nettoyer les espaces SANS casser la structure
        $content = $this->cleanSpaces($content);
        
        return trim($content);
    }

    /**
     * Corriger les apostrophes mal encodées
     */
    private function fixApostrophes(string $content): string
    {
        // Remplacer les apostrophes droites par des courbes (typographie française)
        $content = str_replace("'", "'", $content);
        
        return $content;
    }

    /**
     * Supprimer les caractères invisibles
     */
    private function removeInvisibleChars(string $content): string
    {
        // Supprimer les caractères de contrôle
        $content = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $content);
        
        // Supprimer les caractères Unicode invisibles
        $content = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $content);
        
        // Remplacer les espaces insécables par des espaces normaux
        $content = str_replace("\xc2\xa0", ' ', $content);
        
        return $content;
    }

    /**
     * ✅ Nettoyer les espaces SANS casser les balises HTML
     */
    private function cleanSpaces(string $content): string
    {
        // ✅ Supprimer uniquement les espaces multiples ENTRE les balises
        $content = preg_replace('/>\s+</', '><', $content);
        
        // ✅ Supprimer les espaces en début/fin de ligne
        $lines = explode("\n", $content);
        $lines = array_map('trim', $lines);
        $content = implode("\n", $lines);
        
        // ✅ Supprimer les lignes vides multiples
        $content = preg_replace('/\n{3,}/', "\n\n", $content);
        
        return $content;
    }

    /**
     * Corriger les guillemets
     */
    private function fixQuotes(string $content): string
    {
        $content = str_replace('"', '"', $content);
        $content = str_replace('"', '"', $content);
        
        return $content;
    }

    /**
     * ✅ Supprimer SEULEMENT les balises vraiment vides
     */
    private function removeEmptyTags(string $content): string
    {
        // Supprimer les balises vides : <p></p>, <h1></h1>, <div></div>, etc.
        $content = preg_replace('/<([a-z][a-z0-9]*)[^>]*>\s*<\/\1>/i', '', $content);
        
        return $content;
    }

    /**
     * Corriger les coupures de mots
     */
    private function fixWordBreaks(string $content): string
    {
        $content = str_replace("l'", "l'", $content);
        $content = str_replace("d'", "d'", $content);
        $content = str_replace("n'", "n'", $content);
        $content = str_replace("c'", "c'", $content);
        $content = str_replace("j'", "j'", $content);
        $content = str_replace("m'", "m'", $content);
        $content = str_replace("t'", "t'", $content);
        $content = str_replace("s'", "s'", $content);
        $content = str_replace("qu'", "qu'", $content);
        
        return $content;
    }

    /**
     * ✅ Troncature intelligente d'un titre (coupe au mot, jamais en plein milieu)
     */
    public function cleanTitle(string $title): string
    {
        if (empty($title)) {
            return '';
        }
        
        $title = strip_tags($title);
        $title = $this->removeInvisibleChars($title);
        $title = trim(preg_replace('/\s+/', ' ', $title));
        
        // ✅ Troncature intelligente : on coupe au mot, jamais au milieu
        if (mb_strlen($title) > 60) {
            $truncated = mb_substr($title, 0, 60);
            
            // Couper au dernier espace
            $lastSpace = mb_strrpos($truncated, ' ');
            if ($lastSpace !== false && $lastSpace > 40) {
                $title = mb_substr($truncated, 0, $lastSpace);
            } else {
                $title = $truncated;
            }
            
            // Nettoyer la fin
            $title = rtrim($title, ' .,;:!?-—–');
        }
        
        return $title;
    }

    /**
     * ✅ Troncature intelligente d'une meta description (coupe à la phrase ou au mot)
     */
    public function cleanMetaDescription(string $description): string
    {
        if (empty($description)) {
            return '';
        }
        
        $description = strip_tags($description);
        $description = $this->removeInvisibleChars($description);
        $description = trim(preg_replace('/\s+/', ' ', $description));
        
        // ✅ Troncature intelligente
        if (mb_strlen($description) > 160) {
            $truncated = mb_substr($description, 0, 160);
            
            // 1. Essayer de couper à la dernière phrase complète
            $lastDot = mb_strrpos($truncated, '.');
            if ($lastDot !== false && $lastDot > 120) {
                $description = mb_substr($description, 0, $lastDot + 1);
            } else {
                // 2. Sinon couper au dernier espace
                $lastSpace = mb_strrpos($truncated, ' ');
                if ($lastSpace !== false && $lastSpace > 130) {
                    $description = mb_substr($truncated, 0, $lastSpace);
                } else {
                    $description = $truncated;
                }
                
                // Nettoyer la fin
                $description = rtrim($description, ' .,;:!?-—–');
                $description .= '.';
            }
        }
        
        return $description;
    }
}