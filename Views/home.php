<?php
include '../Public/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ?></title>
    <!--linker til stylesheet-->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Search for Available Rooms</h1>
    

    <form action="index.php?url=home/searchRooms" method="POST">
        <label for="insjekk">Check-in Date:</label><br>
        <input type="date" id="insjekk" name="insjekk" required><br><br>

        <label for="utsjekk">Check-out Date:</label><br>
        <input type="date" id="utsjekk" name="utsjekk" required><br><br>

        <label for="acapacity">Adult Capacity:</label><br>
        <input type="number" id="acapacity" name="acapacity" required><br><br>

        <label for="ccapacity">Child Capacity:</label><br>
        <input type="number" id="ccapacity" name="ccapacity" required><br><br>

        <label for="closetoelevator">Close to Elevator:</label>
        <input type="checkbox" id="closetoelevator" name="closetoelevator" value="1"><br><br>

        <button type="submit">Search</button>
    </form>

    <?php if (isset($rooms) && !empty($rooms)): ?>
    <h2>Available Rooms</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Room Name</th>
            <th>Floor</th>
            <th>Close to Elevator</th>
            <th>Type Name</th>
            <th>Description</th>
        </tr>
        <?php foreach ($rooms as $room): ?>
            <tr>
                <td><?= $room['ID'] ?></td>
                <td><?= $room['roomname'] ?></td>
                <td><?= $room['floor'] ?></td>
                <td><?= $room['closetoelevator'] ? 'Yes' : 'No' ?></td>
                <td><?= $room['typename'] ?></td>
                <td><?= $room['descript'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php elseif (isset($rooms)): ?>
    <p>No rooms available for the selected criteria.</p>
<?php endif; ?>

</body>
</html>

