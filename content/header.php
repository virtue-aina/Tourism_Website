<?php
// Include 'setSession.php' script
include 'setSession.php';

?>
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChateauTours</title>

 <!-- Google font -->
 <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@500;700;900&display=swap" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@500;700;900&display=swap" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Red+Hat+Display:wght@500;700;900&display=swap" rel="stylesheet">

 <!-- Google icons -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">

 <!-- Stylesheet -->
 <link rel="stylesheet" href="../assets/excursions.css">
 
 <!-- Locomotive Scroll CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.3/dist/locomotive-scroll.min.css">
 </head>
 <body data-scroll-container>

 <header data-scroll-section>
    <nav class="nav-links">
         
     <ul class="nav-items">
       <li class="links"><a class="items-logo" href="">Château Tours</a></li>
       <li class="links"><a class="items" href="index.php">Home</a></li>
       <li class="links"><a class="items" href="excursionlist.php">Destinations</a></li>
       <li class="links"><a class="items" href="https://www.figma.com/file/J8HrJsG7ls8PfbWy1TY1xb/Untitled?node-id=0%3A1&t=wOBJLciiueLGUImI-1">Wireframes</a></li>

       <?php
            // If the user is logged in, display logout link
         if(isset($_SESSION['username']))
         {
           echo '<li class="links"><a class="items-right" href="logout.php">Logout</a></li>';
         }
         // Otherwise, display login and signup link
         else
         {
          echo '<li class="links"><a class="items-right" href="login.php">Login</a></li>';
          
          echo '<li class="links"><a class="items" href="signup.php">Get Started</a></li>';
         }
         
         ?>
     </ul>  
   </nav>
</header>    
  
  
  
  