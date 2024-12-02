<?php
class View {

    public function renderAddRoom() {//renderer input form for romskapning. inneholder feletene som skal inn i hoteldb
        echo '<form action="room_admin_index.php" method="POST">
              Rom Nummer: <input type="number" name="roomNumber" min="100" max= "999" step="1" value=""><br>
              Etasje: <input type="number" name="floor" min= "1" max= "3" step="1" value=""><br>
              
              Enkeltrom: <input type ="radio" id= "singleRoom" name="roomType" value="1"><br>
              Dobbeltrom: <input type ="radio" id= "doubleRoom" name="roomType" value="2"><br>
              Junior Suite: <input type ="radio" id= "juniorSuite" name="roomType" value="3"><br>

              Kapasitet Voksne: <input type="number" name="aCapacity" min= "1" max "3" value=""><br>
              Kapasitet Barn: <input type="number" name="cCapacity" min= "0" max "3" value=""><br>
              Nærme Heis: <input type= "checkbox" name= "closeToElevator" value="true"><br>       
              <input type="submit">
          </form>';
    }


    public function render($message) { //renderer en parameter, $message, som kan 
        echo '<p>' . htmlspecialchars($message) . '</p>';
    }
}
#$view = new View();
#$view->renderAddRoom();
?>
