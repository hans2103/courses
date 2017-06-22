<?php
// Page information
$eventDate     = 'vrijdag 23 juni, 13:00-17:00 uur';
$eventLocation = 'Watertoren Bussum';
$eventTitle    = 'Joomla! Performance - Expert Sessie';
$eventTag      = '<h1>Joomla! Performance<br><span>Expert Sessie</span></h1>';

require_once '../slide.class.php';
$slideset      = new Slideset();
$slidesetData  = $slideset->getData();
$slidesetTitle = $slideset->getTitle();
$slidesetStyle = $slideset->getStyle();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $eventTitle; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <link rel="stylesheet" href="../css/base.css"/>
    <link rel="stylesheet" href="../css/<?php echo $slidesetStyle; ?>.css"/>
</head>
<body class="session-bg">
<div class="container index container-title">
    <div class="title-box">
        <div class="title">
			<?php echo $eventTag; ?>
            <p><?php echo $eventDate; ?><br><?php echo $eventLocation; ?></p>
            <div class="logo pwt">
                <img src="../images/perfectwebteam.png">
            </div>
            <div class="logo">
                <img src="../images/yireo.png">
            </div>
        </div>
    </div>
</div>
<div class="container index container-program">
    <ul>
		<?php foreach ($slidesetData as $slideset) : ?>
            <li>
				<?php if (!empty($slideset['file'])): ?>
                    <a href="../slide.php?theme=<?php echo $slidesetStyle; ?>&id=<?php echo $slideset['id']; ?>">
						<?php echo $slideset['title']; ?>
                    </a>
				<?php else: ?>
					<?php echo $slideset['title']; ?>
				<?php endif; ?>
            </li>
		<?php endforeach; ?>
    </ul>
</div>
</body>
</html>
