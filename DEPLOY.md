# Live deployment guide (InfinityFree / any PHP+MySQL host)

WordPress **cannot** run on Vercel. Use a PHP + MySQL host.

Recommended free host: [InfinityFree](https://www.infinityfree.com/)

## Files ready in this repo

| File | Purpose |
|------|---------|
| `starvista-database.sql` | Full site content (posts, pages, menus, settings) |
| `wp-content/themes/starvista/` | Custom theme |
| `wp-content/plugins/starvista-demo/` | Demo importer |
| `wp-content/plugins/elementor/` | Elementor Free |
| `wp-content/uploads/starvista-stock/` | Royalty-free article photos |
| `wp-config-sample.php` | Template — copy to `wp-config.php` on the host |

Local `wp-config.php` is **not** in Git (secrets). Create a new one on the host.

---

## Option A — Fastest (Softaculous WordPress + upload theme)

1. Create an InfinityFree account → create a free website (subdomain like `starvista.great-site.net`).
2. Open **Control Panel** → **Softaculous** → install **WordPress** in the root (`htdocs`).
3. Note the WordPress admin URL / password Softaculous gives you.
4. In Softaculous/Control Panel → create a **MySQL database** *or* use the one Softaculous created.
5. Upload via File Manager (or FTP) into `htdocs/wp-content/`:
   - `themes/starvista/`
   - `plugins/starvista-demo/`
   - `plugins/elementor/` (or install Elementor from WP Admin → Plugins → Add New)
   - `uploads/starvista-stock/` (optional; regenerates from importer if missing)
6. WP Admin → Appearance → activate **StarVista**
7. Plugins → activate **Elementor** + **StarVista Demo Content**
8. Click **Import demo content** (or run importer notice)
9. Settings → Permalinks → **Post name** → Save
10. Upload stock photos into Media if cards still show placeholders, or re-run `scripts/download_stock_photos.py` locally and FTP `wp-content/uploads/`

---

## Option B — Full migrate (upload this project + import SQL)

1. Create InfinityFree site + MySQL database (note: DB name, user, password, host — often `sqlXXX.infinityfree.com`).
2. Zip the project **without** `.git`, local `wp-config.php`, and huge zips.
3. Upload and extract into `htdocs/` (so `htdocs/index.php` exists).
4. Copy `wp-config-sample.php` → `wp-config.php` and fill live DB credentials + live site URL.
5. phpMyAdmin → select your DB → **Import** → `starvista-database.sql`
6. In phpMyAdmin SQL tab, run search-replace for URLs:

```sql
UPDATE wp_options SET option_value = 'https://YOUR-SUBDOMAIN.great-site.net'
WHERE option_name IN ('siteurl', 'home');
```

7. Visit the site. Log in with the **local** admin if you imported SQL:
   - User: `admin`
   - Password: `StarVistaAdmin!`
   - Change password immediately.
8. Settings → Permalinks → Post name → Save.

---

## After deploy checklist

- [ ] Homepage loads with sections
- [ ] HTTPS / padlock works
- [ ] Sticky header + mobile menu
- [ ] Article cards open single posts
- [ ] Footer About / Privacy / Contact work
- [ ] Elementor + StarVista active
- [ ] Admin password changed

## Submit for internship

Send the live URL (e.g. `https://yoursite.great-site.net`) — not the GitHub repo URL.
