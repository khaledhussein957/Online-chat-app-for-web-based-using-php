<?php
session_start();
include('db.php');

if (!isset($_SESSION['username'])) {
    exit("You are not logged in");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];

    $sql = "SELECT * FROM chat_messages WHERE (sender='$sender' AND receiver='$receiver') OR (sender='$receiver' AND receiver='$sender') ORDER BY created_at";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="message"><strong>' . ucfirst($row['sender']) . ':</strong> ' . $row['message'] . '</div>';
        }
    }
}

?>