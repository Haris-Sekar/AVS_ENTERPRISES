<?php
include('./frd.php');


?>
<table>
    <tr>
        <th>Bill No</th>
        <th>Company Name</th>
        <th>Bill date</th>
        <th>Bill Amount without GST</th>
        <th>Net Amount</th>
        <th>Edit Bill</th>
        <th>Delete Bill</th>
    </tr>
    <?php
    $sql="SELECT * FROM purchase_bill;";
    $res=mysqli_query($conn,$sql);
    while($row1=mysqli_fetch_assoc($res)){
    ?>
    <tr>
        <th><?php echo $row1['bill_no']; $bill=$row1['bill_no']; ?></th>
        <th><?php echo $row1['company_name'];?></th>
        <th><?php echo $row1['bill_date']; ?></th>
        <th><?php echo $row1['amt_withoutgst']; ?></th>
        <th><?php echo $row1['net_amt']; ?></th>
        <th><a href="edit_bill_pur.php?bill_no=<?php echo $bill; ?>"><button class="button"  type="submit" name="details" style="width: 70px;">Edit</button></a></th>
        <th><a href="delete_bill_pur.php?bill_no=<?php echo $bill; ?>"><button class="button"  type="submit" name="details" style="width: 70px;">Delete</button></a></th>
    </tr>
    <?php } ?>
    </table>