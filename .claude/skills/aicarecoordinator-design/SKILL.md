---
name: aicarecoordinator-design
description: Style guide and working rules for aicarecoordinator.com (the AI Care Coordinator site, repo chcalibrr/ai-care). Use it before any change to that site - new pages or guides, copy edits, sections, components, social images, or theme code - so the work matches the site's look, voice and deploy flow.
---

# aicarecoordinator.com design and editing guide

The site is a custom WordPress theme in the GitHub repo `chcalibrr/ai-care`. It runs on SiteGround. Anything you change on the site goes through this repo. Read this whole file before your first edit in a run.

## 1. Brand rules (never break these)

- **Name:** "AI Care Coordinator". The logo is the purple icon in `assets/img/favicon.svg` next to the words "AI Care Coordinator", with no background tile behind the icon.
- **No Cevro or ChatForm anywhere** on the site: not in copy, alt text, file names, meta tags, schema, comments or social images.
- **Who reads it:** MDs, nurse practitioners, PAs and primary care practice managers in the US. Write for a busy practice manager, not for an investor or an engineer.
- **Positioning:** the home page is about APCM (Advanced Primary Care Management). Other programs (CCM, TCM, RPM, referral follow-up) live on their own pages.
- **Facts you may state:** HIPAA compliant, SOC 2 Type II, a signed BAA with every practice, flat monthly fee per enrolled patient, no percentage of the practice's Medicare billing. For integrations, always use this wording: "Integrates with and supports 500+ clinics and EHRs". Never write "live in 500+ clinics". Never invent customer names, results, testimonials or numbers.
- **Keep old versions.** Don't delete pages, templates, images or files. `page-coordinator.php` is the saved earlier home page (`/coordinator/`, not indexed) and stays.

## 2. Voice and copy

- Plain words with no jargon. Lead with care and money: the patient gets cared for between visits, and the practice gets paid for it.
- Talk about the practice's pain. Most of their eligible patients aren't getting this care, and doing it by hand needs too many staff. Don't write market or investor lines like "very few practices are getting paid for this".
- **APCM in titles:** don't use "APCM" in H1s, hero headlines or section titles on the home page, because buyers don't know the acronym. Do name it in body copy, as the Medicare program the practice bills under (codes G0556, G0557, G0558). On the APCM page itself, the acronym in the H1 is fine.
- Nothing that sounds AI-written: no slogan headers, no "it's not X, it's Y", no rhetorical questions as headings, no "unlock", "seamless", "revolutionize", "game-changer" or "in today's fast-paced world". No em dashes in headlines.
- Headings are sentence case. Short sentences. One idea per paragraph.
- The calling agent never calls itself "AI" to patients. In any call script or transcript it is "Ava from Dr. Patel's office" (or another name from the practice).
- Clinical and billing claims need a source. Guides and program pages end with a `Sources` block that links to CMS, AAFP and similar sources (see 5).
- Healthcare caution: never promise reimbursement amounts. Use "approx." and the year, and say that rates vary by locality.

## 3. Visual system

All tokens are defined in `assets/css/site.css` under `:root`. Use the variables and never hard-code new colors.

| Token | Value | Use |
|---|---|---|
| `--ink` | #17152E | headings, body on light |
| `--ink-2` | #45425E | body copy, leads |
| `--muted` | #827F96 | captions, table headers |
| `--line` / `--line-2` | #E4E3DD / #EDECE7 | borders, dividers |
| `--bg` / `--paper` / `--card` | #F8F8F5 / #F0F0EC / #FFF | page, alternate band, cards |
| `--brand` / `--brand-700` | #6A3DE8 / #5427CF | buttons, links, icons |
| `--tint` / `--tint-2` / `--tint-3` | #E6DCFC / #F3EEFE / #D2C2F8 | soft purple fills |
| `--navy` / `--navy-2` | #1B1535 / #272047 | dark band, play dot |
| `--peach` | #F5E6DB | patient side of chat bubbles |
| green / amber / red (+ `-50`) | status only | never decorative |

- **Font:** Geist (400 regular for headings, 500 for UI, 600 for bold). There is no monospace look anywhere on the site: `--mono` is mapped to Geist on purpose. Don't add a mono or typewriter font.
- **Type scale:** H1 46–84px with tight tracking (-.045em), weight 400. H2 34–54px. Leads are 19px `--ink-2`. Body is 17–17.5px. Headings are light (400), not bold.
- **Radius:** `--r` 12px, `--r-lg` 18px, `--r-xl` 24px. Buttons 8px. The hero panel is 28px.
- **Shadows:** `--shadow` for cards and `--shadow-lg` for floating UI. Over purple, use the purple-tinted shadow `rgba(40,15,110,.2–.28)`.
- **Signature background: the fluted glass gradient.** This is the purple ribbed glass from cevro.ai. Markup: `<div class="fluted">` (or `.fluted.soft` for a quiet lavender version, `.fluted.deep` for dark purple) containing `<div class="fl-ribs" aria-hidden="true"><i></i><i></i><i></i><i></i></div>` and then the content. Use it for the hero panel, the process stage, the scenario frame and the closing CTA. Use at most one or two fluted panels per page; the rest stays on `--bg` / `--paper`.
- **Photos:** real-looking photos of older patients and care staff in `assets/img/photos/` (webp, about 560px wide portraits, plus wide scenes). Use the photos already there. A new photo must look like a real photo of an older US patient or nurse, not an illustration or a stock "doctor with stethoscope" cliché. Keep faces warm and natural.
- **Icons:** small line icons from `aicc_icon()` in PHP (`check`, `arrow`, `play` and others). Icons are 15–16px, colored `--brand`.
- **Motion:** quiet. A fade or slide reveal (`.reveal`), the drifting ribs, and the waveform and typing in the call card. Respect `prefers-reduced-motion`. No bouncy or flashy animation.
- Don't add new dependencies such as frameworks, icon fonts or UI kits. The theme is plain PHP, CSS and one JS file.

