<?php
/**
 * @var $userStatistics \DTO\AllStatisticsDTO
 */
session_start();
include 'application.php';


if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
    // recording a user_id in session
    $data = $userLifecycle->getUserInfo($username);

    $_SESSION['user_id'] = intval($data->getId());
    $user_id = $_SESSION['user_id'];

    //making all categories DB
    $category = $wordProcessing->getAllCategory();
    $waste = 0;
    $victory = 0;

    //making statistic user DB
    if ($userStatistics = $statistics->getStatisticInfo($user_id)) {

        $userStatistics = $statistics->getStatisticInfo($user_id);
        $victory = $userStatistics->getVictoryGame() . PHP_EOL;
        $waste = $userStatistics->getWasteGame() . PHP_EOL;
    } elseif (isset($userStatistics)) {
        $statisticData = [];
        $statisticData['victory_game'] = 0;
        $statisticData['waste_game'] = 0;
        $statisticData['user_id'] = $_SESSION['user_id'];
        $statistics->setStatisticInfo($statisticData);

    }

    $wordName = null;
    $max = 6;
    if (isset($_POST['category'])) {
        #New game started

        #reset session
        $_SESSION['selected_letter'] = [];
        $_SESSION['answer'] = [];

        $category_id = intval($_POST['category']);
        // making random word database
        $wordName = $wordProcessing->getWord($category_id);
        $wordDescription = $wordProcessing->getDescriptionWord($wordName);
        $_SESSION['wordDescription'] = $wordDescription;
        $_SESSION['category'] = $category_id;
        $_SESSION['wordLength'] = (strlen($wordName) - 2);
        $_SESSION['answer'] = str_split($wordName);
        $_SESSION['successful_letter'] = [];
        $_SESSION['error'] = 0;
        $_SESSION['successful_letters_int'] = 0;
        $_SESSION['key'] = (strlen($wordName) - 1);
    }

    //
    if (isset($_GET['letter']) && isset($_SESSION['selected_letter'])) {
        if (!in_array($_GET['letter'], $_SESSION['selected_letter'])) {

            if (!in_array($_GET['letter'], $_SESSION['selected_letter'])) {
                $_SESSION['selected_letter'][] = $_GET['letter'];

            }

            if (in_array($_GET['letter'], $_SESSION['answer']) && (current($_SESSION['answer']) != $_GET['letter']) && (end($_SESSION['answer']) || ($answerCount[$_GET['letter']] > 1 ) != $_GET['letter'])) {
               // if(end($_SESSION['answer'] == )
                $answerCount = array_count_values($_SESSION['answer']);
                $answerCount[$_GET['letter']];
                if((end($_SESSION['answer']) == $_GET['letter'] || current($_SESSION['answer']) == $_GET['letter']) && $answerCount[$_GET['letter']] > 1){
                    $_SESSION['successful_letters_int'] += ($answerCount[$_GET['letter']] - 1 );
                }else {
                $_SESSION['successful_letters_int'] += $answerCount[$_GET['letter']];
                }
            } elseif (current($_SESSION['answer']) == $_GET['letter'] || (end($_SESSION['answer']) == $_GET['letter'])) {
                $_SESSION['successful_letter'][] = $_GET['letter'];
            } else {
                $_SESSION['error'] += 1;
            }
            if ($_SESSION['error'] >= $max) {
                $_SESSION['answer'] = [];

                $waste += 1;

            }

            if ($_SESSION['successful_letters_int'] === $_SESSION['wordLength']) {
                $_SESSION['answer'] = [];
               // echo 'CONGRATULATIONS YOU GUESSED IT!';
                $victory += 1;

            }

            $statisticData = [];
            $statisticData['victory_game'] = $victory;
            $statisticData['waste_game'] = $waste;
            $statisticData['user_id'] = $_SESSION['user_id'];
            $statistics->updateStatistic($statisticData);

}
 
}
$alphas = range('A', 'Z');

include 'profile_frontend.php';
} else {
header("Location: login.php?error=You have tried  to cheat");
exit;
}
?>