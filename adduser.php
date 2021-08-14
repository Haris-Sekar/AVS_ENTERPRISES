<?php

include('./frd.php');
?>
<div class="adduser" >
    <form action="" method="POST" class="form-additem1" style="height: 300px;">
        <div class="form-items1">
    Curent User:<label for="" require style="text-transform: uppercase;"><input type="text" name="user" value="<?php echo $user; ?>" style="text-transform: uppercase;" disabled class="text-feild"></label><br>
    Password: <input type="password" require name="cpass" class="text-feild"><br>
    <input type="submit" value="Validate" class="btn-validate" name="submit"><br>
</form>
<form action="" method="POST" >

    <div disabled="disabled" id="newuser">
        New User's Username: <input type="text" require name="username" class="text-feild" autocomplete="off"><br>
        New User's Password: <input type="password" require name="newuserpass" class="text-feild"><br>
        New User's Authority:<select name="autho" class="text-feild">
            <option value="admin">Admin</option>
            <option value="worker">Worker</option>
        </select>
    </div>
    <input type="submit" value="Add" name="add" class="btn-validate" style="width: 50px;">
    </div>


    </form>
</div>

<?php 

if(isset($_POST['submit'])){
    $pass=$_POST['cpass'];
    $sql="SELECT * FROM `admin` WHERE username='$user';";
    $res=mysqli_query($conn,$sql);
    $row1=mysqli_fetch_array($res);
    $userpass=$row1['password'];
    if($pass!=$userpass){
        echo "<script> alert('Password is Incorrect') </script>";
    }
    else{
        ?>
        <script>
            document.getElementById("newuser").style.pointerEvents="all";
            document.getElementById("newuser").style.opacity="100%";

        </script>
    <?php
    }
}
if(isset($_POST['add'])){
    $new_user=$_POST['username'];
    $new_pass=$_POST['newuserpass'];
    $autho=$_POST['autho'];
    $sql1="INSERT INTO admin(`username`, `password`, `autho`) VALUES ('$new_user','$new_pass','$autho')";
    $res=mysqli_query($conn,$sql1);
    if(mysqli_error($conn)){
        echo "err";
    }
    else{
        echo "<script>alert('New User added!')</script>";
    }

}

?>
