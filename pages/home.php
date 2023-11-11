<?php
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<div class="row my-3">
  <div class="col-lg">
    <h1>Selamat Datang, <?= $_SESSION['username'] ?></h1>
    <h2>Email aktif: <?= $_SESSION['email'] ?></h2>
    <h2>Terakhir Login: <?= date('d F Y H:i:s', $_SESSION['terakhir_login']) ?></h2>
    <h2>Terakhir Logout: <?= date('d F Y H:i:s', $_SESSION['terakhir_logout']) == "01 January 1970 07:30:00" ? "-" : date('d F Y H:i:s', $_SESSION['terakhir_logout']) ?></h2>
    <h2>Total Login: <?= $_SESSION['total_login'] ?></h2>
    <h2>Login Sebagai: <?= $_SESSION['role'] ?></h2>
  </div>
</div>