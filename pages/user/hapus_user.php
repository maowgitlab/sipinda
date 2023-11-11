<?php
  $id = $_GET['id'];
  mysqli_query($koneksi, "DELETE FROM tb_users WHERE id = '$id'");
  header('location: ?page=data-user');
?>