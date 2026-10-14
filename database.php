<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'db_laporan_fasilitas';

    $conn = mysqli_connect($host, $user, $password, $db);

    if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>