## 4. How the theme is built

- `front-page.php`: home page. `page.php`: every other page. `single.php` / `home.php`: guides (posts).
- `inc/pages.php`: **the page manifest**. Each page has `title`, `h1`, `seo_title`, `desc`, `label` (the pill above the H1), `answer` (the short direct answer under the H1, which AI search engines quote), `order`, `nav` and `blurb` (menu text). It also holds the home FAQ.
- `content/{slug}.html`: page bodies (HTML only, with no `<html>`, `<head>` or inline `<style>`).
- `inc/shortcodes.php`: call player, transcript and revenue calculator. `inc/forms.php`: demo form. `inc/seo.php`: titles, meta, schema, robots, `llms.txt`. `inc/tracking.php`: GA4 and LinkedIn tags (leave alone unless asked).
- `inc/setup.php`: the page installer. On every new theme version it creates any missing pages and refreshes content from `content/*.html`, **except** pages someone edited inside WordPress (it compares a stored hash). If your change doesn't show up, the page was probably edited in WordPress. Don't force-overwrite it; report it.

### Adding a page
1. Add the entry to `aicc_pages()` in `inc/pages.php`, with every field filled in: `seo_title` under about 60 characters, `desc` under about 155, and a one- or two-sentence `answer`.
2. Write `content/{slug}.html` with the components in section 5.
3. Make its social image: `assets/img/og/{slug}.jpg` (section 6). Every new or duplicated page needs its own image. Never let a page fall back to `home.jpg`.
4. If it belongs in the menu, set `nav` and `blurb`.

## 5. Page components (copy these patterns)

Body copy in `content/*.html` is wrapped by `.prose` (820px column). Use:

```html
<h2>What APCM is</h2>
<p>Plain paragraph.</p>

<ol class="page-steps"><li><strong>Consent.</strong> One or two sentences.</li></ol>

<table><thead><tr><th>Code</th><th>Who it covers</th></tr></thead><tbody><tr><td><strong>G0556</strong></td><td>…</td></tr></tbody></table>

<div class="grid-3" style="margin:8px 0 40px">
  <div class="card"><span class="top"></span><h3 style="margin-top:14px">Flat fee per patient</h3><p>…</p></div>
</div>

<div class="faq">
  <details><summary>Is APCM time-based?</summary><div><p>No. …</p></div></details>
</div>

<div class="sources"><h2>Sources</h2><ol>
  <li><a href="https://www.cms.gov/…" rel="nofollow noopener" target="_blank">CMS: Advanced Primary Care Management services</a></li>
</ol></div>
```

- Usual page order: direct answer (from the manifest) → what it is → what's required → where the coordinator fits (a table of what we do and what your team does) → FAQ (4–6 questions) → Sources.
- Book a demo is the one main call to action (`btn btn-primary`). "Hear a call" is the second (`btn btn-ghost` with the navy play dot). Don't add other CTAs.
- Home-page sections already exist (hero in a fluted panel, EHR logo strip, mission split, process stepper, sample call, scenarios, stats, calculator, FAQ, CTA). Edit them inside `front-page.php`; don't rebuild the layout. A repositioning changes the copy only and keeps the layout and design.

## 6. Social (OG) images

The size is 1200×630 JPG: lavender fluted background, logo and name top left, the page H1 on the left in Geist, a label pill bottom left, and a portrait photo on the right in a 24px-radius card. Generate it with the script in this skill (from the repo root):

```
python3 .claude/skills/aicarecoordinator-design/scripts/make_og.py \
  --title "<the page H1>" --label "<pill text>" \
  --photo assets/img/photos/<photo>.webp --out assets/img/og/<slug>.jpg
```

Open the result and look at it before committing. Pick a photo that isn't already used on a sibling page's image if you can.

## 7. Shipping a change

1. Work on `main` in a fresh clone of `chcalibrr/ai-care`. Bump `Version:` in `style.css` (patch for copy, minor for new pages or sections).
2. Check locally: `php -l` on every PHP file you touched, valid HTML in `content/`, no Cevro or ChatForm (`grep -ril "cevro\|chatform" --exclude-dir=.git --exclude-dir=.claude .` must print nothing), and no new font families. The `.mono` class is fine, since it's mapped to Geist.
3. Commit with a plain message saying what changed, then push.
4. Deploy through the Git Updater webhook using the **full commit SHA**: `https://aicarecoordinator.com/wp-json/git-updater/v1/update/?key=$AICC_GU_KEY&theme=ai-care&committish=<SHA>&override=1`. The key is a secret on the server. Never print it, post it or commit it; this repo is public.
5. Purge the SiteGround cache (WordPress admin bar > Purge SG Cache), or add `?nc=<random>` when checking.
6. **Check live:** the page loads (200), the H1 and copy are what you wrote, `og:image` points at the new image and the image loads, and the page is listed in `/wp-sitemap.xml` (noindex pages are kept out on purpose). Take a desktop screenshot (1440 wide) and a phone one (390 wide) and look at both.
7. Report in one or two plain lines what changed, with the URL.

**Ask Chaim first** before changing the home hero headline, pricing wording, the integrations claim, the brand name or logo, tracking tags, or deleting anything.
