<?php

session_start();

if (isset($_SESSION['admin_id'])) {
    header("Location: ../admin/index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin - Nana Florist</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Montserrat:wght@300;400;500;600&display=swap"
        rel="stylesheet"
    >

    <!-- External CSS -->
    <link rel="stylesheet" href="../assets/style.css">

</head>

<body>

    <div class="login-wrapper">

        <div class="login-card">

            <h1>Login Admin</h1>

            <p class="login-description">
                Silakan login untuk masuk ke dashboard.
            </p>


            <?php if (isset($_SESSION['error'])): ?>

                <div class="alert">

                    <?= htmlspecialchars($_SESSION['error']); ?>

                </div>

                <?php unset($_SESSION['error']); ?>

            <?php endif; ?>


            <form
                action="proses_login.php"
                method="POST"
                class="login-form"
            >

                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Masukkan username"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="btn-primary login-button"
                >
                    Login
                </button>

            </form>


            <a
                href="../index.php"
                class="back-link"
            >
                &larr; Kembali ke Website
            </a>

        </div>

    </div>

</body>

</html>
