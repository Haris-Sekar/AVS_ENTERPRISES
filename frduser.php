<?php
include "conn.php";
session_start();
if (!isset($_SESSION['user'])) {
  $_SESSION['msg'] = "You have to log in first";
  header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['user']);
  header("location: login.php");
}
$user = $_SESSION['user'];
$qurey="SELECT  * FROM admin WHERE username='$user'";
        $result=mysqli_query($conn,$qurey);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          $id=$row['id'];
          $autho=$row['autho'];
        }
?>
<html lang="en">

<head>
<link rel="shortcut icon" href="./avs_logo.png" />
<link rel="stylesheet" href="style1.css">
  <meta charset="UTF-8">
  <script src="https://kit.fontawesome.com/9bf6eecd68.js" crossorigin="anonymous"></script>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AVS ENTERPRISES</title>
</head>

<body>
<div class="navbarsticky">
  <ul class="navbar">
    <li><h1><a href="./homeuser.php" id="navbar-a"> AVS ENTERPRISES</a></h1></li>
    <div class="navitems">
    <li><h4><div class="nav1" >User:  <?php echo $user; ?></div></h4></li>
    <li><h4><div class="nav2" >Authority:  <?php echo $autho;  ?></div></h4></li>
    </div>
    
  </ul>
 <button class="btn-logout"><a href="logout.php">Logout</a></button>
 </div>
 <div class="dropdown-menus">
    <div class="navbar-menus">
      <button class="dropbtn">Add</button>
      <div class="dropdown-content">
      <a href="./addsalesbill_worker.php">Add Sales Bill</a><hr>
      <a href="./addsalesrecipt_worker.php">Sales Payment Recipt</a><hr>
      </div>
    </div>
  </div>

</body>

</html>