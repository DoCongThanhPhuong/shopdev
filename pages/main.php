<div>
  <?php
    $routes = [
      "login" => "main/account/login.php",
      "signup" => "main/account/register.php",
      "show_products" => "main/product/show_products.php",
      "search" => "main/product/search_results.php",
      "profile" => "main/account/profile.php",
      "change_password" => "main/account/change_password.php",
      "change_profile" => "main/account/change_profile.php",
      "category" => "main/product/category.php",
      "product_info" => "main/product/product_info.php",
      "cart" => "main/cart/cart.php",
      "customer_info" => "main/order/customer_info.php",
      "confirm_order" => "main/order/confirm_order.php",
      "order_history" => "main/order/order_history.php",
      "order_details" => "main/order/order_details.php",
      "finish" => "main/order/finish.php"
    ];

    $temp = $_GET['navigate'] ?? '';
    $fileToInclude = $routes[$temp] ?? "main/home.php";
    include($fileToInclude);
  ?>
</div>
