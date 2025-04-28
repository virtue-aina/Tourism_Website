<?php
include 'setSession.php';
?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChateauTours</title>
 <!-- goggle font -->
 <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@500;700;900&display=swap" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@500;700;900&display=swap" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Red+Hat+Display:wght@500;700;900&display=swap" rel="stylesheet">

 <!-- google  icons -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">

 <!-- stylesheet -->
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
       
       <!-- alternate nav links if logged in -->
       <?php
       if(isset($_SESSION['id']))
       {
        echo '<li class="links"><a class="items-right" href="myprofile.php">My Profile</a></li>';
           
        echo '<li class="links"><a class="items-right" href="logout.php">Logout</a></li>';
         
       }
       else
       {
        echo '<li class="links"><a class="items-right" href="login.php">Login</a></li>';
        echo '<li class="links"><a class="items" href="signup.php">Get Started</a></li>';
       }
       
       ?>
       
     </ul>

    </nav>
 </header>
 <section data-scroll-section>
    <div>
        
 <?php if (isset($_SESSION['username'])) : ?>

   <p id="welcomemessage"> Welcome <?=  $username = htmlspecialchars($_SESSION['username']) ?>, Lets create memories!</p>
  
   <?php endif; ?>  
    </div> 
  </section>
  
  <main id="cover" data-scroll-section>
    <div class="hero-section">
      <div class="bottom-layer">
        <h1 class="invitation scroll-text" data-scroll data-scroll-speed="1.5">INTERESTED IN A LITTLE OPULENCE IN PARIS?</h1>
        <a href="excursionlist.php" class="book scroll-text" data-scroll data-scroll-speed="0.8">See Destinations!</a>
      </div>
      <h2 class="action scroll-text" data-scroll data-scroll-speed="-1.2">Explore The Palace of Versailles</h2>
    </div>
  </main>

  <section class="packages" data-scroll-section>
    <h4 class="package-title" data-scroll data-scroll-speed="0.3">UPCOMING PACKAGES</h4>
    
    <div class="package-items">
        <div class="package-a" data-scroll data-scroll-speed="0.2">
            <img src="../assets/images/image1.jpg" alt="A photo of a woman and a statue enclosed by two golden pillars at the background of the center of the frame. At the foreground of the image,there is a chandelier at the center with a crowd departing the frame at both sides, leaving the aforementioned woman alone as the subject of the photo." class="package-display">
            <ul class="packages">
                <li class="deal">Palace for two</li>
                <li class="package-list">Just you, Your significant other
                    and a tour guide at the palace.</li>
                <li class="price">$799.99</li>
            </ul>
        </div>

        <div class="package-b" data-scroll data-scroll-speed="0.3">
            <img src="../assets/images/image2.jpg" alt="An image of a Brown long hall with tourists viewing artefacts at both sides. Chandeliers are above the heads of the crowd at the palace with paintings on the ceilings, they do not have a tourist guide. " class="package-display">
            <ul class="packages">
                <li class="deal">The Audiovisual Expierience</li>
                <li class="package-list">Enjoy our digital tour guide,
                    every step you take.</li>
                <li class="price">$299.99</li>
            </ul>
        </div>

        <div class="package-c" data-scroll data-scroll-speed="0.4">
            <img src="../assets/images/image3.jpg" alt="An image showing a white statue of a King and Horse with gold at the fringes of their garments. The statue is mounted above what appears to be an entrance." class="package-display">
            <ul class="packages">
                <li class="deal">Royal Treatment</li>
                <li class="package-list"> Enjoy Chariot rides to and from the palace 
                    with a gourmet lunch.</li>
                <li class="price">$599.99</li>
            </ul>
        </div> 
    </div>
 </section>


 <footer data-scroll-section>
    <hr class="bottom-line">

    <ul class="nav-items" >
      <li class="links"><a href="" class="items">Contact</a></li>
      <li class="links"><a href="../assets/KF7013report.pdf" class="items">Security Report</a></li>
      <li class="links"><a href="" class="items">FAQs</a></li>
    </ul>
 </footer>
    
 <!-- Locomotive Scroll JS -->
 <script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.3/dist/locomotive-scroll.min.js"></script>
 <script src="../assets/locomotive-scroll.js"></script>
 <script src="../assets/animations.js"></script>
 <script>
   // Additional initialization to ensure scroll works
   document.addEventListener('DOMContentLoaded', function() {
     // Force update after a short delay to ensure everything is loaded
     setTimeout(function() {
       if (typeof LocomotiveScroll !== 'undefined' && window.scroll) {
         window.scroll.update();
       }
     }, 500);
   });
 </script>
 </body>
</html> 