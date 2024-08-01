<?php
include "koneksi2.php";

// Membuat database
$sql = "CREATE DATABASE dbpro";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
