# Ramen Safari

A handwritten ramen travelogue, displayed as a Jekyll site under `shjensecurities.tech/ramen`.

---

## Structure

```
_ramen/          → one .md file per entry (front matter only; image does the work)
_layouts/        → default.html and entry.html
assets/pages/    → exported PNG images from reMarkable (one per entry)
assets/css/      → main.css
index.md         → the index page (grouped by city → ramen style)
_config.yml
```

---

## Adding a new entry

1. Export the reMarkable notebook page as PDF
2. Convert to PNG at 150 DPI:
   ```bash
   pdftoppm -png -r 150 -f 1 -l 1 yourfile.pdf assets/pages/your-slug
   # rename output: assets/pages/your-slug.png
   ```
3. Create `_ramen/your-slug.md` using an existing entry as a template
4. Fill in all front matter fields
5. Optionally add a plain-text transcription as the Markdown body (shown under "Read transcription")

---

## Image export workflow (reMarkable)

- Export: Menu → Share → PDF
- One notebook per entry
- Ignore the red annotation layer — it lives on a separate layer and exports cleanly
- Convert PDF → PNG via pdftoppm (see above) or ImageMagick:
  ```bash
  convert -density 150 yourfile.pdf -quality 95 assets/pages/your-slug.png
  ```

---

## Local development

```bash
bundle install
bundle exec jekyll serve
# visit http://localhost:4000/ramen/
```

---

## Deployment (Cloudflare Pages)

- Build command: `jekyll build`
- Output directory: `_site`
- Root: this repository (or subdirectory if monorepo)

### Access control (Cloudflare Access)

Protect `/ramen/*` via Cloudflare Zero Trust → Access → Applications.
Free tier supports email-based one-time PIN — no backend required.
Add allowed emails under the policy rule.

---

## Entry front matter reference

```yaml
layout: entry
title: "Display title"
slug: "url-safe-slug"
location:
  city: "City name"
  region: "Kanto / Kansai / Chugoku"
  neighborhood: "Neighborhood"
date_visited: YYYY-MM-DD
ramen_style: "Tonkotsu / Shoyu / Shio / Miso / Tsukemen / Tai-men"
ramen_substyle: "optional — Black Garlic / Wagyu / Ahi Bone / etc."
restaurant: "optional — only if notable / named"
city_order: 1          # travel sequence (1=Tokyo, 2=Shin-Yokohama, 3=Kyoto, 4=Osaka, 5=Kobe, 6=Hiroshima)
entry_order: 1         # chronological visit order — controls nav sequence
page_image: /ramen/assets/pages/your-slug.png
placeholder: true      # only on Kobe entry until filled in
```

---

## City order

| city_order | City           | Region   |
|------------|----------------|----------|
| 1          | Tokyo          | Kanto    |
| 2          | Shin-Yokohama  | Kanto    |
| 3          | Kyoto          | Kansai   |
| 4          | Osaka          | Kansai   |
| 5          | Kobe           | Kansai   |
| 6          | Hiroshima      | Chugoku  |
