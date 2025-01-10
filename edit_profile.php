<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Profile</title>

    <link rel="stylesheet" href="style.css">


</head>

<body>


    <?php
    session_start();

    require_once('db.php');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user ID from session
    $userId = $_SESSION['user_id'];

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
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $phone = $_POST['phone'];
        $username = $_POST['username'];

        // Handle profile image upload (if any)

        // Check if image file is a actual image or fake image
        if (!empty($_FILES['photo']['name'])) {
            // echo ("<pre>");
            // var_dump($_FILES['photo']);
            // limit file extension to jpg or jpeg 
            $myExtensions = array('jpg', 'jpeg',);
            $nameExtesion = explode('.', $_FILES['photo']['name']);
            $ext = strtolower(end($nameExtesion));
            // echo ("<pre>");
            // var_dump($nameExtesion);
            if (!in_array($ext, $myExtensions))
                echo ("<br>This extension <b>$ext</b> is not allowed");
            // limit file size 
            else if (!$_FILES['photo']['size'])
                echo ("<br>File: <b>" . $_FILES['photo']['name'] . "</b> is too big to be uploaded");
            // check if file exists in the direcory 
            else if (file_exists("uploads/" . $_FILES['photo']['name'])) {
                if (move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/" . $_POST['fname'] . "_" . $_POST['lname'] . ".$ext"))
                    echo ("<br>File has been uploaded successfully");
                else
                    echo ("<br>Nothing has been uploaded");
            } else if (move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/" . $_FILES['photo']['name'])){
                // store in the this variable profilePicture
                $profilePicture = "uploads/" . $_FILES['photo']['name'];
                echo ("<br>Photo <b>" . $_FILES['photo']['name'] . "</b> has been uploaded successfully");
            }
            else
                echo ("<br>Nothing has been uploaded");
        }

        // Update user data in database
        $sql = "UPDATE users SET fname='$firstName', lname='$lastName', phone='$phone', username='$username', profile_picture='$profilePicture' WHERE user_id = $userId";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Profile updated successfully!</p>";
            // Optionally, refresh the page to display updated information
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating profile: " . $conn->error;
        }
    }

    $conn->close();

    ?>


    <div class="container">
        <div class="form-container">
            <h2>Edit Profile</h2>

            <form action="edit_profile.php" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="fname">first name:</label>
                        <input type="text" id="fname" name="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">last name:</label>
                        <input type="text" id="lname" name="lname" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="phone" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="profile_image">Profile Image:</label>
                    <input type="file" id="photo" name="profile_image">
                </div>


                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <button type="submit" name="submit">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>

</html>