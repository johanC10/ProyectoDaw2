<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('LoginAdmin.titulo_pestana') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
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

        .text-sub {
            color: var(--text-secondary);
        }

        .text-brand {
            color: var(--brand-primary);
        }

        .bg-surface {
            background-color: var(--bg-surface);
        }

        .login-card {
            max-width: 480px;
            width: 100%;
            border-radius: 20px;
            padding: 40px;
            background-color: var(--bg-surface);
        }

        /* Botón de volver superior y selector de idioma */
        .top-btn {
            background-color: var(--bg-surface);
            color: var(--text-secondary);
            border: none;
            transition: color 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
        }

        .top-btn:hover {
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
            position: relative;
        }

        .icon-circle i {
            font-size: 35px;
            color: var(--brand-primary);
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
        <a href="<?= base_url('/') ?>" class="btn btn-sm top-btn shadow-sm border">
            <i class="bi bi-arrow-left me-1"></i> <?= lang('LoginAdmin.btn_volver') ?>
        </a>
    </div>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <div class="dropdown">
            <button class="top-btn border dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-globe"></i> <?= strtoupper(service('request')->getLocale()) ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                <li><a class="dropdown-item <?= service('request')->getLocale() === 'ca' ? 'fw-bold' : '' ?>"
                        href="<?= base_url('lang/ca') ?>">Català (CA)</a></li>
                <li><a class="dropdown-item <?= service('request')->getLocale() === 'es' ? 'fw-bold' : '' ?>"
                        href="<?= base_url('lang/es') ?>">Español (ES)</a></li>
                <li><a class="dropdown-item <?= service('request')->getLocale() === 'en' ? 'fw-bold' : '' ?>"
                        href="<?= base_url('lang/en') ?>">English (EN)</a></li>
            </ul>
        </div>
    </div>

    <div class="card shadow login-card border-0">

        <div class="icon-circle">
            <img src="<?= base_url('assets/img/logomini.png') ?>" alt="Logo"
                style="width: 80px; height: 80px; position: absolute; border-radius: 50%;">
        </div>

        <h3 class="text-center fw-bold"><?= lang('LoginAdmin.titulo_form') ?></h3>
        <p class="text-center text-sub mb-4">
            <?= lang('LoginAdmin.subtitulo') ?>
        </p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger border-0 rounded-3">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success border-0 rounded-3">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('process_login_secretaria') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold"><?= lang('LoginAdmin.label_usuario') ?></label>
                <input type="text" name="usuario" class="form-control"
                    placeholder="<?= lang('LoginAdmin.placeholder_usuario') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><?= lang('LoginAdmin.label_password') ?></label>
                <input type="password" name="password" class="form-control"
                    placeholder="<?= lang('LoginAdmin.placeholder_password') ?>" required>
            </div>

            <div class="d-grid mt-2">
                <button type="submit" class="btn btn-action shadow-sm">
                    <?= lang('LoginAdmin.btn_entrar') ?>
                </button>
            </div>

            <div class="text-end mb-4">
                <a href="#" class="text-sub small text-decoration-none" data-bs-toggle="modal"
                    data-bs-target="#recoverModal">
                    <?= lang('LoginAdmin.olvido_pass') ?? '¿Problemas con el alta o la contraseña?' ?>
                </a>
            </div>

        </form>

    </div>

    <!-- Modal Recuperar -->
    <div class="modal fade" id="recoverModal" tabindex="-1" aria-labelledby="recoverModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 16px;">
                <div class="modal-header border-0 bg-light"
                    style="border-top-left-radius: 16px; border-top-right-radius: 16px;">
                    <h5 class="modal-title fw-bold" id="recoverModalLabel"><i
                            class="bi bi-shield-lock me-2 text-brand"></i>
                        <?= lang('LoginAdmin.titulo_recuperar') ?? 'Recuperar Cuenta' ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted small mb-4">
                        <?= lang('LoginAdmin.sub_recuperar') ?? 'Introduce tu usuario. Si estás dado de alta en la BBDD podremos enviar la recuperación. Si no te consta, deberá activarte el jefe (rol superior).' ?>
                    </p>

                    <form action="<?= base_url('recover_password_secretaria') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?= lang('LoginAdmin.label_usuario') ?></label>
                            <input type="text" name="recover_user" class="form-control" required
                                placeholder="<?= lang('LoginAdmin.placeholder_usuario') ?>">
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit"
                                class="btn btn-action shadow-sm"><?= lang('LoginAdmin.btn_enviar_recuperacion') ?? 'Solicitar Acceso' ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>