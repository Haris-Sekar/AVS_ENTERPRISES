<?php

include('frd.php');
$sql1="SELECT * FROM sales_bill ORDER BY bill_no DESC LIMIT 1";
$res1=mysqli_query($conn,$sql1);
$row=mysqli_fetch_array($res1,MYSQLI_ASSOC);
$bill_min=$row['bill_no']+1;
?>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="addsalesrecipt.js"></script>
</head>

<form action="" method="post" class="form-additem">
    <div class="form-items">
    <label>Bill Number:</label>
    <input type="number"  name="billno" id="bill_no" class="text-feild" autocomplete="off" min="<?php echo $bill_min; ?>" title="Bill Number already exits" ><br>
    <label>Customer Name:</label>
    <select name="shopname" class="text-feild" style="width:205px;">
    <?php 
        $qurey="SELECT * FROM customer_details;";
        $result=mysqli_query($conn,$qurey);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            ?>
            
                <option value="<?php echo $row['shop_name']?>"><?php echo $row['shop_name']?></option>
            
<?php
        }
    
    
    ?></select><br>
    <label for="">Date:</label>
    <input type="date" class="text-feild" require name="bill_date"><br>
    <label>Bill Value Without GST:</label>
    <input type="number" name="amtwgst" placeholder="&#x20b9" class="text-feild" autocomplete="off"><br>
    <label for="">Tax Mode</label>
    <select name="tax" class="text-feild"><center>
        <option value="YES">Taxable</option>
        <option value="NO">Non-Taxable</option></center>
    </select><br>
    <label>Payment method:</label>
    <input type="radio" name="payment" value="credit">Credit<input type="radio" name="payment" value="cash">Cash<br>
    <input type="submit" name="submit" value="Add Bill" class="btn-update-pricelist-submit">    
    
    </div>
</form>
<?php 
if(isset($_POST['submit'])){

    $shop=$_POST['shopname'];
    $bill=$_POST['billno'];
    $amtwgst=$_POST['amtwgst'];
    $tax=$_POST['tax'];
    //echo $tax;
    if($tax=="YES"){
        $netvalue=(($amtwgst*5)/100)+$amtwgst;
    }
    else{
        $netvalue=$amtwgst;
    }
    $paymtd=$_POST['payment'];
    $bill_date=$_POST['bill_date'];
    ?>
    <div class="netamt">
    <h3>Net Amount: &#x20b9;<?php echo $netvalue; ?></h3><h6 id="tax">(inclusive of all tax)</h6>
    </div>
    <?php
    if($tax=="NO"){        
        
        $qurey2="INSERT INTO `sales_bill_without`(`bill_no`, `bill_date`, `shop_name`, `net_amt`) VALUES ('$bill','$bill_date','$shop','$netvalue');";
        $result2=mysqli_query($conn,$qurey2);
        if(mysqli_error($conn)){
            echo mysqli_error($conn);

            ?>
            <h2 id="stsmsg">Status:<font color="red"> Bill Number already exist!</font></h2>
            <?php
        }
        else{

            ?>
            <h2 id="stsmsg">Status:<font color="green">Bill Added!</font></h2>
            <?php
        }
        
        if($paymtd!='cash'){
            $sql="UPDATE customer_balance_details SET balance=balance+'$netvalue' WHERE shop_name='$shop';";
            $res=mysqli_query($conn,$sql);
            if(!$res){
                echo 'err';
            }
            
        }
    }
    else{
        
        
        $qurey1="INSERT INTO `sales_bill`(`bill_no`, `bill_date`, `shop_name`, `amt_withoutgst`, `net_amt`) VALUES  ('$bill','$bill_date','$shop','$amtwgst','$netvalue');";
        $result1=mysqli_query($conn,$qurey1);
        if(!mysqli_error($conn)){

            ?>
            <h2 id="stsmsg">Status:<font color="green">Bill Added!</font></h2>
            <?php
        }
        else{
            echo mysqli_error($conn);
            ?>
            
            <h2 id="stsmsg">Status:<font color="red"> Bill Number already exist!</font></h2>
            <?php
        }
        if($paymtd!='cash'){
            $sql="UPDATE customer_balance_details SET balance=balance+'$netvalue' WHERE shop_name='$shop';";
            $res=mysqli_query($conn,$sql);
            if(!$res){
                echo 'err';
            }
            
        }
    }
}

    ?>
    <script>
        var input=document.getElementById('bill_no');
        input.oninvalid=function(event){
            event.target.setCustomValidity('Bill Number already exits');
        }
    </script>