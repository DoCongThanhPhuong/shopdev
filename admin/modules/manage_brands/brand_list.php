<?php
    $sql_brand="SELECT * FROM tblbrand ORDER BY brand_id ASC";
    $query_brand=mysqli_query($mysqli,$sql_brand);
    if (isset($_GET['delete_id'])) {
		$sql_check = "SELECT COUNT(*) as count FROM tblproduct WHERE brand_id = '".$_GET['delete_id']."'";
		$result = mysqli_query($mysqli, $sql_check);
		$row_count = mysqli_num_rows($result);
		if($row_count == 0){
			$sql_delete = "DELETE FROM tblbrand where tblbrand.brand_id = '".$_GET['delete_id']."'";
			mysqli_query($mysqli, $sql_delete);
		} else {
            echo "<script>alert(\"Danh mục này có sản phẩm, không thể xóa\")</script>";
		}
	}
?>
    <div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm thương hiệu
                </div>
                <div class="card-body">
                    <form action="modules/manage_brands/add_brand.php" method="POST">
                        <div class="form-group">
                            <label for="brand_name">Tên thương hiệu:</label>
                            <input class="form-control" type="text" name="brand_name" id="brand_name" required>
                        </div>
                        <input type="submit" class="btn btn-success" name="add" value="Thêm">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách thương hiệu
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên thương hiệu</th>
                                <th scope="col">Sửa/Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0;
                            while ($row_brand=mysqli_fetch_array($query_brand)) {
                                ?>
                                <tr>
                                    <td><?php echo $row_brand['brand_id']?></td>
                                    <td><?php echo $row_brand['brand_name']?></td>
                                    <td class="d-flex">
                                        <a href="?brand=edit_brand&id=<?php echo $row_brand['brand_id']?>" class="btn btn-warning btn-sm text-white mr-2" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="?brand=brand_list&delete_id=<?php echo $row_brand['brand_id']?>" class="btn btn-danger btn-sm text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>