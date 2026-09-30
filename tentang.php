<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Nana Florist</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS External -->
    <link rel="stylesheet" href="assets/style.css">

    <!-- CSS Internal untuk Penyesuaian Halaman Tentang Kami -->
    <style>
 /* ==========================================================================
   1. RESET & VARIABLE SETUP (MAROON ELEGAN)
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
   2. LAYOUT CONTAINERS & TITLES
   ========================================================================== */
.container {
  width: 90%;
  max-width: 1200px;
  margin: 0 auto;
}

.page-title {
  font-family: 'Cormorant Garamond', serif;
  font-size: 2.5rem;
  color: var(--primary);
  text-align: center;
  margin-bottom: 1.5rem;
}

/* ==========================================================================
   3. NAVBAR / HEADER
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
   4. HERO SECTION (HOME PAGE)
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
   5. SEARCH FORM & INPUT (PERBAIKAN PRESISI TOMBOL & INPUT)
   ========================================================================== */
.search-box {
  background: var(--card-bg);
  padding: 1.5rem;
  border-radius: var(--border-radius);
  box-shadow: var(--shadow);
  border: 1px solid #f2e1e1;
  margin-bottom: 2.5rem;
}

.search-form {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  max-width: 600px;
  margin: 0 auto;
}

.search-input {
  flex: 1;
  padding: 0.85rem 1.25rem;
  border: 1.5px solid #e2c7c7;
  border-radius: 30px;
  font-family: 'Montserrat', sans-serif;
  font-size: 0.95rem;
  outline: none;
  transition: var(--transition);
  color: var(--text-dark);
}

.search-input:focus {
  border-color: var(--primary);
  box-shadow: 0 0 10px rgba(128, 0, 32, 0.15);
}

.search-btn {
  background-color: var(--primary);
  color: var(--white);
  border: 1.5px solid var(--primary);
  padding: 0.85rem 2rem;
  border-radius: 30px;
  font-family: 'Montserrat', sans-serif;
  font-size: 0.95rem;
  font-weight: 600;
  cursor: pointer;
  transition: var(--transition);
  box-shadow: 0 4px 12px rgba(128, 0, 32, 0.25);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  white-space: nowrap;
}

.search-btn:hover {
  background-color: var(--primary-hover);
  border-color: var(--primary-hover);
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(128, 0, 32, 0.35);
}

.search-btn:active {
  transform: translateY(0);
}

/* ==========================================================================
   6. BUTTONS GENERAL
   ========================================================================== */
.btn {
  display: inline-block;
  padding: 0.75rem 1.75rem;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 600;
  transition: var(--transition);
  cursor: pointer;
  font-family: 'Montserrat', sans-serif;
  font-size: 0.9rem;
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
   7. SECTIONS & GRID SYSTEM
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
   8. PRODUCT CARD
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

.empty-state {
  text-align: center;
  padding: 3rem;
  background: var(--white);
  border-radius: var(--border-radius);
  border: 1px dashed #f2e1e1;
  color: var(--text-muted);
  grid-column: 1 / -1;
}

/* ==========================================================================
   9. TENTANG KAMI PAGE
   ========================================================================== */
.about-card {
  background: var(--card-bg);
  border-radius: var(--border-radius);
  padding: 3rem 2.5rem;
  box-shadow: var(--shadow);
  border: 1px solid #f2e1e1;
}

.about-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  align-items: center;
}

.about-content h1 {
  font-family: 'Cormorant Garamond', serif;
  font-size: 2.8rem;
  color: var(--primary);
  margin-bottom: 1rem;
  line-height: 1.2;
}

.about-content p {
  color: var(--text-muted);
  font-size: 1rem;
  line-height: 1.8;
  margin-bottom: 1.2rem;
}

.about-image img {
  width: 100%;
  height: auto;
  border-radius: var(--border-radius);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
  object-fit: cover;
}

.contact-section {
  margin-top: 2.5rem;
  padding-top: 2rem;
  border-top: 1px dashed #f2e1e1;
}

.contact-section h2 {
  font-family: 'Cormorant Garamond', serif;
  font-size: 2rem;
  color: var(--primary);
  margin-bottom: 1rem;
}

.contact-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 1rem;
  margin-top: 1rem;
}

.contact-item {
  background: var(--bg-light);
  padding: 1.25rem;
  border-radius: 10px;
  border: 1px solid #f4e8e8;
  transition: var(--transition);
}

.contact-item:hover {
  transform: translateY(-3px);
  box-shadow: 0 5px 15px rgba(128, 0, 32, 0.1);
}

.contact-label {
  font-size: 0.8rem;
  font-weight: 700;
  text-transform: uppercase;
  color: var(--primary);
  letter-spacing: 0.5px;
  display: block;
  margin-bottom: 0.25rem;
}

.contact-value {
  font-size: 1rem;
  color: var(--text-dark);
  font-weight: 600;
  text-decoration: none;
}

.contact-value:hover {
  color: var(--primary);
}

/* ==========================================================================
   10. FOOTER
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
   11. RESPONSIVE LAYOUT
   ========================================================================== */
@media (max-width: 768px) {
  .nav-container {
    flex-direction: column;
    gap: 1rem;
  }

  .hero-title {
    font-size: 2.5rem;
  }

  .about-grid {
    grid-template-columns: 1fr;
    gap: 2rem;
  }

  .about-card {
    padding: 2rem 1.5rem;
  }
}

@media (max-width: 576px) {
  .search-form {
    flex-direction: column;
  }

  .search-input,
  .search-btn {
    width: 100%;
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
                <a href="produk.php">Katalog</a>
                <a href="tentang.php" class="active">Tentang Kami</a>
                
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="section-about">
        <div class="container">
            
            <div class="about-card">
                <div class="about-grid">
                    
                    <!-- Kolom Teks Informasi -->
                    <div class="about-content">
                        <h1>Tentang Nana Florist</h1>
                        <p>
                            Nana Florist adalah UMKM yang bergerak dalam bidang kreasi bunga segar, buket cantik, serta beragam pilihan penganan manis (*cakes & desserts*).
                        </p>
                        <p>
                            Kami berdedikasi untuk menyediakan produk berkualitas terbaik guna melengkapi momen berharga Anda—mulai dari kado ulang tahun, perayaan kelulusan, pernikahan, hingga berbagai acara istimewa lainnya.
                        </p>
                    </div>

                    <!-- Kolom Gambar Utama -->
                    <div class="about-image">
                        <img src="https://images.unsplash.com/photo-1526047932273-341f2a7631f9?auto=format&fit=crop&w=800&q=80" alt="Tentang Nana Florist">
                    </div>

                </div>

                <!-- Bagian Informasi Kontak -->
                <div class="contact-section">
                    <h2>Hubungi Kami</h2>
                    <div class="contact-cards">
                        
                        <div class="contact-item">
                            <span class="contact-label">WhatsApp</span>
                            <a href="https://wa.me/6281234567890" target="_blank" class="contact-value">
                                +62 812-3456-7890
                            </a>
                        </div>

                        <div class="contact-item">
                            <span class="contact-label">Instagram</span>
                            <a href="https://instagram.com/nanaflorist" target="_blank" class="contact-value">
                                @nanaflorist
                            </a>
                        </div>

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