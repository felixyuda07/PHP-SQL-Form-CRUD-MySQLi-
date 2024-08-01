<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "dboo";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek Koneksi
if ($conn->connect_error) {
    die("koneksi gagal: " . $conn->connect_error);
}
echo "koneksi berhasil<br>";

// Menyiapkan sql untuk memasukan data
$sql = "INSERT INTO participants (nama, email) VALUES ('Faisal',
'faisal@gmail.com'),  ('Tata', 'tata@gmail.com')";

// Mengessekusi query
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>