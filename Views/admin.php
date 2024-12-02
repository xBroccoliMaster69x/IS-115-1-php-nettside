<?php
include '../Public/header.php'; // Include the reusable header
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Admin Panel'; ?></title>
</head>
<body>
    <h1>Welcome to the <?= isset($title) ? $title : 'Admin Panel'; ?></h1>

    <form action="index.php?url=admin" method="POST">
        <!-- Button for viewing bookings -->
        <button type="submit" name="action" value="action1">Se bookinger</button>
        
        <!-- Button for viewing rooms -->
        <button type="submit" name="action" value="action2">Se Rom</button>
        
        <!-- knapp for å se romtyper -->
        <button type="submit" name="action" value="action3">Se Romtyper</button>
    </form>

    <div>
        <!-- Placeholder for dynamic content -->
        <?php if (isset($content)) : ?>
            <?= $content; ?>
        <?php endif; ?>
    </div>
</body>
</html>
