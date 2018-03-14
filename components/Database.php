<?php

namespace components;

use PDO;

class Database
{
    /** @var PDO  */
    private $connection;

    /**
     * Database constructor.
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $db
     */
    public function __construct($host, $user, $password, $db)
    {
        $this->connection = new PDO("mysql:host={$host};dbname={$db}", $user, $password);
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}