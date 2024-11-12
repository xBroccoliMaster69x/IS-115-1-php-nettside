<?php
require 'room_admin_controller.php';

$controller = new Controller();



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['roomNumber'],$_POST['floor'],$_POST['roomType'],$_POST['aCapacity'],$_POST['cCapacity'],$_POST['closeToElevator'])) {
    $controller->addRoom($_POST['roomNumber'],$_POST['floor'],$_POST['roomType'],$_POST['aCapacity'],$_POST['cCapacity'],$_POST['closeToElevator']);
} else {
    $controller->showForm();
}
?>