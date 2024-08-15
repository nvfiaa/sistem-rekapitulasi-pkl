<?php
include 'Koneksi.php';

// Tombol simpan (Insert / Update)
if(isset($_POST['btnsimpan'])) {
    $id_pengguna = mysqli_real_escape_string($koneksi, $_POST['btnid_pengguna']);
    $username = mysqli_real_escape_string($koneksi, $_POST['btnusername']);
    $password = mysqli_real_escape_string($koneksi, $_POST['btnpassword']);

    if ($_GET['hal'] == "edit") {
        // Query UPDATE jika data akan diedit
        $edit = mysqli_query($koneksi, "UPDATE data_admin SET
                                        id_pengguna = '$id_pengguna',
                                        username = '$username',
                                        password = '$password'
                                        WHERE id_pengguna = '$_GET[id]'");

        if($edit) {
            echo "<script>
                    alert('Edit Data Sukses!');
                    document.location= 'tabel_admin.php';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Edit Data Gagal!');
                    document.location= 'tabel_admin.php?hal=edit&id=$_GET[id]';
                  </script>";
            exit;
        }
    } else {
        // Query INSERT jika data baru akan disimpan
        $simpan = mysqli_query($koneksi, "INSERT INTO data_admin (id_pengguna, username, password)
                                         VALUES ('$id_pengguna','$username', '$password')");

        if($simpan) {
            echo "<script>
                    alert('Simpan Data Sukses!');
                    document.location= 'tabel_admin.php';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Simpan Data Gagal!');
                    document.location= 'tabel_admin.php';
                  </script>";
            exit;
        }
    }
}

// Uji tombol hapus
if(isset($_GET['hal']) && $_GET['hal'] == "hapus" && isset($_GET['id'])) {
    $hapus = mysqli_query($koneksi, "DELETE FROM data_admin WHERE id_pengguna = '$_GET[id]'");

    if ($hapus) {
        echo "<script>
                alert('Data Telah Dihapus!');
                document.location= 'tabel_admin.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location= 'tabel_admin.php';
              </script>";
        exit;
    }
}

// Tampilkan data untuk form edit
$vid_pengguna = $vusername = $vpassword = '';
if(isset($_GET['hal']) && $_GET['hal'] == "edit" && isset($_GET['id'])) {
    $tampil = mysqli_query($koneksi, "SELECT * FROM data_admin WHERE id_pengguna = '$_GET[id]'");
    $data = mysqli_fetch_array($tampil);
    if($data) {
        $vid_pengguna = $data['id_pengguna'];
        $vusername = $data['username'];
        $vpassword = $data['password'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIN</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2 class="text-center">CRUD Pengguna</h2>

    <!-- Form untuk input/edit data -->
    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            Data Pengguna
        </div>
        <div class="card-body">
            <form action="" method="post">
            <div class="form-group">
                    <label for="id_pengguna">Id Pengguna</label>
                    <input type="text" name="btnid_pengguna" value="<?= $vid_pengguna ?>" class="form-control" placeholder="id_pengguna" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="btnusername" value="<?= $vusername ?>" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="btnpassword" value="<?= $vpassword ?>" class="form-control" placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-success" name="btnsimpan">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
                <a href="index.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Kembali</a>
            </form>
        </div>
    </div>

    <!-- Tabel untuk menampilkan data pengguna -->
    <div class="card mt-3">
        <div class="card-header bg-danger text-white">
            Tabel Admin
        </div>
        
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id Pengguna</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM data_admin ORDER BY id_pengguna DESC");
                    while($data = mysqli_fetch_array($tampil)) {
                        ?>
                        <tr>

                            <td><?= $data['id_pengguna']; ?></td>
                            <td><?= $data['username']; ?></td>
                            <td><?= $data['password']; ?></td>
                            <td>
                                <a href="tabel_admin.php?hal=edit&id=<?= $data['id_pengguna'] ?>" class="btn btn-warning">Edit</a>
                                <a href="tabel_admin.php?hal=hapus&id=<?= $data['id_pengguna'] ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
                                <a href="index.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Kembali</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
