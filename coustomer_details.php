<?php 
include("frd.php");

?>
<h2 id="filter-text">Filters</h2+>
<form action="" method="post">
<input type="search" name="name_filter" placeholder="Search by Name" class="searchbar" autocomplete="off"> 
<input type="search" name="area_filter" placeholder="Search by Area" class="filter-area" autocomplete="off"><br>
<h3 id="filter-text">By Amount</h3>

<div class="filter-balance">
<input type="radio" id="filter-balance" name="balance" value="10000-20000">
<label for="balance">10000-20000</label><br>
<input type="radio" id="filter-balance" name="balance" value="10000-20000">
<label for="balance">20000-30000</label><br>
<input type="radio" id="filter-balance" name="balance" value="10000-20000">
<label for="balance">30000-40000</label><br>
<input type="radio" id="filter-balance" name="balance" value="10000-20000">
<label for="balance">40000-50000</label><br>
<input type="radio" id="filter-balance" name="balance" value="10000-20000">
<label for="balance">50000 and Above</label><br>
</div>
<input type="submit" name="submit" value="Apply filter" class="btn-search"> 
</form>
<table>
    <tr>
        <th>Customer Name</th>
        <th>Phone Number</th>
        <th>GSTIN Number</th>
        <th>Main Area</th>
        <th>Address</th>
        <th>Total Balance</th>
    </tr>
    <?php 
    if(isset($_POST['submit'])){
        $name=$_POST['name_filter'];
        $area=$_POST['area_filter'];
        $qurey2="SELECT * FROM customer_details WHERE shop_name LIKE '%$name%' AND area_name LIKE '%$area%'";
        $result2=mysqli_query($conn,$qurey2);
        $qurey3="SELECT * FROM customer_balance_details WHERE shop_name LIKE '%$name%'";
        $result3=mysqli_query($conn,$qurey3);
        while($row3=mysqli_fetch_array($result2,MYSQLI_ASSOC) and $row4=mysqli_fetch_array($result3,MYSQLI_ASSOC)){?>
    <tr>
        <th><?php echo $row3['shop_name']; ?></th>
        <th><?php echo $row3['phone_number']; ?></th>
        <th><?php echo $row3['gst_number']; ?></th>
        <th><?php echo $row3['area_name']; ?></th>
        <th><?php echo $row3['address']; ?></th>
        <th><?php echo $row4 ['balance']; ?></th>
    </tr>
        <?php
    }
}
    else
    {
    $qurey="SELECT * FROM customer_details";
    $result=mysqli_query($conn,$qurey);
    $qurey1="SELECT * FROM customer_balance_details";
    $result1=mysqli_query($conn,$qurey1);
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC) and $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC)){?>
    <tr>
        <th><?php echo $row['shop_name']; ?></th>
        <th><?php echo $row['phone_number']; ?></th>
        <th><?php echo $row['gst_number']; ?></th>
        <th><?php echo $row['area_name']; ?></th>
        <th><?php echo $row['address']; ?></th>
        <th><?php echo $row1['balance']; ?></th>
    </tr>
    <?php } }?>
</table>
