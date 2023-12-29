<?php

$bid = $_GET['bid']; // board id
$itid = $_GET['itid']; // item id
$cid = $_GET['cid']; // column id
$nval = $_GET['nval']; // new value

if($bid){





$token = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjIzNzY5NDQyMCwidWlkIjozODkxNzU1MSwiaWFkIjoiMjAyMy0wMi0xNlQwNjo1NDowOS4wODFaIiwicGVyIjoibWU6d3JpdGUiLCJhY3RpZCI6MTUwMTIxNTUsInJnbiI6InVzZTEifQ.BAOQ1KXPUW3rdfwiBdZLmdBnMfTie1YUCUoHGOEkwPc';
$apiUrl = 'https://api.monday.com/v2';
$headers = ['Content-Type: application/json', 'Authorization: ' . $token];


// New items

// Update Multiple Column values

// Update Single Column value
$query = 'mutation {
    change_simple_column_value (board_id: '.$bid.', item_id: '.$itid.', column_id: "'.$cid.'", value: "' . $nval .'") {
        id
    }
}';
///////////////////////////
$data = @file_get_contents($apiUrl, false, stream_context_create([
 'http' => [
 'method' => 'POST',
 'header' => $headers,
 'content' => json_encode(['query' => $query]),
 ]
]));


$responseContent = json_decode($data, true);

if($responseContent['errors']) {
 echo "Error: " . $responseContent['errors'][0]['message'];
} else {
 echo "200";
}

}else{

    header("HTTP/1.0 404 Not Found");
    echo "<meta http-equiv='refresh' content='3;url=https://connect.playdigital.co.th/'>";
    echo "<center style='margin-top:25%;font-size:50px;'><strong>ไม่อนุญาติให้ใช้ระบบจะทำการเปลี่ยนหน้าไปส่วนกลางภายใน 2 วินาที</strong></center> ";
    
}
?>