<?php
    $sql_product = "SELECT * FROM tblproduct WHERE product_id = '$_GET[product_id]'";
    $query_product = mysqli_query($mysqli, $sql_product);
    $row_product = mysqli_fetch_array($query_product);

    $sql_comment = "SELECT * FROM tblcomment, tbluser
                    WHERE tblcomment.product_id = '$_GET[product_id]'
                    AND tblcomment.user_id = tbluser.user_id";
    $query_comment = mysqli_query($mysqli, $sql_comment);
?>

<div class="container mt-5">
    <form method="post" action="pages/main/cart/add.php?id=<?php echo $row_product['product_id']; ?>">
        <h2 class="text-center mb-4"><?php echo $row_product['product_name']; ?></h2>
        <div class="row">
            <div class="col-lg-5 mb-4">
                <div class="card shadow-sm">
                    <img src="./assets/images/products/<?php echo $row_product['product_image']; ?>"
                         alt="<?php echo $row_product['product_name']; ?>"
                         class="card-img-top"
                         style="height: 400px; object-fit: contain;">
                </div>
            </div>

            <div class="col-lg-7 mb-4">
                <h6 class="mb-3">Thông số kỹ thuật</h6>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">Hệ điều hành: <?php echo $row_product['product_os']; ?></li>
                            <li class="list-group-item">CPU: <?php echo $row_product['product_cpu']; ?></li>
                            <li class="list-group-item">RAM: <?php echo $row_product['product_ram']; ?> GB</li>
                            <li class="list-group-item">ROM: <?php echo $row_product['product_rom']; ?> GB</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">Màn hình: <?php echo $row_product['product_screen_size']; ?> inch</li>
                            <li class="list-group-item">Độ phân giải: <?php echo $row_product['product_screen_resolution']; ?></li>
                            <li class="list-group-item">Pin: <?php echo $row_product['product_battery']; ?> mAh</li>
                            <li class="list-group-item">Trọng lượng: <?php echo $row_product['product_weight']; ?> kg</li>
                        </ul>
                    </div>
                </div>

                <h6 class="mt-4">Thông tin thêm</h6>
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item">Thương hiệu: <?php echo $row_product['product_brand']; ?></li>
                    <li class="list-group-item">Chất liệu: <?php echo $row_product['product_material']; ?></li>
                    <li class="list-group-item">Camera: <?php echo $row_product['product_camera']; ?></li>
                </ul>

                <div class="mb-3">
                    <p>Giá gốc: <del><?php echo number_format($row_product['product_price'], 0, ',', '.'); ?> VND</del></p>
                    <p class="text-danger">Giảm giá: <?php echo $row_product['product_discount']; ?>%</p>
                    <p><strong>Giá sau giảm:</strong> 
                        <span>
                            <?php echo number_format($row_product['product_price'] * (100 - $row_product['product_discount']) / 100, 0, ',', '.'); ?> VND
                        </span>
                    </p>
                </div>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($row_product['product_quantity'] > 0): ?>
                        <div class="form-group row align-items-center">
                            <label for="quantity" class="col-sm-3 col-form-label"><strong>Số lượng:</strong></label>
                            <div class="col-sm-3">
                                <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" name="mua" class="btn btn-success w-100">Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="text-danger mt-2">Sản phẩm tạm thời hết hàng!</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </form>

    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm p-4">
                <h6 class="mb-3">Mô tả sản phẩm</h6>
                <p><?php echo $row_product['product_description']; ?></p>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="mt-5">
            <h6>Bình luận</h6>
            <?php while ($row_comment = mysqli_fetch_array($query_comment)): ?>
                <div class="alert alert-light border">
                    <p class="mb-1">
                        <strong><?php echo $row_comment['user_fullname']; ?></strong>
                        <small class="text-muted ml-2"><?php echo $row_comment['comment_time']; ?></small>
                    </p>
                    <p class="mb-0"><?php echo $row_comment['comment_content']; ?></p>
                </div>
            <?php endwhile; ?>

            <form action="pages/main/product/comment.php?product_id=<?php echo $row_product['product_id']; ?>" method="POST" class="mt-3">
                <div class="form-group">
                    <textarea name="comment_content" class="form-control" placeholder="Để lại bình luận..." rows="3" required></textarea>
                </div>
                <div class="form-group text-right">
                    <button type="submit" name="comment" class="btn btn-primary">Bình luận</button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>
