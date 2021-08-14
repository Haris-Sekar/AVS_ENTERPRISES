<?php 
include("frd.php");

?>
<div class="cus_det">
<h2 id="filter-text">Filters</h2+>
<form action="" method="post">
<input type="search" name="name_filter" placeholder="Search by Name" class="searchbar" autocomplete="off"> 
<input type="search" name="area_filter" placeholder="Search by Area" class="filter-area" autocomplete="off"><br><br>
<input type="submit" name="submit" value="Apply filter" class="btn-search"> 
</form>
<table>
    <tr>
        <th>Company Name</th>
        <th>Phone Number</th>
        <th>GSTIN Number</th>
        <th>Address</th>
        <th>Total Balance</th>
        <th>View</th>
    </tr>
    <?php 
    if(isset($_POST['submit'])){
        $name=$_POST['name_filter'];
        $area=$_POST['area_filter'];
        $qurey2="SELECT * FROM buyer_compnay_reg WHERE company_name LIKE '%$name%' AND area_name LIKE '%$area%'";
        $result2=mysqli_query($conn,$qurey2);
        while($row3=mysqli_fetch_array($result2,MYSQLI_ASSOC)){?>
    <tr>
        <th><?php echo $row3['company_name']; $sname=$row3['shop_name']; ?></th>
        <th><?php echo $row3['phone']; ?></th>
        <th><?php echo $row3['gst']; ?></th>
        <th><?php echo $row3['address']; ?></th>
        <th><?php echo $row3 ['balance']; ?></th>
        <th><button  type="submit" name="details"><a href="comdet.php?cname=<?php echo $sname; ?>?>"> Details</a></button></th>
    </tr>
        <?php
    }
}
    else
    {
    $qurey="SELECT * FROM buyer_compnay_reg";
    $result=mysqli_query($conn,$qurey);
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){?>
    <tr>
        <th><?php echo $row['company_name']; $sname=$row['company_name'];?></th>
        <th><?php echo $row['phone']; ?></th>
        <th><?php echo $row['gst']; ?></th>
        <th><?php echo $row['address']; ?></th>
        <th><?php echo $row['balance']; ?></th>
        <th><button  type="submit" name="details" class="button"><a href="comdet.php?cname=<?php echo $sname; ?>"  > Details</a></button></th>

    </tr>
    <?php } }?>
</table>
</div>
