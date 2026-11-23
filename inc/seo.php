<?php
/**
 * SEO and AEO: meta fields (editable via REST), titles, descriptions, Open Graph,
 * JSON-LD (Organization, WebSite, Service, FAQPage, BreadcrumbList, Article), robots.txt, llms.txt.
 */
if (!defined('ABSPATH')) exit;

add_action('init', function () {
    $fields = ['aicc_title', 'aicc_desc', 'aicc_h1', 'aicc_label', 'aicc_answer', 'aicc_og', 'aicc_noindex'];
    foreach (['page', 'post'] as $type) {
        foreach ($fields as $f) {
            register_post_meta($type, $f, [
                'type' => 'string', 'single' => true, 'show_in_rest' => true,
                'auth_callback' => function () { return current_user_can('edit_posts'); },
            ]);
        }
    }
});

/** One sentence used word for word everywhere (site, schema, llms.txt). */
function aicc_one_liner() {
    return 'AI Care Coordinator runs Advanced Primary Care Management (APCM) for primary care practices, fully automated: it finds eligible Medicare patients, enrolls them by phone with recorded consent, checks in every month, updates care plans, escalates red flags to clinicians and hands billing a monthly report for G0556, G0557 and G0558.';
}

function aicc_meta($key, $id = null) {
    $id = $id ?: get_queried_object_id();
    return $id ? trim((string) get_post_meta($id, $key, true)) : '';
}

function aicc_page_slug($id = null) {
    $id = $id ?: get_queried_object_id();
    if (is_front_page()) return 'home';
    $p = get_post($id);
    return $p ? $p->post_name : '';
}

add_filter('pre_get_document_title', function ($t) {
    if (is_singular() || is_front_page()) {
        $id = is_front_page() ? (int) get_option('page_on_front') : get_queried_object_id();
        $custom = aicc_meta('aicc_title', $id);
        if ($custom) return $custom;
    }
    if (is_home()) {
        $custom = aicc_meta('aicc_title', (int) get_option('page_for_posts'));
        if ($custom) return $custom;
    }
    return $t;
});
add_filter('document_title_separator', function () { return '|'; });

function aicc_description() {
    if (is_front_page()) return aicc_meta('aicc_desc', (int) get_option('page_on_front')) ?: aicc_one_liner();
    if (is_home()) return aicc_meta('aicc_desc', (int) get_option('page_for_posts'));
    if (is_singular()) {
        $d = aicc_meta('aicc_desc');
        if ($d) return $d;
        $p = get_post();
        return wp_trim_words(wp_strip_all_tags($p->post_excerpt ?: $p->post_content), 30, '…');
    }
    if (is_category()) return wp_strip_all_tags(category_description());
    return get_bloginfo('description');
}

function aicc_og_image() {
    $base = get_template_directory();
    $uri = get_template_directory_uri();
    if (is_singular()) {
        $custom = aicc_meta('aicc_og');
        if ($custom) return $custom;
        if (has_post_thumbnail()) return get_the_post_thumbnail_url(null, 'full');
    }
    $slug = is_home() ? 'guides' : aicc_page_slug();
    if ($slug && file_exists("$base/assets/img/og/$slug.jpg")) return "$uri/assets/img/og/$slug.jpg";
    return "$uri/assets/img/og/home.jpg";
}

function aicc_canonical() {
    if (is_front_page()) return home_url('/');
    if (is_singular()) return get_permalink();
    if (is_home()) return get_permalink((int) get_option('page_for_posts'));
    if (is_category()) return get_category_link(get_queried_object_id());
    return '';
}

