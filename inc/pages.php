<?php
/**
 * Page manifest: every page the theme installs, with its SEO fields.
 * Content lives in /content/{slug}.html.
 */
if (!defined('ABSPATH')) exit;

function aicc_home_faqs() {
    return [
        ['What is APCM?', '<p>Advanced Primary Care Management is a Medicare program that pays primary care practices a monthly amount for each patient whose care they manage between visits. It is billed with three codes, G0556, G0557 and G0558, once per patient per month. There is no minimum number of minutes.</p>'],
        ['Which patients qualify?', '<p>Medicare patients who consent and whose primary care you provide. The level depends on the patient: G0556 for one or no chronic conditions, G0557 for two or more, and G0558 for two or more when the patient is a Qualified Medicare Beneficiary.</p>'],
        ['What does my team have to do?', '<p>Approve the patient list and the care plan template, set your red-flag rules, and review the monthly report before your practitioner bills. We do the enrollment calls, the monthly check-ins, the care plan updates and the documentation. Your team only hears about patients who need a clinician.</p>'],
        ['Can a practice bill APCM when an AI makes the calls?', '<p>APCM is billed by the practitioner responsible for the patient\'s primary care, and CMS lets auxiliary staff provide the service elements under general supervision. Because APCM is not time-based, there are no staff minutes to prove. Your practitioner stays responsible and bills. Have your compliance advisor review your setup.</p>'],
        ['What does the patient pay?', '<p>APCM is a Medicare Part B service, so the patient\'s usual coinsurance can apply unless a supplemental plan covers it. The coordinator explains this before the patient agrees, and records that they can stop at any time.</p>'],
        ['Why APCM and not CCM?', '<p>CCM pays for minutes of clinical staff time, so an AI call does not add billable CCM minutes. APCM pays for managing the patient each month, with no minutes to count, which is the work we automate. You can bill APCM or CCM for a patient in a month, not both.</p>'],
        ['What happens if a patient reports something urgent?', '<p>Red-flag symptoms you define, such as chest pain or trouble breathing, trigger your protocol on the call: a warm transfer to your on-call clinician or an instruction to call 911, plus an alert to your team.</p>'],
        ['How is it priced?', '<p>A flat monthly fee per enrolled patient. We don\'t take a percentage of your Medicare billing.</p>'],
        ['Which EHRs do you integrate with?', '<p>It integrates with Epic, Oracle Health (Cerner), athenahealth, eClinicalWorks, NextGen, AdvancedMD, ModMed, Meditech and other major EHRs, and supports 500+ clinics and EHRs. Consent records, call notes and care plan updates go back into the chart for your team to review.</p>'],
    ];
}

