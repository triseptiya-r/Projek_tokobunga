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

        .navbar {
            background: var(--white);
            box-shadow: 0 2px 12px rgba(128, 0, 32, 0.06);
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

        .container {
            width: 90%;
            max-width: 700px;
            margin: 2.5rem auto;
        }

        .page-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid #f2e1e1;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 0.8rem 1.2rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border: 1px solid #f5c6cb;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .form-group label {
            font-size: 0.88rem;
            font-weight: 600;
        }

        .form-input,
        .form-select,
        .form-textarea {
            padding: 0.75rem 1rem;
            border: 1.5px solid #e2c7c7;
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            outline: none;
            transition: var(--transition);
            background-color: var(--white);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 8px rgba(128, 0, 32, 0.15);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            border: none;
            transition: var(--transition);
            text-align: center;
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
    </style>
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