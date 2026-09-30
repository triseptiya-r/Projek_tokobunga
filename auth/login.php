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
    <title>Login Admin - Nana Florist & Bakery</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        /* RESET & VARIABLE SETUP (MAROON PALETTE) */
        :root {
            --primary: #800020;         /* Deep Maroon */
            --primary-hover: #5c0017;   /* Dark Maroon */
            --accent: #d4af37;          /* Soft Gold Accent */
            --bg-light: #fdf8f8;        /* Light Rose/Warm Cream Tint */
            --card-bg: #ffffff;
            --text-dark: #2b1e1e;       /* Warm Dark Brown-Black */
            --text-muted: #756565;     /* Soft Muted Gray-Brown */
            --white: #ffffff;
            --danger: #d9534f;
            --danger-bg: #fdf2f2;
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        /* CONTAINER & CARD LOGIN */
        .login-wrapper {
            width: 100%;
            max-width: 420px;
        }

        .card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 2.5rem 2rem;
            box-shadow: var(--shadow);
            border: 1px solid #f2e1e1;
            text-align: center;
        }

        .brand-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .card h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 0.25rem;
            font-weight: 700;
        }

        .card p {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 1.75rem;
        }

        /* ALERT ERROR */
        .alert {
            background-color: var(--danger-bg);
            color: var(--danger);
            border: 1px solid #f5c6cb;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            text-align: left;
        }

        /* FORM ELEMENTS */
        .form-group {
            text-align: left;
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e2d2d2;
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.95rem;
            color: var(--text-dark);
            background-color: #fff;
            transition: var(--transition);
            outline: none;
        }

        .form-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.12);
        }

        /* BUTTONS & LINKS */
        .btn-primary {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 30px;
            background-color: var(--primary);
            color: var(--white);
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(128, 0, 32, 0.25);
            transition: var(--transition);
            margin-top: 0.5rem;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(128, 0, 32, 0.35);
        }

        .back-link {
            display: inline-block;
            margin-top: 1.5rem;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .back-link:hover {
            color: var(--primary);
        }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <div class="card">
            
            <h1>Login Admin</h1>
            <p>Silakan login untuk masuk ke dashboard.</p>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert">
                    <?= htmlspecialchars($_SESSION['error']); ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form action="proses_login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn-primary">Login</button>
            </form>

            <a href="../index.php" class="back-link">&larr; Kembali ke Website</a>
        </div>
    </div>

</body>

</html>