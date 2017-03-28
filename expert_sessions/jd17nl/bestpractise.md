class: middle, center, intro
# Best Practice: Joomla Templating
## Hans Kuijpers
<img src="images/logos-hkweb-pwt.png"/>

---
# Werken met Github



Klanten issues aan laten maken


---

# Default Joomla! installatie


- 

- print het design en krijg overzicht
- hak in blokjes
- werk met een styleguide
- clone html presentatie van PWT
- werken met JLayouts
- test het resultaat met YellowLabs
- werk met een helper
- zorg voor een 404 pagina 
- werk met Github

---

# Kleurcontrast 

- http://contrastchecker.com/

---
class: middle, center
<img src="jd17nl/images/contrast-voor.png" />

---

<img src="jd17nl/images/contrast-test-voor.png" />

---

<img src="jd17nl/images/contrast-test-na.png" />

---
class: middle, center
<img src="jd17nl/images/contrast-na.png" />



---
class: middle, center, width100
<img src="jd17nl/images/giphy-any_questions.gif"/>

---
class: middle, center, width100
<img src="jd17nl/images/giphy-thankyou.gif"/>

---



---
# Contrast


```
@fd-ui-meta-color: #585858;
```






<img src="jd16nl/images/label-voor-mobiel.png" />

---
# Mobile-Friendly test
- https://www.google.com/webmasters/tools/mobile-friendly

<img src="jd16nl/images/05-mobile-check-joomladagen-result.png" />

---
# Mobile-Friendly test
Maar dit is hoe Google de site ziet
<img src="jd16nl/images/05-mobile-check-joomladagen.png" />

---
# Robots blokkeren de content
Aanwezigheid van verouderde robots.txt
```
User-agent: *
Disallow: /administrator/
Disallow: /cache/
Disallow: /cli/
Disallow: /components/
Disallow: /images/
Disallow: /includes/
Disallow: /installation/
Disallow: /language/
Disallow: /libraries/
Disallow: /logs/
Disallow: /media/
Disallow: /modules/
Disallow: /plugins/
Disallow: /templates/
Disallow: /tmp/
```

---
# Joomla! 3.5 robots.txt
```
User-agent: *
Disallow: /administrator/
Disallow: /bin/
Disallow: /cache/
Disallow: /cli/
Disallow: /components/
Disallow: /includes/
Disallow: /installation/
Disallow: /language/
Disallow: /layouts/
Disallow: /libraries/
Disallow: /logs/
Disallow: /modules/
Disallow: /plugins/
Disallow: /tmp/
```

---
# Joomladagen.nl responsive

<img src="jd16nl/images/03-joomladagen-screens.jpg" />

---
# Responsive Web Design Testing Tool
- http://mattkersley.com/responsive/
<img src="jd16nl/images/responsive-webdesign-testing-tool.png" />

---
# W3C mobileOK Checker
- http://validator.w3.org/mobile/
<img src="jd16nl/images/validator-w3-org-mobile.png" />

---
# Werk aan de winkel

## Volgend jaar een nieuwe site joomladagen.nl

- mobiel vriendelijk
- voor zowel W3C mobileOK Checker
- als voor Google mobile checker
- suggesties zijn welkom op hans@joomladagen.nl

---
# Maar nu naar je eigen website
## Stappenplan

- Hoe ziet de site er uit op mobiel?
- Hoe zou je willen dat de site er op mobiel uit ziet?
- - apart design
- - responsive
- Wijzigen maar...

- klinkt net zo eenvoudig als het tekenen van een paard

---
<img src="jd16nl/images/How+to+draw+a+horse.jpg" style="height:682px;" />

---
# Google Resizer
- http://design.google.com/resizer/

<img src="jd16nl/images/orangemonkeytours-old.gif" />

---
# Google Resizer - mobiel
<img src="jd16nl/images/orangemonkeytours-mobile.gif" />

---
# Multi-device layout patterns
## Luke Wroblewski
- http://www.lukew.com/ff/entry.asp?1514
<img src="jd16nl/images/md-patterns2.png" />

---
# Huidige structuur

<img src="jd16nl/images/orangemonkeytour-table.png" />

---
# Gewenste structuur

<img src="jd16nl/images/flexbox-basis.png" />

---
# Flexbox for the win
- http://caniuse.com/#search=flexbox
<img src="jd16nl/images/caniuse-flexbox.png" />

---
# Codepen voor de codevoorbeelden
- http://codepen.io/team/css-tricks/pen/jqzNZq

<img src="jd16nl/images/codepen-flexbox.png" />

---
# Huidige structuur

