<?php get_header(); $demo = aicc_url('book-a-demo');
$ph = function ($n) { return get_theme_file_uri('assets/img/photos/' . $n . '.webp'); }; ?>

<section class="hero">
  <div class="hero-panel fluted">
  <div class="fl-ribs" aria-hidden="true"><i></i><i></i><i></i><i></i></div>
  <div class="wrap hero-grid">
    <div class="reveal">
      <h1>More care for your patients. More revenue for your practice.</h1>
      <p class="lead">Medicare pays your practice every month to look after patients between visits. We make every call, so each patient gets checked on and you get paid, without adding staff.</p>
      <div class="hero-ctas">
        <a class="btn btn-primary" href="<?php echo esc_url($demo); ?>">Book a demo</a>
        <a class="btn btn-text" href="#listen"><span class="dot"><?php echo aicc_icon('play'); ?></span>Hear an enrollment call</a>
      </div>
      <div class="hero-note">
        <span><?php echo aicc_icon('check'); ?>Supports 500+ clinics and EHRs</span>
                <span><?php echo aicc_icon('check'); ?>No new staff</span>
        <span><?php echo aicc_icon('check'); ?>Your clinicians stay in charge</span>
              </div>
    </div>
    <div class="stage reveal" data-hero aria-label="Animated example of an APCM check-in call">
      <img class="photo" src="<?php echo esc_url($ph('hero-helen')); ?>" alt="Older woman at her kitchen table taking a check-in call on her phone" width="1000" height="1250" fetchpriority="high">
      <div class="events">
        <div class="event" data-ev><div class="ava pt">MS</div><div><strong>Consent recorded</strong><span>Maria S., 72 F</span></div><em class="tag">APCM</em></div>
        <div class="event" data-ev><div class="ava pt">JR</div><div><strong>Check-in complete</strong><span>James R., 68 M</span></div><em class="tag green">G0557</em></div>
        <div class="event" data-ev><div class="ava pt">LK</div><div><strong>Red flag escalated</strong><span>Linda K., 80 F</span></div><em class="tag red">On-call RN</em></div>
        <div class="event" data-ev><div class="ava pt">RT</div><div><strong>Care plan updated</strong><span>Robert T., 75 M</span></div><em class="tag">G0556</em></div>
      </div>
      <div class="callcard">
        <div class="callcard-top"><div class="ava"><?php echo aicc_mark_svg(); ?></div><div><strong>Ava · Dr. Patel's office</strong><span>Calling Helen W., 74</span></div><span class="timer" data-timer>0:00</span></div>
        <div class="wave" data-wave><?php echo str_repeat('<i></i>', 40); ?></div>
        <div class="lines" data-lines></div>
      </div>
    </div>
  </div>
</div>
</section>

<section class="ehr-strip" aria-label="EHR integrations">
  <div class="wrap"><p class="ehr-label">Integrates with and supports <b>500+ clinics and EHRs</b></p></div>
  <div class="marquee ehr"><div class="marquee-track">
<?php $e = [['epic', 'Epic', 38, 97], ['oracle', 'Oracle Health', 27, 198], ['athenahealth', 'athenahealth', 25, 210], ['eclinicalworks', 'eClinicalWorks', 36, 144], ['nextgen', 'NextGen Healthcare', 32, 165], ['advancedmd', 'AdvancedMD', 26, 201], ['modmed', 'ModMed', 38, 130], ['meditech', 'MEDITECH', 28, 189], ['elation', 'Elation Health', 38, 122], ['practicefusion', 'Practice Fusion', 35, 148], ['drchrono', 'DrChrono', 38, 109], ['greenway', 'Greenway Health', 38, 127]];
foreach (array_merge($e, $e) as $x) echo '<img src="' . esc_url(get_theme_file_uri('assets/img/ehr/' . $x[0] . '.svg')) . '" alt="' . esc_attr($x[1]) . '" height="' . $x[2] . '" width="' . $x[3] . '" loading="lazy">'; ?>
  </div></div>
</section>

