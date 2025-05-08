<?php
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql_login = "SELECT * FROM tbluser WHERE
    user_loginname = '$username' AND user_password = '$password' AND user_is_active = 1 AND user_is_admin = 0";
    $query_login = mysqli_query($mysqli, $sql_login);
    $count = mysqli_num_rows($query_login);
    $row = mysqli_fetch_array($query_login);
    if ($count > 0) {
      $id_cus = $row['user_id'];
      $sql_cart = "SELECT * FROM tblcart where user_id = $id_cus";
      $query_cart = mysqli_query($mysqli, $sql_cart);
      $row_cart = mysqli_fetch_array($query_cart);
      $_SESSION['user_id'] = $id_cus;
      $_SESSION['cart_id'] = $row_cart['cart_id'];
      header("location: ./index.php");
    } else {
      $alert = "Tên đăng nhập hoặc mật khẩu không chính xác!";
    }
  }
?>

<div class="container-fluid">
  <div class="row d-flex justify-content-center align-items-center h-100 my-5">
    <div class="col-md-9 col-lg-6 col-xl-5">
      <img src="./assets/images/banners/login.png"
        class="img-fluid" alt="Ảnh đăng nhập">
    </div>
    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
      <form method="POST" action="">
        <div class="form-outline mb-4">
          <label class="font-weight-bold" for="username">Tên đăng nhập</label>
          <input required type="text" id="username" class="form-control form-control-lg"
            name="username" />
        </div>
        
        <div class="form-outline mb-3">
          <label class="font-weight-bold" for="password">Mật khẩu</label>
          <input required type="password" id="password" class="form-control form-control-lg"
            name="password" />
        </div>
        <p class="text-center text-danger"><strong><?php if(isset($alert)) { echo $alert; } ?></strong></p>
        <div class="text-center text-lg-start mt-4 pt-2">
          <input type="submit" class="btn btn-primary btn-lg" name="login"
            style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Đăng nhập">
            <p class="small font-weight-bold mt-2 pt-1 mb-0">Chưa có tài khoản?
              <a href="index.php?navigate=signup" class="text-danger">Đăng ký</a>
            </p>
        </div>
      </form>
    </div>
  </div>
</div>