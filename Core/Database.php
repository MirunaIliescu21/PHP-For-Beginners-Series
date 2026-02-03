<?php

namespace Core;
use PDO;

class Database {
    public $connection;
    public $statement;

    public function __construct($config, $username, $pass) {

        /* http_build_query($config, '', ';');  genereaza dsn ul notru cu ; intre campuri: host=localhost;port=3306;dbname=myapp;charset=utf8mb4**/

        // dsn = data source name
        $dsn = "mysql:" . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $pass, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params) {

        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        // return $statement; // PDOStatement object
        return $this; // instead of returning the statement, return the Database object itself
    }

    public function find() {
        return $this->statement->fetch();
    }

    /** Method to find a record or fail */
    public function findOrFail() {
        $result = $this->find(); // in our case fetch the note of the query

        if (! $result) {
            abort();
        }

        return $result;
    }

    /** Method to get all records (fetchAll) */
    public function get() {
        return $this->statement->fetchAll();
    }
}