<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Data barang</title>

	
</head>
<body>
	
</body>
</html>

<?php
// Database connection parameters
$servername = "localhost"; // Change this to your server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "peminjaman_barang"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID parameter is set and not empty
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Escape user inputs for security
    $id = $conn->real_escape_string($_GET['id']);

    // SQL to delete record
    $sql = "DELETE FROM peminjaman WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "ID parameter is missing or empty.";
	echo "<br>";
	echo "<a class='btn btn-primary' href='peminjaman.php'>Kembali</a>";
}

// Close connection
$conn->close();
?>
