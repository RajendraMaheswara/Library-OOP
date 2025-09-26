<?php
    include "config.php";
    include "database.php"; 
    include "Form.php";

    $error = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nama_produk = isset($_POST['nama_produk']) ? trim($_POST['nama_produk']) : "";
        $harga       = isset($_POST['harga']) ? trim($_POST['harga']) : "";
        $kategori    = isset($_POST['kategori']) ? trim($_POST['kategori']) : "";
        $ukuran      = isset($_POST['ukuran']) ? trim($_POST['ukuran']) : "";
        $topping     = isset($_POST['topping']) ? implode(",", $_POST['topping']) : "";
        $deskripsi   = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : "";

        if (empty($nama_produk) || empty($harga) || empty($kategori) || empty($ukuran) || empty($topping)) {
            $error = "Semua field wajib diisi kecuali Deskripsi!";
        } else {
            $sql = "INSERT INTO produk_coffee 
                    (nama_produk, harga, kategori, ukuran, topping, deskripsi) 
                    VALUES ('$nama_produk','$harga','$kategori','$ukuran','$topping','$deskripsi')";
            if (!$koneksi->query($sql)) {
                $error = "Gagal menyimpan data: " . $koneksi->error;
            }
        }
    }

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
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 20px; }
        h2 { margin-top: 30px; }
        .error { color: red; font-weight: bold; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Form Input Produk Coffee</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= $error; ?></div>
    <?php endif; ?>

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
        $result = $koneksi->query("SELECT * FROM produk_coffee ORDER BY id ASC");
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
            echo "<tr><td colspan='7' align='center'>Belum ada data produk</td></tr>";
        }
        ?>
    </table>
</body>
</html>
