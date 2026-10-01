<?php
session_start();

require_once "../includes/auth.php";
require_once "../config/database.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama      = trim($_POST['nama'] ?? '');
    $kategori  = trim($_POST['kategori'] ?? '');
    $harga     = (int)($_POST['harga'] ?? 0);
    $stok      = (int)($_POST['stok'] ?? 0);
    $deskripsi = trim($_POST['deskripsi'] ?? '');

    // Validasi input
    if (empty($nama) || empty($kategori) || $harga <= 0) {
        $error = 'Nama, kategori, dan harga wajib diisi dengan benar!';
    } else {
        $gambar_nama = '';

        // Proses Upload Gambar
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $file_tmp   = $_FILES['gambar']['tmp_name'];
            $file_name  = $_FILES['gambar']['name'];
            $file_ext   = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed    = ['jpg', 'jpeg', 'png', 'webp'];

            if (in_array($file_ext, $allowed)) {
                $gambar_nama = time() . '_' . uniqid() . '.' . $file_ext;
                $target = "../uploads/produk/" . $gambar_nama;
                
                if (!is_dir("../uploads/produk/")) {
                    mkdir("../uploads/produk/", 0777, true);
                }

                move_uploaded_file($file_tmp, $target);
            } else {
                $error = 'Format gambar harus JPG, JPEG, PNG, atau WEBP!';
            }
        }

        if (empty($error)) {
            $stmt = mysqli_prepare($conn, "INSERT INTO produk (nama, kategori, harga, stok, deskripsi, gambar) VALUES (?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssdiss", $nama, $kategori, $harga, $stok, $deskripsi, $gambar_nama);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['flash_message'] = 'Produk berhasil ditambahkan!';
                header('Location: produk.php');
                exit;
            } else {
                $error = 'Gagal menyimpan produk ke database.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Nana Florist Admin</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="../assets/style.css?v=2">
</head>

<body>

    <header class="navbar">
        <div class="nav-container">
            <a href="index.php" class="brand-logo">Nana Florist Admin</a>
            <nav class="nav-links">
                <a href="index.php">Dashboard</a>
                <a href="produk.php" class="active">Produk</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <h1 class="page-title">Tambah Produk Baru</h1>

        <?php if (!empty($error)): ?>
            <div class="alert-error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="card">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama" class="form-input" placeholder="Misal: Buket Mawar Merah Deluxe" required>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Buket Mawar">Buket Mawar</option>
                        <option value="Buket Lily">Buket Lily</option>
                        <option value="Buket Chrysanthemum">Buket Chrysanthemum</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Harga (Rp)</label>
                        <input type="number" name="harga" class="form-input" placeholder="150000" min="0" required>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-input" placeholder="10" min="0" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi Produk</label>
                    <textarea name="deskripsi" rows="4" class="form-textarea" placeholder="Tulis deskripsi rinci tentang produk..."></textarea>
                </div>

                <div class="form-group">
                    <label>Foto Produk</label>
                    <input type="file" name="gambar" class="form-input" accept=".jpg,.jpeg,.png,.webp">
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Simpan Produk</button>
                    <a href="produk.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </main>

</body>

</html>