<?php
require 'room_admin_model.php';
require 'room_admin_view.php';

class Controller {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new Model();
        $this->view = new View();
    }

 
    public function addRoom($roomNumber, $floor, $roomType, $aCapacity, $cCapacity, $closeToElevator) {

        $roomData = array(
            "roomNumber"        =>  $roomNumber,
            "floor"             =>  $floor,
            "roomType"          =>  $roomType,
            "aCapacity"         =>  $aCapacity,
            "cCapacity"         =>  $cCapacity,
            "closeToElevator"   =>  $closeToElevator,
        );

        $result = $this->model->saveRoom($roomData);


        if ($result) {
            $this->view->render("ID {$roomData} saved successfully!");
        } else {
            $this->view->render("Failed to save ID {$roomData}.");
        }
    }

 
    public function showForm() {
        $this->view->renderAddRoom();
    }
}
?>
