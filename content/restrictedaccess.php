<?php
// Check if the user is logged in
if (!isset($_SESSION['username']) || !$_SESSION['id'])
{
  // Display the restricted access message
  echo '<div class="restricted-access" data-scroll-section>';
  echo '<h1 data-scroll data-scroll-speed="0.2">Privileged Access</h1>';
  echo '<p data-scroll data-scroll-speed="0.3">Please login page to access this page, redirecting in 4 seconds...</p>';
  echo '</div>';

  // Redirect to the login page after 5 seconds
  header("Refresh: 4; url=./login.php");
  exit;
}
?>