<?php
include("frd.php");
?>
<button class="btn-home"><a href="home.php">Home</a></button>
<table class="table-pricelist">
  <tr>
    <th>#</th>
    <th>Price List Year</th>
    <th>View</th>
    <th>Download</th>
  </tr>
  <tr>
      <?php
      $i = 1;
      $qurey="SELECT * FROM price_list";
      $result=mysqli_query($conn,$qurey);
      while($row = mysqli_fetch_array($result)) { ?>
      <tr>
          <td><?php echo $i++; ?></td>
          <td><?php echo $row['price_list_change_date']; ?></td>
          <td><a href="uploads/<?php echo $row['pdf']; ?>" target="_blank">View</a></td>
          <td><a href="uploads/<?php echo $row['pdf']; ?>" download>Download</td>
      </tr>
      <?php } ?>
    
  </tr>
</table>