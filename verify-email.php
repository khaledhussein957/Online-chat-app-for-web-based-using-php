<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container">
    <div class="image-container">
        <img src="https://img.freepik.com/free-vector/enter-otp-concept-illustration_114360-7967.jpg?t=st=1736238088~exp=1736241688~hmac=5d47dd695a3bdf34800f7518a5e4c2216295b2551e1ca2f9a6b2207c58d96630&w=740" alt="Chat App">
    </div>
    <div class="form-container">
        <h2>Verify code</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" id="code" name="code" required>
            </div>

            <div class="form-group">
                <button type="submit">
                    Verify code
                </button>
            </div>

            <!-- back to the reset passwor page -->
            <div class="form-group">
                <p>Back to Reset Password ? <a href="forget-password.php">Reset Password</a></p>
            </div>

        </form>
    </div>
</div>
    
</body>
</html>