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
    //? Time field validation server-side
    if(!$_POST['time']){
      $error .= "Time is required to create a new task.<br>";
    }else{
      $time = $_POST['time'];
    }
    //? Date field validation server-side
    if(!$_POST['date']){
      $error .= "A date is required to create a new task.<br>";
    }else{
      $date = $_POST['date'];
    }
    //? Database check if validation passed
    if($error != ""){
      $error = '<div class="signin-error" style="color:red;"><strong>Error:</strong><br>'.$error.'</div>';
    }else{
      $query = "INSERT INTO `items` (`name`, `description`, `userID`, `time`, `date`) VALUES ('".$taskName."', '".$description."', '".$_SESSION['userid']."', '".$time."', '".$date."')";
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
  <link rel="stylesheet" type="text/css" href="./css/registerStyle.css" media="all" />
  <title>New Task</title>
</head>
<body>

  <div class="top-bar">
    <h1>New Entry</h1>
  </div>
  <br>

  <div class="form">
    <form method="POST">
      <input type="text" placeholder="Task Name..." name="taskName">
      <input type="time" placeholder="Time..." name="time">
      <input type="date" name="date">
      <input type="text" placeholder="Description..." name="description">
      <input type="submit" value="Add">
    </form>
  </div>

  <div class="err">
      <h1>
      <?php echo $error; ?>
      </h1>
  </div>

  <div class="bottom-bar">
  </div>
  
</body>
</html>