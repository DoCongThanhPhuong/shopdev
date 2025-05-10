<?php
    $order_id = isset($_GET['id']) ? $_GET['id'] : '';
    $sql_order = "SELECT * from tblorder where order_id = $order_id";
    $query_order = mysqli_query($mysqli, $sql_order);
    $row = mysqli_fetch_assoc($query_order);
    $sql_order_detail = "SELECT product_name, tblorder_details.quantity,
    tblorder_details.purchase_price from tblproduct inner join tblorder_details
    on tblorder_details.product_id = tblproduct.product_id
    where tblorder_details.order_id = $order_id";
    $query_order_detail = mysqli_query($mysqli, $sql_order_detail);
?>

<div id="content" class="container-fluid">
    <div class="card">
    <table class="table table-bordered table-checkall">
    <tr>
            <th colspan="4"><h3 class="text-center">Chi tiết đơn hàng</h3></th>
        </tr>
        <tr>
            <td colspan="2">Người nhận: <?= $row['order_receiver']?></td>
            <td colspan="2">Số điện thoại: <?= $row['order_phone']?></td>
        </tr>
        <tr>
            <td colspan="2">Địa chỉ: <?= $row['order_address']?></td>
            <td colspan="2">Thời gian tạo: <?= $row['order_created_at']?></td>
        </tr>
        <tr>
            <td colspan="4">Ghi chú: <?= $row['order_notes']?></td>
        </tr>
        <tr>
            <td colspan="2">Mã đơn hàng: <?= $row['order_code']?></td>
            <td colspan="2">Phương thức: <?= $row['order_payment']?></td>
        </tr>
        <tr>
            <th>#</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
        </tr>
        <?php 
            $i=0;
            while($row_detail = mysqli_fetch_assoc($query_order_detail)){
            $i++;
        ?>
        <tr>
            <td><?= $i?></td>
            <td><?= $row_detail['product_name']?></td>
            <td><?= $row_detail['quantity']?></td>
            <td><?= number_format($row_detail['purchase_price'],0,',','.')?> VND</td>
        </tr>
        <?php }?>
        <tr>
            <th colspan="4">Tổng thanh toán: <?= number_format($row['order_value'],0,',','.')?> VND</th>
        </tr>
    </table>
        </div>
    </div>
</div>