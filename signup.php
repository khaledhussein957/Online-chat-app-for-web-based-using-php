<!DOCTYPE html>
<html>

<head>
    <title>Signup Page</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            width: 800px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }


        .image-container {
            flex: 1;
            background-color: #3498db;
            background-size: cover;
            background-position: center;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .form-container {
            flex: 1;
            padding: 30px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .form-row .form-group input {
            width: 170px;
        }

        .gender-options {
            display: flex;
            gap: 10px;

        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }


        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 370px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .error-message {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <?php

    require_once('Connection.php');

    // Check connection
    if ($conn->connect_error) {
        // print in the console log
        echo "<script>console.log('Connection failed: " . $conn->connect_error . "');</script>";
        exit("Connection failed: " . $conn->connect_error);
    } else {
        echo "<script>console.log('Connected successfully');</script>";

        if (isset($_POST['submit'])) {

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $username = $_POST['username'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // print in the console log
            echo "<script>console.log('First Name: $fname');</script>";
            echo "<script>console.log('Last Name: $lname');</script>";
            echo "<script>console.log('Username: $username');</script>";
            echo "<script>console.log('Phone: $phone');</script>";
            echo "<script>console.log('gender: $gender');</script>";
            echo "<script>console.log('Email: $email');</script>";
            echo "<script>console.log('Password: $password');</script>";

            // Check if the user already exists
            $result = $conn->query("SELECT * FROM users WHERE email = '$email';");
            if ($result->num_rows > 0) {
                echo "User already exists!";
            } else {
                // Insert the user into the database
                if ($conn->query("INSERT INTO users (fname, lname, username, phone, gender, email, password) VALUES ('$fname', '$lname', '$username', '$phone', '$gender', '$email', '$password');")) {
                    echo "Signup successful!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }
    ?>

    <div class="container">
        <div class="image-container">
            <img src="https://img.freepik.com/free-vector/sign-up-concept-illustration_114360-7965.jpg?t=st=1736157795~exp=1736161395~hmac=cfbd208dce775c6b9b4e370d8ffa614cd4ea01fed78ae20cf58e71b4cdfff8a8&w=740" alt="Chat App" style="width: 100%; height: 100%;">
        </div>
        <div class="form-container">
            <h2>Signup</h2>
            <form action="signup.php" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" id="fname" name="fname" class="form-control" required>
                        <span class="error-message" id="fnameError"></span>
                    </div>

                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input type="text" id="lname" name="lname" class="form-control" required>
                        <span class="error-message" id="lnameError"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                        <span class="error-message" id="usernameError"></span>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="phone" id="phone" name="phone" class="form-control" required>
                        <span class="error-message" id="phoneError"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                    <span class="error-message" id="emailError"></span>
                </div>

                <div class="form-group">
                    <label>Gender:</label>
                    <div class="gender-options">
                        <label for="male">Male</label>
                        <input type="radio" id="male" name="gender" value="male">
                        <label for="female">Female</label>
                        <input type="radio" id="female" name="gender" value="female">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    <span class="error-message" id="passwordError"></span>
                </div>
                <button type="submit" class="btn">Signup</button>
            </form>
        </div>
    </div>





    <script>
        // Add client-side validation (optional)
        const fnameInput = document.getElementById('fname');
        const lnameInput = document.getElementById('lname');
        const usernameInput = document.getElementById('username');
        const phoneInput = document.getElementById('phone');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        const fnameError = document.getElementById('fnameError');
        const lnameError = document.getElementById('lnameError');
        const usernameError = document.getElementById('usernameError');
        const phoneError = document.getElementById('phoneError');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');

        fnameInput.addEventListener('blur', () => {
            // Perform basic full_name validation (e.g., length, characters)
            if (fnameInput.value.trim() === '') {
                fnameError.textContent = "first name cannot be empty";
            } else {
                fnameError.textContent = "";
            }
        });

        lnameInput.addEventListener('blur', () => {
            // Perform basic full_name validation (e.g., length, characters)
            if (lnameInput.value.trim() === '') {
                lnameError.textContent = "last name cannot be empty";
            } else {
                lnameError.textContent = "";
            }
        });

        usernameInput.addEventListener('blur', () => {
            // Perform basic username validation (e.g., length, characters)
            if (usernameInput.value.trim() === '') {
                usernameError.textContent = "username cannot be empty";
            } else {
                usernameError.textContent = "";
            }
        });

        phoneInput.addEventListener('blur', () => {
            // Perform basic phone validation (e.g., length, characters)
            if (phoneInput.value.trim() === '') {
                phoneError.textContent = "phone cannot be empty";
            } else {
                phoneError.textContent = "";
            }
        });

        emailInput.addEventListener('blur', () => {
            // Perform basic email validation (e.g., format)
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value)) {
                emailError.textContent = "Invalid email address";
            } else {
                emailError.textContent = "";
            }
        });

        passwordInput.addEventListener('blur', () => {
            // Perform basic password validation (e.g., length, complexity)
            if (passwordInput.value.length < 8) {
                passwordError.textContent = "Password must be at least 8 characters long";
            } else {
                passwordError.textContent = "";
            }
        });
    </script>

</body>

</html>