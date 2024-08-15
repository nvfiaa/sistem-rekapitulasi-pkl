<?php
include 'Koneksi.php'; // Pastikan file ini berisi koneksi ke database dengan variabel $koneksi

// Tombol simpan (Insert / Update)
if (isset($_POST['btnsimpan'])) {
    $nomor = mysqli_real_escape_string($koneksi, $_POST['btnnomor']);
    $id_surat = mysqli_real_escape_string($koneksi, $_POST['btnid_surat']);
    $id_kegiatan = mysqli_real_escape_string($koneksi, $_POST['btnid_kegiatan']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['btntanggal']);
    $kepada = mysqli_real_escape_string($koneksi, $_POST['btnkepada']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['btnketerangan']);
    $jumlah_bayar = mysqli_real_escape_string($koneksi, $_POST['btnjumlah']);
    $username = mysqli_real_escape_string($koneksi, $_POST['btnusername']);

    // Proses upload file gambar jika ada file yang di-upload
    $path_file = '';
    if ($_FILES['btnupload']['size'] > 0) {
        $nama_file = $_FILES['btnupload']['name'];
        $tmp_file = $_FILES['btnupload']['tmp_name'];
        $upload_dir = 'uploads/';
        $path_file = $upload_dir . basename($nama_file);

        // Pindahkan file ke direktori uploads
        if (!move_uploaded_file($tmp_file, $path_file)) {
            echo "<script>
                    alert('Upload File Gagal!');
                    document.location= 'tabel_transaksicrud.php?hal=edit&id=$_GET[id]';
                  </script>";
            exit;
        }
    }

    if ($_GET['hal'] == "edit") {
        // Query UPDATE
        $query = "UPDATE input_kwitansi SET
                    nomor = '$nomor',
                    id_surat = '$id_surat',
                    id_kegiatan = '$id_kegiatan',
                    tanggal = '$tanggal',
                    kepada = '$kepada',
                    keterangan = '$keterangan',
                    jumlah_bayar = '$jumlah_bayar',
                    username = '$username'
                    upload = '$path_file',
                  WHERE nomor = '$_GET[id]'";

        $result = mysqli_query($koneksi, $query);

        if ($result) {
            echo "<script>
                    alert('Edit Data Sukses!');
                    document.location= 'tabel_transaksicrud.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Edit Data Gagal!');
                    document.location= 'tabel_transaksicrud.php?hal=edit&id=$_GET[id]';
                  </script>";
        }
    } else {
        // Query INSERT
        $query = "INSERT INTO input_kwitansi (nomor, id_surat, id_kegiatan, tanggal, kepada, keterangan, jumlah_bayar,  username, upload,)
                  VALUES ('$nomor', '$id_surat','$id_kegiatan', '$tanggal', '$kepada', '$keterangan', '$jumlah_bayar', '$username', '$path_file' )";

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

// Uji tombol hapus
if (isset($_GET['hal']) && $_GET['hal'] == "hapus" && isset($_GET['id'])) {
    $query = "DELETE FROM input_kwitansi WHERE nomor = '$_GET[id]'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
                alert('Data Telah Dihapus!');
                document.location= 'tabel_transaksicrud.php';
              </script>";
    } else {
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location= 'tabel_transaksicrud.php';
              </script>";
    }
}

// Tampilkan data untuk form edit
$vnomor = $vid = $vtanggal = $vkepada = $vketerangan = $vjumlah = $vusername = '';
if (isset($_GET['hal']) && $_GET['hal'] == "edit" && isset($_GET['id'])) {
    $query = "SELECT * FROM input_kwitansi WHERE nomor = '$_GET[id]'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
    if ($data) {
        $vnomor = $data['nomor'];
        $vid_surat = $data['id_surat'];
        $vid_kegiatan = $data['id_kegiatan'];
        $vtanggal = $data['tanggal'];
        $vkepada = $data['kepada'];
        $vketerangan = $data['keterangan'];
        $vjumlah = $data['jumlah_bayar'];
        $vusername = $data['username'];
    }
}
?>