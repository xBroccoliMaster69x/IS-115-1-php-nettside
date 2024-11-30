<?php
class adminModel{
    private $pdo;

    public function __construct() { //constructor for adminModel, etablerer kontakt med hoteldb som rotbruker

        $host = 'localhost';
        $db = 'hoteldb';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //thrower error ved error
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //returnerer data fra db som associated array.
            PDO::ATTR_EMULATE_PREPARES   => false,              // setter emulator til false
        ];

        try { //tester db tilkobling
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getRoom() { //returnerer assosciated array som inneholder rom fra rooms db
        $sql = "SELECT roomNumber, floor, roomType, aCapacity, cCapacity, closeToElevator FROM rooms";
        try{
        $stmt = $this->pdo->query($sql);

        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($rooms)) {
            foreach ($rooms as $room) {
                echo "Room Number: " . $room['roomNumber'] . "<br>";
                echo "Floor: " . $room['floor'] . "<br>";
                echo "Room Type: " . $room['roomType'] . "<br>";
                echo "Adult Capacity: " . $room['aCapacity'] . "<br>";
                echo "Child Capacity: " . $room['cCapacity'] . "<br>";
                echo "Close to Elevator: " . ($room['closeToElevator'] ? 'Yes' : 'No') . "<br><br>";
            }
        } else {
            echo "No rooms found in the database.";
        }
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }
    return $rooms;
    }





    




















}
$adminModel = new adminModel();
$adminModel->getRoom();


?>