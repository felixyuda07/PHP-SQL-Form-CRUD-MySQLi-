<?php
include "koneksi1.php";

// Buat database
$sql = "CREATE DATABASE dataMhs";
if ($conn->query($sql) === TRUE) {
    echo "Database created seccessfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>