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
$tpl->assignInclude("body", "_tp_items.html");
$tpl->prepare();
$tpl->assign("_ROOT.page_title", "Bord");
$tpl->assign("_ROOT.logo_brand_alt", $Brand);




$board_id = $_GET['board_id'];
$TodayThaiShow = ThaiToday($strDateTime, $tnow);




$token = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjIzNzY5NDQyMCwidWlkIjozODkxNzU1MSwiaWFkIjoiMjAyMy0wMi0xNlQwNjo1NDowOS4wODFaIiwicGVyIjoibWU6d3JpdGUiLCJhY3RpZCI6MTUwMTIxNTUsInJnbiI6InVzZTEifQ.BAOQ1KXPUW3rdfwiBdZLmdBnMfTie1YUCUoHGOEkwPc';
$apiUrl = 'https://api.monday.com/v2';
$headers = ['Content-Type: application/json', 'Authorization: ' . $token];
$query = '{
    boards (ids: ' . $board_id .') {
      name
      state
      board_folder_id
      items (limit:100) {
        id
        name
        column_values {
          text
        }
      }
    }
  }';



$data = @file_get_contents($apiUrl, false, stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => $headers,
        'content' => json_encode(['query' => $query]),
    ]
]));
$array1 = json_decode($data, true);
$jsonString = json_encode($array1['data']['boards']);
$array = json_decode($jsonString, true);
$items = $array[0]['items'];

$i=0;



///echo $jsonString."<br><br>";





foreach ($items as $item) {
$id = $items[$i]['id'];
$items_name = $items[$i]['name'];
$status = $items[$i]['column_values'][4]['text'];

$tpl->newBlock("WORKLIST");
$tpl->assign("title",$items_name);

$i++;

}







$tpl->assign("_ROOT.Powerby", $Powerby);
$tpl->assign("_ROOT.Copyright", $Copyright);
$tpl->printToScreen();

