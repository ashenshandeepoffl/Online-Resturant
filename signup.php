<?php

include 'dbConnection.php';

// Process form data when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $address = $_POST["address_no"] . ', ' . $_POST["address_street"] . ', ' . $_POST["address_city"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate password match
    if ($password != $confirm_password) {
        die("Password and Confirm Password do not match");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Set default user role
    $user_type = "customers";

    // SQL query to insert data into the database
    $sql = "INSERT INTO users (first_name, last_name, email, username, address, gender, dob, password, user_type)
            VALUES ('$first_name', '$last_name', '$email', '$username', '$address', '$gender', '$dob', '$hashed_password', '$user_type')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, redirect to login page
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="forms.css">
</head>
<body>

    <div class="topnav">
        <a href="home.php">Home</a>
        <a href="promotions.php">Promotions</a>
        <a href="menu.php">Menu</a>
        <a href="aboutus.html">About</a>
        <a class="active" href="login.php">Login</a>
    </div>


    <div class="container">
        <div class="text">User Registration</div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-row">
                <div class="input-data">
                    <input type="text" name="first_name" required><br>
                    <div class="underline"></div>
                    <label for="first_name">First Name</label>
                </div>
                <div class="input-data">
                    <input type="text" name="last_name" required><br>
                    <div class="underline"></div>
                    <label for="last_name">Last Name</label>
                </div>
            </div>

            <div class="form-row">
                <div class="input-data">
                    <input type="email" name="email" required><br>
                    <div class="underline"></div>
                    <label for="email">Email Address</label>
                </div>
                <div class="input-data">
                    <input type="text" name="username" required><br>
                    <div class="underline"></div>
                    <label for="username">Username</label>
                </div>
            </div>

            <div class="form-row">
                <div class="input-data">
                    <div class="underline"></div>
                    <input type="text" name="address_no" placeholder="No" required> <br>
                    <div class="underline"></div>
                    <input type="text" name="address_street" placeholder="Street" required> <br>
                    <div class="underline"></div>
                    <input type="text" name="address_city" placeholder="City" required> <br>
                </div>
                <div class="input-data">
                    <label for="gender">Gender</label> <br> <br>
                    <select name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select> <br>
                </div>
            </div>
            
            <br> 
            <br> 
            <br>

            <div class="form-row">
                <div class="input-data">
                    <input type="date" name="dob" required><br>
                </div>
                <div class="input-data">
                    <input type="password" name="password" placeholder="" required><br>
                    <div class="underline"></div>
                    <label for="password">Password</label>
                </div>
                
            </div>

            <div class="form-row">
                <div class="input-data">
                    
                    <input type="password" name="confirm_password" required><br>
                    <label for="confirm_password">Confirm Password</label>
                </div>
            </div>

            <div class="form-row submit-btn">
                <div class="input-data">
                    <div class="inner"></div>
                    <input type="submit" value="Register">
                </div>
            </div> 
        </form>
    </div>

</body>
</html>