<?php error_reporting(E_ALL ^ E_NOTICE);
/*****************************************************************
Created :01/10/2021
Author : worapot bhilarbutra (pros.ake)
E-mail : worapot.bhi@gmail.com
Website : https://www.vpslive.com
Copyright (C) 2021-2025, VPS Live Digital togethers all rights reserved.
 *****************************************************************/





// Mysql Version 
/*
if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {

	$db_config = array(
		"host" => "localhost",
		"user" => "root",
		"pass" => "",
		"dbname" => "fufudev_office",
		"charset" => "utf8"
	);
} else {
*/
// Mysql Version 
$db_config = array(
	"host" => "203.146.252.149",
	"user" => "fufudev_office",
	"pass" => "mn@91rB6",
	"dbname" => "vpsoffice",
	"charset" => "utf8"
);
/*}*/









date_default_timezone_set("Asia/Bangkok");

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
	//	header( 'Location: https://office.vpslive.com/' ) ;
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
$tableMemberAddress					= 	"tb_member_address";
$tableMailMessage 					= 	"tb_mail_message";
$tableWebMil 						= 	"tb_mail_message";
$tableWebMenu 						= 	"tb_web_menu";
$tableHotLink						=   "tb_hotlink";

$tableContents 						= 	"tb_contents_detail";
$tableCustomers						= 	"tb_customers";

$tableProvince						=	"tb_province";
$tableAmphur						=	"tb_amphur";
$tableDistrict						=	"tb_district";

$tablePage 							= 	"tb_page";
$tablePageDetail 					= 	"tb_page_detail";
$tableSetting						= 	"tb_setting";



// All config
$cfgDefaultPerPage = 5;
$cfgOtherRowPerPage = 15;



// Session
if (substr_count($_SERVER["SCRIPT_NAME"], "/") == 1) {
	session_name("swcms");
}

session_start();


if (empty($_SESSION['file_upload'])) $_SESSION['file_upload'] = array();


// Connect MySQL
$conn = @new mysqli($db_config["host"], $db_config["user"], $db_config["pass"], $db_config["dbname"]);
$conn->set_charset($db_config["charset"]);












if ($_SESSION["lang"] == "") {
	$_SESSION["lang"] = "_th";
}
if ($_GET['lang'] != "") {
	unset($_SESSION["lang"]);
	if ($_GET['lang'] == "th") {
		$_SESSION["lang"] = "_th";
	} else {
		$_SESSION["lang"] = "_eng";
	}
}
