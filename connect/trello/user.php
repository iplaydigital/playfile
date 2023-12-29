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
$tpl->assignInclude("body", "_tp_user.html");
$tpl->prepare();
$tpl->assign("_ROOT.page_title", "Trello");
$tpl->assign("_ROOT.logo_brand_alt", $Brand);
$tpl->assign("_ROOT.fullname",$_SESSION['FULLNAME']);
$TodayThaiShow = ThaiToday($strDateTime, $tnow);
$tpl->assign("_ROOT.TodayThaiShow", $TodayThaiShow);




$trello = new trello_api($key, $token);
$data = $trello->request('GET', ('/boards/603cbdf9efcf618762ed8612/lists'));
//$data = $trello->request('GET', ('/boards/603cbdf9efcf618762ed8612/lists?'));
//$data = $trello->request('GET', ('/boards/603cbdf9efcf618762ed8612/lists?name=Bang'));
//$data = $trello->request('GET', ('/lists/603cbdf9efcf618762ed8612/archiveAllCards'));
$data = $trello->request('GET', ('/lists/5f210d59e437781b427c127a/cards'));

echo '<pre>';
print_r($data);
echo '</pre>';
//---------------//

foreach ($data as $list) {
    $tpl->newBlock("DATA");
   $NameStaff = $list->desc;
   if($NameStaff=='Bang'){}

    $tpl->assign("name",$list->desc);
    $tpl->assign("id",$list->id);

   

}


$tpl->assign("_ROOT.DATA", $data2);
$tpl->assign("_ROOT.Powerby", $Powerby);
$tpl->assign("_ROOT.Copyright", $Copyright);
$tpl->printToScreen();

