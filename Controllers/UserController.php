<?php
require_once '../Models/user.php';

class UserController extends Controller {
    public function login() {
        $this->view('login');
    }

    public function loginProcess() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['brukernavn'] ?? '';
            $password = $_POST['passord'] ?? '';

            $userModel = new UserModel();
            $user = $userModel->getUserByUsername($username);
            $password = trim($_POST['passord'] ?? ''); // Trimmer input ved innlogging i tilfelle, denne er deretter sammenligned med lagred hashed passord (etter trimming)

            if (!$user) {
                die("User not found in database."); //sjekk om det ble funnet en bruker eller ikke 
            }
            // Debug passordproblemet
           
            var_dump("Input Password (length " . strlen($password) . "):", $password);
            var_dump("Stored Hash in DB:", $user['passord']);
            var_dump(password_verify($password, $user['passord']));

        

            if ($user && password_verify($password, $user['passord'])) {
                session_start();
                $_SESSION['user'] = $user;
                
                
                // Redirecter til dashboard basert på type bruker 
                header("Location: /phpnettside/public/index.php?url=User/dashboard");
                exit;
            } else {
                echo "feil brukernavn eller passord";
            }
        }
    }

    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); 
        }
        // sjekker om key user er finnes i session 
    if (!isset($_SESSION['user'])) {
        header("Location: /phpnettside/public/index.php?url=User/login");
        exit;
    }

    // 
    if ($_SESSION['user']['is_admin'] == 1) {
        
        $this->view('admin', ['user' => $_SESSION['user']]);
    } else {
       
        $this->view('dashboard', ['user' => $_SESSION['user']]);
    }
    }


    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // 
        }
        session_unset(); // renser bort alle variabler fra session
        session_destroy(); // ødelegger session
        header("Location: /phpnettside/public/index.php?url=User/login"); 
        exit;
    }
    


}
