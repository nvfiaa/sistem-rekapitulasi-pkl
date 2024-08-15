<?php
// File: Koneksi.php

// Konfigurasi koneksi database
$host = 'localhost';
$user = 'root'; // Sesuaikan dengan username MySQL Anda
$pass = ''; // Sesuaikan dengan password MySQL Anda, biarkan kosong jika tidak ada password
$db = 'pkl'; // Sesuaikan dengan nama database Anda

// Membuat koneksi ke database MySQL
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
