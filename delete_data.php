<?php
include "config/koneksi.php"; // File koneksi database

if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];

    // Cegah SQL Injection
    $kode = mysqli_real_escape_string($con, $kode);

    // Periksa apakah data dengan kode tersebut ada di database
    $checkQuery = "SELECT * FROM tb_daftar_parkir WHERE kode = '$kode'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Hapus data jika ditemukan
        $deleteQuery = "DELETE FROM tb_daftar_parkir WHERE kode = '$kode'";
        if (mysqli_query($con, $deleteQuery)) {
            echo "<script>alert('Data berhasil dihapus!'); window.location.href='home.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data!'); window.location.href='home.php';</script>";
        }
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='home.php';</script>";
    }
} else {
    echo "<script>alert('Parameter kode tidak ditemukan!'); window.location.href='home.php';</script>";
}
?>
