<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "coffee";
    $koneksi = new mysqli($host, $user, $pass);

    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }
    $sql = "CREATE DATABASE IF NOT EXISTS $db";
    if ($koneksi->query($sql) !== TRUE) {
        die("Error membuat database: " . $koneksi->error);
    }

    $koneksi->select_db($db);
?>
