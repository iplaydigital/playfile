<?php error_reporting(E_ALL ^ E_NOTICE);
/*****************************************************************
Created :28/02/2565
Author : worapot pilabut (aj.ake)
E-mail : worapot.playdigital@gmail.com
Website : https://conenct.playdigital.co.th
Copyright (C) 2023, Play digital Co.,Ltd. all rights reserved.
 *****************************************************************/


include_once("../include/config.inc.php");
include_once("../include/class.inc.php");
include_once("../include/class.TemplatePower.inc.php");
include_once("../include/function.inc.php");
include_once("../authentication/check_login.php");



$tpl = new TemplatePower("../template/_tp_inner.html");
$tpl->assignInclude("body", "_tp_board.html");
$tpl->prepare();
$tpl->assign("_ROOT.page_title", "Bord");
$tpl->assign("_ROOT.logo_brand_alt", $Brand);







$TodayThaiShow = ThaiToday($strDateTime, $tnow);

/*
$query	= "SELECT * FROM `tb_task_all` WHERE `STATUS`='Show' ORDER BY `ID` DESC";
$result	= mysql_query($query);
while($line = mysql_fetch_array($result)) {
$tpl->newBlock("WORKLIST");



$tpl->assign("img",$line["THUMB"]);




}
*/
$board_id = $_GET["board_id"];

$token = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjIzNzY5NDQyMCwidWlkIjozODkxNzU1MSwiaWFkIjoiMjAyMy0wMi0xNlQwNjo1NDowOS4wODFaIiwicGVyIjoibWU6d3JpdGUiLCJhY3RpZCI6MTUwMTIxNTUsInJnbiI6InVzZTEifQ.BAOQ1KXPUW3rdfwiBdZLmdBnMfTie1YUCUoHGOEkwPc';
$apiUrl = 'https://api.monday.com/v2';
$headers = ['Content-Type: application/json', 'Authorization: ' . $token];
//$query = '{ boards { id name } }';


$query = '{
    boards (ids: ' . $board_id .') {
        owners {
            id
        }
        columns {
            title
            type
        }       
    }
}';
echo $query;

$data = @file_get_contents($apiUrl, false, stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => $headers,
        'content' => json_encode(['query' => $query]),
    ]
]));
$array = json_decode($data, true);
foreach ($array['data']['boards'] as $board) {

    $tpl->newBlock("WORKLIST");
    $tpl->assign("title",$board['title']);
   // echo "<tr> <td>" . $board['id'] . "</td> <td>" . $board['name'] . "</td> </tr>";



}













$tpl->assign("_ROOT.Powerby", $Powerby);
$tpl->assign("_ROOT.Copyright", $Copyright);
$tpl->printToScreen();

