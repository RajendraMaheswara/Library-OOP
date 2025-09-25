<?php
include "Form.php";

// Koneksi database
$host = "localhost";
$user = "root";      // sesuaikan
$pass = "";          // sesuaikan
$db   = "coffe"; // sesuaikan

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// --- Simpan data jika form disubmit ---
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $harga       = $_POST['harga'];
    $kategori    = $_POST['kategori'];
    $ukuran      = $_POST['ukuran'];
    $topping     = isset($_POST['topping']) ? implode(",", $_POST['topping']) : "";
    $deskripsi   = $_POST['deskripsi'];

    $sql = "INSERT INTO produk_coffee 
            (nama_produk, harga, kategori, ukuran, topping, deskripsi) 
            VALUES ('$nama_produk','$harga','$kategori','$ukuran','$topping','$deskripsi')";
    $koneksi->query($sql);
}

// --- Buat Form ---
$form = new Form("Coffe.php", "Simpan Produk");
$form->addText("nama_produk", "Nama Produk");
$form->addText("harga", "Harga (Rp)");
$form->addSelect("kategori", "Kategori", array(
    "kopi_hitam" => "Kopi Hitam",
    "espresso"   => "Espresso",
    "latte"      => "Latte",
    "cappuccino" => "Cappuccino"
));
$form->addRadio("ukuran", "Ukuran", array(
    "S" => "Small",
    "M" => "Medium",
    "L" => "Large"
));
$form->addCheckbox("topping", "Topping", array(
    "gula"   => "Gula",
    "susu"   => "Susu",
    "coklat" => "Coklat"
));
$form->addTextarea("deskripsi", "Deskripsi Produk");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Produk Coffee</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin-top: 20px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Form Input Produk Coffee</h2>
    <?php $form->displayForm(); ?>

    <h2>Daftar Produk Coffee</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Ukuran</th>
            <th>Topping</th>
            <th>Deskripsi</th>
        </tr>
        <?php
        $result = $koneksi->query("SELECT * FROM produk_coffee ORDER BY id DESC");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['nama_produk']."</td>
                        <td>".$row['harga']."</td>
                        <td>".$row['kategori']."</td>
                        <td>".$row['ukuran']."</td>
                        <td>".$row['topping']."</td>
                        <td>".$row['deskripsi']."</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Belum ada data produk</td></tr>";
        }
        ?>
    </table>
</body>
</html>