<?php error_reporting (E_ALL ^ E_NOTICE);
/*****************************************************************
Created		: 15/06/2020
Author		: JIE'software 
E-mail		: worapot@yahoo.com
server		: www.vpslive.com
PHP Version : 5.6
Copyright (C) 2010-2020, JIE'software under Bemine.life , all rights reserved.
*****************************************************************/

include_once("../include/config.inc.php");

//ยอดส่งของวันที่ 26 สิงหาคม 2564 ทั้งหมด
$tb1 = 'tb_mail_new26';
$folder='26082564';

if($_GET['d']==1){
    $sql0 = "SELECT * FROM `".$tb1."`";
    $query0 = $conn->query($sql0) or die($conn->error);
    $total = $query0->num_rows;
    $total = number_format($total);
    echo $total;

}
if($_GET['d']==2){
    $sql3 = "SELECT * FROM `".$tb1."` WHERE status=1"; // ส่งแล้ว
    $query3 = $conn->query($sql3) or die($conn->error);
    $total3 = $query3->num_rows;
    $totalsend = number_format($total3);
    //------------------------------
    echo $totatsend;
?>