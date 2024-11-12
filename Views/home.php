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
                <p><a href="index.php?url=user">Go to User Page</a></p>

            </nav>
        </div>
    </header>
    <main style="padding-top: 80px;" margin="0 auto;">
        <form action="Oppg4_2.php" method="POST">
            Start Dato: <input type="date" name="startDato"><br>
            Slutt Dato: <input type="date" name="sluttDato"><br>
            <!--Adresse: <input type="text" name="adresse"><br>-->
            <input type="submit">
        </form>
            <div>
                <?php

                    echo "<br>" . "bob";



                ?>
            </div>
</head>
<body>

<!-- ----------------------------------------->



