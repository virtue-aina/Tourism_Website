<?php 
include './db_conn.php';
include 'header signup.php';
$fname_error = $lname_error = $username_error = $pword_error = $cpword_error  = $verifyusernameerror = '';

if (isset($_POST['submit'])) 
{ //firstname
    if (empty($_POST['fname'])) {
        $fname_error = "First name is needed.";
    } else {
        $fname = htmlspecialchars($_POST['fname']);


        if (!preg_match("/^[a-zA-Z]*$/", $fname)) {
            $fname_error = "no special characters allowed.";
        }

    }

    //last name
    if (empty($_POST['lname'])) {
        $lname_error = "Last name is needed.";
    } else {

        $lname = htmlspecialchars($_POST['lname']);

        if (!preg_match("/^[a-zA-Z]*$/", $lname)) {
            $lname_error = "no special characters allowed.";
        }

    }

    //check username
    if (empty($_POST['username'])) 
    {
        $username_error = "please create a username.";
    }
     else {
        $username = htmlspecialchars($_POST['username']);
        
        if (!preg_match("/^[a-zA-Z-']*$/", $_POST['username'])) 
        {
            $username_error = "Username can only contain letters, hyphens, and apostrophes.";
        } 
        else 
        {
            // ////////check if username already exists
            $sqlusernameverify = "SELECT * FROM users WHERE username = ? ";
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, $sqlusernameverify)) 
            {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_fetch_assoc($result))
                {
                    $verifyusernameerror = "username already exists.";
                }
            }
        }
    }

        //password 

        if (empty($_POST['password'])) {
            $pword_error = "Please create a password.";
        } else {
            $pword = htmlspecialchars($_POST['password']);
            if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{10,}$/", $pword)) {
                $pword_error = "Password is not strong!";
            } else {
                if ($pword !== $_POST['cpassword']) {
                    $cpword_error = "Password does not match.";
                }
            }
        }

    if (!($fname_error || $lname_error || $username_error || $pword_error || $cpword_error || $verifyusernameerror)) 
      {




        //Connect to database
        if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['cpassword'])) {

            $fname = mysqli_real_escape_string($conn, $_POST['fname']);
            $lname = mysqli_real_escape_string($conn, $_POST['lname']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $pword = mysqli_real_escape_string($conn, $_POST['password']);
            $pwordhash = password_hash($pword, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users ( firstname, lastname, username, pwordhash ) 
            VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssss", $fname, $lname, $username, $pwordhash);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                   header('location:./signup.php?result=success');
                   exit();
            } else {
                header('location:./signup.php?result=failed');
                exit();
            }


        }
    }
        
} 

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./assets/excursions.css" rel="stylesheet">
    </head>
    <body>
        <section class ="signup-container" >
        <h2>Sign up</h2>
        <div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  method="POST" >
        
        <div>
        
            <p><label for="fname">First Name</label></p>
            <div>
            <span>
                <p>
                    <?php 
                
                    echo  $fname_error;
                    ?>
                </p>
            </span>
            </div>
            <input type="text" name="fname" placeholder="First Name" 
            value="<?php echo isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : ''; ?>" size="25" accesskey="">

            
        </div>
        <div>
            <p><label for="lname">Last Name</label></p>
            <div>
            <span>
                <p>
                    <?php 
               echo  $lname_error;
                    ?>
                </p>
            </span>
            </div>
            <input type="text" placeholder="Last Name" name="lname" 
            value="<?php echo isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : ''; ?>" size="25" accesskey="">

             
        </div>
        <div>
            <p><label for="username">Create a username</label></p>
            <div>
            <span>
                <p>
                    <?php 
                   echo $username_error;
                    echo $verifyusernameerror;
                    ?>
                </p>
            </span>
            </div>
            <input type="text" placeholder="username" name="username" 
            value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
            size="25" accesskey="" >
           
        </div>
        <div>
            <p>Password should have:<p>
              <li>at least one uppercase letter</li>
            <li>at least one lowercase</li>
            <li>at least one numeric character</li>
            <li> at least one special character</li>
            <li>a minimum of 10 characters</li>
        </div>
        <div>
            <p><label for="password">Create a password</label></p>
            <div>
            <span>
                <p>
                    <?php 
                    echo $pword_error;
                    ?>
                </p>
            </span>
            </div>
            <input type="password"  placeholder="" name="password" 
            value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>"
            size="25" accesskey="" >
        </div>
        <div>
            <label for="cpassword">Confirm password</label>
            <div>
            <span>
                <p>
                    <?php 
                    echo $cpword_error
                    ?>
                </p>
            </span>
            </div>
            <input type="password" placeholder="" name="cpassword"
             value="<?php echo isset($_POST['cpassword']) ? htmlspecialchars($_POST['cpassword']) : ''; ?>" size="25" accesskey="">

        </div>
        <div>
               
            <button type="submit" value="submit" name="submit">Sign Up</button>
            <div>
            <span>
                <p>
                    <?php
                    if (isset($_GET['result']))
                    {
                        if ($_GET['result'] == "success")
                        {
                            echo "<p>sign up sucessfull!</p>";
                            echo "<p>you can now login</p>";
                        }
                        else
                        {
                            if ($_GET['result'] == "failed")
                        {
                            echo "<p>Something went wrong, please try again!<p>";
                        }
                        }
                    }
                    ?>
                </p>
            </span>   
        </div>
    </form>
</section>
        </div>
    </body>
</html>