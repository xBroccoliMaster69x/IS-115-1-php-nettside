<?php

class Database {
    private $host = "localhost:3306"; 
    private $dbName = "hoteldb"; 
    private $username = "root"; 
    private $password = ""; 
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password); //lager ny PDO objekt, kobler til databsen gjennom variablene
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //debug
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //slår av prepared statements for å bruke true prepared statements av db for sikkerhet

        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function prepare($sql) { //forbereder sql spørringer gjennom placeholders
        return $this->pdo->prepare($sql);
    }

    public function lastInsertId() { //henter ID av siste satt inn rad, for bruk når man jobber med auto-incremented PK
        return $this->pdo->lastInsertId();
    }
}
?>