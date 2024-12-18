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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produk = $_POST["id_produk"];
    $jumlah_beli = $_POST["jumlah_beli"];
    $id_session = $_SESSION["id_session"];

    if ($jumlah_beli > 0) {
        $queryinsert = "INSERT INTO tb_keranjang (id_session, id_produk, jumlah_beli) VALUES ('$id_session','$id_produk', '$jumlah_beli')";
        $resultinsert = mysqli_query($koneksi, $queryinsert);

        echo "<script>alert('Produk berhasil dimasukkan ke dalam keranjang. Terima kasih!'); window.location.href = 'index.php';</script>";






    }
}

$id = $_GET["id"];

$query = "SELECT tb_produk.id_produk AS PRODUK, nama_produk, satuan_produk, harga_produk, deskripsi_produk, gambar_produk, tb_produk.id_kategori, nama_kategori FROM tb_produk INNER JOIN tb_kategori ON tb_produk.id_kategori = tb_kategori.id_kategori WHERE tb_produk.id_produk = '$id'";
$result = mysqli_query($koneksi, $query);

$produk = "<h1>Detail Produk</h1>";
$produk .= "<div class='area-produk'>";
while ($row1 = mysqli_fetch_assoc($result)) {
    $produk .= "<div class='makanan-detail'>";
    $produk .= '<img src="image/' . $row1["gambar_produk"] . '" alt="' . $row1["nama_produk"] . '">';
    $produk .= "<br>";

    $produk .= "<div class='detail'>";
    $produk .= "<h1>" . $row1["nama_produk"] . "</h1>";

    $produk .= "<br>";

    $produk .= "<p>" . $row1["deskripsi_produk"] . "</p>";

    $produk .= "<br>";

    $produk .= "<form action='' method='POST'>";
    $produk .= "<input type='hidden' id='id_produk' name='id_produk' value='" . $row1["PRODUK"] . "'>";
    $produk .= "<div class='keranjang'>";
    $produk .= "<label for='jumlah_pesanan'><b>Jumlah Pesanan</b></label>";
    $produk .= "<input type='number' id='jumlah_beli' name='jumlah_beli' required>";
    $produk .= "<button type='submit'>Masukkan ke Keranjang</button>";
    $produk .= "</div>";
    $produk .= "</form>";

    $produk .= "</div>";

    $produk .= "</div>";
}
$produk .= "</div>";

echo $produk;

?>
    
</body>

</html>