<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title class="no-print">
    <?php
    if (isset($_GET['page']) == "data-peminjam") {
      echo "Data Peminjam";
    } else {
      echo "Selamat Datang";
    }
    ?>
  </title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
  <style>
    @media print {
      .no-print {
        display: none;
      }

      @page {
        size: landscape;
      }
    }
  </style>
</head>

<body>
  <?php session_start() ?>
  <?php require_once "vendor/autoload.php"; ?>
  <?php include "pages/navbar.php"; ?>
  <?php include "DB/koneksi.php"; ?>
  <div class="<?= (isset($_GET['page']) && $_GET['page'] == "cetak-peminjam") || (isset($_GET['page']) && $_GET['page'] == "cetak-user") || (isset($_GET['page']) && $_GET['page'] == "cetak-marketing") ? "container-fluid" : "container" ?>">
    <?php
    $faker = Faker\Factory::create();
    if (isset($_GET['page'])) {
      $page = $_GET['page'];
      switch ($page) {

        case 'home':
          include "pages/home.php";
          break;

        case 'logout':
          include "pages/auth/logout.php";
          break;

        case 'login':
          include "pages/auth/login.php";
          break;

        case 'register':
          include "pages/auth/register.php";
          break;

          # Data Peminjam
        case 'data-peminjam':
          include "pages/peminjam/peminjam.php";
          break;

        case 'detail-peminjam':
          include "pages/peminjam/detail_peminjam.php";
          break;

        case 'edit-peminjam':
          include "pages/peminjam/edit_peminjam.php";
          break;

        case 'hapus-peminjam':
          include "pages/peminjam/hapus_peminjam.php";
          break;

        case 'tambah-peminjam':
          include "pages/peminjam/tambah_peminjam.php";
          break;

        case 'cetak-peminjam':
          include "pages/peminjam/cetak_peminjam.php";
          break;

          # Data Marketing
        case 'data-marketing':
          include "pages/marketing/marketing.php";
          break;

        case 'edit-marketing':
          include "pages/marketing/edit_marketing.php";
          break;

        case 'hapus-marketing':
          include "pages/marketing/hapus_marketing.php";
          break;

        case 'tambah-marketing':
          include "pages/marketing/tambah_marketing.php";
          break;

        case 'cetak-marketing':
          include "pages/marketing/cetak_marketing.php";
          break;

          #Data User
        case 'data-user':
          include "pages/user/user.php";
          break;

        case 'hapus-user':
          include "pages/user/hapus_user.php";
          break;

        case 'cetak-user':
          include "pages/user/cetak_user.php";
          break;

        default:
          echo "Halaman Tidak ditemukan";
          break;
      }
    } else {
      include "pages/auth/login.php";
    }
    ?>
  </div>
  <script src="assets/js/jquery-3.7.0.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jquery.dataTables.min.js"></script>
  <script src="assets/js/sweetalert2.js"></script>
  <script>
    new DataTable('#tabel-peminjam')
    new DataTable('#tabel-user')
    new DataTable('#tabel-marketing')

    function hapusPeminjam(id) {
      Swal.fire({
        title: 'Hapus data peminjam ini?',
        text: "Anda tidak akan dapat mengembalikan tindakan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus data!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Berhasil!",
            text: "Data Peminjam ini Berhasil dihapus.",
            icon: "success"
          });
          setTimeout(function() {
            window.location.href = "?page=hapus-peminjam&id=" + id;
          }, 2000);
        }
      })
    }

    function hapusUser(id) {
      Swal.fire({
        title: 'Hapus data user ini?',
        text: "Anda tidak akan dapat mengembalikan tindakan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus data!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Berhasil!",
            text: "Data User ini Berhasil dihapus.",
            icon: "success"
          });
          setTimeout(function() {
            window.location.href = "?page=hapus-user&id=" + id;
          }, 2000);
        }
      })
    }

    function hapusMarketing(id) {
      Swal.fire({
        title: 'Hapus data marketing ini?',
        text: "Anda tidak akan dapat mengembalikan tindakan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus data!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Berhasil!",
            text: "Data Marketing ini Berhasil dihapus.",
            icon: "success"
          });
          setTimeout(function() {
            window.location.href = "?page=hapus-marketing&id=" + id;
          }, 2000);
        }
      })
    }
  </script>
</body>

</html>