<?php
  include 'DatabaseConnection.php';
  //* $dbConnection = DatabaseConnection::getInstance()->getConnection();
  session_start();
  //? Variables
  $error = "";
  $password = "";
  $username = "";
  $fetchedPassword = "";
  //? If form was submitted
  if($_POST){
    //? Username field validation server-side
    if(!$_POST['username']){
      $error .= "A username is required to log in.<br>";
    }else{
      $username = $_POST['username'];
    }
    //? Password field validation server-side
    if(!$_POST['password']){
      $error .= "A password is required to log in.<br>";
    }else{
      $password = $_POST['password'];
    }

    //? Database check if validation passed
    if($error != ""){
      $error = '<div class="signin-error" style="color:red;"><strong>Error:</strong><br>'.$error.'</div>';
    }else{
      //? Connecting to database for credential validation
      $dbConnection = DatabaseConnection::getInstance()->getConnection();
      //? Querying the database with custom query
      $query = "SELECT * FROM users WHERE `username` = '".$username."'";
      if($result = mysqli_query($dbConnection, $query)){
        $row = mysqli_fetch_array($result);
        $fetchedPassword = $row['password'];
      }
      //? Actual validation code
      if($fetchedPassword == $password){
        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $row['userID'];
        //? Closing database connection
        mysqli_close($dbConnection);
        header("Location: ./profile.php");
      }else{
        $error = '<div class="signin-error" style="color:red;"><strong>Error:</strong><br>Incorrect Credentials!</div>';
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel='icon' href="favicon.ico" type='image/x-icon'>
        <title>Log In</title>
    </head>
    <body>
        <div class="top-bar">
            <h1>Log In</h1>
            <hr>
        </div>
        <div class="login-form">
            <form method="POST">
                <div class="err">
                    <?php echo $error; ?>
                </div>
                <input type="text" placeholder="Enter username" name="username">
                <br>
                <input type="password" placeholder="Enter password" name="password">
                <br>
                <input type="submit" value="Log In">
            </form>
        </div>
        <div class="register">
            <p>Don't Have an Account?</p>
            <a href="register.php">Register</a>
        </div>
        <div class="bottom-bar">
            <hr>
        </div>
    </body>
</html>