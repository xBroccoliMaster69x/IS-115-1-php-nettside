<?php
require_once '../Models/search.php';

class HomeController extends Controller {
    private $searchModel;

    public function __construct() {
        $this->searchModel = new SearchModel();
    }

    public function index() {
        // Render the home view with the search form
        $this->view('home');
    }

    public function searchRooms() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize input
            $checkinDate = $_POST['insjekk'];
            $checkoutDate = $_POST['utsjekk'];
            $acapacity = (int)$_POST['acapacity'];
            $ccapacity = (int)$_POST['ccapacity'];
            $closeToElevator = isset($_POST['closetoelevator']) ? 1 : 0;

            // Validation: Check-in date must be before check-out date
            if (strtotime($checkinDate) >= strtotime($checkoutDate)) {
                echo "Check-in date cannot be later than or equal to check-out date.";
                return;
            }

            // Fetch available rooms
            $rooms = $this->searchModel->getAvailableRooms($checkinDate, $checkoutDate, $acapacity, $ccapacity, $closeToElevator);

            // Render the home view with search results
            $this->view('home', ['rooms' => $rooms]);
        }
    }
}
