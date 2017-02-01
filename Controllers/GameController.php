<?php
namespace Controllers;


class GameController
{
    private $statistics;
    private $userLifecycle;
    private $wordProcessing;
    private $username;
    private $data;
    private $user_id;
    private $category;
    private $waste;
    private $victory;
    private $userStatistics;
    private $statisticData;
    private $wordName;
    private $max;
    private $category_id;
    private $wordDescription;
    private $answerCount;
    private $alphas;
    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }
    /**
     * Game constructor.
     * @param Object $db
     * @param Object $userLifecycle
     * @param Object $wordProcessing
     * @param Object $statistics
     */
    public function __construct($userLifecycle, $wordProcessing, $statistics)
    {

        session_start();
        $this->setUserLifecycle($userLifecycle);
        $this->setStatistics($statistics);
        $this->setWordProcessing($wordProcessing);
        $this->setAlphas(range('A', 'Z'));


    }

    public function getUserInfo(){
        $this->setUsername($_SESSION['user']);

        // recording a user_id in session
        $this->data = $this->userLifecycle->getUserInfo($this->username);

        $_SESSION['user_id'] = intval($this->data->getId());
        $this->setUserId( $_SESSION['user_id']);

        //making all categories DB
        $this->setCategory($this->wordProcessing->getAllCategory());
        $this->waste = 0;
        $this->victory = 0;
        return $this->username;

    }
    /**
     * @return mixed
     */
    public function getStatistics()
    {
        $this->userStatistics = $this->statistics->getStatisticInfo($this->user_id);
        if (!empty($this->userStatistics)) {

            $this->victory = $this->userStatistics->getVictoryGame();
            $this->waste = $this->userStatistics->getWasteGame() ;

        } elseif (isset($this->statistics)) {
            $this->statisticData = [];
            $this->statisticData['victory_game'] = 0;
            $this->statisticData['waste_game'] = 0;
            $this->statisticData['user_id'] = $this->getUserId();
            $this->statistics->setStatisticInfo($this->statisticData);

        }


    }

    /**
     * @return mixed
     */
    public function getWord()
    {
        $this->wordName = null;
        $this->max = 6;
        if (isset($_POST['category'])) {
            #New game started

            #reset session
            $_SESSION['selected_letter'] = [];
            $_SESSION['answer'] = [];

            $this->setCategoryId(intval($_POST['category']));
            // making random word database
            $this->setWordName($this->wordProcessing->getWord($this->category_id));
            $this->setWordDescription($this->wordProcessing->getDescriptionWord($this->wordName));
            $_SESSION['wordDescription'] = $this->getWordDescription();
            $_SESSION['category'] = $this->getCategoryId();
            $_SESSION['wordLength'] = (strlen($this->getWordName()) - 2);
            $_SESSION['answer'] = str_split($this->getWordName());
            $_SESSION['successful_letter'] = [];
            $_SESSION['error'] = 0;
            $_SESSION['successful_letters_int'] = 0;
            $_SESSION['key'] = (strlen($this->getWordName()) - 1);

        }
        return $this->wordName;

    }

    /**
     * @return mixed
     */
    public function getWordName()
    {
        return $this->wordName;
    }

    /**
     * @return mixed
     */
    public function getWordDescription()
    {
        return $this->wordDescription;
    }


    public function play()
    {
        if (isset($_GET['letter']) && isset($_SESSION['selected_letter'])) {
            if (!in_array($_GET['letter'], $_SESSION['selected_letter'])) {

                if (!in_array($_GET['letter'], $_SESSION['selected_letter'])) {
                    $_SESSION['selected_letter'][] = $_GET['letter'];

                }
                $this->answerCount = array_count_values($_SESSION['answer']);

                if (in_array($_GET['letter'], $_SESSION['answer']) &&
                    ((current($_SESSION['answer']) != $_GET['letter'] || ($this->answerCount[$_GET['letter']] > 1 ))) &&
                    ((end($_SESSION['answer']) != $_GET['letter']) || ($this->answerCount[$_GET['letter']] > 1 ))) {

                    if((end($_SESSION['answer']) == $_GET['letter'] || current($_SESSION['answer']) == $_GET['letter']) && $this->answerCount[$_GET['letter']] > 1){
                        $_SESSION['successful_letters_int'] += ($this->answerCount[$_GET['letter']] - 1 );
                    }else {
                        $_SESSION['successful_letters_int'] += $this->answerCount[$_GET['letter']];
                    }
                } elseif (current($_SESSION['answer']) == $_GET['letter'] || (end($_SESSION['answer']) == $_GET['letter'])) {
                    $_SESSION['successful_letter'][] = $_GET['letter'];
                } else {
                    $_SESSION['error'] += 1;
                }
                if ($_SESSION['error'] >= $this->max) {
                    $_SESSION['answer'] = [];

                    $this->waste += 1;

                }

                if ($_SESSION['successful_letters_int'] === $_SESSION['wordLength']) {
                    $_SESSION['answer'] = [];
                    // echo 'CONGRATULATIONS YOU GUESSED IT!';
                    $this->victory += 1;

                }

                $this->statisticData = [];
                $this->statisticData['victory_game'] = $this->victory;
                $this->statisticData['waste_game'] = $this->waste;
                $this->statisticData['user_id'] = $_SESSION['user_id'];
                $this->statistics->updateStatistic($this->statisticData);

            }

        }
    }

    /**
     * @return mixed
     */
    public function getAnswerCount()
    {
        return $this->answerCount;
    }

    public function start()
    {
        if (isset($_SESSION['user'])) {
            $this->getUserInfo();
            $this->getStatistics();
            $this->getWord();
            $this->play();
        }else{
            header("Location: login.php?error=You have tried  to cheat");
            exit;
        }

    }
    public function getAlphas()
    {
        return $this->alphas;
    }
    public function getMax()
    {
        return $this->max;
    }
    public function getCategory()
    {
        return $this->category;
    }



    /**
     * @return mixed
     */
    public function getVictory()
    {
        return $this->victory;
    }

    /**
     * @return mixed
     */
    public function getWaste()
    {
        return $this->waste;
    }
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * @param Object $statistics
     */
    public function setStatistics( $statistics)
    {
        $this->statistics = $statistics;
    }

    /**
     * @param Object $userLifecycle
     */
    public function setUserLifecycle( $userLifecycle)
    {
        $this->userLifecycle = $userLifecycle;
    }

    /**
     * @param Object $wordProcessing
     */
    public function setWordProcessing($wordProcessing)
    {
        $this->wordProcessing = $wordProcessing;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @param mixed $waste
     */
    public function setWaste($waste)
    {
        $this->waste = $waste;
    }

    /**
     * @param mixed $victory
     */
    public function setVictory($victory)
    {
        $this->victory = $victory;
    }

    /**
     * @param mixed $userStatistics
     */
    public function setUserStatistics($userStatistics)
    {
        $this->userStatistics = $userStatistics;
    }

    /**
     * @param mixed $statisticData
     */
    public function setStatisticData($statisticData)
    {
        $this->statisticData = $statisticData;
    }

    /**
     * @param mixed $wordName
     */
    public function setWordName($wordName)
    {
        $this->wordName = $wordName;
    }

    /**
     * @param mixed $max
     */
    public function setMax($max)
    {
        $this->max = $max;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * @param mixed $wordDescription
     */
    public function setWordDescription($wordDescription)
    {
        $this->wordDescription = $wordDescription;
    }

    /**
     * @param mixed $answerCount
     */
    public function setAnswerCount($answerCount)
    {
        $this->answerCount = $answerCount;
    }

    /**
     * @param mixed $alphas
     */
    public function setAlphas($alphas)
    {
        $this->alphas = $alphas;
    }

    private function getUserId()
    {
        return $this->user_id;
    }
}