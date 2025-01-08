<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groups page</title>

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
?>

    <div id="header">
        <h2>Groups</h2>
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
            <h1>Group Management</h1>

            <table>
                <thead>
                    <tr>
                        <th>Group ID</th>
                        <th>Group Name</th>
                        <th>Description</th>
                        <th>Members</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Administrators</td>
                        <td>Group for administrators</td>
                        <td>John Doe, Jane Smith</td>
                        <td><a href="#">Edit</a> | <a href="#">Delete</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Users</td>
                        <td>Group for regular users</td>
                        <td>David Lee, Sarah Jones</td>
                        <td><a href="#">Edit</a> | <a href="#">Delete</a></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>


</body>

</html>