<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration page</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container">
    <div class="image-container">
        <img src="https://img.freepik.com/free-vector/sign-up-concept-illustration_114360-7965.jpg?t=st=1736157795~exp=1736161395~hmac=cfbd208dce775c6b9b4e370d8ffa614cd4ea01fed78ae20cf58e71b4cdfff8a8&w=740" alt="Chat App">
    </div>
    <div class="form-container">
        <h2>Sign up</h2>
        <form action="#" method="post">
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
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="sex">Sex:</label>
                <div class="sex-options">
                    <label for="male">Male</label>
                    <input type="radio" id="male" name="sex" value="male" required>
                    <label for="female">Female</label>
                    <input type="radio" id="female" name="sex"value="female" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <button type="submit">
                    Sign up
                </button>
            </div>

            <!-- already have an account -->
            <div class="form-group">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>

        </form>
    </div>
</div>

</body>
</html>