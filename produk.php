<?php
require_once "config/database.php";

$keyword = $_GET['keyword'] ?? '';

if ($keyword != '') {
    $keyword_safe = mysqli_real_escape_string($conn, $keyword);
    $query = mysqli_query(
        $conn,
        "SELECT * FROM produk
         WHERE nama LIKE '%$keyword_safe%' OR kategori LIKE '%$keyword_safe%'
         ORDER BY id DESC"
    );
} else {
    $query = mysqli_query(
        $conn,
        "SELECT * FROM produk
         ORDER BY id DESC"
    );
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Nana Florist</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS External -->
    <link rel="stylesheet" href="assets/style.css">

    <link 
          rel="stylesheet"
          href="assets/style.css">
</head>

<body>

    <!-- Header / Navbar -->
    <header class="navbar">
        <div class="container nav-container">
            <a href="index.php" class="brand-logo">Nana Florist</a>
            <nav class="nav-menu">
                <a href="index.php">Beranda</a>
                <a href="produk.php" class="active">Katalog</a>
                <a href="tentang.php">Tentang Kami</a>
                
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="section-products">
        <div class="container">
            
            <h1 class="page-title">Katalog Produk Kami</h1>

            <!-- Form Pencarian -->
            <div class="search-box">
                <form method="GET" class="search-form">
                    <input 
                        type="text" 
                        name="keyword" 
                        class="search-input"
                        placeholder="Cari buket bunga, atau kategori..." 
                        value="<?= htmlspecialchars($keyword); ?>"
                    >
                    <button type="submit" class="search-btn">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Grid Produk -->
            <div class="grid">
                <?php if (mysqli_num_rows($query) > 0): ?>
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
                                
                                <p class="product-desc">
                                    <?= htmlspecialchars(substr($row['deskripsi'], 0, 75)) . '...'; ?>
                                </p>
                                
                                <div class="product-meta">
                                    <span class="product-price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></span>
                                    <span class="product-stock">Stok: <?= (int)$row['stok']; ?></span>
                                </div>

                                <a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-outline">Lihat Detail</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <h3>Produk Tidak Ditemukan</h3>
                        <p>Tidak ada produk yang cocok dengan pencarian "<strong><?= htmlspecialchars($keyword); ?></strong>".</p>
                        <a href="produk.php" class="btn btn-primary" style="margin-top: 1rem;">Tampilkan Semua Produk</a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </main>

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