<section class="mission">
  <div class="wrap mission-grid">
    <div class="reveal">
      <h2>The revenue is already on your panel.</h2>
      <p class="lead">Most Medicare patients in a primary care practice qualify for APCM. What's missing is someone to enroll them and stay in touch every month. That's the part we take over, for every patient, in their language.</p>
      <div class="face-sum"><b>337</b><span>patients ready to bill for APCM this month in an example practice, with no new hires</span></div>
    </div>
    <div class="faces reveal" data-faces>
      <?php foreach ([['p-james', 'James R.', 'BP log reviewed'], ['p-margaret', 'Margaret H.', 'Refill requested'], ['p-rosa', 'Rosa M.', 'Check-in in Spanish'], ['p-henry', 'Henry L.', 'Wellness visit booked']] as $f): ?>
        <div class="face"><img src="<?php echo esc_url($ph($f[0])); ?>" alt="" loading="lazy" width="560" height="743"><span class="chip"><i><?php echo aicc_icon('check'); ?></i><span><b><?php echo esc_html($f[1]); ?></b><?php echo esc_html($f[2]); ?></span></span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head reveal">
      <h2>Medicare already pays for this. Almost nobody bills it.</h2>
      <p class="lead">APCM pays primary care practices every month for managing a patient's care between visits, with no minutes to count. The only thing in the way has been staff time to make the calls.</p>
    </div>
    <div class="stats reveal">
      <div class="stat"><b>1.2%</b><p>of Medicare fee-for-service patients received APCM services in the last quarter of 2025, the program's first year.</p><small>Source: <a href="https://www.medicaleconomics.com/view/first-look-at-apcm-data-growth-modest-reach-physician-turnover-for-medicares-primary-care-bundle" rel="nofollow noopener" target="_blank">Medical Economics</a></small></div>
      <div class="stat"><b>43.6%</b><p>of clinicians surveyed were not billing APCM and had never heard of the codes.</p><small>Source: <a href="https://www.medicaleconomics.com/view/first-look-at-apcm-data-growth-modest-reach-physician-turnover-for-medicares-primary-care-bundle" rel="nofollow noopener" target="_blank">Medical Economics</a></small></div>
      <div class="stat"><b>~$50</b><p>a month per patient for G0557, the level used for about 80% of APCM claims.</p><small>Source: <a href="https://aafp.org/content/dam/AAFP/documents/advocacy/payment/medicare/ES-2025MPFSFinalRule-112124.pdf" rel="nofollow noopener" target="_blank">AAFP</a>, 2025 national average</small></div>
      <div class="stat"><b>0 min</b><p>monthly time requirement. APCM is billed once per patient per month when the requirements are met.</p><small>Source: <a href="https://www.cms.gov/medicare/payment/fee-schedules/physician-fee-schedule/advanced-primary-care-management-services" rel="nofollow noopener" target="_blank">CMS</a></small></div>
    </div>
  </div>
</section>

