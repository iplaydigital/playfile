<?php
error_reporting(E_ALL ^ E_NOTICE);

/*****************************************************************
Created :01/10/2021
Author : worapot bhilarbutra (pros.ake)
E-mail : worapot.bhi@gmail.com
Website : <https://www.vpslive.com>
Copyright (C) 2021-2025, VPS Live Digital togethers all rights reserved.
 *****************************************************************/

// Setting
$Brand 		= "Welcome";
$Copyright 	= "Play digital Co.,Ltd.";
$Powerby 	= "อ.พี่เอก";

// Database
$db_config = array(
	"host" => "203.151.157.19",
	"user" => "playco_md",
	"pass" => "Mbf7MmIy1oOulR",
	"dbname" => "playco_monday",
	"charset" => "utf8"
);

/* worapot.playdigitial@gmail.com*/
$key = 'ed0def94964aaa86975e462497b270db';
$token = 'ATTA4fbdcde14ba97cb2a5de2c7dd3f147cc7c7abfda5c4da6bf12846f9fe0fb5cdcA6946950';

/* IT@playdigital.co.th
ใช้ไม่ได้
$key ='97c1c3591e88a0c2331e9801b327a8a6';
$token = '69c0dc691916ce1cfd9992a51b36acda2016a3a2a869625175f7893ef79886ec';
*/

// monday.com
$mondaytoken 		= 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjIzNzY5NDQyMCwidWlkIjozODkxNzU1MSwiaWFkIjoiMjAyMy0wMi0xNlQwNjo1NDowOS4wODFaIiwicGVyIjoibWU6d3JpdGUiLCJhY3RpZCI6MTUwMTIxNTUsInJnbiI6InVzZTEifQ.BAOQ1KXPUW3rdfwiBdZLmdBnMfTie1YUCUoHGOEkwPc';
$mondayapiUrl 		= 'https://api.monday.com/v2';
$mondayheaders 		= ['Content-Type: application/json', 'Authorization: ' . $mondaytoken];

// trello.com Powerup
$trelloapi		="ed0def94964aaa86975e462497b270db";
$trellotoken 	="463faebb20d8b28c04ff9591da6afff2e704c56f723b97cafedcfae967d4559d";
$trelloapiUrl   ="https://api.trello.com/1";
//Token Master
$trellotokenM 	="ATTA4fbdcde14ba97cb2a5de2c7dd3f147cc7c7abfda5c4da6bf12846f9fe0fb5cdcA6946950";


$boardConnect = "https://trello.com/b/8ZQZ7Z7O/connect";

//SET Time
date_default_timezone_set("Asia/Bangkok");
$strDateTime  = date("Y-m-d h:i:s");
$tnow          = date("h:i:s");

$iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
$iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
$webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");
$status = true;

if ($iPod || $iPhone) {
	$status = false;
	//were an iPhone/iPod touch -- do something here
} else if ($iPad) {
	$status = false;
	//were an iPad -- do something here
} else if ($Android) {
	$status = false;
	//were an Android device -- do something here
} else if ($webOS) {
	$status = false;
	//were a webOS device -- do something here
}
if ($status == true) {
	//	header( 'Location: https://connect.playdigital.co.th' ) ;
}

// Display Error ,0=none display,1=display
@ini_set('display_errors', '1');
@set_time_limit(0);

// MySQL Table
$tableLag 							= 	"tb_lag";
$tableAdmin 						= 	"tb_admin_user";
$tableAdminMenu 					= 	"tb_admin_menu";
$tableMessage 						= 	"tb_message";
$tableMember 						= 	"tb_member";
$tableMembersLogin					= 	"tb_members_login";
$tableMemberAddress					= 	"tb_member_address";
$tableMailMessage 					= 	"tb_mail_message";
$tableWebMil 						= 	"tb_mail_message";
$tableWebMenu 						= 	"tb_web_menu";

$tableLog							=   "tb_linelog";
$tableOrders						=	"tb_orders";
$tableTask							=   "tb_task";
$tableSocial						=   "tb_social";
$tableHotLink						=   "tb_hotlink";

$tableDayliExpress 					=   "tb_DailyExpress";
$tableTrackLog 					    =   "tb_track_log";


$tableContents 						= 	"tb_contents_detail";
$tableCustomers						= 	"tb_customers";
$tableAgents						= 	"tb_agents";


$tableProvince						=	"tb_province";
$tableAmphur						=	"tb_amphur";
$tableDistrict						=	"tb_district";

$tablePage 							= 	"tb_page";
$tablePageDetail 					= 	"tb_page_detail";
$tableSetting						= 	"tb_setting";


$tableProducts						=	"tb_products";
$tableAgent							=	"tb_agent";
$tableBotAction						=	"tb_bot_action";


$tableHelpSupport					=	"tp_help_support";

// All config
$cfgDefaultPerPage = 5;
$cfgOtherRowPerPage = 15;


// Session
if (substr_count($_SERVER["SCRIPT_NAME"], "/") == 1) {
	session_name("connect");
}

session_start();

if (empty($_SESSION['file_upload'])) {
	$_SESSION['file_upload'] = array();
}

// Connect MySQL
$conn = new mysqli($db_config["host"], $db_config["user"], $db_config["pass"], $db_config["dbname"]);
$conn->set_charset($db_config["charset"]);

if (!isset($_SESSION["lang"]) || empty($_SESSION["lang"])) {
	$_SESSION["lang"] = "_th";
}
if (isset($_GET['lang'])) {
	unset($_SESSION["lang"]);
	if ($_GET['lang'] == "th") {
		$_SESSION["lang"] = "_th";
	} else {
		$_SESSION["lang"] = "_eng";
	}
}

?>
