<?php
include '../Public/header.php'; // Include the reusable header
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <h1>Welcome to the <?= $title ?></h1>

    <p><a href="index.php?url=user">Go to User Page</a></p>
    <?php
    
    class adminView{
        public function renderOptions(){


        }
        public function showRooms(){
            /*
            echo "<table border='1'";
            echo "<tr><th>Navn:</th><th>Alder:</th></tr>"; # lager to tabell headers, Navn og Alder
        
            // lager tabell rader og data
            echo "<tr>";                   # sterter en rad i tabellen
            echo "<td>" . $navn . "</td>"; # lagrer variablen $navn i første celle
            echo "<td>" . $alder . "</td>"; # lagrer variablen $alder i andre celle
            echo "</tr>";
        
            echo "</table>";
            */

        }
    
    
    
    
    
    
    }
    ?>
</body>
</html>
