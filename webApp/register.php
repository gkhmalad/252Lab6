<?php
    include 'DatabaseConnection.php';
    $dbConnection = DatabaseConnection::getInstance()->getConnection();
    session_start();
    $error = "";
    $password = "";
    $username = "";
    $passwordRe = "";
    $email = "";
    if($_POST){
        !$_POST['username'] ? $error .= "A username is required to register.<br>" : $username = $_POST['username'];
        !$_POST['password'] ? $error .= "A password is required to register.<br>" : $password = $_POST['password'];
        !$_POST['repassword'] ? $error .= "Please repeat the password.<br>" : $passwordRe = $_POST['repassword'];
        !$_POST['email'] ? $error .= "An email is required to register.<br>" : (($_POST['email'] && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false) ? $error .= "Invalid email address.<br>" : $email = $_POST['email']);
        ($_POST['password'] && $_POST['repassword'] && ($_POST['repassword'] != $_POST['password'])) ? $error.= "The passwords do not match" : true;
        if($error != ""){
            $error = '<div class="signin-error" style="color:red;"><strong>Error:</strong><br>'.$error.'</div>';
        }else{
            $query = "SELECT * FROM users WHERE `username` = '".$username."'";
            if($result = mysqli_query($dbConnection, $query)){
                $row = mysqli_fetch_array($result);
                if(mysqli_num_rows($result)!=0 && $row['email'] = $email){
                    $error = '<div class="signin-error" style="color:red;"><strong>Error:</strong><br>A user with this email already exists.</div>';
                }else{
                    $query = "INSERT INTO `users` (`email`, `password`, `username`) VALUES ('".$email."', '".$password."', '".$username."')";
                    mysqli_query($dbConnection, $query);
                    $error = '<div class="signup-success" style="color:green;"><p>Sign Up Success!</p></div>';
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <link rel='icon' href="favicon.ico" type='image/x-icon'>
      <title>Register</title>
    </head>
    <body>
        <div class="top-bar">
            <h1>Register</h1>
            <hr>
        </div>
      <div class="register-form">
          <div class="err">
              <?php echo $error; ?>
            </div>
          <form method="POST">
              <input type="text" placeholder="Enter username" name="username">
              <br>
              <input type="text" placeholder="Enter email" name="email">
              <br>
              <input type="password" placeholder="Enter password" name="password">
              <br>
              <input type="password" placeholder="Re-enter password" name="repassword">
              <br>
              <input type="submit" value="Register">
          </form>
      </div>
      <div class="register">
          <p>Already Have an Account?</p>
          <a href="index.php">Log In</a>
      </div>
      <div class="bottom-bar">
          <hr>
      </div>
    </body>
</html>