<?php
    include("../../config/connection.php");
    if (isset($_POST['submit']) && isset($_GET['id'])) {
        $brand_id = $_GET['id'];
        $brand_name = $_POST['brand_name'];
        if ($brand_name != "") {
            $sql_update = "UPDATE tblbrand SET brand_name = '$brand_name' WHERE brand_id = $brand_id";
            mysqli_query($mysqli, $sql_update);
        }
    }
    header('location:../../index.php?brand=brand_list');
?>