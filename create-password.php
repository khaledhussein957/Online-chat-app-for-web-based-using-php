<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Password</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container">
    <div class="image-container">
        <img src="https://img.freepik.com/free-vector/reset-password-concept-illustration_114360-7966.jpg?t=st=1736238366~exp=1736241966~hmac=a1453b8677b27bada648563ec56c82e1044f67ae2b7cf070bd0a8b112253b455&w=740" alt="Chat App">
    </div>
    <div class="form-container">
        <h2>Create Password</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <div class="form-group">
                <button type="submit">
                    Create Password
                </button>
            </div>

            <!-- back to the verify email page -->
            <div class="form-group">
                <p>Back to Verify Email ? <a href="verify-email.php">Verify Email</a></p>
            </div>

        </form>
    </div>
</div>

    
</body>
</html>