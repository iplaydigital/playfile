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
include_once("../include/trello-api.php");


$tpl = new TemplatePower("../template/_tp_inner_Trello.html");
$tpl->assignInclude("body", "_tp_index.html");
$tpl->prepare();
$tpl->assign("_ROOT.page_title", "Trello");
$tpl->assign("_ROOT.logo_brand_alt", $Brand);
$tpl->assign("_ROOT.fullname",$_SESSION['FULLNAME']);
$TodayThaiShow = ThaiToday($strDateTime, $tnow);
$tpl->assign("_ROOT.TodayThaiShow", $TodayThaiShow);




$trello = new trello_api($key, $token);
//$data = $trello->request('GET', ('/boards/64940f6cb9386f2faa47a895'));
$data = $trello->request('GET', ('/boards/64940f6cb9386f2faa47a895/lists'));
//$data = $trello->request('GET', ('/boards/64940f6cb9386f2faa47a895/lists?name=Bang'));
//echo '<pre>';
//print_r($data);
//echo '</pre>';
//---------------//







foreach ($data as $list) {

    $tpl->newBlock("DATA");
    $tpl->assign("name",$list->name);
    $tpl->assign("id",$list->id);

    $data2 = $trello->request('GET', ('/lists/'.$list->id.'/cards'));
    $no=0;
    foreach ($data2 as $list2) {
        $no++;
        if($no<15){
        $tpl->newBlock("LISTDATA");
        if($no==1){ 
            $tpl->assign("ac","show");
            $tpl->assign("st","true");
        }else{
            $tpl->assign("st","false");
        }
        $tpl->assign("no",$no);   
        $tpl->assign("name",$list->name);
        $tpl->assign("name2",$list2->name);
        $tpl->assign("desc",$list2->desc);
        $tpl->assign("id",$list2->id);


        }

    }


}



//tpl->assign("_ROOT.DATA", $data2);
$tpl->assign("_ROOT.Powerby", $Powerby);
$tpl->assign("_ROOT.Copyright", $Copyright);
$tpl->printToScreen();

