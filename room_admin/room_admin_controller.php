<?php
require 'room_admin_model.php';
require 'room_admin_view.php';

class Controller {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new Model(); //lager objekt av model 
        $this->view = new View(); //lager objekt av view
    }

 
    private function addRoom($roomNumber, $floor, $roomType, $aCapacity, $cCapacity, $closeToElevator) {

        $roomData = array(         //lager assiciativ array for datafelt fra hoteldb
            "roomNumber"        =>  $roomNumber,
            "floor"             =>  $floor,
            "roomType"          =>  $roomType,
            "aCapacity"         =>  $aCapacity,
            "cCapacity"         =>  $cCapacity,
            "closeToElevator"   =>  $closeToElevator,
        );

        $result = $this->model->saveRoom($roomData); //caller saveRoom() fra model-objektet med den assosiative arrayen som parameter.


        if ($result) { //caller render() fra view uannsett men dersom $result ikke eksisterer, ergo saveRoom() ikke fungerte gir den forskjellig feilmeld
            $this->view->render("ID {$roomData} saved successfully!");
        } else {
            $this->view->render("Failed to save ID {$roomData}.");
        }
    }

 
    public function showForm() { //caller renderAddroom() fra view, dette er en html forms
        $this->view->renderAddRoom();
    }
}
?>
