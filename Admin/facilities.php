<?php
include 'dbConnection.php';

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        // Add new facility
        $facility_name = $_POST['facility_name'];
        $seating_capacity = $_POST['seating_capacity'];
        $parking_available = isset($_POST['parking_available']) ? 1 : 0;
        $availability_status = isset($_POST['availability_status']) ? 1 : 0;

        $sql = "INSERT INTO restaurant_facilities (facility_name, seating_capacity, parking_available, availability_status)
                VALUES ('$facility_name', $seating_capacity, $parking_available, $availability_status)";
        mysqli_query($conn, $sql);
    } elseif (isset($_POST['delete'])) {
        // Delete facility
        $facility_id = $_POST['facility_id'];

        $sql = "DELETE FROM restaurant_facilities WHERE id = $facility_id";
        mysqli_query($conn, $sql);
    }
}

// Retrieve facilities from the database
$sql = "SELECT * FROM restaurant_facilities";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Restaurant Facilities</title>
</head>
<body>
    <h1>Admin - Restaurant Facilities</h1>

    <!-- Add New Facility Form -->
    <h2>Add New Facility</h2>
    <form action="" method="post">
        <label for="facility_name">Facility Name:</label>
        <input type="text" name="facility_name" required><br>

        <label for="seating_capacity">Seating Capacity:</label>
        <input type="number" name="seating_capacity" required><br>

        <label for="parking_available">Parking Available:</label>
        <input type="checkbox" name="parking_available"><br>

        <label for="availability_status">Availability Status:</label>
        <input type="checkbox" name="availability_status"><br>

        <input type="submit" name="add" value="Add Facility">
    </form>

    <!-- List of Facilities -->
    <h2>Facilities List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Facility Name</th>
            <th>Seating Capacity</th>
            <th>Parking Available</th>
            <th>Availability Status</th>
            <th>Action</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['facility_name'] . "</td>";
            echo "<td>" . $row['seating_capacity'] . "</td>";
            echo "<td>" . ($row['parking_available'] ? 'Yes' : 'No') . "</td>";
            echo "<td>" . ($row['availability_status'] ? 'Available' : 'Not Available') . "</td>";
            echo "<td>
                    <a href='edit_facility.php?id=" . $row['id'] . "'>Edit</a>
                    <form action='' method='post'>
                        <input type='hidden' name='facility_id' value='" . $row['id'] . "'>
                        <input type='submit' name='delete' value='Delete' onclick='return confirm(\"Are you sure?\")'>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
