<?php
  if(isset($_GET['trang'])){
    $page = $_GET['trang'];
  } else{
    $page = 1;
  }
  if($page == '' || $page == 1){
    $begin = 0;
  } else{
    $begin = ($page*8)-8;
  }
  if(isset($_GET['category_id'])){
    $sql_product = "SELECT * FROM tblproduct where category_id = '$_GET[category_id]' ORDER BY product_id DESC";
  } elseif (isset($_POST['keyword'])){
    $keyword = $_POST['keyword'];
    $sql_product = "SELECT * FROM tblproduct where tblproduct.product_name LIKE '%" . $keyword . "%'";
  } else {
    $sql_product = "SELECT * FROM tblproduct ORDER BY product_id DESC LIMIT $begin,8";
  }
  $query_product = mysqli_query($mysqli,$sql_product);
?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-2 col-sm-12 sidebar">
        <?php include('pages/main/product/sidebar.php')?>
      </div>
      <div class="container-fluid col-lg-10 col-sm-12 mt-4">
        <div class="row min-height-100">
        <?php
        while($row_product = mysqli_fetch_array($query_product)){
        ?>
        <form class="col-lg-3 col-md-4 col-sm-6" action="./index.php?navigate=product_info&product_id=<?php echo $row_product['product_id'];?>" method="POST">
          <div class="card text-center mb-4" style="height: 380px;">
            <img
                class="card-img-top product-img"
                src="./assets/images/products/<?php echo $row_product['product_image'];?>"
                alt="<?php echo $row_product['product_name'];?>"
            />
            <div class="card-body">
                <h6><?php echo $row_product['product_name']?></h6>
                <?php if ($row_product['product_discount'] > 0) { ?>
                    <h6 class="text-danger">
                        <s><?php echo number_format($row_product['product_price'], 0, ',', '.'); ?> VND</s>
                        <sup class="badge badge-danger"><?php echo $row_product['product_discount']; ?>%</sup>
                    </h6>
                    <h6><?php echo number_format($row_product['product_price'] * (100 - $row_product['product_discount']) / 100, 0, ',', '.'); ?> VND</h6>
                <?php } else { ?>
                    <h6><?php echo number_format($row_product['product_price'], 0, ',', '.'); ?> VND</h6>
                <?php } ?>
                <input type="submit" class="btn btn-info" name='submit' value="Xem chi tiết">
            </div>
          </div>
        </form>
        <?php
        }
        ?>
      </div>
				<?php
				$sql_trang = mysqli_query($mysqli, "SELECT * FROM tblproduct");
				$row_count = mysqli_num_rows($sql_trang);
				$trang = ceil($row_count/8);
				?>
				<ul class="d-flex justify-content-center list-unstyled">
					<?php
					  for($i=1;$i<=$trang;$i++){
					?>
						<li class="p-2 m-1" <?php if($i==$page){echo 'style="background: #ccc"';} else {echo 'style="background: #fff"';}?>>
              <a class="text-dark" href="index.php?navigate=show_products&trang=<?php echo $i ?>"><?php echo $i ?></a>
            </li>
					<?php } ?>
				</ul>
      </div>
    </div>
  </div>
