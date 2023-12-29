<?php 

    $db_host = "203.146.252.149";
    $db_user = "thaied_txmail";
    $db_password = "u6Qv6y!8";
    $db_name = "thaied_txmail";

    try {
        $db = new PDO("mysql:host={$db_host}; dbname={$db_name}", $db_user, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOEXCEPTION $e) {
        $e->getMessage();
    }


?>