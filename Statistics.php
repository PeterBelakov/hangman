<?php

use Drivers\Database;
use DTO\AllStatisticsDTO;

class Statistics
{
    /**
     * @var Database
     */
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function updateStatistic(array $statisticData)
    {
        $query = "UPDATE statistics SET victory_game = ?, waste_game = ? WHERE user_id = ?";
        $preparedArgs = [$statisticData['victory_game'], $statisticData['waste_game'], $statisticData['user_id']];
               $stmt = $this->db->prepare($query);
        return $stmt->execute($preparedArgs);
    }

    public function setStatisticInfo(array $statisticData)
    {
        $victory_game = $statisticData['victory_game'];
        $waste_game = $statisticData['waste_game'];
        $user_id = $statisticData['user_id'];
        $query = "INSERT INTO statistics (victory_game, waste_game, user_id) VALUES (?, ?, ?);";
        $statisticArgs = [$victory_game, $waste_game, $user_id];
        $stmt = $this->db->prepare($query);
        $stmt->execute($statisticArgs);
        return $stmt;
    }

    public function getStatisticInfo(int $user_id)
    {
        $query = "SELECT victory_game, waste_game FROM statistics WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$user_id]);
        $row = $stmt->fetchObject(\DTO\AllStatisticsDTO::class);
        return $row;
    }
}