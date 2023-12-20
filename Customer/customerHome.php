<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Home</title>
    <script>
        // Prevent going back to the login page
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
</head>
<body>
    <h2>Welcome to Customer Home Page</h2>

    <?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION["user_id"]) && isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "customers") {
        // Display the username
        echo "<p>Hello, " . $_SESSION["username"] . "!</p>";
    } else {
        // Redirect to the login page if not logged in
        header("Location: login.html");
        exit();
    }
    ?>

    <!-- Your customer home page content goes here -->

    <p>Customer-specific content...</p>

    <a href="/The Outer Clove restaurant/logout.php">Logout</a>
</body>
</html>
