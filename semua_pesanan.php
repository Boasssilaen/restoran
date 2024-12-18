<?php

include "sesi.php";

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
include "header.php";

$query = "SELECT no_pesanan, nama_pemesan, tgl_pesanan, waktu_pesanan, grand_total, status_pesanan, nama_user FROM tb_pesanan INNER JOIN tb_user ON tb_pesanan.id_kasir = tb_user.id_user";
$result = mysqli_query($koneksi, $query);

$tbl = "<table border='1' cellpadding='10' cellspacing='0'>
        <tr>
            <th>No</th>
            <th>No Pesanan</th>
            <th>Nama Pemesan</th>
            <th>Waktu Pemesanan</th>
            <th>Grand Total</th>
            <th>Status Pesanan</th>
            <th>Kasir</th>
        </tr>";
$no = 1;

while ($row = mysqli_fetch_assoc($result)) {
    $no_pesanan = $row['no_pesanan'];
    $nama_pemesan = $row['nama_pemesan'];
    $tgl_pesanan = date("d F Y", strtotime($row['tgl_pesanan']));
    $waktu_pesanan = date("H:i:s", strtotime($row['waktu_pesanan']));
    $grand_total = $row['grand_total'];
    $status_pesanan = $row['status_pesanan'];
    $nama_user = $row['nama_user'];

    $tbl .= "<tr>
        <td>$no</td>
        <td><a href='pesanan.php?no=$no_pesanan'>$no_pesanan</a></td>
        <td>$nama_pemesan</td>
        <td>$tgl_pesanan ($waktu_pesanan)</td>
        <td>Rp. $grand_total</td>
        <td>$status_pesanan</td>";

        if ($status_pesanan == "Dipesan") {
            $tbl .= "<td></td>";
        } else {
            $tbl .= "<td>$nama_user</td>";
        }

        $tbl .= "</tr>";
        $no++;

}

$tbl .= "</table>";

echo $tbl;
?>
    
</body>

</html>