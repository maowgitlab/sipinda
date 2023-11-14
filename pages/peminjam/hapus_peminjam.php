<?php
  $id = $_GET['id'];
  mysqli_query($koneksi, "DELETE FROM tb_peminjam WHERE id = '$id'");
  mysqli_query($koneksi, "DELETE FROM tb_transaksi WHERE id_peminjam = '$id'");
  header('location: ?page=data-peminjam');
?>