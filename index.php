<?php
require_once "config/database.php";

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     ORDER BY id DESC
     LIMIT 3"
);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nana Florist & Bakery - Toko Bunga & Kue</title>


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link 
          rel="stylesheet"
          href="assets/style.css">


</head>

<!-- Header / Navbar -->
    <header class="navbar">
        <div class="container nav-container">
            <a href="index.php" class="brand-logo">Nana Florist</a>
            <nav class="nav-menu">
                <a href="index.php" class="active">Beranda</a>
                <a href="produk.php">Katalog</a>
                <a href="tentang.php">Tentang Kami</a>
                
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">
            <span class="hero-tagline">Keindahan & Kebahagiaan</span>
            <h1 class="hero-title">NANA FLORIST</h1>
            <p class="hero-subtitle">Bloom Your Moments</p>
            <a href="produk.php" class="btn btn-primary">Lihat Katalog</a>
        </div>
    </section>

    <!-- Produk Populer / Terbaru -->
    <section class="section-products">
        <div class="container">
            <div class="section-header">
                <h2>Produk Pilihan Kami</h2>
            </div>

            <div class="grid">
                <?php while ($row = mysqli_fetch_assoc($query)): ?>
                    <div class="card">
                        <div class="card-image-wrapper">
                            <span class="badge badge-best">BEST</span>
                            <?php if (!empty($row['gambar'])): ?>
                                <img src="uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama']); ?>" class="product-image">
                            <?php else: ?>
                                <img src="assets/images/placeholder.jpg" alt="No Image" class="product-image">
                            <?php endif; ?>
                        </div>

                        <div class="card-body">
                            <h3 class="product-title"><?= htmlspecialchars($row['nama']); ?></h3>
                            <p class="product-category"><?= htmlspecialchars($row['kategori']); ?></p>
                            
                            <!-- Menampilkan ringkasan deskripsi -->
                            <p class="product-desc"><?= htmlspecialchars(substr($row['deskripsi'], 0, 70)) . '...'; ?></p>
                            
                            <div class="product-meta">
                                <span class="product-price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></span>
                                <!-- Menampilkan stok dari tabel produk -->
                                <span class="product-stock">Stok: <?= (int)$row['stok']; ?></span>
                            </div>

                            <a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-outline">Detail Produk</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- Section Tentang Kami -->
    <section class="section-about">
        <div class="container grid-about">
            <div class="about-text">
                <h2>Tentang Toko Kami</h2>
                <p>Kami menghadirkan kombinasi istimewa antara keindahan rangkaian bunga segar dan kelezatan hidangan manis khas pilihan untuk memeriahkan berbagai momen spesial Anda dan keluarga.</p>
            </div>
            <div class="about-gallery">
                <img src="assets/images/bunga.jpeg" alt="Tentang Nana Florist">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-grid">
            <div>
                <h4>Nana Florist</h4>
                <p>Jl. Bunga Melati No. 123</p>
                <p>+62 812-3456-7890</p>
            </div>
            <div>
                <h4>Kategori Produk</h4>
                <p>Buket Bunga</p>
                
                <p>Bunga Papan</p>
            </div>
            <div>
                <h4>Informasi</h4>
                <p>Cara Pemesanan</p>
                <p>Layanan Pengiriman</p>
            </div>
        </div>
    </footer>

</body>

</html>