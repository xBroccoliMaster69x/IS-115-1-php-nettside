<?php
require_once '../Core/database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }
    
    public function createUser($fornavn, $etternavn, $mobilnummer, $email, $adresse, $brukernavn, $passord) {
        
    try { $sql = "INSERT INTO users (fornavn, etternavn, mobilnummer, email, adresse, brukernavn, passord) 
                VALUES (:fornavn, :etternavn, :mobilnummer, :email, :adresse, :brukernavn, :passord)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':fornavn', $fornavn);
        $stmt->bindValue(':etternavn', $etternavn);
        $stmt->bindValue(':mobilnummer', $mobilnummer);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':adresse', $adresse);
        $stmt->bindValue(':brukernavn', $brukernavn);
        $stmt->bindValue(':passord', $passord); // bruker allerede hashed passord fra vontroller

       return $stmt->execute();
     } catch (PDOException $e) {
        // Logger error (må sette opp en err.log fil?)
        error_log("feil i laging av bruker: " . $e->getMessage(), 3, '/path/to/error.log');
        return false;
        }
    }

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM users WHERE brukernavn = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetches the entire user row as an associative array
        if (!$stmt->execute()) {
            die("forrespøring feil: " . implode(", ", $stmt->errorInfo()));
        }
    } 
}
