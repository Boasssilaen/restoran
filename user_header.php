<?php

include "koneksi.php";

session_start();

if (!isset($_SESSION["id_session"])) {
    $_SESSION["id_session"] = session_id();
}

?>

<section class="header">
    <div class="navbar">
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="keranjang.php?id=<?php echo $_SESSION["id_session"]; ?>">Keranjang</a></li>
        </ul>
    </div>
    <div class="loReg">
        <a href="login.php">Login</a>
    </div>
</section>
