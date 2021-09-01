<?php 
include('./frd.php');
?>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="addsalesrecipt.js"></script>
</head>
<div class="customer_name" id="username_list">
<form action="" method="post">
    <label>User:</label>
    <select name="user" class="text-feild" style="width:205px;">
        <option value="null">Select a User</option>
        <?php 
            $qurey="SELECT * FROM admin;";
            $result=mysqli_query($conn,$qurey);
            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                ?>
                
                    <option value="<?php echo $row['username']?>"><?php echo $row['username']?></option>
                
                <?php
                    }?>
        </select>
        <input type="submit" value="Search" class="btn-search1" name="submit" onclick="dis()">
    </form>
</div>

<?php 

if(isset($_POST['submit'])){
    $user_sel=$_POST['user'];
    $sql1="SELECT * FROM admin WHERE username='$user_sel'";
    $res1=mysqli_query($conn,$sql1);
    $row1=mysqli_fetch_array($res1);
    $user_autho=$row1['autho'];

    ?>
    <div class="prof-card" style="height: 300px;">
    <div class="prof-img">
        <img src="./user.png" alt="user" srcset="">
    </div>
    <div class="prof-name">
        <?php echo $user_sel ?>
    </div>
    <div class="prof-salesbill">
        Authority: <?php echo $user_autho;?><br>
    </div>
    <div class="prof-btns">
        <button  onclick="delete_user()" class="button" >Delete User</button>
        <button onclick="change_pass()" class="button">Change Password</button>

    </div>
    
</div>
<?php
}

?>
<div class="delete_user" id="delete_user">
<form action="" method="POST"> 
        <h2>Do you want to delete User : <?php echo $user_sel;?> <input type="text" name="user_sel" id="" hidden value="<?php echo $user_sel; ?>"></h2>
        <input type="submit" value="Yes" name="yes" class="button" style="width: 70px;">
        <input type="submit" value="No" name="no" class="button" style="width: 70px;">
    </form>
    <?php
    if(isset($_POST['yes'])){
        $user_sel=$_POST['user_sel'];
        $sql2="DELETE FROM `admin` WHERE `username`='$user_sel'";
        $res2=mysqli_query($conn,$sql2);
        if(!mysqli_error($conn)){
            echo "<script>alert('.$user_sel. Deleted Sucessfully!'); </script>";
            

        }
        else{
            echo "err";
        }
    }
    
    
    ?>
</div>

    <div class="delete_user1" id="change_pass">
    <form action="" method="POST"> 
            New Password: <input type="password" name="newpass" id="newpass" class="text-feild"><br>
            Confirm Password: <input type="password" name="confpass" id="newpass" class="text-feild"><br>
            <input type="submit" value="Yes" name="change" class="button" style="width: 70px;" >
            <input type="reset" value="reset" name="no" class="button" style="width: 70px;">
        </form>
        <?php
        if(isset($_POST['change'])){
            $pass1=$_POST['newpass'];
            $pass=md5($pass1);
            $con_pass=md5($_POST['confpass']);
            if($pass==$con_pass){
                $sql3="UPDATE admin SET password='$con_pass' WHERE username='$user_sel'";
                $res3=mysqli_query($conn,$sql3);
                if(!mysqli_error($conn)){
                    echo "<script>alert('.$user_sel. Password changed Sucessfully!'); </script>";
                }
                else{
                    echo "err";
                }
            }
            else{
                echo "<script>alert(' Password Missmatch'); </script>";

            }
            
        }
        
        
        ?>
    </div>

<script>
    function delete_user(){
        document.getElementById('delete_user').style.visibility="visible";
        document.getElementById('change_pass').style.visibility="hidden";
    }
    function change_pass(){
        document.getElementById('delete_user').style.visibility="hidden";
        document.getElementById('change_pass').style.visibility="visible";

    }
    function dis(){
        document.getElementById('username_list').style.visibility="hidden";
    }
</script>


