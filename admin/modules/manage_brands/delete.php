<?php
    include("../../config/connection.php");
    if (isset($_GET['delete_id'])) {
        $delete_id = intval($_GET['delete_id']);
        $sql_check = "SELECT COUNT(*) as count FROM tblproduct WHERE brand_id = '$delete_id'";
        $result = mysqli_query($mysqli, $sql_check);
        $data = mysqli_fetch_assoc($result);
    
        if ($data['count'] == 0) {
            $sql_delete = "DELETE FROM tblbrand WHERE brand_id = '$delete_id'";
            mysqli_query($mysqli, $sql_delete);
            header('location: ../../index.php?brand=brand_list');
        } else {
            echo "<script>alert('Thương hiệu này có sản phẩm, không thể xóa');</script>";
        }
    }
?>
