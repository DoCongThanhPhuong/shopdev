<?php
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $sql_getOrder = "SELECT * FROM tblorder WHERE tblorder.user_id = $user_id ORDER BY order_id DESC";
  $query_getOrder = mysqli_query($mysqli, $sql_getOrder);
}
?>

<div class="container min-height-100">
  <div class="row">
    <div class="col-md-12 mt-3 table-custom-wrapper">
      <h5 class="text-center">Lịch sử đặt hàng</h5>

      <?php
      if (isset($_SESSION['user_id']) && mysqli_num_rows($query_getOrder) > 0) {
      ?>
        <table class="table-custom">
          <thead>
            <tr class="text-center">
              <th scope="col">#</th>
              <th scope="col">Mã</th>
              <th scope="col">Người nhận</th>
              <th scope="col">Thời gian</th>
              <th scope="col">Giá trị</th>
              <th scope="col">Trạng thái</th>
              <th scope="col">Chi tiết</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 0;
            while ($row_getOrder = mysqli_fetch_array($query_getOrder)) {
              $i++;
              switch ($row_getOrder['order_status']) {
                case 0:
                  $status = "Chờ thanh toán";
                  $style = "text-danger";
                  break;
                case 1:
                  $status = "Đã thanh toán";
                  $style = "text-success";
                  break;
                case 2:
                  $status = "Đang giao";
                  $style = "text-info";
                  break;
                case 3:
                  $status = "Đã hủy";
                  $style = "text-danger";
                  break;
                case 4:
                  $status = "Đã giao";
                  $style = "text-primary";
                  break;
                default:
                  $status = "Không xác định";
                  $style = "text-muted";
              }
            ?>
              <tr class="text-center">
                <td><?php echo $i; ?></td>
                <td><?php echo $row_getOrder['order_code']; ?></td>
                <td><?php echo $row_getOrder['order_receiver']; ?></td>
                <td><?php echo $row_getOrder['order_created_at']; ?></td>
                <td><?php echo number_format($row_getOrder['order_value'], 0, ',', '.'); ?> VND</td>
                <td class="<?php echo $style; ?>"><?php echo $status; ?></td>
                <td>
                  <a href="index.php?navigate=order_details&id=<?php echo $row_getOrder['order_id']; ?>"><i class="fas fa-eye"></i></a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      <?php
      } else {
      ?>
        <p class="mt-3 text-center">Bạn chưa có đơn hàng</p>
      <?php
      }
      ?>
    </div>
  </div>
</div>
