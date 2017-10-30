background-image: url(jug/bussum/201710/aankondiging.jpg)

---
class: middle, center
background-image: url(jug/bussum/201710/cm-bg.jpg)

<img src="jug/bussum/201710/custommanagement.png">

---
class: center, middle, intro
# De basis
> Een goed begin, is het halve werk

---
# Een basis template
Om mee te beginnen
<img src="jug/bussum/201710/github-hans2103-thistemplate.png">

---
# Handig... maar....
Veel tijd kwijt met 

- via Joomla.org meest recente versie downloaden
- installeren op hostingomgeving
- handige extensies downloaden en installeren
- tof template downloaden en installeren
- standaard instellingen wijzigen
- accounts aanmaken

---
# Dus... een basis website

- Investeer eenmalig tijd in een goede basis
- Gebruik als kickstart voor ieder template-project
- Beheer basis via bijvoorbeeld een github-repo
- Maak bibliotheek van overrides, JavaScript, SCSS

---
# De PWT basis website

<img src="jug/bussum/201710/github-perfectwebteam-perfectsite.png">

---
# Het begin is vrij leeg

<img src="jd17nl/images/perfect-site-frontend.png"/>

---
# Zo moet het straks worden


<img src="jug/bussum/201710/cm-designs.png">

---
class: center, middle, intro

# Aan het werk
## Stap voor stap alle designs doornemen


---
# Waar mogelijk alleen com_content

- Homepage -> com_content category blog weergave
- Team -> com_content category blog weergave
- Team member -> com_content article
- Expertise -> com_content article met modules
- Expertise selectie -> com_content category blog weergave
- Opdrachtgevers -> com_content category blog weergave
- Opdrachtgevers item -> com_content article
- Nieuws -> com_content category blog weergave
- Nieuws item -> com_content article
- Contact -> com_content article

---
# Opdrachtgevers 
- image_intro van alle artikelen in category

<img src="jug/bussum/201710/cm-opdrachtgevers.png">

---
# Opdrachtgevers 
- image_intro van alle artikelen in category

<img src="jug/bussum/201710/cm-opdrachtgevers-minus-eentje.png">

---
# Template override

- van _com_content/views/category/tmpl/_

```
- blog.php
- blog.xml
- blog_item.php
```
 
- naar _templates/bla/html/com_content/category/_

```
- clients.php
- clients.xml
- clients_item.php
```

---
# Client.xml

- van

```xml
<layout title="COM_CONTENT_CATEGORY_VIEW_BLOG_TITLE" 
	option="COM_CONTENT_CATEGORY_VIEW_BLOG_OPTION">
	<help key = "JHELP_MENUS_MENU_ITEM_ARTICLE_CATEGORY_BLOG" />
	<message>
		<![CDATA[COM_CONTENT_CATEGORY_VIEW_BLOG_DESC]]>
	</message>
</layout>
```

- naar

```xml
<layout title="COM_CONTENT_CATEGORY_VIEW_CLIENTS_TITLE" 
	option="COM_CONTENT_CATEGORY_VIEW_CLIENTS_OPTION">
	<help key = "JHELP_MENUS_MENU_ITEM_ARTICLE_CATEGORY_BLOG" />
	<message>
		<![CDATA[COM_CONTENT_CATEGORY_VIEW_CLIENTS_DESC]]>
	</message>
</layout>
```

---
# Taalstrings
- _administrator/language/overrides/nl-NL.overrides.ini_

```ini
COM_CONTENT_CATEGORY_VIEW_CLIENTS_TITLE="Categorieblog Opdrachtgevers pagina"
COM_CONTENT_CATEGORY_VIEW_CLIENTS_OPTION="Categoryblogclientpage"
COM_CONTENT_CATEGORY_VIEW_CLIENTS_DESC="Weergave van artikelintroducties van opdrachtgevers pagina."
```

---
# Menu type
- Nieuwe optie beschikbaar bij aanmaken menu item

<img src="jug/bussum/201710/cm-menutype.png">

---
# Override van cateogory blog
- blog.php gekopieerd naar clients.php

