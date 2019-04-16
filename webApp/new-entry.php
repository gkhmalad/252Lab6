<?php
  //TODO Figure out how to add date and time to DB
  include 'DatabaseConnection.php';
  $dbConnection = DatabaseConnection::getInstance()->getConnection();
  session_start();
  if(!$_SESSION['username'] || !$_SESSION['userid']){
    header('Location: index.php'); 
  }
  $error = "";
  $taskName = "";
  $time = "";
  $date = "";
  $description = "";
   //? If form was submitted
   if($_POST){
    //? Username field validation server-side
    if(!$_POST['taskName']){
      $error .= "A name is required to create a new task.<br>";
    }else{
      $taskName = $_POST['taskName'];
    }
    //? Password field validation server-side
    if(!$_POST['description']){
      $error .= "A description is required to create a new task.<br>";
    }else{
      $description = $_POST['description'];
    }
    //? Database check if validation passed
    if($error != ""){
      $error = '<div class="signin-error" style="color:red;"><strong>Error:</strong><br>'.$error.'</div>';
    }else{
      $query = "INSERT INTO `items` (`name`, `description`, `userID`) VALUES ('".$taskName."', '".$description."', '".$_SESSION['userid']."')";
      mysqli_query($dbConnection, $query);
      $error = '<div class="creation-success" style="color:gree"><p>Task Creation Success!</p></div>';
      //? Closing database connection
      mysqli_close($dbConnection);
      header("Location: ./profile.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel='icon' href="./assets/icons/favicon.ico" type='image/x-icon'>
  <title>New Task</title>
</head>
<body>

  <div class="top-bar">

    <h1 style="color:orange">New Entry</h1>
    <hr>
  </div>

  <div class="register-form">

    <div class="err">
      <?php echo $error; ?>
    </div>
    <form method="POST">
    
      <input type="text" placeholder="Task Name..." name="taskName">
      <br>
      <input type="time" placeholder="Time..." name="time">
      <br>
      <input type="date" name="date">
      <br>
      <input type="text" placeholder="Description..." name="description">
      <br>
      <input type="submit" value="Add">
    </form>
  </div>

  <div class="bottom-bar">
    <hr>
  </div>
  
</body>
</html>