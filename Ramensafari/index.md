---
layout: ramen-default
title: "Ramen Safari"
permalink: /ramen/
---

{% assign entries = site.ramen | where_exp: "entry", "entry.placeholder != true" | sort: "style_order" | sort: "city_order" %}
{% assign cities = entries | map: "location.city" | uniq %}

<div class="index-intro">
  <p>A handwritten record of fifteen bowls eaten across five cities in Japan.</p>
  <p class="intro-ja">日本五都市で食べた十五杯の手書き記録</p>
</div>

{% for city in cities %}
  {% assign city_entries = entries | where: "location.city", city %}
  {% assign first = city_entries | first %}

  <section class="city-section">
    <div class="city-header">
      <h2>{{ city }}{% if first.location.city_ja %}<span class="name-ja">{{ first.location.city_ja }}</span>{% endif %}</h2>
      <span class="region-label">{{ first.location.region }}{% if first.location.region_ja %}<span class="name-ja">{{ first.location.region_ja }}</span>{% endif %}</span>
    </div>

    {% assign styles = city_entries | map: "ramen_style" | uniq %}
    {% for style in styles %}
      {% assign style_entries = city_entries | where: "ramen_style", style %}
      {% assign style_first = style_entries | first %}

      <div class="style-group">
        <h3 class="style-label">{{ style }}{% if style_first.ramen_style_ja %}<span class="name-ja">{{ style_first.ramen_style_ja }}</span>{% endif %}</h3>
        <ul class="entry-list">
          {% for entry in style_entries %}
          <li class="entry-item">
            <a href="{{ entry.url | prepend: site.baseurl }}">
              <span class="entry-title">{{ entry.title }}</span>
              <span class="entry-neighborhood">{{ entry.location.neighborhood }}</span>
              {% if entry.ramen_substyle != "" %}
                <span class="entry-substyle">{{ entry.ramen_substyle }}</span>
              {% endif %}
            </a>
          </li>
          {% endfor %}
        </ul>
      </div>

    {% endfor %}
  </section>
{% endfor %}

{% assign kobe = site.ramen | where: "placeholder", true | first %}
{% if kobe %}
<section class="city-section city-placeholder">
  <div class="city-header">
    <h2>Kobe<span class="name-ja">神戸</span></h2>
    <span class="region-label">Kansai<span class="name-ja">関西</span></span>
  </div>
  <p class="placeholder-note">Entry pending. <span class="name-ja">記録準備中</span></p>
</section>
{% endif %}
