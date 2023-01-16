<?php
include 'db_conn.php';
include 'header.php';

$excursion_query = "SELECT * FROM excursions";
$excursion_data = mysqli_query($conn, $excursion_query);

//Use a while loop to iterate through the result set
while ($excursion = mysqli_fetch_assoc($excursion_data)) {
 
  // Display the excursion details using div elements
  echo '<div class="excursion">';
  echo '<img src="../assets/images/'. $excursion['images']. '" >';
  echo '<alt="'. $excursion['excursion_name']. '" >';
  echo '<div>';
  echo '<h2>'  . $excursion['excursion_name'] . '</h2>';
  echo '<p>' . $excursion['description'] . '</p>';
  echo '<p>Price: '  . $excursion['price'] .'</p>';
  echo '<p>Location: '   . $excursion['location'] . '</p>';
  echo '<button><a href="./excursiondetails.php?excursionID='. $excursion['excursionID'].'">View Excursion</a></button>';
  echo '</div>';
  echo '</div>';
  
}







include './footer.php';
?>

