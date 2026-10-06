<?php

declare(strict_types=1);
?>
<!-- Hero Section -->
<section class="daya-hero-section" id="top">
    <div class="site-container daya-hero-container">
        <!-- Hero Text Content -->
        <div class="daya-hero__content">
            <h1 class="daya-hero__title">
                <span class="daya-hero__title-main"><?= e($hero['headline_main']) ?></span>
                <span class="daya-hero__title-accent">
                    <?= e($hero['headline_accent']) ?>
                    <svg class="daya-hero__swoosh" viewBox="0 0 160 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M2 13C45 4 115 4 158 13" stroke="url(#swoosh-gradient)" stroke-width="4" stroke-linecap="round"/>
                        <defs>
                            <linearGradient id="swoosh-gradient" x1="2" y1="8" x2="158" y2="8" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#8B5CF6"/>
                                <stop offset="1" stop-color="#C084FC"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </span>
            </h1>

            <p class="daya-hero__description"><?= e($hero['description']) ?></p>

            <div class="daya-hero__actions">
                <a href="<?= e($hero['primary_cta']['url']) ?>" class="btn btn--primary btn--glow">
                    <?= e($hero['primary_cta']['label']) ?>
                </a>
                <a href="<?= e($hero['secondary_cta']['url']) ?>" class="btn btn--secondary daya-glass--css">
                    <?= e($hero['secondary_cta']['label']) ?>
                </a>
            </div>
        </div>

        <!-- Hero Visual Mockup / Interactive Media -->
        <div class="daya-hero__visual">
            <div class="daya-hero-stack" aria-hidden="true">
                <div class="daya-hero-card daya-hero-card--back"></div>
                <div class="daya-hero-card daya-hero-card--mid"></div>
                <div class="daya-hero-card daya-hero-card--front">
                    <button class="daya-hero-media" type="button" aria-label="پخش ویدیوی نمونه کار" aria-pressed="false">
                        <img class="daya-hero-media__poster" src="<?= asset('images/hero/aria-hero-video-poster.png') ?>" alt="آریا رضوی در حال طراحی محصول" width="1920" height="1080" fetchpriority="high">
                        <video class="daya-hero-media__video" src="<?= asset('videos/hero-static-ui-motion.mp4') ?>" poster="<?= asset('images/hero/aria-hero-video-poster.png') ?>" muted loop playsinline preload="metadata"></video>
                        <span class="daya-hero-media__play-badge" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Brands Section -->
<section class="daya-brands-section" aria-label="برندهای همکار">
    <div class="site-container daya-brands-container">
        <div class="daya-brands__header">
            <span class="badge badge--pill"><?= e($brands['caption_title']) ?></span>
            <p class="daya-brands__sub"><?= e($brands['caption_subtitle']) ?></p>
        </div>

        <div class="daya-brands__marquee">
            <div class="daya-brands__track">
                <?php foreach ($brands['items'] as $brand): ?>
                    <span class="daya-brand-item"><?= e($brand['name']) ?></span>
                <?php endforeach; ?>
                <!-- Duplicate for seamless loop -->
                <?php foreach ($brands['items'] as $brand): ?>
                    <span class="daya-brand-item" aria-hidden="true"><?= e($brand['name']) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="daya-about-section" id="about">
    <div class="site-container daya-about-container">
        <div class="daya-section-heading">
            <span class="badge"><?= e($about['badge']) ?></span>
            <h2 class="daya-section-title"><?= e($about['title']) ?></h2>
        </div>
        <div class="daya-about__card daya-glass--css">
            <p class="daya-about__text"><?= e($about['content']) ?></p>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="daya-services-section" id="services">
    <div class="site-container daya-services-container">
        <div class="daya-section-heading">
            <span class="badge"><?= e($services['badge']) ?></span>
            <h2 class="daya-section-title"><?= e($services['title']) ?></h2>
        </div>

        <div class="daya-services-grid">
            <?php foreach ($services['items'] as $service): ?>
                <article class="daya-service-card daya-glass" id="<?= e($service['id']) ?>">
                    <div class="daya-service-card__icon-wrap">
                        <img src="<?= asset($service['icon_orb']) ?>" alt="" class="daya-service-card__orb" aria-hidden="true">
                        <img src="<?= asset($service['icon_glyph']) ?>" alt="" class="daya-service-card__glyph" aria-hidden="true">
                    </div>
                    <h3 class="daya-service-card__title"><?= e($service['title']) ?></h3>
                    <p class="daya-service-card__desc"><?= e($service['description']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section class="daya-portfolio-section" id="work">
    <div class="site-container daya-portfolio-container">
        <div class="daya-section-heading">
            <span class="badge"><?= e($projects['badge']) ?></span>
            <h2 class="daya-section-title"><?= e($projects['title']) ?></h2>
        </div>

        <div class="daya-portfolio-bento">
            <?php foreach ($projects['items'] as $project): ?>
                <?php if ($project['variant'] === 'view-all'): ?>
                    <a href="#contact" class="daya-portfolio-card daya-portfolio-card--view-all daya-glass--css">
                        <div class="daya-portfolio-card__all-content">
                            <span><?= e($project['name']) ?></span>
                            <img src="<?= asset('images/portfolio/chevron-left.svg') ?>" alt="" class="daya-portfolio-card__all-icon" aria-hidden="true">
                        </div>
                    </a>
                <?php else: ?>
                    <article class="daya-portfolio-card daya-portfolio-card--<?= e($project['variant']) ?> daya-glass--css">
                        <?php if (!empty($project['image'])): ?>
                            <div class="daya-portfolio-card__media">
                                <img src="<?= asset($project['image']) ?>" alt="<?= e($project['name']) ?>" loading="lazy">
                            </div>
                        <?php endif; ?>

                        <div class="daya-portfolio-card__footer">
                            <span class="daya-portfolio-card__name"><?= e($project['name']) ?></span>
                            <?php if ($project['action']): ?>
                                <a href="#contact" class="daya-portfolio-card__action-btn" aria-label="مشاهده پروژه <?= e($project['name']) ?>">
                                    <span>مشاهده</span>
                                    <img src="<?= asset('images/portfolio/arrow-left.svg') ?>" alt="" aria-hidden="true">
                                </a>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
