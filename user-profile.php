<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>

    <style>
        body {
            font-family: sans-serif;
            margin: 0;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        h1,
        h2 {
            margin-bottom: 10px;
        }

        .profile-container {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-details {
            text-align: left;
        }

        .profile-details label {
            display: block;
            margin-bottom: 5px;
        }

        .profile-details span {
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            color: white;
            background-color: #333333;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: rgb(69, 69, 69);
        }

        a {
            text-decoration: none;
            color: black;
        }

        .page {
            color: white;
            padding: 10px;
            text-align: center;
            gap: 10px;
            border-right: 1 solid #333;
        }

        .page ul {
            list-style: none;
        }

        .page a {
            color: #333;
            text-decoration: none;
            display: block;
            padding: 10px;
        }

        .page a:hover {
            background-color: #f0f0f0;
        }
    </style>

</head>

<body>


<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
} else {

    // User is logged in, get user ID from session
    $userId = $_SESSION['user_id'];

    // **Important:** **Do not store sensitive data directly in cookies**
    // Instead, use the user ID to fetch user information from the database

    require_once('Connection.php');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch user information from the database
    $sql = "SELECT * FROM users WHERE user_id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $userInfo = $result->fetch_assoc();

    } else {
        // User not found in the database
        echo "User not found.";
        exit();
    }
    
}
?>



    <div class="container">

        <div class="page">
            <ul>
                <li><a href="chats.php">Chats</a></li>
                <li><a href="user-profile.php">Profile</a></li>
            </ul>
        </div>


        <div class="content">
            <h1>My Profile</h1>

            <div class="profile-container">
                <div class="profile-image">
                    <img src="<?php echo !empty($userInfo['profile_picture']) ? $userInfo['profile_picture'] : 'user.png'; ?>" alt="User Image">
                </div>

                <div class="profile-details">
                    <label>Full Name:</label>
                    <span><?php echo $userInfo['fname'] . " " . $userInfo['lname']; ?></span><br>


                    <label>Username:</label>
                    <span><?php echo $userInfo['username']; ?></span><br>

                    <label>Email:</label>
                    <span><?php echo $userInfo['email']; ?></span><br>

                    <label>Phone:</label>
                    <span><?php echo $userInfo['phone']; ?></span><br>

                    <label>Sex:</label>
                    <span><?php echo $userInfo['sex']; ?></span><br>

                    <a href="edit_profile.php" class="btn">Edit Profile</a>
                    <a href="logout.php" class="btn">Logout</a>
                    <a class='btn btn-danger' onclick="return confirm('Are you sure you want to delete this user?');" href='delete_profile.php?id=<?php echo $userInfo["user_id"]; ?>'>Delete Profile</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<?php $conn->close(); ?>