<?php
    $sql_category="SELECT * FROM tblcategory ORDER BY category_id DESC";
    $query_category=mysqli_query($mysqli,$sql_category);
    $sql_brand="SELECT * FROM tblbrand ORDER BY brand_id DESC";
    $query_brand=mysqli_query($mysqli,$sql_brand);
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">Thêm sản phẩm</div>
        <div class="card-body">
            <form action="modules/manage_products/add.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"><label for="name">Tên</label><input class="form-control" required type="text" name="product_name" id="name"></div>
                        <div class="form-group"><label for="product_description">Mô tả</label><textarea name="product_description" class="form-control" required id="product_description" cols="30" rows="4"></textarea></div>
                        <div class="form-group"><label for="product_price">Giá (VNĐ)</label><input class="form-control" required type="number" min="0" name="product_price" id="product_price"></div>
                        <div class="form-group"><label for="product_quantity">Số lượng</label><input class="form-control" required type="number" min="1" step="1" name="product_quantity" id="product_quantity"></div>
                        <div class="form-group"><label for="product_discount">Giảm giá (%)</label><input class="form-control" required type="number" min="0" max="100" name="product_discount" id="product_discount"></div>
                        <div class="form-group"><label for="product_brand">Thương hiệu</label><select class="form-control" required name="product_brand"><?php while ($row_brand=mysqli_fetch_array($query_brand)) { ?><option value="<?php echo $row_brand['brand_id']?>"><?php echo $row_brand['brand_name']?></option><?php } ?></select></div>
                        <div class="form-group"><label for="product_category">Danh mục</label><select class="form-control" required name="product_category"><?php while ($row_category=mysqli_fetch_array($query_category)) { ?><option value="<?php echo $row_category['category_id']?>"><?php echo $row_category['category_name']?></option><?php } ?></select></div>
                        <div class="form-group"><label for="product_image">Hình ảnh</label><input class="form-control" required type="file" name="product_image" accept="image/png, image/jpeg, image/webp"></div>
                        <div class="form-group"><label for="product_material">Chất liệu</label><input class="form-control" required type="text" name="product_material" id="product_material"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><label for="product_ram">RAM (GB)</label><input class="form-control" required type="number" min="1" name="product_ram" id="product_ram"></div>
                        <div class="form-group"><label for="product_rom">ROM (GB)</label><input class="form-control" required type="number" min="1" name="product_rom" id="product_rom"></div>
                        <div class="form-group"><label for="product_cpu">CPU</label><input class="form-control" required type="text" name="product_cpu" id="product_cpu"></div>
                        <div class="form-group"><label for="product_gpu">GPU</label><input class="form-control" required type="text" name="product_gpu" id="product_gpu"></div>
                        <div class="form-group"><label for="product_screen_size">Kích thước màn hình (inch)</label><input class="form-control" required type="number" step="0.1" min="0" name="product_screen_size" id="product_screen_size"></div>
                        <div class="form-group"><label for="product_screen_resolution">Độ phân giải màn hình</label><input class="form-control" required type="text" name="product_screen_resolution" id="product_screen_resolution"></div>
                        <div class="form-group"><label for="product_battery">Pin (Wh)</label><input class="form-control" required type="text" name="product_battery" id="product_battery"></div>
                        <div class="form-group"><label for="product_camera">Camera</label><input class="form-control" required type="text" name="product_camera" id="product_camera"></div>
                        <div class="form-group"><label for="product_os">Hệ điều hành</label><input class="form-control" required type="text" name="product_os" id="product_os"></div>
                        <div class="form-group"><label for="product_weight">Trọng lượng (kg)</label><input class="form-control" required type="number" step="0.01" min="0" name="product_weight" id="product_weight"></div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary mt-3" value="Thêm" name="submit">
            </form>
        </div>
    </div>
</div>

