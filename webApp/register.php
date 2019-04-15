<?php
  include 'DatabaseConnection.php';
  //* $dbConnection = DatabaseConnection::getInstance()->getConnection();
  session_start();
  //? Variables
  $error = "";
  $password = "";
  $username = "";
  $passwordRe = "";
  $email = "";
  //? If form was submitted
  if($_POST){
    //? Username field validation server-side
    if(!$_POST['username']){
      $error .= "A username is required to register.<br>";
    }else{
      $username = $_POST['username'];
    }
    //? Password field validation server-side
    if(!$_POST['password']){
      $error .= "A password is required to register.<br>";
    }else{
      $password = $_POST['password'];
    }
    //? Password field validation server-side
    if(!$_POST['repassword']){
      $error .= "Please repeat the password.<br>";
    }else{
      $passwordRe = $_POST['repassword'];
    }
    //? Password field validation server-side
    if(!$_POST['email']){
      $error .= "An email is required to register.<br>";
    }else{
      //?Checking if email is in a valid form
      if($_POST['email'] && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false){
        $error .= "Invalid email address.<br>";
      }else{
      $email = $_POST['email'];
      }
    }
    if($_POST['password'] && $_POST['repassword']){
      if($_POST['repassword'] != $_POST['password']){
        $error .= "The passwords do not match.<br>";
      }
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
        //? Checking if a user with this email already exists
        if(mysqli_num_rows($result)!=0 && $row['email'] = $email){
          $error = '<div class="signin-error" style="color:red;"><strong>Error:</strong><br>A user with this email already exists.</div>';
        }else{
          //? Inserting new user into the database table
          $query = "INSERT INTO `users` (`email`, `password`, `username`) VALUES ('".$email."', '".$password."', '".$username."')";
          mysqli_query($dbConnection, $query);
          $error = '<div class="signup-success" style="color:green;"><p>Sign Up Success!</p></div>';
          //? Closing database connection
          mysqli_close($dbConnection);
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

      <input type="text" placeholder="Username..." name="username">
      <br>
      <input type="text" placeholder="Email..." name="email">
      <br>
      <input type="password" placeholder="Password..." name="password">
      <br>
      <input type="password" placeholder="Repeat Password..." name="repassword">
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