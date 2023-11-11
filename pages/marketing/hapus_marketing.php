<?php
  $id = $_GET['id'];
  mysqli_query($koneksi, "DELETE FROM tb_marketing WHERE id = '$id'");
  header('location: ?page=data-marketing');
?>