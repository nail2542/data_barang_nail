<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Formulir Peminjaman Barang</title>
</head>
<body>
    <h2>Tambah Data</h2>
	<style>
		body {
			background-color: yellow;
		}
	</style>
    <form action="tambah2.php" method="post">

		<div class="container" style="text-align: center;">
        <label for="id_barang" class="form-label">Id:</label><br>
        <input type="text" class="form-control" style="text-align: center;" id="id" name="id" required><br><br>
		</div>

		<div class="container" style="text-align: center;">
		<label for="nama_barang" class="form-label">Nama Barang:</label><br>
        <input type="text" id="nama_barang" class="form-control" style="text-align: center;" name="nama_barang" required><br><br>
		</div>

		<div class="container" style="text-align: center;">
		<label for="keadaan_barang" class="form-label">Keadaan Barang:</label><br>
        <input type="text" id="keadaan_barang" class="form-control" style="text-align: center;" name="keadaan_barang" required><br><br>
		</div>

		<div class="container" style="text-align: center;">
		<label for="jumlah_barang" class="form-label">Jumlah Barang:</label><br>
        <input type="text" id="tanggal_kembali" class="form-control" style="text-align: center;" name="jumlah_barang" required><br><br>
		</div>

        <input type="submit" value="Tambah Data" class="btn btn-primary" style="margin-left: 75vh; width: 60vh;">
		<br>
		<br>
		<a class="btn btn-primary" href="barang.php" style="margin-left: 75vh; width: 60vh;">Kembali</a>
    </form>

	<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "peminjaman_barang");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Tangani permintaan POST dari formulir peminjaman
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $id = $_POST['id'];
	$nama_barang = $_POST['nama_barang'];
	$keadaan_barang = $_POST['keadaan_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];

    // Lakukan sanitasi input untuk mencegah serangan SQL Injection
    $id = mysqli_real_escape_string($koneksi, $id);
	$nama_barang = mysqli_real_escape_string($koneksi, $nama_barang);
	$keadaan_barang = mysqli_real_escape_string($koneksi, $keadaan_barang);
    $jumlah_barang = mysqli_real_escape_string($koneksi, $jumlah_barang);

    // Buat query untuk menyimpan data peminjaman ke dalam database
    $query = "INSERT INTO barang (id, nama_barang, keadaan_barang, jumlah_barang) 
              VALUES ('$id', '$nama_barang', '$keadaan_barang', '$jumlah_barang')";

    // Eksekusi query
    if(mysqli_query($koneksi, $query)) {
        echo "Peminjaman barang berhasil.";
    } else {
        echo "ERROR: Tidak bisa mengeksekusi query: $query. " . mysqli_error($koneksi);
    }
}

// Tutup koneksi
mysqli_close($koneksi);
?>

</body>
</html>
