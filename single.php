<?php get_header(); while (have_posts()): the_post(); $answer = aicc_meta('aicc_answer', get_the_ID()); ?>
<section class="page-hero dotted">
  <div class="wrap">
    <nav class="crumbs" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> / <a href="<?php echo esc_url(aicc_url('guides')); ?>">Guides</a></nav>
    <span class="label">Guide · <?php echo esc_html(get_the_date('F j, Y')); ?></span>
    <h1><?php echo esc_html(aicc_meta('aicc_h1', get_the_ID()) ?: get_the_title()); ?></h1>
    <?php if ($answer): ?><div class="answer"><?php echo esc_html($answer); ?></div><?php endif; ?>
  </div>
</section>
<article class="prose">
  <?php if (has_post_thumbnail()) { the_post_thumbnail('large', ['style' => 'border-radius:20px;margin-bottom:32px']); } ?>
  <?php the_content(); ?>
  <?php echo aicc_cta_html(); ?>
  <p class="updated">Updated <?php echo esc_html(get_the_modified_date('F j, Y')); ?></p>
</article>
<?php endwhile; get_footer();
