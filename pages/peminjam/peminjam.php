<?php
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<div class="row my-3">
  <div class="col-lg">
    <div class="text-center text-lg-start">
      <h1 class="d-lg-inline">Data Peminjam</h1>
      <a href="?page=tambah-peminjam" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Input Data Peminjam Baru</a>
      <a href="?page=cetak-peminjam" class="btn btn-sm btn-secondary mb-3"><i class="fas fa-print"></i> Cetak</a>
    </div>
    <div class="table-responsive">
      <table class="table table-striped" id="tabel-peminjam" width="100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Nomer Telepon</th>
            <th>DA Motor</th>
            <th>Nomer Kontrak</th>
            <th class="text-center">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $dataPinjaman = mysqli_query($koneksi, "SELECT tb_peminjam.*, tb_marketing.no_marketing, tb_marketing.nama_marketing FROM tb_peminjam JOIN tb_marketing ON tb_peminjam.no_kontrak = tb_marketing.no_marketing ORDER BY tb_peminjam.id DESC");
          ?>
          <?php foreach ($dataPinjaman as $data) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data['nama'] ?></td>
              <td>(+62)<?= $data['no_telp'] ?></td>
              <td>DA <?= $data['da_motor'] ?></td>
              <td><?= $data['no_kontrak'] ?> - <?= $data['nama_marketing'] ?></td>
              <td>
                <div class="d-flex justify-content-center gap-1">
                  <a href="?page=detail-peminjam&id=<?= $data['id']; ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                  <a href="?page=edit-peminjam&id=<?= $data['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                  <button type="button" class="btn btn-sm btn-danger" onclick="hapusPeminjam(<?= $data['id'] ?>)"><i class="fas fa-trash"></i></button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>