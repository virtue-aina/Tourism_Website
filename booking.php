<?php
include 'db_conn.php';
include 'header.php';
include 'restrictedaccess.php';

//retrieve data from post request
$excursion_date = $_POST['excursion_date'];
$tickets = $_POST['tickets'];
$booking_notes =mysqli_real_escape_string($conn, $_POST['booking_notes']);;
$excursionID = $_POST['excursionID'];
$customerID = $_SESSION['id'];

// Query the database to get the excursion information
$sql = "SELECT * FROM excursions WHERE excursionID = '$excursionID'";
$query = mysqli_query($conn, $sql);

// Check if the excursion was found
if ($query && $row = mysqli_fetch_assoc($query)) {
  $price = $row['price'];
} else {
  // Display error message if the excursion was not found
  echo 'Excursion not found';
}

//calculate number of tickets
$total_cost = (float)$price * (int)$tickets;
echo $total_cost;
$sql = "SELECT * FROM users WHERE id = '$customerID'";
$query = mysqli_query($conn, $sql);

// Get customer data
// Check if the customer was found
if ($query && $row = mysqli_fetch_assoc($query)) {
  //get customer data
  $customerID = $row['id'];
  $fname = $row['firstname'];
  $lname = $row['lastname'];
} else {
  // Display error message if the customer was not found
  echo 'Customer not found';
}

//Insert the booking into the database
$sql = "INSERT INTO booking (excursionID, customerID, fname, lname, excursion_date, tickets, total_cost, booking_notes) VALUES ('$excursionID','$customerID', '$fname', '$lname','$excursion_date', '$tickets', '$total_cost', '$booking_notes')";
$query = mysqli_query($conn, $sql);

// Check if booking was successfully added to database
if ($query) {
  echo "Booking was successful";
  // Retrieve the booking ID of the inserted booking
  $booking_id = mysqli_insert_id($conn);
  // Redirect the user to the confirmation page
  header("Location: ./ticketing.php?id=$booking_id");
} else {
  echo 'Booking was not successful';
  // Display error message
}

