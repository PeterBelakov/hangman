<?php
session_start();
include 'application.php';

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];

    $data = $userLifecycle->getUserInfo($username);
    $category = $wordProcessing->getAllCategory();
    $wordName = null;
    $max = 5;

    if (isset($_POST['category'])) {
        #New game started

        #reset session
        $_SESSION['selected_letter'] = [];
        $_SESSION['answer'] = [];

        $category_id = intval($_POST['category']);
        $wordName = $wordProcessing->getWord($category_id);
        $_SESSION['category'] = $category_id;
        $_SESSION['wordLength'] = strlen($wordName);
        $_SESSION['answer'] = str_split($wordName);
        $_SESSION['successful_letter'] = [];
        $_SESSION['error'] = 0;
        $_SESSION['successful_letters_int'] = 0;
    }
    if (isset($_GET['letter']) && isset($_SESSION['selected_letter'])) {

        if (!in_array($_GET['letter'], $_SESSION['selected_letter'])) {
            $_SESSION['selected_letter'][] = $_GET['letter'];
        }
        if (in_array($_GET['letter'], $_SESSION['answer'])) {
            $_SESSION['successful_letter'][] = $_GET['letter'];
            $_SESSION['successful_letters_int'] += 1;
        } else {
            $_SESSION['error'] += 1;
        }
        if ($_SESSION['error'] >= $max) {
            $_SESSION['answer'] = [];
            echo 'SORRY, YOU ARE HANGED!';
        }
        if ($_SESSION['successful_letter'] == ($_SESSION['wordLength'] -2)) {
            echo 'CONGRATULATIONS YOU GUESSED IT!';
        }
    }

    var_dump($_SESSION['successful_letters_int']);
    var_dump($_SESSION['answer']);
    if (!empty($_SESSION['wordLength'])) {
        $_SESSION['hiddenWord'] = array_fill(0, $_SESSION['wordLength'], '_');


        foreach ($_SESSION['answer'] as $value) {
            if ($value == reset($_SESSION['answer'])) {
                echo reset($_SESSION['answer']);
            } elseif ($value == end($_SESSION['answer'])) {
                echo end($_SESSION['answer']);
            } elseif (in_array($value, $_SESSION['selected_letter'], TRUE)) {
                echo $value;
            } else {
                echo $value = ' _';
            }
        }
    } else {
        echo 'Choose category!';
    }
    $alphas = range('A', 'Z');

    include 'profile_frontend.php';
} else {
    header("Location: login.php?error=You have tried  to cheat");
    exit;
}
?>

