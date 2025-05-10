<?php
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql_getProduct = "SELECT * FROM tblproduct WHERE product_id = $product_id";
    $query_getProduct = mysqli_query($mysqli, $sql_getProduct);
    $row = mysqli_fetch_array($query_getProduct);
    
    $sql_brand = "SELECT * FROM tblbrand ORDER BY brand_id DESC";
    $query_brand = mysqli_query($mysqli, $sql_brand);

    $sql_category = "SELECT * FROM tblcategory ORDER BY category_id DESC";
    $query_category = mysqli_query($mysqli, $sql_category);
}
?>
<div>
  <div id="content" class="container-fluid">
    <div class="card">
      <div class="card-header font-weight-bold">Cập nhật sản phẩm</div>
      <div class="card-body">
        <form action="modules/manage_products/update.php?id=<?= $product_id ?>" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input class="form-control" required type="text" name="product_name" id="name" value="<?= $row['product_name'] ?>">
              </div>
              <div class="form-group">
                <label for="product_quantity">Số lượng</label>
                <input class="form-control" required type="text" name="product_quantity" id="product_quantity" value="<?= $row['product_quantity'] ?>">
              </div>
              <div class="form-group">
                <label for="product_price">Giá</label>
                <input class="form-control" required type="text" name="product_price" id="product_price" value="<?= $row['product_price'] ?>">
              </div>
              <div class="form-group">
                <label for="product_brand">Thương hiệu</label>
                <select class="form-control" required name="product_brand">
                  <?php
                    mysqli_data_seek($query_brand, 0);
                    while ($row_brand = mysqli_fetch_array($query_brand)) {
                      $selected = ($row['brand_id'] == $row_brand['brand_id']) ? 'selected' : '';
                      echo "<option value='{$row_brand['brand_id']}' $selected>{$row_brand['brand_name']}</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="product_material">Chất liệu</label>
                <input class="form-control" required type="text" name="product_material" id="product_material" value="<?= $row['product_material'] ?>">
              </div>
              <div class="form-group">
                <label for="product_ram">RAM</label>
                <input class="form-control" required type="text" name="product_ram" id="product_ram" value="<?= $row['product_ram'] ?>">
              </div>
              <div class="form-group">
                <label for="product_rom">ROM</label>
                <input class="form-control" required type="text" name="product_rom" id="product_rom" value="<?= $row['product_rom'] ?>">
              </div>
              <div class="form-group">
                <label for="product_cpu">CPU</label>
                <input class="form-control" required type="text" name="product_cpu" id="product_cpu" value="<?= $row['product_cpu'] ?>">
              </div>
              <div class="form-group">
                <label for="product_gpu">GPU</label>
                <input class="form-control" required type="text" name="product_gpu" id="product_gpu" value="<?= $row['product_gpu'] ?>">
              </div>
              <div class="form-group">
                <label for="product_screen_size">Kích thước màn hình</label>
                <input class="form-control" required type="text" name="product_screen_size" id="product_screen_size" value="<?= $row['product_screen_size'] ?>">
              </div>
              <div class="form-group">
                <label for="product_screen_resolution">Độ phân giải màn hình</label>
                <input class="form-control" required type="text" name="product_screen_resolution" id="product_screen_resolution" value="<?= $row['product_screen_resolution'] ?>">
              </div>
              <div class="form-group">
                <label for="product_battery">Pin</label>
                <input class="form-control" required type="text" name="product_battery" id="product_battery" value="<?= $row['product_battery'] ?>">
              </div>
              <div class="form-group">
                <label for="product_camera">Camera</label>
                <input class="form-control" required type="text" name="product_camera" id="product_camera" value="<?= $row['product_camera'] ?>">
              </div>
              <div class="form-group">
                <label for="product_os">Hệ điều hành</label>
                <input class="form-control" required type="text" name="product_os" id="product_os" value="<?= $row['product_os'] ?>">
              </div>
              <div class="form-group">
                <label for="product_weight">Trọng lượng</label>
                <input class="form-control" required type="text" name="product_weight" id="product_weight" value="<?= $row['product_weight'] ?>">
              </div>
              <div class="form-group">
                <label for="product_discount">Giảm giá (%)</label>
                <input class="form-control" required type="number" name="product_discount" id="product_discount" value="<?= $row['product_discount'] ?>">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="product_description">Mô tả</label>
                <textarea name="product_description" class="form-control" required id="product_description" cols="30" rows="10"><?= $row['product_description'] ?></textarea>
              </div>
              <div class="form-group">
                <label for="product_category">Danh mục</label>
                  <select class="form-control" required name="product_category">
                    <?php
                      mysqli_data_seek($query_category, 0);
                      while ($row_category = mysqli_fetch_array($query_category)) {
                        $selected = ($row['category_id'] == $row_category['category_id']) ? 'selected' : '';
                        echo "<option value='{$row_category['category_id']}' $selected>{$row_category['category_name']}</option>";
                      }
                    ?>
                  </select>
              </div>
              <div class="form-group">
                <label for="product_image">Hình ảnh</label>
                <input class="form-control" type="file" name="product_image" accept="image/*">
                <div class="mt-2">
                  <img src="./assets/images/products/<?= $row['product_image'] ?>" alt="" width="150">
                </div>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-primary mt-3" name="submit" value="Cập nhật">
        </form>
      </div>
    </div>
  </div>
</div>
