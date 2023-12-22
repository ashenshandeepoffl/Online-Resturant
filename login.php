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
</head>
<body>
    <h2>User Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
