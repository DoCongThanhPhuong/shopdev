<?php
if (isset($_SESSION['user_id'])) {
  $user_id=$_SESSION['user_id'];
  $sql_getOrder="SELECT * FROM tblorder where tblorder.user_id=$user_id order by order_id DESC";
  $query_getOrder=mysqli_query($mysqli,$sql_getOrder);
}
?>

<div class="container min-height-100">
  <div class="row">
    <div class="col-md-12 mt-3">
      <h2 class="text-center">List of orders</h2>
      <table cellpadding="5px" class="table-bordered w-100 bg-white">
        <thead>
          <tr class="text-center">
            <th scope="col">No.</th>
            <th scope="col">ID</th>
            <th scope="col">Receiver</th>
            <th scope="col">Created time</th>
            <th scope="col">Value</th> 
            <th scope="col">Status</th>
            <th scope="col">Details</th> 
          </tr>
        </thead>
        <tbody>
        <?php
        if (isset($_SESSION['user_id'])) {
          $i=0;
        while($row_getOrder = mysqli_fetch_array($query_getOrder)){
          $i++;
          if($row_getOrder['order_status'] == 0) {$status = "Pending approval"; $style = "text-warning";}
          else if($row_getOrder['order_status'] == 1) {$status = "Approved"; $style = "text-success";}
          else {$status = "Cancelled"; $style = "text-danger";}
        ?>
            <td><?php echo $i ?></td>
            <td><?php echo $row_getOrder['order_id']; ?></td> 
            <td><?php echo $row_getOrder['order_receiver']; ?></td> 
            <td><?php echo $row_getOrder['order_created_time']; ?></td> 
            <td><?php echo number_format($row_getOrder['order_value'], 0, ',', '.'); ?> VND</td>
            <td class="<?php echo $style?>"><?php echo $status; ?></td>
            <td>
              <a href="index.php?navigate=order_details&id=<?php echo $row_getOrder['order_id']?>">View</a>
            </td>
      </tbody>
      <?php
          }
        }
        else {
          ?>
          <h4 class="text-center">No order history</h4>
          <?php
        }
        ?>
      </table>
    </div>
  </div>
</div>
