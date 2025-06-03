<?php
$statusMap = [
    '' => 'Tất cả',
    '0' => 'Chờ thanh toán',
    '1' => 'Đã thanh toán',
    '2' => 'Đang giao',
    '3' => 'Đã hủy',
    '4' => 'Đã giao',
    '5' => 'Đã hoàn tiền'
];

$status = isset($_GET['status']) ? $_GET['status'] : '';

if ($status !== '' && array_key_exists($status, $statusMap)) {
    $query_order = mysqli_query($mysqli, "SELECT * FROM tblorder WHERE order_status = '$status' ORDER BY order_id DESC");
    $title = "Đơn hàng - " . $statusMap[$status];
} else {
    $query_order = mysqli_query($mysqli, "SELECT * FROM tblorder ORDER BY order_id DESC");
    $title = "Tất cả đơn hàng";
}
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0"><?= $title ?></h5>
            <form method="GET" class="form-inline">
                <input type="hidden" name="order" value="order_list">
                <label for="status" class="mr-2">Lọc trạng thái:</label>
                <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                    <?php foreach ($statusMap as $key => $label): ?>
                        <option value="<?= $key ?>" <?= ($status === (string)$key) ? 'selected' : '' ?>>
                            <?= $label ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <table class="table table-striped table-checkall">
            <thead>
                <tr>
                    <th scope="col">Mã</th>
                    <th scope="col">Người nhận</th>
                    <th scope="col">Điện thoại</th>
                    <th scope="col">Thời gian</th>
                    <th scope="col">Giá trị</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Xem</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sum = 0;
                $num = 0;
                while ($row_order = mysqli_fetch_array($query_order)) {
                    $sum += $row_order['order_value'];
                    $num++;
                    $order_status_label = $statusMap[$row_order['order_status']] ?? 'Không xác định';
                    ?>
                    <tr>
                        <td><?= $row_order['order_code'] ?></td>
                        <td><?= $row_order['order_receiver'] ?></td>
                        <td><?= $row_order['order_phone'] ?></td>
                        <td><?= $row_order['order_created_at'] ?></td>
                        <td><?= number_format($row_order['order_value'], 0, ',', '.') ?> VND</td>
                        <td><?= $order_status_label ?></td>
                        <td>
                            <a href="?order=order_details&id=<?= $row_order['order_id'] ?>">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <th colspan="6">Số lượng đơn hàng: <?= $num ?></th>
                    <th>Tổng giá trị: <?= number_format($sum, 0, ',', '.') ?> VND</th>
                </tr>
            </tbody>
        </table>
    </div>
</div>
