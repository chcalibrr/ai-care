<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="sr-only" href="#main">Skip to content</a>
<header class="site-header" data-header>
  <div class="wrap nav">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(AICC_NAME); ?> home"><?php echo aicc_logo_svg(); ?><span><b>AI</b> Care Coordinator</span></a>
    <ul class="menu" data-menu>
      <li><a href="<?php echo esc_url(aicc_url('apcm')); ?>">APCM</a></li>
      <li class="has-sub"><a href="<?php echo esc_url(aicc_url('chronic-care-management')); ?>">Other programs</a>
        <ul class="sub">
          <?php foreach (aicc_pages() as $slug => $p): if (($p['nav'] ?? '') !== 'programs' || $slug === 'apcm') continue; ?>
            <li><a href="<?php echo esc_url(aicc_url($slug)); ?>"><strong><?php echo esc_html($p['title']); ?></strong><span><?php echo esc_html($p['blurb']); ?></span></a></li>
          <?php endforeach; ?>
        </ul>
      </li>
      <li><a href="<?php echo esc_url(home_url('/#how')); ?>">How it works</a></li>
      <li class="has-sub"><a href="<?php echo esc_url(aicc_url('guides')); ?>">Resources</a>
        <ul class="sub">
          <?php foreach (aicc_pages() as $slug => $p): if (($p['nav'] ?? '') !== 'resources') continue; ?>
            <li><a href="<?php echo esc_url(aicc_url($slug)); ?>"><strong><?php echo esc_html($p['title']); ?></strong><span><?php echo esc_html($p['blurb']); ?></span></a></li>
          <?php endforeach; ?>
          <li><a href="<?php echo esc_url(aicc_url('guides')); ?>"><strong>Guides</strong><span>APCM billing, eligibility and consent</span></a></li>
        </ul>
      </li>
      <li><a href="<?php echo esc_url(aicc_url('pricing')); ?>">Pricing</a></li>
      <li><a href="<?php echo esc_url(aicc_url('security')); ?>">Security</a></li>
    </ul>
    <div class="nav-cta">
      <a class="btn btn-text" href="<?php echo esc_url(home_url('/#listen')); ?>">Hear a call</a>
      <a class="btn btn-primary" href="<?php echo esc_url(aicc_url('book-a-demo')); ?>">Book a demo</a>
      <button class="nav-toggle" type="button" aria-label="Open menu" data-toggle><span></span><span></span><span></span></button>
    </div>
  </div>
</header>
<main id="main">
