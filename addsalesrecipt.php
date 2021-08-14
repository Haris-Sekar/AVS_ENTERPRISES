<?php
include("./frd.php")


?>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="addsalesrecipt.js"></script>
</head>

    <form action="" method="post" class="form-additem1" id="formadditem">
    <div class="form-items1">
    <label>Shop Name:</label>
    <select name="sname" class="text-feild" style="width:205px;" >
    <option value="null">select a shop</option>
    <?php 
        $qurey="SELECT * FROM customer_details;";
        $result=mysqli_query($conn,$qurey);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            ?>
            
                <option value="<?php echo $row['shop_name']?>"><?php echo $row['shop_name']?></option>
            
<?php
        }
    
    
    ?></select><br>
        <label for="">Amount:</label>
        <input type="number" name="amt" id="" class="text-feild" placeholder="&#x20b9" require> <br>
        <label for="">Date:</label>
        <input type="date" id="date" name="date" class="text-feild" require>
        <script>
            $('#date').val(new Date().toJSON().slice(0,10));
        </script><br>
        <label>User:</label>
        <input type="text" value="<?php echo $user;?>" disabled class="text-feild" style="text-transform: uppercase;" name="user"><br>
        <label>Payment Method:</label>
        <input type="radio" name="pay_method" value="cash" onclick="myfunc(value)"  require>CASH<input type="radio" name="pay_method" value="cheque" onclick="myfunc(value)" require>CHEQUE <br>
        <div id="chq" style="opacity: 0%;">
            <label>Cheque Date:</label>
            <input type="date" placeholder="Cheque date" class="text-feild" require name="chq_date"><br>
            <label>Cheque recive date:</label>
            <input type="date" placeholder="Cheque recive date" class="text-feild" require name="chq_res_date"><br>
            <label>Cheque Number:</label>
            <input type="number" placeholder="Cheque Number" class="text-feild" require name="chq_num"><br>
            <label>Cheque Bank:</label>
            <input type="text" placeholder="Cheque bank" require class="text-feild" name="chq_bank">

        </div>
       

        <input type="submit" value="Submit" name="submit" class="btn-submit" id="sub-btn">
    </div>
    </form>
    <script>

function myfunc(name){

if(name== 'cheque'){
    document.getElementById("chq").style.opacity="100%";
    document.getElementById("sub-btn").style.top="0px";
    document.getElementById("formadditem").style.height="400px"


}
else{
    document.getElementById("chq").style.opacity="0%";
    document.getElementById("sub-btn").style.top="-150px";
    document.getElementById("formadditem").style.height="250px";
}
}
    </script>
    <?php
        if(isset($_POST['submit'])){
            $amt=$_POST['amt'];
            $sname=$_POST['sname'];
            $pay_method=$_POST['pay_method'];
            $chq_date=$_POST['chq_date'];
            $chq_res_date=$_POST['chq_res_date'];
            $chq_num=$_POST['chq_num'];
            $chq_bank=$_POST['chq_bank'];
            $date=$_POST['date'];
            echo $date;
            $sql4="SELECT * FROM customer_balance_details WHERE shop_name='$sname'";
            $result5=mysqli_query($conn,$sql4);
            while($cus_det=mysqli_fetch_array($result5,MYSQLI_ASSOC)){
                $balance=$cus_det['balance'];
            }
            if($balance>$amt){
                if($pay_method=='cash'){
                    $sql="INSERT INTO `sales_recipt`(`shop_name`, `date`, `amt`, `payment_method`, `user`) VALUES ('$sname','$date','$amt','$pay_method','$user')";
                    $result=mysqli_query($conn,$sql);
                    $sql2="UPDATE customer_balance_details SET balance=balance-'$amt' WHERE shop_name='$sname'";
                    $result2=mysqli_query($conn,$sql2);
                    if(mysqli_error($conn)){
                        echo mysqli_error($conn);
                        //echo "Went Worng!!";
                    }
                    else{
                        ?>
                        <h2 id="stsmsg"><center>Status:<font color="green">Payment Recipt Added!</font></center></h2>
                    <?php
                    }
                }
                else{
                    $sql="INSERT INTO `sales_recipt`(`shop_name`, `date`, `amt`, `payment_method`, `user`) VALUES ('$sname','$date','$amt','$pay_method','$user')";
                    $result=mysqli_query($conn,$sql);
                    $sql1="INSERT INTO sales_payment_cheque_details( `shop_name`, `chq_date`, `chq_recive_date`, `chq_number`, `chq_bank`) VALUES ('$sname','$chq_date','$chq_res_date','$chq_num','$chq_bank')";
                    $result1=mysqli_query($conn,$sql);
                    $sql3="UPDATE customer_balance_details SET balance=balance-'$amt' WHERE shop_name='$sname'";
                    $result3=mysqli_query($conn,$sql2);
                    if(mysqli_error($conn)){
                        echo "Went Worng!!";
                        echo mysqli_error($conn);
                    }
                }
                $qurey="SELECT * FROM customer_balance_details WHERE shop_name='$sname'";
            $result4=mysqli_query($conn,$qurey);
            while($row=mysqli_fetch_array($result4,MYSQLI_ASSOC)){
                ?>
                    <script> alert("<h2 id="stsmsg"><center>Remainig Balance:<font color="green"><?php echo $row['balance']; ?></font></center></h2>");</script>
            <?php
            }
            }
            else{
                $qurey="SELECT * FROM customer_balance_details WHERE shop_name='$sname'";
                $result4=mysqli_query($conn,$qurey);
                while($row=mysqli_fetch_array($result4,MYSQLI_ASSOC)){
                    echo "<script>alert('Balance is:$balance') </script>";
                }

            }
        }
    
    
    ?>
