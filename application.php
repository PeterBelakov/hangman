<?php
 require_once "autoload.php";
Drivers\Database::setInstance("Localhost", "root", "", "hangman", "ROOT_ACCESS");

$db = Drivers\Database::getInstance("ROOT_ACCESS");
$userLifecycle = new UserLifecycle($db);
$wordProcessing = new WordProcessing($db);
$statistics = new Statistics($db);