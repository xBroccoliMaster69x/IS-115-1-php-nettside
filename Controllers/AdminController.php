<?php
require_once("..//Models/admin.php");

class AdminController extends Controller {
    private $AdminModel;

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->handleRequest();
        } else {        
        $this->AdminModel = new AdminModel();
        $data = ['title' => 'Admin Page'];
        $this->view('admin', $data);  
        }
    }
     public function handleRequest() {
        $this->AdminModel = new AdminModel();

        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            switch ($action) {
                case 'action1': // dette er "Se bookinger" knapp
                    // Show bookings
                    $this->showBookings();
                    break;
                
                case 'action2': // dette er "Se rom" knapp
                    // Show rooms
                    $this->showRooms();
                    break;

                case 'action3': // dette er "Se Romtyper" knapp
                    $this->showRoomTypes();
                    break;

                default:
                    echo "Invalid action!";
            }
        }
    }

    public function showBookings($ID = null) {
        $this->AdminModel = new AdminModel(); // Initialize the AdminModel
    
        $bookings = $this->AdminModel->getBookings($ID);
    
        echo "<h2>Bookings</h2>";
    
        if (!empty($bookings)) {
            foreach ($bookings as $booking) {
                echo "<div>";
                echo "<p>Room ID: {$booking['room_ID']}</p>";
                echo "<p>User ID: {$booking['user_ID']}</p>";
                echo "<p>Start Date: {$booking['startdate']}</p>";
                echo "<p>End Date: {$booking['enddate']}</p>";
                echo "<p>Type: {$booking['type']}</p>";
    
                // Edit and Delete buttons
                echo '<a href="index.php?url=admin/editBooking/' . $booking['ID'] . '" class="edit-button">Edit</a> ';
                echo '<a href="index.php?url=admin/deleteBooking/' . $booking['ID'] . '" class="delete-button" onclick="return confirm(\'Are you sure you want to delete this booking?\')">Delete</a>';
                echo "<hr>";
                echo "</div>";
            }
        } else {
            echo "No bookings found.";
        }
    
        // Add New Booking button
        echo '<br><a href="index.php?url=admin/addBooking" class="add-button">Add New Booking</a>';
    
    }
    
    public function addBooking() {
        echo '<h2>Add New Booking</h2>';
        echo '
            <form action="index.php?url=admin/saveBooking" method="POST">
                <label for="room_ID">Room ID:</label><br>
                <input type="number" id="room_ID" name="room_ID" required><br><br>
    
                <label for="user_ID">User ID:</label><br>
                <input type="number" id="user_ID" name="user_ID" required><br><br>
    
                <label for="startdate">Start Date:</label><br>
                <input type="date" id="startdate" name="startdate" required><br><br>
    
                <label for="enddate">End Date:</label><br>
                <input type="date" id="enddate" name="enddate" required><br><br>
    
                <label for="type">Type:</label><br>
                <input type="text" id="type" name="type" required><br><br>
    
                <button type="submit">Save Booking</button>
            </form>
        ';
    }

    public function saveBooking() {
        $this->AdminModel = new AdminModel(); // Initialize the AdminModel
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'room_ID' => $_POST['room_ID'],
                'user_ID' => $_POST['user_ID'],
                'startdate' => $_POST['startdate'],
                'enddate' => $_POST['enddate'],
                'type' => $_POST['type']
            ];
    
            if ($this->AdminModel->saveBooking($data)) {
                echo 'Booking added successfully!';
            } else {
                echo 'Failed to add booking.';
            }
        }
    
        echo '<br><a href="index.php?url=admin/displayBookings">Back to Bookings</a>';
    }
        
    public function editBooking($ID) {
        $this->AdminModel = new AdminModel(); // Initialize the AdminModel
    
        $booking = $this->AdminModel->getBookings($ID)[0]; // Fetch booking by ID
    
        if ($booking) {
            echo '<h2>Edit Booking</h2>';
            echo '
                <form action="index.php?url=admin/updateBooking" method="POST">
                    <input type="hidden" name="ID" value="' . $booking['ID'] . '">
    
                    <label for="room_ID">Room ID:</label><br>
                    <input type="number" id="room_ID" name="room_ID" value="' . $booking['room_ID'] . '" required><br><br>
    
                    <label for="user_ID">User ID:</label><br>
                    <input type="number" id="user_ID" name="user_ID" value="' . $booking['user_ID'] . '" required><br><br>
    
                    <label for="startdate">Start Date:</label><br>
                    <input type="date" id="startdate" name="startdate" value="' . $booking['startdate'] . '" required><br><br>
    
                    <label for="enddate">End Date:</label><br>
                    <input type="date" id="enddate" name="enddate" value="' . $booking['enddate'] . '" required><br><br>
    
                    <label for="type">Type:</label><br>
                    <input type="text" id="type" name="type" value="' . $booking['type'] . '" required><br><br>
    
                    <button type="submit">Update Booking</button>
                </form>
            ';
        } else {
            echo "Booking not found.";
        }

    }
    
    public function updateBooking() {
        $this->AdminModel = new AdminModel(); // Initialize the AdminModel
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ID' => $_POST['ID'],
                'room_ID' => $_POST['room_ID'],
                'user_ID' => $_POST['user_ID'],
                'startdate' => $_POST['startdate'],
                'enddate' => $_POST['enddate'],
                'type' => $_POST['type']
            ];
    
            if ($this->AdminModel->updateBooking($data)) {
                echo 'Booking updated successfully!';
            } else {
                echo 'Failed to update booking.';
            }
        }
    
        echo '<br><a href="index.php?url=admin/displayBookings">Back to Bookings</a>';
    }
    
    public function deleteBooking($ID) {
        $this->AdminModel = new AdminModel(); // Initialize the AdminModel
    
        if ($this->AdminModel->deleteBooking($ID)) {
            echo 'Booking deleted successfully!';
        } else {
            echo 'Failed to delete booking.';
        }
    
        echo '<br><a href="index.php?url=admin/displayBookings">Back to Bookings</a>';
    }

    
