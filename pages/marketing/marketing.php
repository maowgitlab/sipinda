<?php
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<div class="row my-3">
  <div class="col-lg">
    <div class="text-center text-lg-start">
      <h1 class="d-lg-inline">Data Marketing</h1>
      <a href="?page=tambah-marketing" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Input Data marketing Baru</a>
      <a href="?page=cetak-marketing" class="btn btn-sm btn-secondary mb-3"><i class="fas fa-print"></i> Cetak</a>
    </div>
    <div class="table-responsive">
      <table class="table table-striped" id="tabel-marketing" width="100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nomer Marketing</th>
            <th>Nama</th>
            <th>Kode Cabang</th>
            <th>Unit Head</th>
            <th>Dibuat tanggal</th>
            <th class="text-center">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $dataMarketing = mysqli_query($koneksi, "SELECT * FROM tb_marketing ORDER BY id DESC");
          ?>
          <?php foreach ($dataMarketing as $data) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data['no_marketing'] ?></td>
              <td><?= $data['nama_marketing'] ?></td>
              <td><?= $data['kode_cabang'] ?></td>
              <td><?= $data['unit_head'] ?></td>
              <td><?= date('d F Y H:i:s', $data['created_at']) ?></td>
              <td>
                  <a href="?page=edit-marketing&id=<?= $data['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                  <button type="button" class="btn btn-sm btn-danger" onclick="hapusMarketing(<?= $data['id'] ?>)"><i class="fas fa-trash"></i></button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>