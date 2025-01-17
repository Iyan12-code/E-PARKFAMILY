<?php
include "config/koneksi.php";

if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];
    $query = mysqli_query($con, "SELECT * FROM tb_daftar_parkir WHERE kode='$kode'");
    $data = mysqli_fetch_array($query);
}

if (isset($_POST['btn_update'])) {
    $plat_nomor = $_POST['plat_nomor'];
    $merk = $_POST['merk'];
    $jenis = $_POST['jenis'];

    $sql = "UPDATE tb_daftar_parkir SET plat_nomor='$plat_nomor', merk='$merk', jenis='$jenis' WHERE kode='$kode'";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Data updated successfully'); window.location.href='home.php';</script>";
    } else {
        echo "<script>alert('Error updating data'); window.location.href='home.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Data</title>
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4 bg-success">
        <h2>Edit Data Kendaraan</h2>
        <form method="POST">
            <div class="form-group">
                <label>Plat Nomor</label>
                <input type="text" class="form-control" name="plat_nomor" value="<?php echo $data['plat_nomor']; ?>" required>
            </div>
            <div class="form-group">
                <label>Merk Kendaraan</label>
                <input type="text" class="form-control" name="merk" value="<?php echo $data['merk']; ?>" required>
            </div>
            <div class="form-group">
                <label>Jenis Kendaraan</label>
                <select class="form-control" name="jenis" required>
                    <option value="Motor" <?php if($data['jenis'] == 'Motor') echo 'selected'; ?>>Motor</option>
                    <option value="Mobil" <?php if($data['jenis'] == 'Mobil') echo 'selected'; ?>>Mobil</option>
                    <option value="Truk/Bus/Lainnya" <?php if($data['jenis'] == 'Truk/Bus/Lainnya') echo 'selected'; ?>>Truk/Bus/Lainnya</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="btn_update">Simpan</button>
            <a href="home.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
