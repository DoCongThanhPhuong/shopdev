<?php
  $user_id = $_SESSION['user_id'];
  $sql_Cus = "SELECT * FROM tbluser WHERE user_id = $user_id LIMIT 1";
  $query_Cus = mysqli_query($mysqli, $sql_Cus);
  $row = mysqli_fetch_array($query_Cus);
  if (isset($_POST['save']) && $_POST['old-password'] != "" && $_POST['new-password'] != "" && $_POST['new-password-repeat'] != "")
  {
    $oldPassword = md5($_POST['old-password']);
    $newPassword = md5($_POST['new-password']);
    $newPasswordRepeat = md5($_POST['new-password-repeat']);
    $user_password = $row['user_password'];
    if ($oldPassword != $user_password)
      echo "<script>alert(\"Mật khẩu hiện tại không chính xác!\")</script>";
    else if ($newPassword != $newPasswordRepeat)
      echo "<script>alert(\"Mật khẩu nhập lại không khớp!\")</script>";
    else {
      $sql_add = "UPDATE tbluser set user_password = '" . $newPassword . "' WHERE user_id= '$user_id'";
      mysqli_query($mysqli, $sql_add);
      echo "<script>alert(\"Đổi mật khẩu thành công!\")</script>";
    }
  }
?>
<div class="container">
  <div class="card bg-light pt-3 pb-3 my-5">
    <article class="card-body mx-auto" style="max-width: 400px;">
      <h4 class="card-title text-center">Đổi mật khẩu</h4>
      <form action="" method="POST">
        <label for="old-password">Mật khẩu hiện tại</label>
        <input type="password" name="old-password" required style="width: 220px;">
        <label for="new-password">Mật khẩu mới</label>
        <input type="password" name="new-password" required style="width: 220px;">
        <label for="new-password-repeat">Nhập lại mật khẩu mới</label>
        <input type="password" name="new-password-repeat" required style="width: 220px;">
        <input type="submit" class="btn btn-primary btn-block mt-3" name="save" value="Lưu">
      </form>
    </article>
  </div>
</div>