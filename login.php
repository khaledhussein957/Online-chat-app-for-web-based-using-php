<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container">
    <div class="form-container">
        <h2>Login</h2>
        <form action="#" method="post">
                        

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
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
                <button type="submit">
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