<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registreringsskjema</title>
</head>
<body>
    <h1>Registreringsskjema</h1>
    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

        <form method="POST" action="/phpnettside/public/index.php?url=Registration/register"> 
        <input type="text" name="fornavn" placeholder="Fornavn" required>
        <input type="text" name="etternavn" placeholder="Etternavn" required>
        <input type="text" name="mobilnummer" placeholder="Mobilnummer" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="adresse" placeholder="Addresse">
        <input type="text" name="brukernavn" placeholder="Brukernavn" required>
        <input type="password" name="passord" placeholder="Passord" required>
        <button type="submit">Registrer bruker</button>
    </form>
</body>
</html>