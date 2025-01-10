<?php
session_start();

// Check if the user is logged in and has necessary permissions
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin' ) {
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
} else {
    header("Location: dashboard.php");
    exit();
}

// Fetch user data from database
$sql = "SELECT * FROM users WHERE user_id = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

// Process form submission
if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $sex = $_POST['sex'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $userType = $_POST['userType'];

    // Check if email already exists (excluding current user)
    $sql = "SELECT * FROM users WHERE email='$email' AND user_id != $userId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $emailErr = "Email already exists";
    }

    // update user data
    $sql = "UPDATE users SET fname='$firstName', lname='$lastName', sex='$sex', username='$username', phone='$phone', email='$email', user_type='$userType' WHERE user_id = $userId";

    if ($conn->query($sql) === TRUE) {
        echo "<p>User updated successfully!</p>";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container">
        <div class="form-container">
            <h1>Edit User</h1>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $userId); ?>">
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" value="<?php echo $user['fname']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" value="<?php echo $user['lname']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="sex">Sex:</label>
                    <select id="sex" name="sex" required>
                        <option value="male" <?php echo $user['sex'] == 'male' ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo $user['sex'] == 'female' ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="userType">User Type:</label>
                    <input type="text" id="userType" name="userType" value="<?php echo $user['user_type']; ?>" required>
                </div>
                <button type="submit" name="submit">Update User</button>
            </form>
        </div>

    </div>

</body>

</html>