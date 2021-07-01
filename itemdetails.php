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
<link rel="stylesheet" href="style1.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AVS ENTERPRISES</title>
</head>

<body>
  <ul class="navbar">
    <li><h1>AVS ENTERPRISES</h1></li>
    <div class="navitems">
    <li><h4><div class="nav1" >User:  <?php echo $user; ?></div></h4></li>
    <li><h4><div class="nav2" >Authority:  <?php echo $autho;  ?></div></h4></li>
    </div>
  </ul>
  <button class="btn-logout"><a href="logout.php">Logout</a></button>
  <button class="btn-home"><a href="home.php">Home</a></button>
  <table>
    <tr>
      <th>ID</th>
      <th>Item Name</th>
      <th>Manufacture</th>
      <th>Item Group</th>
    </tr>
    <?php
    $qurey="SELECT  * FROM item";
    $result=mysqli_query($conn,$qurey);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    ?>
    <tr>
      <td scope="row"><?php echo $row['id'];?></td>
      <td scope="row"><?php echo $row['style'];?></td>
      <td scope="row"><?php echo $row['Manufacture'];?></td>
      <td scope="row"><?php echo $row['item_group'];?></td>
    </tr>
    <?php }?>
  </table>
</body>

</html>
