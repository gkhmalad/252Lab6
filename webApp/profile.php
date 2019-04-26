<?php
    include 'DatabaseConnection.php';
    $dbConnection = DatabaseConnection::getInstance()->getConnection();
    session_start();
    if(!$_SESSION['username'] || !$_SESSION['userid']){
        header('Location: index.php');
    }
    $query = "SELECT * FROM items WHERE `userID` = ".$_SESSION['userid'];
    $listings = "";
    if($result = mysqli_query($dbConnection, $query)){
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $listings .= '<tr onclick = "strike(this)"><td>'.$row['itemID'].'</td><td>'.$row['name'].'</td><td>'.$row['description'].'</td><td>'.$row['time'].'</td><td>'.$row['date'].'</td><td><form method="post"><input type="text" style="display: none;" name="theID" value="'.$row['itemID'].'"><input type="submit" name="deleteEntry" value="Delete"></form></td></tr>';
            }
        }
    }

    if(isset($_POST["deleteEntry"])){
        $query = "DELETE FROM items WHERE `itemID` =".$_POST['theID'];
        mysqli_query($dbConnection, $query);
        header("Refresh:0");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel='icon' href="./assets/icons/favicon.ico" type='image/x-icon'>
        <link rel="stylesheet" type="text/css" href="./css/profileStyle.css" media="all" />
        <title>My Profile</title>
    </head>

    <body>
        <script type = "text/javascript">
            function strike(x){
                if(x.style.textDecoration == "none"){
                    x.style.textDecoration = "line-through";
                }
                else{
                    x.style.textDecoration = "none";
                }
            }
        </script>
        <div class="top-bar" style="background-color:#BA55D3">
            <h1 style="color:white"><?php echo strtoupper($_SESSION['username'])." PROFILE"?></h1>
        </div>
        <div class="nav-bar">
            <a href="new-entry.php" class = "btn-two cyan mini" style="text-decoration: none;">New Entry</a>
            &nbsp
            <a href="logout.php" id="logout" title="Log Out" class = "btn-two cyan mini" style="text-decoration: none;">Log Out</a>
        </div>
        <div class="entries-group">
            <table>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Time</th>
                    <th>Date</th>
                    <th> </th>
                </tr>
                <div class="entry-single">
                    <?php echo $listings; ?>
                </div>
            </table>
        </div>
        <div class="bottom-bar">
        </div>
    </body>
</html>