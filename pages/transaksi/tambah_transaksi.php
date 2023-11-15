<?php
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<?php
$invalid = "";
$no_transaksi = $_GET['transaksi'];
$dataTransaksi = mysqli_query($koneksi, "SELECT tb_transaksi.id, tb_transaksi.no_transaksi, tb_transaksi.no_marketing, tb_transaksi.id_peminjam, tb_transaksi.angsuran AS angsuran_transaksi, tb_transaksi.sisa_pinjaman, tb_transaksi.created_at, tb_peminjam.nama, tb_peminjam.total_pinjaman, tb_peminjam.angsuran, tb_marketing.no_marketing, tb_marketing.nama_marketing FROM tb_transaksi JOIN tb_peminjam JOIN tb_marketing ON tb_transaksi.no_marketing = tb_marketing.no_marketing AND tb_transaksi.id_peminjam = tb_peminjam.id WHERE tb_transaksi.no_transaksi = '$no_transaksi' ORDER BY tb_transaksi.id DESC");
$data = mysqli_fetch_assoc($dataTransaksi);
if (isset($_POST['simpan'])) {
  $no_transaksi = htmlspecialchars($_POST['no_transaksi']);
  $no_marketing = htmlspecialchars($_POST['no_marketing']);
  $id_peminjam = htmlspecialchars($_POST['id_peminjam']);
  $angsuran = htmlspecialchars($_POST['angsuran']);
  $created_at = time();
  
  if ($no_transaksi == null || $no_marketing == null || $id_peminjam == null || $angsuran == null) {
    $invalid = "is-invalid";
  } else {
    $sisa_pinjaman = $data['sisa_pinjaman'] - $angsuran;
    $query = mysqli_query($koneksi, "INSERT INTO tb_transaksi VALUES (NULL, '$no_transaksi', '$no_marketing', '$id_peminjam', '$angsuran', '$sisa_pinjaman', '$created_at')");
    if ($query) {
      echo "
    <script>
    alert('Data Transaksi Berhasil ditambahkan.');
    window.location = '?page=detail-transaksi&transaksi=$no_transaksi';
    </script>
    ";
    }
  }
}
?>
<div class="row my-3">
  <div class="col-lg">
    <h1 class="mb-3">Tambah Data Transaksi</h1>
    <form action="" method="post">
      <input type="hidden" name="id_peminjam" value="<?= $data['id_peminjam'] ?>">
      <div class="mb-3">
        <label for="no_transaksi" class="form-label">Nomer Transaksi</label>
        <input type="text" class="form-control-plaintext <?= $invalid ?> fw-bold" id="no_transaksi" name="no_transaksi" readonly value="<?= $data['no_transaksi'] ?>">
        <?php if ($invalid) : ?>
          <div class="invalid-feedback">
            Nomer Transaksi tidak boleh kosong.
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="no_marketing" class="form-label">Nomer Marketing</label>
        <input type="text" class="form-control-plaintext <?= $invalid ?> fw-bold" id="no_marketing" name="no_marketing" readonly value="<?= $data['no_marketing'] ?>">
        <?php if ($invalid) : ?>
          <div class="invalid-feedback">
            Nomer Marketing tidak boleh kosong.
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="angsuran" class="form-label">Angsuran</label>
        <input type="text" class="form-control-plaintext <?= $invalid ?> fw-bold" id="angsuran" name="angsuran" readonly value="<?= $data['angsuran'] ?>">
        <?php if ($invalid) : ?>
          <div class="invalid-feedback">
            Angsuran tidak boleh kosong.
          </div>
        <?php endif; ?>
      </div>
      <button type="submit" name="simpan" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
      <a href="?page=detail-transaksi&transaksi=<?= $no_transaksi ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </form>
  </div>
</div>