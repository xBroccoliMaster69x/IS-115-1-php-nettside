<?php
include '../Public/header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Innlogging</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Logg In</h1>
    <form method="POST" action="/phpnettside/public/index.php?url=User/loginProcess">
        <input type="text" name="brukernavn" placeholder="brukernavn" required>
        <input type="password" name="passord" placeholder="passord" required>
        <button type="submit">Logg In</button>
    </form>
    <p>ikke bruker? <a href="/phpnettside/public/index.php?url=registration/register">Registrer her</a></p>
    <br>
    <p><a href="/phpnettside/public/index.php?url=Home/index">tilbake til hjemmesiden</a></p>
</body>
</html>
