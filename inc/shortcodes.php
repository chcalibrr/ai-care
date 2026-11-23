<?php
/**
 * Reusable blocks, available as shortcodes inside page content.
 */
if (!defined('ABSPATH')) exit;

function aicc_call_script() {
    // [speaker, text, start seconds] — matches assets/audio/sample-check-in-call.mp3 (APCM enrollment call)
    return [
        ['ai', "Hi, is this Michael?", 0.61],
        ['pt', "Yeah, speaking.", 2.39],
        ['ai', "Hi Michael, it's Ava, I work with Dr. Patel. Do you have a quick minute?", 4.73],
        ['pt', "Uh, sure. What's up?", 9.56],
        ['ai', "So at your visit last month, Dr. Patel saw your blood pressure was up, and he'd rather not wait till your next appointment to see how it's going. So he asked me to keep an eye on it with you in between.", 12.51],
        ['pt', "Okay... what does that mean, exactly?", 23.66],
        ['ai', "It just means I'll call you about once a month to see how you're doing, and help with refills. If anything looks off, I get it to Dr. Patel the same day. And you can reach us any time, day or night.", 27.73],
        ['pt', "Hm. Okay. And is that, um... does that cost anything?", 39.17],
        ['ai', "It's covered under Medicare Part B. Your usual coinsurance can apply, so depending on your plan there might be a small charge each month. And you can stop any time, just tell us.", 45.04],
        ['pt', "Yeah, okay. Let's do it.", 55.54],
        ['ai', "Great. So I've got you down as agreeing to start this month. What's a good time for me to call you?", 58.77],
        ['pt', "Mornings are better. Before ten, if you can.", 64.4],
        ['ai', "Mornings before ten, got it. While I have you, have you been checking your blood pressure at home?", 66.59],
        ['pt', "Um, kind of. Few times a week. It's been around 140 over 90.", 72.09],
        ['ai', "Okay, thanks. That's still a little high, so I'll pass those numbers to Dr. Patel today. And how are you doing on the lisinopril? Enough left?", 79.02],
        ['pt', "Oh, actually, I'm almost out. Maybe four or five days.", 88.1],
        ['ai', "No problem, I'll send the refill request over today so you don't run out. I've added all of this to your care plan, and I'll call you next month, in the morning.", 93.05],
        ['pt', "Great. Thanks, Ava.", 101.58],
        ['ai', "Of course. Take care, Michael.", 103.59],
    ];
}

function aicc_player_html() {
    $peaks = '12,88,50,72,24,61,84,72,59,63,39,66,46,5,79,85,59,73,60,75,71,56,57,75,70,62,29,45,55,41,12,68,89,76,83,59,41,79,63,58,50,75,70,63,41,47,74,52,53,22,32,88,54,89,65,71,79,76,58,45,65,46,50,40,65,6,59,100,82,58,54,82,63,61,76,77,50,63,84,72,57,74,59,55,40,81,80,10,7,47,21,74,85,73,58,63,95,52,54,53,86,60,86,28,23,72,86,74,60,70,80,73,58,66,47,58,17,55,54,5';
    ob_start(); ?>
    <div class="player" data-player data-peaks="<?php echo esc_attr($peaks); ?>">
      <div class="player-main">
        <div>
          <div class="player-top">
            <button class="play" type="button" aria-label="Play the sample call" data-play><?php echo aicc_icon('play'); ?></button>
            <div><strong>APCM enrollment call</strong><span>Sample call · 1:47 · English</span></div>
          </div>
        </div>
        <div>
          <div class="bars" data-bars aria-hidden="true"></div>
          <div class="time"><span data-cur>0:00</span><span>1:47</span></div>
        </div>
        <div class="speakers"><span><i></i>Ava, Dr. Patel's office</span><span><i class="pt"></i>Michael, patient</span></div>
        <p class="disclaim">Sample call with a fictional patient and practice, recorded over a phone line. Real calls follow your practice's script, protocols and escalation rules.</p>
      </div>
      <div class="script" data-script>
        <?php foreach (aicc_call_script() as $l): ?>
          <p class="<?php echo esc_attr($l[0]); ?>" data-t="<?php echo esc_attr($l[2]); ?>"><b><?php echo $l[0] === 'ai' ? 'Ava' : 'Michael'; ?></b><?php echo esc_html($l[1]); ?></p>
        <?php endforeach; ?>
      </div>
      <audio preload="none" src="<?php echo esc_url(get_template_directory_uri() . '/assets/audio/sample-check-in-call.mp3?v=' . AICC_VER); ?>"></audio>
    </div>
    <?php return ob_get_clean();
}

