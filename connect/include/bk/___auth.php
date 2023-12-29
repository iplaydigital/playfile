<?php


if(isset($_COOKIE['les_member']) && $_COOKIE['les_member']!=''){
	/*$ck = json_decode(base64_decode($_COOKIE['doc_member']));*/
	$ck = unserialize(base64_decode($_COOKIE['les_member']));
	if($ck->id >0 && $ck->email!=''){
		$_SESSION['ss_mid'] = $ck->id;
		$_SESSION['ss_email'] = $ck->email;
		$_SESSION['ss_displayname'] = $ck->displayname;

//header("Location: profile1.php");
	}else{
//header("Location: profile2.php");	
	}
	
	
}

$sql = "select * from jie_member where id='".mysql_real_escape_string($_SESSION['ss_mid'])."' and email='".mysql_real_escape_string($_SESSION['ss_email'])."' ";
$result = mysql_query($sql);
$rs = mysql_fetch_assoc($result);

$auth_data = false;
	
	if(mysql_num_rows($result)>0 && $rs['id']===$_SESSION['ss_mid'] && $rs['email'] ===$_SESSION['ss_email']){
	
		$auth_data = array(
			"auth_id" =>$rs['id'],
			"auth_email" =>$rs['email'],
			"auth_displayname" =>$rs['displayname'],
			"auth_mode" =>$rs['mode'],
			"auth_point" =>$rs['point']
		);
	
	}



function setwgAuth($tpl, $data){
	
/*	$tpl->assignInclude( "INC_WGLOGIN", "../_inc_login.tpl" );
	$tpl->assignInclude( "INC_WGLOGIN2", "../html/_inc_login2.php" );
	$tpl->assignInclude( "INC_BASKET", "../html/_inc_basket.tpl" );*/
	if(isset($data) && is_array($data) && count($data)>0){
	
			$tpl->newBlock("LOGOUT");
			$tpl->assign("nickname",$_SESSION['ss_displayname']);
			
/*		$tpl->assignInclude( "INC_WGLOGIN", "../html/_inc_wgdetail.tpl" );
		$tpl->assignInclude( "INC_WGLOGIN2", "../html/_inc_wgdetail2.tpl" );*/
		/*$tpl->prepare();*/
		//$tpl->assign("_ROOT.CHECK_SIGNIN","<a href='register.php?action=logout'>Sign out</a>");
/*		foreach($data as $k=>$v){
			$tpl->assign('_ROOT.'.$k,$v);
		}
		
		$tpl->assign('_ROOT.profile_src_wg','../images/member.jpg');
		$file_p = '../upload/member/'.$data['auth_id'].'_profile_pic.jpg';
		if(is_file($file_p)) $tpl->assign('_ROOT.profile_src_wg',$file_p.'?'.time());
*/			
	}else{
		/*$tpl->prepare();*/
		//$tpl->assign("_ROOT.CHECK_SIGNIN","<a href='register.php'>Sign in</a>");	
		$tpl->newBlock("LOGIN");
	}
	
	
	
/*	$tpl->assign('_ROOT.num_cart',0);
	
	if(isset($_COOKIE['cc_cart']) && count($_COOKIE['cc_cart'])>0){
		$rs = unserialize(base64_decode($_COOKIE['cc_cart']));
		$tpl->assign('_ROOT.num_cart',count($rs));
	}*/
	
}


	

?>