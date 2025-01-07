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
            height: 588px;
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
    </style>

</head>

<body>

    <div id="header">
        <h2>Profile</h2>
    </div>


    <div class="main">
        <div id="sidebar">
            <ul>
                <li><a href="dashboard.php">Users</a></li>
                <li><a href="groups.php">Groups</a></li>
                <li><a href="profile.php">Profile</a></li>
            </ul>
        </div>



        <div id="main-content">
            <h1>My Profile</h1>

            <div class="profile-container">
                <div class="profile-image">
                    <img src="user_image.jpg" alt="User Image">
                </div>

                <div class="profile-details">
                    <label>Full Name:</label>
                    <span>John Doe</span><br>

                    <label>Username:</label>
                    <span>johndoe123</span><br>

                    <label>Email:</label>
                    <span>john.doe@example.com</span><br>

                    <label>Phone:</label>
                    <span>+1 123-456-7890</span><br>

                    <a href="edit_profile.php" class="btn">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>


</body>

</html>