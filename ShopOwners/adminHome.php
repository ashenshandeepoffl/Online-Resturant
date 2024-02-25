<?php
    include 'welcomeName.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function () {
            window.history.pushState(null, "", window.location.href);
        };
    </script>
    <title>Admin Home</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <div class="hero-image">
        <div class="hero-text">
            <h1>The Outer Clove Restaurant ShowOwners Panel</h1>
            <p>Quality Food from a quality kitchen</p>
            <p>Scroll Down ↡</p>
        </div>
    </div>

<div class="container">

    <div>
        <div class="dashbordCard">
            <div class="wrap">
                <span class="dashbordCardCount">Menus</span>
                <h1 class="dashbordCardTitle"><a href="menu.php">Click Here</a></h1>
            </div>
        </div>
    </div>

    <div>
        <div class="dashbordCard">
            <div class="wrap">
                <span class="dashbordCardCount">Reservations</span>
                <h1 class="dashbordCardTitle"><a href="viewReservation.php">Click Here</a></h1>
            </div>
        </div>
    </div>

    <div>
        <div class="dashbordCard">
            <div class="wrap">
                <span class="dashbordCardCount">Orders</span>
                <h1 class="dashbordCardTitle"><a href="adminOrders.php">Click Here</a></h1>
            </div>
        </div>
    </div>

    <div>
        <div class="dashbordCard">
            <div class="wrap">
                <span class="dashbordCardCount">Outlets</span>
                <h1 class="dashbordCardTitle"><a href="facilities.php">Click Here</a></h1>
            </div>
        </div>
    </div>

    <div>
        <div class="dashbordCard">
            <div class="wrap">
                <span class="dashbordCardCount">Promotions</span>
                <h1 class="dashbordCardTitle"><a href="ManagePromotions.php">Click Here</a></h1>
            </div>
        </div>
    </div>

    <div>
        <div class="dashbordCard">
            <div class="wrap">
                <span class="dashbordCardCount">New ShowOwners</span>
                <h1 class="dashbordCardTitle"><a href="signup.php">Click Here</a></h1>
            </div>
        </div>
    </div>

    <div>
        <div class="dashbordCard">
            <div class="wrap">
                <span class="dashbordCardCount">Logout</span>
                <h1 class="dashbordCardTitle"><a href="/Restaurant/logout.php">Logout</a></h1>
            </div>
        </div>
    </div>
    
</div>
</body>
</html>