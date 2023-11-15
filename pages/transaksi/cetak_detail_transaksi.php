<?php
$no_transaksi = $_GET['transaksi'];
$dataTransaksi = mysqli_query($koneksi, "SELECT tb_transaksi.id, tb_transaksi.no_transaksi, tb_transaksi.no_marketing, tb_transaksi.id_peminjam, tb_transaksi.angsuran AS angsuran_transaksi, tb_transaksi.sisa_pinjaman, tb_transaksi.created_at, tb_peminjam.*, tb_marketing.no_marketing, tb_marketing.nama_marketing FROM tb_transaksi JOIN tb_peminjam JOIN tb_marketing ON tb_transaksi.no_marketing = tb_marketing.no_marketing AND tb_transaksi.id_peminjam = tb_peminjam.id WHERE tb_transaksi.no_transaksi = '$no_transaksi' ORDER BY tb_transaksi.id DESC");
$query = mysqli_fetch_assoc($dataTransaksi);
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<div class="row my-3">
  <div class="col-lg">
    <div class="text-center mb-5">
      <h1>Data Laporan Detail Transaksi</h1>
    </div>
    <table class="mb-3">
      <tr>
        <td width="200px">Nama</td>
        <td width="20px">:</td>
        <td><?= $query['nama'] ?></td>
      </tr>
      <tr>
        <td width="200px">DA Motor</td>
        <td width="20px">:</td>
        <td>DA <?= $query['da_motor'] ?></td>
      </tr>
      <tr>
        <td width="200px">Nomer Telepon</td>
        <td width="20px">:</td>
        <td>(+62)<?= $query['no_telp'] ?></td>
      </tr>
      <tr style="vertical-align: top;">
        <td width="200px">Alamat</td>
        <td width="20px">:</td>
        <td><textarea class="form-control-plaintext" readonly cols="30" rows="2"><?= $query['alamat'] ?></textarea></td>
      </tr>
      <tr>
        <td width="200px">Dicairkan Oleh</td>
        <td width="20px">:</td>
        <td><?= $query['dicairkan_oleh'] ?></td>
      </tr>
      <tr>
        <td width="200px">Total Pinjaman</td>
        <td width="20px">:</td>
        <td>Rp. <?= number_format($query['total_pinjaman'], 0, '.','.') ?></td>
      </tr>
      <tr>
        <td width="200px">Jenis Pencairan</td>
        <td width="20px">:</td>
        <td><?= $query['jenis_pencairan'] ?></td>
      </tr>
      <tr>
        <td width="200px">Nomer Kontrak</td>
        <td width="20px">:</td>
        <td><?= $query['no_marketing'] ?> - <?= $query['nama_marketing'] ?></td>
      </tr>
      <tr>
        <td width="200px">TOP</td>
        <td width="20px">:</td>
        <td><?= $query['top'] ?> BLN</td>
      </tr>
    </table>
    <button class="btn btn-sm btn-secondary no-print" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
    <table class="table table-striped" width="100%">
      <thead>
        <tr>
          <th class="text-center">No.</th>
          <th class="text-center">Angsuran</th>
          <th class="text-center">Sisa Pinjaman</th>
          <th class="text-center">Tanggal Bayar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        ?>
        <?php foreach ($dataTransaksi as $data) : ?>
          <tr>
            <td class="text-center"><?= $no++; ?></td>
            <td class="text-center">Rp. <?= number_format($data['angsuran_transaksi'], 0, '.', '.') ?> / BLN</td>
            <td class="text-center"><?= $data['sisa_pinjaman'] <= 0.1 ? "<small class='badge rounded-pill text-bg-success'><i class='fas fa-check-circle'></i> LUNAS</small>" : "Rp. " . number_format($data['sisa_pinjaman'], 0, '.', '.') ?></td>
            <td class="text-center"><?= date('d F Y H:i', $data['created_at']) ?> WITA</td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="text-end mt-5">
      <small><strong>Banjarmasin, <?= date('d F Y') ?></strong></small>
    </div>
    <div class="text-end" style="margin-top: 5rem; margin-right: 2rem;">
      <small><strong>(...................................)</strong></small>
    </div>
  </div>
</div>