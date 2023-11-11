<nav class="navbar navbar-expand-lg bg-light no-print">
  <div class="container">
    <a class="navbar-brand" href="#">SiPinda</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php if (isset($_SESSION['username'])) : ?>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?= ($_GET['page'] == "home"  ? "active" : "") ?>" aria-current="page" href="index.php"><i class="fas fa-home fa-sm"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($_GET['page'] == "data-peminjam" || ($_GET['page'] == "tambah-peminjam") || ($_GET['page'] == "detail-peminjam") || ($_GET['page'] == "edit-peminjam") || ($_GET['page'] == "cetak-peminjam") ? "active" : "") ?>" href="?page=data-peminjam"><i class="fas fa-server fa-sm"></i> Data Peminjam</a>
          </li>
          <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") : ?>
            <li class="nav-item">
              <a class="nav-link <?= ($_GET['page'] == "data-marketing" || ($_GET['page'] == "tambah-marketing") || ($_GET['page'] == "detail-marketing") || ($_GET['page'] == "edit-marketing") || ($_GET['page'] == "cetak-marketing") ? "active" : "") ?>" href="?page=data-marketing"><i class="fas fa-shopping-bag fa-sm"></i> Data Marketing</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= ($_GET['page'] == "data-user" || $_GET['page'] == "cetak-user" ? "active" : "") ?>" href="?page=data-user"><i class="fas fa-users-cog fa-sm"></i> Data User</a>
            </li>
          <?php endif; ?>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <span class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; cursor: pointer;">
              <i class="fas fa-user fa-sm"></i> <?= $_SESSION['username'] ?>
            </span>
            <ul class="dropdown-menu dropdown-menu-light">
              <li><a class="dropdown-item" href="?page=logout"><i class="fas fa-sign-out-alt fa-sm"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      <?php else : ?>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?= (!isset($_GET['page']) || $_GET['page'] == "login" ? "active" : "") ?>" aria-current="page" href="?page=login"><i class="fas fa-sign-in-alt fa-sm"></i> Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == "register" ? "active" : "") ?>" href="?page=register"><i class="fas fa-user-plus fa-sm"></i> Register</a>
          </li>

        </ul>
      <?php endif; ?>
    </div>
  </div>
</nav>