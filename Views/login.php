<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log In</title>
</head>
<body>
    <h1>Log In</h1>
    <form method="POST" action="/phpnettside/public/index.php?url=User/loginProcess">
        <input type="text" name="brukernavn" placeholder="brukernavn" required>
        <input type="password" name="passord" placeholder="passord" required>
        <button type="submit">Log In</button>
    </form>
    <p>ikke bruker? <a href="/phpnettside/public/index.php?url=registration/register">Registrer her</a></p>
</body>
</html>
