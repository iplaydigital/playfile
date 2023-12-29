<?php
include('simplehtmldom_1_9_1/simple_html_dom.php');

$i = $_GET['s'];
$start="";
$smartcount = 0;
$bizcount   = 0;
$playcount  = 0;
$greenerycount=0;
$LISTSMART="";
$LISTGREENERY="";
$LISTBIZ ="";
$LISTPLAY="";

 
    $url = 'https://www.afterklass.com/post/detail/'.$i;
    $html = new simple_html_dom();
     $html->load_file($url);

     $data = file_get_contents($url);


     echo $data;