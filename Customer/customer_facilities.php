<?php
include 'dbConnection.php';

// Retrieve facilities from the database
$sql = "SELECT * FROM restaurant_facilities WHERE availability_status = 1";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer - Restaurant Facilities</title>
</head>
<body>
    <h1>Customer - Restaurant Facilities</h1>

    <!-- List of Available Facilities -->
    <h2>Available Facilities</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Facility Name</th>
            <th>Seating Capacity</th>
            <th>Parking Available</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['facility_name'] . "</td>";
            echo "<td>" . $row['seating_capacity'] . "</td>";
            echo "<td>" . ($row['parking_available'] ? 'Yes' : 'No') . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    
</body>
</html>
