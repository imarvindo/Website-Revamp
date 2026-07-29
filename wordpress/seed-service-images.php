<?php
/**
 * Inject 3 relevant Unsplash images into each service page's post_content
 * at strategic positions (top hero, mid, lower section).
 *
 * Run: php wp-cli.phar --path=wordpress eval-file wordpress/seed-service-images.php
 */

$services = [
    13 => [ // SEO
        'slug'   => 'search-engine-optimization',
        'images' => [
            ['url' => 'https://images.unsplash.com/photo-1562577309-4932fdd64cd1?w=1200&q=80&auto=format&fit=crop', 'alt' => 'SEO strategy and keyword research — Dubai SEO agency'],
            ['url' => 'https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?w=1100&q=80&auto=format&fit=crop', 'alt' => 'Google Analytics dashboard — SEO performance tracking UAE'],
            ['url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1100&q=80&auto=format&fit=crop', 'alt' => 'SEO link building and content strategy — SearchEngineOptimization.ae'],
        ],
        'insert_after' => [
            'Search Engine Optimization (SEO) is the discipline', // after intro
            'The Four Pillars of Our SEO Service',                 // mid content
            'Link Building',                                        // lower section
        ],
    ],
    14 => [ // AI Search
        'slug'   => 'ai-search-optimization',
        'images' => [
            ['url' => 'https://images.unsplash.com/photo-1677442135703-1787eea5ce01?w=1200&q=80&auto=format&fit=crop', 'alt' => 'AI search optimisation — ChatGPT and Google AI Overviews strategy'],
            ['url' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=1100&q=80&auto=format&fit=crop', 'alt' => 'Generative Engine Optimisation — GEO strategy for UAE businesses'],
            ['url' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=1100&q=80&auto=format&fit=crop', 'alt' => 'AI search landscape — Perplexity, Gemini, ChatGPT for Dubai brands'],
        ],
        'insert_after' => [
            'The Rise of AI Search',
            'Our AI Search Optimisation',
            'Structured Data',
        ],
    ],
    15 => [ // PPC
        'slug'   => 'ppc-management',
        'images' => [
            ['url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1200&q=80&auto=format&fit=crop', 'alt' => 'PPC Google Ads management Dubai — paid search campaigns UAE'],
            ['url' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=1100&q=80&auto=format&fit=crop', 'alt' => 'Google Ads performance dashboard — PPC agency Dubai'],
            ['url' => 'https://images.unsplash.com/photo-1579621970795-87facc2f976d?w=1100&q=80&auto=format&fit=crop', 'alt' => 'ROI-driven PPC campaigns — Google Ads management UAE'],
        ],
        'insert_after' => [
            'Pay-Per-Click',
            'Our PPC Management',
            'Conversion Rate',
        ],
    ],
    16 => [ // Social Media
        'slug'   => 'social-media-marketing',
        'images' => [
            ['url' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?w=1200&q=80&auto=format&fit=crop', 'alt' => 'Social media marketing Dubai — Instagram Facebook LinkedIn strategy'],
            ['url' => 'https://images.unsplash.com/photo-1432888622747-4eb9a8efeb07?w=1100&q=80&auto=format&fit=crop', 'alt' => 'Social media content creation — UAE digital marketing agency'],
            ['url' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1100&q=80&auto=format&fit=crop', 'alt' => 'Social media analytics and growth — SearchEngineOptimization.ae Dubai'],
        ],
        'insert_after' => [
            'Social Media Marketing',
            'Our Social Media',
            'Content Strategy',
        ],
    ],
    17 => [ // Web Design
        'slug'   => 'web-design',
        'images' => [
            ['url' => 'https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?w=1200&q=80&auto=format&fit=crop', 'alt' => 'Web design Dubai — conversion-optimised website design UAE'],
            ['url' => 'https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?w=1100&q=80&auto=format&fit=crop', 'alt' => 'UI/UX design process — Dubai web design agency'],
            ['url' => 'https://images.unsplash.com/photo-1558655146-d09347e92766?w=1100&q=80&auto=format&fit=crop', 'alt' => 'Mobile-responsive web design — SearchEngineOptimization.ae'],
        ],
        'insert_after' => [
            'Web Design',
            'Our Web Design',
            'Mobile',
        ],
    ],
    18 => [ // Web Dev
        'slug'   => 'web-development',
        'images' => [
            ['url' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=1200&q=80&auto=format&fit=crop', 'alt' => 'Web development Dubai — WordPress React custom builds UAE'],
            ['url' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=1100&q=80&auto=format&fit=crop', 'alt' => 'Custom web development — Dubai development agency'],
            ['url' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=1100&q=80&auto=format&fit=crop', 'alt' => 'Full-stack web development — SearchEngineOptimization.ae'],
        ],
        'insert_after' => [
            'Web Development',
            'Our Development',
            'WordPress',
        ],
    ],
];

foreach ($services as $post_id => $data) {
    $post = get_post($post_id);
    if (!$post) {
        echo "❌  Post $post_id not found\n";
        continue;
    }

    $content = $post->post_content;

    // Remove any previously injected images (avoid duplicates on re-run)
    $content = preg_replace('/<img[^>]+images\.unsplash\.com[^>]+>\s*/i', '', $content);
    $content = preg_replace('/<figure[^>]*>\s*<img[^>]+images\.unsplash\.com[^>]+>.*?<\/figure>\s*/is', '', $content);

    $img_html = [];
    foreach ($data['images'] as $idx => $img) {
        $style = $idx === 0
            ? 'width:100%;border-radius:16px;margin:0 0 2rem;aspect-ratio:16/7;object-fit:cover;'
            : 'width:100%;border-radius:12px;margin:2rem 0;aspect-ratio:16/7;object-fit:cover;';
        $img_html[] = '<img src="' . esc_url($img['url']) . '" alt="' . esc_attr($img['alt']) . '" style="' . $style . '" loading="lazy">';
    }

    // Insert hero image at the very top of content
    $content = $img_html[0] . "\n\n" . $content;

    // Insert image 2 after first <h2>
    $content = preg_replace('/<\/h2>/', "</h2>\n\n" . $img_html[1], $content, 1);

    // Insert image 3 after the third <h2> (or second if <3 exist)
    $h2_count = preg_match_all('/<\/h2>/', $content);
    $target   = min(3, max(2, (int)($h2_count / 2)));
    $found    = 0;
    $content  = preg_replace_callback('/<\/h2>/', function($m) use (&$found, $target, $img_html) {
        $found++;
        if ($found === $target) {
            return "</h2>\n\n" . $img_html[2];
        }
        return $m[0];
    }, $content);

    wp_update_post([
        'ID'           => $post_id,
        'post_content' => $content,
    ]);

    // Confirm image count in saved content
    $saved   = get_post($post_id)->post_content;
    $img_cnt = substr_count($saved, 'images.unsplash.com');
    $word_ct = str_word_count(wp_strip_all_tags($saved));

    echo "✅  ID $post_id | {$data['slug']} | images: $img_cnt | words: ~$word_ct\n";
}

echo "\n🎉  Service page images injected successfully.\n";
