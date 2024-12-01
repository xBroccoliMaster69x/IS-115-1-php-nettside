<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($user['fornavn']) ?></h1>
    <p>Here are your details:</p>
    <ul>
        <li>First Name: <?= htmlspecialchars($user['fornavn']) ?></li>
        <li>Last Name: <?= htmlspecialchars($user['etternavn']) ?></li>
        <li>Email: <?= htmlspecialchars($user['email']) ?></li>
        <li>Phone: <?= htmlspecialchars($user['mobilnummer']) ?></li>
    </ul>
    <p><a href="/phpnettside/public/index.php?url=Home/index">tilbake til hjemmesiden</a></p>
</body>
</html>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($user['fornavn']) ?></h1>
    <p>Here are your details:</p>
    <ul>
        <li>First Name: <?= htmlspecialchars($user['fornavn']) ?></li>
        <li>Last Name: <?= htmlspecialchars($user['etternavn']) ?></li>
        <li>Email: <?= htmlspecialchars($user['email']) ?></li>
        <li>Phone: <?= htmlspecialchars($user['mobilnummer']) ?></li>
    </ul>
    <p><a href="/phpnettside/public/index.php?url=Home/index">tilbake til hjemmesiden</a></p>
</body>
</html>
>>>>>>> 06bfc943c7500c868494991ced202e24c896d362
