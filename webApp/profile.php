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
                $listings .= '<tr><td>'.$row['itemID'].'</td><td>'.$row['name'].'</td><td>'.$row['description'].'</td></tr>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel='icon' href="./assets/icons/favicon.ico" type='image/x-icon'>
        <title>My Profile</title>
        <style>
            table {
                border-collapse: collapse;
            }
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <div class="top-bar">
            <h1 style="color:orange"><?php echo strtoupper($_SESSION['username'])." PROFILE"?></h1>
            <hr>
        </div>
        <div class="nav-bar">
            <a href="new-entry.php">New Entry</a>
            &nbsp
            <a href="logout.php" id="logout" title="Log Out" >Log Out</a>
            <hr>
        </div>
        <div class="entries-group">
            <table>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
                <div class="entry-single">
                    <?php echo $listings; ?>
                </div>
            </table>
        </div>
        <div class="bottom-bar">
            <hr>
        </div>
    </body>
</html>