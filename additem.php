<?php
include('frd.php');
?>
<button class="btn-home"><a href="home.php">Home</a></button>
<form action="" method="post" class="form-additem">
    <div class="form-items">
    <label>Item Name:</label>
    <input type="text" name="stylename" class="text-feild" autocapitalize="characters" autocomplete="off"><br>
    <label>Item Group:</label>
    <input type="text" name="item_group" class="text-feild" autocapitalize="characters" autocomplete="off"><br>
    <label>	Manufacture Name:</label>
    <input type="text" name="manufacture" class="text-feild" autocapitalize="characters" autocomplete="off"><br><br>
    <input type="submit" name="submit" value="Add Item" class="btn-update-pricelist-submit">
    </div>
</form>
<?php
if(isset($_POST['submit'])){
    $item=strtoupper($_POST['stylename']);
    $grp=strtoupper($_POST['item_group']);
    $man=strtoupper($_POST['manufacture']);
    $qurey="INSERT INTO item(`style`, `Manufacture`, `item_group`) VALUES ('$item','$man','$grp');";
    $result=mysqli_query($conn,$qurey);
    if($result){
        ?>
        <h2>Item Added!</h2>
        <?php
    }
    else{
        echo "error";
    }
}

?>