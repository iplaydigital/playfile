<?php
$token = '0b41f35ef91ef0f611abd834287bcf1a';
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
$responseContent = json_decode($data, true);

echo json_encode($responseContent);
?>