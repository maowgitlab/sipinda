<?php
if (!isset($_SESSION['username'])) {
  header('location: ?page=login');
}
?>
<div class="row my-3">
  <div class="col-lg">
    <div class="text-center text-lg-start">
      <h1 class="d-lg-inline">Data User</h1>
      <a href="?page=cetak-user" class="btn btn-sm btn-secondary mb-3"><i class="fas fa-print"></i> Cetak</a>
    </div>
    <div class="table-responsive">
      <table class="table table-striped" id="tabel-user" width="100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Terakhir Login</th>
            <th>Tanggal Daftar</th>
            <th class="text-center">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $dataUser = mysqli_query($koneksi, "SELECT * FROM tb_users WHERE role = 'operator' ORDER by id DESC");
          ?>
          <?php foreach ($dataUser as $data) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data['username'] ?></td>
              <td><?= $data['email'] ?></td>
              <td><?= $data['role'] ?></td>
              <td><?= date('d F Y H:i:s', $data['terakhir_login']) == "01 January 1970 07:30:00" ? "-" : date('d F Y H:i:s', $data['terakhir_login']) ?></td>
              <td><?= date('d F Y H:i:s', $data['created_at']) ?></td>
              <td>
                <div class="d-flex justify-content-center">
                  <button type="button" class="btn btn-sm btn-danger" onclick="hapusUser(<?= $data['id'] ?>)"><i class="fas fa-trash"></i></button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>