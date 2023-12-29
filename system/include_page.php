<?
	if($_GET['page']=="home" or $_GET['page']==""){
		include("system/home.php");
	}else if($_GET['page']=="clients"){
		include("system/clients.php");		
	}else if($_GET['page']=="work"){
		include("system/work.php");		
	}else if($_GET['page']=="category"){
		include("system/category.php");		
	}else if($_GET['page']=="detail-work"){
		include("system/detail-work.php");		
	}else if($_GET['page']=="detail-workVDO"){
		include("system/detail-workVDO.php");		
//	}else if($_GET['page']=="news-detail"){
//		include("system/news-detail.php");		
//	}else if($_GET['page']=="infections"){
//		include("system/infections.php");		
//	}else if($_GET['page']=="infections-detail"){
//		include("system/infections-detail.php");		
	}
?>