<?php
include ("./frd.php");

?>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="addsalesrecipt.js"></script>
</head>

    <form action="" method="post" class="form-additem1" id="formadditem">
    <div class="form-items1">
    <label>Company Name Name:</label>
    <select name="sname" class="text-feild" style="width:205px;" >
    <option value="null">Select a Company</option>
    <?php 
        $qurey="SELECT * FROM buyer_compnay_reg;";
        $result=mysqli_query($conn,$qurey);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            ?>
            
                <option value="<?php echo $row['company_name']?>"><?php echo $row['company_name']?></option>
            
<?php
        }
    
    
    ?></select><br>
        <label for="">Amount:</label>
        <input type="number" name="amt" id="" class="text-feild" placeholder="&#x20b9" require> <br>
        <label for="">Date:</label>
        <input type="date" id="date" name="date" class="text-feild" require>
        <script>
            $('#date').val(new Date().toJSON().slice(0,10));
        </script><br>
        <label>User:</label>
        <input type="text" value="<?php echo $user;?>" disabled class="text-feild" style="text-transform: uppercase;" name="user"><br>
        <input type="submit" value="Submit" name="submit" class="btn-submit" id="sub-btn" style="top: 10px;">
    </div>
    </form>
    <?php
        if(isset($_POST['submit'])){
            $amt=$_POST['amt'];
            $sname=$_POST['sname'];
            $date=$_POST['date'];
            echo $date;
            $sql4="SELECT * FROM buyer_compnay_reg WHERE company_name='$sname'";
            $result5=mysqli_query($conn,$sql4);
            while($cus_det=mysqli_fetch_array($result5,MYSQLI_ASSOC)){
                $balance=$cus_det['balance'];
            }
            if($balance>$amt){
                    $sql="INSERT INTO `purchase_recipt`(`company_name`, `date`, `amt`, `user`) VALUES ('$sname','$date','$amt','$user')";
                    $result=mysqli_query($conn,$sql);
                    $sql2="UPDATE buyer_compnay_reg SET balance=balance-'$amt' WHERE company_name='$sname'";
                    $result2=mysqli_query($conn,$sql2);
                    if(mysqli_error($conn)){
                        echo mysqli_error($conn);
                        //echo "Went Worng!!";
                    }
                    else{
                        ?>
                        <h2 id="stsmsg"><center>Status:<font color="green">Payment Recipt Added!</font></center></h2>
                    <?php
                    }
                $qurey="SELECT * FROM buyer_compnay_reg WHERE company_name='$sname'";
                $result4=mysqli_query($conn,$qurey);
                while($row=mysqli_fetch_array($result4,MYSQLI_ASSOC)){
                ?>
                    <script> alert("<h2 id="stsmsg"><center>Remainig Balance:<font color="green"><?php echo $row['balance']; ?></font></center></h2>");</script>
            <?php
            }
        }
            else{
                $qurey="SELECT * FROM buyer_compnay_reg WHERE company_name='$sname'";
                $result4=mysqli_query($conn,$qurey);
                while($row=mysqli_fetch_array($result4,MYSQLI_ASSOC)){
                    echo "<script>alert('Balance is:$balance') </script>";
                }

            }
        }
    
    ?>
