<?php

include "sesi.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | <?php echo $_SESSION["nama"]; ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    
    include "header.php";

    ?>

    <div class="dashboard">
        <p>Halo, <span><?php echo $_SESSION["nama"]; ?></span> 😊.</p>
        <p>Selamat Datang di Halaman Dashboard.</p>
    </div>
    
</body>

</html>