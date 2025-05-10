<?php
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
  exit("Người dùng chưa đăng nhập.");
}

$sql = "SELECT user_password FROM tbluser WHERE user_id = $user_id";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
  $oldPassword = trim($_POST['old-password'] ?? '');
  $newPassword = trim($_POST['new-password'] ?? '');
  $newPasswordRepeat = trim($_POST['new-password-repeat'] ?? '');

  if (!$oldPassword || !$newPassword || !$newPasswordRepeat) {
    echo "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
  } elseif (md5($oldPassword) !== $row['user_password']) {
    echo "<script>alert('Mật khẩu hiện tại không chính xác!');</script>";
  } elseif ($newPassword !== $newPasswordRepeat) {
    echo "<script>alert('Mật khẩu nhập lại không khớp!');</script>";
  } else {
    $newPasswordMd5 = md5($newPassword);
    $updateSql = "UPDATE tbluser SET user_password = '$newPasswordMd5' WHERE user_id = $user_id";
    mysqli_query($mysqli, $updateSql);
    echo "<script>alert('Đổi mật khẩu thành công!');</script>";
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