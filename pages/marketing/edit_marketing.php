<?php
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<?php
$invalid = "";
$id = $_GET['id'];
$dataMarketing = mysqli_query($koneksi, "SELECT * FROM tb_marketing WHERE id = '$id'");
$data = mysqli_fetch_assoc($dataMarketing);
if (isset($_POST['update'])) {
  $no_marketing = htmlspecialchars($_POST['no_marketing']);
  $nama_marketing = htmlspecialchars($_POST['nama_marketing']);
  $kode_cabang = htmlspecialchars($_POST['kode_cabang']);
  $unit_head = htmlspecialchars($_POST['unit_head']);

  if ($no_marketing == null || $nama_marketing == null || $kode_cabang == null || $unit_head == null) {
    $invalid = "is-invalid";
  } else {
    $query = mysqli_query($koneksi, "UPDATE tb_marketing SET nama_marketing = '$nama_marketing' WHERE id = '$id'");
    if ($query) {
      echo "
    <script>
    alert('Data Marketing Berhasil diperbarui.');
    window.location = '?page=data-marketing';
    </script>
    ";
    }
  }
}
?>
<div class="row my-3">
  <div class="col-lg">
    <h1 class="mb-3">Edit Data Marketing</h1>
    <form action="" method="post">
      <div class="mb-3">
        <label for="no_marketing" class="form-label">Nomer Marketing <sup class="text-danger"><strong>(Otomatis)</strong></sup></label>
        <input type="text" class="form-control <?= $invalid ?>" id="no_marketing" name="no_marketing" readonly value="<?= $data['no_marketing'] ?>">
        <?php if ($invalid) : ?>
          <div class="invalid-feedback">
            Nomer Marketing boleh kosong.
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="nama_marketing" class="form-label">Nama</label>
        <input type="text" class="form-control <?= $invalid ?>" id="nama_marketing" name="nama_marketing" autofocus value="<?= $data['nama_marketing'] ?>">
        <?php if ($invalid) : ?>
          <div class="invalid-feedback">
            Nama tidak boleh kosong.
          </div>
        <?php endif; ?>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <label for="kode_cabang" class="form-label">Kode Cabang <sup class="text-danger"><strong>(Otomatis)</strong></sup></label>
          <div class="input-group mb-3">
            <input type="text" class="form-control <?= $invalid ?>" value="<?= $data['kode_cabang'] ?>" name="kode_cabang">
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                Kode Cabang tidak boleh kosong.
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-lg-6">
          <label for="unit_head" class="form-label">Unit Head <sup class="text-danger"><strong>(Otomatis)</strong></sup></label>
          <div class="input-group mb-3">
            <input type="text" class="form-control <?= $invalid ?>" value="<?= $data['unit_head'] ?>" name="unit_head">
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                Unit Head tidak boleh kosong.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <button type="submit" name="update" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Update</button>
      <a href="?page=data-marketing" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </form>
  </div>
</div>