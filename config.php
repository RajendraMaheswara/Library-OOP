<?php
// Konfigurasi
$host = "localhost";
$user = "root";        // sesuaikan
$pass = "";            // sesuaikan
$db   = "coffee";   // nama database

// Koneksi awal tanpa pilih DB dulu
$koneksi = new mysqli($host, $user, $pass);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Buat database jika belum ada
$sql = "CREATE DATABASE IF NOT EXISTS $db";
if ($koneksi->query($sql) !== TRUE) {
    die("Error membuat database: " . $koneksi->error);
}

// Pilih database
$koneksi->select_db($db);
?>
