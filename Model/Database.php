<?php

namespace Model;

class Database
{
    // connection to the database
    private $host = "localhost";
    private $db_name = "aesthetinkmvc";
    private $username = "root";
    private $password = "";
    private $connetion = null;

    // getter for connection
    public function bddConnect()
    {
        try {
            $pdo = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $this->connetion = $pdo;

        } catch (\PDOException $exception) {
            echo "Connecting error : " . $exception->getMessage();
        }

        return $this->connetion;
    }
}