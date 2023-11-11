<?php
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<div class="row my-3">
  <div class="col-lg">
    <div class="text-center mb-5">
      <h1>Data Laporan akun User</h1>
    </div>
    <button class="btn btn-sm btn-secondary no-print" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th class="text-center">Tanggal Daftar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $dataUser = mysqli_query($koneksi, "SELECT * FROM tb_users WHERE role = 'operator' ORDER by id DESC");
          ?>
          <?php if (mysqli_num_rows($dataUser) == 0) : ?>
            <tr>
              <td colspan="6" class="text-center fw-bold text-danger">Data User Masih Kosong.</td>
            </tr>
          <?php else : ?>
            <?php foreach ($dataUser as $data) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['username'] ?></td>
                <td><?= $data['email'] ?></td>
                <td><?= $data['role'] ?></td>
                <td class="text-center"><?= date('d F Y H:i:s', $data['created_at']) ?></td>
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