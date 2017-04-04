class: middle, center, intro
# Best Practice: Joomla Templating
## Hans Kuijpers
<img src="jd17nl/images/hkweb-perfectwebteam.png"/>

---
class: middle, center
# TIP 1 - de basis

---
# Begin met een basis

- via Joomla.org meest recente versie downloaden
- installeren op hostingomgeving
- handige extensies downloaden en installeren
- tof template downloaden en installeren
- standaard instellingen wijzigen
- accounts aanmaken
 
--

- een boel tijd verloren
- en nu pas aan de slag

---
# Begin met een goede basis

- Heb ergens een basis Joomla! site staan
- Rol die uit op je lokale ontwikkelomgeving
- En ga aan de slag

---
# Eenmalig eigen basis opzetten

- Investeer eenmalig tijd in een goede basis
- Gebruik als kickstart voor ieder template-project
- Beheer basis via bijvoorbeeld een github-repo
- Maak bibliotheek van overrides, JavaScript, SCSS

---

<img src="jd17nl/images/perfect-site-frontend.png"/>

---

<img src="jd17nl/images/perfect-site--resultaat.png"/>

---

<img src="jd17nl/images/perfect-site-github.png"/>

---
class: middle, center
# TIP 2 - automatiseer waar mogelijk

---
# Building tools

- Zoveel mogelijk stappen automatiseren
- Snel en eenvoudig
- Performance verbeteren
- Fouten minimaliseren

---
# Welke taken?

- LESS of SASS compileren naar CSS
- SASS source map aanmaken
- JavaScript samenvoegen 
- CSS of JavaScript minifyen
- Git commits, pushen en pullen
- Afbeeldingen comprimeren
- Bestanden kopieren

--
## Bijvoorbeeld met Grunt

---
class: code-14
# Grunt task sass compilatie
 ## SCSS => CSS

```npm
'use strict';

//
module.exports = {
    dist: {
        options: {
            includePaths: [
                require("bourbon").includePaths,
                require("bourbon-neat").includePaths,
                require("node-normalize-scss").includePaths
            ]
        },
        files: {
*            '<%= paths.template %>/css/style.css': '<%= paths.assets %>/scss/style.scss',
            '<%= paths.template %>/css/grid.css': '<%= paths.assets %>/scss/grid.scss',
            '<%= paths.template %>/css/font.css': '<%= paths.assets %>/scss/font.scss'
        }
    }
};
```

---
class: middle, center
# TIP 3 - SCSS mixins for the win

---

<img src="jd17nl/images/bootstrap.png"/>

---

<img src="jd17nl/images/neat.png"/>

---
class: middle, center
<img src="jd17nl/images/neat-zero.png"/>

---

<img src="jd17nl/images/arrow-0.png"/>

---

<img src="jd17nl/images/arrow-1.png"/>

---
class: code-14
# section/_heading.scss 

```scss
.section {
	@include e('heading') {
		@include m('light') {
*			@include heading($quarter-spanish-white);
		}
	
		@include m('white') {
			@include heading(white);
		}
	
		@include m('image') {
			@include heading--clipart;
		}
	}
}
```
---
class: code-14
# @include heading -> mixin heading

```scss
@mixin heading($bgcolor: white) {
	@include heading--base;
*	@include arrow-bottom(2.5em, 50, transparent, $bgcolor);
}

@mixin heading--clipart {
	@include heading--base;
	@include arrow-bottom-clipart(50);
}
```

---
class: code-14
# @include arrow-button -> mixin arrow-button

```scss
@mixin arrow-bottom($border-width: 2.5em, $z-index: 50, $color-background: transparent, $color-arrow: white) {
	background-position: 50% 0;
	background-size: cover;
	background-repeat:no-repeat;

	position: relative;
	z-index: $z-index;
	&:before,
	&:after {
		position: absolute;
		bottom: 0;
		border-bottom: $border-width solid $color-arrow;
		display: block;
		content: " ";
	}
	&:before {
		width: 50%;
		left: 0;
		border-right: $border-width solid $color-background;

	}
	&:after {
		left: 50%;
		right: 0;
		border-left: $border-width solid $color-background;
	}
}
```

---
class: code-14
# Met css als resultaat

- scss -> css
- vendorprefix
- minified

