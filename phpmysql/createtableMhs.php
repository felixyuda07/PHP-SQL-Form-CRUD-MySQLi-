<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "dataMhs";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Buat tabel
$sql = "CREATE TABLE mahasiswa (
    nim VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100),
    tempat_lahir VARCHAR(100),
    tanggal_lahir DATE,
    jurusan VARCHAR(50),
    program_studi VARCHAR(50),
    ipk DECIMAL(3,2)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table participants created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$conn->close();
?>