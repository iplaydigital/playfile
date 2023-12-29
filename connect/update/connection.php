<?php

$db_host = "203.146.252.149";
$db_user = "fufudev_office";
$db_password = "mn@91rB6";
$db_name = "vpsoffice";

try {
    $db = new PDO("mysql:host={$db_host}; dbname={$db_name}", $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOEXCEPTION $e) {
    $e->getMessage();
}

$tb_hotlink = "tb_hotlink";