```php
<?php if (!empty($this->intro_items)) : ?>
    <section class="section section__client-items<?php echo $this->params->get('show_description', 1) ? ' section__arrow--down' : ''; ?>">
        <div class="container">
            <div class="section__content">
	            Hier de plaatjes van alle opdrachtgevers
            </div>
        </div>
    </section>
<?php endif; ?>
```

---
# Override van category blog
- oproepen van alle plaatjes

```php
<?php
foreach ($this->intro_items as $key => &$item)
{
	$this->item = &$item;
	echo $this->loadTemplate('item');
}
?>
```

Waar zijn die plaatjes?
Die zitten in clients_item.php

---
# Override van category blog_item
- eindelijk die plaatjes


```php
<?php $images  = json_decode($this->item->images); ?>
<?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
	<figure class="section__image">
		<?php echo JHtml::_('image', $images->image_intro, $this->item->title); ?>
	</figure>
<?php endif; ?>
```

---
# Wat styling erover

```sass
.section__client-items {
	padding-top: 2rem;
	padding-bottom: 5rem;

	.section__content {
		@include grid-column(12);

		@include grid-media($grid-charlie) {
			@include grid-column(10);
			@include grid-push(1);
		}
	}

	.section__image {
		@include grid-column(1 of 2);
		padding: $spacing-xs;

		@include grid-media($grid-alpha--plus) {
			@include grid-column(1 of 3);
		}

		@include grid-media($grid-beta) {
			@include grid-column(1 of 4);
		}

		@include grid-media($grid-charlie) {
			@include grid-column(1 of 5);
		}
	}
}
```

---
# Het resultaat met com_content

<img src="jug/bussum/201710/cm-clients-code.png">

---
class: center, middle, intro
# Die was eenvoudig
> Nu een pittige

---
background-image: url(jug/bussum/201710/cm-team-item.png)

---
# Team member
- Header 
toont article title

- Sidebar:
afbeelding link is image_intro, typisch via custom fields, plaatjes via custom fields, stuk tekst via taalstring

- Main-top:
Quote via custom fields, LinkedIn via custom fields, telefoon via custom fields, e-mail via custom fields

- Content:
drie velden via custom fields

- Main-bottom:
twee modules

---
# Overzicht van aangemaakte fields

<img src="jug/bussum/201710/cm-team-item-customfields.png">

---
# Template override

- van _com_content/views/article/tmpl/_

```
- default.php
```
 
- naar _templates/bla/html/com_content/article/_

```
- vennoot.php
```

--
## let op: dit keer geen vennoot.xml

---
# Weergave override via Opties
- Bij aanmaken nieuw com_content article

<img src="jug/bussum/201710/weergave-override.png">

---
# Overzicht door templates

```php
*<?php echo Jlayouts::render('content.heading', array('title' => $this->item->title, 'bgcolor' => 'white')); ?>

<section class="section section__vennoot">
    <div class="container">
        <div class="section__content section__content--vennoot">
            <div class="block__vennoot-top">
				<?php echo $this->loadTemplate('top'); ?>
            </div>

            <div class="block__vennoot-main">
				<?php echo $this->item->event->beforeDisplayContent; ?>
				<?php echo $this->loadTemplate('body'); ?>
				<?php echo $this->item->event->afterDisplayContent; ?>
            </div>

            <div class="block__vennoot-bottom">
	            <?php echo $this->loadTemplate('bottom-opdrachten'); ?>
	            <?php echo $this->loadTemplate('bottom-publicaties'); ?>
            </div>
        </div>

        <div class="section__content section__content--aside">
            <div class="block__vennoot-image">
				<?php echo $this->loadTemplate('image'); ?>
            </div>
			<?php echo $this->loadTemplate('aside'); ?>
        </div>

    </div>
</section>
```

---
# heading
- html/layouts/template/content/heading.php

<img src="jug/bussum/201710/cm-team-item-header.png">

```php
<?php echo Jlayouts::render('content.heading', 
	array('title' => $this->item->title, 'bgcolor' => 'white')); ?>
```

--
## eigen JLayout