//# Rooms -------------------------------------------------------------------------------------------------------
    public function showRooms($ID = null) {
    $rooms = $this->AdminModel->getRooms($ID);
    
        echo "<h2>Rooms</h2>";
    
        if (!empty($rooms)) {
            foreach ($rooms as $room) {
                echo "<div>";
                echo "<p>Name: {$room['roomname']}</p>";
                echo "<p>Floor: {$room['floor']}</p>";
                echo "<p>Rom type: {$room['roomtype_ID']}</p>";
                echo "<p>Nærme Heis? " . ($room['closetoelevator'] ? 'Ja' : 'Nei') . "</p>";
    
                // Edit and Delete buttons
                echo '<a href="index.php?url=admin/editRoom/' . $room['ID'] . '" class="edit-button">Edit</a> ';
                echo '<a href="index.php?url=admin/deleteRoom/' . $room['ID'] . '" class="delete-button" onclick="return confirm(\'Are you sure you want to delete this room?\')">Delete</a>';
                echo "<hr>";
                echo "</div>";
            }
        } else {
            echo "ingen rom funnet.";
        }
    
        // Add New Room Type button
        echo '<br><a href="index.php?url=admin/addRoom" class="add-button">Add New Room</a>';
    }

    public function addRoom() {
        echo '<h2>Add New Room</h2>';
        echo '
            <form action="index.php?url=admin/saveRoom" method="POST">
                <label for="roomname">Room Name:</label><br>
                <input type="text" id="roomname" name="roomname" required><br><br>
    
                <label for="floor">Floor:</label><br>
                <input type="number" id="floor" name="floor" required><br><br>
    
                <label for="roomtype_ID">Room Type ID:</label><br>
                <input type="number" id="roomtype_ID" name="roomtype_ID" required><br><br>
    
                <label for="closetoelevator">Close to Elevator:</label><br>
                <input type="checkbox" id="closetoelevator" name="closetoelevator" value="1"><br><br>
    
                <button type="submit">Save Room</button>
            </form>
        ';
    }

    public function saveRoom() {
        $this->AdminModel = new AdminModel(); // Initialize the AdminModel
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'roomname' => $_POST['roomname'],
                'floor' => $_POST['floor'],
                'roomtype_ID' => $_POST['roomtype_ID'],
                'closetoelevator' => isset($_POST['closetoelevator']) ? 1 : 0
            ];
    
            if ($this->AdminModel->saveRoom($data)) {
                echo 'Room added successfully!';
            } else {
                echo 'Failed to add room.';
            }
        }
    
        echo '<br><a href="index.php?url=admin/displayRooms">Back to Rooms</a>';
    }
    public function editRoom($id) {
        $this->AdminModel = new AdminModel(); // Initialize the AdminModel
    
        $room = $this->AdminModel->getRooms($id)[0]; // Fetch room by ID
    
        if ($room) {
            echo '<h2>Edit Room</h2>';
            echo '
                <form action="index.php?url=admin/updateRoom" method="POST">
                    <input type="hidden" name="id" value="' . $room['ID'] . '">
    
                    <label for="roomname">Rom navn:</label><br>
                    <input type="text" id="roomname" name="roomname" value="' . $room['roomname'] . '" required><br><br>
    
                    <label for="floor">Etasje:</label><br>
                    <input type="number" id="floor" name="floor" value="' . $room['floor'] . '" required><br><br>
    
                    <label for="roomtype_ID">Rom Type:</label><br>
                    <input type="number" id="roomtype_ID" name="roomtype_ID" value="' . $room['roomtype_ID'] . '" required><br><br>
    
                    <label for="closetoelevator">Nærme heis? :</label><br>
                    <input type="checkbox" id="closetoelevator" name="closetoelevator" value="1" ' . ($room['closetoelevator'] ? 'checked' : '') . '><br><br>
    
                    <button type="submit">Update Room</button>
                </form>
            ';
        } else {
            echo "Room not found.";
        }
    }

    public function updateRoom() {
        $this->AdminModel = new AdminModel(); // Initialize the AdminModel
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['id'],
                'roomname' => $_POST['roomname'],
                'floor' => $_POST['floor'],
                'roomtype_ID' => $_POST['roomtype_ID'],
                'closetoelevator' => isset($_POST['closetoelevator']) ? 1 : 0
            ];
    
            if ($this->AdminModel->updateRoom($data)) {
                echo 'Room updated successfully!';
            } else {
                echo 'Failed to update room.';
            }
        }
    
        echo '<br><a href="index.php?url=admin/displayRooms">Back to Rooms</a>';
    }

    public function deleteRoom($id) {
        $this->AdminModel = new AdminModel(); // Initialize the AdminModel
    
        if ($this->AdminModel->deleteRoom($id)) {
            echo 'Room deleted successfully!';
        } else {
            echo 'Failed to delete room.';
        }
    
        echo '<br><a href="index.php?url=admin/displayRooms">Back to Rooms</a>';
    }
