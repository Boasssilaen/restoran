<?php

include "sesi.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php

    include "koneksi.php";
    include "header.php";

    $no_pesanan = $_GET['no'];

    $query = "SELECT no_pesanan, nama_pemesan, status_pesanan FROM tb_pesanan WHERE no_pesanan = '$no_pesanan'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    echo "<h1>Detail Pesanan</h1>";

    ?>

    <div class="detaPes">
        <?php
        echo "<p>No Pesanan: " . $row['no_pesanan'] . "</p>";
        echo "<p>Nama Pemesan: " . $row['nama_pemesan'] . "</p>";
        echo "<p>Rincian Pesanan Anda Adalah:</p>";
        ?>
    </div>

    <?php

    $query_detail = "SELECT tb_detail_pesanan.id_produk, nama_produk, satuan_produk, tb_detail_pesanan.harga_produk, jumlah_beli, total_harga FROM tb_detail_pesanan INNER JOIN tb_produk ON tb_detail_pesanan.id_produk = tb_produk.id_produk WHERE no_pesanan = '$no_pesanan'";
    $result_detail = mysqli_query($koneksi, $query_detail);

    $tbl = "<table border='1' cellpadding='10' cellspacing='0'>
        <tr>
            <th>No</th>
            <th>Id Produk</th>
            <th>Nama Produk</th>
            <th>Satuan Produk</th>
            <th>Harga Produk</th>
            <th>Jumlah Beli</th>
            <th>Total Harga</th>
         </tr>";

         $no = 1;
         while ($row_detail = mysqli_fetch_assoc($result_detail)) {
            $tbl .= "<tr>
                <td>" . $no++ . "</td>
                <td>" . $row_detail['id_produk'] . "</td>
                <td>" . $row_detail['nama_produk'] . "</td>
                <td>" . $row_detail['satuan_produk'] . "</td>
                <td>Rp. " . $row_detail['harga_produk'] . "</td>
                <td>" . $row_detail['jumlah_beli'] . "</td>
                <td>Rp. " . $row_detail['total_harga'] . "</td>
            </tr>";
         }

         $tbl .= "
         </table>";
         echo $tbl;
         ?>

         <div class="tombol">
            <button onclick="kembali()">Kembali</button>
            <?php if ($row['status_pesanan'] == "Dipesan") : ?>
                <form id="formBayar" method="post" action ="">
                    <input type="hidden" name="no_pesanan" value="<?php echo $no_pesanan; ?>">
                    <input type="hidden" name="bayar_sekarang" value="DiBayar">
                    <button type="button" onclick="konfirmasiBayar()">Bayar</button>
                </form>
            <?php endif; ?>
        </div>

        <script>
            function kembali() {
                window.location.href = "semua_pesanan.php";
            }

            function konfirmasiBayar() {
                var bayar = confirm('Apakah pesanan tersebut benar sudah dibayarkan?');
                if (bayar) {
                    document.getElementById('formBayar') .submit();
                }
            }
        </script>



    
</body>

</html>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_pesanan = $_POST['no_pesanan'];
    $id_kasir = $_SESSION['id'];

    $update_query = "UPDATE tb_pesanan SET status_pesanan = 'DiBayar', id_kasir = '$id_kasir' WHERE no_pesanan = '$no_pesanan'";
    mysqli_query($koneksi, $update_query);

    header("Location: semua_pesanan.php");
    exit();
}

?>