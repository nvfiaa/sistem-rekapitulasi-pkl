<?php
include 'Koneksi.php';

// Tombol simpan (Insert / Update)
if(isset($_POST['btnsimpan'])) {
    $id_pengguna = mysqli_real_escape_string($koneksi, $_POST['btnid_pengguna']);
    $kode_kegiatan = mysqli_real_escape_string($koneksi, $_POST['btnkode_kegiatan']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['btnjabatan']);
    $tujuan = mysqli_real_escape_string($koneksi, $_POST['btntujuan']);
    $tanggal_kegiatan = mysqli_real_escape_string($koneksi, $_POST['btntanggal_kegiatan']);
    $lama_perjalanan = mysqli_real_escape_string($koneksi, $_POST['btnlama_perjalanan']);
    $jumlah_bayar = mysqli_real_escape_string($koneksi, $_POST['btnjumlah_bayar']);

    if ($_GET['hal'] == "edit") {
        // Query UPDATE jika data akan diedit
        $edit = mysqli_query($koneksi, "UPDATE dinas_luar SET
                                        id_pengguna = '$id_pengguna',
                                        kode_kegiatan = '$kode_kegiatan',
                                        jabatan = '$jabatan',
                                        tujuan = '$tujuan',
                                        tanggal_kegiatan = '$tanggal_kegiatan',
                                        lama_perjalanan = '$lama_perjalanan',
                                        jumlah_bayar = '$jumlah_bayar'
                                        WHERE id_pengguna = '$_GET[id]'");

        if($edit) {
            echo "<script>
                    alert('Edit Data Sukses!');
                    document.location= 'perjalanan_dinas.php';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Edit Data Gagal!');
                    document.location= 'perjalanan_dinas.php?hal=edit&id=$_GET[id]';
                  </script>";
            exit;
        }
    } else {
        // Query INSERT jika data baru akan disimpan
        $simpan = mysqli_query($koneksi, "INSERT INTO dinas_luar (id_pengguna, kode_kegiatan, jabatan, tujuan, tanggal_kegiatan, lama_perjalanan, jumlah_bayar)
                                         VALUES ('$id_pengguna', '$kode_kegiatan', '$jabatan', '$tujuan', '$tanggal_kegiatan', '$lama_perjalanan', '$jumlah_bayar')");

        if($simpan) {
            echo "<script>
                    alert('Simpan Data Sukses!');
                    document.location= 'perjalanan_dinas.php';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Simpan Data Gagal!');
                    document.location= 'perjalanan_dinas.php';
                  </script>";
            exit;
        }
    }
}

// Uji tombol hapus
if(isset($_GET['hal']) && $_GET['hal'] == "hapus" && isset($_GET['id'])) {
    $hapus = mysqli_query($koneksi, "DELETE FROM dinas_luar WHERE id_pengguna = '$_GET[id]'");

    if ($hapus) {
        echo "<script>
                alert('Data Telah Dihapus!');
                document.location= 'perjalanan_dinas.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location= 'perjalanan_dinas.php';
              </script>";
        exit;
    }
}

// Tampilkan data untuk form edit
$vkode_kegiatan = $vjabatan = $vtujuan = $vtanggal_kegiatan = $vlama_perjalanan = $vjumlah_bayar = '';
if(isset($_GET['hal']) && $_GET['hal'] == "edit" && isset($_GET['id'])) {
    $tampil = mysqli_query($koneksi, "SELECT * FROM dinas_luar WHERE id_pengguna = '$_GET[id]'");
    $data = mysqli_fetch_array($tampil);
    if($data) {
        $vid_pengguna = $data['id_pengguna'];
        $vkode_kegiatan = $data['kode_kegiatan'];
        $vjabatan = $data['jabatan'];
        $vtujuan = $data['tujuan'];
        $vtanggal_kegiatan = $data['tanggal_kegiatan'];
        $vlama_perjalanan = $data['lama_perjalanan'];
        $vjumlah_bayar = $data['jumlah_bayar'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perjalan Dinas Luar</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2 class="text-center">KEMENKUMHAM</h2>

    <!-- Form untuk input/edit data -->
    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            Input Perjalan Dinas
        </div>
        <div class="card-body">
            <form action="" method="post">

            <div class="form-group">
                    <label for="id_pengguna">Id Pengguna</label>
                    <input type="text" name="btnid_pengguna" value="<?= $vlama_perjalanan ?>" class="form-control" placeholder="id_pengguna" required>
                </div>
                <div class="form-group">
                    <label for="kode_kegiatan">Kode kegiatan</label>
                    <input type="text" name="btnkode_kegiatan" value="<?= $vkode_kegiatan ?>" class="form-control" placeholder="kode_kegiatan" required>
                </div>
                <div class="form-group">
                    <label for="jabatan">jabatan</label>
                    <input type="text" name="btnjabatan" value="<?= $vjabatan ?>" class="form-control" placeholder="jabatan" required>
                </div>
                <div class="form-group">
                    <label for="tujuan">tujuan</label>
                    <input type="text" name="btntujuan" value="<?= $vtujuan ?>" class="form-control" placeholder="tujuan" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                    <input type="date" name="btntanggal_kegiatan" value="<?= $vtanggal_kegiatan ?>" class="form-control" placeholder="tanggal_kegiatan" required>
                </div>
                <div class="form-group">
                    <label for="lama_perjalanan">lama_perjalanan</label>
                    <input type="text" name="btnlama_perjalanan" value="<?= $vlama_perjalanan ?>" class="form-control" placeholder="lama_perjalanan" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_bayar">Jumlah Bayar</label>
                    <input type="text" name="btnjumlah_bayar" value="<?= $vjumlah_bayar ?>" class="form-control" placeholder="jumlah_bayar" required>
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
            Daftar Perjalanan Dinas Luar
        </div>
        
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id Pengguna</th>
                        <th>Kode Kegiatan</th>
                        <th>jabatan</th>
                        <th>Tujuan</th>
                        <th>Tanggal Kegiatan</th>
                        <th>lama_perjalanan</th>
                        <th>Jumlah Bayar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM dinas_luar ORDER BY id_pengguna   DESC");
                    while($data = mysqli_fetch_array($tampil)) {
                        ?>
                        <tr>
                            <td><?= $data['id_pengguna']; ?></td>
                            <td><?= $data['kode_kegiatan']; ?></td>
                            <td><?= $data['jabatan']; ?></td>
                            <td><?= $data['tujuan']; ?></td>
                            <td><?= $data['tanggal_kegiatan']; ?></td>
                            <td><?= $data['lama_perjalanan']; ?></td>
                            <td><?= $data['jumlah_bayar']; ?></td>
                            
                            <td>
                                <a href="perjalanan_dinas.php?hal=edit&id=<?= $data['id_pengguna'] ?>" class="btn btn-warning">Edit</a>
                                <a href="perjalanan_dinas.php?hal=hapus&id=<?= $data['id_pengguna'] ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
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

