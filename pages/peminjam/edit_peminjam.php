<?php
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<?php
$invalid = "";
$id = $_GET['id'];
$dataPeminjamById = mysqli_query($koneksi, "SELECT * FROM tb_peminjam WHERE id = '$id'");
$data = mysqli_fetch_assoc($dataPeminjamById);

if (isset($_POST['update'])) {
  $nama = htmlspecialchars($_POST['nama']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $no_telp = htmlspecialchars($_POST['no_telp']);
  $da_motor = htmlspecialchars($_POST['da_motor']);
  $dicairkan_oleh = htmlspecialchars($_POST['dicairkan_oleh']);
  $top = htmlspecialchars($_POST['top']);
  $angsuran = htmlspecialchars($_POST['angsuran']);
  $total_pinjaman = htmlspecialchars($_POST['total_pinjaman']);
  $no_kontrak = $_POST['no_kontrak'] ?? null;
  $jenis_pencairan = $_POST['jenis_pencairan'] ?? null;

  if ($nama == null || $alamat == null || $no_telp == null || $da_motor == null || $dicairkan_oleh == null || $top == null || $angsuran == null || $total_pinjaman == null || $no_kontrak == null || $jenis_pencairan == null) {
    $invalid = "is-invalid";
  } else {
    $query = mysqli_query($koneksi, "UPDATE tb_peminjam SET nama='$nama', alamat='$alamat', no_telp='$no_telp', da_motor='$da_motor', dicairkan_oleh='$dicairkan_oleh', top='$top', angsuran='$angsuran', total_pinjaman='$total_pinjaman', no_kontrak='$no_kontrak', jenis_pencairan='$jenis_pencairan' WHERE id = '$id'");
    if ($query) {
      echo "
      <script>
      alert('Data Peminjam Berhasil diperbarui.');
      window.location = '?page=data-peminjam';
      </script>
      ";
    }
  }
}
?>
<div class="row my-3">
  <div class="col-lg">
    <h1 class="mb-3">Edit Data Peminjam</h1>
    <form action="" method="post">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control <?= $invalid ?>" id="nama" value="<?= $data['nama'] ?>" name="nama" autofocus>
        <?php if ($invalid) : ?>
          <div class="invalid-feedback">
            Nama tidak boleh kosong.
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control <?= $invalid ?>" id="alamat" name="alamat" rows="3"><?= $data['alamat'] ?></textarea>
        <?php if ($invalid) : ?>
          <div class="invalid-feedback">
            Alamat tidak boleh kosong.
          </div>
        <?php endif; ?>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <label for="no_telp" class="form-label">Nomer Telepon</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">+62</span>
            <input type="text" class="form-control <?= $invalid ?>" placeholder="81283123" name="no_telp" aria-describedby="basic-addon1" value="<?= $data['no_telp'] ?>">
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                Nomer Telepon tidak boleh kosong.
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-lg-6">
          <label for="da_motor" class="form-label">DA Motor</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">DA</span>
            <input type="text" class="form-control <?= $invalid ?>" placeholder="2131 HA" name="da_motor" aria-describedby="basic-addon1" value="<?= $data['da_motor'] ?>">
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                DA Motor tidak boleh kosong.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="mb-3">
            <label for="dicairkan_oleh" class="form-label">Dicairkan Oleh</label>
            <input type="text" class="form-control <?= $invalid ?>" id="dicairkan_oleh" name="dicairkan_oleh" value="<?= $data['dicairkan_oleh'] ?>" readonly>
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                Dicarikan Oleh tidak boleh kosong.
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-lg-6">
          <label for="top" class="form-label">TOP</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control <?= $invalid ?>" value="<?= $data['top'] ?>" placeholder="12" name="top">
            <span class="input-group-text" id="basic-addon2">BLN</span>
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                TOP tidak boleh kosong.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <label for="angsuran" class="form-label">Angsuran</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Rp</span>
            <input type="text" class="form-control <?= $invalid ?>" placeholder="1500000" name="angsuran" aria-describedby="basic-addon1" value="<?= $data['angsuran'] ?>">
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                Angsuran tidak boleh kosong.
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-lg-6">
          <label for="total_pinjaman" class="form-label">Total Pinjaman</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Rp</span>
            <input type="text" class="form-control <?= $invalid ?>" placeholder="1500000" name="total_pinjaman" aria-describedby="basic-addon1" value="<?= $data['total_pinjaman'] ?>">
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                Total Pinjaman tidak boleh kosong.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="mb-3">
            <label for="no_kontrak" class="form-label">Nomer Kontrak</label>
            <select class="form-select <?= $invalid ?>" aria-label="Default select example" name="no_kontrak">
              <?php
              $dataMarketing = mysqli_query($koneksi, "SELECT no_marketing, nama_marketing FROM tb_marketing ORDER BY id DESC");
              ?>
              <?php if (mysqli_num_rows($dataMarketing) == 0) : ?>
                <option selected disabled>Nomer Kontrak Masih Kosong.</option>
              <?php else : ?>
                <option disabled>Pilih Nomer Kontrak</option>
                <?php foreach ($dataMarketing as $dataM) : ?>
                  <option value="<?= $dataM['no_marketing'] ?>" <?= $data['no_kontrak'] == $dataM['no_marketing'] ? "selected" : "" ?>><?= $dataM['no_marketing'] ?> - <?= $dataM['nama_marketing'] ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                Jenis Pencairan harus dipilih.
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="mb-3">
            <label for="jenis_pencairan" class="form-label">Jenis Pencairan</label>
            <select class="form-select <?= $invalid ?>" aria-label="Default select example" name="jenis_pencairan">
              <option disabled>Pilih Jenin Pencairan</option>
              <option value="CASH" <?= $data['jenis_pencairan'] == "CASH" ? "selected" : "" ?>>CASH</option>
              <option value="TRANSFER" <?= $data['jenis_pencairan'] == "TRANSFER" ? "selected" : "" ?>>TRANSFER</option>
            </select>
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                Jenis Pencairan harus dipilih.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <button type="submit" name="update" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Update</button>
      <a href="?page=data-peminjam" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </form>
  </div>
</div>