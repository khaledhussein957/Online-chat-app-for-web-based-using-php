<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Password</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>

<?php
session_start();

require_once('Connection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the token is provided in the URL
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Find the user associated with the token (you might need to store the token in the database)
    // This is a simplified example, you might need to adjust based on your token storage method
    $sql = "SELECT * FROM users WHERE user_id ='$userId'"; 
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $userId = $row['user_id']; 

        if (isset($_POST['submit'])) {
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            // Validate confirm password
  
            if ($newPassword !== $confirmPassword) {
                $confirmPasswordErr = "Passwords do not match";
            }

                // Hash the new password
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update user's password in the database
                $sql = "UPDATE users SET password='$hashedPassword' WHERE user_id = $userId"; 

                if ($conn->query($sql) === TRUE) {
                    echo "<p>Password updated successfully!</p>";
                } else {
                    echo "Error updating password: " . $conn->error;
                }
        }
    } else {
        echo "<p>Invalid or expired token.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}

$conn->close();

?>

<div class="container">
    <div class="image-container">
        <img src="https://img.freepik.com/free-vector/reset-password-concept-illustration_114360-7966.jpg?t=st=1736238366~exp=1736241966~hmac=a1453b8677b27bada648563ec56c82e1044f67ae2b7cf070bd0a8b112253b455&w=740" alt="Chat App">
    </div>
    <div class="form-container">
        <h2>Create Password</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <div class="form-group">
                <button type="submit">
                    Create Password
                </button>
            </div>

            <!-- back to the verify email page -->
            <div class="form-group">
                <p>Back to Verify Email ? <a href="verify-email.php">Verify Email</a></p>
            </div>

        </form>
    </div>
</div>

    
</body>
</html>