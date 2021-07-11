<?php

include('frd.php');
?>
<button class="btn-home"><a href="home.php">Home</a></button>
<form action="" method="post" class="form-additem">
    <div class="form-items">
    <label>Bill Number:</label>
    <input type="number" name="billno" class="text-feild" autocomplete="off" ><br>
    <label>Customer Name:</label>
    <select name="shopname" class="text-feild">
    <?php 
        $qurey="SELECT * FROM customer_details;";
        $result=mysqli_query($conn,$qurey);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            ?>
            
                <option value="<?php echo $row['shop_name']?>"><?php echo $row['shop_name']?></option>
            
<?php
        }
    
    
    ?></select><br>
    <label>Bill Value Without GST:</label>
    <input type="number" name="amtwgst" placeholder="&#x20b9" class="text-feild" autocomplete="off"><br>
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
    $netvalue=(($amtwgst*5)/100)+$amtwgst;
    $paymtd=$_POST['payment'];
    ?>
    <div class="netamt">
    <h3>Net Amount: &#x20b9;<?php echo $netvalue; ?></h3><h6 id="tax">(inclusive of all tax)</h6>
    </div>

    
    <?php
    $qurey1="INSERT INTO sales_bill(`bill_no`, `shop_name`, `amt_withoutgst`, `net_amt`) VALUES ('$bill','$shop','$amtwgst','$netvalue') ";
    $result1=mysqli_query($conn,$qurey1);
    if(!mysqli_error($conn)){

        ?>
        <h2 id="stsmsg">Status:<font color="green">Bill Added!</font></h2>
        <?php
    }
    else{
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

?>