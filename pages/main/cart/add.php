<?php
	include("../../../admin/config/connection.php");
	session_start();
	$user_id = $_SESSION['user_id'];
	if(isset($_GET['id'])){
		$product_id= $_GET['id'];
		$quantity = (int)$_POST['quantity'];
		$sql_check_product = "SELECT * FROM tblcart WHERE user_id = $user_id AND product_id = $product_id";
		$result = mysqli_query($mysqli, $sql_check_product);
		if ($result) {
			if (mysqli_num_rows($result) > 0) {
				$sql_update_quantity = "UPDATE tblcart SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id";
				$update_result = mysqli_query($mysqli, $sql_update_quantity);
			} else {
				$sql_addtocart="INSERT INTO tblcart(user_id,product_id,quantity, added_at) VALUES('$user_id','$product_id','$quantity', NOW())";
				mysqli_query($mysqli,$sql_addtocart);
			}
		}
		header('location: ../../../index.php?navigate=cart');
	}
?>