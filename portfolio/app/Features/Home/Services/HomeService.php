<?php

declare(strict_types=1);

namespace App\Features\Home\Services;

final class HomeService
{
    /**
     * Retrieve all data required for rendering the Home page.
     *
     * @return array<string, mixed>
     */
    public function getHomeData(): array
    {
        return [
            'title' => 'دایا استودیو — آریا رضوی | طراح محصول',
            'meta_description' => 'پورتفولیو اختصاصی آریا رضوی، طراح محصول و رابط کاربری استودیو خلاق دایا. ارائه دهنده راهکارهای نوآورانه طراحی محصول، تجربه کاربری و سیستم‌های دیزاین.',
            'hero' => [
                'headline_main' => 'خلاقیت را احساس کنید',
                'headline_accent' => 'مثل یک حرفه ای',
                'description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.',
                'primary_cta' => [
                    'label' => 'درخواست مشاوره',
                    'url' => '#contact',
                ],
                'secondary_cta' => [
                    'label' => 'نمونه کار ها',
                    'url' => '#work',
                ],
                'video_poster' => 'assets/images/hero/aria-hero-video-poster.png',
                'video_source' => 'assets/videos/hero-static-ui-motion.mp4',
            ],
            'brands' => [
                'caption_title' => 'همکاران ما',
                'caption_subtitle' => 'برندهایی که به ما اعتماد کردند',
                'items' => [
                    ['name' => 'digikala', 'label' => 'Digikala'],
                    ['name' => 'Snapp!', 'label' => 'Snapp'],
                    ['name' => 'digikala', 'label' => 'Digikala'],
                    ['name' => 'Snapp!', 'label' => 'Snapp'],
                    ['name' => 'digikala', 'label' => 'Digikala'],
                    ['name' => 'Snapp!', 'label' => 'Snapp'],
                    ['name' => 'digikala', 'label' => 'Digikala'],
                ],
            ],
            'about' => [
                'badge' => 'درباره ما',
                'title' => 'ما کی هستیم؟',
                'content' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی.',
            ],
            'services' => [
                'badge' => 'خدمات ما',
                'title' => 'دایا چه خدماتی را ارائه می دهد؟',
                'items' => [
                    [
                        'id' => 'service-ui-1',
                        'title' => 'طراحی UI',
                        'description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است',
                        'icon_orb' => 'assets/images/services/service-orb.svg',
                        'icon_glyph' => 'assets/images/services/service-figma.svg',
                    ],
                    [
                        'id' => 'service-product',
                        'title' => 'طراحی محصول',
                        'description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است',
                        'icon_orb' => 'assets/images/services/service-orb.svg',
                        'icon_glyph' => 'assets/images/services/service-product.svg',
                    ],
                    [
                        'id' => 'service-ux',
                        'title' => 'طراحی UX',
                        'description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است',
                        'icon_orb' => 'assets/images/services/service-orb.svg',
                        'icon_glyph' => 'assets/images/services/service-ux.svg',
                    ],
                    [
                        'id' => 'service-ui-2',
                        'title' => 'طراحی UI',
                        'description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است',
                        'icon_orb' => 'assets/images/services/service-orb.svg',
                        'icon_glyph' => 'assets/images/services/service-figma-small.svg',
                    ],
                ],
            ],
            'projects' => [
                'badge' => 'نمونه کارها',
                'title' => 'با برخی از پروژه های ما آشنا شوید',
                'items' => [
                    [
                        'id' => 'project-car',
                        'name' => 'نام پروژه',
                        'variant' => 'tall',
                        'image' => 'assets/images/portfolio/figma-project-tall.png',
                        'action' => false,
                    ],
                    [
                        'id' => 'project-bermuda-1',
                        'name' => 'برمودا',
                        'variant' => 'medium',
                        'image' => 'assets/images/portfolio/figma-project-bermuda.png',
                        'action' => true,
                    ],
                    [
                        'id' => 'project-bermuda-2',
                        'name' => 'برمودا',
                        'variant' => 'medium',
                        'image' => 'assets/images/portfolio/figma-project-bermuda.png',
                        'action' => false,
                    ],
                    [
                        'id' => 'project-agency',
                        'name' => 'نام پروژه',
                        'variant' => 'wide',
                        'image' => 'assets/images/portfolio/figma-project-wide.png',
                        'action' => false,
                    ],
                    [
                        'id' => 'project-agency-bottom',
                        'name' => 'نام پروژه',
                        'variant' => 'wide-bottom',
                        'image' => 'assets/images/portfolio/figma-project-wide.png',
                        'action' => false,
                    ],
                    [
                        'id' => 'project-view-all',
                        'name' => 'مشاهده همه',
                        'variant' => 'view-all',
                        'image' => null,
                        'action' => false,
                    ],
                ],
            ],
            'contact' => [
                'email' => 'hello@aria.design',
                'headline' => 'بیایید چیزی ماندگار خلق کنیم',
            ],
        ];
    }
}