add_action('wp_head', function () {
    $desc = esc_attr(aicc_description());
    $title = esc_attr(wp_get_document_title());
    $url = esc_url(aicc_canonical());
    $img = esc_url(aicc_og_image());
    $noindex = (is_singular() && aicc_meta('aicc_noindex')) || is_search() || is_404() || is_paged();
    echo "\n";
    if ($desc) echo "<meta name=\"description\" content=\"$desc\">\n";
    echo $noindex ? "<meta name=\"robots\" content=\"noindex,follow\">\n" : "<meta name=\"robots\" content=\"index,follow,max-image-preview:large,max-snippet:-1\">\n";
    if (!is_singular() && $url) echo "<link rel=\"canonical\" href=\"$url\">\n";
    echo "<meta property=\"og:site_name\" content=\"" . esc_attr(AICC_NAME) . "\">\n";
    echo "<meta property=\"og:type\" content=\"" . (is_singular('post') ? 'article' : 'website') . "\">\n";
    echo "<meta property=\"og:title\" content=\"$title\">\n";
    if ($desc) echo "<meta property=\"og:description\" content=\"$desc\">\n";
    if ($url) echo "<meta property=\"og:url\" content=\"$url\">\n";
    echo "<meta property=\"og:image\" content=\"$img\">\n<meta property=\"og:image:width\" content=\"1200\">\n<meta property=\"og:image:height\" content=\"630\">\n";
    echo "<meta name=\"twitter:card\" content=\"summary_large_image\">\n<meta name=\"twitter:title\" content=\"$title\">\n";
    if ($desc) echo "<meta name=\"twitter:description\" content=\"$desc\">\n";
    echo "<meta name=\"twitter:image\" content=\"$img\">\n";
    echo '<link rel="icon" href="' . esc_url(get_template_directory_uri() . '/assets/img/favicon.svg') . '" type="image/svg+xml">' . "\n";
    echo '<meta name="theme-color" content="#F8F8F5">' . "\n";
    aicc_schema();
}, 1);

/** Pull FAQs out of rendered HTML: <details><summary>Q</summary><div>A</div></details>. */
function aicc_extract_faqs($html) {
    $faqs = [];
    if (preg_match_all('#<details[^>]*>\s*<summary[^>]*>(.*?)</summary>\s*<div[^>]*>(.*?)</div>\s*</details>#si', $html, $m, PREG_SET_ORDER)) {
        foreach ($m as $row) {
            $faqs[] = [
                '@type' => 'Question',
                'name' => trim(wp_strip_all_tags($row[1])),
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => trim(preg_replace('/\s+/', ' ', wp_strip_all_tags($row[2])))],
            ];
        }
    }
    return $faqs;
}

