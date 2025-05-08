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
      <h5 class="text-center">Danh sách đơn hàng</h5>
      <table cellpadding="5px" class="table-bordered w-100 bg-white">
        <thead>
          <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Người nhận</th>
            <th scope="col">Thời gian</th>
            <th scope="col">Giá trị</th> 
            <th scope="col">Trạng thái</th>
            <th scope="col">Chi tiết</th> 
          </tr>
        </thead>
        <tbody>
        <?php
        if (isset($_SESSION['user_id'])) {
          $i=0;
        while($row_getOrder = mysqli_fetch_array($query_getOrder)){
          $i++;
          if($row_getOrder['order_status'] == 0) {$status = "Chờ duyệt"; $style = "text-warning";}
          elseif($row_getOrder['order_status'] == 1) {$status = "Đã duyệt"; $style = "text-success";}
          else {$status = "Đã hủy"; $style = "text-danger";}
        ?>
            <td><?php echo $i ?></td>
            <td><?php echo $row_getOrder['order_id']; ?></td> 
            <td><?php echo $row_getOrder['order_receiver']; ?></td> 
            <td><?php echo $row_getOrder['order_created_at']; ?></td> 
            <td><?php echo number_format($row_getOrder['order_value'], 0, ',', '.'); ?> VND</td>
            <td class="<?php echo $style?>"><?php echo $status; ?></td>
            <td>
              <a href="index.php?navigate=order_details&id=<?php echo $row_getOrder['order_id']?>"><i class="fas fa-eye"></i></a>
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