```
<body>
<div class="wrapper">
  <div class="header">
    <div class="header-image">...</div>
    <div class="tools">...</div>
    <table width="100%" border="0" cellpadding="0">
      <tbody><tr>
        <td class="left">...</td>
        <td class="middle">...</td>
        <td class="right">...</td>
      </tr></tbody>
    </table>
    <div class="conditions">...</div>
    <div class="footer">...</div>
  </div>
</div>
</body>
```

---
# Gewenste structuur
```
<body>
<div class="site">
  <header class="site__header">...</header>
  <div class="site__tools">...</div>
  <div class="site__main">...</div>
  <aside class="site__aside site__aside-1">...</aside>
  <aside class="site__aside site__aside-2">...</aside>
  <div class="site__footer">...</div>
</body>
```

---
# index.php in huidige template
- Op je testomgeving met de bestaande template
- index.php kopieren naar index-orig.php
- nieuw bestand index-new.php
- nieuw bestand index.php met de volgend info:

```
<?php
defined('_JEXEC') or die;

include_once('index-new.php');
//include_once('index-orig.php');
```

---
# Viewport toevoegen
voorkom dat device gaat herschalen

```
<meta name="viewport"
  content="width=device-width, 
           user-scalable=yes,
           initial-scale=1">
```

voorkom dat user gaat pinchen en zoomen
```
<meta name="viewport" 
  content="width=device-width,
           user-scalable=no,
           initial-scale=1,
           maximum-scale=1">
```
advies: kies voor het eerste

---
# Toevoegen kan ook vanuit Joomla 

<img src="jd16nl/images/template-edit-joomla.gif" />

---
# Begin vanuit mobiel

```
.site {
	display: flex;
	flex-flow: row wrap;
	justify-content: center;
	max-width:1200px;
	margin:0 auto;
	padding:5px;
}

.site__header,
.site__tools,
.site__main,
.site__aside,
.site__footer {
	flex: 1 100%;
}
```

---
# Nu al geweldig op mobiel

<img src="jd16nl/images/orangemonkeytours-mobile-no-media.gif" />

---
# Maar minder op desktop

<img src="jd16nl/images/orangemonkeytours-desktop-no-media.gif" />

---
# Media-queries bieden de oplossing

```
@media only screen and (min-width: 768px) {
	.site__main {
		flex: 1 0px;
		order: 2;
	}
	.site__aside.site__aside-1 {
		flex: 0 280px;
	}
	.site__aside-1 {
		order: 1;
	}
	.site__aside-2 {
		order: 3;
	}
	.site__footer {
		order: 4;
	}
}
```

---
# Twee kolommen... nog geen drie

<img src="jd16nl/images/orangemonkey-mediaquery-768.png" />

---
# Meer media-queries

```
@media only screen and (min-width: 1024px) {
	.site__aside.site__aside-2 {
		flex: 0 240px;
	}
}
```

---
# Eindresultaat

<img src="jd16nl/images/orangemonkey-eindresultaat.png" />

---
# Maar dan... 

- afbeeldingen die te groot zijn
- tabellen die niet passen
- iFrame die niet pas

> The devil is in the details

---
# Responsive images
```
img {max-width: 100%;}
```

<img src="jd16nl/images/image-max-width.png" />

---
# Tables

<img src="jd16nl/images/non-responsive-table.gif" />

---
# Bootstrap gebruikers
- http://codepen.io/SitePoint/full/raXdwZ/

<img src="jd16nl/images/responsive-table-bootstrap.gif" />

---
# CSS-Tricks Table Roundup
- https://css-tricks.com/responsive-data-table-roundup/

<img src="jd16nl/images/css-tricks-table.jpg" />

---
# iFrame

<img src="jd16nl/images/iframe-desktop-before.png" />

---
# iFrame

<img src="jd16nl/images/iframe-mobiel-before.png" />

---
# HTML en CSS wijziging
Verwijder widht en height uit iFrame html tag plus

```
iframe {
	border:none;
	width:100%;
	height:100%;
	min-height:600px;
}
@media only screen and (min-width: 1084px) {
	iframe {
		width: 768px;
	}
}
```

---
# iFrame

<img src="jd16nl/images/iframe-desktop-after.png" />

---
# iFrame

<img src="jd16nl/images/iframe-mobiel-after.png" />

---
# Eind goed al goed

- Hoe ziet de site er op mobiel uit?
- Hoe wil je dat de site er uit komt te zien?
- Keuze voor responsive of separaat template
- viewport & media-queries & details :-)
- flexbox is cool!

---
class: middle, center, intro
# Bedankt!

## Hans Kuijpers
## @hans2103
