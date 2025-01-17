<?php 

// Get the 'kode' from the POST request
$kode = $_POST['kode'];

// Include database connection
include 'koneksi.php';

// Set the time zone for Jakarta
date_default_timezone_set("Asia/Jakarta");

// Query to get the entry time and vehicle type from the database
$query = mysqli_query($con, "SELECT hitung_jam_masuk, jenis FROM tb_daftar_parkir WHERE kode = '$kode'");
$data = mysqli_fetch_array($query);

// Get the entry time (jam_masuk) and current time (jam_keluar)
$jam_masuk = $data['hitung_jam_masuk'];
$jam_keluar = date('H');  // Get current hour

// Calculate the parking duration (lama) in hours
if ($jam_keluar == $jam_masuk) {
    $lama = 1;  // If the current hour is equal to entry hour, assume 1 hour
} else if ($jam_keluar > $jam_masuk) {
    $lama = $jam_keluar - $jam_masuk;  // Normal case: current hour is greater than entry hour
} else {
    $jam_keluar = $jam_keluar + 24;  // If it's past midnight, adjust the hour
    $lama = $jam_keluar - $jam_masuk;
}

// Calculate the total fee based on vehicle type
if ($data['jenis'] == "Motor") {
    $hasil = 1000 * $lama;  // Motor: 1000 per hour
} elseif ($data['jenis'] == "Mobil") {
    $hasil = 2000 * $lama;  // Mobil: 2000 per hour
} elseif ($data['jenis'] == "Truk/Bus/Lainnya") {
    $hasil = 3000 * $lama;  // Truk/Bus/Lainnya: 3000 per hour
}

// Output the total parking fee as the response
echo "$hasil"; // Send the calculated total back to the frontend

?>
