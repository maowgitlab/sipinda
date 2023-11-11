<?php
  session_start();
  $username = $_SESSION['username'];
  $terakhir_logout = time();
  mysqli_query($koneksi, "UPDATE tb_users SET terakhir_logout = '$terakhir_logout' WHERE username = '$username'");
  session_destroy();
  header('location: ?page=login&pesan=logout');
?>