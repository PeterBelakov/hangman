<?php

/* Let's game begin */
include 'application.php';
$game = new \Controllers\GameController( $userLifecycle, $wordProcessing, $statistics );
$game->start();
include 'assets/views/profile_frontend.php';
