<?php
use Drivers\Database;
use DTO\AllCategoryDTO;

class WordProcessing
{
    /**
     * @var Database
     */
    private $db;

    public function __construct(Database $db)
    {

        $this->db = $db;

    }
    /**
     * @return Generator
     */
    public function getAllCategory() : Generator
    {
        $query = "SELECT 
                  id, category_name
                  FROM 
                  categorys ";
        $stmt = $this->db->prepare($query);
        $stmt ->execute();

        while ($row = $stmt->fetchObject(AllCategoryDTO::class)) {
            yield $row;
        }
    }
    public function getWord(string $word) : string
    {
        $query = "SELECT word FROM words 
                  WHERE category_id = ?
                  ORDER BY RAND()
                  LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$word]);
        $row = $stmt->fetch();
        return $row['word'];

    }
}

