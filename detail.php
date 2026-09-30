<?php

require_once "config/database.php";

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
<html>

<head>

    <title>
        <?= htmlspecialchars($produk['nama']); ?>
    </title>

    <link rel="stylesheet" href="assets/style.css">

</head>

<body>

<div class="navbar">

    <div class="container">

        <a href="index.php">
            Sweet Cake
        </a>

        <a href="produk.php">
            Produk
        </a>

    </div>

</div>

<div class="container">

    <div class="card">

        <?php if ($produk['gambar']): ?>

            <img
                src="uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>"
                class="product-image"
            >

        <?php endif; ?>

        <h1>
            <?= htmlspecialchars($produk['nama']); ?>
        </h1>

        <p>
            Kategori:
            <?= htmlspecialchars($produk['kategori']); ?>
        </p>

        <p>
            <?= nl2br(
                htmlspecialchars($produk['deskripsi'])
            ); ?>
        </p>

        <h2>
            Rp <?= number_format(
                $produk['harga'],
                0,
                ',',
                '.'
            ); ?>
        </h2>

        <p>
            Stok:
            <?= $produk['stok']; ?>
        </p>

        <a
            href="produk.php"
            class="btn"
        >
            Kembali
        </a>

    </div>

</div>

</body>

</html>