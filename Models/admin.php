<?php
class AdminModel{
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

    public function getBookings($ID = null) {
        if ($ID === null) {
            $stmt = $this->pdo->query("SELECT * FROM booking");
        } else {
            $stmt = $this->pdo->prepare("SELECT * FROM booking WHERE ID = :ID");
            $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
        }
    
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function saveBooking($data) {
        $stmt = $this->pdo->prepare("INSERT INTO booking (room_ID, user_ID, startdate, enddate, type) 
                                     VALUES (:room_ID, :user_ID, :startdate, :enddate, :type)");
    
        $stmt->bindParam(':room_ID', $data['room_ID']);
        $stmt->bindParam(':user_ID', $data['user_ID']);
        $stmt->bindParam(':startdate', $data['startdate']);
        $stmt->bindParam(':enddate', $data['enddate']);
        $stmt->bindParam(':type', $data['type']);
    
        return $stmt->execute();
    }
    public function updateBooking($data) {
        $stmt = $this->pdo->prepare("UPDATE booking 
                                     SET room_ID = :room_ID, user_ID = :user_ID, startdate = :startdate, enddate = :enddate, type = :type 
                                     WHERE ID = :ID");
    
        $stmt->bindParam(':ID', $data['ID']);
        $stmt->bindParam(':room_ID', $data['room_ID']);
        $stmt->bindParam(':user_ID', $data['user_ID']);
        $stmt->bindParam(':startdate', $data['startdate']);
        $stmt->bindParam(':enddate', $data['enddate']);
        $stmt->bindParam(':type', $data['type']);
    
        return $stmt->execute();
    }
            
    public function deleteBooking($ID) {
        $stmt = $this->pdo->prepare("DELETE FROM booking WHERE ID = :ID");
        $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    



    
//#region Section RoomType
    public function saveRoomType($roomTypeData) { //lager array med variabler fra associativ array med felt til hotelDB, fra table
        $roomTypeName         = $roomTypeData["typename"];
        $descript             = $roomTypeData["descript"];
        $acapacity            = $roomTypeData["acapacity"];
        $ccapacity            = $roomTypeData["ccapacity"];
    

        $stmt = $this->pdo->prepare("INSERT INTO roomtype (typename, descript, acapacity, ccapacity)
        VALUES (:typename, :descript, :acapacity, :ccapacity)"); //lager insert statement $stmt so 
    
    //binder variabler fra $roomData til $stmt evkivalenten
        $stmt->bindParam(':typename', $roomTypeName);
        $stmt->bindParam(':descript', $descript);
        $stmt->bindParam(':acapacity', $acapacity);
        $stmt->bindParam(':ccapacity', $ccapacity);

    
        
        return $stmt->execute();
    }

    /* getter metode, returnerer alle rooms dersom param ikk er satt.*/
    public function getRooms($ID = null) {
        if ($ID === null) {
            $stmt = $this->pdo->query("SELECT * FROM rooms");
        } else {
            $stmt = $this->pdo->prepare("SELECT * FROM rooms WHERE ID = :ID");
            $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
        }
    
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function saveRoom($data) {
        $stmt = $this->pdo->prepare("INSERT INTO rooms (roomname, floor, roomtype_ID, closetoelevator) 
                                     VALUES (:roomname, :floor, :roomtype_ID, :closetoelevator)");
    
        $stmt->bindParam(':roomname', $data['roomname']);
        $stmt->bindParam(':floor', $data['floor']);
        $stmt->bindParam(':roomtype_ID', $data['roomtype_ID']);
        $stmt->bindParam(':closetoelevator', $data['closetoelevator']);
    
        return $stmt->execute();
    }
    public function updateRoom($data) {
        $stmt = $this->pdo->prepare("UPDATE rooms 
                                     SET roomname = :roomname, floor = :floor, roomtype_ID = :roomtype_ID, closetoelevator = :closetoelevator 
                                     WHERE ID = :ID");
    
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':roomname', $data['roomname']);
        $stmt->bindParam(':floor', $data['floor']);
        $stmt->bindParam(':roomtype_ID', $data['roomtype_ID']);
        $stmt->bindParam(':closetoelevator', $data['closetoelevator']);
    
        return $stmt->execute();
    }
    public function deleteRoom($id) {
        $stmt = $this->pdo->prepare("DELETE FROM rooms WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
                

    public function setRoomUnavailable($data) {
        $stmt = $this->pdo->prepare("INSERT INTO booking (room_ID, user_ID, startdate, enddate, type) 
                                     VALUES (:room_ID, :user_ID, :startdate, :enddate, :type)");
    
        // Bind parameters from the `$data` array to the query
        $stmt->bindParam(':room_ID', $data['room_ID'], PDO::PARAM_INT);
        $stmt->bindParam(':user_ID', $data['user_ID'], PDO::PARAM_INT);         $stmt->bindParam(':startdate', $data['startdate']);
        $stmt->bindParam(':enddate', $data['enddate']);
        $stmt->bindValue(':type', 2, PDO::PARAM_INT); // type 2 for utilgjengelig
    
        return $stmt->execute();
    }
    


    /* getter metode, returnerer alle roomtype dersom param ikk er satt.*/
    public function getRoomType($ID = null) {
        if ($ID === null) {
            // Fetch all room types
            $stmt = $this->pdo->query("SELECT * FROM roomtype");
        } else {
            // Fetch a specific room type by ID
            $stmt = $this->pdo->prepare("SELECT * FROM roomtype WHERE ID = :ID");
            $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(); // Returns an array of room types (or a single room type if you fetch by ID)
    }

    public function updateRoomType($data) {
        $stmt = $this->pdo->prepare("UPDATE roomtype SET typename = :typename, descript = :descript, acapacity = :acapacity, ccapacity = :ccapacity WHERE ID = :ID");
    
        $stmt->bindParam(':ID', $data['ID']);
        $stmt->bindParam(':typename', $data['typename']);
        $stmt->bindParam(':descript', $data['descript']);
        $stmt->bindParam(':acapacity', $data['acapacity']);
        $stmt->bindParam(':ccapacity', $data['ccapacity']);
    
        return $stmt->execute();
    }

    public function deleteRoomType($ID) {
        $stmt = $this->pdo->prepare("DELETE FROM roomtype WHERE ID = :ID");
        $stmt->bindParam(':ID', $ID);
        return $stmt->execute();
    }
//#endregion  
}
?>