<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
            /*background-color: #2d6bdf37;*/
            background-color: rgba(109, 120, 206, 0.07);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            box-shadow: -2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .icon-circle i {
            font-size: 35px;
            color: white;
        }

        .btn-primary {
            /*background-color: #2d6cdf;*/
            background-color: #6d79ce;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #1f4fb3;
        }

        input {
            border-radius: 12px !important;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="card shadow login-card">

        <div class="icon-circle">
            <img src="<?= base_url('assets/img/logomini.png') ?>" alt="Logo" style="width: 80px; height: 80px; position: absolute;">
        </div>

        <h3 class="text-center fw-bold">Validar Sesión</h3>
        <p class="text-center text-muted mb-4">
            Pon tu código de verificación para validar tu sesión como estudiante.
        </p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('comprobar_codigo') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Codigo de Verificación</label>
                <input type="text" name="codigo" class="form-control" placeholder="XXXXXX" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    Validar Codigo de Verificación
                </button>
            </div>

        </form>

    </div>
</body>

</html>