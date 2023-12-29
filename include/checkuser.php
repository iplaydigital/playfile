<?
	$res = mysql_query("select * from administrator where admin_id='".$_SESSION['UserId']."' and permission='".$_SESSION['permission']."'");
	if(mysql_num_rows($res)==0){
		?><script> alert("คุณไม่มีรายชื่ออยู่ในระบบนี้"); window.location="index.php?page=logout";</script><?
	}else{ 
		if($_SESSION['permission']!="777"){
		?><script> alert("คุณไม่มีสิทธิ์เข้าถึงข้อมูลในส่วนนี้"); window.location="index.php?page=logout";</script><?
		}
	}
?>