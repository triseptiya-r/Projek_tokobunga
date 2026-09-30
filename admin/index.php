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

    <!-- CSS Internal -->
    <style>
        /* ==========================================================================
           RESET & VARIABLE SETUP (MAROON PALETTE)
           ========================================================================== */
        :root {
            --primary: #800020;         /* Deep Maroon */
            --primary-hover: #5c0017;   /* Dark Maroon */
            --accent: #d4af37;          /* Soft Gold Accent */
            --bg-light: #fdf8f8;        /* Light Rose Tint */
            --card-bg: #ffffff;
            --text-dark: #2b1e1e;       /* Warm Dark Brown-Black */
            --text-muted: #756565;     /* Soft Muted Gray-Brown */
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
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            letter-spacing: 1px;
        }

        .nav-menu {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            color: var(--primary);
            font-weight: 600;
        }

        .nav-menu a.btn-logout {
            color: #d9534f;
            border: 1px solid #f2c7c7;
            padding: 0.4rem 1rem;
            border-radius: 20px;
        }

        .nav-menu a.btn-logout:hover {
            background-color: #d9534f;
            color: var(--white);
            border-color: #d9534f;
        }

        /* ==========================================================================
           MAIN CONTENT & CONTAINERS
           ========================================================================== */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 2.5rem auto;
        }

        .welcome-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.5rem;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .welcome-text {
            color: var(--text-muted);
            font-size: 1.05rem;
        }

        .welcome-text strong {
            color: var(--primary);
        }

        /* ==========================================================================
           GRID & STATS CARDS
           ========================================================================== */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 1.75rem;
            box-shadow: var(--shadow);
            border: 1px solid #f2e1e1;
            transition: var(--transition);
        }

        .card-stat {
            position: relative;
            overflow: hidden;
        }

        .card-stat::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background-color: var(--primary);
        }

        .card-stat h3 {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .card-stat .stat-number {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--primary);
            line-height: 1;
        }

        .card-stat .stat-status {
            font-size: 1.5rem;
            color: #2e7d32;
            font-weight: 600;
        }

        /* ==========================================================================
           MANAGEMENT SECTION CARD & BUTTONS
           ========================================================================== */
        .card-manage h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .card-manage p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

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
            text-align: center;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(128, 0, 32, 0.25);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(128, 0, 32, 0.35);
        }

        /* ==========================================================================
           RESPONSIVE
           ========================================================================== */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }

            .page-title {
                font-size: 2rem;
            }
        }
    </style>
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