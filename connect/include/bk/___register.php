<?php error_reporting (E_ALL ^ E_NOTICE);
/*****************************************************************
Created : 08/06/2014
Author : P' Ake HaUskaa 
E-mail : info@hauskaa.in
Website : http://www.hauskaa.in
Copyright (C) 2014, Hauskaa all rights reserved.
*****************************************************************/

include_once("./include/config.inc.php");
include_once("./include/function.inc.php");
include_once("./include/class.inc.php");
include_once("./include/class.TemplatePower.inc.php");

$tpl = new TemplatePower("_tp_register.html");
$tpl->prepare();

//Keypage(1);

##########




if($_GET['lag']!="" && $_SESSION['lag']!=""){$_SESSION['lag']=$_GET['lag'];}
if($_GET['lag']=="" && $_SESSION['lag']==""){$_SESSION['lag']=1;}else{$lag=$_GET['lag'];}
if(!isset($_GET['lag'])  && !isset($_SESSION['lag']) || $_GET['lag']=="" && !isset($_SESSION['lag']))  {$lag=$lagdf;}
if(!isset($_GET['lag'])  && isset($_SESSION['lag']) || $_GET['lag']=="" && isset($_SESSION['lag']))  {$lag=$_SESSION['lag'];}

if($lag==2){
	$tpl->newBlock("EN");
	if($_GET["lag"]!=""){
		$tpl->assign("_ROOT.flag","<li><a href='http://www.lesashaclub.com".str_replace("?lag=2" , "" , $_SERVER["REQUEST_URI"] )."?lag=1'><img src='assets/images/thailand-flag.png' alt='Thailand Flag'></a></li>");
	}else{
		$tpl->assign("_ROOT.flag","<li><a href='http://www.lesashaclub.com".$_SERVER["REQUEST_URI"]."?lag=1'><img src='assets/images/thailand-flag.png' alt='Thailand Flag'></a></li>");
	}
	
}else{
	$tpl->newBlock("TH");
	if($_GET["lag"]!=""){
		$tpl->assign("_ROOT.flag","<li><a href='http://www.lesashaclub.com".str_replace("?lag=1" , "" , $_SERVER["REQUEST_URI"] )."?lag=2'><img src='assets/images/united-kingdom-flag.png' alt='United Kingdom Flag'></a></li>");
	}else{
		$tpl->assign("_ROOT.flag","<li><a href='http://www.lesashaclub.com".$_SERVER["REQUEST_URI"]."?lag=2'><img src='assets/images/united-kingdom-flag.png' alt='United Kingdom Flag'></a></li>");
	}	

}

	

	
		
// register /////////////////////////////////////////////////////

if(trim($_GET['action'])=='logout'){
	
	unset($_COOKIE['les_member']);
	unset($_SESSION);
	setcookie('les_member', '', time()-3600,'/');
	session_destroy();
	
	header("Location: login.php");
	/*exit();*/

}
		
///////////////////////////////////////////////////
if($_SESSION['displayname']!=""){
		$tpl->newBlock("SUCCES");
		$tpl->assign("displayname",$_SESSION['displayname']);
}
elseif($_SESSION['displayname']==""){ //  ถ้ายังไม่ได้ล็อกอิน  
		$tpl->newBlock("ERROR");
 }

///////////////////////////////////////////////////