```css
.section__heading--light:after,.section__heading--white:after,.section__home-lead:after{border-left:2.5em solid transparent;right:0}.section__blog-items .readmore a:active,.section__blog-items .readmore a:focus,.section__blog-items .readmore a:hover,.section__cases-items .readmore a:active,.section__cases-items .readmore a:focus,.section__cases-items .readmore a:hover{outline:0}.section__blog-items .readmore a:focus,.section__blog-items .readmore a:hover,.section__cases-items .readmore a:focus,.section__cases-items .readmore a:hover{background:#dabc7f}.section__heading--light,.section__heading--white,.section__home-lead{background-position:50% 0;background-size:cover;background-repeat:no-repeat}.section__heading--light:before,.section__heading--white:before,.section__home-lead:before{width:50%;border-right:2.5em solid transparent}.section__fulltext .container:last-child .section__content,.section__fulltext .section__aside-footer--wrapper:last-child .section__content{margin-bottom:36px}.section__heading--light{min-height:9rem;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;position:relative;z-index:50}.section__heading--light h1{font:700 30px/40px Montserrat,Helvetica,sans-serif;margin-top:-.5rem;color:#fff;text-align:center;text-shadow:0 0 5px #272F38;text-transform:uppercase}@media only screen and (min-width:760px){.section__heading--light h1{font:700 36px/65px Montserrat,Helvetica,sans-serif;margin-top:-1.5rem}}.section__heading--light:after,.section__heading--light:before{position:absolute;bottom:0;border-bottom:2.5em solid #f7f0e3;display:block;content:" "}.section__heading--light:before{left:0}.section__heading--light:after{left:50%}
```

---
class: middle, center
# TIP 4 - de templateHelper

---
class: code-14
# Template - Protostar

```php
126: <!DOCTYPE html>
127: <html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
128: <head>
129: 	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
130: 	<jdoc:include type="head" />
131: </head>
132: <body class="site <?php echo $option
133: 	. ' view-' . $view
134:	. ($layout ? ' layout-' . $layout : ' no-layout')
135:	. ($task ? ' task-' . $task : ' no-task')
136:	. ($itemid ? ' itemid-' . $itemid : '')
137:	. ($params->get('fluidContainer') ? ' fluid' : '');
138:	echo ($this->direction === 'rtl' ? ' rtl' : '');
139:?>">
```
--
## Pas op regel 126 begint de HTML pagina.
Daarvoor alleen maar PHP functies

---
# Nadelen

- foutgevoelig
- geen overzicht
- moeilijk herbruikbaar in overrides

--

## Conflicten gegarandeerd! 
(en dus debug-uren)

---
class: code-14
# Template - PerfectTemplate

```php
24: <!DOCTYPE html>
25: <html class="html no-js" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
26: <head>
27:     <jdoc:include type="head"/>
28:     <noscript>
29:         <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/font.css" rel="stylesheet" type="text/css"/>
30:     </noscript>
31: </head>
32: <body class="<?php echo PWTTemplateHelper::getBodySuffix(); ?>">
33: <?php echo PWTTemplateHelper::getAnalytics(2,'GTM-XXXXXX')['script']; ?>
```
--
## 100 regels eerder begint de HTML pagina
De PHP functies zijn verplaatst

---
class: code-14
# De eerste 25 regels code

```php
<?php
/*
 * @package     perfecttemplate
 * @copyright   Copyright (c) Perfect Web Team / perfectwebteam.nl
 * @license     GNU General Public License version 3 or later
 */

// No direct access.
defined('_JEXEC') or die;

// Load Perfect Template Helper
require_once JPATH_THEMES . '/' . $this->template . '/helper.php';
require_once JPATH_THEMES . '/' . $this->template . '/html/layouts/render.php';

PWTTemplateHelper::setMetadata();
PWTTemplateHelper::setFavicon();
PWTTemplateHelper::unloadCss();
PWTTemplateHelper::unloadJs();
PWTTemplateHelper::loadCss();
PWTTemplateHelper::loadJs();
PWTTemplateHelper::localstorageFont();
PWTTemplateHelper::ajaxSVG();
?>
```

---
class: code-14
# Bij fouten makkelijk uit te schakelen
```php
<?php
/*
 * @package     perfecttemplate
 * @copyright   Copyright (c) Perfect Web Team / perfectwebteam.nl
 * @license     GNU General Public License version 3 or later
 */

// No direct access.
defined('_JEXEC') or die;

// Load Perfect Template Helper
require_once JPATH_THEMES . '/' . $this->template . '/helper.php';
require_once JPATH_THEMES . '/' . $this->template . '/html/layouts/render.php';

PWTTemplateHelper::setMetadata();
PWTTemplateHelper::setFavicon();
*//PWTTemplateHelper::unloadCss();
*//PWTTemplateHelper::unloadJs();
*//PWTTemplateHelper::loadCss();
*//PWTTemplateHelper::loadJs();
*//PWTTemplateHelper::localstorageFont();
*//PWTTemplateHelper::ajaxSVG();
?>
```

