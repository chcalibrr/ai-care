<?php get_header(); ?>
<section class="page-hero dotted"><div class="wrap"><h1><?php echo is_404() ? 'Page not found' : esc_html(get_the_archive_title() ?: 'Guides'); ?></h1>
<?php if (is_404()): ?><p class="lead">The page you're looking for isn't here. Try the <a href="<?php echo esc_url(aicc_url('guides')); ?>">guides</a> or go <a href="<?php echo esc_url(home_url('/')); ?>">home</a>.</p><?php endif; ?></div></section>
<?php if (!is_404() && have_posts()): ?>
<section class="section-tight" style="padding-top:20px"><div class="wrap"><div class="posts">
<?php while (have_posts()): the_post(); ?>
  <a class="card" href="<?php the_permalink(); ?>"><span class="top"></span><h3 style="margin-top:14px"><?php the_title(); ?></h3><p><?php echo esc_html(wp_trim_words(wp_strip_all_tags(get_the_content()), 26, '…')); ?></p><span class="arrow">Read →</span></a>
<?php endwhile; ?>
</div></div></section>
<?php endif; get_footer();
