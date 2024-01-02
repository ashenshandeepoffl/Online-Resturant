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
            echo '<script language="javascript">';
            echo 'alert("Invalid password")';
            echo '</script>';
        }
    } else {
        echo '<script language="javascript">';
        echo 'alert("User not found")';
        echo '</script>';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <script src="validation.js"></script>
    <link rel="stylesheet" href="forms.css">
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

    <h2>Login</h2>

    <div class="reservationForm"> 
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <input type="text" name="username"><br>
            <label for="username">Username</label>

            <input type="password" name="password" autocomplete="off"><br>
            <label for="password">Password</label>

            <input type="submit" value="Login">
            <br> <br>
            <p>Don't have an account? <a href="signup.php"><b>Sign in now</b></a></p>
        </form>
    </div>

</body>
</html>

