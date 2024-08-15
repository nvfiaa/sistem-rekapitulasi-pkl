<?php
include 'Koneksi.php';

// Tombol simpan (Insert / Update)
if(isset($_POST['btnsimpan'])) {
    $id_pengguna = mysqli_real_escape_string($koneksi, $_POST['btnid_pengguna']);
    $kode_kegiatan = mysqli_real_escape_string($koneksi, $_POST['btnkode_kegiatan']);
    $kegiatan = mysqli_real_escape_string($koneksi, $_POST['btnkegiatan']);
    $jumlah_pembayaran = mysqli_real_escape_string($koneksi, $_POST['btnjumlah_pembayaran']);

    if ($_GET['hal'] == "edit") {
        // Query UPDATE jika data akan diedit
        $edit = mysqli_query($koneksi, "UPDATE daftar_rab SET
                                        id_pengguna = '$id_pengguna',
                                        kode_kegiatan = '$kode_kegiatan',
                                        kegiatan = '$kegiatan',
                                        jumlah_pembayaran = '$jumlah_pembayaran'
                                        WHERE id_pengguna = '$_GET[id]'");

        if($edit) {
            echo "<script>
                    alert('Edit Data Sukses!');
                    document.location= 'tabel_rab.php';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Edit Data Gagal!');
                    document.location= 'tabel_rab.php?hal=edit&id=$_GET[id]';
                  </script>";
            exit;
        }
    } else {
        // Query INSERT jika data baru akan disimpan
        $simpan = mysqli_query($koneksi, "INSERT INTO daftar_rab (id_pengguna, kode_kegiatan, kegiatan, jumlah_pembayaran)
                                         VALUES ('$id_pengguna', '$kode_kegiatan', '$kegiatan', '$jumlah_pembayaran')");

        if($simpan) {
            echo "<script>
                    alert('Simpan Data Sukses!');
                    document.location= 'tabel_rab.php';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Simpan Data Gagal!');
                    document.location= 'tabel_rab.php';
                  </script>";
            exit;
        }
    }
}

// Uji tombol hapus
if(isset($_GET['hal']) && $_GET['hal'] == "hapus" && isset($_GET['id'])) {
    $hapus = mysqli_query($koneksi, "DELETE FROM daftar_rab WHERE id_pengguna = '$_GET[id]'");

    if ($hapus) {
        echo "<script>
                alert('Data Telah Dihapus!');
                document.location= 'tabel_rab.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location= 'tabel_rab.php';
              </script>";
        exit;
    }
}

// Tampilkan data untuk form edit
$vid_pengguna = $vkode_kegiatan = $vkegiatan = $jumlah_pembayaran = '';
if(isset($_GET['hal']) && $_GET['hal'] == "edit" && isset($_GET['id'])) {
    $tampil = mysqli_query($koneksi, "SELECT * FROM daftar_rab WHERE id_pengguna = '$_GET[id]'");
    $data = mysqli_fetch_array($tampil);
    if($data) {
        $vid_pengguna = $data['id_pengguna'];
        $vkode_kegiatan = $data['kode_kegiatan'];
        $vkegiatan = $data['kegiatan'];
        $vjumlah_pembayaran = $data['jumlah_pembayaran'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Rancangan Anggaran Biaya</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2 class="text-center">Rancangan Anggaran biaya</h2>

    <!-- Form untuk input/edit data -->
    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            Input Rab
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="id_pengguna">id_pengguna</label>
                    <input type="text" name="btnid_pengguna" value="<?= $vid_pengguna ?>" class="form-control" placeholder="id_pengguna" required>
                </div>
                <div class="form-group">
                    <label for="kode_kegiatan">kode_kegiatan</label>
                    <input type="text" name="btnkode_kegiatan" value="<?= $vkode_kegiatan ?>" class="form-control" placeholder="kode_kegiatan" required>
                </div>
                <div class="form-group">
                    <label for="kegiatan">kegiatan</label>
                    <input type="text" name="btnkegiatan" value="<?= $vkegiatan ?>" class="form-control" placeholder="kegiatan" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_pembayaran">jumlah_pembayaran</label>
                    <input type="text" name="btnjumlah_pembayaran" value="<?= $vjumlah_pembayaran ?>" class="form-control" placeholder="jumlah_pembayaran" required>
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
            Daftar Rab
        </div>
        
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id Pengguna</th>
                        <th>Kode_kegiatan</th>
                        <th>kegiatan</th>
                        <th>Jumlah bayar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM daftar_rab ORDER BY id_pengguna DESC");
                    while($data = mysqli_fetch_array($tampil)) {
                        ?>
                        <tr>

                            <td><?= $data['id_pengguna']; ?></td>
                            <td><?= $data['kode_kegiatan']; ?></td>
                            <td><?= $data['kegiatan']; ?></td>
                            <td><?= $data['jumlah_pembayaran']; ?></td>
                            <td>
                                <a href="tabel_rab.php?hal=edit&id=<?= $data['id_pengguna'] ?>" class="btn btn-warning">Edit</a>
                                <a href="tabel_rab.php?hal=hapus&id=<?= $data['id_pengguna'] ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
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
