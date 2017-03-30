class: middle, center, intro
# Best Practice: Joomla Templating
## Hans Kuijpers
<img src="images/logos-hkweb-pwt.png"/>

---
# Begin met een basis

- via Joomla.org meest recente versie downloaden
- installeren op hostingomgeving
- handige extensies downloaden en installeren
- tof template downloaden en installeren
- standaard instellingen wijzigen
- accounts aanmaken 
- een boel tijd verloren
- en ga aan de slag

---
# Begin met een goede basis

- Heb ergens een basis Joomla! site staan
- Rol die uit op je lokale ontwikkelomgeving
- En ga aan de slag

---
# Versiebeheer van de software



---
# Automatiseren waar mogelijk

---
# SCSS mixins for the win

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
29:         <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/font.css"
30:               rel="stylesheet" type="text/css"/>
31:     </noscript>
32: </head>
33: <body class="<?php echo PWTTemplateHelper::getBodySuffix(); ?>">
34: <?php echo PWTTemplateHelper::getAnalytics(2,'GTM-XXXXXX')['script']; ?>
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
# TIP 4 - gebruik JLayout(s)

--
## JLayout?, nog even herhalen aub.
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
# Joomla! core kan veel



---
# Joomla! 3.7 custom fields

---
# Eigen plugin 

---


Ik bouw onder ander websites met Joomla!

Joomla installatie
installatie van handige extensies
kopieren van recent template
slopen van template
en beginnen maar


Dat is niet handig
Handiger is om een default kale joomla installatie te hebben waarmee je direct van start kunt

Tip 1: heb een basis joomla template beschikbacue


Elke keer de site uploaden naar de nieuwe plek is ook niet echt snel


ik werk daarom graag lokaal aan de websites
en gebruik daarvoor Mamp en PhpStorm en Sequel Pro








# Automatiseer waar mogelijk


# DRY









# Het ontstaan van de template helper
- screenshot van veul code boven <html>
- niet elk project heeft dezelfde functionaliteit nodig
- helper.php to the rescue
- functies oproepen waar nodig




# Mapjes mapjes en mapjes





# Print het design
en krijg hierdoor overzicht

<img src="jd17nl/images/print-design.jpg" />

---

# Versiebeheer van de software


---




---







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

Programmeer in het Engels

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


---
class: middle, center, intro
# Bedankt!

## Hans Kuijpers
## @hans2103
