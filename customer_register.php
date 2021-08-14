<?php
include("frd.php");
?>
<head>
    <link rel="stylesheet" href="style1.css">
    <style>
        * {
  box-sizing: border-box;
  font-family: 'Cairo', sans-serif;

}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
    background-color: #008CBA;
      height: 35px;
      width: 70px;
      border-radius: 5px;
      position: relative;
      top: 15px;
      right: 20px;
      float: right;
      font-family: 'Cairo', sans-serif;
      border: none;
      color: white;
}

input[type=submit]:hover {
    background-color: #4CAF50;
    color: white;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
    </style>
</head>
<div class="container">
  <form action="" method="POST">
  <div class="row">
    <div class="col-25">
      <label for="shopname">Shop Name</label>
    </div>
    <div class="col-75">
      <input type="text" name="shopname" placeholder="Shop Name..." autocomplete="off">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="phone">Phone Number</label>
    </div>
    <div class="col-75">
      <input type="text" name="phone" placeholder="phone number" autocomplete="off">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="gst">GSTIN Number</label>
    </div>
    <div class="col-75">
    <input type="text" name="gst_number" placeholder="Gst number" autocomplete="off"><br>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="area">Main Area Name</label>
    </div>
    <div class="col-75">
    <input type="text" name="area" placeholder="Area" autocomplete="off"><br>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="address">Address</label>
    </div>
    <div class="col-75">
      <textarea id="address" name="address" placeholder="Address" style="height:200px" autocomplete="off"></textarea>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="area">Balance:</label>
    </div>
    <div class="col-75">
    <input type="number" name="bal" placeholder="&#x20b9 Balance" autocomplete="off"><br>
    </div>
  </div>
  <div class="row">
    <input type="submit" value="Submit" name="submit">
  </div>
  </form>
</div>
<?php
if(isset($_POST['submit'])){
    $name=$_POST['shopname'];
    $phone=$_POST['phone'];
    $gst=$_POST['gst_number'];
    $area=$_POST['area'];
    $address=$_POST['address'];
    $bal=$_POST['bal'];
    $qurey="INSERT INTO customer_details(`shop_name`, `phone_number`, `gst_number`, `area_name`, `address`) VALUES ('$name','$phone','$gst','$area','$address')";
    $result=mysqli_query($conn,$qurey);
    $qurey1="INSERT INTO customer_balance_details(`shop_name`, `balance`,'gst_number') VALUES ('$name','$bal','$gst')";
    $result1=mysqli_query($conn,$qurey1);
    if($result and $result1){
        header("location:home.php");
    }
    else{
        echo "error";
    }

}


?>