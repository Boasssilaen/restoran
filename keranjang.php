<?php

include "user_header.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Pesanan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php

include "koneksi.php";

$sessionid = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_pesanan = $_POST['no_pesanan'];
    $nama_pemesan = $_POST['nama_pemesan'];
    $tgl_pesanan = date("Y-m-d");
    $grand_total = $_POST['grand_total'];
    $waktu_pesanan = date("H:i:s");
    $status_pesanan = "Dipesan";
    $id_kasir = 1;
    
    $query_pesanan = "INSERT INTO tb_pesanan (no_pesanan, nama_pemesan, tgl_pesanan, grand_total, waktu_pesanan, status_pesanan, id_kasir)VALUES ('$no_pesanan', '$nama_pemesan', '$tgl_pesanan', '$grand_total', '$waktu_pesanan', '$status_pesanan', '$id_kasir')";
    mysqli_query($koneksi, $query_pesanan);

    $keranjang_query = "SELECT tb_keranjang.id_produk, jumlah_beli, harga_produk FROM tb_keranjang INNER JOIN tb_produk ON tb_keranjang.id_produk = tb_produk.id_produk WHERE tb_keranjang.id_session = '$sessionid'";
    $keranjang_result = mysqli_query($koneksi, $keranjang_query);

    while ($row = mysqli_fetch_assoc($keranjang_result)) {
        $id_produk = $row['id_produk'];
        $jumlah_beli = $row['jumlah_beli'];
        $harga_produk = $row['harga_produk'];
        $total_harga = $harga_produk * $jumlah_beli;

        $query_detail_pesanan = "INSERT INTO tb_detail_pesanan (no_pesanan, id_produk, jumlah_beli, harga_produk, total_harga) VALUES ('$no_pesanan', '$id_produk', '$jumlah_beli', '$harga_produk', '$total_harga')";
        mysqli_query($koneksi, $query_detail_pesanan);
    }

    $query_hapus_keranjang = "DELETE FROM tb_keranjang WHERE id_session = '$sessionid'";
    mysqli_query($koneksi, $query_hapus_keranjang);

    header("Location: data_pesanan.php");
    exit();
}

$query = "SELECT id_session, tb_keranjang.id_produk, tb_keranjang.id_keranjang, jumlah_beli, nama_produk, satuan_produk, harga_produk FROM tb_keranjang INNER JOIN tb_produk ON tb_keranjang.id_produk = tb_produk.id_produk WHERE id_session = '$sessionid'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $no = 1;
    $grand_total = 0;

    $tbl = "<h1>Keranjang Pesanan</h1>";
    $tbl .= "<table border='1px' cellpadding='10' cellspacing='0'><tr><th>No</th><th>Id Produk</th><th>Nama Produk</th><th>Satuan Produk</th><th>Harga Produk</th><th>Jumlah Beli</th><th>Total_Harga</th><th>Aksi</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        $total_harga = $row['harga_produk'] * $row['jumlah_beli'];
        $grand_total += $total_harga;

        $tbl .= "<tr>";
        $tbl .= "<td>" . $no++ . "</td>";
        $tbl .= "<td>" . $row['id_produk'] . "</td>";
        $tbl .= "<td>" . $row['nama_produk'] . "</td>";
        $tbl .= "<td>" . $row['satuan_produk'] . "</td>";
        $tbl .= "<td>" . $row['harga_produk'] . "</td>";
        $tbl .= "<td>" . $row['jumlah_beli'] . "</td>";
        $tbl .= "<td>" . $total_harga . "</td>";
        $tbl .= "<td><a href='hapus_produk.php?id=" . $row['id_keranjang'] . "'>Hapus</a></td>";
        $tbl .= "</tr>";

    }

    $tbl .= "<tr><th colspan='6'>Grand Total</th>";
    $tbl .= "<th colspan='2'>" . $grand_total . "</th></tr>";
    $tbl .= "</table>";
    $nopesanan = date("Ymd") . sprintf("%03d", rand(0, 999));

    $tbl .= "<div class='namPem'>";

    $tbl .= "<form action='' method='post'>";
    $tbl .= '<input type="hidden" name="no_pesanan" value="' .$nopesanan . '">';
    $tbl .= '<label for="nama_pemesan">Nama Pemesan</label>';
    $tbl .= '<input type="text" id="nama_pemesan" name="nama_pemesan" required>';
    $tbl .= '<input type="hidden" name="tgl_pesanan" value="' . date("Y-m-d") . '">';
    $tbl .= '<input type="hidden" name="grand_total" value="' . $grand_total . '">';
    $tbl .= '<input type="hidden" name="waktu_pesanan" value="' . date("H-i-s") . '">';
    $tbl .= '<input type="hidden" name="status_pesanan" value="Dipesan">'; 
    $tbl .= '<input type="hidden" name="id_kasir" value="1">';
    $tbl .= '<button type="submit">Selesaikan Pesanan</button>';
    $tbl .= "</form>";

    $tbl .= "</div>";

    echo $tbl;
    
 
    

} else {
    header("Location: index.php");
    exit();
}

?>
    
</body>
</html>