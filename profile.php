<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile page</title>

    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        #header {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: center;
        }

        .main {
            display: flex;
        }

        #sidebar {
            background-color: #333;
            color: #fff;
            padding: 20px;
            width: 200px;
            height: 100vh;
        }

        #sidebar ul {
            list-style: none;
            padding: 0;
        }

        #sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
        }

        #sidebar a:hover {
            background-color: #555;
        }

        #main-content {
            flex: 1;
            padding: 20px;
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
    </style>

</head>

<body>

    <!-- import the connection -->
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

        $conn->close();
    }
    ?>

    <div id="header">
        <h2>Profile</h2>
    </div>


    <div class="main">
        <div id="sidebar">
            <ul>
                <li><a href="dashboard.php">Users</a></li>
                <li><a href="chat.php">Chats</a></li>
                <li><a href="profile.php">Profile</a></li>
            </ul>
        </div>



        <div id="main-content">
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
                </div>
            </div>
        </div>
    </div>


</body>

</html>