<?php
include('./frd.php')

?>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="addsalesrecipt.js"></script>
</head>
<div class="customer_name">
<form action="" method="post">
    <label>Customer Name:</label>
    <select name="shopname" class="text-feild" style="width:205px;">
        <option value="null">Select a customer</option>
        <?php 
            $qurey="SELECT * FROM customer_details;";
            $result=mysqli_query($conn,$qurey);
            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                ?>
                
                    <option value="<?php echo $row['shop_name']?>"><?php echo $row['shop_name']?></option>
                
                <?php
                    }?>
        </select>
        <input type="submit" value="Search" class="btn-search1" name="submit">
    </form>
</div>
<?php
    if(isset($_POST['submit'])){
        $cname=$_POST['shopname'];
        $shop_name1=$cname;
        $sql="SELECT * FROM customer_details WHERE shop_name='$cname'";
        $res=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
            $phone=$row['phone_number'];
            $gst_num=$row['gst_number'];
            $area=$row['area_name'];
            $address=$row['address'];
        }
        $balance_sql="SELECT * FROM customer_balance_details WHERE shop_name='$cname'";
        $balance_res=mysqli_query($conn,$balance_sql);
        $row2=mysqli_fetch_array($balance_res,MYSQLI_ASSOC);
        $balance=$row2['balance'];
        ?>
        <form action="" method="POST" class="cus_update_form">
        <div class="cus_update">
            <ul class="cus_update_exits">
                <li> Shop Name: <?php echo $cname; ?> <input type="text" name="shopname" placeholder="Enter the new Shop Name" autocomplete="OFF" id="text-feild"> <input type="submit" value="Change" class="btn-submit1" name="shopname_submit"> <input type="text" name="sname" id="" value="<?php echo $gst_num ;?>" hidden></li><br><hr>
                <li> Phone Number: <?php echo $phone; ?><input type="number" name="phone" placeholder="Enter the new Phone number" id="text-feild"><input type="submit" value="Change" class="btn-submit1" name="phone_submit"><input type="text" name="sname" id="" value="<?php echo $cname ;?>" hidden></li><br><hr>
                <li>GST Number:<?php  echo $gst_num; ?><input type="text" name="gst_number" placeholder="Enter the new GST Number" id="text-feild"><input type="submit" value="Change" class="btn-submit1" name="gst_submit"><input type="text" name="sname" id="" value="<?php echo $cname ;?>" hidden></li><br><hr>
                <li>Area Name: <?php echo $area; ?><input type="text" name="main_area" placeholder="Enter the new Main area" id="text-feild"><input type="submit" value="Change" class="btn-submit1" name="area_submit"><input type="text" name="sname" id="" value="<?php echo $cname ;?>" hidden></li><br><hr>
                <li id="textarea-address">Address: <?php echo $address; ?> <input type="text" name="address" id="text-feild" placeholder="Enter the new Address"><input type="submit" value="Change" class="btn-submit1" name="address_submit"> <input type="text" name="sname" id="" value="<?php echo $cname ;?>" hidden></li><br><hr>
            </ul>
            </form>
        </div>
        
    
<?php
    }
    ?>
    <script>
        var input=document.getElementById('bill_no');
        input.oninvalid=function(event){
            event.target.setCustomValidity('Bill Number already exits');
        }
    </script>

<?php 
if(isset($_POST['shopname_submit'])){
    $new_cname=$_POST['shopname'];
    $gst=$_POST['sname'];
    $sql1="UPDATE customer_balance_details SET shop_name='$new_cname' WHERE gst_number='$gst';";
    $result1=mysqli_query($conn,$sql1);
    if(!mysqli_error($conn)){
        $sql="UPDATE customer_details SET shop_name='$new_cname' WHERE gst_number='$gst';";
        $result=mysqli_query($conn,$sql);   
        ?> 
        <h3>Shop Name Changed Page will automatically refresh in 5 sec</h3>
        <?php
        header("Refresh:5");
    }
    else{
        echo mysqli_error($conn);   
    }
}
if(isset($_POST['phone_submit'])){
    $new_cname=$_POST['phone'];
    $shop_name1=$_POST['sname'];
    $sql="UPDATE customer_details SET phone_number='$new_cname' WHERE shop_name='$shop_name1';";
    $result=mysqli_query($conn,$sql);   
    if(!mysqli_error($conn)){
        
        ?> 
        <h3>Phone Number Changed Page will automatically refresh in 5 sec</h3>
        <?php
        header("Refresh:5");
    }
    else{
        echo mysqli_error($conn);   
    }
}
if(isset($_POST['gst_submit'])){
    $gst_number=$_POST['gst_number'];
    $shop_name1=$_POST['sname'];
    $sql="UPDATE customer_details SET gst_number='$gst_number' WHERE shop_name='$shop_name1';";
    $result=mysqli_query($conn,$sql);   
    if(!mysqli_error($conn)){
        
        ?> 
        <h3>GST Number Changed Page will automatically refresh in 5 sec</h3>
        <?php
        header("Refresh:5");
    }
    else{
        echo mysqli_error($conn);   
    }
}
if(isset($_POST['area_submit'])){
    $main_area=$_POST['main_area'];
    $shop_name1=$_POST['sname'];
    $sql="UPDATE customer_details SET area_name='$main_area' WHERE shop_name='$shop_name1';";
    $result=mysqli_query($conn,$sql);   
    if(!mysqli_error($conn)){
        
        ?> 
        <h3>Main Area Number Changed Page will automatically refresh in 5 sec</h3>
        <?php
        header("Refresh:5");
    }
    else{
        echo mysqli_error($conn);   
    }
}
if(isset($_POST['address_submit'])){
    $address=$_POST['address'];
    $shop_name1=$_POST['sname'];
    $sql="UPDATE customer_details SET address='$main_area' WHERE shop_name='$shop_name1';";
    $result=mysqli_query($conn,$sql);   
    if(!mysqli_error($conn)){
        
        ?> 
        <h3>Adderss Number Changed Page will automatically refresh in 5 sec</h3>
        <?php
        header("Refresh:5");
    }
    else{
        echo mysqli_error($conn);   
    }
}




?>