//Rooms end--------------------------------------------------------------------------------------------------------------       
    
    

    public function showRoomTypes($ID = null) {
        $roomTypes = $this->AdminModel->getRoomType($ID);
    
        echo "<h2>Room Types</h2>";
    
        if (!empty($roomTypes)) {
            foreach ($roomTypes as $roomType) {
                echo "<div>";
                echo "<p>Name: {$roomType['typename']}</p>";
                echo "<p>Description: {$roomType['descript']}</p>";
                echo "<p>Adult Capacity: {$roomType['acapacity']}</p>";
                echo "<p>Child Capacity: {$roomType['ccapacity']}</p>";
    
                // Edit and Delete buttons
                echo '<a href="index.php?url=admin/editRoomType/' . $roomType['ID'] . '" class="edit-button">Edit</a> ';
                echo '<a href="index.php?url=admin/deleteRoomType/' . $roomType['ID'] . '" class="delete-button" onclick="return confirm(\'Are you sure you want to delete this room type?\')">Delete</a>';
                echo "<hr>";
                echo "</div>";
            }
        } else {
            echo "No room types found.";
        }
    
        // Add New Room Type button
        echo '<br><a href="index.php?url=admin/addRoomType" class="add-button">Add New Room Type</a>';
 
    }
    
    

    public function addRoomType() {
        echo '<h2>Add New Room Type</h2>';
        echo '
            <form action="index.php?url=admin/saveRoomType" method="POST">
                <label for="typename">Navn:</label><br>
                <input type="text" id="typename" name="typename" required><br><br>
    
                <label for="descript">Beskrivelse:</label><br>
                <textarea id="descript" name="descript" required></textarea><br><br>
    
                <label for="acapacity">Voksen kapasistet:</label><br>
                <input type="number" id="acapacity" name="acapacity" min= "0" max "99" required><br><br>
    
                <label for="ccapacity">Barn kapasitet:</label><br>
                <input type="number" id="ccapacity" name="ccapacity" min= "0" max "99" required><br><br>
    
                <button type="submit">Save Room Type</button>
            </form>
        ';
    }

    public function editRoomType($ID) {
        // Fetch the room type details
        $this->AdminModel = new AdminModel();
        $roomType = $this->AdminModel->getRoomType($ID)[0]; // Assuming ID is unique
    
        if ($roomType) {
            echo '<h2>Edit Room Type</h2>';
            echo '
                <form action="index.php?url=admin/updateRoomType" method="POST">
                    <input type="hidden" name="ID" value="' . $roomType['ID'] . '">
                    <label for="typename">Name:</label><br>
                    <input type="text" id="typename" name="typename" value="' . $roomType['typename'] . '" required><br><br>
    
                    <label for="descript">Description:</label><br>
                    <textarea id="descript" name="descript" required>' . $roomType['descript'] . '</textarea><br><br>
    
                    <label for="acapacity">Adult Capacity:</label><br>
                    <input type="number" id="acapacity" name="acapacity" value="' . $roomType['acapacity'] . '" required><br><br>
    
                    <label for="ccapacity">Child Capacity:</label><br>
                    <input type="number" id="ccapacity" name="ccapacity" value="' . $roomType['ccapacity'] . '" required><br><br>
    
                    <button type="submit">Update Room Type</button>
                </form>
            ';
        } else {
            echo "Room type not found.";
        }
    }
    
    


    public function saveRoomType() {
        $this->AdminModel = new AdminModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'typename' => $_POST['typename'],
                'descript' => $_POST['descript'],
                'acapacity' => $_POST['acapacity'],
                'ccapacity' => $_POST['ccapacity']
            ];
    
            if ($this->AdminModel->saveRoomType($data)) {
                echo 'Room type added successfully!';
            } else {
                echo 'Failed to add room type.';
            }
        }
    }

    public function updateRoomType() {
        $this->AdminModel = new AdminModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ID' => $_POST['ID'],
                'typename' => $_POST['typename'],
                'descript' => $_POST['descript'],
                'acapacity' => $_POST['acapacity'],
                'ccapacity' => $_POST['ccapacity']
            ];
    
            if ($this->AdminModel->updateRoomType($data)) {
                echo 'Room type updated successfully!';
            } else {
                echo 'Failed to update room type.';
            }
        }
    
        // Redirect back to the room types list
        echo '<br><a href="index.php?url=admin/displayRoomTypes">Back to Room Types</a>';
    }

    public function deleteRoomType($ID) {
        $this->AdminModel = new AdminModel();
        if ($this->AdminModel->deleteRoomType($ID)) {
            echo 'Room type deleted successfully!';
        } else {
            echo 'Failed to delete room type.';
        }
    
        // Redirect back to the room types list
        echo '<br><a href="index.php?url=admin/displayRoomTypes">Back to Room Types</a>';
    }
    
        

}
    // Add a back button
    echo '<br><a href="index.php?url=admin">Back to Admin</a>';
?>