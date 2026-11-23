<?php get_header();
while (have_posts()): the_post();
    $id = get_the_ID();
    $h1 = aicc_meta('aicc_h1', $id) ?: get_the_title();
    $label = aicc_meta('aicc_label', $id);
    $answer = aicc_meta('aicc_answer', $id);
    $is_form = get_post_field('post_name', $id) === 'book-a-demo';
?>
<section class="page-hero dotted">
  <span class="blob b2" style="opacity:.4"></span>
  <div class="wrap">
    <nav class="crumbs" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> / <span><?php the_title(); ?></span></nav>
    <?php if ($label): ?><span class="label"><?php echo esc_html($label); ?></span><?php endif; ?>
    <h1><?php echo esc_html($h1); ?></h1>
    <?php if ($answer): ?><div class="answer"><?php echo esc_html($answer); ?></div><?php endif; ?>
    <?php if (!$is_form && $answer): ?>
      <div class="hero-ctas" style="margin-top:28px"><a class="btn btn-primary" href="<?php echo esc_url(aicc_url('book-a-demo')); ?>">Book a demo <?php echo aicc_icon('arrow'); ?></a><a class="btn btn-ghost" href="<?php echo esc_url(home_url('/#listen')); ?>"><span class="dot"><?php echo aicc_icon('play'); ?></span>Hear a call</a></div>
    <?php endif; ?>
  </div>
</section>
<article class="prose">
  <?php the_content(); ?>
  <p class="updated">Last updated <?php echo esc_html(get_the_modified_date('F j, Y')); ?></p>
</article>
<?php endwhile; get_footer();
