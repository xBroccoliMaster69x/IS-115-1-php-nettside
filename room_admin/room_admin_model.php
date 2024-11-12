<?php
class Model {
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


    public function saveRoom($roomData) {
        $roomNumber         = $roomData["roomNumber"];
        $floor              = $roomData["floor"];
        $roomType           = $roomData["roomType"];
        $aCapacity          = $roomData["aCapacity"];
        $cCapacity          = $roomData["cCapacity"];
        $closeToElevator    = $roomData["closeToElevator"];
    

        $stmt = $this->pdo->prepare("INSERT INTO rooms (roomNumber, floor, roomType, aCapacity, cCapacity, closeToElevator)
        VALUES (:roomNumber, :floor, :roomType, :aCapacity, :cCapacity, :closeToElevator)");
    

        $stmt->bindParam(':roomNumber', $roomNumber);
        $stmt->bindParam(':floor', $floor);
        $stmt->bindParam(':roomType', $roomType);
        $stmt->bindParam(':aCapacity', $aCapacity);
        $stmt->bindParam(':cCapacity', $cCapacity);
        $stmt->bindParam(':closeToElevator', $closeToElevator);
    
        
        return $stmt->execute();
    }
    
    
}
?>