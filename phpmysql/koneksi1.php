<?php
$servername = "localhost";
$username   = "root";
$password   = "";

// membuat koneksi
$conn = new mysqli($servername, $username, $password);

// cek koneksi
if ($conn -> connect_error) {
    die("koneksi gagal: ". $conn-> connect_error);
}
echo "koneksi berhasil"
?>