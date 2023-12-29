<?php
$token = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjIzNzY5NDQyMCwidWlkIjozODkxNzU1MSwiaWFkIjoiMjAyMy0wMi0xNlQwNjo1NDowOS4wODFaIiwicGVyIjoibWU6d3JpdGUiLCJhY3RpZCI6MTUwMTIxNTUsInJnbiI6InVzZTEifQ.BAOQ1KXPUW3rdfwiBdZLmdBnMfTie1YUCUoHGOEkwPc';
$apiUrl = 'https://api.monday.com/v2';
$headers = ['Content-Type: application/json', 'Authorization: ' . $token];

//$query = '{ boards { id name } }';


$query = '{
    boards (ids: 3891260629) {
        owners {
            id
        }
        columns {
            title
            type
        }       
    }
}';





$data = @file_get_contents($apiUrl, false, stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => $headers,
        'content' => json_encode(['query' => $query]),
    ]
]));
$array1 = json_decode($data, true);

$jsonString = json_encode($array1['data']['boards']);
//$jsonString = '[{"owners":[],"columns":[{"title":"Name","type":"name"},{"title":"Subitems","type":"subtasks"},{"title":"Item ID","type":"pulse-id"},{"title":"Owner","type":"multiple-person"},{"title":"Teams","type":"multiple-person"},{"title":"Status","type":"color"},{"title":"Start Date","type":"date"},{"title":"monday Doc","type":"doc"},{"title":"Timeline","type":"timerange"},{"title":"Work Hours","type":"numeric"},{"title":"Link","type":"link"}]}]';
$array = json_decode($jsonString, true);

// Access the "owners" property
$owners = $array[0]['owners'];

// Access the "columns" property
$columns = $array[0]['columns'];

// Access the title of the first column
$firstColumnTitle = $columns[0]['title'];

$i=0;
foreach ($columns as $column) {
    
echo $columns[$i]['title']."<br>"; // Output: "Name"
$i++;

}

?>















