<?php

require "vendor/autoload.php";

use Notion\Notion;

$token = "secret_NvfpcAHzRjbYeWy5Ie6770zuiSeLv9lwgt4PSeOV3Me";
$notion = Notion::create($token);

$users = $notion->users()->findAll();

foreach ($users as $user) {
    echo $user->name . PHP_EOL;
}