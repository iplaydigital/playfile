<?php error_reporting(E_ALL ^ E_NOTICE);
/*****************************************************************
Created :28/02/2565
Author : worapot pilabut (aj.ake)
E-mail : worapot.playdigital@gmail.com
Website : https://conenct.playdigital.co.th
Copyright (C) 2023, Play digital Co.,Ltd. all rights reserved.
 *****************************************************************/

 
require "./trello-api.php";
$key = 'ed0def94964aaa86975e462497b270db';
$token = 'ATTA4fbdcde14ba97cb2a5de2c7dd3f147cc7c7abfda5c4da6bf12846f9fe0fb5cdcA6946950';

$trello = new trello_api($key, $token);
$data = $trello->request('GET', ('member/me/boards'));

echo '<pre>';
print_r($data);
echo '</pre>';