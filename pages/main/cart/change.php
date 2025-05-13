<?php
    include("../../../admin/config/connection.php");
    session_start();
    $user_id = $_SESSION['user_id'];
    if(isset($_GET['id']) && isset($_GET['change'])){
        $id = $_GET['id'];
        if($_GET['change'] == 'plus'){
            $sql_update = "UPDATE tblcart SET quantity = quantity + 1 WHERE product_id = '$id' AND user_id = '$user_id'";
            $update_result = mysqli_query($mysqli, $sql_update);
        }
        if($_GET['change'] == 'minus') {
            $sql_sl = "SELECT quantity FROM tblcart WHERE product_id = '$id' AND user_id = '$user_id'";
            $result = mysqli_query($mysqli, $sql_sl);
            $row = mysqli_fetch_assoc($result);
            $current_quantity = $row['quantity'];

            if ($current_quantity >= 1) {
                if ($current_quantity == 1) {
                    $deleteQuery = "DELETE FROM tblcart WHERE product_id = '$id' AND user_id = '$user_id'";
                    $deleteResult = mysqli_query($mysqli, $deleteQuery);
                } else {
                    $sql_update = "UPDATE tblcart SET quantity = quantity - 1 WHERE product_id = '$id' AND user_id = '$user_id'";
                    $update_result = mysqli_query($mysqli, $sql_update);
                }
            }
        }
    }
    header('location: ../../../index.php?navigate=cart');
?>