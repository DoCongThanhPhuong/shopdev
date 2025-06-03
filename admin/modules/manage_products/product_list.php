<?php
    $categories = mysqli_query($mysqli, "SELECT * FROM tblcategory WHERE category_is_deleted = 0");
    $brands = mysqli_query($mysqli, "SELECT * FROM tblbrand WHERE brand_is_deleted = 0");
    $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : (isset($_SESSION['keyword']) ? $_SESSION['keyword'] : '');
    $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';
    $brand_id = isset($_GET['brand_id']) ? $_GET['brand_id'] : '';
    $sort_by_sold = isset($_GET['sort']) && $_GET['sort'] === 'sold';
    $page = isset($_GET['trang']) ? (int)$_GET['trang'] : 1;
    $limit = 8;
    $begin = ($page - 1) * $limit;

    $where = "product_is_deleted = 0";
    if ($keyword != '') {
        $where .= " AND product_name LIKE '%" . mysqli_real_escape_string($mysqli, $keyword) . "%'";
        $_SESSION['keyword'] = $keyword;
    }
    if ($category_id != '') {
        $where .= " AND category_id = '" . mysqli_real_escape_string($mysqli, $category_id) . "'";
    }
    if ($brand_id != '') {
        $where .= " AND brand_id = '" . mysqli_real_escape_string($mysqli, $brand_id) . "'";
    }

    $order_by = $sort_by_sold ? "ORDER BY product_sold DESC" : "ORDER BY product_id DESC";
    $sql_product = "SELECT * FROM tblproduct WHERE $where $order_by LIMIT $begin, $limit";
    $query_product = mysqli_query($mysqli, $sql_product);
    $sql_count = "SELECT COUNT(*) AS total FROM tblproduct WHERE $where";
    $row_count = mysqli_fetch_assoc(mysqli_query($mysqli, $sql_count));
    $total_row = $row_count ? $row_count['total'] : 0;
    $total_page = max(1, ceil($total_row / $limit));
?>


<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 text-center">Danh sách sản phẩm</h5>
            <div class="form-inline">
                <form action="" method="POST" class="d-flex mr-3">
                    <input type="text" class="form-control" placeholder="Tên sản phẩm" name="keyword"
                           value="<?= htmlspecialchars($keyword) ?>">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary ml-2">
                </form>

                <form method="GET" class="form-inline">
                    <input type="hidden" name="product" value="product_list">
                    
                    <select name="category_id" class="form-control mr-2" onchange="this.form.submit()">
                        <option value="">-- Chọn danh mục --</option>
                        <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                            <option value="<?= $cat['category_id'] ?>" <?= ($category_id == $cat['category_id']) ? 'selected' : '' ?>>
                                <?= $cat['category_name'] ?>
                            </option>
                        <?php } ?>
                    </select>

                    <select name="brand_id" class="form-control mr-2" onchange="this.form.submit()">
                        <option value="">-- Chọn thương hiệu --</option>
                        <?php while ($brand = mysqli_fetch_assoc($brands)) { ?>
                            <option value="<?= $brand['brand_id'] ?>" <?= ($brand_id == $brand['brand_id']) ? 'selected' : '' ?>>
                                <?= $brand['brand_name'] ?>
                            </option>
                        <?php } ?>
                    </select>

                    <a href="?product=product_list&sort=sold" class="btn btn-success">Bán chạy nhất</a>
                </form>
            </div>
        </div>

        <div class="card-body">
            <div class="tableInfo">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Số lượng</th>
                            <th>Đã bán</th>
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
                                <td><?= $i ?></td>
                                <td class="truncate-text"><?= $row['product_name'] ?></td>
                                <td><?= $row['product_quantity'] ?></td>
                                <td><?= $row['product_sold'] ?></td>
                                <td><?= number_format($row['product_price'], 0, ',', '.') ?>đ</td>
                                <td><?= $row['product_discount'] ?>%</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="?product=update_product&id=<?= $row['product_id'] ?>" class="btn btn-warning btn-sm mr-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="?product=delete_product&id=<?= $row['product_id'] ?>" class="btn btn-danger btn-sm"
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
                    <li class="p-2 m-1" style="background: <?= ($i == $page) ? '#ccc' : '#fff' ?>;">
                        <a class="text-dark" href="index.php?product=product_list&trang=<?= $i ?>&category_id=<?= $category_id ?>&brand_id=<?= $brand_id ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
