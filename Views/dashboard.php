<?php
include '../Public/header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bruker Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Velkommen <?= htmlspecialchars($user['fornavn']) ?></h1>
    <p>Din informasjon:</p>
    <ul>
        <li>Fornavn: <?= htmlspecialchars($user['fornavn']) ?></li>
        <li>Etternavn: <?= htmlspecialchars($user['etternavn']) ?></li>
        <li>Email: <?= htmlspecialchars($user['email']) ?></li>
        <li>Mobilnummer: <?= htmlspecialchars($user['mobilnummer']) ?></li>
    </ul>
    <br>
    <p><a href="/phpnettside/public/index.php?url=Home/index">tilbake til hjemmesiden</a></p>
</body>
</html>