```php
<section class="section section__heading <?php echo 'section__heading--' . $class; ?>" <?php echo Jlayouts::render('header-image-arrow'); ?>>
	<div class="container">
		<h1><?php 
		echo $displayData['title'] ? $displayData['title'] : '';
		?></h1>
	</div>
</section>
<?php endif; ?>
```

---
# Overzicht door templates - herhaling

```php
<?php echo Jlayouts::render('content.heading', array('title' => $this->item->title, 'bgcolor' => 'white')); ?>

<section class="section section__vennoot">
    <div class="container">
        <div class="section__content section__content--vennoot">
*            <div class="block__vennoot-top">
*				<?php echo $this->loadTemplate('top'); ?>
*            </div>

            <div class="block__vennoot-main">
				<?php echo $this->item->event->beforeDisplayContent; ?>
				<?php echo $this->loadTemplate('body'); ?>
				<?php echo $this->item->event->afterDisplayContent; ?>
            </div>

            <div class="block__vennoot-bottom">
	            <?php echo $this->loadTemplate('bottom-opdrachten'); ?>
	            <?php echo $this->loadTemplate('bottom-publicaties'); ?>
            </div>
        </div>

        <div class="section__content section__content--aside">
            <div class="block__vennoot-image">
				<?php echo $this->loadTemplate('image'); ?>
            </div>
			<?php echo $this->loadTemplate('aside'); ?>
        </div>

    </div>
</section>
```

---
# loadTemplate('top')
- html/com_content/article/vennoot_top.php

<img src="jug/bussum/201710/cm-team-item-top.png">

--
## viertal Custom Fields
- Quote
- LinkedIn
- Telefoon
- E-mail

---
# Weergave in beheer van artikel
- Inhoud > Artikelen

<img src="jug/bussum/201710/cm-team-item-top-items.png">

---
# Overzicht van de Custom Fields
- Inhoud > Velden

<img src="jug/bussum/201710/custom-fields-items.png">

---
# Oproepen in een override

<img src="jug/bussum/201710/custom-fields-items-quote.png">

```php
<?php echo $this->item->jcfields[2]->value; ?>
```

--
2? Wat is 2?
Veldnaam quote zou handiger zijn toch?

---
# mapping aanmaken van naam -> id

```php
foreach ($this->item->jcfields as $jcfield)
{
	$this->item->jcfield_name_id_map[$jcfield->name] = $jcfield->id;
}

$jcfield_name_id_map = $this->item->jcfield_name_id_map;



echo $this->item->jcfields[$jcfield_name_id_map['quote']]->value;
``` 

---
# loadTemplate('top')
- html/com_content/article/vennoot_top.php

```php
<?php
foreach ($this->item->jcfields as $jcfield)
{
	$this->item->jcfield_name_id_map[$jcfield->name] = $jcfield->id;
}

$jcfield_name_id_map = $this->item->jcfield_name_id_map;
?>
<div class="block__vennoot-top-headline">
	<?php
	if (!empty($quote = 
	$this->item->jcfields[$jcfield_name_id_map['quote']]->value))
	{
		echo $quote;
	}
	?>
</div>
```
Herhalen voor LinkedIn, Telefoon en E-mail

---
# loadTemplate('body')
- html/com_content/article/vennoot_body.php

--

```php
foreach ($this->item->jcfields as $jcfield)
{
	$this->item->jcfield_name_id_map[$jcfield->name] = $jcfield->id;
}

$jcfield_name_id_map = $this->item->jcfield_name_id_map;

$fields = array('achtergrond-en-ervaring','leiderschapsvisie-en-managementstijl','specialisaties-en-trackrecord');

if ($this->item->language == 'en-GB')
{
    $fields = array('background-and-experience','leadership-vision-and-management-style','specialisations-and-track-record');
}

foreach ($fields as $field)
{
	$vennoot_body = $this->item->jcfields[$jcfield_name_id_map[$field]];
	if ($vennoot_body->value)
	{
		echo JText::_('<h2>' . $vennoot_body->title . '</h2>');
		echo JText::_($vennoot_body->value);
	}
}
```

---
class: center, middle, intro
# dafuq?

---
# loadTemplate('body')
- html/com_content/article/vennoot_body.php

