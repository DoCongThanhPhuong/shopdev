<?php
    $sql_category_products="SELECT * FROM tblcategory ORDER BY category_id DESC";
    $query_category_products=mysqli_query($mysqli,$sql_category_products);
?>

<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm mới
                </div>
                <div class="card-body">
                    <form action="modules/manage_categories/add_cat.php" method="POST">
                        <div class="form-group">
                            <label for="category_name">Tên danh mục:</label>
                            <input class="form-control" type="text" name="category_name" id="category_name" required>
                        </div>
                        <input type="submit" class="btn btn-success" name="add" value="Thêm">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách danh mục
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Sửa/Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;
                            while ($row_category_products=mysqli_fetch_array($query_category_products)) {
                                ?>
                                <tr>
                                    <td><?php echo $i++?></td>
                                    <td><?php echo $row_category_products['category_name']?></td>
                                    <td class="d-flex">
                                        <a href="?cat=change_cat_name&id=<?php echo $row_category_products['category_id']?>" class="btn btn-warning btn-sm text-white mr-2" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="modules/manage_categories/delete.php?delete_id=<?php echo $row_category_products['category_id']?>" class="btn btn-danger btn-sm text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>