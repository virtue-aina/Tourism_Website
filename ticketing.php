
<?php

include 'db_conn.php';
include 'header.php';
include 'restrictedaccess.php';
if (isset($_GET['id'])) 
{
    // Get booking information from database
    $id = $_GET['id'];
    $sql = "SELECT * FROM booking WHERE bookingID = $id ";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
?>
    <!-- // Display booking information -->
    <div class ="ticket" >
    <h2>Ticket</h2>
    <p>Excursion:
        <?php 
            $excursionID = $row['excursionID'];
            $getExcursionName = "SELECT excursion_name FROM excursions WHERE excursionID = $excursionID";
             $queryName= mysqli_query($conn, $getExcursionName);
            //$queryName = $conn->query($getExcursionName);
            if (mysqli_num_rows($queryName) > 0) {
                $fetchName =  mysqli_fetch_assoc($queryName);
              //fetchname = $queryName->fetch_assoc();
                echo $fetchName['excursion_name'];
            }else{
                echo "Invalid Excursion ID submitted";
            }
        ?>
     </p>
    <p>Customer Name: <?= $row['fname'] . ' ' . $row['lname'] ?></p>
    <p>Excursion Date: <?= $row['excursion_date'] ?></p>
    <p>Number of Tickets: <?= $row['tickets'] ?></p>
    <p>Total Cost: $<?= $row['total_cost'] ?></p>
    <p>Booking Notes: <?= $row['booking_notes'] ?></p>
    </div>
<?php
}


?>