```php
*foreach ($this->item->jcfields as $jcfield)
*{
*	$this->item->jcfield_name_id_map[$jcfield->name] = $jcfield->id;
*}
*
*$jcfield_name_id_map = $this->item->jcfield_name_id_map;

$fields = array('achtergrond-en-ervaring','leiderschapsvisie-en-managementstijl','specialisaties-en-trackrecord');

if ($this->item->language == 'en-GB')
{
	$fields = array('background-and-experience','leadership-vision-and-management-style','specialisations-and-track-record');
}

foreach ($fields as $field)
{
	$vennoot_body = $this->item->jcfields[$jcfield_name_id_map[$field]];
	if ($vennoot_body->value)
	{
		echo JText::_('<h2>' . $vennoot_body->title . '</h2>');
		echo JText::_($vennoot_body->value);
	}
}
```

---
# loadTemplate('body')
- html/com_content/article/vennoot_body.php

```php
foreach ($this->item->jcfields as $jcfield)
{
	$this->item->jcfield_name_id_map[$jcfield->name] = $jcfield->id;
}

$jcfield_name_id_map = $this->item->jcfield_name_id_map;

*$fields = array('achtergrond-en-ervaring','leiderschapsvisie-en-managementstijl','specialisaties-en-trackrecord');

if ($this->item->language == 'en-GB')
{
    $fields = array('background-and-experience','leadership-vision-and-management-style','specialisations-and-track-record');
}

foreach ($fields as $field)
{
	$vennoot_body = $this->item->jcfields[$jcfield_name_id_map[$field]];
	if ($vennoot_body->value)
	{
		echo JText::_('<h2>' . $vennoot_body->title . '</h2>');
		echo JText::_($vennoot_body->value);
	}
}
```

---
# loadTemplate('body')
- html/com_content/article/vennoot_body.php

```php
foreach ($this->item->jcfields as $jcfield)
{
	$this->item->jcfield_name_id_map[$jcfield->name] = $jcfield->id;
}

$jcfield_name_id_map = $this->item->jcfield_name_id_map;

*$fields = array('achtergrond-en-ervaring','leiderschapsvisie-en-managementstijl','specialisaties-en-trackrecord');
*
*if ($this->item->language == 'en-GB')
*{
*   $fields = array('background-and-experience','leadership-vision-and-management-style','specialisations-and-track-record');
*}

foreach ($fields as $field)
{
	$vennoot_body = $this->item->jcfields[$jcfield_name_id_map[$field]];
	if ($vennoot_body->value)
	{
		echo JText::_('<h2>' . $vennoot_body->title . '</h2>');
		echo JText::_($vennoot_body->value);
	}
}
```

---
# loadTemplate('body')
- html/com_content/article/vennoot_body.php

```php
foreach ($this->item->jcfields as $jcfield)
{
	$this->item->jcfield_name_id_map[$jcfield->name] = $jcfield->id;
}

$jcfield_name_id_map = $this->item->jcfield_name_id_map;

$fields = array('achtergrond-en-ervaring','leiderschapsvisie-en-managementstijl','specialisaties-en-trackrecord');

if ($this->item->language == 'en-GB')
{
    $fields = array('background-and-experience','leadership-vision-and-management-style','specialisations-and-track-record');
}

*foreach ($fields as $field)
*{
	$vennoot_body = $this->item->jcfields[$jcfield_name_id_map[$field]];
	if ($vennoot_body->value)
	{
		echo JText::_('<h2>' . $vennoot_body->title . '</h2>');
		echo JText::_($vennoot_body->value);
	}
*}
```

---
# loadTemplate('body')
- html/com_content/article/vennoot_body.php

```php
foreach ($this->item->jcfields as $jcfield)
{
	$this->item->jcfield_name_id_map[$jcfield->name] = $jcfield->id;
}

$jcfield_name_id_map = $this->item->jcfield_name_id_map;

$fields = array('achtergrond-en-ervaring','leiderschapsvisie-en-managementstijl','specialisaties-en-trackrecord');

if ($this->item->language == 'en-GB')
{
    $fields = array('background-and-experience','leadership-vision-and-management-style','specialisations-and-track-record');
}

foreach ($fields as $field)
{
*   $vennoot_body = $this->item->jcfields[$jcfield_name_id_map[$field]];
	if ($vennoot_body->value)
	{
		echo JText::_('<h2>' . $vennoot_body->title . '</h2>');
		echo JText::_($vennoot_body->value);
	}
}
```