<section id="how">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="label">How it works</span>
      <h2>From patient list to paid, every month</h2>
      <p class="lead">Four jobs your staff don't have time for, done for every eligible patient. Your clinical team approves what matters.</p>
    </div>
    <div class="proc reveal" data-process>
      <div class="ptabs" role="tablist">
        <div class="ptab" role="tab" tabindex="0" aria-selected="true" data-ptab="0"><i class="pbar"></i><span class="pn">01</span><div class="pbody"><span class="ptitle">Find every eligible patient</span><div class="pdesc"><p>We read your patient list and sort Medicare patients by APCM level, based on chronic conditions and Qualified Medicare Beneficiary status, so the right code is clear before anyone is called.</p><ul class="ticks"><li>Sorted into G0556, G0557 and G0558</li><li>Patients billed for CCM this month flagged</li><li>Nothing is billed until your team approves</li></ul></div></div></div>
        <div class="ptab" role="tab" tabindex="0" aria-selected="false" data-ptab="1"><i class="pbar"></i><span class="pn">02</span><div class="pbody"><span class="ptitle">Enroll them by phone</span><div class="pdesc"><p>Ava calls each eligible patient for your practice, explains why the doctor wants to stay in touch, what it costs and that they can stop any time, and records verbal consent in the chart.</p><ul class="ticks"><li>Explains cost sharing and the right to stop</li><li>Consent saved with date, time and recording</li><li>First check-in done on the same call</li></ul></div></div></div>
        <div class="ptab" role="tab" tabindex="0" aria-selected="false" data-ptab="2"><i class="pbar"></i><span class="pn">03</span><div class="pbody"><span class="ptitle">Check in with every patient, every month</span><div class="pdesc"><p>Medications, symptoms, readings, upcoming visits and anything the patient needs. Routine requests get handled; anything clinical goes to your team.</p><ul class="ticks"><li>At least one touchpoint per patient per month</li><li>Refill requests and visit booking handled</li><li>Red flags escalated to your on-call clinician</li></ul></div></div></div>
        <div class="ptab" role="tab" tabindex="0" aria-selected="false" data-ptab="3"><i class="pbar"></i><span class="pn">04</span><div class="pbody"><span class="ptitle">Hand billing a clean monthly report</span><div class="pdesc"><p>At month end your team gets a report of every patient with a qualifying touchpoint, mapped to the right code, with the documentation behind each line.</p><ul class="ticks"><li>Mapped to G0556, G0557 and G0558</li><li>Call notes, consent and care plan updates linked</li><li>Your practitioner reviews and bills</li></ul></div></div></div>
      </div>
      <div class="pstage fluted soft">
        <div class="fl-ribs" aria-hidden="true"><i></i><i></i><i></i><i></i></div>
        <button class="pause" type="button" aria-label="Pause" data-ppause><?php echo aicc_icon('pause'); ?></button>
        <div class="pane on" data-pane="0"><div class="ui"><div class="ui-h"><span>Eligibility review</span><span>Example</span></div><div class="ui-b">
            <div class="progress"><i data-bar></i></div>
            <div class="row" data-r><div>Maria S. · 72<small>Hypertension, type 2 diabetes, CKD 3</small></div><span class="badge">G0557</span></div>
            <div class="row" data-r><div>James R. · 68<small>Hyperlipidemia</small></div><span class="badge">G0556</span></div>
            <div class="row" data-r><div>Linda K. · 80<small>COPD, heart failure · QMB</small></div><span class="badge">G0558</span></div>
            <div class="row" data-r><div>Robert T. · 75<small>Enrolled in CCM this month</small></div><span class="badge amber">Review</span></div>
            <div class="row" data-r><div>Susan M. · 66<small>No Medicare Part B on file</small></div><span class="badge no">Not eligible</span></div>
          </div></div></div>
        <div class="pane" data-pane="1"><div class="ui"><div class="ui-h"><span>Enrollment call</span><span class="live">LIVE</span></div><div class="lines" style="padding:16px 18px" data-mini='[["ai","Hi Michael, it’s Ava, I work with Dr. Patel. Dr. Patel saw your blood pressure was up and asked me to keep an eye on it with you between visits."],["pt","Okay. Does that cost anything?"],["ai","It’s covered under Medicare Part B. Your usual coinsurance can apply, and you can stop any time."],["pt","Yeah, okay. Let’s do it."],["sys","Verbal consent recorded · G0557 · added to chart"]]'></div></div></div>
        <div class="pane" data-pane="2"><div class="ui"><div class="ui-h"><span>Check-in summary · Margaret H.</span><span>Example</span></div><div class="ui-b">
            <div class="row" data-r><div>Medications taken as prescribed<small>Lisinopril, metformin</small></div><span class="badge green">On track</span></div>
            <div class="row" data-r><div>Home blood pressure<small>~130/80 this week</small></div><span class="badge green">In range</span></div>
            <div class="row" data-r><div>Ankle swelling on Sunday<small>Resolved · noted for nurse review</small></div><span class="badge amber">Care plan note</span></div>
            <div class="row" data-r><div>Metformin refill<small>Request sent to Dr. Patel's team</small></div><span class="badge">Sent</span></div>
            <div class="row" data-r><div>Annual wellness visit<small>Tue 14th, 10:00 a.m.</small></div><span class="badge">Booked</span></div>
          </div></div></div>
        <div class="pane" data-pane="3"><div class="ui"><div class="ui-h"><span>Monthly report · November</span><span>Example</span></div><div class="ui-b">
            <div class="row" data-r><div>G0556 · Level 1<small>92 patients with a documented touchpoint</small></div><span class="badge">92</span></div>
            <div class="row" data-r><div>G0557 · Level 2<small>214 patients</small></div><span class="badge">214</span></div>
            <div class="row" data-r><div>G0558 · Level 3<small>31 patients</small></div><span class="badge">31</span></div>
            <div class="row" data-r><div>Escalations reviewed by clinicians<small>9 this month, all closed</small></div><span class="badge green">Closed</span></div>
            <div class="total"><span class="mono">Ready for practitioner review</span><b>337</b></div>
          </div></div></div>
      </div>
    </div>
  </div>
</section>

