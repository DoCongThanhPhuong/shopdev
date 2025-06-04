<?php
  $user_id = $_SESSION['user_id'] ?? null;

  if (!$user_id) {
    exit("Người dùng chưa đăng nhập.");
  }

  $sql = "SELECT user_password FROM tbluser WHERE user_id = $user_id";
  $result = mysqli_query($mysqli, $sql);
  $row = mysqli_fetch_assoc($result);

  $message = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $oldPassword = trim($_POST['old-password'] ?? '');
    $newPassword = trim($_POST['new-password'] ?? '');
    $newPasswordRepeat = trim($_POST['new-password-repeat'] ?? '');

    if (!$oldPassword || !$newPassword || !$newPasswordRepeat) {
      $message = "Vui lòng điền đầy đủ thông tin!";
    } elseif (md5($oldPassword) !== $row['user_password']) {
      $message = "Mật khẩu hiện tại không chính xác!";
    } elseif ($newPassword !== $newPasswordRepeat) {
      $message = "Mật khẩu nhập lại không khớp!";
    } else {
      $newPasswordMd5 = md5($newPassword);
      $updateSql = "UPDATE tbluser SET user_password = '$newPasswordMd5' WHERE user_id = $user_id";
      mysqli_query($mysqli, $updateSql);
      $message = "Đổi mật khẩu thành công!";
    }
  }
?>

<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow-sm border-0">
        <div class="card-body p-4">
          <h4 class="card-title text-center mb-4">🔐 Đổi mật khẩu</h4>

          <?php if (!empty($message)) : ?>
            <div class="alert alert-<?php echo strpos($message, 'thành công') !== false ? 'success' : 'danger'; ?>">
              <?php echo $message; ?>
            </div>
          <?php endif; ?>

          <form action="" method="POST">
            <div class="form-group mb-3">
              <label for="old-password">Mật khẩu hiện tại</label>
              <input type="password" class="form-control" name="old-password" id="old-password" required>
            </div>

            <div class="form-group mb-3">
              <label for="new-password">Mật khẩu mới</label>
              <input type="password" class="form-control" name="new-password" id="new-password" required>
            </div>

            <div class="form-group mb-4">
              <label for="new-password-repeat">Nhập lại mật khẩu mới</label>
              <input type="password" class="form-control" name="new-password-repeat" id="new-password-repeat" required>
            </div>

            <button type="submit" name="save" class="btn btn-primary w-100">💾 Lưu mật khẩu</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
