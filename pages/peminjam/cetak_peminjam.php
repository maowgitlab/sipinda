<?php
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<div class="row my-3">
  <div class="col-lg">
    <div class="text-center mb-5">
      <h1>Data Laporan Peminjaman</h1>
    </div>
    <button class="btn btn-sm btn-secondary no-print" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Nomer Telepon</th>
            <th>DA Motor</th>
            <th>Nomer Kontrak</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $dataPinjaman = mysqli_query($koneksi, "SELECT tb_peminjam.*, tb_marketing.no_marketing, tb_marketing.nama_marketing FROM tb_peminjam JOIN tb_marketing ON tb_peminjam.no_kontrak = tb_marketing.no_marketing ORDER BY tb_peminjam.id DESC");
          ?>
          <?php if (mysqli_num_rows($dataPinjaman) == 0) : ?>
            <tr>
              <td colspan="5" class="text-center fw-bold text-danger">Data Peminjaman Masih Kosong</td>
            </tr>
          <?php else : ?>
            <?php foreach ($dataPinjaman as $data) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['nama'] ?></td>
                <td>(+62)<?= $data['no_telp'] ?></td>
                <td>DA <?= $data['da_motor'] ?></td>
                <td><?= $data['no_kontrak'] ?> - <?= $data['nama_marketing'] ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <div class="text-end mt-5">
      <small><strong>Banjarmasin, <?= date('d F Y') ?></strong></small>
    </div>
    <div class="text-end" style="margin-top: 5rem; margin-right: 2rem;">
      <small><strong>(...................................)</strong></small>
    </div>
  </div>
</div>