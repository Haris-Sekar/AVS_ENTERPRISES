<?php

include('frd.php');
?>
<button class="btn-home"><a href="home.php">Home</a></button>
<form action="" method="post" class="form-additem">
    <div class="form-items">
    <label>Bill Number:</label>
    <input type="number" name="billno" class="text-feild" autocomplete="off" ><br>
    <label>Company Name:</label>
    <select name="cname" class="text-feild">
    <?php 
        $qurey="SELECT * FROM buyer_compnay_reg;";
        $result=mysqli_query($conn,$qurey);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            ?>
            
                <option value="<?php echo $row['company_name']?>"><?php echo $row['company_name']?></option>
            
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

    $shop=$_POST['cname'];
    $bill=$_POST['billno'];
    $amtwgst=$_POST['amtwgst'];
    $netvalue=(($amtwgst*5)/100)+$amtwgst;
    $paymtd=$_POST['payment'];
    ?>
    <div class="netamt">
        <h3>Net Amount: &#x20b9;<?php echo $netvalue; ?></h3><h6 id="tax">(inclusive of all tax)</h6>
    </div>

    
    <?php
    $qurey1="INSERT INTO purchase_bill(`bill_no`, `company_name`, `amt_withoutgst`, `net_amt`) VALUES ('$bill','$shop','$amtwgst','$netvalue') ";
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
        $sql="UPDATE buyer_compnay_reg SET balance=balance+'$netvalue' WHERE company_name='$shop';";
        $res=mysqli_query($conn,$sql);
        if(!$res){
            echo 'err';
        }
        
    }
    
}

?>