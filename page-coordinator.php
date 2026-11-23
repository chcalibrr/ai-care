<?php
/**
 * Saved version: 'AI care coordinator for every patient' home page (v1.2, Nov 2026).
 * Kept for a possible return to coordinator positioning. Not indexed.
 */
if (!function_exists('aicc_home_faqs_coordinator')) {
function aicc_home_faqs_coordinator() {
    return [
        ['Can a practice bill APCM when an AI makes the calls?', '<p>APCM is billed by the practitioner responsible for the patient\'s primary care, and CMS designates it a care management service that auxiliary staff can provide under general supervision. APCM is not time-based. The coordinator does outreach, check-ins and documentation under your clinical team\'s supervision; your practitioner stays responsible and bills. Have your compliance advisor review your setup.</p>'],
        ['Does the patient know they are talking to an AI?', '<p>Yes. The coordinator introduces itself as an AI care coordinator calling for your practice at the start of every call. Patients can ask for a person at any time.</p>'],
        ['What happens if a patient reports something urgent?', '<p>Red-flag symptoms you define, such as chest pain, trouble breathing or signs of stroke, trigger your protocol in real time: a warm transfer to your on-call clinician, or an instruction to call 911, plus an alert to your team.</p>'],
        ['Which programs does it support?', '<p>Advanced Primary Care Management (G0556, G0557, G0558), Chronic Care Management, Transitional Care Management, Remote Patient Monitoring engagement and referral follow-up.</p>'],
        ['How does it connect to our EHR?', '<p>We connect to your EHR during onboarding, or start from a regular export of your patient list. Notes, consent records and care plan updates go back into the chart for your team to review.</p>'],
        ['How is it priced?', '<p>A flat monthly fee per enrolled patient. We don\'t take a percentage of your Medicare billing.</p>'],
        ['Is patient data protected?', '<p>Our controls are SOC 2 Type II audited, and we sign a Business Associate Agreement with every practice before any patient data is shared.</p>'],
        ['What languages does it speak?', '<p>English and Spanish, with more languages available on request.</p>'],
    ];
}
}
?>
<?php get_header(); $demo = aicc_url('book-a-demo');
$ph = function ($n) { return get_theme_file_uri('assets/img/photos/' . $n . '.webp'); }; ?>

<section class="hero">
  <div class="hero-panel fluted">
  <div class="fl-ribs" aria-hidden="true"><i></i><i></i><i></i><i></i></div>
  <div class="wrap hero-grid">
    <div class="reveal">
      <h1>An AI care coordinator for every patient</h1>
      <p class="lead">It finds eligible Medicare patients, gets consent, calls each one every month, escalates red flags to your clinicians and hands billing a clean report for APCM and CCM.</p>
      <div class="hero-ctas">
        <a class="btn btn-primary" href="<?php echo esc_url($demo); ?>">Book a demo</a>
        <a class="btn btn-text" href="#listen"><span class="dot"><?php echo aicc_icon('play'); ?></span>Hear a real check-in</a>
      </div>
      <div class="hero-note">
        <span><?php echo aicc_icon('check'); ?>APCM, CCM, TCM and RPM</span>
        <span><?php echo aicc_icon('check'); ?>Your clinicians stay in charge</span>
        <span><?php echo aicc_icon('check'); ?>SOC 2 Type II</span>
      </div>
    </div>
    <div class="stage reveal" data-hero aria-label="Animated example of an AI check-in call">
      <img class="photo" src="<?php echo esc_url($ph('hero-helen')); ?>" alt="Older woman at her kitchen table taking a check-in call on her phone" width="1000" height="1250" fetchpriority="high">
      <div class="events">
        <div class="event" data-ev><div class="ava pt">MS</div><div><strong>Consent recorded</strong><span>Maria S., 72 F</span></div><em class="tag">APCM</em></div>
        <div class="event" data-ev><div class="ava pt">JR</div><div><strong>Check-in complete</strong><span>James R., 68 M</span></div><em class="tag green">G0557</em></div>
        <div class="event" data-ev><div class="ava pt">LK</div><div><strong>Red flag escalated</strong><span>Linda K., 80 F</span></div><em class="tag red">On-call RN</em></div>
        <div class="event" data-ev><div class="ava pt">RT</div><div><strong>Referral booked</strong><span>Robert T., 75 M</span></div><em class="tag">Cardiology</em></div>
      </div>
      <div class="callcard">
        <div class="callcard-top"><div class="ava"><?php echo aicc_mark_svg(); ?></div><div><strong>Ava, care coordinator</strong><span>Calling Helen W., 74</span></div><span class="timer" data-timer>0:00</span></div>
        <div class="wave" data-wave><?php echo str_repeat('<i></i>', 40); ?></div>
        <div class="lines" data-lines></div>
      </div>
    </div>
  </div>
