<?php
namespace Drivers;

class Database
{
    /**
     * @var \PDO[]
     */

    private static $instances = [];
    private $pdo;

    public function __construct($host, $user, $pass, $dbName)
    {
        $this->pdo = new \PDO("mysql:host=$host;dbname=$dbName", $user, $pass);
    }

    public function prepare($statement)
    {
        return new DatabaseStatement($this->pdo->prepare($statement));
    }

    public static function setInstance($host, $user, $pass, $dbName, $instanceName)
    {
        self::$instances[$instanceName] = new Database($host, $user, $pass, $dbName);
    }

    public static function getInstance($instanceName)
    {
        return self::$instances[$instanceName];
    }

}