<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php

    session_start();

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        header("Location: dashboard.php");
        exit();
    }

    require_once('db.php');
    // Check connection
    if ($conn->connect_error) {
        // print in the console log
        echo "<script>console.log('Connection failed: " . $conn->connect_error . "');</script>";
        exit("Connection failed: " . $conn->connect_error);
    } else {
        // print in the console log
        echo "<script>console.log('Connected successfully');</script>";

        if (isset($_POST['submit'])) {
            // Get form data
            $email = $_POST['email'];
            $password = $_POST['password'];


            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                // Verify password
                if (password_verify($password, $row["password"])) {
                    // Login successful

                    setcookie("email", $email, time() +  24 * 60 * 60); //  
                    setcookie("password", $password, time() +  24 * 60 * 60); //

                    session_start();
                    $_SESSION['user_id'] = $row["user_id"];
                    $_SESSION['user_type'] = $row["user_type"];
                    $_SESSION['username'] = $row["username"];

                    // if user type is admin navigate to dashboard else to chats page
                    if ($row["user_type"] == "admin") {
                        // redirect to dashboard page 
                        header("Location: dashboard.php");
                        exit();
                    } else{
                        // redirect to chats page
                        header("Location: chat.php");
                    }


                    
                } else {
                    echo "<script>alert('Incorrect password.')</script>";
                }
            } else {
                echo "<script>alert('invalid email.')</script>";
            }

            $conn->close();
        }
    }
    ?>

    <div class="container">
        <div class="form-container">
            <h2>Login</h2>
            <form action="login.php" method="post">


                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>" required>
                </div>



                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <!-- link for forget password -->
                <div class="form-group">
                    <p><a href="forget-password.php">Forget password?</a></p>
                </div>

                <div class="form-group">
                    <button type="submit" name="submit">
                        Login
                    </button>
                </div>

                <!-- create a new account -->
                <div class="form-group">
                    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                </div>

            </form>
        </div>
        <div class="image-container">
            <img src="https://img.freepik.com/free-vector/computer-login-concept-illustration_114360-7962.jpg?t=st=1736237161~exp=1736240761~hmac=f332ab75a5e4c3e49c439aed065d18de5dadd01e3408cd54d4d404d3809e9f31&w=740" alt="Chat App">
        </div>
    </div>

</body>

</html>