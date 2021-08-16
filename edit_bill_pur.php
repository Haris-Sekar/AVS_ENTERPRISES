<?php


include('./frd.php');
$bill=$_GET['bill_no'];
?>

<div class="validateuser" id="validateuser">
    <form action="" method="post">
        Curent User: <input type="text" name="user" value="<?php echo $user; ?>" style="text-transform: uppercase;" disabled class="text-feild"><br>
        Password: <input type="password" require name="cpass" class="text-feild"><br>
        <input type="submit" value="Validate" class="btn-validate" name="submit" style="float: none;"><br>
    </form>
</div>
<?php 

$sql="SELECT * FROM purchase_bill WHERE bill_no='$bill'";
$res=mysqli_query($conn,$sql);
$row1=mysqli_fetch_array($res);
$bill_date=$row1['bill_date'];
$shop_name=$row1['company_name'];
$amt_withoutgst=$row1['amt_withoutgst'];
$net_amt=$row1['net_amt'];



?>
<div class="bill_edit_form" id="bill_edit_form">
    <form action="" method="POST" class="cus_update_form">
        <div class="cus_update">
            <ul class="cus_update_exits">
                <hr><li> Bill Date: <?php echo $bill_date; ?> <input type="date" name="date" autocomplete="OFF" id="text-feild"> <input type="submit" value="Change" class="btn-submit1" name="date_submit"> <input type="number" name="sname" id="" value="<?php echo $bill ;?>" hidden></li><br><hr>
                <li> Amount without gst: <?php echo $amt_withoutgst; ?><input type="number" name="amt" placeholder="Enter the new Amount before GST" id="text-feild"><input type="submit" value="Change" class="btn-submit1" name="amt_submit"><input type="number" name="sname" id="" value="<?php echo $bill ;?>" hidden></li><br><hr>
            </ul>
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
            document.getElementById("bill_edit_form").style.opacity="100%";
            document.getElementById("validateuser").style.opacity="0%";
            document.getElementById("bill_edit_form").style.top="-200px"; 
            document.getElementById("bill_edit_form").style.left="100px"; 



        </script>
    <?php
    }
}
if(isset($_POST['date_submit'])){
    $date=$_POST['date'];
    $bill=$_POST['sname'];
    $sql2="UPDATE purchase_bill SET bill_date='$date' WHERE bill_no='$bill'";
    $res2=mysqli_query($conn,$sql2);
    if(!mysqli_error($conn)){
        
        ?> 
        <h3>Date Changed, Page will automatically refresh in 5 sec</h3>
        <?php
        header("Refresh:5");
    }
    else{
        echo mysqli_error($conn);   
    }
}
if(isset($_POST['amt_submit'])){
    $bill=$_POST['sname'];
    $amt=$_POST['amt'];
    $net_amt=(($amt*5)/100)+$amt;
    $sql3="UPDATE purchase_bill SET amt_withoutgst='$amt', net_amt='$net_amt' WHERE bill_no='$bill'";
    $res3=mysqli_query($conn,$sql3);
    if(!mysqli_error($conn)){
        
        ?> 
        <h3>Amount Changed, Page will automatically refresh in 5 sec</h3>
        <?php
        header("Refresh:5");
    }
    else{
        echo mysqli_error($conn);   
    }
}

?>
