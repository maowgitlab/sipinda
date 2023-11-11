<?php
if (isset($_SESSION['username'])) {
  header('location: ?page=home');
}
?>
<?php
$invalid = "";
if (isset($_POST['login'])) {
  $username = htmlspecialchars($_POST['username']);
  $password = $_POST['password'];

  if ($username == null || $password == null) {
    $invalid = "is-invalid";
  } else {
    $user = mysqli_query($koneksi, "SELECT * FROM tb_users WHERE username = '$username'");
    $data = mysqli_fetch_assoc($user);

    if ($data) {
      if (password_verify($password, $data['password'])) {
        $terakhir_login = time();
        $total_login    = $data['total_login'] + 1;
        mysqli_query($koneksi, "UPDATE tb_users SET total_login = '$total_login', terakhir_login = '$terakhir_login' WHERE username = '$username'");
        $dataLogin = mysqli_query($koneksi, "SELECT * FROM tb_users WHERE username = '$username'");
        $dataL     = mysqli_fetch_assoc($dataLogin);
        session_start();
        $_SESSION['username'] = $dataL['username'];
        $_SESSION['email']    = $dataL['email'];
        $_SESSION['role']     = $dataL['role'];
        $_SESSION['total_login']          = $dataL['total_login'];
        $_SESSION['terakhir_login']       = $dataL['terakhir_login'];
        $_SESSION['terakhir_logout']      = $dataL['terakhir_logout'];
        header('location: ?page=home');
      } else {
        header('location: ?page=login&error=login');
      }
    } else {
      header('location: ?page=login&error=login');
    }
  }
}
?>
<div class="row my-3">
  <div class="col-lg-8">
    <h1>Login</h1>
    <?php if (isset($_GET['error']) == "login") : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> Username atau password salah.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php elseif (isset($_GET['pesan']) == "logout") : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> anda telah logout.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <form action="?page=login" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control <?= $invalid ?>" id="username" name="username" autofocus>
        <?php if ($invalid) : ?>
          <div class="invalid-feedback">
            Username tidak boleh kosong.
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control <?= $invalid ?>" id="password" name="password">
        <?php if ($invalid) : ?>
          <div class="invalid-feedback">
            Password tidak boleh kosong.
          </div>
        <?php endif; ?>
      </div>
      <button type="submit" name="login" class="btn btn-primary"><i class="fas fa-lock"></i> Login</button>
    </form>
  </div>
</div>