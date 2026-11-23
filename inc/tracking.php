<?php
/**
 * Analytics and ad pixels for aicarecoordinator.com.
 * Page views on every page; a lead event when the demo form succeeds (?sent=1).
 * Never sends form contents. Not loaded for logged-in admins.
 */
if (!defined('ABSPATH')) exit;

const AICC_GA4 = 'G-NZ6K68ESJ7';
const AICC_META_PIXEL = '2259088834653196';
const AICC_LINKEDIN_PARTNER = ''; // set when the LinkedIn Insight Tag is created

add_action('wp_head', function () {
    if (is_user_logged_in()) return;
    $lead = isset($_GET['sent']) && $_GET['sent'] === '1';
    if (AICC_GA4) { ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr(AICC_GA4); ?>"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?php echo esc_js(AICC_GA4); ?>');<?php if ($lead) echo "gtag('event','generate_lead');"; ?></script>
<?php }
    if (AICC_META_PIXEL) { ?>
<script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init','<?php echo esc_js(AICC_META_PIXEL); ?>');fbq('track','PageView');<?php if ($lead) echo "fbq('track','Lead');"; ?></script>
<?php }
    if (AICC_LINKEDIN_PARTNER) { ?>
<script>_linkedin_partner_id="<?php echo esc_js(AICC_LINKEDIN_PARTNER); ?>";window._linkedin_data_partner_ids=window._linkedin_data_partner_ids||[];window._linkedin_data_partner_ids.push(_linkedin_partner_id);(function(l){if(!l){window.lintrk=function(a,b){window.lintrk.q.push([a,b])};window.lintrk.q=[]}var s=document.getElementsByTagName("script")[0];var b=document.createElement("script");b.type="text/javascript";b.async=true;b.src="https://snap.licdn.com/li.lms-analytics/insight.min.js";s.parentNode.insertBefore(b,s);})(window.lintrk);</script>
<?php }
}, 5);
