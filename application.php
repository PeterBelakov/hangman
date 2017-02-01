<?php
require_once "autoload.php";
require_once "config.php";
Drivers\Database::setInstance($database['host'], $database['username'], $database['password'], $database['dbName'], $database['access']);

$db = Drivers\Database::getInstance("ROOT_ACCESS");
$userLifecycle = new UserLifecycle($db);
$wordProcessing = new WordProcessing($db);
$statistics = new Statistics($db);