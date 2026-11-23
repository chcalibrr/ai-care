# aicarecoordinator.com theme

WordPress theme for aicarecoordinator.com (folder name on the server: `wp-content/themes/ai-care`, installed from this repo by Git Updater).

## How changes go live

1. Edit files here and bump `Version:` in `style.css`.
2. Push to `main`.
3. Call the Git Updater webhook to install it right away (otherwise Git Updater picks it up on its next check):
   `https://aicarecoordinator.com/wp-json/git-updater/v1/update/?key=KEY&theme=ai-care&committish=COMMIT_SHA&override=1`
   Use the full commit SHA: `branch=main` can install a stale copy because GitHub caches the branch zip for a few minutes.
   The key is in Settings > Git Updater > Remote Management. Never commit it; this repo is public.
4. Purge the SiteGround cache (admin bar > Purge SG Cache).

`AICC_VER` in `functions.php` reads the version from `style.css`. A new version re-runs the page installer (`inc/setup.php`), which refreshes page content from `content/*.html` unless a page was edited in WordPress.

## Layout

- `front-page.php`: home page
- `page-coordinator.php`: saved earlier home page (coordinator positioning), served at `/coordinator/`, not indexed
- `inc/pages.php`: page list, titles, descriptions, home FAQ
- `inc/shortcodes.php`: call player, transcript, revenue calculator
- `inc/seo.php`: schema, robots, llms.txt
- `content/*.html`: page bodies
- `assets/`: CSS, JS, images, audio, social images (`assets/img/og/`), EHR logos (`assets/img/ehr/`)
