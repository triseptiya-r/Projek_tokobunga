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

    <!-- CSS External -->
    <link rel="stylesheet" href="assets/style.css">
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
    <main class="section-detail">
        <div class="container">

            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="index.php">Beranda</a>
                <span>&nbsp;/&nbsp;</span>

                <a href="produk.php">Katalog</a>
                <span>&nbsp;/&nbsp;</span>

                <span class="breadcrumb-active">
                    <?= htmlspecialchars($produk['nama']); ?>
                </span>
            </div>


            <!-- Detail Produk -->
            <div class="detail-product">

                <!-- Gambar Produk -->
                <div class="product-image">
                    <?php if (!empty($produk['gambar'])): ?>

                        <img
                            src="uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>"
                            alt="<?= htmlspecialchars($produk['nama']); ?>"
                        >

                    <?php else: ?>

                        <img
                            src="assets/images/placeholder.jpg"
                            alt="No Image"
                        >

                    <?php endif; ?>
                </div>


                <!-- Informasi Produk -->
                <div class="product-info">

                    <span class="product-category">
                        <?= htmlspecialchars($produk['kategori']); ?>
                    </span>


                    <h1 class="product-title">
                        <?= htmlspecialchars($produk['nama']); ?>
                    </h1>


                    <div class="product-price">
                        Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>
                    </div>


                    <div class="product-stock">
                        Stok Tersedia:
                        <strong>
                            <?= (int)$produk['stok']; ?> unit
                        </strong>
                    </div>


                    <div class="product-description">

                        <h4>Deskripsi Produk</h4>

                        <p>
                            <?= htmlspecialchars($produk['deskripsi']); ?>
                        </p>

                    </div>


                    <!-- Tombol Aksi -->
                    <div class="product-actions">

                        <a
                            href="https://wa.me/6281234567890?text=Halo%20Nana%20Florist,%20saya%20ingin%20memesan%20<?= urlencode($produk['nama']); ?>"
                            target="_blank"
                            class="btn btn-primary btn-order"
                        >
                            Pesan Sekarang via WA
                        </a>

                        <a
                            href="produk.php"
                            class="btn btn-outline btn-back"
                        >
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
