<?php
  include("../../config/connection.php");
  session_start();
  if (isset($_POST['add'])) {
      $brand_name=$_POST['brand_name'];
      $sql_add = "INSERT INTO tblbrand(brand_name) VALUES ('$brand_name')";
      mysqli_query($mysqli,$sql_add);
      header('location: ../../index.php?brand=brand_list');
  }
?>