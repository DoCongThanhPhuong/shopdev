<?php
    include("../../config/connection.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql_delete = "UPDATE tblproduct SET product_is_deleted = 1 WHERE product_id = '$id'";
        $delete_result = mysqli_query($mysqli, $sql_delete);
        if($delete_result){
            header("location: ../product_list.php");
        }
    }
?>
