<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sessió - Inscripció</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* Variables Globales de Color */
        :root {
            --brand-primary: #6d79ce; 
            --brand-hover: #24c87e;
            --bg-page: #f4f6f9;
            --bg-surface: #ffffff;
            --text-main: #2b2d42;
            --text-secondary: #6c757d;
            --icon-bg: rgba(109, 120, 206, 0.07);
        }

        body {
            background-color: var(--bg-page);
            color: var(--text-main);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .text-sub { color: var(--text-secondary); }
        .bg-surface { background-color: var(--bg-surface); }

        .login-card {
            max-width: 480px;
            width: 100%;
            border-radius: 20px;
            padding: 40px;
            background-color: var(--bg-surface);
        }

        /* Botón de volver superior */
        .btn-back-portal {
            background-color: var(--bg-surface);
            color: var(--text-secondary);
            border: none;
            transition: color 0.2s;
        }
        .btn-back-portal:hover {
            color: var(--brand-primary);
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background-color: var(--icon-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            box-shadow: -2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .icon-circle i {
            font-size: 35px;
            color: var(--bg-surface);
        }

        .btn-action {
            background-color: var(--brand-primary);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-action:hover {
            background-color: var(--brand-hover);
            color: #ffffff;
        }

        input.form-control {
            border-radius: 12px !important;
            padding: 10px;
        }
    </style>
</head>
<body>

    <div class="position-fixed top-0 start-0 p-3" style="z-index: 1050;">
        <a href="<?= base_url('/') ?>" class="btn btn-sm btn-back-portal shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Tornar al Portal
        </a>
    </div>

    <div class="card shadow login-card border-0">

        <div class="icon-circle">
            <img src="<?= base_url('assets/img/logomini.png') ?>" alt="Logo" style="width: 80px; height: 80px; position: absolute;">
        </div>

        <h3 class="text-center fw-bold">Iniciar Sessió</h3>
        <p class="text-center text-sub mb-4">
            Introdueix el teu DNI i email per accedir al procés de matrícula
        </p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger border-0 rounded-3">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login_estudiante') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">DNI/NIE</label>
                <input type="text" name="dni" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="d-grid mt-2">
                <button type="submit" class="btn btn-action shadow-sm">
                    Enviar Codi de Verificació
                </button>
            </div>
        </form>

    </div>

</body>
</html>