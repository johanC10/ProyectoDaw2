<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Secretaría</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f4f6f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center; 
        }

        .login-card {
            max-width: 480px;
            width: 100%;
            border-radius: 20px;
            padding: 40px;
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background-color: rgba(109, 120, 206, 0.07);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            box-shadow: -2px 2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .icon-circle i {
            font-size: 35px;
            color: #6d79ce; /* Ajustado para que el icono se vea si no carga la imagen */
        }

        .btn-primary {
            background-color: #6d79ce;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #24c87e;
        }

        input {
            border-radius: 12px !important;
            padding: 10px;
        }
    </style>
</head>

<body>

    <div class="card shadow login-card border-0">

        <div class="icon-circle">
            <img src="<?= base_url('assets/img/logomini.png') ?>" alt="Logo" style="width: 80px; height: 80px; position: absolute; border-radius: 50%;">
        </div>

        <h3 class="text-center fw-bold">Iniciar Sesión</h3>
        <p class="text-center text-muted mb-4">
            Introduce tu usuario y contraseña para acceder al área administrativa
        </p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger border-0 rounded-3">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('process_login_secretaria') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Usuario</label>
                <input type="text" name="usuario" class="form-control" placeholder="Nombre de usuario" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="********" required>
            </div>

            <div class="d-grid mt-2">
                <button type="submit" class="btn btn-primary shadow-sm">
                    Entrar
                </button>
            </div>

        </form>

    </div>

</body>
</html>