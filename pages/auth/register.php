<?php
if (isset($_SESSION['username'])) {
  header('location: ?page=home');
}
?>
<?php
$invalid = "";
if (isset($_POST['register'])) {
  $username = htmlspecialchars($_POST['username']);
  $email    = htmlspecialchars($_POST['email']);
  $password = $_POST['password'];
  if ($username == null || $password == null || $email == null) {
    $invalid = "is-invalid";
  } else {
    $dataUsername = mysqli_query($koneksi, "SELECT username FROM tb_users WHERE username = '$username'");
    $dataEmail = mysqli_query($koneksi, "SELECT email FROM tb_users WHERE email = '$email'");
    $data1     = mysqli_fetch_assoc($dataUsername);
    $data2     = mysqli_fetch_assoc($dataEmail);
    if ($data1['username'] == $username) {
      header('location: ?page=register&error=username');
    } elseif ($data2['email'] == $email) {
      header('location: ?page=register&error=email');
    } else {
      $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $waktuSekarang = time();
      $data = mysqli_query($koneksi, "INSERT INTO tb_users VALUES(NULL, '$email', '$username', '$passwordHash', 'operator', 0, 0, 0, '$waktuSekarang')");
      header('location: ?page=register&pesan=berhasil');
    }
  }
}
?>
<div class="row my-3">
  <div class="col-lg-8">
    <h1>Register</h1>
    <?php if (isset($_GET['error']) && $_GET['error'] == "username") : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> Username sudah terdaftar.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php elseif (isset($_GET['error']) && $_GET['error'] == "email") : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> Email sudah terdaftar.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php elseif (isset($_GET['pesan']) && $_GET['pesan'] == "berhasil") : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> Akun berhasil dibuat.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <form action="?page=register" method="post">
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
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control <?= $invalid ?>" id="email" name="email">
        <?php if ($invalid) : ?>
          <div class="invalid-feedback">
            Email tidak boleh kosong.
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
      <button type="submit" name="register" class="btn btn-primary"><i class="fas fa-check-circle"></i> Register</button>
    </form>
  </div>
</div>