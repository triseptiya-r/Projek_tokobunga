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
    
    <!-- Custom CSS -->
    <style>
        /* ==========================================================================
   RESET & VARIABLE SETUP (MAROON PALETTE)
   ========================================================================== */
:root {
  --primary: #800020;            /* Deep Maroon */
  --primary-hover: #5c0017;      /* Darker Maroon */
  --accent: #d4af37;             /* Soft Gold Accent */
  --bg-light: #fdf8f8;           /* Light Rose Tint */
  --card-bg: #ffffff;
  --text-dark: #2b1e1e;          /* Warm Dark Brown-Black */
  --text-muted: #756565;        /* Soft Muted Gray-Brown */
  --white: #ffffff;
  --shadow: 0 10px 25px rgba(128, 0, 32, 0.08);
  --border-radius: 12px;
  --transition: all 0.3s ease;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Montserrat', sans-serif;
  color: var(--text-dark);
  background-color: var(--bg-light);
  line-height: 1.6;
}

/* ==========================================================================
   LAYOUT CONTAINERS
   ========================================================================== */
.container {
  width: 90%;
  max-width: 1200px;
  margin: 0 auto;
}

/* ==========================================================================
   NAVBAR / HEADER
   ========================================================================== */
.navbar {
  background: var(--white);
  box-shadow: 0 2px 12px rgba(128, 0, 32, 0.06);
  position: sticky;
  top: 0;
  z-index: 1000;
  padding: 1rem 0;
  border-bottom: 2px solid #f4e8e8;
}

.nav-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.brand-logo {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.9rem;
  font-weight: 700;
  color: var(--primary);
  text-decoration: none;
  letter-spacing: 1px;
}

.nav-menu {
  display: flex;
  gap: 1.5rem;
}

.nav-menu a {
  text-decoration: none;
  color: var(--text-muted);
  font-weight: 500;
  transition: var(--transition);
}

.nav-menu a:hover,
.nav-menu a.active {
  color: var(--primary);
  font-weight: 600;
}

/* ==========================================================================
   HERO SECTION
   ========================================================================== */
.hero {
  background: linear-gradient(rgba(61, 0, 15, 0.65), rgba(61, 0, 15, 0.65)), 
              url('https://images.unsplash.com/photo-1508610048659-a06b669e3321?auto=format&fit=crop&w=1350&q=80');
  background-size: cover;
  background-position: center;
  height: 70vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: var(--white);
  border-bottom-left-radius: 20px;
  border-bottom-right-radius: 20px;
}

.hero-tagline {
  text-transform: uppercase;
  letter-spacing: 2px;
  font-size: 0.9rem;
  color: #fce4e4;
}

.hero-title {
  font-family: 'Cormorant Garamond', serif;
  font-size: 3.5rem;
  margin: 0.5rem 0;
  font-weight: 700;
  letter-spacing: 2px;
}

.hero-subtitle {
  font-size: 1.2rem;
  margin-bottom: 1.5rem;
  font-weight: 300;
  color: #f3d5d5;
}

/* ==========================================================================
   BUTTONS
   ========================================================================== */
.btn {
  display: inline-block;
  padding: 0.75rem 1.75rem;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 600;
  transition: var(--transition);
  cursor: pointer;
}

.btn-primary {
  background-color: var(--primary);
  color: var(--white);
  box-shadow: 0 4px 15px rgba(128, 0, 32, 0.3);
  border: none;
}

.btn-primary:hover {
  background-color: var(--primary-hover);
  transform: translateY(-2px);
}

.btn-outline {
  border: 1.5px solid var(--primary);
  color: var(--primary);
  background: transparent;
  text-align: center;
}

.btn-outline:hover {
  background-color: var(--primary);
  color: var(--white);
}

/* ==========================================================================
   SECTIONS & GRID SYSTEM
   ========================================================================== */
.section-products, .section-about, .section-detail {
  padding: 4rem 0;
}

.section-header {
  text-align: center;
  margin-bottom: 2.5rem;
}

.section-header h2 {
  font-family: 'Cormorant Garamond', serif;
  font-size: 2.5rem;
  color: var(--primary);
}

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 2rem;
}

/* ==========================================================================
   PRODUCT CARD (INDEX PAGE)
   ========================================================================== */
.card {
  background: var(--card-bg);
  border-radius: var(--border-radius);
  overflow: hidden;
  box-shadow: var(--shadow);
  transition: var(--transition);
  display: flex;
  flex-direction: column;
  border: 1px solid #f2e1e1;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 30px rgba(128, 0, 32, 0.15);
}

.card-image-wrapper {
  position: relative;
  width: 100%;
  height: 250px;
  overflow: hidden;
}

.product-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: var(--transition);
}

.card:hover .product-image {
  transform: scale(1.05);
}

.badge {
  position: absolute;
  top: 12px;
  right: 12px;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  z-index: 10;
  letter-spacing: 0.5px;
}

.badge-best {
  background-color: var(--primary);
  color: var(--white);
}

.card-body {
  padding: 1.25rem;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.product-title {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.4rem;
  margin-bottom: 0.25rem;
  color: var(--text-dark);
}

.product-category {
  font-size: 0.8rem;
  color: var(--primary);
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 1px;
  margin-bottom: 0.5rem;
}

.product-desc {
  font-size: 0.9rem;
  color: var(--text-muted);
  margin-bottom: 1rem;
  flex-grow: 1;
}

.product-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.product-price {
  font-size: 1.2rem;
  font-weight: 700;
  color: var(--primary);
}

.product-stock {
  font-size: 0.85rem;
  color: var(--text-muted);
}

/* ==========================================================================
   ABOUT SECTION
   ========================================================================== */
.grid-about {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  align-items: center;
}

.about-text h2 {
  font-family: 'Cormorant Garamond', serif;
  font-size: 2.2rem;
  color: var(--primary);
  margin-bottom: 1rem;
}

.about-gallery img {
  width: 100%;
  border-radius: var(--border-radius);
  box-shadow: var(--shadow);
}

/* ==========================================================================
   FOOTER
   ========================================================================== */
.footer {
  background-color: #3b000e;
  color: var(--white);
  padding: 3rem 0 1.5rem;
  margin-top: 2rem;
  border-top: 3px solid var(--primary);
}

.footer-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 2rem;
  margin-bottom: 2rem;
}

.footer h4 {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.4rem;
  margin-bottom: 1rem;
  color: #f3c1c1;
}

.footer p {
  font-size: 0.9rem;
  color: #d1b8b8;
  margin-bottom: 0.5rem;
}

/* ==========================================================================
   RESPONSIVE LAYOUT (MOBILE & TABLET)
   ========================================================================== */
@media (max-width: 768px) {
  .nav-container {
    flex-direction: column;
    gap: 1rem;
  }

  .hero-title {
    font-size: 2.5rem;
  }

  .grid-about {
    grid-template-columns: 1fr;
  }
}
    </style>
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