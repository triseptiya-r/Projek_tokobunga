<?php
session_start();

require_once "../includes/auth.php";
require_once "../config/database.php";

$keyword  = $_GET['keyword'] ?? '';
$kategori = $_GET['kategori'] ?? '';

$where = [];

if ($keyword != '') {
    $keyword_safe = mysqli_real_escape_string($conn, $keyword);
    $where[] = "nama LIKE '%$keyword_safe%'";
}

if ($kategori != '') {
    $kategori_safe = mysqli_real_escape_string($conn, $kategori);
    $where[] = "kategori = '$kategori_safe'";
}

$where_sql = "";

if (count($where) > 0) {
    $where_sql = "WHERE " . implode(" AND ", $where);
}

/*
|--------------------------------------------------------------------------
| PAGINATION
|--------------------------------------------------------------------------
*/

$per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $per_page;

$count_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total 
     FROM produk
     $where_sql"
);

$count_data = mysqli_fetch_assoc($count_query);
$total_data = $count_data['total'];
$total_page = ceil($total_data / $per_page);

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     $where_sql
     ORDER BY id DESC
     LIMIT $per_page OFFSET $offset"
);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - Nana Florist Admin</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Internal -->
    <style>
        :root {
            --primary: #800020;
            --primary-hover: #5c0017;
            --accent: #d4af37;
            --bg-light: #fdf8f8;
            --card-bg: #ffffff;
            --text-dark: #2b1e1e;
            --text-muted: #756565;
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

        /* Navbar Styling */
        .navbar {
            background: var(--white);
            box-shadow: 0 2px 12px rgba(128, 0, 32, 0.06);
            padding: 1rem 0;
            border-bottom: 2px solid #f4e8e8;
            margin-bottom: 2rem;
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
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--primary);
        }

        /* Layout Container */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto 3rem auto;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2rem;
            color: var(--primary);
        }

        /* Card Component */
        .card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 1.8rem;
            box-shadow: var(--shadow);
            border: 1px solid #f2e1e1;
            margin-bottom: 2rem;
        }

        /* Form Search & Filter */
        .filter-form {
            display: flex;
            gap: 1rem;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            flex: 1;
            min-width: 200px;
        }

        .form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-input,
        .form-select {
            padding: 0.7rem 1rem;
            border: 1.5px solid #e2c7c7;
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            outline: none;
            transition: var(--transition);
            background-color: var(--white);
        }

        .form-input:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 8px rgba(128, 0, 32, 0.15);
        }

        .form-actions {
            display: flex;
            gap: 0.5rem;
        }

        /* Button Styling */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.7rem 1.4rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.88rem;
            cursor: pointer;
            border: none;
            transition: var(--transition);
            line-height: 1;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-secondary {
            background-color: #f0e6e6;
            color: var(--text-dark);
        }

        .btn-secondary:hover {
            background-color: #e2d2d2;
        }

        .btn-warning {
            background-color: #f39c12;
            color: var(--white);
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
            border-radius: 6px;
        }

        .btn-warning:hover {
            background-color: #d68910;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: var(--white);
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
            border-radius: 6px;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        /* Table Styling */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.9rem;
        }

        table th {
            background-color: #fdf3f3;
            color: var(--primary);
            font-weight: 700;
            padding: 1rem;
            border-bottom: 2px solid #f2e1e1;
            white-space: nowrap;
        }

        table td {
            padding: 1rem;
            border-bottom: 1px solid #f6ecec;
            vertical-align: middle;
        }

        table tr:hover {
            background-color: #fffafa;
        }

        .img-thumb {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e2c7c7;
        }

        .no-img {
            color: var(--text-muted);
            font-size: 0.8rem;
            font-style: italic;
        }

        .action-btns {
            display: flex;
            gap: 0.5rem;
        }

        .badge-category {
            background-color: #fef5e7;
            color: #d4af37;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            border: 1px solid #fbeee0;
        }

        /* Pagination Styling */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--white);
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            border: 1px solid #e2c7c7;
            transition: var(--transition);
        }

        .pagination a:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .pagination a.active {
            background-color: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <header class="navbar">
        <div class="nav-container">
            <a href="index.php" class="brand-logo">Nana Florist Admin</a>
            <nav class="nav-links">
                <a href="index.php">Dashboard</a>
                <a href="produk.php" class="active">Produk</a>
                <a href="../index.php" target="_blank">Lihat Website</a>
            </nav>
        </div>
    </header>

    <main class="container">

        <div class="header-actions">
            <h1 class="page-title">Kelola Produk</h1>
            <a href="tambah.php" class="btn btn-primary">
                + Tambah Produk Baru
            </a>
        </div>

        <?php include "../includes/flash.php"; ?>

        <!-- SEARCH & FILTER -->
        <div class="card">
            <form method="GET" class="filter-form">
                <div class="form-group">
                    <label>Cari Produk</label>
                    <input 
                        type="text" 
                        name="keyword" 
                        class="form-input" 
                        placeholder="Masukkan nama produk..." 
                        value="<?= htmlspecialchars($keyword); ?>"
                    >
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <option value="Buket Mawar" <?= $kategori == 'Buket Mawar' ? 'selected' : ''; ?>>Buket Mawar</option>
                        <option value="Buket Lily" <?= $kategori == 'Buket Lily' ? 'selected' : ''; ?>>Buket Lily</option>
                        <option value="Buket Chrysanthemum" <?= $kategori == 'Buket Chrysanthemum' ? 'selected' : ''; ?>>Buket Chrysanthemum</option>
                        <option value="Bunga" <?= $kategori == 'Bunga' ? 'selected' : ''; ?>>Bunga</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="produk.php" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>

        <!-- TABLE PRODUK -->
        <div class="card table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th style="width: 90px;">Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th style="width: 130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($query) > 0): ?>
                        <?php 
                        $no = $offset + 1; 
                        while ($row = mysqli_fetch_assoc($query)): 
                        ?>
                            <tr>
                                <td><strong><?= $no++; ?></strong></td>
                                <td>
                                    <?php if (!empty($row['gambar'])): ?>
                                        <img 
                                            src="../uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" 
                                            alt="<?= htmlspecialchars($row['nama']); ?>" 
                                            class="img-thumb"
                                        >
                                    <?php else: ?>
                                        <span class="no-img">Tidak ada foto</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($row['nama']); ?></strong>
                                </td>
                                <td>
                                    <span class="badge-category"><?= htmlspecialchars($row['kategori']); ?></span>
                                </td>
                                <td>
                                    <strong>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></strong>
                                </td>
                                <td>
                                    <?= $row['stok']; ?> pcs
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                                        <a 
                                            href="hapus.php?id=<?= $row['id']; ?>" 
                                            class="btn btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                        >
                                            Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 2rem;">
                                Tidak ada data produk yang ditemukan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <?php if ($total_page > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_page; $i++): ?>
                    <a 
                        href="?page=<?= $i; ?>&keyword=<?= urlencode($keyword); ?>&kategori=<?= urlencode($kategori); ?>"
                        class="<?= $page == $i ? 'active' : ''; ?>"
                    >
                        <?= $i; ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

    </main>

</body>

</html>