<section id="listen" class="section-tight">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>Hear an enrollment call</h2>
      <p class="lead">Michael agrees to join, gets his first check-in and has a refill sent, in under two minutes. Nobody at the practice picked up a phone.</p>
    </div>
    <div class="reveal"><?php echo aicc_player_html(); ?></div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head reveal">
      <h2>What happens on the calls</h2>
      <p class="lead">Every call follows your practice's protocols. A few situations from a normal month.</p>
    </div>
    <div class="scen reveal" data-scen>
      <div class="stabs" role="tablist">
        <button class="stab" role="tab" aria-selected="true" data-stab="0"><i class="meter"></i><strong>Red flag escalation</strong><span>Chest pain reported on a check-in</span></button>
        <button class="stab" role="tab" aria-selected="false" data-stab="1"><i class="meter"></i><strong>After an ER visit</strong><span>Care plan updated, follow-up booked</span></button>
        <button class="stab" role="tab" aria-selected="false" data-stab="2"><i class="meter"></i><strong>Spanish-language check-in</strong><span>Same program, patient's language</span></button>
        <button class="stab" role="tab" aria-selected="false" data-stab="3"><i class="meter"></i><strong>Patient says not now</strong><span>Recorded, nothing billed</span></button>
      </div>
      <div class="sframe fluted deep">
        <div class="fl-ribs" aria-hidden="true"><i></i><i></i><i></i><i></i></div>
        <span class="sname" data-sname>Call</span>
        <div class="shot"><img data-simg src="<?php echo esc_url($ph('scene-nurse')); ?>" alt="" loading="lazy" width="1000" height="753"></div>
        <div class="slines lines" data-slines></div>
        <div class="srec" data-srec></div>
      </div>
    </div>
  </div>
</section>
<script type="application/json" id="aicc-scenarios">
<?php echo wp_json_encode([
  ['name' => 'Check-in · Linda K., 80', 'img' => $ph('scene-nurse'), 'lines' => [
    ['ai', 'Hi Linda, it’s Ava from Dr. Patel’s office, for your monthly check-in. How have you been feeling?'],
    ['pt', 'Not great. I’ve had some pressure in my chest since this morning.'],
    ['ai', 'I’m sorry. Is the pressure there right now, and does it spread to your arm, jaw or back?'],
    ['pt', 'It’s there now. A little in my left arm.'],
    ['ai', 'Linda, this could be serious. I’m connecting you to the on-call nurse right now. If the line drops, please call 911.'],
    ['sys', 'Warm transfer to on-call RN · 0:42 into call'],
  ], 'rec' => [['Red-flag protocol: chest pain', 'red', 'Triggered'], ['Warm transfer to on-call RN', 'green', 'Connected'], ['Practice alerted by text and email', '', 'Sent'], ['Call recording and notes saved', '', 'Chart']]],
  ['name' => 'After an ER visit · James R., 68', 'img' => $ph('scene-discharge'), 'lines' => [
    ['ai', 'Hi James, it’s Ava from Dr. Patel’s office. I saw you were in the ER on Saturday. How are you feeling?'],
    ['pt', 'Better. They said it was my blood sugar.'],
    ['ai', 'I’m glad you’re home. Did they change any of your medications?'],
    ['pt', 'They upped my metformin. I haven’t picked it up yet.'],
    ['ai', 'Okay. I’ll let Dr. Patel’s team know, and I can book you in to see him this week. Does Thursday at 2 work?'],
    ['pt', 'Thursday’s fine.'],
  ], 'rec' => [['ER visit noted from hospital record', '', 'Synced'], ['New dose not yet filled', 'amber', 'Flagged'], ['Follow-up Thursday 2:00 p.m.', '', 'Booked'], ['Care plan updated for APCM', 'green', 'Chart']]],
  ['name' => 'Chequeo · Rosa M., 71', 'img' => $ph('p-rosa'), 'lines' => [
    ['ai', 'Hola, señora Rosa. Soy Ava, del consultorio del Dr. Patel. ¿Tiene unos minutos para su chequeo mensual?'],
    ['pt', 'Sí, claro.'],
    ['ai', '¿Cómo ha estado su azúcar esta semana?'],
    ['pt', 'Un poco alta en las mañanas.'],
    ['ai', 'Gracias. Lo anoto para la enfermera. ¿Necesita algún medicamento?'],
    ['pt', 'No, todo bien.'],
  ], 'rec' => [['Check-in completed in Spanish', 'green', 'Done'], ['Morning glucose running high', 'amber', 'Nurse review'], ['Medications on track', 'green', 'OK'], ['English summary added to chart', '', 'Chart']]],
  ['name' => 'Enrollment · Henry L., 79', 'img' => $ph('p-henry'), 'lines' => [
    ['ai', 'Hi Henry, it’s Ava from Dr. Patel’s office. Dr. Patel would like us to check in with you once a month between visits. Can I tell you about it?'],
    ['pt', 'I’d rather not right now. My daughter handles my appointments.'],
    ['ai', 'That’s completely fine. Would it help if I called her instead, with your okay?'],
    ['pt', 'Maybe later. Not this month.'],
    ['ai', 'No problem. I’ll make a note, and nothing changes with your care. Take care, Henry.'],
  ], 'rec' => [['Patient declined for now', '', 'Recorded'], ['No consent, nothing billed', 'green', 'Correct'], ['Daughter as contact suggested', 'amber', 'For staff'], ['Re-offer at next visit', '', 'Note']]],
]); ?>
</script>


