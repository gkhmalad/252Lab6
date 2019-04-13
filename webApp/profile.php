<?php
  include 'DatabaseConnection.php';
  //* $dbConnection = DatabaseConnection::getInstance()->getConnection();
  session_start();
  if(!$_SESSION['username'] || !$_SESSION['userid']){
    header('Location: index.php'); 
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel='icon' href="favicon.ico" type='image/x-icon'>
  <title>My Profile</title>
</head>
<body>

  <div class="top-bar">

    <h1 style="color:orange">**USERNAME**</h1>
    <hr>
  </div>

  <div class="nav-bar">

    <a href="new-entry.php">New Entry</a>
    <br>
    <a href="logout.php" id="logout" title="Log Out">Log Out</a>

    <hr>
  </div>


  <div class="bottom-bar">
    
    <hr>
  </div>
    
  
</body>
</html>