</div>
</section>

<div class="marquee" aria-hidden="true"><div class="marquee-track">
<?php $m = ['Advanced Primary Care Management', 'Chronic Care Management', 'Transitional Care Management', 'Remote Patient Monitoring', 'Referral follow-up', 'Annual wellness visits', 'Medication refills', 'English and Spanish', '24/7 escalation to your on-call team'];
foreach (array_merge($m, $m) as $x) echo '<span>' . esc_html($x) . '</span>'; ?>
</div></div>

<section class="mission">
  <div class="wrap mission-grid">
    <div class="reveal">
      <h2>Every Medicare patient on your panel, checked on every month.</h2>
      <p class="lead">Most practices only reach the patients who call in. The coordinator calls everyone on the program, in their language, and leaves your nurses the cases that need a clinician.</p>
      <div class="face-sum"><b>337</b><span>patients with a documented monthly touchpoint in an example practice, ready for practitioner review</span></div>
    </div>
    <div class="faces reveal" data-faces>
      <?php foreach ([['p-james', 'James R.', 'BP log reviewed'], ['p-margaret', 'Margaret H.', 'Refill requested'], ['p-rosa', 'Rosa M.', 'Check-in in Spanish'], ['p-henry', 'Henry L.', 'Wellness visit booked']] as $f): ?>
        <div class="face"><img src="<?php echo esc_url($ph($f[0])); ?>" alt="" loading="lazy" width="560" height="743"><span class="chip"><i><?php echo aicc_icon('check'); ?></i><span><b><?php echo esc_html($f[1]); ?></b><?php echo esc_html($f[2]); ?></span></span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section id="how">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="label">How it works</span>
      <h2>From patient list to billing report, every month</h2>
      <p class="lead">Four jobs your staff don't have time for, done for every eligible patient, with your clinical team approving what matters.</p>
    </div>
    <div class="proc reveal" data-process>
      <div class="ptabs" role="tablist">
        <div class="ptab" role="tab" tabindex="0" aria-selected="true" data-ptab="0"><i class="pbar"></i><span class="pn">01</span><div class="pbody"><span class="ptitle">Find every eligible patient</span><div class="pdesc"><p>We read your patient list and sort Medicare patients by APCM level, based on chronic conditions and Qualified Medicare Beneficiary status, so the right code is clear before anyone is called.</p><ul class="ticks"><li>Sorted into G0556, G0557 and G0558</li><li>Patients already in CCM flagged for review</li><li>Nothing is billed until your team approves</li></ul></div></div></div>
        <div class="ptab" role="tab" tabindex="0" aria-selected="false" data-ptab="1"><i class="pbar"></i><span class="pn">02</span><div class="pbody"><span class="ptitle">Explain the program and get consent</span><div class="pdesc"><p>The coordinator calls each eligible patient, says it is an AI calling for your practice, explains what the program covers and any cost sharing, and records verbal consent in the chart.</p><ul class="ticks"><li>Discloses it's an AI on every call</li><li>Explains cost sharing and the right to stop anytime</li><li>Consent saved with date, time and recording</li></ul></div></div></div>
        <div class="ptab" role="tab" tabindex="0" aria-selected="false" data-ptab="2"><i class="pbar"></i><span class="pn">03</span><div class="pbody"><span class="ptitle">Check in with every patient, every month</span><div class="pdesc"><p>Medications, symptoms, readings, upcoming visits and anything the patient needs. Routine requests get handled; anything clinical goes to your team.</p><ul class="ticks"><li>At least one touchpoint per patient per month</li><li>Refill requests and visit booking handled</li><li>Red flags escalated to your on-call clinician</li></ul></div></div></div>
        <div class="ptab" role="tab" tabindex="0" aria-selected="false" data-ptab="3"><i class="pbar"></i><span class="pn">04</span><div class="pbody"><span class="ptitle">Hand billing a clean monthly report</span><div class="pdesc"><p>At month end your team gets a report of every patient with a qualifying touchpoint, mapped to the right code, with the documentation behind each line.</p><ul class="ticks"><li>Mapped to G0556, G0557, G0558 or CCM codes</li><li>Call notes, consent and care plan updates linked</li><li>Your practitioner reviews and bills</li></ul></div></div></div>
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
        <div class="pane" data-pane="1"><div class="ui"><div class="ui-h"><span>Enrollment call</span><span class="live">LIVE</span></div><div class="lines" style="padding:16px 18px" data-mini='[["ai","Hi Maria, this is Ava, an AI care coordinator calling for Dr. Patel’s office."],["ai","Dr. Patel’s team offers a care program with monthly check-ins and help with refills and appointments. Medicare covers it, and a small coinsurance may apply."],["pt","That sounds useful. Can I stop if I don’t like it?"],["ai","Yes, you can stop any time. Would you like me to enroll you?"],["pt","Yes, please."],["sys","Verbal consent recorded · added to chart"]]'></div></div></div>
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
      <h2>Hear a monthly check-in</h2>
      <p class="lead">A blood pressure follow-up, a symptom noted for the nurse, a refill request and a wellness visit booked, in under 90 seconds.</p>
    </div>
    <div class="reveal"><?php echo aicc_player_html(); ?></div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head reveal">
      <h2>What the coordinator handles</h2>
      <p class="lead">Every call follows your practice's protocols. These are examples of the situations it handles each day.</p>
    </div>
    <div class="scen reveal" data-scen>
      <div class="stabs" role="tablist">
        <button class="stab" role="tab" aria-selected="true" data-stab="0"><i class="meter"></i><strong>Red flag escalation</strong><span>Chest pain reported on a check-in</span></button>
        <button class="stab" role="tab" aria-selected="false" data-stab="1"><i class="meter"></i><strong>Post-discharge call</strong><span>TCM contact within 2 business days</span></button>
        <button class="stab" role="tab" aria-selected="false" data-stab="2"><i class="meter"></i><strong>Referral follow-up</strong><span>Referred patient booked same day</span></button>
        <button class="stab" role="tab" aria-selected="false" data-stab="3"><i class="meter"></i><strong>Spanish-language check-in</strong><span>Same program, patient's language</span></button>
        <button class="stab" role="tab" aria-selected="false" data-stab="4"><i class="meter"></i><strong>Missed RPM readings</strong><span>No readings for 4 days</span></button>
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
    ['ai', 'Hi Linda, it’s Ava from Dr. Patel’s office for your monthly check-in. How have you been feeling?'],
    ['pt', 'Not great. I’ve had some pressure in my chest since this morning.'],
    ['ai', 'I’m sorry. Is the pressure there right now, and does it spread to your arm, jaw or back?'],
    ['pt', 'It’s there now. A little in my left arm.'],
    ['ai', 'Linda, this could be serious. I’m connecting you to the on-call nurse right now. If the line drops, please call 911.'],
    ['sys', 'Warm transfer to on-call RN · 0:42 into call'],
  ], 'rec' => [['Red-flag protocol: chest pain', 'red', 'Triggered'], ['Warm transfer to on-call RN', 'green', 'Connected'], ['Practice alerted by text and email', '', 'Sent'], ['Call recording and notes saved', '', 'Chart']]],
  ['name' => 'Post-discharge · James R., 68', 'img' => $ph('scene-discharge'), 'lines' => [
    ['ai', 'Hi James, this is Ava, an AI care coordinator from Dr. Patel’s office. I’m calling because you left the hospital yesterday. How are you doing at home?'],
    ['pt', 'Tired, but okay.'],
    ['ai', 'Did the hospital change any of your medications?'],
    ['pt', 'They added a water pill. I haven’t picked it up yet.'],
    ['ai', 'I’ll let Dr. Patel’s team know, and I can book your follow-up visit. Does Thursday at 2 p.m. work?'],
    ['pt', 'Thursday is fine.'],
  ], 'rec' => [['Interactive contact within 2 business days', 'green', 'Done'], ['New medication not yet filled', 'amber', 'Flagged'], ['Follow-up visit Thursday 2:00 p.m.', '', 'Booked'], ['Documented for TCM (99495/99496)', '', 'Chart']]],
  ['name' => 'Referral · Robert T., 75', 'img' => $ph('hero-helen'), 'lines' => [
    ['ai', 'Hi Robert, this is Ava from Dr. Patel’s office. Dr. Patel referred you to a cardiologist this morning. I can help you book it now.'],
    ['pt', 'Oh, I was going to call them next week.'],
    ['ai', 'They have an opening Monday at 9:30 a.m. or Wednesday at 1 p.m. Which is better?'],
    ['pt', 'Wednesday at one.'],
    ['ai', 'Done. I’ll text you the address, and I’ll let Dr. Patel know you’re booked.'],
  ], 'rec' => [['Referral received from Dr. Patel', '', 'Today'], ['Patient reached within 3 hours', 'green', 'Reached'], ['Cardiology, Wed 1:00 p.m.', '', 'Booked'], ['Referring practice notified', 'green', 'Closed']]],
  ['name' => 'Chequeo · Rosa M., 71', 'img' => $ph('p-rosa'), 'lines' => [
    ['ai', 'Hola, señora Rosa. Soy Ava, coordinadora de cuidados con inteligencia artificial del consultorio del Dr. Patel. ¿Tiene unos minutos para su chequeo mensual?'],
    ['pt', 'Sí, claro.'],
    ['ai', '¿Cómo ha estado su azúcar esta semana?'],
    ['pt', 'Un poco alta en las mañanas.'],
    ['ai', 'Gracias. Lo anoto para la enfermera. ¿Necesita algún medicamento?'],
    ['pt', 'No, todo bien.'],
  ], 'rec' => [['Check-in completed in Spanish', 'green', 'Done'], ['Morning glucose running high', 'amber', 'Nurse review'], ['Medications on track', 'green', 'OK'], ['English summary added to chart', '', 'Chart']]],
  ['name' => 'RPM follow-up · Frank D., 77', 'img' => $ph('scene-bp'), 'lines' => [
    ['ai', 'Hi Frank, it’s Ava from Dr. Patel’s office. We haven’t received a blood pressure reading from your cuff in four days. Is everything okay?'],
    ['pt', 'The batteries died, I think.'],
    ['ai', 'That happens. It takes four AA batteries. Would you like me to stay on while you check?'],
    ['pt', 'Okay, it’s on now. Reading 138 over 84.'],
    ['ai', 'Got it, thank you. Readings are coming through again.'],
  ], 'rec' => [['No readings for 4 days', 'amber', 'Detected'], ['Device fixed on the call', 'green', 'Resolved'], ['Reading 138/84 received', 'green', 'In range'], ['Adherence note for RPM review', '', 'Chart']]],
]); ?>
</script>

