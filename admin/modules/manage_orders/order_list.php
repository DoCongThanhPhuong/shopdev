<?php
    if(isset($_GET['process'])) {
        $query_order = mysqli_query($mysqli,"SELECT * FROM tblorder where order_status = '2' order by order_id DESC");
        $title = "Đơn hàng đã hủy";
    } else {
        $query_order = mysqli_query($mysqli,"SELECT * FROM tblorder where order_status = '1' order by order_id DESC");
        $title = "Đơn hàng đã duyệt";
    }
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 "><?= $title?></h5>
        </div>
    <table class="table table-striped table-checkall">
        <thead>
            <tr>
                <th scope="col">Mã</th>
                <th scope="col">Người nhận</th>
                <th scope="col">Điện thoại</th>
                <th scope="col">Thời gian</th>
                <th scope="col">Giá trị</th>
                <th scope="col">Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sum=0;
                $num=0;
                while($row_order = mysqli_fetch_array($query_order)){
                    $sum+=$row_order['order_value'];
                    $num++;
            ?>
            <tr>
                <td><?php echo $row_order['order_code']?></td>
                <td><?php echo $row_order['order_receiver']?></td>
                <td><?php echo $row_order['order_phone']?></td>
                <td><?php echo $row_order['order_created_at']?></td>
                <td><?php echo number_format($row_order['order_value'],0,',','.')?> VND</td>
                <td><a href="?order=order_details&id=<?php echo $row_order['order_id']?>"><i class="fas fa-eye"></i></a></td>
            </tr>
        <?php
        }
         $total_value=$sum;
        ?>
        <tr>
            <th colspan="5">Số lượng đơn hàng: <?= $num ?></th>
            <th colspan="3">Tổng giá trị: <?= number_format($total_value,0,',','.') ?> VND</th>
        </tr>
        </tbody>
    </table>
    </div>
    </div>
</div>