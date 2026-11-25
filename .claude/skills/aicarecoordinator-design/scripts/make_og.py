#!/usr/bin/env python3
"""Render a 1200x630 social (OG) image in the aicarecoordinator.com style.

Usage (run from the repo root):
  python3 .claude/skills/aicarecoordinator-design/scripts/make_og.py \
      --title "Run APCM for every eligible patient, without new hires" \
      --label "Advanced Primary Care Management" \
      --photo assets/img/photos/p-henry.webp \
      --out assets/img/og/apcm.jpg

Needs Python Playwright with Chromium (pip install playwright; playwright install chromium),
or pass --chrome /path/to/chrome to use an installed Chrome.
"""
import argparse, html, pathlib, tempfile
from playwright.sync_api import sync_playwright

FLUTED = ("radial-gradient(70% 95% at 72% 16%,rgba(122,74,234,.95) 0%,rgba(122,74,234,.55) 34%,rgba(122,74,234,0) 76%),"
          "radial-gradient(55% 75% at 100% 72%,rgba(96,76,168,.75) 0%,rgba(96,76,168,0) 72%),"
          "radial-gradient(60% 85% at 38% -5%,rgba(212,192,252,.95) 0%,rgba(212,192,252,0) 76%),"
          "radial-gradient(70% 75% at 2% 104%,#fff 0%,rgba(255,255,255,0) 72%),"
          "linear-gradient(180deg,#E6DAFC 0%,#F5F0FF 60%,#FDFCFF 100%)")

def main():
    ap = argparse.ArgumentParser()
    ap.add_argument("--title", required=True, help="the page H1, sentence case")
    ap.add_argument("--label", default="", help="short pill text, e.g. the program name")
    ap.add_argument("--photo", default="assets/img/photos/hero-helen.webp")
    ap.add_argument("--out", required=True)
    ap.add_argument("--chrome", default=None, help="optional Chrome/Chromium executable")
    a = ap.parse_args()
    root = pathlib.Path.cwd()
    logo = (root / "assets/img/favicon.svg").resolve().as_uri()
    photo = (root / a.photo).resolve().as_uri()
    label = f'<div class="label">{html.escape(a.label)}</div>' if a.label else ""
    doc = f"""<!doctype html><html><head><meta charset="utf-8">
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500&display=swap" rel="stylesheet">
<style>
*{{box-sizing:border-box}} body{{margin:0;width:1200px;height:630px;font-family:Geist,Inter,system-ui,sans-serif;color:#17152E}}
.bg{{position:absolute;inset:0;display:flex;background:#F4EEFE;background-image:{FLUTED}}}
.bg::before{{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(255,255,255,.55) 0%,rgba(255,255,255,.35) 45%,rgba(255,255,255,.12) 100%)}}
.bg i{{flex:1;position:relative}}
.bg i::after{{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(255,255,255,.20) 0%,rgba(255,255,255,.04) 7%,rgba(255,255,255,0) 30%,rgba(255,255,255,0) 82%,rgba(40,15,100,.05) 100%);border-left:1px solid rgba(255,255,255,.38)}}
.bg i:first-child::after{{border-left:0}}
.brand{{position:absolute;left:72px;top:62px;display:flex;align-items:center;gap:14px;font-size:25px;font-weight:500;letter-spacing:-.02em}}
.brand img{{width:42px;height:42px}}
h1{{position:absolute;left:72px;top:0;bottom:0;margin:auto 0;height:fit-content;width:560px;font-weight:400;font-size:52px;line-height:1.08;letter-spacing:-.035em}}
.label{{position:absolute;left:72px;bottom:56px;font-size:18px;color:#45425E;border:1px solid #E4E3DD;border-radius:10px;padding:9px 14px;background:rgba(255,255,255,.6)}}
.photo{{position:absolute;right:36px;top:36px;width:464px;height:558px;border-radius:24px;object-fit:cover;box-shadow:0 30px 80px rgba(40,15,110,.28)}}
</style></head><body>
<div class="bg"><i></i><i></i><i></i><i></i></div>
<div class="brand"><img src="{logo}">AI Care Coordinator</div>
<h1>{html.escape(a.title)}</h1>{label}
<img class="photo" src="{photo}">
</body></html>"""
    with tempfile.NamedTemporaryFile("w", suffix=".html", delete=False, dir=root) as f:
        f.write(doc); page_path = pathlib.Path(f.name)
    try:
        with sync_playwright() as p:
            b = p.chromium.launch(executable_path=a.chrome) if a.chrome else p.chromium.launch()
            pg = b.new_page(viewport={"width": 1200, "height": 630})
            pg.goto(page_path.as_uri()); pg.wait_for_load_state("networkidle")
            pg.evaluate("document.fonts.ready")
            pg.screenshot(path=a.out, type="jpeg", quality=88)
            b.close()
    finally:
        page_path.unlink(missing_ok=True)
    print("wrote", a.out)

if __name__ == "__main__":
    main()
