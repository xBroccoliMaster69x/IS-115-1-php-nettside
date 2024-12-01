<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!--linker til stylesheet-->
    <link rel="stylesheet" href="assets/css/style.css">
    <header>
        <div class="container">
            <!-- Logo -->
            <div class="logo">
                <a href="mainPage.php">Logo</a>
            </div>

            <!-- Navigation Links -->
            <nav>
                <p><a href="/phpnettside/public/index.php?url=User/login">Go to User Page</a></p>

            </nav>
        </div>
    </header>

        </form>
            <div>
                <?php

                    echo "<br>" . "bob";



                ?>
            </div>


</head>
<body>

<!-- ----------------------------------------->
<?php
class homeView{
    function renderOrder(){
        echo '<form action="room_admin_index.php" method="POST">
        Insjekk Dato: <input type="date" name="insjekk" ><br>
        Utsjekk Dato: <input type="date" name="utsjekk" ><br>
        
        Enkeltrom: <input type ="radio" id= "singleRoom" name="roomType" value="1"><br>
        Dobbeltrom: <input type ="radio" id= "doubleRoom" name="roomType" value="2"><br>
        Junior Suite: <input type ="radio" id= "juniorSuite" name="roomType" value="3"><br>

        Kapasitet Voksne: <input type="number" name="aCapacity" min= "1" max "3" value=""><br>
        Kapasitet Barn: <input type="number" name="cCapacity" min= "0" max "3" value=""><br>
        Nærme Heis: <input type= "checkbox" name= "closeToElevator" value="true"><br>       
        <input type="submit">
    </form>';





    }



}
$a = new homeView;
$a->renderOrder();
?>


