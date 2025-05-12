<?php
    include("../../config/connection.php");
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $category_id = $_POST['product_category'];
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];
        $product_brand = $_POST['product_brand'];
        $product_material = $_POST['product_material'];
        $product_ram = $_POST['product_ram'];
        $product_rom = $_POST['product_rom'];
        $product_cpu = $_POST['product_cpu'];
        $product_gpu = $_POST['product_gpu'];
        $product_screen_size = $_POST['product_screen_size'];
        $product_screen_resolution = $_POST['product_screen_resolution'];
        $product_battery = $_POST['product_battery'];
        $product_camera = $_POST['product_camera'];
        $product_os = $_POST['product_os'];
        $product_weight = $_POST['product_weight'];
        $product_discount = $_POST['product_discount'];
        if ($_FILES['product_image']['name'] != ""){
            $query_select_image = "SELECT product_image FROM tblproduct WHERE product_id  = $id";
            $result_select_image = mysqli_query($mysqli, $query_select_image);
            $row_select_image = mysqli_fetch_assoc($result_select_image);
            $imageToDelete = $row_select_image['product_image'];
            unlink("../../../assets/images/products/".$imageToDelete);
            $imageName = $_FILES['product_image']['name'];
            $imageTemp = $_FILES['product_image']['tmp_name'];
            move_uploaded_file($imageTemp, "../../../assets/images/products/" . $imageName);
            $sql_update_anh = "UPDATE tblproduct SET product_image = '$imageName' WHERE product_id = '$_GET[id]'";
            mysqli_query($mysqli, $sql_update_anh);
        }
        $sql_update = "
        UPDATE tblproduct SET
            category_id = $category_id,
            product_name = '$product_name',
            product_description = '$product_description',
            product_quantity = $product_quantity,
            product_price = $product_price,
            product_discount = $product_discount,
            brand_id = '$product_brand',
            product_material = '$product_material',
            product_ram = '$product_ram',
            product_rom = '$product_rom',
            product_cpu = '$product_cpu',
            product_gpu = '$product_gpu',
            product_screen_size = '$product_screen_size',
            product_screen_resolution = '$product_screen_resolution',
            product_battery = '$product_battery',
            product_camera = '$product_camera',
            product_os = '$product_os',
            product_weight = '$product_weight'
        WHERE product_id = $id
        ";
        mysqli_query($mysqli, $sql_update);
    }
    header('location: ../../index.php?product=product_list');
?>