function aicc_calculator_html() {
    ob_start(); ?>
    <div class="calc" data-calc>
      <div class="calc-in">
        <div class="field"><label for="c-panel">Medicare patients in your practice <output data-o="panel">1,000</output></label>
          <input id="c-panel" type="range" min="100" max="5000" step="50" value="1000" data-i="panel"></div>
        <div class="field"><label for="c-enroll">Share who enroll <output data-o="enroll">50%</output></label>
          <input id="c-enroll" type="range" min="10" max="80" step="5" value="50" data-i="enroll">
          <div class="hint">Patients must agree to join. Calling every eligible patient is what moves this number.</div></div>
        <div class="field"><label for="c-multi">Enrolled patients with 2+ chronic conditions <output data-o="multi">70%</output></label>
          <input id="c-multi" type="range" min="0" max="100" step="5" value="70" data-i="multi"></div>
        <div class="field"><label for="c-qmb">Of those, Qualified Medicare Beneficiaries <output data-o="qmb">12%</output></label>
          <input id="c-qmb" type="range" min="0" max="50" step="1" value="12" data-i="qmb"></div>
        <div>
          <div class="rates">
            <div><label for="r1">G0556 $/mo</label><input id="r1" type="number" step="0.01" value="16.37" data-r="r1"></div>
            <div><label for="r2">G0557 $/mo</label><input id="r2" type="number" step="0.01" value="53.78" data-r="r2"></div>
            <div><label for="r3">G0558 $/mo</label><input id="r3" type="number" step="0.01" value="117.24" data-r="r3"></div>
          </div>
          <div class="field"><div class="hint">Defaults are 2026 Medicare national rates. Your rate depends on your locality; check the CMS Physician Fee Schedule lookup.</div></div>
        </div>
      </div>
      <div class="calc-out">
        <span class="mono">Estimated APCM revenue per year</span>
        <div class="big" data-out="year">$0</div>
        <div class="r"><span>Per month</span><b data-out="month">$0</b></div>
        <div class="r"><span>If every Medicare patient joined</span><b data-out="full">$0</b></div>
        <div class="r"><span>Enrolled patients</span><b data-out="patients">0</b></div>
        <div class="r"><span>G0556 / G0557 / G0558</span><b data-out="mix">0 / 0 / 0</b></div>
        <small>Estimate only, before patient cost sharing and our fee. Not billing advice.</small>
      </div>
    </div>
    <?php return ob_get_clean();
}

function aicc_cta_html($title = 'See it run with your patient list', $text = 'Book a 20-minute demo. We\'ll walk through a live check-in call and estimate what your practice could bill.') {
    return '<div class="inline-cta"><div><strong>' . esc_html($title) . '</strong><span>' . esc_html($text) . '</span></div><a class="btn btn-light" href="' . esc_url(aicc_url('book-a-demo')) . '">Book a demo ' . aicc_icon('arrow') . '</a></div>';
}

add_shortcode('aicc_player', function () { return aicc_player_html(); });
add_shortcode('aicc_calculator', function () { return aicc_calculator_html(); });
add_shortcode('aicc_demo_form', function () { return '<div id="demo">' . aicc_demo_form_html() . '</div>'; });
add_shortcode('aicc_cta', function ($a) {
    $a = shortcode_atts(['title' => 'See it run with your patient list', 'text' => 'Book a 20-minute demo. We\'ll walk through a live check-in call and estimate what your practice could bill.'], $a);
    return aicc_cta_html($a['title'], $a['text']);
});
add_shortcode('aicc_url', function ($a) { $a = shortcode_atts(['slug' => ''], $a); return esc_url(aicc_url($a['slug'])); });
