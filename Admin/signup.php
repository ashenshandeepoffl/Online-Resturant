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
    $user_type = "admin";

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
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="topnav">
        <a href="adminHome.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="viewReservation.php">Reservations</a>
        <a href="adminOrders.php">Orders</a>
        <a href="view_users.php">Users</a>
        <a href="facilities.php">Outlets</a>
        <a href="ManagePromotions.php">Promotions</a>
        <a class="active" href="signup.php">New Admins</a>
        <a href="/Restaurant/logout.php">Logout</a>
    </div>

    <h1>New Admin Form</h1>

    <div class="menueDeatilsForm">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <input type="text" name="first_name" required> <br>
            <label for="first_name">First Name</label>

            <input type="text" name="last_name" required> <br>
            <label for="last_name">Last Name</label>

            <input type="email" name="email" required> <br>
            <label for="email">Email Address</label>

            <input type="text" name="username" required>
            <label for="username">Username</label>

            <input type="text" name="address_no" placeholder="No" required> 
            <label for="address">Address No</label>
            <input type="text" name="address_street" placeholder="Street" required>
            <label for="address">Address Stress</label>
            <input type="text" name="address_city" placeholder="City" required> 
            <label for="address">Address City</label><br> <br>

            <select name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <label for="gender">Gender</label>
           
            <input type="date" name="dob" required> <br>
            <label for="dob">Date of Birth</label>

            <input type="password" name="password" placeholder="" required> <br>
            <label for="password">Password</label>

            <input type="password" name="confirm_password" required> <br>
            <label for="confirm_password">Confirm Password</label>

            <input type="submit" value="Register" class="register">
            <br> <br>
        </form>
    </div>

</body>
</html>