<?php

include 'db_conn.php';
include 'header.php';

// check if the user is logged in
include 'restrictedaccess.php';
 
//set variables
$noticket = '';
$updatereport = '';

// retrieve the user's account information
$user_id = $_SESSION['id'];
$username = $_SESSION['username'];
$customerID = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE id = ? OR username = ?";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "is", $user_id, $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
}

$sql = "SELECT * FROM booking WHERE customerID  = ? ";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i",  $customerID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $bookingrow = mysqli_fetch_assoc($result);
    if (!$bookingrow['tickets']) {
       
        $noticket = 'you have no tickets!';
    }
}

    // check if the form to update the account information has been submitted
if (isset($_POST['submit'])) {

  if(isset($_POST['username']) && isset($_POST['password'])  ){
    
    $password = $_POST['password'];
    
    if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{10,}$/", $password)) {
        echo "Password is not strong.";

    } else {
        // get the new account information from the form
        $cleanedpassword = mysqli_real_escape_string($conn, $_POST['password']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $pwordhash = password_hash($cleanedpassword, PASSWORD_DEFAULT);
    }
    // update the user's account information in the database
    $sql = "UPDATE users SET pwordhash = ?, username = ? WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssi", $pwordhash, $username, $user_id);
            $check = mysqli_stmt_execute($stmt);
            if ($check) {
                $updatereport = "Update sucessful. Log back in!";
                header("Refresh: 6; url=./login.php");
                exit;
            } else {
                echo "something went wrong!";
            }
        } 
        {
            echo 'Sorry, you cant update just one field';
        }

    }
}

// check if the delete account button has been clicked
if (isset($_POST['delete']))
{
    // delete the user's account from the database
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        // redirect the user to the login page
        header('location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet">
</head>
<body data-scroll-section>
    <section>
        <div class="profile-container" data-scroll data-scroll-speed="0.3">
            <h2>My Profile</h2>
            <div>
                <p><label>Username:</label> <?php echo $row['username']; ?></p>
                <p><label>First Name:</label> <?php echo $row['firstname']; ?></p>
                <p><label>Last Name:</label> <?php echo $row['lastname']; ?></p>
                <p><label>No of Tickets:</label> <?php echo $noticket; echo $bookingrow['tickets']; ?></p>
               
            </div>
            <form action="" method="POST" data-scroll data-scroll-speed="0.2">
                <h3>Update Account Information</h3>
                <h2><?php echo $updatereport  ?></h2>            
                <p><label for="password">New Password:</label> <input  type="password" name="password" placeholder="New Password" ></p>
                <p><label for="username">New Username:</label> <input type="text" name="username" placeholder="New username" ></p>
                
                <button type="submit" name="submit" accesskey="">Update Information</button>
            </form>
            <form action="" method="POST" data-scroll data-scroll-speed="0.2">
                <h3>Delete Account</h3>
                <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                <button type="submit" name="delete" >Delete Account</button>
            </form>
        </div>
    </section>
</body>
</html>
