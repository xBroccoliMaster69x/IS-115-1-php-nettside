<?php
require_once ('../Core/database.php');
class searchModel {
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

    public function getAvailableRooms($startDate, $endDate) {
        $query = "
            SELECT r.*
            FROM rooms r
            LEFT JOIN booking b ON r.ID = b.room_ID 
                AND (
                    (b.startdate <= :endDate AND b.enddate >= :startDate) -- Overlapping booking
                )
            WHERE b.ID IS NULL
        ";

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':startDate' => $startDate,
                ':endDate' => $endDate
            ]);

            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            throw new \PDOException("Error fetching available rooms: " . $e->getMessage(), (int)$e->getCode());
        }
    }
}

$startDate = '2024-12-10';
$endDate = '2025-12-15';
$a = new searchModel();
$availableRooms = $a->getAvailableRooms($startDate, $endDate);
foreach ($availableRooms as $room) {
    echo "Room ID: " . $room['ID'] . ", Name: " . $room['roomname'] . ", Floor: " . $room['floor'] . "\n";
}
?>