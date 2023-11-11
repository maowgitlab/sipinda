<?php
  $id = $_GET['id'];
  mysqli_query($koneksi, "DELETE FROM tb_peminjam WHERE id = '$id'");
  header('location: ?page=data-peminjam');
?>