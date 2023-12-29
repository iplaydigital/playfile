<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
table {
    width: 100%;
}
</style>



<a href='index.php'>Home</a>
<?php
$token = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjIzNzY5NDQyMCwidWlkIjozODkxNzU1MSwiaWFkIjoiMjAyMy0wMi0xNlQwNjo1NDowOS4wODFaIiwicGVyIjoibWU6d3JpdGUiLCJhY3RpZCI6MTUwMTIxNTUsInJnbiI6InVzZTEifQ.BAOQ1KXPUW3rdfwiBdZLmdBnMfTie1YUCUoHGOEkwPc';
$apiUrl = 'https://api.monday.com/v2';
$headers = ['Content-Type: application/json', 'Authorization: ' . $token];


$query = '{ users { id name } }';
$data = @file_get_contents($apiUrl, false, stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => $headers,
        'content' => json_encode(['query' => $query]),
    ]
]));
$array = json_decode($data, true);
// echo json_encode($array['data']['boards']);
echo "<table><thead> <tr> <th>  </th><th> id </th>  <th> Name </th> </thead> <tbody>";
$no=0;
foreach ($array['data']['users'] as $users) {
    $no++;
    echo "<tr> <td>". $no . "</td> <td>" . $users['id'] . "</td>  <td>" . $users['name'] . "</td><td></td> </tr>";
}
echo "</tbody> </table>";
