# aicarecoordinator.com theme

WordPress theme for aicarecoordinator.com (folder name on the server: `wp-content/themes/aicc`).

## How changes go live

1. Edit files here and bump `Version:` in `style.css`.
2. Push to `main`.
3. The Git Updater plugin on the site picks up the new version and updates the theme.

`AICC_VER` in `functions.php` reads the version from `style.css`. A new version re-runs the page installer (`inc/setup.php`), which refreshes page content from `content/*.html` unless a page was edited in WordPress.

## Layout

- `front-page.php`: home page
- `page-coordinator.php`: saved earlier home page (coordinator positioning), served at `/coordinator/`, not indexed
- `inc/pages.php`: page list, titles, descriptions, home FAQ
- `inc/shortcodes.php`: call player, transcript, revenue calculator
- `inc/seo.php`: schema, robots, llms.txt
- `content/*.html`: page bodies
- `assets/`: CSS, JS, images, audio, social images (`assets/img/og/`), EHR logos (`assets/img/ehr/`)
