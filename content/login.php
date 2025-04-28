<?php

session_start();
include 'db_conn.php';
include 'header login_signup.php';
if (isset($_POST['submit'])) 
{

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pword = mysqli_real_escape_string($conn, $_POST['password']);
    $pwordhash = password_hash($pword, PASSWORD_DEFAULT);

    if (empty($_POST['username']) || empty($_POST['password'])) 
    {

        header('location:./login.php?result=emptyinput');
        exit();

    } 
    else 
    {
        if (isset($_POST['username'])) 
        {
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, $sql)) 
            {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                if (!$row) 
                {
                    header('location:./login.php?result=invalidinput');
                    exit();

                }
                 else {
                    $checkpword = password_verify($_POST['password'], $row['pwordhash']);      
                          if  (!$checkpword)
                          {
                            header('location:./login.php?result=invalidinput');
                            exit();
                        }  
                         else 
                         { // stores the user's ID and username in the session
                           
                           $_SESSION['id'] = $row['id'];
                           $_SESSION['username'] = $row['username'];
                            // redirects the user to the index page
                            header("location:./index.php");
                         exit();
                           
                        }
                }

                }

            }
        }

    }
//}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="KF7013/assets/style.css" rel="stylesheet">
    </head>
    <body>
        <section>
    <div class="login-container">
    <form  action="" method="POST" >
    <h2>Login</h2>
    <div>
            <span>
            <?php
                    if (isset($_GET['result']))
                    {
                        if ($_GET['result'] == "emptyinput")
                        {
                            echo "<p>fields cannot be empty!<p>";
                        }
                        else
                        {
                            if ($_GET['result'] == "invalidinput")
                        {
                            echo "<p>Wrong username or password<p>";
                        }
                        }
                    }
                    ?>
            </span>
            </div>
            <div >
           <p><label for="username">Username</label></p>
           
            <div><input type="text" name="username" placeholder="Username"
            value ="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';?>"  size="25" accesskey="">
             
        </div>
        <div>
            <label for="password">Enter password</label>
            <div>
           
            <input type="password" name="password" placeholder="Password"
              value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';?>" size="25" accesskey="">
           
        </div>
        <div >
           <button type="submit" value="login" name="submit" accesskey="">Login</button>
        </div>
        <div>
            <span>
                <p>
                    no account? <a href="signup.php" >sign up</a>
                </p>
            </span>
        </div>
</div>
</section>
    </form> 
    </body>
</html>