---
# loadTemplate('body')
- html/com_content/article/vennoot_body.php

```php
foreach ($this->item->jcfields as $jcfield)
{
	$this->item->jcfield_name_id_map[$jcfield->name] = $jcfield->id;
}

$jcfield_name_id_map = $this->item->jcfield_name_id_map;

$fields = array('achtergrond-en-ervaring','leiderschapsvisie-en-managementstijl','specialisaties-en-trackrecord');

if ($this->item->language == 'en-GB')
{
    $fields = array('background-and-experience','leadership-vision-and-management-style','specialisations-and-track-record');
}

foreach ($fields as $field)
{
	$vennoot_body = $this->item->jcfields[$jcfield_name_id_map[$field]];
*   if ($vennoot_body->value)
*   {
		echo JText::_('<h2>' . $vennoot_body->title . '</h2>');
		echo JText::_($vennoot_body->value);
*   }
}
```

---
# loadTemplate('body')
- html/com_content/article/vennoot_body.php

```php
foreach ($this->item->jcfields as $jcfield)
{
	$this->item->jcfield_name_id_map[$jcfield->name] = $jcfield->id;
}

$jcfield_name_id_map = $this->item->jcfield_name_id_map;

$fields = array('achtergrond-en-ervaring','leiderschapsvisie-en-managementstijl','specialisaties-en-trackrecord');

if ($this->item->language == 'en-GB')
{
    $fields = array('background-and-experience','leadership-vision-and-management-style','specialisations-and-track-record');
}

foreach ($fields as $field)
{
	$vennoot_body = $this->item->jcfields[$jcfield_name_id_map[$field]];
	if ($vennoot_body->value)
	{
*       echo JText::_('<h2>' . $vennoot_body->title . '</h2>');
*       echo JText::_($vennoot_body->value);
	}
}
```

---
# Het resultaat

<img src="jug/bussum/201710/cm-team-item-content.png">

---
# Het resultaat - Engels

<img src="jug/bussum/201710/cm-team-item-content-en.png">

---
# Overzicht door templates - herhaling

```php
<?php echo Jlayouts::render('content.heading', array('title' => $this->item->title, 'bgcolor' => 'white')); ?>

<section class="section section__vennoot">
    <div class="container">
        <div class="section__content section__content--vennoot">
            <div class="block__vennoot-top">
				<?php echo $this->loadTemplate('top'); ?>
            </div>

            <div class="block__vennoot-main">
				<?php echo $this->item->event->beforeDisplayContent; ?>
				<?php echo $this->loadTemplate('body'); ?>
				<?php echo $this->item->event->afterDisplayContent; ?>
            </div>

            <div class="block__vennoot-bottom">
	            <?php echo $this->loadTemplate('bottom-opdrachten'); ?>
	            <?php echo $this->loadTemplate('bottom-publicaties'); ?>
            </div>
        </div>

        <div class="section__content section__content--aside">
            <div class="block__vennoot-image">
*				<?php echo $this->loadTemplate('image'); ?>
            </div>
			<?php echo $this->loadTemplate('aside'); ?>
        </div>

    </div>
</section>
```

---
# loadTemplate('image')
- html/com_content/article/vennoot_image.php

```php
<?php
$images  = json_decode($this->item->images);

if(isset($images->image_teammember) && !empty($images->image_teammember))
{
	echo '<figure>';
	echo JHtml::_('image', $images->image_teammember, $this->item->title);
	echo '</figure>';
}
```

<img src="jug/bussum/201710/cm-team-item-image.png">

----
# Alleen com_content

De gehele website kan door de klant via Inhoud > Artikelen bijgehouden worden.

Is de weergave niet zoals ze wil, dan geen lege breaks plaatsen, maar css wijzigen.

---
class: middle, center, intro
# Dank voor jullie aandacht

## Hans Kuijpers
## @hans2103

