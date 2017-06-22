<?php
require_once 'slide.class.php';
$slideshow = new Slideshow();
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $slideshow->getTitle(); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
	<link rel="stylesheet" href="css/base.css"/>
	<link rel="stylesheet" href="css/plyr.css"/>
	<link rel="stylesheet" href="css/<?php echo $slideshow->getStyle(); ?>.css"/>
</head>
<body>
<textarea id="source"><?php echo file_get_contents($slideshow->getFile()); ?></textarea>
<script src="js/remark-latest.min.js"></script>
<script>
	var slideshow = remark.create({
		slideNumberFormat: '<?php echo $slideshow->getTitle(); ?> - %current% of %total%',
		highlightStyle: 'googlecode'
	});
</script>
<script>
	(function(d, p){
		var a = new XMLHttpRequest(),
			b = d.body;
		a.open("GET", p, true);
		a.send();
		a.onload = function(){
			var c = d.createElement("div");
			c.style.display = "none";
			c.innerHTML = a.responseText;
			b.insertBefore(c, b.childNodes[0]);
		}
	})(document, "images/sprite.svg");
</script>
<script src="js/plyr.js"></script>
<script>plyr.setup({
		controls: ["restart", "play", "current-time", "duration", "fullscreen"],
		displayDuration: false,
		volume: 1,
	});</script>
</body>
</html>
