<?php
session_start();

// Check if the user is logged in and has necessary permissions
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'user') {
    header("Location: login.php");
    exit();
}

require_once('db.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Delete user from database
    $sql = "DELETE FROM users WHERE user_id = $userId";

    if ($conn->query($sql) === TRUE) {
        echo "<p>User deleted successfully!</p>";
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    header("Location: users.php"); 
    exit();
}

$conn->close();

?>