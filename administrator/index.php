<?php
	session_start();
	include("../include/connect.php");
	include("../include/function.php");
	$today = date("Y-m-d");
	$time = date("H:i:s");
?>	
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title> PLAYDIGITAL</title>
	<meta name="description" content="Perfectum Dashboard Bootstrap Admin Template.">
	<meta name="author" content="Łukasz Holeczek">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	
	<!----------editor--------------->
		<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
		<script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
	<!------------------------------->
	
	<!--[if lt IE 7 ]>
	<link id="ie-style" href="css/style-ie.css" rel="stylesheet">
	<![endif]-->
	<!--[if IE 8 ]>
	<link id="ie-style" href="css/style-ie.css" rel="stylesheet">
	<![endif]-->
	<!--[if IE 9 ]>
	<![endif]-->
	
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
		<?
		if($_GET['page']=="" or $_GET['page']=="login"){
			$_GET['page']="login"; ?>
			<style type="text/css"> body { background: url(img/bg-login.jpg) !important; } </style>
		<?	} ?>
</head>

<body>
	<!-- <div id="overlay">
		<ul>
		  <li class="li1"></li>
		  <li class="li2"></li>
		  <li class="li3"></li>
		  <li class="li4"></li>
		  <li class="li5"></li>
		  <li class="li6"></li>
		</ul>
	</div>	-->
	<!-- start: Header -->
		<?
		if($_GET['page']!="login"){
			include("system/header.php");
		}
		?>
	<!-- start: Header -->
	
	<div class="container-fluid">
		<?
		if($_GET['page']=="" or $_GET['page']=="login"){
			include("system/login.php");
		}else{
		
		?>
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
				<? include("system/menu.php");?>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- start: Content -->
			
			<?php 
			if($_GET['page']=="" or $_GET['page']=="login"){
				$_GET['page']="login";
				include("system/include_page.php");
			}else{
				include("system/include_page.php");
			}
			?>
			
			<!-- end: Content -->
			</div><!--/#content.span10-->
		</div><!--/fluid-row-->
				
		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>
		
		<div class="clearfix"></div>
		
		<footer>
			<p>
				<span style="text-align:left;float:left">&copy; 2016 <a href="http://bootstrapmaster.com" alt="Bootstrap Themes">Playdigital</a></span>
				<span class="hidden-phone" style="text-align:right;float:right">Powered by: <a href="../" alt="Bootstrap Admin Templates">Playdigital</a></span>
			</p>
		</footer>
		<?
		}
		?>
	</div><!--/.fluid-container-->

	<?
		include("../include/inc_script.php");
	?>
	
</body>
</html>
