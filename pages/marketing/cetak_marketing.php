<?php
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<div class="row my-3">
  <div class="col-lg">
    <div class="text-center mb-5">
      <h1>Data Laporan Marketing</h1>
    </div>
    <button class="btn btn-sm btn-secondary no-print" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
    <table class="table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nomer Marketing</th>
          <th>Nama</th>
          <th>Kode Cabang</th>
          <th>Unit Head</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $dataMarketing = mysqli_query($koneksi, "SELECT * FROM tb_marketing ORDER BY id DESC");
        ?>
        <?php if (mysqli_num_rows($dataMarketing) == 0) : ?>
          <tr>
            <td class="fw-bold text-center text-danger" colspan="5">Data Marketing masih kosong.</td>
          </tr>
        <?php else : ?>
          <?php foreach ($dataMarketing as $data) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data['no_marketing'] ?></td>
              <td><?= $data['nama_marketing'] ?></td>
              <td><?= $data['kode_cabang'] ?></td>
              <td><?= $data['unit_head'] ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
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