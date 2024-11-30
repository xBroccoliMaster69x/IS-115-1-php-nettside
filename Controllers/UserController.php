<?php
require_once '../Models/user.php';

class UserController extends Controller {
    public function login() {
        echo "Routing to UserController::login"; // Debug

        $this->view('login');
    }

    public function loginProcess() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['brukernavn'] ?? '';
            $password = $_POST['passord'] ?? '';

            $userModel = new UserModel();
            $user = $userModel->getUserByUsername($username);

            if (!$user) {
                die("User not found in database."); //sjekk om det ble funnet en bruker eller ikke 
            }
            // Debug passordproblemet
            var_dump($password);
            var_dump($user['passord']);
            var_dump(password_verify('Anakat01.', '$2y$10$yKwKyWkZKRUeAxmkdbH1jeUpdlCkucLC0bMrGaEnt9D'));
    


            if ($user && password_verify($password, $user['passord'])) {
                session_start();
                $_SESSION['user'] = $user;

                header("Location: /phpnettside/public/index.php?url=User/dashboard");
                exit;
            } else {
                echo "feil brukernavn eller passord";
            }
        }
    }

    public function dashboard() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: /phpnettside/public/index.php?url=User/login");
            exit;
        }

        $this->view('dashboard', ['user' => $_SESSION['user']]);
    }

}
