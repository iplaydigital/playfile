<?php

//require "./trello-api.php";
//$key = 'ed0def94964aaa86975e462497b270db';
//$token = '463faebb20d8b28c04ff9591da6afff2e704c56f723b97cafedcfae967d4559d';
//$url = 'https://api.trello.com/1/lists/{id}?key=APIKey&token=APIToken';










$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.trello.com/1/members/me/boards?key=ed0def94964aaa86975e462497b270db&token=ATTA4fbdcde14ba97cb2a5de2c7dd3f147cc7c7abfda5c4da6bf12846f9fe0fb5cdcA6946950');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}else{
    echo 'welcome';
    $data = curl_exec($c);
    echo curl_error($c);
    curl_close($c);

    return json_decode($data);
}
curl_close($ch);