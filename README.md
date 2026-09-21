# StarVista — WordPress Internship Assignment

A **real, functional WordPress website** inspired by the public homepage structure of [Pinkvilla](https://www.pinkvilla.com/). Original sample journalism and generated placeholder images only — no scraped Pinkvilla copy, photos, or trademarks.

Brand used for this assignment: **StarVista** (placeholder entertainment newsroom).

---

## What you get

- Custom Elementor-compatible theme (`starvista`)
- Sticky header + working mobile hamburger menu
- Dynamic homepage sections that query real WordPress posts
- Clickable article cards that open single-post templates
- Footer pages: About Us, Privacy Policy, Contact
- Elementor Free + Hello Elementor installed (free only)
- Demo content plugin that creates categories, authors, posts, images, and menus

---

## Local setup (this Windows machine — XAMPP)

Apache and MariaDB are already present via XAMPP. This project uses **MariaDB on port 3307** (XAMPP’s configured port).

### 1. Start XAMPP services

1. Open `C:\xampp\xampp-control.exe`
2. Start **Apache** (optional if you use the PHP built-in server below)
3. Start **MySQL**

### 2. Confirm the database exists

XAMPP MySQL (MariaDB) is on **port 3307**, empty root password:

```bat
C:\xampp\mysql\bin\mysql.exe --port=3307 -u root -e "CREATE DATABASE IF NOT EXISTS starvista CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 3. Start the site

From this folder:

```bat
"C:\xampp\php\php.exe" -S 127.0.0.1:8080 router.php
```

Open: [http://127.0.0.1:8080](http://127.0.0.1:8080)

### 4. Admin login

- URL: [http://127.0.0.1:8080/wp-admin](http://127.0.0.1:8080/wp-admin)
- Username: `admin`
- Password: `StarVistaAdmin!`

Change this password before any public deployment.

---

## If WordPress is not installed yet

From this folder, with XAMPP PHP:

```bat
"C:\xampp\php\php.exe" wp-cli.phar core is-installed
```

If that fails:

```bat
"C:\xampp\php\php.exe" wp-cli.phar core install --url="http://127.0.0.1:8080" --title="StarVista" --admin_user="admin" --admin_password="StarVistaAdmin!" --admin_email="admin@starvista.local" --skip-email
"C:\xampp\php\php.exe" wp-cli.phar theme activate starvista
"C:\xampp\php\php.exe" wp-cli.phar plugin activate elementor
"C:\xampp\php\php.exe" wp-cli.phar plugin activate starvista-demo
"C:\xampp\php\php.exe" wp-cli.phar rewrite structure "/%postname%/"
"C:\xampp\php\php.exe" wp-cli.phar eval "starvista_demo_run_import();"
```

Alternatively, in **WP Admin → Plugins**, activate **StarVista Demo Content**, then click **Import demo content**.

---

## Docker alternative

Docker Desktop must be running.

```bat
docker compose up -d
```

Then visit [http://localhost:8080](http://localhost:8080) and complete the WordPress installer (database is already created):

- Database name: `starvista`
- User: `starvista`
- Password: `starvista`
- Host: `db`

Activate **StarVista**, **Elementor**, and **StarVista Demo Content**, then import demo content.

---

## Theme / plugin details

| Item | Details |
|------|---------|
| Active theme | **StarVista** (`wp-content/themes/starvista`) — custom, Elementor-compatible |
| Bundled free theme | **Hello Elementor** (available in Appearance → Themes) |
| Page builder | **Elementor Free** only (no Pro) |
| Demo data | **StarVista Demo Content** (custom free plugin) |

### Why a custom theme instead of building the entire homepage only in Elementor Free?

Elementor Free cannot create a site-wide sticky header, footer, or single-post template (those are Theme Builder / Pro features). StarVista implements those in PHP so the assignment stays fully functional without paid plugins.

Elementor is installed so pages remain editable, and the theme registers free custom widgets under the **StarVista** category:

- StarVista Posts Grid (dynamic category query)
- StarVista Hero (helper widget)

The live homepage is `front-page.php`, which queries real posts by category.

---

## Plugins used (free only)

1. **Elementor** — page builder required by the assignment; used for editable pages and custom widgets.
2. **StarVista Demo Content** — creates sample posts, categories, authors, featured images, pages, and menus.

No other plugins are required. Do not install Elementor Pro.

---

## Homepage sections

Header (sticky) → Hero / Latest rail → Celebrity Style → Exclusive Videos → Movie Reviews → Entertainment (Bollywood, Hollywood, TV, South) → Fashion → Health & Beauty → Korean Wave → Lifestyle → Footer

Every article card links to a real single post.

---

## Deploying to free/low-cost hosting

Good options: InfinityFree, Playground, or a cheap Infinity/Hostinger/Cloudways trial. Most student-friendly path:

1. Zip this project **or** export the database + `wp-content`.
2. Create MySQL on the host.
3. Upload WordPress files (or upload this folder).
4. Edit `wp-config.php`:
   - `DB_NAME`, `DB_USER`, `DB_PASSWORD`, `DB_HOST`
   - Remove or update `WP_HOME` / `WP_SITEURL` to the live domain
   - Generate new [security keys](https://api.wordpress.org/secret-key/1.1/salt/)
5. Import the database (phpMyAdmin) **or** run the WP installer if the DB is empty, then activate theme + plugins + demo import.
6. In **Settings → Permalinks**, choose **Post name** and save.
7. In **Settings → General**, set the live URL.

### Search-replace after migration

If the database was copied from local:

```bat
php wp-cli.phar search-replace "http://127.0.0.1:8080" "https://your-live-domain.com" --all-tables
```

---

## Assignment deadline

Thursday, 24 September, 2 PM — deploy a live development URL and submit that URL for review. Do not generate the submission PDF unless asked.

---

## Credentials reminder

Local only. Change before deploy.

- Admin: `admin` / `StarVistaAdmin!`
- DB (XAMPP): `root` / (empty) @ `127.0.0.1:3307` / database `starvista`
