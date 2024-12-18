<?php

include "koneksi.php";

session_start();

$id_keranjang = $_GET['id'];
$id_session = $_SESSION['id_session'];

$query = "DELETE FROM tb_keranjang WHERE id_keranjang = '$id_keranjang'";
mysqli_query($koneksi, $query);

header("Location: keranjang.php?id=" . $id_session);
exit();

?>