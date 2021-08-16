<?php
include('frd.php');
?>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="addsalesrecipt.js"></script>
</head>
<div class="customer_name">
<form action="" method="post">
    <label>Bill Number:</label>
    <select name="bill" class="text-feild" style="width:205px;">
        <option value="null">Select a Bill</option>
        <?php 
            $qurey="SELECT * FROM purchase_bill;";
            $result=mysqli_query($conn,$qurey);
            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                ?>
                
                    <option value="<?php echo $row['bill_no']?>"> Bill NO :<?php echo $row['bill_no']?>-<?php echo $row['company_name']; ?></option>
                
                <?php
                    }?>
        </select>
        <input type="submit" value="Search" class="btn-search1" name="submit" onclick="mufunc()">
    </form>
</div>



<?php 
if(isset($_POST['submit'])){
    $bill=$_POST['bill'];
    $sql="SELECT * FROM purchase_bill WHERE bill_no='$bill'";
    $res=mysqli_query($conn,$sql);
    $row1=mysqli_fetch_array($res);
    $bill_date=$row1['bill_date'];
    $shop_name=$row1['company_name'];
    $amt_withoutgst=$row1['amt_withoutgst'];
    $net_amt=$row1['net_amt'];

    ?>
    <div class="bill_edit_form" id="bill_edit_form" style="opacity: 100% ;">
    <form action="" method="POST" class="cus_update_form">
        <div class="cus_update">
            <ul class="cus_update_exits">
                <hr><li> Bill Date: <?php echo $bill_date; ?> <input type="date" name="date" placeholder="Enter the new Shop Name" autocomplete="OFF" id="text-feild"> <input type="submit" value="Change" class="btn-submit1" name="date_submit"> <input type="number" name="sname" id="" value="<?php echo $bill ;?>" hidden></li><br><hr>
                <li> Amount without gst: <?php echo $amt_withoutgst; ?><input type="number" name="amt" placeholder="Enter the new Amount before GST" id="text-feild"><input type="submit" value="Change" class="btn-submit1" name="amt_submit"><input type="number" name="sname" id="" value="<?php echo $bill ;?>" hidden></li><br><hr>
                
            </ul>
           <button class="button1"> <a href="./delete_bill_pur1.php?bill_no=<?php echo $bill; ?>">Delete Bill</a></button>
        </div>
    </form>
</div>
    
<?php

}

?>
<?php

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