<?php
    $sql_category="SELECT * FROM tblcategory ORDER BY category_id DESC";
    $query_category=mysqli_query($mysqli,$sql_category);
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form action="modules/manage_products/add.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input class="form-control" required type="text" name="product_name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="product_price">Giá</label>
                            <input class="form-control" required type="text" name="product_price" id="product_price">
                        </div>
                        <div class="form-group">
                            <label for="product_quantity">Số lượng</label>
                            <input class="form-control" required type="text" name="product_quantity" id="product_quantity">
                        </div>
                        <div class="form-group">
                            <label for="product_brand">Thương hiệu</label>
                            <input class="form-control" required type="text" name="product_brand" id="product_brand">
                        </div>
                        <div class="form-group">
                            <label for="product_material">Chất liệu</label>
                            <input class="form-control" required type="text" name="product_material" id="product_material">
                        </div>
                        <div class="form-group">
                            <label for="product_ram">RAM</label>
                            <input class="form-control" required type="text" name="product_ram" id="product_ram">
                        </div>
                        <div class="form-group">
                            <label for="product_rom">ROM</label>
                            <input class="form-control" required type="text" name="product_rom" id="product_rom">
                        </div>
                        <div class="form-group">
                            <label for="product_cpu">CPU</label>
                            <input class="form-control" required type="text" name="product_cpu" id="product_cpu">
                        </div>
                        <div class="form-group">
                            <label for="product_gpu">GPU</label>
                            <input class="form-control" required type="text" name="product_gpu" id="product_gpu">
                        </div>
                        <div class="form-group">
                            <label for="product_screen_size">Kích thước màn hình</label>
                            <input class="form-control" required type="text" name="product_screen_size" id="product_screen_size">
                        </div>
                        <div class="form-group">
                            <label for="product_screen_resolution">Độ phân giải màn hình</label>
                            <input class="form-control" required type="text" name="product_screen_resolution" id="product_screen_resolution">
                        </div>
                        <div class="form-group">
                            <label for="product_battery">Pin</label>
                            <input class="form-control" required type="text" name="product_battery" id="product_battery">
                        </div>
                        <div class="form-group">
                            <label for="product_camera">Camera</label>
                            <input class="form-control" required type="text" name="product_camera" id="product_camera">
                        </div>
                        <div class="form-group">
                            <label for="product_os">Hệ điều hành</label>
                            <input class="form-control" required type="text" name="product_os" id="product_os">
                        </div>
                        <div class="form-group">
                            <label for="product_weight">Trọng lượng</label>
                            <input class="form-control" required type="text" name="product_weight" id="product_weight">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="product_description">Mô tả</label>
                            <textarea name="product_description" class="form-control" required id="product_description" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="product_image">Hình ảnh</label>
                    <input class="form-control" required type="file" name="product_image" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="product_category">Danh mục</label>
                    <select class="form-control" required name="product_category">
                        <?php while ($row_category=mysqli_fetch_array($query_category)) { ?>
                        <option value="<?php echo $row_category['category_id']?>"><?php echo $row_category['category_name']?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_discount">Giảm giá(%)</label>
                    <input class="form-control" required type="text" name="product_discount" id="product_discount">
                </div>
                <input type="submit" class="btn btn-primary"  value="Thêm" name="submit">
            </form>
        </div>
    </div>
</div>