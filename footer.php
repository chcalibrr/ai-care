</main>
<footer class="site-footer">
  <div class="wrap">
    <div class="foot">
      <div>
        <a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><?php echo aicc_logo_svg(); ?><span><b>AI</b> Care Coordinator</span></a>
        <p style="margin-top:16px">More APCM revenue, fully automated. We enroll your eligible Medicare patients and check in with every one of them, every month.</p>
      </div>
      <div>
        <h4>Programs</h4>
        <ul>
          <?php foreach (aicc_pages() as $slug => $p): if (($p['nav'] ?? '') !== 'programs') continue; ?>
            <li><a href="<?php echo esc_url(aicc_url($slug)); ?>"><?php echo esc_html($p['title']); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div>
        <h4>Resources</h4>
        <ul>
          <?php foreach (aicc_pages() as $slug => $p): if (($p['nav'] ?? '') !== 'resources') continue; ?>
            <li><a href="<?php echo esc_url(aicc_url($slug)); ?>"><?php echo esc_html($p['title']); ?></a></li>
          <?php endforeach; ?>
          <li><a href="<?php echo esc_url(aicc_url('guides')); ?>">Guides</a></li>
        </ul>
      </div>
      <div>
        <h4>Company</h4>
        <ul>
          <li><a href="<?php echo esc_url(aicc_url('pricing')); ?>">Pricing</a></li>
          <li><a href="<?php echo esc_url(aicc_url('security')); ?>">Security</a></li>
          <li><a href="<?php echo esc_url(aicc_url('book-a-demo')); ?>">Book a demo</a></li>
          <li><a href="<?php echo esc_url(aicc_url('privacy-policy')); ?>">Privacy policy</a></li>
        </ul>
      </div>
    </div>
    <div class="legal">
      <span>© <?php echo esc_html(date('Y')); ?> <?php echo esc_html(AICC_NAME); ?></span>
      <span>Not medical or billing advice. Your practitioners remain responsible for patient care and billing.</span>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
