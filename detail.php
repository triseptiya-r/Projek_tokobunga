<?php
require_once "config/database.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk WHERE id = $id"
);

$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    header("Location: produk.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produk['nama']); ?> - Nana Florist</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet"
          href="assets/style.css
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

    <!-- Main Content Detail Produk -->
    <main class="section-detail" style="padding: 3rem 0; min-height: 70vh;">
        <div class="container">
            <!-- Breadcrumb Navigation -->
            <div style="margin-bottom: 1.5rem; font-size: 0.9rem; color: var(--text-muted);">
                <a href="index.php" style="color: var(--text-muted); text-decoration: none;">Beranda</a> &nbsp;/&nbsp; 
                <a href="produk.php" style="color: var(--text-muted); text-decoration: none;">Katalog</a> &nbsp;/&nbsp; 
                <span style="color: var(--primary); font-weight: 600;"><?= htmlspecialchars($produk['nama']); ?></span>
            </div>

            <!-- Detail Grid Container -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2.5rem; background: var(--card-bg); padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--shadow); border: 1px solid #f2e1e1; align-items: start;">
                
                <!-- Gambar Produk -->
                <div style="width: 100%; border-radius: var(--border-radius); overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                    <?php if (!empty($produk['gambar'])): ?>
                        <img src="uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>" alt="<?= htmlspecialchars($produk['nama']); ?>" style="width: 100%; height: auto; max-height: 450px; object-fit: cover; display: block;">
                    <?php else: ?>
                        <img src="assets/images/placeholder.jpg" alt="No Image" style="width: 100%; height: auto; max-height: 450px; object-fit: cover; display: block;">
                    <?php endif; ?>
                </div>

                <!-- Informasi Produk -->
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <span style="color: var(--primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                        <?= htmlspecialchars($produk['kategori']); ?>
                    </span>

                    <h1 style="font-family: 'Cormorant Garamond', serif; font-size: 2.5rem; color: var(--text-dark); line-height: 1.2;">
                        <?= htmlspecialchars($produk['nama']); ?>
                    </h1>

                    <div style="font-size: 1.8rem; font-weight: 700; color: var(--primary);">
                        Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>
                    </div>

                    <div style="padding: 0.5rem 0; border-top: 1px dashed #f2e1e1; border-bottom: 1px dashed #f2e1e1; color: var(--text-muted); font-size: 0.9rem;">
                        Stok Tersedia: <strong style="color: var(--text-dark);"><?= (int)$produk['stok']; ?> unit</strong>
                    </div>

                    <div style="margin: 0.5rem 0;">
                        <h4 style="font-family: 'Cormorant Garamond', serif; font-size: 1.2rem; color: var(--text-dark); margin-bottom: 0.5rem;">Deskripsi Produk</h4>
                        <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.7; white-space: pre-line;">
                            <?= htmlspecialchars($produk['deskripsi']); ?>
                        </p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div style="display: flex; gap: 1rem; margin-top: 1rem; flex-wrap: wrap;">
                        <a href="https://wa.me/6281234567890?text=Halo%20Nana%20Florist,%20saya%20ingin%20memesan%20<?= urlencode($produk['nama']); ?>" target="_blank" class="btn btn-primary" style="flex: 1; text-align: center;">
                            Pesan Sekarang via WA
                        </a>
                        <a href="produk.php" class="btn btn-outline" style="width: auto; padding: 0.75rem 1.5rem;">
                            &larr; Kembali
                        </a>
                    </div>
                </div>

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
                <p>Kue & Dessert</p>
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