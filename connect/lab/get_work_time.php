<?php
// เชื่อมต่อกับฐานข้อมูล MySQL
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "my_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// ดึงข้อมูลเวลาเริ่มต้นและเวลาสิ้นสุดของงานที่ต้องการนับเวลาจากฐานข้อมูล
$sql = "SELECT start_time, end_time FROM work_time ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $start_time = $row["start_time"];
  $end_time = $row["end_time"];
  echo "$start_time|$end_time";
} else {
  echo "0 results";
}

$conn->close();
?>
?>