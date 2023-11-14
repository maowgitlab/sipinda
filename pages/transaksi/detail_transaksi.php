<?php
$no_transaksi = $_GET['transaksi'];
$dataTransaksi = mysqli_query($koneksi, "SELECT tb_transaksi.id, tb_transaksi.no_transaksi, tb_transaksi.no_marketing, tb_transaksi.id_peminjam, tb_transaksi.angsuran AS angsuran_transaksi, tb_transaksi.sisa_pinjaman, tb_transaksi.created_at, tb_peminjam.nama, tb_peminjam.total_pinjaman, tb_marketing.no_marketing, tb_marketing.nama_marketing FROM tb_transaksi JOIN tb_peminjam JOIN tb_marketing ON tb_transaksi.no_marketing = tb_marketing.no_marketing AND tb_transaksi.id_peminjam = tb_peminjam.id WHERE tb_transaksi.no_transaksi = '$no_transaksi'");
$query = mysqli_fetch_assoc($dataTransaksi);
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<div class="row my-3">
  <div class="col-lg">
    <div class="text-center text-lg-start">
      <h1 class="d-lg-inline">Detail Transaksi</h1>
      <a href="?page=cetak-detail-transaksi&transaksi=<?= $no_transaksi ?>" class="btn btn-sm btn-secondary mb-3"><i class="fas fa-print"></i> Cetak</a>
      <?php if ($query['sisa_pinjaman'] > 0) : ?>
        <a href="?page=tambah-transaksi&transaksi=<?= $no_transaksi ?>" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus fa-sm"></i> Tambah Data Transaksi</a>
      <?php endif; ?>
      <a href="#" class="btn-sm btn btn-info mb-3 fw-bold">Total Pinjaman: Rp. <?= number_format($query['total_pinjaman'], 0, '.', '.') ?></a>
    </div>
    <div class="table-responsive">
      <table class="table table-striped" id="tabel-transaksi" width="100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Peminjam</th>
            <th>Angsuran</th>
            <th>Sisa Pinjaman</th>
            <th>Tanggal Bayar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          ?>
          <?php foreach ($dataTransaksi as $data) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data['nama'] ?></td>
              <td>Rp. <?= number_format($data['angsuran_transaksi'], 0, '.', '.') ?> / BLN</td>
              <td><?= $data['sisa_pinjaman'] == 0 || $data['sisa_pinjaman'] < 0 ? "<small class='badge rounded-pill text-bg-success'><i class='fas fa-check-circle'></i> LUNAS</small>" : "Rp. " . number_format($data['sisa_pinjaman'], 0, '.', '.') ?></td>
              <td><?= date('d F Y H:i', $data['created_at']) ?> WITA</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>