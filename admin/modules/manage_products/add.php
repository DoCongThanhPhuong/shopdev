<?php
    include("../../config/connection.php");
    if (isset($_POST['submit'])) {
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
        $imageName = $_FILES['product_image']['name'];
        $imageTemp = $_FILES['product_image']['tmp_name'];
        move_uploaded_file($imageTemp, "../../../assets/images/products/" . $imageName);
        $sql_add =
        "INSERT INTO tblproduct (
            category_id, product_name, product_description,
            product_price, product_quantity, product_image, product_discount,
            brand_id, product_material, product_ram, product_rom,
            product_cpu, product_gpu, product_screen_size,
            product_screen_resolution, product_battery, product_camera,
            product_os, product_weight
        ) VALUES (
            $category_id, '$product_name', '$product_description',
            $product_price, $product_quantity, '$imageName', $product_discount,
            $product_brand, '$product_material', '$product_ram', '$product_rom',
            '$product_cpu', '$product_gpu', '$product_screen_size',
            '$product_screen_resolution', '$product_battery', '$product_camera',
            '$product_os', '$product_weight'
        )
        ";
        mysqli_query($mysqli,$sql_add);
        }
    header('location: ../../index.php?product=product_list');
?>