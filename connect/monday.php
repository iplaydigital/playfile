<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
table {
    width: 100%;
}
</style>
<?php
$token = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjIzNzY5NDQyMCwidWlkIjozODkxNzU1MSwiaWFkIjoiMjAyMy0wMi0xNlQwNjo1NDowOS4wODFaIiwicGVyIjoibWU6d3JpdGUiLCJhY3RpZCI6MTUwMTIxNTUsInJnbiI6InVzZTEifQ.BAOQ1KXPUW3rdfwiBdZLmdBnMfTie1YUCUoHGOEkwPc';
$apiUrl = 'https://api.monday.com/v2';
$headers = ['Content-Type: application/json', 'Authorization: ' . $token];

$query = '{ boards { id name } }';
$data = @file_get_contents($apiUrl, false, stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => $headers,
        'content' => json_encode(['query' => $query]),
    ]
]));
$array = json_decode($data, true);
// echo json_encode($array['data']['boards']);
echo "<table bor> <thead> <tr> <th> id </th> <th> Name </th> </thead> <tbody>";
foreach ($array['data']['boards'] as $board) {
    echo "<tr> <td>" . $board['id'] . "</td> <td>" . $board['name'] . "</td> </tr>";
}
echo "</tbody> </table>";
