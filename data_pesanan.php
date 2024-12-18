<?php

include "user_header.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pesanan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php
include "koneksi.php";

$query1 = "SELECT no_pesanan, nama_pemesan, waktu_pesanan, tgl_pesanan FROM tb_pesanan";
$result1 = mysqli_query($koneksi, $query1);

$tbl = "<h1>Data Pesanan</h1>";

while ($pesanan = mysqli_fetch_assoc($result1)) {
    $no_pesanan = $pesanan['no_pesanan'];
    $tanggal = date("d F Y", strtotime($pesanan['tgl_pesanan']));
    $waktu = date("H:i", strtotime($pesanan['waktu_pesanan']));

    $tbl .= "<div class='daPes'>";

    $tbl .= "<div class='detaPes'>";

    $tbl .= "<p>No Pesanan: " . $no_pesanan . "</p>";
    $tbl .= "<p>Nama Pemesan: " . $pesanan['nama_pemesan'] . "</p>";
    $tbl .= "<p>Waktu Pesanan: " . $waktu . ", (" . $tanggal . ")</p>";
    $tbl .= "<p>Rincian Pesanan Anda Adalah:</p>";

    $tbl .= "</div>";

    $tbl .= "<table border='1px' cellpadding='10' cellspacing='0'>
            <tr>
                <th>No</th>
                <th>Id Produk</th>
                <th>Nama Produk</th>
                <th>Satuan Produk</th>
                <th>Harga Produk</th>
                <th>Jumlah Beli</th>
                <th>Total Harga</th>
            </tr>";

    $query2 = "SELECT tb_detail_pesanan.id_produk, nama_produk, satuan_produk, tb_detail_pesanan.harga_produk, jumlah_beli, total_harga FROM tb_detail_pesanan INNER JOIN tb_produk ON tb_detail_pesanan.id_produk = tb_produk.id_produk WHERE no_pesanan = '$no_pesanan'";
    $result2 = mysqli_query($koneksi, $query2);

    $no = 1;
    while ($detail = mysqli_fetch_assoc($result2)) {
        $tbl .= "<tr>";
        $tbl .= "<td>" . $no++ . "</td>";
        $tbl .= "<td>" . $detail['id_produk'] . "</td>";
        $tbl .= "<td>" . $detail['nama_produk'] . "</td>";
        $tbl .= "<td>" . $detail['satuan_produk'] . "</td>";
        $tbl .= "<td>Rp. " . $detail['harga_produk'] . "</td>";
        $tbl .= "<td>" . $detail['jumlah_beli'] . "</td>";
        $tbl .= "<td>Rp. " . $detail['total_harga'] . "</td>";
        $tbl .= "</tr>";


    }

    $tbl .= "</table>";

    $tbl .= "</div>";


        
    
    
                
}

echo $tbl;
?>
    
</body>

</html>