<?php
include 'Koneksi.php'; // Pastikan file ini berisi koneksi ke database dengan variabel $koneksi

// Button save (Insert / Update)
if (isset($_POST['btnsimpan'])) {
    $id_pengguna = mysqli_real_escape_string($koneksi, $_POST['btnid_pengguna']);
    $no_surat = mysqli_real_escape_string($koneksi, $_POST['btnno_surat']);
    $kode_kegiatan = mysqli_real_escape_string($koneksi, $_POST['btnkode_kegiatan']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['btntanggal']);
    $kepada = mysqli_real_escape_string($koneksi, $_POST['btnkepada']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['btnketerangan']);
    $jumlah_bayar = mysqli_real_escape_string($koneksi, $_POST['btnjumlah_bayar']);

  // Process file upload if there is a file uploaded
  $path_file = '';
  if ($_FILES['btnupload']['size'] > 0) {
      $nama_file = $_FILES['btnupload']['name'];
      $tmp_file = $_FILES['btnupload']['tmp_name'];
      $upload_dir = 'uploads/';
      $path_file = $upload_dir . basename($nama_file);

      // Move file to uploads directory
      if (!move_uploaded_file($tmp_file, $path_file)) {
          echo "<script>
                  alert('Upload File Gagal!');
                  document.location= 'tabel_transaksicrud.php?hal=edit&no_surat=$_GET[no_surat]';
                </script>";
          exit;
      }
  } else if (isset($_POST['existing_upload'])) {
      $path_file = $_POST['existing_upload'];
  }
  if ($_GET['hal'] == "edit") {
    // Query UPDATE
    $query = "UPDATE tabel_transaksi SET
                id_pengguna = '$id_pengguna',
                kode_kegiatan = '$kode_kegiatan',
                tanggal = '$tanggal',
                kepada = '$kepada',
                keterangan = '$keterangan',
                jumlah_bayar = '$jumlah_bayar',
                upload = '$path_file'
              WHERE no_surat = '$_GET[id]'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
                alert('Edit Data Sukses!');
                document.location= 'tabel_transaksicrud.php';
              </script>";
    } else {
        echo "<script>
                alert('Edit Data Gagal!');
                document.location= 'tabel_transaksicrud.php?hal=edit&no_surat=$_GET[no_surat]';
              </script>";
    }
} else {
    // Query INSERT
    $query = "INSERT INTO tabel_transaksi (id_pengguna, no_surat, kode_kegiatan, tanggal, kepada, keterangan, jumlah_bayar, upload)
              VALUES ('$id_pengguna', '$no_surat', '$kode_kegiatan', '$tanggal', '$kepada', '$keterangan', '$jumlah_bayar', '$path_file')";

    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo "<script>
                alert('Simpan Data Sukses!');
                document.location= 'tabel_transaksicrud.php';
              </script>";
    } else {
        echo "<script>
                alert('Simpan Data Gagal!');
                document.location= 'tabel_transaksicrud.php';
              </script>";
    }
}
}
// Button delete
if (isset($_GET['hal']) && $_GET['hal'] == "hapus") {
    $no_surat = mysqli_real_escape_string($koneksi, $_GET['no_surat']);

    // Query DELETE
    $query = "DELETE FROM tabel_transaksi WHERE no_surat = '$no_surat'";
    
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
                alert('Hapus Data Sukses!');
                document.location= 'tabel_transaksicrud.php';
              </script>";
    } else {
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location= 'tabel_transaksicrud.php';
              </script>";
    }
}
// Display data for form edit
$vid_pengguna = $vno_surat = $vkode_kegiatan = $vtanggal = $vkepada = $vketerangan = $vjumlah_bayar = '';
if (isset($_GET['hal']) && $_GET['hal'] == "edit" && isset($_GET['no_surat'])) {
    $query = "SELECT * FROM tabel_transaksi WHERE no_surat = '$_GET[no_surat]'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
    if ($data) {
        $vid_pengguna = $data['id_pengguna'];
        $vno_surat = $data['no_surat'];
        $vkode_kegiatan = $data['kode_kegiatan'];
        $vtanggal = $data['tanggal'];
        $vkepada = $data['kepada'];
        $vketerangan = $data['keterangan'];
        $vjumlah_bayar = $data['jumlah_bayar'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Kwitansi</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2 class="text-center">CRUD Transaksi</h2>

 <!-- Form for input/edit data -->
 <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            Data Transaksi Kemenkumham
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="id_pengguna">Id Pengguna</label>
                    <input type="text" name="btnid_pengguna" value="<?= $vid_pengguna ?>" class="form-control" placeholder="id_pengguna" required>
                </div>
                <div class="form-group">
                    <label for="no_surat">No Surat</label>
                    <input type="text" name="btnno_surat" value="<?= $vno_surat ?>" class="form-control" placeholder="no_surat" required>
                </div>
                <div class="form-group">
                    <label for="kode_kegiatan">Kode Kegiatan</label>
                    <input type="text" name="btnkode_kegiatan" value="<?= $vkode_kegiatan ?>" class="form-control" placeholder="kode_kegiatan" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="btntanggal" value="<?= $vtanggal ?>" class="form-control" placeholder="Tanggal" required>
                </div>
                <div class="form-group">
                    <label for="kepada">Kepada</label>
                    <input type="text" name="btnkepada" value="<?= $vkepada ?>" class="form-control" placeholder="Kepada" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" name="btnketerangan" value="<?= $vketerangan ?>" class="form-control" placeholder="Keterangan" required>
                    </div>
                <div class="form-group">
                    <label for="jumlah_bayar">Jumlah Bayar</label>
                    <input type="text" name="btnjumlah_bayar" value="<?= $vjumlah_bayar ?>" class="form-control" placeholder="jumlah_bayar" required>
                </div>
                <div class="form-group">
                    <label for="upload">Upload Gambar</label>
                    <input type="file" name="btnupload" class="form-control-file">
                    <?php if(isset($_GET['hal']) && $_GET['hal'] == "edit" && !empty($data['upload'])): ?>
                        <input type="hidden" name="existing_upload" value="<?= $data['upload'] ?>">
                        <p>Current file: <a href="<?= $data['upload'] ?>" target="_blank"><?= basename($data['upload']) ?></a></p>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-success" name="btnsimpan">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
                <a href="index.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Kembali</a>
            </form>
        </div>
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
</body>
</html>