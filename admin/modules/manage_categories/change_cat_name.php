<?php
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $sql_getCategory = "SELECT * FROM tblcategory where category_id = $category_id";
    $query_getCategory = mysqli_query($mysqli, $sql_getCategory);
    $row = mysqli_fetch_array($query_getCategory);
}
?>
<div>
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhật danh mục
            </div>
            <div class="card-body">
                <form action="modules/manage_categories/update.php?id=<?php echo $category_id ?>" method="POST">
                    <div class="form-group">
                        <label for="category_name">Tên danh mục:</label>
                        <input required class="form-control" type="text" name="category_name" id="category_name"
                            value="<?php echo $row['category_name'] ?>">
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>
</div>
            
            