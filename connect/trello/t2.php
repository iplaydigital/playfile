<?php
require "./trello-api.php";
$key = 'ed0def94964aaa86975e462497b270db';
$token = 'ATTA4fbdcde14ba97cb2a5de2c7dd3f147cc7c7abfda5c4da6bf12846f9fe0fb5cdcA6946950';

$trello = new trello_api($key, $token);
$data = $trello->request('GET', ('member/me/boards'));

echo '<pre>';
print_r($data);
echo '</pre>';