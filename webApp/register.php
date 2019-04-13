<?php
  //TODO
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
    <form method="POST">

      <input type="text" placeholder="Username..." name="username">
      <br>
      <input type="text" placeholder="Email..." name="username">
      <br>
      <input type="password" placeholder="Password..." name="password">
      <br>
      <input type="password" placeholder="Repeat Password..." name="password">
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