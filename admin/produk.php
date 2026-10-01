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


    <link 
          rel="stylesheet"
          href="../assets/style.css">

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