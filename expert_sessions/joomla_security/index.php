<?php
// Page information
$eventDate = 'vrijdag 23 oktober, 14:00-17:00 uur';
$eventLocation = 'Bussum';
$eventTitle = 'Joomla! Security - Expert Sessie';
$eventTag = '<h1>Joomla! Security<br/><span>Expert Sessie</span></h1>';

require_once '../slide.class.php';
$slideset = new Slideset();
$slidesetData = $slideset->getData();
$slidesetTitle = $slideset->getTitle();
$slidesetStyle = $slideset->getStyle();
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $eventTitle; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="../css/pwt.css" />
    <link rel="stylesheet" href="../css/<?php echo $slidesetStyle; ?>.css" />
  </head>
  <body class="session-bg">
    <div class="container">
        <div class="title-box">
            <div class="title">
                <?php echo $eventTag; ?>
                <p><?php echo $eventDate; ?>, <?php echo $eventLocation; ?></p>
            </div>
        </div>
    </div>
    <div class="container container-program">
    <h3><?php echo $slidesetTitle; ?></h3>
    <ul>
        <?php foreach($slidesetData as $slideset) : ?>
        <li>
            <?php $title = $slideset['title'] . ' (' . $slideset['speaker']. ')'; ?>
            <a href="../slide.php?theme=<?= $slidesetStyle; ?>&id=<?= $slideset['id']; ?>">
                <?php echo $title; ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
    </div>
  </body>
</html>
