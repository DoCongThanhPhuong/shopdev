<?php
    $sql_CountOrder1 = mysqli_query($mysqli,"SELECT * FROM tblorder WHERE order_status  = '1'");
    $CountOrder1 = mysqli_num_rows($sql_CountOrder1);
    $sql_AllMoney = mysqli_query($mysqli,"SELECT order_value FROM tblorder where order_status = '4'");
    $i=0;
    while($allMoney=mysqli_fetch_array($sql_AllMoney)){
        $i+=$allMoney['order_value'];
    }
    $AllMoney=0;
    $AllMoney=$i;
    $sql_CountOrder2 = mysqli_query($mysqli,"SELECT * FROM tblorder WHERE order_status = '4'");
    $CountOrder2 = mysqli_num_rows($sql_CountOrder2);
    $sql_CountOrder3 = mysqli_query($mysqli,"SELECT order_id FROM tblorder WHERE order_status = '3'");
    $CountOrder3 = mysqli_num_rows($sql_CountOrder3);
?>
<div class="container-fluid py-5">
    <div class="row">
        <div class="col">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem; height: 120px;">
                <div class="card-header">DOANH THU</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo number_format($AllMoney,0,',','.') ?> VND</h5>
                </div>
             </div>
        </div>
        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem; height: 120px;">
                <div class="card-header">ĐƠN ĐÃ THANH TOÁN</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $CountOrder1 ?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem; height: 120px;">
                <div class="card-header">ĐƠN ĐÃ GIAO</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $CountOrder2 ?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem; height: 120px;">
                <div class="card-header">ĐƠN ĐÃ HỦY</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $CountOrder3 ?></h5>
                </div>
            </div>
    </div>
</div>
    <div class="card">
        <p class="card-header font-weight-bold">
            Đơn hàng đã thanh toán
        </p>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Người nhận</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Phương thức</th>
                        <th scope="col">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    while($row=mysqli_fetch_array($sql_CountOrder1)){
                    $i++;?>
                    <tr>
                        <th scope="row"><?php echo $i?></th>
                        <td><?php echo $row['order_code']?></td>
                        <td>
                            <?php echo $row['order_receiver']?>
                        </td>
                        <td><?php echo number_format($row['order_value'],0,',','.')?> VND</td>
                        <td><?php echo $row['order_created_at']?></td>
                        <td><?php echo $row['order_payment']?></td>
                        <td><a href="?order=order_details&id=<?php echo $row['order_id']?>"><i class="fas fa-eye"></i></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>