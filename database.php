<?php
include "config.php";

// Buat tabel jika belum ada
$sql = "CREATE TABLE IF NOT EXISTS produk_coffee (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    kategori VARCHAR(50),
    ukuran VARCHAR(10),
    topping VARCHAR(255),
    deskripsi TEXT
)";

if ($koneksi->query($sql) !== TRUE) {
    echo "Error membuat tabel: " . $koneksi->error;
}
?>
