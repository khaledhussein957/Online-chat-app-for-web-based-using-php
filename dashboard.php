<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard page</title>

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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        a[type="edit"] {
            color: #4CAF50;
            text-decoration: none;
        }
        a[type="delete"] {
            color: rgb(255, 0, 0);
            text-decoration: none;
        }
    </style>

</head>

<body>

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once('Connection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

?>

    <div id="header">
        <h2>Users</h2>
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
            <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>

            <table border="1">
                <thead>
                    <tr>
                        <th>User Id</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>Sex</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Profile pic</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["user_id"] . "</td>";
                            echo "<td>" . $row["fname"] . "</td>";
                            echo "<td>" . $row["lname"] . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["phone"] . "</td>";
                            echo "<td>" . $row["sex"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["user_type"] . "</td>";
                            echo "<td>" . $row["profile_picture"] . "</td>";
                            echo "<td><a type='edit' href='edit_user.php?id=" . $row["user_id"] . "'>Edit</a> | <a type='delete' href='delete_user.php?id=" . $row["user_id"] . "'>Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No users found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>


</body>

</html>

<?php
$conn->close();
?>