<?php
include 'db_conn.php';
include 'header.php';
include 'restrictedaccess.php';
// Get the excursion ID from the URL

    $excursionID = $_GET['excursionID'];


// Query the database to get the excursion information
$sql = "SELECT * FROM excursions WHERE excursionID = '$excursionID';";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

// Display the excursion information
echo '<div class="container" data-scroll-section>';
echo '<div class="excursion-info" data-scroll data-scroll-speed="0.3">';
echo '<img src="../assets/images/'. $row['images']. '"  width="650px">'; 
echo '<h2>' . $row['excursion_name'] . '</h2>';
echo '<p>' . $row['description'] . '</p>';
echo '<p> $' . $row['price'] . '</p>';
echo '<p>' . $row['location'] . '</p>';
echo '</div>';
echo '</div>';

// Check if the form was submitted

if (isset($_POST['submit'])) 
{

if(empty($_POST(['excursion_date'])) || empty(($_POST(['tickets'])))|| empty(($_POST(['booking_notes']))))
{
        $error = 'fields cannot be empty';
}
else
{
        header('location:./booking.php');
}
}     ?>
         
         <!DOCTYPE html> 
<html>
  <head>
    <meta charset='utf-8'>
    <title>Book Excursion</title>
  </head>
  <body data-scroll-section>
    <form method="post" action="booking.php" data-scroll data-scroll-speed="0.2">
      <!-- Excursion ID value is passed as a hidden field -->
      <input type="hidden" name="excursionID" value="<?php echo $excursionID; ?>">

      <!-- Excursion date input -->
      <label for="excursion_date">Excursion Date</label>
      <input type="date" min='<?php echo date("Y-m-d"); ?>' name="excursion_date" >

      <!-- Number of tickets input -->
      <br>
      <label for="tickets">Number of Tickets</label>
      <input type="number" min="1" name="tickets">

      <!-- Booking notes textarea -->
      <br>
      <label for="booking_notes">Booking Notes</label>
      <textarea name="booking_notes" id="booking_notes" ></textarea>

      <!-- Submit button -->
      <br>
      <input type="submit" name="submit" value="Book" >
    </form>
  </body>
</html>


  <!-- <p><//?php// echo $error; ?></p> -->
  
 </body>
 </html>


