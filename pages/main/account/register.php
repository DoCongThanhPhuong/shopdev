<?php
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password_repeat = $_POST['password-repeat'];
  $email = $_POST['email'];
  $fullname = $_POST['fullname'];
  $address = $_POST['address'];
  $phonenumber = $_POST['phonenumber'];
  $created_at = date("Y-m-d H:i:s");
  $pattern = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
  if (isset($_POST['submit']) && $_POST['username'] != "" && $_POST['password'] != "" && $_POST['password-repeat'] != "" && $_POST['email'] != "" && $_POST['fullname'] != "" && $_POST['address'] != "" && $_POST['phonenumber'] != "") {
    if ($password != $password_repeat) {
      $check_register = "Mật khẩu nhập lại không khớp!";
    } elseif (!preg_match($pattern, $email, $matchs))
      $check_register = "Email không hợp lệ!";
    elseif (!preg_match("/^[0-9]{10,12}$/", $phonenumber))
      $check_register = "Số điện thoại không hợp lệ!";
    else {
      $sql_add = "INSERT INTO tbluser(user_loginname,user_password,user_email,user_fullname,user_address,user_phone,user_created_at)
      VALUES('" . $username . "','" . md5($password) . "','" . $email . "','" . $fullname . "','" . $address . "','" . $phonenumber . "','" . $created_at . "')";
      mysqli_query($mysqli, $sql_add);
      $user_id = mysqli_insert_id($mysqli);
      header('location: index.php?navigate=login');
    }
  }
}
?>

<div class="container h-100">
  <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-lg-12 col-xl-11">
      <div class="card text-black mt-4 mb-4" style="border-radius: 25px;">
        <div class="card-body p-md-5">
          <div class="row justify-content-center">
            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
              <p class="text-center h3 fw-bold mb-5 mx-1 mx-md-4 mt-4">Đăng ký</p>
              <p class="text-center text-danger">
                <?php if (isset($check_register)) {
                  echo $check_register;
                }
                ?>
              </p>
              <form class="mx-1 mx-md-4" action="" method="POST">
                <div class="d-flex align-items-center mb-4">
                  <label class="m-0 p-1" for="fullname">
                    <i class="fa fa-user fa-lg me-3 fa-fw"></i>
                  </label>
                  <div class="form-outline flex-fill mb-0">
                    <input type="text" id="fullname" class="form-control" required name="fullname" placeholder="Họ tên"/>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                <label class="m-0 p-1" for="address">
                  <i class="fa fa-home fa-lg me-3 fa-fw"></i>
                </label>
                  <div class="form-outline flex-fill mb-0">
                    <input type="text" id="address" class="form-control" required name="address" placeholder="Địa chỉ"/>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                <label class="m-0 p-1" for="email">
                  <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                </label>
                  <div class="form-outline flex-fill mb-0">
                    <input type="email" id="email" class="form-control" required name="email" placeholder="Email"/>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                <label class="m-0 p-1" for="phonenumber">
                  <i class="fa fa-phone fa-lg me-3 fa-fw"></i>
                </label>
                  <div class="form-outline flex-fill mb-0">
                    <input type="text" id="phonenumber" class="form-control" required name="phonenumber" placeholder="Số điện thoại"/>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                <label class="m-0 p-1" for="loginname">
                  <i class="fa fa-user-circle fa-lg me-3 fa-fw"></i>
                </label>
                  <div class="form-outline flex-fill mb-0">
                    <input type="text" id="loginname" class="form-control" required name="username" placeholder="Tên đăng nhập"/>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                <label class="m-0 p-1" for="password">
                  <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                </label>
                  <div class="form-outline flex-fill mb-0">
                    <input type="password" id="password" class="form-control" required name="password" placeholder="Mật khẩu"/>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                <label class="m-0 p-1" for="password-repeat">
                  <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                </label>
                  <div class="form-outline flex-fill mb-0">
                    <input type="password" id="password-repeat" class="form-control" required name="password-repeat" placeholder="Nhập lại mật khẩu"/>
                  </div>
                </div>

                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                  <button type="submit" class="btn btn-primary" name="submit">Đăng ký</button>
                </div>
              </form>
            </div>
            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
              <img src="./assets/images/banners/signup.png"
                class="img-fluid" alt="Ảnh đăng ký">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>