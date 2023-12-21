<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "As+s01galaxysa";
$dbname = "Resturent";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch menu details based on menu_code
if (isset($_GET['menu_code'])) {
    $menu_code = $_GET['menu_code'];

    $menu_query = "SELECT * FROM menu_items WHERE menu_code = $menu_code";
    $menu_result = $conn->query($menu_query);

    if ($menu_result->num_rows == 1) {
        $menu_row = $menu_result->fetch_assoc();
    } else {
        // Redirect to customerHome.html if menu not found
        header("Location: customerHome.html");
        exit();
    }
} else {
    // Redirect to customerHome.html if menu_code is not provided
    header("Location: customerHome.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Details</title>
</head>
<body>
    <h2>Menu Details</h2>
    <img src="<?php echo $menu_row['image_url']; ?>" alt="<?php echo $menu_row['name']; ?>"><br>
    <strong>Name:</strong> <?php echo $menu_row['name']; ?><br>
    <strong>Price:</strong> <?php echo $menu_row['price']; ?><br>
    <strong>Description:</strong> <?php echo $menu_row['long_description']; ?><br>

    <!-- Comment Section -->
    <h3>Comments</h3>
    <?php
    // Display comments for this menu item
    $comment_query = "SELECT * FROM comments WHERE menu_code = $menu_code";
    $comment_result = $conn->query($comment_query);

    if ($comment_result->num_rows > 0) {
        while ($comment_row = $comment_result->fetch_assoc()) {
            echo "<div>";
            echo "<strong>{$comment_row['username']}</strong>: {$comment_row['comment']}<br>";
            echo "</div>";
        }
    } else {
        echo "No comments yet.";
    }
    ?>

    <!-- Comment Form -->
    <h3>Add a Comment</h3>
    <form action="addComment.php" method="post">
        <input type="hidden" name="menu_code" value="<?php echo $menu_code; ?>">
        <textarea name="comment" rows="4" cols="50" required></textarea><br>
        <input type="submit" value="Add Comment">
    </form>

    <!-- Order Form -->
    <h3>Place an Order</h3>
    <form action="placeOrder.php" method="post">
        <input type="hidden" name="menu_code" value="<?php echo $menu_code; ?>">
        <input type="number" name="quantity" min="1" value="1" required>
        <input type="submit" value="Place Order">
    </form>

</body>
</html>
