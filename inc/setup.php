<?php
/**
 * One-time and versioned content install. Pages are created from /content/*.html.
 * A page is only overwritten on later theme versions if nobody edited it since the last install.
 */
if (!defined('ABSPATH')) exit;

function aicc_install() {
    $dir = get_template_directory() . '/content/';
    $ids = [];
    foreach (aicc_pages() as $slug => $p) {
        $file = $dir . $slug . '.html';
        $content = file_exists($file) ? file_get_contents($file) : '';
        $existing = get_page_by_path($slug === 'home' ? 'home' : $slug);
        if ($existing) {
            $id = $existing->ID;
            $last = get_post_meta($id, '_aicc_hash', true);
            $now = md5($existing->post_content);
            if (!$last && $existing->post_status !== 'publish') {
                wp_update_post(['ID' => $id, 'post_content' => $content, 'post_title' => $p['title'], 'post_status' => 'publish']);
                update_post_meta($id, '_aicc_hash', md5($content));
            } elseif ($last && $last === $now && md5($content) !== $now) {
                wp_update_post(['ID' => $id, 'post_content' => $content, 'post_title' => $p['title']]);
                update_post_meta($id, '_aicc_hash', md5($content));
            }
        } else {
            $id = wp_insert_post([
                'post_type' => 'page', 'post_status' => 'publish', 'post_name' => $slug,
                'post_title' => $p['title'], 'post_content' => $content, 'menu_order' => $p['order'] ?? 0,
                'comment_status' => 'closed', 'ping_status' => 'closed',
            ]);
            update_post_meta($id, '_aicc_hash', md5($content));
        }
        if (!$id || is_wp_error($id)) continue;
        $ids[$slug] = $id;
        foreach (['seo_title' => 'aicc_title', 'desc' => 'aicc_desc', 'h1' => 'aicc_h1', 'label' => 'aicc_label', 'answer' => 'aicc_answer'] as $k => $meta) {
            if (empty($p[$k])) continue;
            $cur = get_post_meta($id, $meta, true); $src = get_post_meta($id, '_src_' . $meta, true);
            // Update when empty, or when the stored value still matches what the theme last installed (not hand-edited).
            if (!$cur || $src === $cur || ($src === '' && $cur !== $p[$k])) {
                update_post_meta($id, $meta, $p[$k]); update_post_meta($id, '_src_' . $meta, $p[$k]);
            }
        }
        if (!empty($p['noindex'])) update_post_meta($id, 'aicc_noindex', 1);
    }

    if (!empty($ids['home'])) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $ids['home']);
    }
    if (!empty($ids['guides'])) update_option('page_for_posts', $ids['guides']);
    if (!empty($ids['privacy-policy'])) update_option('wp_page_for_privacy_policy', $ids['privacy-policy']);

    if (!get_option('aicc_installed_ver')) {
        update_option('blogname', AICC_NAME);
        update_option('blogdescription', 'An AI care coordinator for every patient');
        update_option('permalink_structure', '/%postname%/');
        update_option('default_comment_status', 'closed');
        update_option('default_ping_status', 'closed');
        update_option('blog_public', 1);
        update_option('timezone_string', 'America/New_York');
        // Remove WordPress starter content.
        $hello = get_page_by_path('hello-world', OBJECT, 'post');
        if ($hello) wp_trash_post($hello->ID);
        $sample = get_page_by_path('sample-page');
        if ($sample) wp_trash_post($sample->ID);
        $cat = get_category(1);
        if ($cat && $cat->slug === 'uncategorized') wp_update_term(1, 'category', ['name' => 'Guides', 'slug' => 'guide']);
    }
    flush_rewrite_rules();
    update_option('aicc_installed_ver', AICC_VER);
}

add_action('after_switch_theme', 'aicc_install');
add_action('wp_loaded', function () {
    if (get_option('aicc_installed_ver') !== AICC_VER) aicc_install();
});
