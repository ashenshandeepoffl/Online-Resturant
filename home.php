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
    <title>The Outer Clove restaurant</title> 
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="topnav">
        <a class="active" href="home.php">Home</a>
        <a href="promotions.php">Promotions</a>
        <a href="menu.php">Menu</a>
        <a href="aboutus.html">About</a>
        <a href="login.php">Login</a>
    </div>

     <!-- Slideshow container -->
    <div class="slideshow-container">

        <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <img src="/Restaurant/Images/1.jpg" style="width:100%">
        <div class="text"></div>
        </div>
    
        <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="/Restaurant/Images/2.jpg" style="width:100%">
        <div class="text"></div>
        </div>
    
        <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img src="/Restaurant/Images/3.jpg" style="width:100%">
        <div class="text"></div>
        </div>
    
        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>
    
    <!-- The dots/circles -->
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div> 

    <h1 class="topics">Our Services</h1>

    <div class="card-container">
        <div class="card">
          <img src="/Restaurant/Images/dinning.jpg" alt="Avatar" style="width:100%">
          <div class="container">
            <h4><b>Dinning</b></h4>
            <p>Some words...</p>
          </div>
        </div>
      
        <div class="card">
            <img src="/Restaurant/Images/ta.jpg" alt="Avatar" style="width:100%">
            <div class="container">
              <h4><b>Take Away</b></h4>
              <p>Some words...</p>
            </div>
        </div>
      
        <div class="card">
            <img src="/Restaurant/Images/online.jpg" alt="Avatar" style="width:100%">
            <div class="container">
              <h4><b>Online Reservaion</b></h4>
              <p>Some words...</p>
            </div>
        </div>
      
        <div class="card">
            <img src="/Restaurant/Images/food.jpg" alt="Avatar" style="width:100%">
            <div class="container">
              <h4><b>High Quality Foods</b></h4>
              <p>Some words...</p>
            </div>
        </div>
    </div>
    
    <h1 class="topics">Our Outlets</h1>

    <div class="card-container">
      <?php
      while ($row = mysqli_fetch_assoc($result)) {

        echo '<div class="card">';
          echo '<div class="container">';
            echo '<h2>' . $row['facility_name'] . '</h2>';
            echo '<p>Seating Capacity: ' . $row['seating_capacity'] . '</p>';
            echo '<p>Parking Availability: ' . ($row['parking_available'] ? 'Yes' : 'No') . '</p>';
          echo '</div>';
        echo '</div>';

      }?>
    <div> 
    <script src="Home.js"></script>
</body>
</html>