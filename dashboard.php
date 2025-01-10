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

        .btn {
            padding: 5px 10px;
            border-radius: 3px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .ll {
            display: flex;
            gap: 2px;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }
    </style>

</head>

<body>

    <?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
        header("Location: login.php");
        exit();
    }
    

    require_once('db.php');

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
                <?php if ($_SESSION['user_type'] === 'admin') { ?>
                    <li><a href="dashboard.php">Users</a></li>
                    <li><a href="groups.php">Groups</a></li>
                    <li><a href="profile.php">Profile</a></li>
                <?php } else { ?>
                    <li><a href="chats.php">Chats</a></li>
                <?php } ?>
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
                            echo "<td class='ll'><a class='btn btn-primary' href='edit_user.php?id=" . $row["user_id"] . "'>Edit</a>  <a class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this user?');\" href='delete_user.php?id=" . $row["user_id"] . "'>Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No users found.</td></tr>";
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