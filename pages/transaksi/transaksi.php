<?php
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<div class="row my-3">
  <div class="col-lg">
    <div class="text-center text-lg-start">
      <h1 class="d-lg-inline">Data Transaksi</h1>
      <!-- <a href="?page=cetak-transaksi" class="btn btn-sm btn-secondary mb-3"><i class="fas fa-print"></i> Cetak</a> -->
    </div>
    <div class="table-responsive">
      <table class="table table-striped" id="tabel-detail-transaksi" width="100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nomer Transaksi</th>
            <th>Nomer Marketing</th>
            <th>Nama Peminjam</th>
            <th class="text-center">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $dataTransaksi = mysqli_query($koneksi, "SELECT 
              tb_transaksi.no_transaksi, 
              tb_transaksi.no_marketing, 
              tb_transaksi.id_peminjam, 
              tb_peminjam.nama, 
              tb_marketing.no_marketing, 
              tb_marketing.nama_marketing 
          FROM 
              tb_transaksi 
          JOIN 
              tb_peminjam ON tb_transaksi.id_peminjam = tb_peminjam.id
          JOIN 
              tb_marketing ON tb_transaksi.no_marketing = tb_marketing.no_marketing
          GROUP BY 
              tb_transaksi.no_transaksi, 
              tb_transaksi.no_marketing, 
              tb_transaksi.id_peminjam, 
              tb_peminjam.nama, 
              tb_marketing.no_marketing,  
              tb_marketing.nama_marketing");
          ?>
          <?php foreach ($dataTransaksi as $data) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data['no_transaksi'] ?></td>
              <td><?= $data['no_marketing'] ?> - <?= $data['nama_marketing'] ?></td>
              <td><?= $data['nama'] ?></td>
              <td>
                <div class="d-flex justify-content-center">
                  <a href="?page=detail-transaksi&transaksi=<?= $data['no_transaksi'] ?>" class="btn btn-sm btn-info"><i class="fas fa-search"></i></a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>