function aicc_schema() {
    $home = home_url('/');
    $graph = [];
    $graph[] = [
        '@type' => 'Organization', '@id' => $home . '#org', 'name' => AICC_NAME, 'url' => $home,
        'logo' => get_template_directory_uri() . '/assets/img/logo-512.png',
        'description' => aicc_one_liner(),
    ];
    $graph[] = ['@type' => 'WebSite', '@id' => $home . '#website', 'name' => AICC_NAME, 'url' => $home, 'publisher' => ['@id' => $home . '#org']];

    if (is_front_page()) {
        $graph[] = [
            '@type' => 'Service', '@id' => $home . '#service', 'name' => 'Automated APCM program for primary care practices',
            'serviceType' => 'Care management outreach and documentation for APCM, CCM, TCM and RPM',
            'provider' => ['@id' => $home . '#org'], 'areaServed' => 'US', 'description' => aicc_one_liner(),
            'audience' => ['@type' => 'BusinessAudience', 'audienceType' => 'Primary care practices'],
        ];
        $faqs = function_exists('aicc_home_faqs') ? array_map(function ($f) {
            return ['@type' => 'Question', 'name' => $f[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => wp_strip_all_tags($f[1])]];
        }, aicc_home_faqs()) : [];
        if ($faqs) $graph[] = ['@type' => 'FAQPage', 'mainEntity' => $faqs];
    } elseif (is_singular()) {
        $post = get_post();
        $content = apply_filters('the_content', $post->post_content);
        $faqs = aicc_extract_faqs($content);
        if ($faqs) $graph[] = ['@type' => 'FAQPage', 'mainEntity' => $faqs];
        $crumbs = [['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $home]];
        if (is_singular('post')) {
            $crumbs[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'Guides', 'item' => get_permalink((int) get_option('page_for_posts'))];
            $graph[] = [
                '@type' => 'Article', 'headline' => get_the_title(), 'datePublished' => get_the_date('c'), 'dateModified' => get_the_modified_date('c'),
                'author' => ['@id' => $home . '#org'], 'publisher' => ['@id' => $home . '#org'], 'mainEntityOfPage' => get_permalink(),
                'image' => aicc_og_image(), 'description' => aicc_description(),
            ];
        }
        $crumbs[] = ['@type' => 'ListItem', 'position' => count($crumbs) + 1, 'name' => get_the_title(), 'item' => get_permalink()];
        $graph[] = ['@type' => 'BreadcrumbList', 'itemListElement' => $crumbs];
        $graph[] = ['@type' => 'WebPage', 'url' => get_permalink(), 'name' => wp_get_document_title(), 'dateModified' => get_the_modified_date('c'), 'isPartOf' => ['@id' => $home . '#website']];
    }
    echo '<script type="application/ld+json">' . wp_json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";
}

// Keep noindex pages out of the sitemap; drop users sitemap.
add_filter('wp_sitemaps_add_provider', function ($provider, $name) { return $name === 'users' ? false : $provider; }, 10, 2);
add_filter('wp_sitemaps_posts_query_args', function ($args, $type) {
    $args['meta_query'] = [['relation' => 'OR', ['key' => 'aicc_noindex', 'compare' => 'NOT EXISTS'], ['key' => 'aicc_noindex', 'value' => '', 'compare' => '=']]];
    return $args;
}, 10, 2);

// robots.txt: open to search and AI crawlers.
add_filter('robots_txt', function ($out, $public) {
    if (!$public) return $out;
    $lines = ["User-agent: *", "Disallow: /wp-admin/", "Allow: /wp-admin/admin-ajax.php", ""];
    foreach (['GPTBot', 'OAI-SearchBot', 'ChatGPT-User', 'ClaudeBot', 'Claude-SearchBot', 'PerplexityBot', 'Google-Extended', 'Applebot-Extended', 'Bingbot'] as $bot) {
        $lines[] = "User-agent: $bot";
        $lines[] = "Allow: /";
        $lines[] = "";
    }
    $lines[] = 'Sitemap: ' . home_url('/wp-sitemap.xml');
    return implode("\n", $lines) . "\n";
}, 10, 2);

// /llms.txt for answer engines.
add_action('init', function () {
    add_rewrite_rule('^llms\.txt$', 'index.php?aicc_llms=1', 'top');
});
add_filter('query_vars', function ($v) { $v[] = 'aicc_llms'; return $v; });
add_action('template_redirect', function () {
    if (!get_query_var('aicc_llms')) return;
    header('Content-Type: text/plain; charset=utf-8');
    echo '# ' . AICC_NAME . "\n\n> " . aicc_one_liner() . "\n\n";
    echo "## Product pages\n\n";
    foreach (aicc_pages() as $slug => $p) {
        if (!empty($p['noindex']) || in_array($slug, ['home', 'guides'], true)) continue;
        $page = get_page_by_path($slug);
        if (!$page) continue;
        $d = get_post_meta($page->ID, 'aicc_desc', true) ?: ($p['desc'] ?? '');
        echo '- [' . get_the_title($page) . '](' . get_permalink($page) . '): ' . $d . "\n";
    }
    $posts = get_posts(['numberposts' => 50, 'post_status' => 'publish']);
    if ($posts) {
        echo "\n## Guides\n\n";
        foreach ($posts as $p) {
            $d = get_post_meta($p->ID, 'aicc_desc', true) ?: wp_trim_words(wp_strip_all_tags($p->post_content), 25, '…');
            echo '- [' . get_the_title($p) . '](' . get_permalink($p) . '): ' . $d . "\n";
        }
    }
    exit;
}, 0); // before WordPress's canonical redirect adds a trailing slash