<section>
  <div class="wrap">
    <div class="section-head reveal">
      <h2>Medicare pays for this work. Most practices don't do it yet.</h2>
      <p class="lead">APCM pays primary care practices every month for managing a patient's care between visits, with no minutes to count. The limit has been staff time to make the calls.</p>
    </div>
    <div class="stats reveal">
      <div class="stat"><b>1.2%</b><p>of Medicare fee-for-service patients received APCM services in the last quarter of 2025, the program's first year.</p><small>Source: <a href="https://www.medicaleconomics.com/view/first-look-at-apcm-data-growth-modest-reach-physician-turnover-for-medicares-primary-care-bundle" rel="nofollow noopener" target="_blank">Medical Economics</a></small></div>
      <div class="stat"><b>43.6%</b><p>of clinicians surveyed were not billing APCM and had never heard of the codes.</p><small>Source: <a href="https://www.medicaleconomics.com/view/first-look-at-apcm-data-growth-modest-reach-physician-turnover-for-medicares-primary-care-bundle" rel="nofollow noopener" target="_blank">Medical Economics</a></small></div>
      <div class="stat"><b>~$50</b><p>a month per patient for G0557, the level used for about 80% of APCM claims.</p><small>Source: <a href="https://aafp.org/content/dam/AAFP/documents/advocacy/payment/medicare/ES-2025MPFSFinalRule-112124.pdf" rel="nofollow noopener" target="_blank">AAFP</a>, 2025 national average</small></div>
      <div class="stat"><b>0 min</b><p>monthly time requirement. APCM is billed once per patient per month when the requirements are met.</p><small>Source: <a href="https://www.cms.gov/medicare/payment/fee-schedules/physician-fee-schedule/advanced-primary-care-management-services" rel="nofollow noopener" target="_blank">CMS</a></small></div>
    </div>
  </div>
