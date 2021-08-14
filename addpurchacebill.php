<?php

include('frd.php');
$sql1="SELECT * FROM purchase_bill ORDER BY bill_no DESC LIMIT 1";
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
    <input type="number" name="billno" class="text-feild" autocomplete="off" min="<?php echo $bill_min; ?>" id="bill_no"><br>
    <label for="data">Bill Date:</label>
    <input type="date" name="billdate" class="text-feild" placeholder="Bill Date"><br>
    <label>Company Name:</label>
    <select name="cname" style="width:205px;">
    <option value="">Select a Company</option>
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

<script>
        var input=document.getElementById('bill_no');
        input.oninvalid=function(event){
            event.target.setCustomValidity('Bill Number already exits');
        }
    </script>