---
class: code-14
# Helper.php - snippet

```php
class PWTTemplateHelper
{
	
	static public function template()
	{
		return JFactory::getApplication()->getTemplate();
	}
        	
	static public function loadCss()
	{
		JFactory::getDocument()->addStyleSheet('templates/' . self::template() . '/css/style.css');
	}
```

--
## Resulteert in
```html
	<link href="/templates/perfecttemplate/css/style.css" rel="stylesheet" type="text/css" />
```

---
class: code-14
# Body classes die de weg wijzen
```php
class PWTTemplateHelper
{
	static public function getBodySuffix()
	{
		$classes   = array();
		$classes[] = 'option-' . self::getPageOption();
		$classes[] = 'view-' . self::getPageView();
		$classes[] = self::getPageLayout() ? 'layout-' . self::getPageLayout() : 'no-layout';
		$classes[] = self::getPageTask() ? 'task-' . self::getPageTask() : 'no-task';
		$classes[] = 'itemid-' . self::getItemId();
		$classes[] = self::getPageClass();
		$classes[] = self::isHome() ? 'path-home' : 'path-' . implode('-', self::getPath('array'));
		$classes[] = 'home-' . (int) self::isHome();

		return implode(' ', $classes);
	}
```
--
## Resulteert in
``` html
<body class="option-com-content view-category layout-blog no-task itemid-130 path-nieuws home-0">
```

---
# Eigen Meta data toevoegen

- functies aanmaken in helper.php
- functies oproepen in index.php
- frontend verversen en bekijk het resultaat

---
class: code-14
# Eigen Meta data toevoegen
## helper.php
```php
class PWTTemplateHelper
{
	static public function setGenerator($generator)
	{
		JFactory::getDocument()->setGenerator($generator);
	}
	
	static public function setMetadata()
	{
		$doc    = JFactory::getDocument();
		
		$doc->setCharset('utf8');
		$doc->setMetaData('X-UA-Compatible', 'IE=edge', true);
		$doc->setMetaData('viewport', 'width=device-width, initial-scale=1.0');
	}
	
	static public function getSitename()
	{
		return JFactory::getConfig()->get('sitename');
	}
```
---
class: code-14
# Eigen Meta data toevoegen
## index.php
```php
// Load Perfect Template Helper
require_once JPATH_THEMES . '/' . $this->template . '/helper.php';

PWTTemplateHelper::setMetadata();
PWTTemplateHelper::setGenerator(PWTTemplateHelper::getSitename());
```
---
class: code-14
# Eigen Meta data toevoegen
## het resultaat
```html
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="generator" content="Custom Management" />
```
--
## Controle over de head

---
class: middle, center
# TIP 5  - gebruik JLayout(s)

---
# JLayout?, nog even herhalen aub.
- manier om (klein stukje) weergave op te bouwen
- enkel layout bestand met specifieke output
- data variabel meesturen
- zit in `layouts/joomla`
---
# Voordelen gebruik JLayout
- herbruikbaar door gehele site (template en extensies)
- aanpassingen één keer doorvoeren in plaats op diverse plekken
- niet langer copy/pasten van code in template overrides

--
- <strong>herbruikbaar in verschillende projecten</strong>

---
class: code-14
# Eigen JLayouts functie
- `html/layouts/render.php`

```php
class Jlayouts
{
	public static function render($type, $data = '')
	{
		$template = JFactory::getApplication()->getTemplate();
		$jlayout  = new JLayoutFile($type, JPATH_THEMES . '/' . $template . '/html/layouts/template');

		return $jlayout->render($data);
	}
```
--
Zorgt er voor dat eigen JLayouts vanuit `html/layouts/template/` opgeroepen kunnen worden. 

---
class: code-14
# Eigen JLayouts voor datum notatie
toegepast in `html/categories/blog_item.php`

```php
if ($params->get('show_publish_date')) :
	echo JLayoutHelper::render('template.content.create_date', array('date' => $this->item->created, 'format' => 'DATE_FORMAT_CC1'));
endif;
```

vraagt om `html/layouts/template/content/create_date.php`

