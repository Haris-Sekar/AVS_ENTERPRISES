<?php
include("frd.php");
?>
<button class="btn-home"><a href="home.php">Home</a></button>
<table class="table-pricelist">
  <tr>
    <th>#</th>
    <th>Price List Year</th>
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
          <td><?php echo $row['file_name']; ?></td>
          <td><a href="pdf/<?php echo $row['pdf_file']; ?>" download id="black-text1">Click</a></td>
      </tr>
      <?php } ?>
    
  </tr>
</table>