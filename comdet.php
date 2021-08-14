<?php
include('./frd.php');
$cname=$_GET['cname'];
$sql="SELECT * FROM buyer_compnay_reg WHERE company_name='$cname'";
$res=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $phone=$row['phone'];
    $gst_num=$row['gst'];
    $address=$row['address'];
    $balance=$row['balance'];
}

$no_of_bill_sql="SELECT count( * ) as no_of_bill FROM `purchase_bill` 
WHERE company_name='$cname'";
$no_of_bill_res=mysqli_query($conn,$no_of_bill_sql);
$row1=mysqli_fetch_array($no_of_bill_res,MYSQLI_ASSOC);
$no_of_bill=$row1['no_of_bill'];
$salesbill_sql="SELECT SUM(net_amt) AS amt_purchased FROM purchase_bill WHERE company_name='$cname';";
$salesbill_res=mysqli_query($conn,$salesbill_sql);
$row3=mysqli_fetch_array($salesbill_res,MYSQLI_ASSOC);
$amt_purchased=$row3['amt_purchased'];
?>

<div class="prof-card" style="height: 450px;">
    <div class="prof-img">
        <img src="./user.png" alt="user" srcset="">
    </div>
    <div class="prof-name">
        <?php echo $cname ?>
    </div>
    <div class="prof-main-area">
        Main Area: <?php echo $address ?>
    </div>
    <div class="prof-salesbill">
        No of Bills purchased: <?php echo $no_of_bill; ?><br>
        Amount purchased: &#x20b9 <?php echo $amt_purchased; ?><br>
        Balance amount: &#x20b9 <?php echo $balance; ?><br>
        Mobile Number: <?php echo $phone;?><br>
        GST Number: <?php echo $gst_num;?><br>
    </div>
    <div class="prof-btns">
        <button id="billdet" onclick="billdet()" class="button" >Bill Details</button>
        <button id="paymentdet" onclick="paymentdet(value)" class="button">Payment Details</button>

    </div>
    
</div>
<div class="billdet" id="bill" style="visibility: hidden;">
        <table>
            <tr>
                <th>Bill Number</th>
                <th>Bill Date</th>
                <th>Bill value without Gst</th>
                <th>Net Amount</th>
            </tr>
            
                <?php
                    $sql1="SELECT * FROM purchase_bill WHERE company_name='$cname'";
                    $res1=mysqli_query($conn,$sql1);
                    while($row4=mysqli_fetch_array($res1,MYSQLI_ASSOC)){
                                       
                ?>
                <tr>
                <th><?php echo $row4['bill_no'] ?></th>
                <th><?php echo $row4['bill_date'] ?></th>
                <th><?php echo $row4['amt_withoutgst'] ?></th>
                <th><?php echo $row4['net_amt'] ?></th>
                </tr>
                        <?php }?>
            
        </table>
</div>
<div class="paydet" id="pay" style="visibility: hidden;">
    <table>
        <tr>
            <th>Recipt Number</th>
            <th>Recipt Date</th>
            <th>Amount</th>
            <th>Sent By</th>
        </tr>
        
                <?php
                    $sql1="SELECT * FROM purchase_recipt WHERE company_name='$cname'";
                    $res1=mysqli_query($conn,$sql1);
                    while($row4=mysqli_fetch_array($res1,MYSQLI_ASSOC)){
                                       
                ?>
                <tr>
                <th><?php echo $row4['recipt_no'] ?></th>
                <th><?php echo $row4['date'] ?></th>
                <th><?php echo $row4['amt'] ?></th>
                <th><?php echo $row4['user'] ?></th>
                </tr>
                        <?php }?>
            
    </table>
</div>
    <script>
        function billdet()
        {
          document.getElementById("bill").style.visibility="visible";
          document.getElementById("pay").style.visibility="hidden";
        }
        function paymentdet(){
            document.getElementById("bill").style.visibility="hidden";
          document.getElementById("pay").style.visibility="visible";
        }
        

    </script>
