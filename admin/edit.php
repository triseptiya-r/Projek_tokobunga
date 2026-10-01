<?php

session_start();

require_once "../includes/auth.php";
require_once "../config/database.php";

$id = isset($_GET['id'])
    ? (int)$_GET['id']
    : 0;

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     WHERE id = $id"
);

$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    die("Produk tidak ditemukan.");
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Produk - Nana Florist</title>

    <link rel="stylesheet" href="../assets/style.css">

</head>

<body>

<div class="container">

    <div class="card">

        <h1>Edit Produk</h1>

        <?php include "../includes/flash.php"; ?>


        <form
            action="proses_produk.php"
            method="POST"
            enctype="multipart/form-data"
        >

            <input
                type="hidden"
                name="aksi"
                value="edit"
            >

            <input
                type="hidden"
                name="id"
                value="<?= $produk['id']; ?>"
            >


            <!-- Nama Produk -->

            <label>Nama Produk</label>

            <input
                type="text"
                name="nama"
                value="<?= htmlspecialchars($produk['nama']); ?>"
                placeholder="Contoh: Buket Mawar Merah"
                required
            >


            <!-- Kategori -->

            <label>Kategori</label>

            <select name="kategori" required>

                <option value="">
                    Pilih Kategori
                </option>

                <option
                    value="Buket Bunga"
                    <?= $produk['kategori'] == 'Buket Bunga' ? 'selected' : ''; ?>
                >
                    Buket Bunga
                </option>

                <option
                    value="Bunga Papan"
                    <?= $produk['kategori'] == 'Bunga Papan' ? 'selected' : ''; ?>
                >
                    Bunga Papan
                </option>

                <option
                    value="Bunga Meja"
                    <?= $produk['kategori'] == 'Bunga Meja' ? 'selected' : ''; ?>
                >
                    Bunga Meja
                </option>

                <option
                    value="Standing Flower"
                    <?= $produk['kategori'] == 'Standing Flower' ? 'selected' : ''; ?>
                >
                    Standing Flower
                </option>

                <option
                    value="Hampers Bunga"
                    <?= $produk['kategori'] == 'Hampers Bunga' ? 'selected' : ''; ?>
                >
                    Hampers Bunga
                </option>

                <option
                    value="Bunga Pernikahan"
                    <?= $produk['kategori'] == 'Bunga Pernikahan' ? 'selected' : ''; ?>
                >
                    Bunga Pernikahan
                </option>

            </select>


            <!-- Deskripsi -->

            <label>Deskripsi</label>

            <textarea
                name="deskripsi"
                rows="5"
                placeholder="Masukkan deskripsi produk..."
                required
            ><?= htmlspecialchars($produk['deskripsi']); ?></textarea>


            <!-- Harga -->

            <label>Harga</label>

            <input
                type="number"
                name="harga"
                value="<?= $produk['harga']; ?>"
                min="0"
                required
            >


            <!-- Stok -->

            <label>Stok</label>

            <input
                type="number"
                name="stok"
                value="<?= $produk['stok']; ?>"
                min="0"
                required
            >


            <!-- Gambar -->

            <label>Ganti Gambar</label>

            <input
                type="file"
                name="gambar"
                accept=".jpg,.jpeg,.png,.webp"
            >


            <?php if (!empty($produk['gambar'])): ?>

                <p>Gambar saat ini:</p>

                <img
                    src="../uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>"
                    alt="<?= htmlspecialchars($produk['nama']); ?>"
                    class="edit-product-image"
                >

            <?php endif; ?>


            <!-- Tombol -->

            <div class="edit-product-actions">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Update Produk
                </button>

                <a
                    href="produk.php"
                    class="btn btn-secondary"
                >
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>
