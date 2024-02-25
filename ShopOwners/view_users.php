<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Users</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
<link rel="stylesheet" href="home.css">
</head>
<body>

    <div class="topnav">
        <a href="adminHome.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="viewReservation.php">Reservations</a>
        <a href="adminOrders.php">Orders</a>
        <a href="facilities.php">Outlets</a>
        <a href="ManagePromotions.php">Promotions</a>
        <a href="signup.php">New ShopOwners</a>
        <a href="/Restaurant/logout.php">Logout</a>
    </div>

    <?php
        include 'welcomeName.php';
    ?>

    <h1>All Users</h1>

    <!-- Search Box -->
    <form action="" method="post" id="searchForm">
        <input type="text" name="search" id="searchInput" placeholder="Enter username or email">
        <input type="submit" value="Search">
    </form>

    <?php
    // Database connection details
    include 'dbConnection.php';
    
    // Check if the search form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search = $_POST['search'];

        // Query to search for users
        $search_query = "SELECT * FROM users WHERE username LIKE '%$search%' OR email LIKE '%$search%'";
        $result = $conn->query($search_query);

        if ($result->num_rows > 0) {
            echo "<h3>Search Results:</h3>";
            displayUsersTable($result);
        } else {
            echo "<p>No results found.</p>";
            $all_users_query = "SELECT * FROM users";
            $result = $conn->query($all_users_query);

            if ($result->num_rows > 0) {
                displayUsersTable($result);}
        }
    } else {
        // Query to get all users
        $all_users_query = "SELECT * FROM users";
        $result = $conn->query($all_users_query);

        if ($result->num_rows > 0) {
            echo "<h3>All Users</h3>";
            displayUsersTable($result);
        } else {
            echo "<p>No users found.</p>";
        }
    }

    // Function to display users in a table
    function displayUsersTable($result) {
        echo "<table>";
        echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Username</th><th>Address</th><th>Gender</th><th>DOB</th><th>User Type</th><th>Action</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['first_name']}</td>";
            echo "<td>{$row['last_name']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['address']}</td>";
            echo "<td>{$row['gender']}</td>";
            echo "<td>{$row['dob']}</td>";
            echo "<td>{$row['user_type']}</td>";
            echo "<td><a href='deleteUser.php?id={$row['id']}'>Delete</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>

</body>
</html>
