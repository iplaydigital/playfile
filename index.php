<?
include("include/connect.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Play digital Turn on our ideas, Let’s play to win</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="css/css.css">
<script>
document.createElement('article'); document.createElement('aside'); document.createElement('details'); document.createElement('figcaption'); document.createElement('figure'); document.createElement('footer'); document.createElement('header'); document.createElement('hgroup'); document.createElement('main'); document.createElement('nav'); document.createElement('section'); document.createElement('summary');
</script>
</head>


<!--Menu Drop Down-->
<!--<script src="js/dropdown/jquery-1.9.0.min.js"></script>-->
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<script src="js/dropdown/hoverIntent.js"></script>
<script src="js/dropdown/superfish.js"></script>
<script>
// initialise plugins
jQuery(function(){
    jQuery('#example').superfish({
        useClick: true,
		pathClass:	'current'
    });
});
</script>
<style>
.sf-sub-indicator {
  display:none !important;
}
</style>
<!--Menu Drop Down-->

<!--Burger Menu-->
<script src="js/burgerMenu/modernizr.custom.js"></script>
<!--<script src="js/burgerMenu/jquery.min.js"></script>-->
<script src="js/burgerMenu/jquery.dlmenu.js"></script>
<script>
	$(function() {
		$( '#dl-menu' ).dlmenu();
	});
</script>

<!-- Slick JS-->

<link rel="stylesheet" type="text/css" href="css/slick.css" />
<link rel="stylesheet" type="text/css" href="css/slick-theme.css" />

<link rel="stylesheet" type="text/css" href="js/burgerMenu/default.css" />
<link rel="stylesheet" type="text/css" href="js/burgerMenu/component.css" />
<style>
	.sf-sub-indicator {
	  display:none !important;
	}
</style>
<style>
	.current {
		color:#fc5222;
		text-decoration:underline;
	}

</style>

<!--Burger Menu-->
<!--Fancy jQuery Lightbox Alternative | Demonstrations-->
<!--<script type="text/javascript" src="js/lightbox/jquery-1.10.1.min.js"></script>-->
<script type="text/javascript" src="js/lightbox/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="js/lightbox/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="js/lightbox/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" type="text/css" href="js/lightbox/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="js/lightbox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<link rel="stylesheet" type="text/css" href="js/lightbox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script type="text/javascript" src="js/lightbox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<script type="text/javascript" src="js/lightbox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="js/lightbox/JSfancybox-media.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$(".various").fancybox({
		maxWidth	: 720,
		maxHeight	: 273,
		fitToView	: false,
		width		: '99%',
		height		: '100%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>
<style>
.fancybox-overlay {
	background-color:rgba(0,0,0,0.7);
}

.menuMain #example li.m-work::after {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: rgba(0, 0, 0, 0.5) transparent transparent;
    border-image: none;
    border-style: solid;
    border-width: 5px;
    content: "";
    height: 0;
    margin-top: -3px;
    position: absolute;
    right: -3px;
    top: 50%;
    width: 0;
}

</style>
<script>
	function load_popup(){
		document.getElementById('vdo_').click();
	}
</script>
<!--End Fancy jQuery Lightbox Alternative | Demonstrations-->

<script src="js/slidePage/functions.js"></script>
<body  onLoad="load_popup()">

<?php include('system/header.php') ?>
<?php include('system/include_page.php') ?>
<?php include('system/contact.php') ?>

</body>
</html>
