<?php
session_start();

include 'dbConnection.php';

// Process login form data when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // SQL query to retrieve user data
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Password is correct, set session variables
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_type"] = $row["user_type"];
            $_SESSION["username"] = $row["username"];

            // Redirect based on user type
            switch ($_SESSION["user_type"]) {
                case "admin":
                    header("Location: Admin/adminHome.php");
                    break;
                case "customers":
                    header("Location: Customer/customerHome.php");
                    break;
                case "shopOwner":
                    header("Location: ShopOwners/shopOwnersHome.php");
                    break;
                default:
                    // Handle other user types or roles
                    break;
            }
            exit();
        } else {
            echo '<script language="javascript">';
            echo 'alert("Invalid password")';
            header("Location: invalid.html");
            echo '</script>';

        }
    } else {
        echo '<script language="javascript">';
        echo 'alert("User not found")';
        header("Location: userNotFound.html");
        echo '</script>';
    }
}

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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
</head>
<body>

    <div class="topnav">
        <a href="home.php">Home</a>
        <a href="promotions.php">Promotions</a>
        <a href="menu.php">Menu</a>
        <a href="aboutus.html">About</a>
        <a href="gallery.html">Gallery</a>
        <a class="active" href="login.php">Login</a>
    </div>

    <div class="body2">
        <div class="container" id="container">
            <div class="form-container sign-up">
                <form name ="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
                    <h1>Create Account</h1>
                    <!-- <span>Add your person details with us</span> -->
                    <input type="text" name="first_name" placeholder="First Name">
                    <input type="text" name="last_name" placeholder="Last Name">
                    <input type="email" name="email" placeholder="Email">
                    <input type="text" name="username" placeholder="Username">
                    <input type="text" name="address_no" placeholder="Address Number" > 
                    <input type="text" name="address_street" placeholder="Address Street" >
                    <input type="text" name="address_city" placeholder="Address City" > 
                    <select name="gender" >
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <input type="date" name="dob" placeholder="Date of Birth">
                    <input type="password" name="password" placeholder="Password" > 
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                    <button>Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <h1>Sign In</h1>
                    <span>Use your username & password</span>
                    <input type="text" name="username">
                    <input type="password" name="password" autocomplete="off">
                    <a href="#">Forget Your Password?</a>
                    <button>Sign In</button>
                </form>
            </div>
            <div class="toggle-container">
                <div class="toggle">
                    <div class="toggle-panel toggle-left">
                        <h1>Welcome Back!</h1>
                        <p>Enter your personal details to use all of site features</p>
                        <button class="hidden" id="login">Sign In</button>
                    </div>
                    <div class="toggle-panel toggle-right">
                        <h1>Hello, Friend!</h1>
                        <p>Register with your personal details to use all of site features</p>
                        <button class="hidden" id="register">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer">
            <div class="row social-icons">
                <a href="#" class="icon"><i class="fa fa-facebook"></i></a>
                <a href="#" class="icon"><i class="fa fa-instagram"></i></a>
                <a href="#" class="icon"><i class="fa fa-youtube"></i></a>
                <a href="#" class="icon"><i class="fa fa-twitter"></i></a>
            </div>
            
            <div class="row footer-links">
                <ul>
                    <li><a href="aboutus.html">Contact us</a></li>
                    <li><a href="home.php">Our Services</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Career</a></li>
                </ul>
            </div>
            
            <div class="copyright">
                &copy; 2024 The Outer Clove Restaurant - All rights reserved  
            </div>
        </div>
    </footer>
    
    <script src="script.js"></script>
</body>
</html



