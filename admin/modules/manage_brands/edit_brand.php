<?php
if (isset($_GET['id'])) {
    $brand_id = $_GET['id'];
    $sql_getBrand = "SELECT * FROM tblbrand where brand_id = $brand_id";
    $query_getBrand = mysqli_query($mysqli, $sql_getBrand);
    $row = mysqli_fetch_array($query_getBrand);
}
?>
<div>
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhật thương hiệu
            </div>
            <div class="card-body">
                <form action="modules/manage_brands/update.php?id=<?php echo $brand_id ?>" method="POST">
                    <div class="form-group">
                        <label for="brand_name">Tên danh mục:</label>
                        <input required class="form-control" type="text" name="brand_name" id="brand_name"
                            value="<?php echo $row['brand_name'] ?>">
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>
</div>
            
            