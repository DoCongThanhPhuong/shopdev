<?php
  $user_id = $_SESSION['user_id'];
  $sql_cart_detail =
    "SELECT tblcart.product_id, tblcart.quantity,
    tblproduct.product_name, tblproduct.product_price, tblproduct.product_discount
    FROM tblcart
    INNER JOIN tblproduct ON tblcart.product_id = tblproduct.product_id
    WHERE tblcart.user_id = $user_id";
  $query_cart_detail = mysqli_query($mysqli, $sql_cart_detail);
  $_SESSION['order_receiver'] = $_POST['order_receiver'];
  $_SESSION['order_address'] = $_POST['order_address'];
  $_SESSION['order_phone'] = $_POST['order_phone'];
  $_SESSION['order_notes'] = $_POST['order_notes'];
  $total_value = isset($_SESSION['total_value']) ? $_SESSION['total_value'] : 0;
?>

<div class="container py-5">
    <div class="row">
      <div class="col-lg-8 mt-5 table-custom-wrapper">
        <table class="table-custom">
          <tr class="text-center">
            <td colspan="4"><h5>Chi tiết đơn hàng</h5></td>
          </tr>
          <tr>
            <td colspan="4">Người nhận: <?php echo $_SESSION['order_receiver'] ?></td>
          </tr>
          <tr>
            <td colspan="2">Địa chỉ: <?php echo $_SESSION['order_address'] ?></td>
            <td colspan="2">Số điện thoại: <?php echo $_SESSION['order_phone'] ?></td>
          </tr>
          <tr>
            <td colspan="4">Ghi chú: <?php echo $_SESSION['order_notes'] ?></td>
          </tr>
            <tr class="text-center">
              <th scope="col">#</th>
              <th scope="col">Tên sản phẩm</th>
              <th scope="col">Số lượng</th>
              <th scope="col">Giá</th>
            </tr>
              <?php
                $i=0;
                $total_value = 0;
                while($row_detail = mysqli_fetch_assoc($query_cart_detail)) {
                  $i++;
              ?>
                <tr class="text-center">
                  <td><?= $i?></td>
                  <td>
                    <?= $row_detail['product_name'] ?>
                  </td>
                  <td>
                    <?= $row_detail['quantity'] ?>
                  </td>
                  <td>
                    <?= number_format($row_detail['product_price'] *(100 - $row_detail['product_discount'])/ 100,0,',','.') ?> VND
                  </td>
                </tr>
              <?php
                $value = (int)$row_detail['quantity'] * (int)$row_detail['product_price'] * (100-$row_detail['product_discount'])/100;
                $total_value += $value;
                }
              ?>
              <tr>
                <th colspan="5" scope="col">Tổng giá trị:  <?= number_format($total_value,0,',','.') ?> VND</th>
              </tr>
        </table>
        <a class="mt-5 btn btn-danger" href="index.php?navigate=cart">Trở lại</a>
      </div>
      <div class="col-lg-4 mt-5">
      <div class="table-custom-wrapper">
          <form method="POST" action="pages/main/order/process_payment.php">
              <p class="mt-2 text-center">PHƯƠNG THỨC THANH TOÁN</p>
              <input class="d-block btn btn-success mt-3 w-100" type="submit" name="cod" value="Thanh toán tiền mặt (COD)">
              <input class="d-block btn btn-primary mt-3 w-100" type="submit" name="vnpay" value="Thanh toán qua VNPAY">
          </form>
          <form method="POST" enctype="application/x-www-form-urlencoded"
                          action="pages/main/order/momo_qr_payment.php">
            <input type="hidden" name="total_value" value="<?php echo $total_value?>">
            <input class="btn text-light mt-3 w-100" style="background-color: #ae2170; border-color: #ae2170;"
            type="submit" value="Thanh toán qua MOMO QR Code">
          </form>
          <form method="POST" enctype="application/x-www-form-urlencoded"
                          action="pages/main/order/momo_atm_payment.php">
            <input type="hidden" name="total_value" value="<?php echo $total_value?>">
            <input class="btn text-light mt-3 w-100" style="background-color: #ae2170; border-color: #ae2170;"
            type="submit" value="Thanh toán qua MOMO ATM">
          </form>
        </div>
      </div>
  </div>
</div>