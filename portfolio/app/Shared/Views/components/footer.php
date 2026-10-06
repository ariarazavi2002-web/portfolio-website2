<?php

declare(strict_types=1);
?>
<footer class="site-footer" id="contact">
    <div class="site-footer__container">
        <div class="site-footer__top">
            <div class="site-footer__brand-block">
                <a href="#top" class="site-footer__logo">
                    <img src="<?= asset('images/brand/daya-logo.svg') ?>" alt="لوگوی دایا استودیو" width="48" height="32">
                    <span>دایا استودیو</span>
                </a>
                <p class="site-footer__tagline">خلق تجربه‌های دیجیتال هدفمند و رابط‌های کاربری چشم‌نواز.</p>
            </div>
            <div class="site-footer__links-block">
                <h4 class="site-footer__heading">دسترسی سریع</h4>
                <ul>
                    <li><a href="#top">صفحه نخست</a></li>
                    <li><a href="#about">درباره ما</a></li>
                    <li><a href="#services">خدمات تخصصی</a></li>
                    <li><a href="#work">نمونه کارها</a></li>
                </ul>
            </div>
            <div class="site-footer__contact-block">
                <h4 class="site-footer__heading">ارتباط با ما</h4>
                <a href="mailto:hello@aria.design" class="site-footer__email">hello@aria.design</a>
                <div class="site-footer__socials">
                    <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">لینکدین</a>
                    <a href="https://behance.net" target="_blank" rel="noopener noreferrer" aria-label="Behance">بیهنس</a>
                    <a href="https://dribbble.com" target="_blank" rel="noopener noreferrer" aria-label="Dribbble">دریبل</a>
                </div>
            </div>
        </div>
        <div class="site-footer__bottom">
            <p class="site-footer__copy">© <?= date('Y') ?> دایا استودیو (آریا رضوی). تمامی حقوق محفوظ است.</p>
        </div>
    </div>
</footer>
