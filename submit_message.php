<?php
session_start();
include('Connection.php');
if (!isset($_SESSION['username'])) {
    exit("You are not logged in");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection (similar to chat.php)

    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $message = $_POST['message'];

    $sql = "INSERT INTO chat_messages (sender, receiver, message) VALUES ('$sender', '$receiver', '$message')";
    $conn->query($sql);
    $conn->close();
}


?>