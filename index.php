
<!DOCTYPE html>
<?php
// Mulai session
session_start();

// Pastikan session username sudah diatur
if (!isset($_SESSION['username'])) {
    die("Anda belum login. Silakan login terlebih dahulu.");
}

// Ambil username dari session
$username = $_SESSION['username'];

// Include file koneksi
include 'Koneksi.php'; // Pastikan path file ini sudah benar

// Debugging: Cek apakah koneksi berhasil

// Query untuk mengambil data admin berdasarkan username
$query = "SELECT * FROM data_admin WHERE username = '$username'";
$data = mysqli_query($koneksi, $query);

// Debugging: Cek apakah query berhasil


// Ambil data admin
$d = mysqli_fetch_array($data);

// Debugging: Cek apakah data berhasil diambil

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
    <meta charset="UTF-8">
    <title>Administrasi</title>
    <link rel="icon" type="image/x-icon" href="img/logo_kumham.jpg">


  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
  <!-- Navbar / Menu -->
  


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> Administrasi</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon">
        <img src="img/logo_kumham.jpg" alt="Logo" style="width: 50px; height: 50px;">
    </div>
    <div class="sidebar-brand-text mx-3"> Kemenkumham <sup></sup></div>
</a>



      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
            <!-- Nav Item - inpu kwitansi -->
            <li class="nav-item active">
              <a class="nav-link" href="tabel_transaksicrud.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Input kwitansi</span></a>
            </li>
            <!-- Nav Item - Admin -->
            <li class="nav-item active">
              <a class="nav-link" href="tabel_admin.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Data Admin</span></a>
            </li>
             <!-- Nav Item kegiatan -  -->
             <li class="nav-item active">
              <a class="nav-link" href="perjalanan_dinas.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Perjalanan Dinas</span></a>
            </li>
           <!-- Nav Item - tabel Rab -->
           <li class="nav-item active">
              <a class="nav-link" href="tabel_rab.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>RAB</span></a>
            </li>
          </li>
          
            
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="img/logo_kumham.jpg" class="img-profile rounded-circle">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($d['username']); ?></span>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">
          <img src="img/logo_power.jpg" class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400">logout</i>
          </a>
          <!-- Additional dropdown items can be added here -->
        </div>
      </li>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="login.php" data-toggle="modal" data-target="#logoutModal">
              <img src="img/logo_power.jpg" class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400" style="width: 18px; height: 18px; object-fit: cover; border-radius: 50%;" alt="Logout">
              Logout
              </a>
            </div>
            </li>

          </ul>

        </nav>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Welcome, <?php echo htmlspecialchars($d['username']); ?></h1>
    <!-- Additional page content can be added here -->
  </div>

<!-- Table to display transaction data -->
<div class="card mt-3">
        <div class="card-header bg-danger text-white">
            Tabel Transaksi
        </div>
        <a href="transaksi/laporantransaksi.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a>
        <div class="card-body">
        <br>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Pengguna</th>
                        <th>No Surat</th>
                        <th>Kode Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Kepada</th>
                        <th>Keterangan</th>
                        <th>Jumlah Bayar</th>
                        <th>Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM tabel_transaksi");
                    while ($data = mysqli_fetch_array($tampil)) :
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['id_pengguna'] ?></td>
                            <td><?= $data['no_surat'] ?></td>
                            <td><?= $data['kode_kegiatan'] ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['kepada'] ?></td>
                            <td><?= $data['keterangan'] ?></td>
                            <td><?= $data['jumlah_bayar'] ?></td>
                            <td><img src="<?= $data['upload'] ?>" width="100" data-toggle="modal" data-target="#imageModal<?= $data['no_surat'] ?>"></td>
                            <td>
                                <a href="tabel_transaksicrud.php?hal=edit&no_surat=<?= $data['no_surat'] ?>" class="btn btn-warning">Edit</a>
                                <a href="tabel_transaksicrud.php?hal=hapus&no_surat=<?= $data['no_surat'] ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>

                        <!-- Modal to display image -->
                        <div class="modal fade" id="imageModal<?= $data['no_surat'] ?>" tabindex="-1" aria-labelledby="imageModalLabel<?= $data['no_surat'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="imageModalLabel<?= $data['no_surat'] ?>">Image Preview</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="<?= $data['upload'] ?>" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                         ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    
        
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>novia rahmah &copy; @nvfiaa.18_</span>
          </div>
        </div>
      </footer>
      
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
<?php

