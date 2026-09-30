<?php

require_once "config/database.php";

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     ORDER BY id DESC
     LIMIT 6"
);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Sweet Cake - Toko Kue</title>

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

        <a href="tentang.php">
            Tentang Kami
        </a>

    </div>

</div>

<section class="hero">

    <div class="container">

        <h1>
            Sweet Cake
        </h1>

        <p>
            Kue lezat untuk setiap momen spesial.
        </p>

        <a
            href="produk.php"
            class="btn"
        >
            Lihat Produk
        </a>

    </div>

</section>

<div class="container">

    <h2>Produk Terbaru</h2>

    <div class="grid">

        <?php while ($row = mysqli_fetch_assoc($query)): ?>

        <div class="card">

            <?php if ($row['gambar']): ?>

                <img
                    src="uploads/produk/<?= htmlspecialchars($row['gambar']); ?>"
                    class="product-image"
                >

            <?php endif; ?>

            <h3>
                <?= htmlspecialchars($row['nama']); ?>
            </h3>

            <p>
                <?= htmlspecialchars($row['kategori']); ?>
            </p>

            <strong>
                Rp <?= number_format(
                    $row['harga'],
                    0,
                    ',',
                    '.'
                ); ?>
            </strong>

            <br><br>

            <a
                href="detail.php?id=<?= $row['id']; ?>"
                class="btn"
            >
                Detail
            </a>

        </div>

        <?php endwhile; ?>

    </div>

</div>

</body>

</html>