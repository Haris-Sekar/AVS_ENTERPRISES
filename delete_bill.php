<?php 
include ('frd.php');
$bill=$_GET['bill_no'];
?>
<div class="confirm_delte">
    <form action="" method="POST"> 
        <h2>Do you want to delete Bill No : <?php echo $bill;?></h2>
        <input type="submit" value="Yes" name="yes" class="button" style="width: 70px;">
        <input type="submit" value="No" name="no" class="button" style="width: 70px;">
    </form>
</div>
<?php

if(isset($_POST['yes'])){
    $sql="DELETE FROM `sales_bill` WHERE  bill_no='$bill'";
    $res=mysqli_query($conn,$sql);
    if(!mysqli_error($conn)){
        header('location:view_sales_bill.php');
    }
}
elseif(isset($_POST['no'])){
    header('location:view_sales_bill.php');

}


?>