</section>

<section class="section-tight" id="calculator">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>What APCM could mean for your practice</h2>
    </div>
    <div class="reveal"><?php echo aicc_calculator_html(); ?></div>
  </div>
</section>

<section>
  <div class="band-dark">
    <div class="wrap">
      <div class="section-head">
        <span class="label">Clinical control</span>
        <h2>Your clinical team stays in charge</h2>
        <p class="lead">The coordinator does the routine work at scale. Your clinicians set the protocols, approve care plans and take every clinical decision.</p>
      </div>
      <div class="grid-2">
        <div class="dark-card"><h4>The coordinator handles</h4><ul>
          <li>Finding eligible patients and explaining the program</li><li>Recording verbal consent</li><li>Monthly check-in calls and texts</li><li>Refill requests and visit booking</li><li>Post-discharge and referral calls</li><li>Documentation and the monthly billing report</li></ul></div>
        <div class="dark-card alt"><h4>Your team handles</h4><ul>
          <li>Clinical protocols and red-flag rules</li><li>Approving care plans and changes</li><li>Escalated calls, around the clock via your on-call clinician</li><li>Medication changes and clinical advice</li><li>Reviewing and submitting claims</li><li>Deciding which patients join which program</li></ul></div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head reveal">
      <h2>One coordinator for every program you run</h2>
    </div>
    <div class="grid-3 reveal">
      <?php foreach (aicc_pages() as $slug => $p): if (!in_array($p['nav'] ?? '', ['programs'], true)) continue; ?>
        <a class="card" href="<?php echo esc_url(aicc_url($slug)); ?>"><h3><?php echo esc_html($p['title'] === 'APCM' ? 'Advanced Primary Care Management' : $p['title']); ?></h3><div class="code"><?php echo esc_html($p['blurb']); ?></div><p><?php echo esc_html($p['desc']); ?></p><span class="arrow">Learn more</span></a>
      <?php endforeach; ?>
      <a class="card" href="<?php echo esc_url(aicc_url('revenue-calculator')); ?>"><h3>Revenue calculator</h3><div class="code">G0556 · G0557 · G0558</div><p>Estimate your monthly APCM revenue from your Medicare panel, with your own local rates.</p><span class="arrow">Open calculator</span></a>
    </div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>Three ways to run care management</h2>
    </div>
    <div class="tablewrap reveal">
      <table class="compare">
        <thead><tr><th></th><th>Hire care coordinators</th><th>Outsourced CCM service</th><th class="us">AI Care Coordinator</th></tr></thead>
        <tbody>
          <tr><td>Patients reached each month</td><td>Limited by staff hours</td><td>Limited by their staff</td><td class="us">Every enrolled patient</td></tr>
          <tr><td>Hours</td><td>Office hours</td><td>Their schedule</td><td class="us">Any time, with escalation 24/7</td></tr>
          <tr><td>Who talks to your patients</td><td>Your staff</td><td>Their nurses, under your name</td><td class="us">An AI that says so, then your team when needed</td></tr>
          <tr><td>Time to launch</td><td>Hiring and training</td><td>Contract and onboarding</td><td class="us">Weeks</td></tr>
          <tr><td>How you pay</td><td>Salaries and benefits</td><td>Often a share of collections</td><td class="us">Flat fee per enrolled patient</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section>
  <div class="wrap faq-split">
    <div class="section-head reveal"><h2>Questions practices ask</h2><p class="lead">More detail on billing, consent and escalation is on each program page.</p><a class="btn btn-ghost" href="<?php echo esc_url($demo); ?>">Ask us anything</a></div>
    <div class="faq reveal">
      <?php foreach (aicc_home_faqs_coordinator() as $f): ?>
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
      <h2>Give every patient a care coordinator</h2>
      <p class="lead">See a live check-in with your own scenarios, and get an estimate of what your practice could bill.</p>
      <div class="cta-row"><a class="btn btn-primary" href="<?php echo esc_url($demo); ?>">Book a demo</a><a class="btn btn-ghost" href="#calculator">Estimate revenue</a></div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
