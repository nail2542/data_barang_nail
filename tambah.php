<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Document</title>
</head>
</html>
<body>
	
</body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Form tambah barang</title>
</head>
<body>
    <h2>Tambah Data</h2>

    <form action="tambah.php" method="post">

		<div class="container" style="text-align: center;">
        <label for="id" class="form-label">Id:</label><br>
        <input type="text" class="form-control" style="text-align: center;" id="id" name="id" required><br><br>
		</div>
		<div class="container" style="text-align: center;">
		<label for="nama_peminjam" class="form-label">Nama Peminjam:</label><br>
        <input type="text" id="nama_peminjam" class="form-control" style="text-align: center;" name="nama_peminjam" required><br><br>
		</div>

		<div class="container" style="text-align: center;">
		<label for="barang_dipinjam" class="form-label">Barang Dipinjam:</label><br>
        <input type="text" id="barang_dipinjam" class="form-control" style="text-align: center;" name="barang_dipinjam" required><br><br>
		</div>

		<div class="container" style="text-align: center">
        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam:</label><br>
        <input type="date" id="tanggal_pinjam" class="form-control" style="text-align: center;" name="tanggal_pinjam" required><br><br>
		</div>

		<div class="container" style="text-align: center;">
		<label for="tanggal_kembali" class="form-label">Tanggal Kembali:</label><br>
        <input type="date" id="tanggal_kembali" class="form-control" style="text-align: center;" name="tanggal_kembali" required><br><br>
		</div>

        <input type="submit" value="Tambah Data" class="btn btn-primary" style="margin-left: 75vh; width: 60vh;">
		<br>
		<br>
		<a class="btn btn-primary" href="peminjaman.php" style="margin-left: 75vh; width: 60vh;">Kembali</a>
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
	$nama_peminjam = $_POST['nama_peminjam'];
	$barang_dipinjam = $_POST['barang_dipinjam'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
	$tanggal_kembali = $_POST['tanggal_kembali'];

    // Lakukan sanitasi input untuk mencegah serangan SQL Injection
    $id = mysqli_real_escape_string($koneksi, $id);
	$nama_peminjam = mysqli_real_escape_string($koneksi, $nama_peminjam);
	$barang_dipinjam = mysqli_real_escape_string($koneksi, $barang_dipinjam);
    $tanggal_pinjam = mysqli_real_escape_string($koneksi, $tanggal_pinjam);
	$tanggal_kembali = mysqli_real_escape_string($koneksi, $tanggal_kembali);

    // Buat query untuk menyimpan data peminjaman ke dalam database
    $query = "INSERT INTO peminjaman (id, nama_peminjam, barang_dipinjam, tanggal_pinjam, tanggal_kembali) 
              VALUES ('$id', '$nama_peminjam', '$barang_dipinjam', '$tanggal_pinjam', '$tanggal_kembali')";

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