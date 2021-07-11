<?php
include "frd.php";
?>
  <table>
    <tr>
      <th>ID</th>
      <th>Item Name</th>
      <th>Manufacture</th>
      <th>Item Group</th>
    </tr>
    <?php
    $qurey="SELECT  * FROM item";
    $result=mysqli_query($conn,$qurey);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    ?>
    <tr>
      <td scope="row"><?php echo $row['id'];?></td>
      <td scope="row"><?php echo $row['style'];?></td>
      <td scope="row"><?php echo $row['Manufacture'];?></td>
      <td scope="row"><?php echo $row['item_group'];?></td>
    </tr>
    <?php }?>
  </table>
</body>

</html>