<section class="section-tight" id="calculator">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>What it could add to your practice</h2>
    </div>
    <div class="reveal"><?php echo aicc_calculator_html(); ?></div>
  </div>
</section>

<section>
  <div class="band-dark">
    <div class="wrap">
      <div class="section-head">
        <span class="label">Clinical control</span>
        <h2>You get the revenue. Your clinicians keep control.</h2>
        <p class="lead">We do the routine work for every patient. Your clinicians set the protocols, approve care plans and make every clinical decision.</p>
      </div>
      <div class="grid-2">
        <div class="dark-card"><h4>The coordinator handles</h4><ul>
          <li>Finding eligible patients by APCM level</li><li>Enrollment calls and recorded consent</li><li>Monthly check-in calls and texts</li><li>Refill requests and visit booking</li><li>Care plan updates</li><li>The monthly APCM billing report</li></ul></div>
        <div class="dark-card alt"><h4>Your team handles</h4><ul>
          <li>Clinical protocols and red-flag rules</li><li>Approving care plans and changes</li><li>Escalated calls, around the clock via your on-call clinician</li><li>Medication changes and clinical advice</li><li>Reviewing and submitting claims</li><li>Approving which patients are offered APCM</li></ul></div>
      </div>
    </div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>Three ways to care for patients between visits</h2>
    </div>
    <div class="tablewrap reveal">
      <table class="compare">
        <thead><tr><th></th><th>Hire care coordinators</th><th>Outsourced care management</th><th class="us">AI Care Coordinator</th></tr></thead>
        <tbody>
          <tr><td>Patients reached each month</td><td>Limited by staff hours</td><td>Limited by their staff</td><td class="us">Every enrolled patient</td></tr>
          <tr><td>Hours</td><td>Office hours</td><td>Their schedule</td><td class="us">Any time, with escalation 24/7</td></tr>
          <tr><td>Who talks to your patients</td><td>Your staff</td><td>Their nurses, under your name</td><td class="us">Ava, for your practice. Your team for anything clinical</td></tr>
          <tr><td>Time to launch</td><td>Hiring and training</td><td>Contract and onboarding</td><td class="us">Weeks</td></tr>
          <tr><td>How you pay</td><td>Salaries and benefits</td><td>Often a share of collections</td><td class="us">Flat fee per enrolled patient</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section>
  <div class="wrap faq-split">
    <div class="section-head reveal"><h2>Questions practices ask</h2><p class="lead">More on codes, eligibility and consent is on the <a href="<?php echo esc_url(aicc_url('apcm')); ?>">APCM page</a>.</p><a class="btn btn-ghost" href="<?php echo esc_url($demo); ?>">Ask us anything</a></div>
    <div class="faq reveal">
      <?php foreach (aicc_home_faqs() as $f): ?>
        <details><summary><?php echo esc_html($f[0]); ?></summary><div><?php echo wp_kses_post($f[1]); ?></div></details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="cta-panel fluted reveal">
      <div class="fl-ribs" aria-hidden="true"><i></i><i></i><i></i><i></i></div>
      <div class="cta-faces"><?php foreach (['p-james', 'p-margaret', 'p-rosa', 'p-henry'] as $f) echo '<img src="' . esc_url($ph($f)) . '" alt="" loading="lazy" width="560" height="743">'; ?></div>
      <h2>Care for every patient. Get paid every month.</h2>
      <p class="lead">Book a 20-minute demo. We'll estimate what your practice could bill each month and play a call with your own scenarios.</p>
      <div class="cta-row"><a class="btn btn-primary" href="<?php echo esc_url($demo); ?>">Book a demo</a><a class="btn btn-ghost" href="#calculator">Estimate revenue</a></div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
