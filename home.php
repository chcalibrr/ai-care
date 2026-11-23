<?php get_header(); $pid = (int) get_option('page_for_posts'); ?>
<section class="page-hero dotted">
  <div class="wrap">
    <span class="label">Guides</span>
    <h1><?php echo esc_html(aicc_meta('aicc_h1', $pid) ?: 'Guides'); ?></h1>
    <p class="lead"><?php echo esc_html(aicc_meta('aicc_desc', $pid)); ?></p>
  </div>
</section>
<section class="section-tight" style="padding-top:20px">
  <div class="wrap">
    <?php if (have_posts()): ?>
      <div class="posts">
        <?php while (have_posts()): the_post(); ?>
          <a class="card" href="<?php the_permalink(); ?>"><span class="top"></span>
            <div class="code" style="margin-top:14px"><?php echo esc_html(get_the_date('M j, Y')); ?></div>
            <h3><?php the_title(); ?></h3>
            <p><?php echo esc_html(aicc_meta('aicc_desc', get_the_ID()) ?: wp_trim_words(wp_strip_all_tags(get_the_content()), 26, '…')); ?></p>
            <span class="arrow">Read →</span></a>
        <?php endwhile; ?>
      </div>
      <div style="margin-top:32px"><?php the_posts_pagination(['mid_size' => 1]); ?></div>
    <?php else: ?>
      <div class="grid-3">
        <?php foreach (['apcm', 'chronic-care-management', 'transitional-care-management', 'remote-patient-monitoring', 'referral-follow-up', 'patient-care-coordination'] as $slug): $p = aicc_pages()[$slug]; ?>
          <a class="card" href="<?php echo esc_url(aicc_url($slug)); ?>"><span class="top"></span><h3 style="margin-top:14px"><?php echo esc_html($p['h1'] ?? $p['title']); ?></h3><p><?php echo esc_html($p['desc']); ?></p><span class="arrow">Read →</span></a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
<?php get_footer();
