<section class="header">
    <div class="navbar">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="semua_pesanan.php">Pesanan</a></li>
        </ul>
    </div>
    <div class="loReg">
        <ul>
            <li><?php echo $_SESSION["nama"]; ?></li>
            <li>|</li>
            <li><button onclick="confirmLogout()">Logout</button></li>
        </ul>
    </div>
</section>

<script>
    function confirmLogout() {
        var logout = confirm('Apakah anda ingin Logout?');
        if (logout) {
            window.location.href = "logout.php";
        }
    }
</script>

