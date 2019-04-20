<?php
    include 'DatabaseConnection.php';
    $dbConnection = DatabaseConnection::getInstance()->getConnection();
    session_start();
    $error = "";
    $password = "";
    $username = "";
    $fetchedPassword = "";
    if(isset($_SESSION['username']) && isset($_SESSION['userid'])){
        header('Location: ./profile.php');
    }
    if($_POST){
        !$_POST['username'] ? $error .= "A username is required to log in.<br>" : $username = $_POST['username'];
        !$_POST['password'] ? $error .= "A password is required to log in.<br>" : $password = $_POST['password'];
        if($error != ""){
            $error = '<div class="signin-error" style="color:red;"><strong>Error:</strong><br>'.$error.'</div>';
        }else{
            $query = "SELECT * FROM users WHERE `username` = '".$username."'";
            if($result = mysqli_query($dbConnection, $query)){
                $row = mysqli_fetch_array($result);
                $fetchedPassword = $row['password'];
            }
            if($fetchedPassword == $password){
                $_SESSION['username'] = $username;
                $_SESSION['userid'] = $row['userID'];
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
    <link rel='icon' href="./assets/icons/favicon.ico" type='image/x-icon'>
    <link rel="stylesheet" type="text/css" href="./css/indexStyle.css" media="all" />
    <title>Log In</title>
</head>

<body>
    <h1>WELCOME TO 2DAY</h1>
    <h1><?php echo $error; ?></h1>

    <div class="stand">
        <div class="outer-screen">
            <div class="inner-screen">
                <div class="form">
                    <form method="POST">
                        <input type="text" class="zocial-dribbble" placeholder="Enter your username" name="username" />
                        <input type="password" placeholder="Password" name="password" />
                        <input type="submit" value="Login" />
                    </form>
                    <a href="./register.php">SIGN UP</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>