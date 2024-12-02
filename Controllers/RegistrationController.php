<?php

require_once '../Core/validation.php';
require_once '../Models/user.php';

class RegistrationController extends Controller {
    public function register() {
        {
            echo "Register method called!"; // Debug
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'fornavn' => $_POST['fornavn'] ?? '',
                'etternavn' => $_POST['etternavn'] ?? '',
                'mobilnummer' => $_POST['mobilnummer'] ?? '',
                'email' => $_POST['email'] ?? '',
                'adresse' => $_POST['adresse'] ?? '',
                'brukernavn' => $_POST['brukernavn'] ?? '',
                'passord' => $_POST['passord'] ?? '',
            ];

            $validator = new Validator();

            // Validerer
            $data['fornavn'] = $validator->validate('fornavn', $data['fornavn'], 'maxLength', ['length' => 50]);
            $data['etternavn'] = $validator->validate('etternavn', $data['etternavn'], 'maxLength', ['length' => 50]);
            $data['mobilnummer'] = $validator->validate('mobilnummer', $data['mobilnummer'], 'phone');
            $data['email'] = $validator->validate('email', $data['email'], 'email');
            $data['brukernavn'] = $validator->validate('brukernavn', $data['brukernavn'], 'maxLength', ['length' => 20]);
            $data['passord'] = $validator->validate('passord', $data['passord'], 'password');

            // feilsjekk på validering
            if ($validator->printErrors()) {
                return;
            }

            // Hash passord
            $data['passord'] = password_hash($data['passord'], PASSWORD_DEFAULT);

            // lagrer bruker til database
            $userModel = new UserModel();
            $Created = $userModel->createUser( //knytter til createuser i model filen
                $data['fornavn'],
                $data['etternavn'],
                $data['mobilnummer'],
                $data['email'],
                $data['adresse'],
                $data['brukernavn'],
                $data['passord']
            );

            if ($Created) {
                // Fetcher brukeren sin data for å sørge å få med all data fra brukeren, ikke bare input (dette trenges for å få med data generert av db, id, hashed passord istedefor rå passord)
                $user = $userModel->getUserByUsername($data['brukernavn']);
            
                // Starter en session for å lagre fetch data
                session_start();
                $_SESSION['user'] = $user;
            
                // redirekter til dashboard
                header("Location: /phpnettside/public/index.php?url=User/dashboard");
                exit;
            
            } else {
                echo "<br> Registrering feilet.";
            }
        } else {
            // Render registreringsskjema
            $this->view('register');
        }
    }
}
?>