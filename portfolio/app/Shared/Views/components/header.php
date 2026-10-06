<?php

declare(strict_types=1);
?>
<header class="site-header" id="site-header">
    <div class="site-header__container">
        <!-- Brand Logo -->
        <a class="site-header__brand" href="#top" aria-label="دایا استودیو - خانه">
            <img src="<?= asset('images/brand/daya-logo.svg') ?>" alt="لوگوی دایا استودیو" class="site-header__logo-mark" width="48" height="32">
            <span class="site-header__brand-text">دایا استودیو</span>
        </a>

        <!-- Navigation Links -->
        <nav class="site-header__nav" aria-label="ناوبری اصلی سایت">
            <ul class="site-header__menu">
                <li><a href="#top" class="site-header__link is-active">خانه</a></li>
                <li><a href="#work" class="site-header__link">پورتفولیو</a></li>
                <li><a href="#services" class="site-header__link">خدمات</a></li>
                <li><a href="#about" class="site-header__link">درباره ما</a></li>
            </ul>
        </nav>

        <!-- CTA Action -->
        <div class="site-header__actions">
            <a href="#contact" class="btn btn--primary btn--header">شروع همکاری</a>
        </div>
    </div>
</header>
