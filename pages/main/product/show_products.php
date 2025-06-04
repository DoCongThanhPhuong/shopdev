<?php
  if (isset($_GET['trang'])) {
    $page = $_GET['trang'];
  } else {
    $page = 1;
  }
  if ($page == '' || $page == 1) {
    $begin = 0;
  } else {
    $begin = ($page * 8) - 8;
  }

  $conditions = [];
  $conditions[] = "product_is_deleted = 0";
  $limit = "LIMIT $begin, 8";

  if (isset($_GET['category_id']) && $_GET['category_id'] != '') {
    $conditions[] = "category_id = '" . intval($_GET['category_id']) . "'";
  }
  if (isset($_GET['brand_id']) && $_GET['brand_id'] != '') {
    $conditions[] = "brand_id = '" . intval($_GET['brand_id']) . "'";
  }
  if (isset($_GET['price_from']) && is_numeric($_GET['price_from'])) {
    $conditions[] = "product_price >= " . intval($_GET['price_from']);
  }
  if (isset($_GET['price_to']) && is_numeric($_GET['price_to'])) {
    $conditions[] = "product_price <= " . intval($_GET['price_to']);
  }
  if (isset($_POST['keyword']) && $_POST['keyword'] != '') {
    $keyword = mysqli_real_escape_string($mysqli, $_POST['keyword']);
    $conditions[] = "product_name LIKE '%$keyword%'";
    $limit = "";
  }

  $where = count($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '';
  $sql_product = "SELECT * FROM tblproduct $where ORDER BY product_id DESC $limit";
  $query_product = mysqli_query($mysqli, $sql_product);
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2 col-sm-12 sidebar">
      <?php include('pages/main/product/sidebar.php')?>
    </div>

    <div class="container-fluid col-lg-10 col-sm-12 mt-4">
      <form method="GET" action="index.php" class="row mb-3">
        <input type="hidden" name="navigate" value="show_products">

        <div class="col-md-3">
          <select name="brand_id" class="form-control">
            <option value="">Chọn thương hiệu</option>
            <?php
            $sql_brand = "SELECT * FROM tblbrand ORDER BY brand_id ASC";
            $query_brand = mysqli_query($mysqli, $sql_brand);
            while ($row_brand = mysqli_fetch_array($query_brand)) {
              $selected = (isset($_GET['brand_id']) && $_GET['brand_id'] == $row_brand['brand_id']) ? 'selected' : '';
              echo "<option value='{$row_brand['brand_id']}' $selected>{$row_brand['brand_name']}</option>";
            }
            ?>
          </select>
        </div>

        <div class="col-md-2">
          <input type="number" name="price_from" class="form-control" placeholder="Giá từ (VND)"
            value="<?php echo isset($_GET['price_from']) ? $_GET['price_from'] : '' ?>">
        </div>

        <div class="col-md-2">
          <input type="number" name="price_to" class="form-control" placeholder="Giá đến (VND)"
            value="<?php echo isset($_GET['price_to']) ? $_GET['price_to'] : '' ?>">
        </div>

        <div class="col-md-2">
          <button type="submit" class="btn btn-primary">Lọc</button>
        </div>
      </form>

      <div class="row min-height-100">
        <?php while ($row_product = mysqli_fetch_array($query_product)) { ?>
          <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <a href="index.php?navigate=product_info&product_id=<?php echo $row_product['product_id'];?>" class="text-decoration-none text-dark d-inline-block">
              <div class="card text-center h-100" style="cursor: pointer;">
                <img class="card-img-top product-img"
                  src="./assets/images/products/<?php echo $row_product['product_image'];?>"
                  alt="<?php echo $row_product['product_name'];?>" />
                <div class="card-body">
                  <p class="truncate-text" data-fullname="<?php echo htmlspecialchars($row_product['product_name']); ?>"><?php echo $row_product['product_name']?></p>
                  <?php if ($row_product['product_discount'] > 0) { ?>
                    <h6 class="text-danger">
                      <s><?php echo number_format($row_product['product_price'], 0, ',', '.'); ?> VND</s>
                      <sup class="badge badge-danger">-<?php echo $row_product['product_discount']; ?>%</sup>
                    </h6>
                    <h6><?php echo number_format($row_product['product_price'] * (100 - $row_product['product_discount']) / 100, 0, ',', '.'); ?> VND</h6>
                  <?php } else { ?>
                    <h6><?php echo number_format($row_product['product_price'], 0, ',', '.'); ?> VND</h6>
                  <?php } ?>
                </div>
              </div>
            </a>
          </div>
        <?php } ?>
      </div>

      <?php
      $sql_trang_count = "SELECT * FROM tblproduct $where";
      $sql_trang = mysqli_query($mysqli, $sql_trang_count);
      $row_count = mysqli_num_rows($sql_trang);
      $trang = ceil($row_count / 8);
      ?>
      <ul class="d-flex justify-content-center list-unstyled">
        <?php for ($i = 1; $i <= $trang; $i++) { ?>
        <li class="p-2 m-1" style="background: <?php echo $i == $page ? '#ccc' : '#fff'; ?>">
          <a class="text-dark"
            href="index.php?navigate=show_products&trang=<?php echo $i; ?><?php
              echo isset($_GET['brand_id']) ? '&brand_id=' . $_GET['brand_id'] : '';
              echo isset($_GET['price_from']) ? '&price_from=' . $_GET['price_from'] : '';
              echo isset($_GET['price_to']) ? '&price_to=' . $_GET['price_to'] : '';
              echo isset($_GET['category_id']) ? '&category_id=' . $_GET['category_id'] : '';
            ?>"><?php echo $i; ?></a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