function aicc_pages() {
    return [
        'home' => [
            'title' => 'Home',
            'seo_title' => 'Get Paid for the Care Between Visits | Automated APCM for Primary Care',
            'desc' => 'Medicare pays your practice every month to care for patients between visits (APCM). We make every enrollment and check-in call, so patients get cared for and you get paid, with no new staff.',
            'order' => 0,
        ],
        'apcm' => [
            'title' => 'APCM',
            'h1' => 'Run APCM for every eligible patient, without new hires',
            'seo_title' => 'APCM Program with an AI Care Coordinator (G0556, G0557, G0558)',
            'desc' => 'Launch Advanced Primary Care Management with an AI care coordinator: eligibility, consent, monthly touchpoints and billing reports for G0556, G0557 and G0558.',
            'label' => 'Advanced Primary Care Management',
            'answer' => 'Yes, a practice can run APCM with an AI care coordinator. APCM is billed once per patient per month with no time minimum. The AI handles outreach, check-ins and documentation under your clinical team\'s general supervision, and your practitioner bills.',
            'order' => 10, 'nav' => 'programs', 'blurb' => 'What we automate: G0556, G0557, G0558',
        ],
        'chronic-care-management' => [
            'title' => 'Chronic Care Management',
            'h1' => 'Chronic care management, and why we run APCM instead',
            'seo_title' => 'CCM vs APCM: Why AI Calls Don\'t Count Toward CCM Minutes',
            'desc' => 'CCM pays for minutes of clinical staff time, so AI calls don\'t add billable CCM time. How CCM works, how APCM differs, and how practices move CCM patients to APCM.',
            'label' => 'Chronic Care Management (CCM)',
            'answer' => 'CCM pays for clinical staff or practitioner time spent managing patients with two or more chronic conditions, starting at 20 minutes a month for code 99490. Time spent by software is not clinical staff time, so an AI call does not add CCM minutes. APCM has no time requirement, which is why we automate APCM.',
            'order' => 20, 'nav' => 'programs', 'blurb' => 'Why AI calls don\'t add CCM minutes',
        ],
        'transitional-care-management' => [
            'title' => 'Transitional Care Management',
            'h1' => 'Reach every discharged patient within two business days',
            'seo_title' => 'Transitional Care Management (TCM): AI Post-Discharge Calls',
            'desc' => 'Make the TCM interactive contact within two business days of discharge for every patient, book the follow-up visit and document it for 99495 or 99496.',
            'label' => 'Transitional Care Management (TCM)',
            'answer' => 'TCM requires an interactive contact with the patient within two business days of discharge and a face-to-face visit within 7 or 14 days. An AI care coordinator can call every discharged patient on time, check medications and symptoms, and book the visit.',
            'order' => 30, 'nav' => 'programs', 'blurb' => 'Two-business-day calls, 99495 and 99496',
        ],
        'remote-patient-monitoring' => [
            'title' => 'Remote Patient Monitoring',
            'h1' => 'Keep RPM patients engaged and their readings coming in',
            'seo_title' => 'Remote Patient Monitoring (RPM) Engagement with an AI Care Coordinator',
            'desc' => 'Use an AI care coordinator to keep remote patient monitoring patients sending readings, follow up on missed days and flag out-of-range values to your team.',
            'label' => 'Remote Patient Monitoring (RPM)',
            'answer' => 'RPM only pays when patients keep sending readings and someone follows up on them. An AI care coordinator calls or texts patients who stop sending data, checks in on out-of-range readings and routes anything clinical to your team.',
            'order' => 40, 'nav' => 'programs', 'blurb' => 'Adherence calls and reading follow-up',
        ],
        'referral-follow-up' => [
            'title' => 'Referral Follow-up',
            'h1' => 'Turn every referral into a booked appointment',
            'seo_title' => 'Referral Follow-up with an AI Care Coordinator | Close Referral Leakage',
            'desc' => 'Up to half of specialist referrals are never completed. An AI care coordinator calls each referred patient within hours, books the visit and reports back to the referring practice.',
            'label' => 'Referral follow-up',
            'answer' => 'Up to half of referrals to specialists are never completed. An AI care coordinator calls every referred patient within hours, answers their questions, books the appointment and tells the referring practice it happened.',
            'order' => 50, 'nav' => 'programs', 'blurb' => 'Call every referred patient within hours',
        ],
        'patient-care-coordination' => [
            'title' => 'Patient Care Coordination',
            'h1' => 'Patient care coordination for primary care practices',
            'seo_title' => 'Patient Care Coordination: What It Is and How Practices Get Paid',
            'desc' => 'What patient care coordination is, which Medicare programs pay primary care practices for it (APCM, CCM, TCM) and how an AI care coordinator scales it.',
            'label' => 'Care coordination',
            'answer' => 'Patient care coordination means organizing a patient\'s care and sharing information across everyone involved in it. Medicare pays primary care practices for it through programs like APCM, CCM and TCM, and an AI care coordinator can do the routine outreach for every patient.',
            'order' => 60, 'nav' => 'resources', 'blurb' => 'What it is and how practices get paid',
        ],
        'revenue-calculator' => [
            'title' => 'APCM Revenue Calculator',
            'h1' => 'APCM revenue calculator',
            'seo_title' => 'APCM Revenue Calculator: Estimate Your Monthly Care Management Revenue',
            'desc' => 'Estimate what your practice could bill each month under APCM codes G0556, G0557 and G0558 based on your Medicare panel and enrollment rate.',
            'label' => 'Calculator',
            'answer' => 'Monthly APCM revenue is roughly the number of enrolled patients at each level multiplied by that level\'s rate. Enter your Medicare panel below; the rates are editable so you can use your local figures.',
            'order' => 70, 'nav' => 'resources', 'blurb' => 'Estimate your monthly APCM revenue',
        ],
        'ai-care-coordinator-vs-hiring' => [
            'title' => 'AI Care Coordinator vs Hiring',
            'h1' => 'AI care coordinator vs hiring a care coordinator',
            'seo_title' => 'AI Care Coordinator vs Hiring a Care Coordinator: Cost and Coverage',
            'desc' => 'Compare hiring care coordinators, outsourcing to a CCM vendor and using an AI care coordinator on cost, coverage, hours and how your clinical team stays involved.',
            'label' => 'Compare',
            'answer' => 'A care coordinator can make a limited number of patient calls a day, during office hours. An AI care coordinator calls every enrolled patient every month, at any hour, and hands clinical issues to your staff, so your team focuses on the patients who need a person.',
            'order' => 80, 'nav' => 'resources', 'blurb' => 'Cost and coverage side by side',
        ],
        'pricing' => [
            'title' => 'Pricing',
            'h1' => 'Simple pricing per enrolled patient',
            'seo_title' => 'Pricing | AI Care Coordinator',
            'desc' => 'A flat monthly fee per enrolled patient. No percentage of your Medicare billing.',
            'label' => 'Pricing',
            'answer' => 'You pay a flat monthly fee for each enrolled patient the coordinator manages. We never take a percentage of what you bill Medicare.',
            'order' => 90,
        ],
        'security' => [
            'title' => 'Security',
            'h1' => 'Security and compliance',
            'seo_title' => 'Security, HIPAA and Compliance | AI Care Coordinator',
            'desc' => 'How the AI care coordinator protects patient data: HIPAA compliant, SOC 2 Type II audited controls, a signed BAA before go-live, encryption and clinician-controlled escalation.',
            'label' => 'Security',
            'answer' => 'We are HIPAA compliant and our controls are SOC 2 Type II audited. Every practice signs a Business Associate Agreement with us before any patient data is shared, and your clinicians decide how and when the coordinator escalates.',
            'order' => 100,
        ],
        'book-a-demo' => [
            'title' => 'Book a Demo',
            'h1' => 'Book a demo',
            'seo_title' => 'Book a Demo | AI Care Coordinator',
            'desc' => 'Hear an APCM enrollment call with your own scenarios and get an estimate of what your practice could bill each month.',
            'label' => 'Demo',
            'order' => 110,
        ],
        'privacy-policy' => [
            'title' => 'Privacy Policy',
            'h1' => 'Privacy policy',
            'seo_title' => 'Privacy Policy | AI Care Coordinator',
            'desc' => 'How aicarecoordinator.com handles information submitted through this website.',
            'order' => 200, 'noindex' => true,
        ],
        'coordinator' => [
            'title' => 'AI Care Coordinator (saved version)',
            'seo_title' => 'AI Care Coordinator for APCM & CCM | Every Patient, Every Month',
            'desc' => 'An AI care coordinator that runs your APCM and CCM programs: eligibility, consent calls, monthly check-ins, escalation and billing-ready logs. Your clinicians stay in charge.',
            'label' => 'APCM · CCM · TCM · RPM',
            'order' => 300, 'noindex' => true,
        ],
        'guides' => [
            'title' => 'Guides',
            'h1' => 'Guides to APCM and Medicare care management',
            'seo_title' => 'Care Management Guides: APCM, CCM, TCM and RPM',
            'desc' => 'Practical guides for primary care practices running APCM, CCM, TCM, RPM and referral programs.',
            'label' => 'Guides',
            'order' => 120,
        ],
    ];
}
