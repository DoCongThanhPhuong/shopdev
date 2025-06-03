<?php
    $order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $sql_order = "SELECT * FROM tblorder WHERE order_id = $order_id";
    $query_order = mysqli_query($mysqli, $sql_order);
    $row = mysqli_fetch_assoc($query_order);

    $sql_order_detail = "SELECT product_name, tblorder_details.quantity,
        tblorder_details.purchase_price FROM tblproduct
        INNER JOIN tblorder_details ON tblorder_details.product_id = tblproduct.product_id
        WHERE tblorder_details.order_id = $order_id";
    $query_order_detail = mysqli_query($mysqli, $sql_order_detail);

    $statusMap = [
        0 => 'Thất bại',
        1 => 'Đã thanh toán',
        2 => 'Đang giao',
        3 => 'Đã hủy',
        4 => 'Đã giao',
        5 => 'Đã hoàn tiền'
    ];
    $statusText = $statusMap[$row['order_status']] ?? 'Không xác định';
?>


<div id="content" class="container-fluid">
    <div class="card">
        <table class="table table-bordered table-checkall">
            <tr>
                <th colspan="4"><h3 class="text-center">Chi tiết đơn hàng</h3></th>
            </tr>
            <tr>
                <td colspan="2">Người nhận: <?= htmlspecialchars($row['order_receiver']) ?></td>
                <td colspan="2">Số điện thoại: <?= htmlspecialchars($row['order_phone']) ?></td>
            </tr>
            <tr>
                <td colspan="2">Địa chỉ: <?= htmlspecialchars($row['order_address']) ?></td>
                <td colspan="2">Thời gian tạo: <?= $row['order_created_at'] ?></td>
            </tr>
            <tr>
                <td colspan="4">Ghi chú: <?= htmlspecialchars($row['order_notes']) ?></td>
            </tr>
            <tr>
                <td colspan="2">Mã đơn hàng: <?= htmlspecialchars($row['order_code']) ?></td>
                <td colspan="2">Phương thức: <?= htmlspecialchars($row['order_payment']) ?></td>
            </tr>
            <tr>
                <td colspan="4">Trạng thái: <strong><?= $statusText ?></strong></td>
            </tr>

            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>

            <?php 
            $i = 0;
            while ($row_detail = mysqli_fetch_assoc($query_order_detail)) {
                $i++;
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= htmlspecialchars($row_detail['product_name']) ?></td>
                <td><?= $row_detail['quantity'] ?></td>
                <td><?= number_format($row_detail['purchase_price'], 0, ',', '.') ?> VND</td>
            </tr>
            <?php } ?>

            <tr>
                <th colspan="4">Tổng thanh toán: <?= number_format($row['order_value'], 0, ',', '.') ?> VND</th>
            </tr>
        </table>

        <div class="text-center mb-3">
            <?php if ($row['order_status'] == 1): ?>
                <a class="btn btn-primary" href="modules/manage_orders/process_order.php?id=<?= $order_id ?>&process=deliver">Giao hàng</a>
            <?php elseif ($row['order_status'] == 3): ?>
                <a class="btn btn-secondary" href="modules/manage_orders/process_order.php?id=<?= $order_id ?>&process=refund">Đã hoàn tiền</a>
            <?php endif; ?>
        </div>
    </div>
</div>
