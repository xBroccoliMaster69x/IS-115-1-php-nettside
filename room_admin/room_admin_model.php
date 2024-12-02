<?php
class Model {
    private $pdo;

    public function __construct() { //constructor for adminModel, etablerer kontakt med hoteldb som rotbruker

        $host = 'localhost';
        $db = 'hoteldb';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset"; //lagrer data source name som paramenter
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //thrower error ved error
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //returnerer data fra db som associated array.
            PDO::ATTR_EMULATE_PREPARES   => false,              // setter emulator til false
        ];

        try { //tester db tilkobling
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) { //lagrer objektet av PDOException som $e
            throw new \PDOException($e->getMessage(), (int)$e->getCode()); //returnerer feilmeld og feilkode fra $e()PDOException objektet
        }
    }


    public function saveRoom($roomData) { //lager array med variabler fra associativ array med felt til hotelDB, fra table
        $roomNumber         = $roomData["roomNumber"];
        $floor              = $roomData["floor"];
        $roomType           = $roomData["roomType"];
        $aCapacity          = $roomData["aCapacity"];
        $cCapacity          = $roomData["cCapacity"];
        $closeToElevator    = $roomData["closeToElevator"];
    

        $stmt = $this->pdo->prepare("INSERT INTO rooms (roomNumber, floor, roomType, aCapacity, cCapacity, closeToElevator)
        VALUES (:roomNumber, :floor, :roomType, :aCapacity, :cCapacity, :closeToElevator)"); //lager insert statement $stmt so 
    
//binder variabler fra $roomData til $stmt evkivalenten
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