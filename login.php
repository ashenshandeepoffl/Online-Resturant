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
                    header("Location: Owner/ownerHome.php");
                    break;
                default:
                    // Handle other user types or roles
                    break;
            }
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
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
    <title>Login Form</title>
    <script>
        function preventBack(){window.history.forward()};
            setTimeout("preventBack()",0);
            window.onunload function(){null;}
    </script>
    
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
        <div class="text">Login</div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-row">
                <div class="input-data">
                    <input type="text" name="username" required><br>
                    <div class="underline"></div>
                    <label for="username">Username</label>
                </div>
            </div>

            <div class="form-row">
                <div class="input-data">
                    <input type="password" name="password" required autocomplete="off"><br>
                    <div class="underline"></div>
                    <label for="password">Password</label>
                </div>
            </div>

            <div class="form-row submit-btn">
                <div class="input-data">
                    <div class="inner"></div>
                    <input type="submit" value="Login">
                </div>
            </div> 

            <p>Don't have an account? <a href="signup.php">Sign in now</a></p>

        </form>
    </div>
</body>
</html>

