<?php
include "conn.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>AVS ENTERPRISES</title>
  <link rel="shortcut icon" href="./avs_logo.png" />

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script defer="" src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon="{&quot;si&quot;:10,&quot;rayId&quot;:&quot;6425b5bd7e673971&quot;,&quot;version&quot;:&quot;2021.4.0&quot;}"></script>
</head>
<body>
<div class="jumbotron jumbotraon-fluid">
  <h1>AVS ENTERPRISES</h1>
</div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <img src="./avs_logo.png" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                       <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Log in to access <strong><BR>AVS ENTERPRISES</strong></h3>
                                <p class="mb-4">DATABASE</p>
                            </div>
                            <form action="" method="post">
                                <div class="form-group first">
                                    <label for="username">Username:</label>
                                    <input type="text" class="form-control" id="username" name="uname">
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="pass">
                                </div>
                                <input type="submit" name="submit" value="Log In" class="btn text-white btn-block btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>

<?php

if(isset($_POST['submit'])){
    $user=$_POST['uname'];
    $pass1=$_POST['pass'];
    $pass=md5($pass1);
    $query="SELECT * FROM admin WHERE username='$user';";
    $res=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
    {
        if ($pass==$row['password'] ) 
        {
            if($row['autho']=="admin")
            {
                session_start();
                $_SESSION['user']=$user;
                $_SESSION['success'] = "You have logged in!";
                header("location: home.php");
            }
            else{
                session_start();
                $_SESSION['user']=$user;
                $_SESSION['success'] = "You have logged in!";
                header("location: homeuser.php");
            }
        }
        else
        {
           ?><script>
               alert('Incorrect Username or Password');
               </script>
        <?php
        }
}
}



?>