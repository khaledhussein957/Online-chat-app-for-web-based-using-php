<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget password</title>

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

    require_once('Connection.php');

    // Include PHPMailer classes
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process form submission
    if (isset($_POST['submit'])) {
        // Get form data
        $email = $_POST['email'];

        // Check if email exists
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            echo "<script>console.log('Email not found.')</script>";
        } else {
            // Create the message link (replace with your actual domain)
            $message = "Click here to reset your password: http://localhost/project/Online-chat-app-for-web-based-using-php/create-password.php?token=" . uniqid();

            // Configure PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings (replace with your actual SMTP details)
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'khaledhussein957@gmail.com';                 // SMTP username
                $mail->Password   = 'iqtqlzhqhjczokt';                        // SMTP password
                $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption
                $mail->Port       = 587;                                    // TCP port to connect to

                // Recipients
                $mail->setFrom('khaledhussein957@gmail.com');
                $mail->addAddress($email);                       // Add a recipient

                // Content
                $mail->isHTML(true);                                        // Set email format to HTML
                $mail->Subject = 'Password Reset Request';
                $mail->Body    = $message;
                $mail->AltBody = strip_tags($message);

                $mail->send();
                echo "<script>alert('Reset password request sent successfully.')</script>";
                header("Location: create-password.php");
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }

    $conn->close();
    ?>

    <div class="container">
        <div class="image-container">
            <img src="https://img.freepik.com/premium-vector/landing-page-illustration-design-people-forgot-her-password_108061-334.jpg?w=1060" alt="Chat App">
        </div>
        <div class="form-container">
            <h2>Forget Password</h2>
            <form action="forget-password.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <button type="submit" name="submit">
                        Reset Password
                    </button>
                </div>

                <!-- back to the login page -->
                <div class="form-group">
                    <p>Back to Login ? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>

</body>

</html>