<?php
require_once "../includes/auth.php";
require_once "../config/database.php";

$total_produk = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM produk"
);

$data_produk = mysqli_fetch_assoc(
    $total_produk
);

$total_kategori = mysqli_query(
    $conn,
    "SELECT COUNT(DISTINCT kategori) AS total
     FROM produk"
);

$data_kategori = mysqli_fetch_assoc(
    $total_kategori
);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Nana Florist & Bakery</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link 
          rel="stylesheet"
          href="../assets/style.css">
</head>

<body>

    <!-- Header / Navbar Admin -->
    <header class="navbar">
        <div class="nav-container">
            <a href="index.php" class="brand-logo">Nana Florist Admin</a>
            <nav class="nav-menu">
                <a href="index.php" class="active">Dashboard</a>
                <a href="produk.php">Produk</a>
                <a href="../index.php" target="_blank">Lihat Website</a>
                <a href="logout.php" class="btn-logout">Logout</a>
            </nav>
        </div>
    </header>

    <!-- Content -->
    <main class="container">

        <!-- Welcome Banner -->
        <div class="welcome-header">
            <h1 class="page-title">Dashboard Admin</h1>
            <p class="welcome-text">
                Selamat datang kembali, <strong><?= htmlspecialchars($_SESSION['admin_nama'] ?? 'Admin'); ?></strong>
            </p>
        </div>

        <!-- Metric Grid -->
        <div class="grid">
            <div class="card card-stat">
                <h3>Total Produk</h3>
                <div class="stat-number"><?= (int) $data_produk['total']; ?></div>
            </div>

            <div class="card card-stat">
                <h3>Total Kategori</h3>
                <div class="stat-number"><?= (int) $data_kategori['total']; ?></div>
            </div>

            <div class="card card-stat">
                <h3>Status Sistem</h3>
                <div class="stat-status">Aktif</div>
            </div>
        </div>

        <!-- Quick Action Card -->
        <div class="card card-manage">
            <h2>Manajemen Produk</h2>
            <p>Kelola katalog produk, tambah item baru, serta perbarui harga & stok Nana Florist & Bakery.</p>
            <a href="produk.php" class="btn btn-primary">Kelola Produk</a>
        </div>

    </main>

</body>

</html>