<?php
// Mengaktifkan session PHP
session_start();

// Menghubungkan dengan koneksi
include 'koneksi.php'; // Pastikan file koneksi.php berada di direktori yang benar

// Jika form login dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Menangkap data yang dikirim dari form
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Menyeleksi data admin dengan username dan password yang sesuai
  $data = mysqli_query($koneksi, "SELECT * FROM data_admin WHERE username='$username' AND password='$password'");
  $dpengguna = mysqli_fetch_assoc($data);

  // Menghitung jumlah data yang ditemukan
  $cek = mysqli_num_rows($data);

  if ($cek > 0) {
    $idpengguna = $dpengguna['id_pengguna'];
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    $_SESSION['idpengguna'] = $idpengguna;
    header("location:index.php");
    exit(); // Pastikan untuk menghentikan eksekusi script setelah redirect
  } else {
    $pesan = "Login gagal! Username atau Password salah.";
  }
} else {
  $pesan = "Masuk untuk memulai sesi";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Selamat Datang</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
            <div class="col-lg-6 d-none d-lg-block">
            <img src="img/logo_kumham.jpg" class="img-fluid" alt="Logo">
            </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                  </div>
                  <form class="user" action="" method="POST">
                    
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" id="username" aria-describedby="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                    <hr>
                  </form>
                </div>
              </div>
            </div>
          </div>
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

  
</body>
</html>
