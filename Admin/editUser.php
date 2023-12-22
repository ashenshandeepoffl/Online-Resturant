<?php
// Include database connection
include 'dbConnection.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $edit_user_query = "SELECT * FROM users WHERE id = $user_id";
    $edit_user_result = $conn->query($edit_user_query);

    if ($edit_user_result->num_rows == 1) {
        $edit_user_row = $edit_user_result->fetch_assoc();
    } else {
        // Redirect to adminHome.html if user not found
        header("Location: adminHome.html");
        exit();
    }
} else {
    // Redirect to adminHome.html if id is not provided
    header("Location: adminHome.html");
    exit();
}
?>

<form action="updateUser.php" method="post">
    <!-- Add input fields for updating user details -->
    <input type="submit" value="Update User">
</form>
