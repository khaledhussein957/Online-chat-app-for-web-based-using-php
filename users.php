<?php
session_start();

// Only show users if logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once('Connection.php');

$sql = "SELECT user_id, username, email FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>
</head>

<body>

    <?php

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "username" . $row['username'] . "-" . $row['email'];
        }
    } else {
        echo "not found any user";
    }

    ?>

</body>

</html>