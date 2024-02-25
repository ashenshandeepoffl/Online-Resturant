<?php
session_start();

// Database connection details
include 'dbConnection.php';

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
    <link rel="stylesheet" href="menuDetails.css">
</head>
<body>
    <div class="card">
        <div class="card__title">
            <div class="icon">
            <a href="menu.php"><i class="fa fa-arrow-left"></i></a>
            </div>
            <h3>New products</h3>
        </div>
        <div class="card__body">
        <div class="half">
          <div class="featured_text">
            <h1>Outer Clove</h1>
            <p class="sub"><?php echo $menu_row['name']; ?></p>
            <p class="price"><?php echo $menu_row['price']; ?></p>
          </div>
          <div class="image">
          <img src="/Restaurant/Admin/<?php echo $menu_row['image_url']; ?>" alt="<?php echo $menu_row['name']; ?>">
          </div>
        </div>
        <div class="half">
          <div class="description">
            <p> <?php echo $menu_row['long_description']; ?></p>
          </div>
          <span class="stock"><i class="fa fa-pen"></i> In stock</span>
          <div class="reviews">
          <h3>Comments</h3>
            <?php
                // Display comments for this menu item
                $comment_query = "SELECT * FROM comments WHERE menu_code = $menu_code";
                $comment_result = $conn->query($comment_query);

                if ($comment_result->num_rows > 0) {
                    while ($comment_row = $comment_result->fetch_assoc()) {
                        echo "<div class='comments'>";
                        echo "<strong>{$comment_row['username']}</strong>: {$comment_row['comment']}<br>";
                        echo "</div>";
                    }
                } else {
                    echo "No comments yet.";
                }?>
          </div>
        </div>
    </div>
    <div class="card__footer">
        <div class="action">
        <button type="button"><a href="login.php">Add to the cart</a></button>
        </div>
    </div>
    </div>


</body>
</html>

    