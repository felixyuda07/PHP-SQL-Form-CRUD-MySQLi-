<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "dbpro";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek Koneksi
if ($conn->connect_error) {
    die("koneksi gagal: " . $conn->connect_error);
}

// Menyiapkan sql untuk memasukan data
$sql = "INSERT INTO participants (nama, email) VALUES ('Faisal',
'faisal@gmail.com'),  ('Tata', 'tata@gmail.com')";

// Mengeksekusi query
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Menutup koneksi
mysqli_close($conn);
?>