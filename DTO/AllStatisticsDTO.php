<?php
namespace DTO;
class AllStatisticsDTO
{
    private $victory_game;
    private $waste_game;
    private $user_id;

    /**
     * @param mixed $victory_game
     */
    public function setVictoryGame($victory_game)
    {
        $this->victory_game = $victory_game;
    }

    /**
     * @param mixed $waste_game
     */
    public function setWasteGame($waste_game)
    {
        $this->waste_game = $waste_game;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getVictoryGame()
    {
        return $this->victory_game;
    }

    /**
     * @return mixed
     */
    public function getWasteGame()
    {
        return $this->waste_game;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }


}