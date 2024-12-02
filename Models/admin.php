<?php
class adminModel{
    private $pdo;

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