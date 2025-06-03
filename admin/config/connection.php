<?php
  $mysqli = new mysqli("localhost","root","","shopdev");
  if ($mysqli -> connect_errno) {
    echo "Kết nối Chờ thanh toán: " . $mysqli -> connect_error;
    exit();
  }
?>