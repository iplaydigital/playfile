<?php error_reporting(E_ALL ^ E_NOTICE);
/*****************************************************************
Created :20/01/2022
Author : worapot pilabut (pros.ake)
E-mail : worapot.bhi@gmail.com
# Check Package Change
 *****************************************************************/



// Login USERPASSWORD
if ($_SESSION['USERNAME']) {
	$active = 1;
} else if ($_SESSION['USERPASSWORD']) {
	$active = 2;
} else if ($_SESSION['LineID']) {
	$active = 1;
} else {
	header("Location: ../authentication/index.php");
	exit;
}

// Login LINE

/*
// Check Login
$query = "SELECT * FROM `$tableAdmin` WHERE `USERNAME`='{$_SESSION['USERNAME']}' && `PASSWORD`='{$_SESSION['PASSWORD']}'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
	header("Location: ../authentication/index.php");
	exit;
}
*/