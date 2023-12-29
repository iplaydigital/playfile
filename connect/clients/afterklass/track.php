<?php
// กำหนด URL ของเว็บไซต์
$url = 'https://www.afterklass.com/post/detail/7022';

// ใช้ cURL ในการดึง HTML
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$html = curl_exec($ch);
curl_close($ch);


echo $html;


// ใช้ simple_html_dom ในการแยกแยะ tag h1
require_once('simplehtmldom_1_9_1/simple_html_dom.php');
$dom = new simple_html_dom();
$dom->load($html);
foreach($dom->find('h1') as $h1) {
    echo $h1->plaintext;
}
?>
