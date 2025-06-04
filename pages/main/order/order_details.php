<?php
    $order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $sql_order = "SELECT order_receiver, order_phone, order_created_at,
        order_notes, order_code, order_payment, order_value, order_status
        FROM tblorder WHERE order_id = $order_id";
    $query_order = mysqli_query($mysqli, $sql_order);
    $row = mysqli_fetch_assoc($query_order);

    $sql_order_details = "SELECT product_name, tblorder_details.quantity,
        tblorder_details.purchase_price
        FROM tblproduct
        INNER JOIN tblorder_details ON tblorder_details.product_id = tblproduct.product_id
        WHERE tblorder_details.order_id = $order_id";
    $query_order_details = mysqli_query($mysqli, $sql_order_details);

    $statusMap = [
        0 => 'Chờ thanh toán',
        1 => 'Đã thanh toán',
        2 => 'Đang giao',
        3 => 'Đã hủy',
        4 => 'Đã giao',
        5 => 'Đã hoàn tiền'
    ];
    $statusText = $statusMap[$row['order_status']] ?? 'Không xác định';
?>


<div class="container mt-5 table-custom-wrapper">
    <table class="table-custom">
        <tr>
            <th colspan="4" scope="col"><h5 class="text-center">Chi tiết đơn hàng</h5></th>
        </tr>
        <tr>
            <td colspan="2">Người nhận: <?= htmlspecialchars($row['order_receiver']) ?></td>
            <td colspan="2">Số điện thoại: <?= htmlspecialchars($row['order_phone']) ?></td>
        </tr>
        <tr>
            <td colspan="2">Địa chỉ: <?= htmlspecialchars($row['order_phone']) ?></td>
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
        while ($row_details = mysqli_fetch_assoc($query_order_details)) {
            $i++;
        ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= htmlspecialchars($row_details['product_name']) ?></td>
            <td><?= $row_details['quantity'] ?></td>
            <td><?= number_format($row_details['purchase_price'], 0, ',', '.') ?> VND</td>
        </tr>
        <?php } ?>

        <tr>
            <th colspan="4">Tổng giá trị: <?= number_format($row['order_value'], 0, ',', '.') ?> VND</th>
        </tr>
    </table>

    <?php if ($row['order_status'] == 0 || $row['order_status'] == 1): ?>
        <div class="text-center mt-2">
            <a class="btn btn-danger" href="pages/main/order/cancel.php?id_cancel=<?= $order_id ?>">Hủy đơn hàng</a>
        </div>
    <?php endif; ?>
</div>

