<section class="header">
    <div class="navbar">
        <ul>
            <li><a href="index.php">Beranda</a></li>
        </ul>
    </div>
    <div class="loReg">
    </div>
</section>

<?php

session_start();

include "koneksi.php";

if (isset($_SESSION["email"])) {
    header("Location: dashboard.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM tb_user WHERE email_user = '$email' AND password_user = '$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["email"] = $row["email_user"];
        $_SESSION["nama"] = $row["nama_user"];
        $_SESSION["id"] = $row["id_user"];
    } else {
        echo "<script>alert('Email atau Password salah, silahkan ulangi!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <section class="login">
        <div class="form">
            <h2>Login to System</h2>

            <form action="" method="post">
                <label for="email">Email</label>
                <br>
                <input type="email" id="email" name="email">
                <br>
                <label for="password">Password</label>
                <br>
                <input type="password" id="password" name="password">
                <br>
                <button type="submit">Login</button>
            </form>
        </div>
    </section>


    
    
</body>
</html>