<?php
    $keyword = '';
    if (isset($_POST['keyword'])) {
        $keyword = $_POST['keyword'];
        $_SESSION['keyword'] = $keyword;
    } elseif (isset($_SESSION['keyword'])) {
        $keyword = $_SESSION['keyword'];
    }

    $page = isset($_GET['trang']) ? (int)$_GET['trang'] : 1;
    $limit = 8;
    $begin = ($page - 1) * $limit;

    if ($keyword != '') {
        $sql_product = "SELECT * FROM tblproduct WHERE product_name LIKE '%$keyword%' ORDER BY product_id DESC LIMIT $begin, $limit";
        $sql_count = "SELECT * FROM tblproduct WHERE product_name LIKE '%$keyword%'";
    } else {
        $sql_product = "SELECT * FROM tblproduct ORDER BY product_id DESC LIMIT $begin, $limit";
        $sql_count = "SELECT * FROM tblproduct";
    }

    $query_product = mysqli_query($mysqli, $sql_product);
    $total_row = mysqli_num_rows(mysqli_query($mysqli, $sql_count));
    $total_page = ceil($total_row / $limit);
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 text-center">Danh sách sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="" method="POST" class="d-flex">
                    <input type="text" class="form-control form-search" placeholder="Tên sản phẩm" name="keyword"
                           value="<?php echo htmlspecialchars($keyword); ?>">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary ml-2">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="tableInfo">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Giảm giá</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = $begin;
                        while ($row = mysqli_fetch_array($query_product)) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td>
                                <img class="product-img" src="../assets/images/products/<?php echo $row['product_image']; ?>"
                                     alt="<?php echo $row['product_name']; ?>" width="80">
                            </td>
                            <td class="truncate-text"><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['product_quantity']; ?></td>
                            <td><?php echo number_format($row['product_price'], 0, ',', '.'); ?>đ</td>
                            <td><?php echo $row['product_discount']; ?>%</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="?product=update_product&id=<?php echo $row['product_id']; ?>"
                                       class="btn btn-warning btn-sm rounded text-white mr-2"
                                       title="Sửa">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="?product=delete_product&id=<?php echo $row['product_id']; ?>"
                                       class="btn btn-danger btn-sm rounded text-white"
                                       title="Xóa"
                                       onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <ul class="d-flex justify-content-center list-unstyled">
                <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                    <li class="p-2 m-1" style="background: <?php echo ($i == $page) ? '#ccc' : '#fff'; ?>">
                        <a class="text-dark" href="index.php?product=product_list&trang=<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
