<?php
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<?php
$id = $_GET['id'];
$dataPeminjamById = mysqli_query($koneksi, "SELECT tb_peminjam.*, tb_marketing.no_marketing, tb_marketing.nama_marketing FROM tb_peminjam JOIN tb_marketing ON tb_peminjam.no_kontrak = tb_marketing.no_marketing WHERE tb_peminjam.id = '$id'");
$data = mysqli_fetch_assoc($dataPeminjamById);
?>
<div class="row my-3">
  <div class="col-lg">
    <h1>Detail Data Peminjam</h1>
    <div class="card">
      <h5 class="card-header"><i class="fas fa-id-card"></i> <?= $data['nama'] ?></h5>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
            <div class="mb-3 row">
              <label for="no_telp" class="col-sm-4 col-form-label fw-bold">Nomer Telepon</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext border-bottom border-1" id="no_telp" value="(+62)<?= $data['no_telp'] ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="alamat" class="col-sm-4 col-form-label fw-bold">Alamat</label>
              <div class="col-sm-8">
                <textarea name="alamat" id="alamat" readonly class="form-control-plaintext border-bottom border-1" cols="30" rows="4"><?= $data['alamat'] ?></textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="da_motor" class="col-sm-4 col-form-label fw-bold">DA Motor</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext border-bottom border-1" id="da_motor" value="DA <?= $data['da_motor'] ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="dicairkan_oleh" class="col-sm-4 col-form-label fw-bold">Dicarikan Oleh</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext border-bottom border-1" id="dicairkan_oleh" value="<?= $data['dicairkan_oleh'] ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="top" class="col-sm-4 col-form-label fw-bold">TOP</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext border-bottom border-1" id="top" value="<?= $data['top'] ?> BLN">
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="mb-3 row">
              <label for="no_kontrak" class="col-sm-4 col-form-label fw-bold">Nomer Kontrak</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext border-bottom border-1" id="no_kontrak" value="<?= $data['no_kontrak'] ?> - <?= $data['nama_marketing'] ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="total_angsuran" class="col-sm-4 col-form-label fw-bold">Angsuran</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext border-bottom border-1" id="total_angsuran" value="Rp. <?= number_format($data['angsuran'], 0, '.', '.') ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="pinjaman" class="col-sm-4 col-form-label fw-bold">Total Pinjaman</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext border-bottom border-1" id="pinjaman" value="Rp. <?= number_format($data['total_pinjaman'], 0, '.', '.') ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="jenis_pencairan" class="col-sm-4 col-form-label fw-bold">Jenis Pencairan</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext border-bottom border-1" id="jenis_pencairan" value="<?= $data['jenis_pencairan'] ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tglpeminjaman" class="col-sm-4 col-form-label fw-bold">Tanggal Peminjaman</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext border-bottom border-1" id="tlgpeminjaman" value="<?= date('d F Y H:i:s', $data['created_at']) ?>">
              </div>
            </div>
          </div>
        </div>
        <a href="?page=data-peminjam" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
      </div>
    </div>
  </div>
</div>