--
## Datum is taalstring
override in `language/overrides/nl-NL-override.ini`
```ini
DATE_FORMAT_CC1="F Y"
```
output: maand jaar

---
class: code-14
# Eigen JLayouts - inhoud
- `html/layouts/template/content/create_date.php`

```php
<?php
defined('JPATH_BASE') or die;

$date   = $displayData['date'];
$class  = isset($displayData['class']) ? $displayData['class'] : 'content';
$format = JText::_($displayData['format']);

echo '<span class="' . $class . '__create">';
echo '<time datetime="' . JHtml::_('date', $date, 'c') . '" itemprop = "dateCreated" >';
echo JHtml::_('date', $date, $format);
echo '</time>';
echo '</span>';
```

--
## Resulteert in

```php
<span class="content__create"><time datetime="2017-02-17T10:31:00+01:00" itemprop="dateCreated">februari 2017</time></span>
```

---
# Eigen JLayouts - Google Maps
- `html/layouts/template/blocks/gmap.php`

- op te roepen via:

```php
<?php echo Jlayouts::render('block-gmap'); ?>
```

---
class: code-7
# Eigen JLayouts - Google Maps

```php
<?php

defined('_JEXEC') or die;

$apikey    = '';
$latitude  = '';
$longitude = '';
$color     = '';
$marker    = JUri::root() . '/images/map-marker.png';
$title     = PWTTemplateHelper::getSitename();
?>
<div class="block__gmap--wrapper">
    <div id="map-canvas" class="block__gmap--canvas"></div>
</div>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo $apikey; ?>"></script>
<script type="text/javascript">
    function initialize(offset) {
        var myLatlng = new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>);
        var mapOptions = {
            center: myLatlng,
            zoom: 13,
            zoomControlOptions: {style: google.maps.ZoomControlStyle.SMALL},
            mapTypeControl: false,
            streetViewControl: false,
            scrollwheel: false,
            keyboardShortcuts: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [
                {
                    stylers: [
                        {hue: "<?php echo $color; ?>"},
                        {saturation: -20}
                    ]
                }, {
                    featureType: "road",
                    elementType: "geometry",
                    stylers: [
                        {lightness: 100},
                        {visibility: "simplified"}
                    ]
                }, {
                    featureType: "road",
                    elementType: "labels",
                    stylers: [
                        {visibility: "simplified"}
                    ]
                }, {
                    featureType: "poi",
                    elementType: "labels",
                    stylers: [
                        {visibility: "off"}
                    ]
                }, {
                    featureType: "poi.business",
                    elementType: "labels",
                    stylers: [
                        {visibility: "off"}
                    ]
                }, {
                    featureType: "water",
                    elementType: "labels",
                    stylers: [
                        {visibility: "off"}
                    ]
                }
            ]
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        var image = new google.maps.MarkerImage('<?php echo $marker; ?>', null, null, null, new google.maps.Size(75, 75));
        var marker = new google.maps.Marker({
            position: myLatlng,
            icon: image,
            map: map,
            title: '<?php echo $title; ?>'
        });
        var center;

        function calculateCenter() {
            center = map.getCenter();
        }

        google.maps.event.addDomListener(map, "idle", function () {
            calculateCenter();
        });
        google.maps.event.addDomListener(window, "resize", function () {
            map.setCenter(center);
        });
        google.maps.Map.prototype.panToWithOffset = function (latlng, offsetX, offsetY) {
            var map = this;
            var ov = new google.maps.OverlayView();
            ov.onAdd = function () {
                var proj = this.getProjection();
                var aPoint = proj.fromLatLngToContainerPixel(latlng);
                aPoint.x = aPoint.x + offsetX;
                aPoint.y = aPoint.y + offsetY;
                map.panTo(proj.fromContainerPixelToLatLng(aPoint));
            };
            ov.draw = function () {
            };
            ov.setMap(this);
        };
        map.panToWithOffset(myLatlng, -(offset), 0);
    }
    function googleMap() {
        var viewportwidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
        if (viewportwidth <= 600) {
            initialize(0);
        } else {
            initialize(200);
        }
    }
    googleMap();
    google.maps.event.addDomListener(window, "resize", function () {
        googleMap();
    });
</script>
```

---
# Eigen JLayouts - Gmap

<img src="jd17nl/images/jlayouts-gmap.png"/>

---
class: middle, center, intro
# Bedankt!

## Hans Kuijpers
## @hans2103
