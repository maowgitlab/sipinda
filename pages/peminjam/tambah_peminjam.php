<?php
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<?php
$invalid = "";
if (isset($_POST['simpan'])) {
  $nama = htmlspecialchars($_POST['nama']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $no_telp = htmlspecialchars($_POST['no_telp']);
  $da_motor = htmlspecialchars($_POST['da_motor']);
  $dicairkan_oleh = htmlspecialchars($_POST['dicairkan_oleh']);
  $top = htmlspecialchars($_POST['top']);
  $total_pinjaman = htmlspecialchars($_POST['total_pinjaman']);
  $no_kontrak = $_POST['no_kontrak'] ?? null;
  $jenis_pencairan = $_POST['jenis_pencairan'] ?? null;
  $created_at = time();

  if ($nama == null || $alamat == null || $no_telp == null || $da_motor == null || $dicairkan_oleh == null || $top == null || $total_pinjaman == null || $no_kontrak == null || $jenis_pencairan == null) {
    $invalid = "is-invalid";
  } else {
    $angsuran = $total_pinjaman / $top;
    $sisa_pinjaman = $total_pinjaman - $angsuran;
    $query = mysqli_query($koneksi, "INSERT INTO tb_peminjam VALUES(NULL, '$nama', '$alamat', '$no_telp', '$da_motor', '$dicairkan_oleh', '$top', '$angsuran', '$no_kontrak', '$total_pinjaman', '$jenis_pencairan', '$created_at')");
    $id_peminjam = mysqli_insert_id($koneksi);
    $no_transaksi = $faker->numerify('TR-####-####-####');
    mysqli_query($koneksi, "INSERT INTO tb_transaksi (id, no_transaksi, no_marketing, id_peminjam, angsuran, sisa_pinjaman, created_at) VALUES (NULL, '$no_transaksi', '$no_kontrak', '$id_peminjam', '$angsuran', '$sisa_pinjaman', '$created_at');");
    if ($query) {
      echo "
    <script>
    alert('Data Peminjam Berhasil ditambahkan.');
    window.location = '?page=data-peminjam';
    </script>
    ";
    }
  }
}
?>
<div class="row my-3">
  <div class="col-lg">
    <h1 class="mb-3">Tambah Data Peminjam</h1>
    <form action="" method="post">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control <?= $invalid ?>" id="nama" name="nama" autofocus>
        <?php if ($invalid) : ?>
          <div class="invalid-feedback">
            Nama tidak boleh kosong.
          </div>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control <?= $invalid ?>" id="alamat" name="alamat" rows="3"></textarea>
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
            <input type="text" class="form-control <?= $invalid ?>" placeholder="81283123" name="no_telp" aria-describedby="basic-addon1">
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
            <input type="text" class="form-control <?= $invalid ?>" placeholder="2131 HA" name="da_motor" aria-describedby="basic-addon1">
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                DA Motor tidak boleh kosong.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="mb-3">
            <label for="dicairkan_oleh" class="form-label">Dicairkan Oleh</label>
            <input type="text" class="form-control <?= $invalid ?>" id="dicairkan_oleh" name="dicairkan_oleh" value="khadijah">
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                Dicarikan Oleh tidak boleh kosong.
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-lg-4">
          <label for="total_pinjaman" class="form-label">Total Pinjaman</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Rp</span>
            <input type="text" class="form-control <?= $invalid ?>" placeholder="1500000" name="total_pinjaman" aria-describedby="basic-addon1">
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                Total Pinjaman tidak boleh kosong.
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-lg-4">
          <label for="top" class="form-label">TOP</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control <?= $invalid ?>" placeholder="12" name="top">
            <span class="input-group-text" id="basic-addon2">BLN</span>
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                TOP tidak boleh kosong.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- <div class="row">
        <div class="col-lg-6">
          <label for="angsuran" class="form-label">Angsuran</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Rp</span>
            <input type="text" class="form-control <?= $invalid ?>" placeholder="1500000" name="angsuran" aria-describedby="basic-addon1">
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                Angsuran tidak boleh kosong.
              </div>
            <?php endif; ?>
          </div>
        </div>

      </div> -->
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
                <option selected disabled>Pilih Nomer Kontrak</option>
                <?php foreach ($dataMarketing as $dataM) : ?>
                  <option value="<?= $dataM['no_marketing'] ?>"><?= $dataM['no_marketing'] ?> - <?= $dataM['nama_marketing'] ?></option>
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
              <option selected disabled>Pilih Jenin Pencairan</option>
              <option value="CASH">CASH</option>
              <option value="TRANSFER">TRANSFER</option>
            </select>
            <?php if ($invalid) : ?>
              <div class="invalid-feedback">
                Jenis Pencairan harus dipilih.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <button type="submit" name="simpan" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
      <a href="?page=data-peminjam" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </form>
  </div>
</div>