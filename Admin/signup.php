<?php
// Database connection details
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
        header("Location:\Restaurant\login.php");
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
</head>
<body>
    <h2>User Registration</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required><br>

        <label for="email">Email Address:</label>
        <input type="email" name="email" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address_no" placeholder="No" required>
        <input type="text" name="address_street" placeholder="Street" required>
        <input type="text" name="address_city" placeholder="City" required><br>

        <label for="gender">Gender:</label>
        <select name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
