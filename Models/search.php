<?php
class SearchModel {
    private $pdo;

    public function __construct() {
        $host = 'localhost';
        $db = 'hoteldb';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getAvailableRooms($startDate, $endDate, $closeToElevator = false, $acapacity = null, $ccapacity = null) {
        $query = "
            SELECT r.ID, r.roomname, r.floor, r.closetoelevator, rt.typename, rt.descript
            FROM rooms r
            LEFT JOIN booking b ON r.ID = b.room_ID 
                AND (
                    (b.startdate <= :endDate AND b.enddate >= :startDate) -- Overlapping booking
                )
            LEFT JOIN roomtype rt ON r.roomtype_ID = rt.ID
            WHERE b.ID IS NULL
        ";
    
        if ($closeToElevator) {
            $query .= " AND r.closetoelevator = 1";
        }
        if ($acapacity !== null) {
            $query .= " AND rt.acapacity >= :acapacity";
        }
        if ($ccapacity !== null) {
            $query .= " AND rt.ccapacity >= :ccapacity";
        }
    
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':startDate', $startDate);
            $stmt->bindValue(':endDate', $endDate);
    
            if ($acapacity !== null) {
                $stmt->bindValue(':acapacity', $acapacity, PDO::PARAM_INT);
            }
            if ($ccapacity !== null) {
                $stmt->bindValue(':ccapacity', $ccapacity, PDO::PARAM_INT);
            }
    
            $stmt->execute();
    
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            throw new \PDOException("Error fetching available rooms: " . $e->getMessage(), (int)$e->getCode());
        }
    }
    
    
    
    
    
}
