<?php error_reporting(E_ALL ^ E_NOTICE);
/*****************************************************************
Created :21/02/2023
Author : worapot bhilarbutra (p.ake)
E-mail : worapot.bhi@gmail.com
Website : https://www.vpslive.com
Copyright (C) 2023-2025, VPS Live Digital togethers all rights reserved.
 *****************************************************************/

include_once("./include/config.inc.php");
include_once("./include/class.inc.php");
include_once("./include/class.TemplatePower.inc.php");


$tpl = new TemplatePower("template/_tp_main.html");
$tpl->assignInclude("body", "_tp_index.html");
$tpl->prepare();
$tpl->assign("_ROOT.page_title", "หน้าแรก");


$strDateTime  = date("Y-m-d h:i:s");
$tnow          = date("h:i:s");

function ThaiToday($strDateTime, $tnow)
{
    $arrThaiMonth = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    list($strYMD, $strTime) = explode(" ", $strDateTime);
    list($intY, $intM, $intD) = explode("-", $strYMD);
    $intY = $intY + 543;
    $strM = $arrThaiMonth[$intM * 1];
    $intD = $intD * 1;
    $TodayThai = " " . $intD . " " . $strM . " " . $intY . " เวลา :" . $tnow;
    return $TodayThai;
}


$TodayThaiShow = ThaiToday($strDateTime, $tnow);

$tpl->assign("_ROOT.Today", "วันนี้" . $TodayThaiShow);

$sql = "SELECT * FROM `" . $tableHotLink  . "`";
$query = $conn->query($sql) or die($conn->error);
$total = $query->num_rows;
$total = number_format($total);

$i = 0;

while ($ln = $query->fetch_assoc()) {
    $i++;
    $tpl->newBlock("HOTLINK");
    $tpl->assign("no", $i);
    $tpl->assign("bgcolor", $ln['COLOR']);
    $tpl->assign("svg", $ln['SVG']);
}




$tpl->printToScreen();
