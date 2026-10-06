<?php

declare(strict_types=1);

use App\Core\View;
?>
<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? 'دایا استودیو — آریا رضوی') ?></title>
    <meta name="description" content="<?= e($meta_description ?? 'پورتفولیو اختصاصی آریا رضوی، طراح محصول') ?>">

    <!-- Preconnect & Persian Typography (Vazirmatn) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= asset('css/variables.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/base.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/daya-glass.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/components.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/layout.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/home.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/responsive.css') ?>">
</head>
<body class="site-body">
    <!-- Ambient Background Glows -->
    <div class="site-glow site-glow--top" aria-hidden="true"></div>
    <div class="site-glow site-glow--hero" aria-hidden="true"></div>

    <!-- Reusable Shared Header -->
    <?php View::component('header'); ?>

    <!-- Main Content Injected by Feature Views -->
    <main id="main-content" class="site-main">
        <?= $content ?? '' ?>
    </main>

    <!-- Reusable Shared Footer -->
    <?php View::component('footer'); ?>

    <!-- Scripts -->
    <script src="<?= asset('js/app.js') ?>"></script>
    <script src="<?= asset('js/hero.js') ?>"></script>
</body>
</html>
