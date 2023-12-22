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
</head>
<body>

<h1>Add/Update/Delete Meanu iteam</h1> 
<a href="meanuDetails.php">Click Here</a>

<h1>View/Update Online Reservations</h1>
<a href="viewReservation.php">Click Here</a>

<h1>View/Update Online Orders</h1>
<a href="adminOrders.php">Click Here</a>

<h1>View/Delete users</h1>
<a href="view_users.php">Click Here</a>


<a href="/Restaurant/logout.php">Logout</a> <hr>
</body>
</html>