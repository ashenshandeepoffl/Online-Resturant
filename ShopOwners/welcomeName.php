<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Back</title>

    <style>
        .alert {
            background-color: #c1ffff;
            color: #019b98;
            margin: 10px;
            border-radius: 10px;  
            text-align: center;  
        }

        .closebtn {
            margin-left: 500px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: #014e60;
        }
    </style>

</head>
<body>
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <?php
            // Start the session
            session_start();

            // Check if the user is logged in
            if (isset($_SESSION["user_id"]) && isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "shopOwner") {
                // Display the username

                echo "<h4>Welcome Back, " . $_SESSION["username"] . "!</h4>"; 
            } else {
                // Redirect to the login page if not logged in
                header("Location: login.php");
                exit();
            }
        ?>
    </div>
</body>
</html>
