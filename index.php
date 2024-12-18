<?php

include "user_header.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran Boas</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php

    include "koneksi.php";

    $makanan = "SELECT tb_produk.id_produk AS PRODUK, nama_produk, satuan_produk, harga_produk, deskripsi_produk, gambar_produk, tb_produk.id_kategori, nama_kategori FROM tb_produk INNER JOIN tb_kategori ON tb_produk.id_kategori = tb_kategori.id_kategori WHERE tb_produk.id_kategori = 1";
    $makananresult = mysqli_query($koneksi, $makanan);

    $produk = "<h1>Makanan</h1>";
    $produk .= "<div class='area-produk'>";
    while ($row1 = mysqli_fetch_assoc($makananresult)) {
        $produk .= '<a href="detail-produk.php?id=' . $row1["PRODUK"] . '">';
        $produk .= "<div class='makanan'>";
        $produk .= '<img src=  "image/' . $row1["gambar_produk"] . '" alt="' . $row1["nama_produk"] . '">';
        $produk .= "<br>";
        $produk .= "<p>" . $row1["nama_produk"] . "</p>";
        $produk .= "<p>Rp. " . $row1["harga_produk"] . "</p>";
        $produk .= "</div>";
        $produk .= '</a>';
    }
        $produk .= "</div>";

        echo $produk;

        $minuman = "SELECT tb_produk.id_produk AS PRODUK, nama_produk, satuan_produk, harga_produk, deskripsi_produk, gambar_produk, tb_produk.id_kategori, nama_kategori FROM tb_produk INNER JOIN tb_kategori ON tb_produk.id_kategori = tb_kategori.id_kategori WHERE tb_produk.id_kategori = 2";
        $minumanresult = mysqli_query($koneksi, $minuman);

        $produk = "<h1>Minuman</h1>";
        $produk .= "<div class='area-produk'>";
        while ($row2 = mysqli_fetch_assoc($minumanresult)) {
            $produk .= '<a href="detail-produk.php?id=' . $row2["PRODUK"] . '">';
            $produk .= "<div class='makanan'>";
            $produk .= '<img src="image/' . $row2["gambar_produk"] . '"alt="' . $row2["nama_produk"] . '">';
            $produk .= "<br>";
            $produk .= "<p>" . $row2["nama_produk"] . "</p>";
            $produk .= "<p>Rp. " . $row2["harga_produk"] . "</p>";
            $produk .= "</div>";
            $produk .= '</a>';
        }
        $produk .= "</div>";

        echo $produk;

        ?>
    
</body>
</html>