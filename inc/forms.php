<?php
/**
 * Demo request form: stored as a private post type and emailed to the site admin.
 * Collects practice details only, never patient information.
 */
if (!defined('ABSPATH')) exit;

add_action('init', function () {
    register_post_type('aicc_lead', [
        'label' => 'Demo requests', 'public' => false, 'show_ui' => true, 'show_in_menu' => true,
        'menu_icon' => 'dashicons-email-alt', 'supports' => ['title', 'editor'], 'capability_type' => 'post',
        'show_in_rest' => false,
    ]);
});

function aicc_demo_form_html() {
    $sent = isset($_GET['sent']) ? sanitize_key($_GET['sent']) : '';
    ob_start();
    if ($sent === '1') {
        echo '<div class="notice">Thanks. We got your request and will reply within one business day to book a time.</div>';
        return ob_get_clean();
    }
    if ($sent === '0') echo '<div class="notice err">Something was missing. Please check the form and try again.</div>';
    ?>
    <form class="form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
      <input type="hidden" name="action" value="aicc_demo">
      <?php wp_nonce_field('aicc_demo', 'aicc_nonce'); ?>
      <div class="hp" aria-hidden="true"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
      <div class="two">
        <div><label for="f-name">Your name</label><input id="f-name" name="name" required autocomplete="name"></div>
        <div><label for="f-role">Role</label>
          <select id="f-role" name="role"><option>Physician / owner</option><option>Practice manager</option><option>Medical director</option><option>Care management lead</option><option>Billing / revenue cycle</option><option>Other</option></select></div>
      </div>
      <div class="two">
        <div><label for="f-email">Work email</label><input id="f-email" type="email" name="email" required autocomplete="email"></div>
        <div><label for="f-phone">Phone</label><input id="f-phone" type="tel" name="phone" autocomplete="tel"></div>
      </div>
      <div class="two">
        <div><label for="f-practice">Practice name</label><input id="f-practice" name="practice" required autocomplete="organization"></div>
        <div><label for="f-state">State</label><input id="f-state" name="state" autocomplete="address-level1"></div>
      </div>
      <div class="two">
        <div><label for="f-panel">Medicare patients</label>
          <select id="f-panel" name="panel"><option>Under 250</option><option>250 to 500</option><option>500 to 1,000</option><option>1,000 to 3,000</option><option>3,000+</option></select></div>
        <div><label for="f-program">Most interested in</label>
          <select id="f-program" name="program"><option>APCM</option><option>CCM</option><option>TCM</option><option>RPM</option><option>Referral follow-up</option><option>Not sure yet</option></select></div>
      </div>
      <div><label for="f-ehr">EHR</label><input id="f-ehr" name="ehr" placeholder="e.g. athenahealth, eClinicalWorks, Epic"></div>
      <button class="btn btn-primary" type="submit">Request a demo <?php echo aicc_icon('arrow'); ?></button>
      <p class="note">Please don't include any patient information in this form.</p>
    </form>
    <?php
    return ob_get_clean();
}

function aicc_handle_demo() {
    $back = wp_get_referer() ?: aicc_url('book-a-demo');
    $back = remove_query_arg('sent', $back);
    if (!isset($_POST['aicc_nonce']) || !wp_verify_nonce($_POST['aicc_nonce'], 'aicc_demo') || !empty($_POST['website'])) {
        wp_safe_redirect(add_query_arg('sent', '0', $back)); exit;
    }
    $f = [];
    foreach (['name', 'role', 'email', 'phone', 'practice', 'state', 'panel', 'program', 'ehr'] as $k) {
        $f[$k] = isset($_POST[$k]) ? sanitize_text_field(wp_unslash($_POST[$k])) : '';
    }
    $f['email'] = sanitize_email($f['email']);
    if (!$f['name'] || !is_email($f['email']) || !$f['practice']) {
        wp_safe_redirect(add_query_arg('sent', '0', $back)); exit;
    }
    $body = '';
    foreach ($f as $k => $v) $body .= ucfirst($k) . ': ' . $v . "\n";
    $body .= 'Page: ' . esc_url_raw($back) . "\n";
    wp_insert_post(['post_type' => 'aicc_lead', 'post_status' => 'private', 'post_title' => $f['practice'] . ' — ' . $f['name'], 'post_content' => $body]);
    wp_mail(get_option('admin_email'), 'New demo request: ' . $f['practice'], $body, ['Reply-To: ' . $f['name'] . ' <' . $f['email'] . '>']);
    wp_safe_redirect(add_query_arg('sent', '1', $back) . '#demo'); exit;
}
add_action('admin_post_nopriv_aicc_demo', 'aicc_handle_demo');
add_action('admin_post_aicc_demo', 'aicc_handle_demo');
