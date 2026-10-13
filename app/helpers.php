<?php

if (!function_exists('clean_content')) {
    function clean_content($content)
    {
        try {
            $cleaner = app(\App\Services\ContentCleanerService::class);
            return $cleaner->clean($content);
        } catch (\Exception $e) {
            return $content;
        }
    }
}

if (!function_exists('clean_title')) {
    function clean_title($title)
    {
        try {
            $cleaner = app(\App\Services\ContentCleanerService::class);
            return $cleaner->cleanTitle($title);
        } catch (\Exception $e) {
            return $title;
        }
    }
}

if (!function_exists('clean_meta')) {
    function clean_meta($meta)
    {
        try {
            $cleaner = app(\App\Services\ContentCleanerService::class);
            return $cleaner->cleanMetaDescription($meta);
        } catch (\Exception $e) {
            return $meta;
        }
    }
}

if (!function_exists('clean_meta_description')) {
    function clean_meta_description($description)
    {
        try {
            $cleaner = app(\App\Services\ContentCleanerService::class);
            return $cleaner->cleanMetaDescription($description);
        } catch (\Exception $e) {
            return $description;
        }
    }
}