if($_POST['action']=='register'){
	
		if(isset($_POST['email']) && isset($_POST['password']) ){
			
			/*$q = 'select count(id) as num from member where lower(email)="'.mysql_real_escape_string(strtolower($_POST['email'])).'"';
			$rs = mysql_query($q);
			$row = mysql_fetch_assoc($rs);*/
			
			$q = "select count(id) as num from `jie_member` where email='".mysql_real_escape_string(strtolower($_POST['email']))."'";
			$rs = mysql_query($q) or die(mysql_error());
			$row = mysql_fetch_assoc($rs);

			if($row['num']==0){
								
				$data = array();
				
				$data['email'] 		= strtolower($_POST['email']);
				$data['password'] 	= md5(md5($_POST['password']).md5('lesasha'));
				$data['firstname'] 	= $_POST['name'];
				$data['surname'] 	= $_POST['surname'];
				$data['gender'] 	= $_POST['gender'];
				$data['birthday'] 	= $_POST['year']."-".$_POST['month']."-".$_POST['day'];
				$data['date'] 		= date("Y-m-d H:i:s");
				$data['mode'] 		= 'website';
				$data['active'] 	= 1;
					
				
				if( mysql_query(sqlCommandInsert($tableMember,$data)) ){
					$id = mysql_insert_id();
					$code = 'LES'.date('Y').sprintf("%05d", $id);

					mysql_query(sqlCommandUpdate($tableMember,array('memcode'=>$code),'id="'.$id.'" '));
						
						
// 						$code_salt = md5(md5(mt_rand()).md5($id));
// 						mysql_query(sqlCommandUpdate($tableMember,array('code'=>$code_salt),'id="'.$id.'" '));
// 						if($code_salt){
// 							$link = 'http://www.docofficial.com/2015/register.php?action=code&c='.$code_salt;
							
// 							$subject = 'ยืนยันการเปิดใช้บัญชีของคุณ ในเว็บไซต์ www.docofficial.com';
// 							$detail = 'เรียนคุณ : '.$data['fullname'].'<br />';
// 							$detail .= 'เรื่อง : ยืนยันการเปิดใช้บริการ สมัครสมาชิก เพื่อสั่งซื้อสินค้าในเว็บไซต์ <a href="http://www.docofficial.com/">www.docofficial.com</a><br /><br /><br />';
// 							$detail .= 'ทางบริษัทได้ตรวจสอบข้อมูลของท่านแล้วและอนุญาติให้ท่านสามารถซื้อสินค้า <br />  ในเว็บไซต์ <a href="http://www.docofficial.com/">www.docofficial.com</a> โดยท่านจะต้องยืนยันโดยคลิ๊ก ตามลิ้งนี้ <br /><br />';
// 							$detail .= '<a href="'.$link.'">เปิดใช้งานบัญชี '.$data['email'].'</a><br /><br />';
// 							$detail .= 'การสั่งซื้อสินค้าจะต้องสั่งซื้อสินค้าภายใต้ข้อกำหนดของบริษัทฯ  <br /> และสั่งซื้อตั้งแต่ 1,000 บาท ขึ้นไปเท่านั้น <br /><br />';
// 							$detail .= 'ขอแสดงความนับถือ <br /> www.docofficial.com <br />';
				
// 							include_once("./include/class.phpmailer.php");
// 							include_once("./include/setting.php");
// 							$mail = getPHPmailer();
// 							$mail->Subject	= $subject;
// 							$mail->Body		= $detail;
// 							$mail->AddAddress(strtolower($_POST['email']));
// 							//$mail->Send();
// if(!$mail->Send()) {
//     //echo "Mailer Error: " . $mail->ErrorInfo;

// 	echo "<script language=\"JavaScript\">alert('Mailer Error: ".$mail->ErrorInfo."');</script>";	
// } else {
// 	echo "<script language=\"JavaScript\">alert('Mailer Complete');</script>";
// }								
// 							$mail->ClearAddresses();
// 						}												
				}
				
				//$tpl->newBlock("SUCCES1");	
				header("Location: login.php");				
			}else{
				$tpl->newBlock("ERROR2");
			}//if($row['num']==0){
						
		}//if(isset($_POST['email']){
}		

//////////////////////////////////////////////////



for($day=1;$day<=31;$day++)
{
	$tpl->newBlock("DAY");
	$tpl->assign("day",$day);
}

$month_name = array("January","February","March","April","May","June","July","August","September","October","November","December");
for($month=0;$month<count($month_name);$month++)
{
	$tpl->newBlock("MONTH");
	$tpl->assign("month",$month_name[$month]);
	$tpl->assign("no",$month+1);
}

for($year=date("Y");$year>=date("Y")-100;$year--)
{
	$tpl->newBlock("YEAR");
	$tpl->assign("year",$year);
}


//setting();
FRONTSETTING($lag);
FRONTPAGESEO("Shop",$lag);
FRONTSLIDE($lag);
FRONTCONTACT($lag);
NUMCART($lag);
/*MENUPRODUCT($lag);*/

$tpl->printToScreen();
ob_end_flush();
clearstatcache();

?>