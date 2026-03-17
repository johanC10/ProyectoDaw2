<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('Portal.titulo_pestana') ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --brand-primary: #6d79ce; 
            --brand-hover: #5b66b8;
            --brand-success: #24c87e;
            --bg-page: #f8f9fa;
            --bg-surface: #ffffff;
            --text-main: #212529;
            --text-secondary: #6c757d;
            --border-light: #f1f3f5;
            --border-medium: #e9ecef;
        }

        body {
            background-color: var(--bg-page);
            color: var(--text-main);
            font-family: system-ui, -apple-system, sans-serif;
        }
        .text-sub { color: var(--text-secondary); }
        .bg-surface { background-color: var(--bg-surface); }

        /* Dropdown de idiomas */
        .lang-selector {
            background-color: var(--bg-surface);
            color: var(--text-main);
            font-weight: 500;
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .btn-access {
            color: #ffffff;
            border: 1px solid var(--brand-success);
            background-color: var(--brand-success);
            transition: all 0.2s;
            font-weight: 500;
        }
        .btn-access:hover {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
            color: #ffffff;
        }

        .btn-start {
            background-color: var(--brand-primary);
            color: #ffffff;
            border: none;
            font-weight: 600;
            transition: background-color 0.2s;
        }
        .btn-start:hover {
            background-color: var(--brand-success);
            color: #ffffff;
        }

        .hero-icon {
            background: linear-gradient(135deg, var(--brand-primary), #4b58b0);
            width: 90px; 
            height: 90px;
            color: #ffffff;
            font-size: 2.5rem;
        }

        .card-feature {
            background-color: var(--bg-surface);
            transition: transform 0.3s ease;
        }
        .card-feature:hover {
            transform: translateY(-5px);
        }
        .feature-icon {
            color: var(--brand-success);
            font-size: 2rem;
        }
        
        .process-card {
            background-color: var(--bg-surface);
            border-radius: 12px;
            border: 1px solid var(--border-medium);
            padding: 2rem 0; 
        }
        
        .process-title {
            text-align: center;
            font-weight: 700;
            margin-bottom: 2rem;
            color: var(--text-main);
        }

        .process-step {
            display: flex;
            align-items: center;
            padding: 1.25rem 2rem;
            border-bottom: 1px solid var(--border-light);
            max-width: 650px; 
            margin: 0 auto; 
        }
        .process-step:last-child {
            border-bottom: none;
        }

        .step-number {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            background-color: var(--brand-primary);
            color: #ffffff;
            border-radius: 50%;
            flex-shrink: 0;
            margin-right: 1.5rem; 
        }

        .step-text {
            font-size: 1rem;
            color: var(--text-main);
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="position-fixed top-0 end-0 p-3 d-flex align-items-center gap-3" style="z-index: 1050;">
        
        <div class="dropdown">
            <button class="lang-selector dropdown-toggle border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-globe"></i> <?= strtoupper(service('request')->getLocale()) ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                <li><a class="dropdown-item <?= service('request')->getLocale() === 'ca' ? 'fw-bold' : '' ?>" href="<?= base_url('lang/ca') ?>">Català (CA)</a></li>
                <li><a class="dropdown-item <?= service('request')->getLocale() === 'es' ? 'fw-bold' : '' ?>" href="<?= base_url('lang/es') ?>">Español (ES)</a></li>
                <li><a class="dropdown-item <?= service('request')->getLocale() === 'en' ? 'fw-bold' : '' ?>" href="<?= base_url('lang/en') ?>">English (EN)</a></li>
            </ul>
        </div>

        <a href="<?= base_url('auth/secretaria') ?>" class="btn btn-access btn-sm shadow-sm">
            <i class="bi bi-shield-lock-fill me-1"></i> <?= lang('Portal.btn_secretaria') ?>
        </a>
    </div>

    <main class="container py-5">
        
        <div class="row justify-content-center text-center py-5">
            <div class="col-lg-8">
                <div class="mx-auto hero-icon rounded-circle d-flex align-items-center justify-content-center mb-4 shadow">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <h1 class="display-5 fw-bold mb-3"><?= lang('Portal.titulo_principal') ?></h1>
                <p class="lead text-sub mb-4">
                    <?= lang('Portal.subtitulo') ?>
                </p>
                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                    <a href="<?= base_url('auth/estudiante') ?>" class="btn btn-start btn-lg px-5 py-3 shadow">
                        <?= lang('Portal.btn_comenzar') ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5 pb-5">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="feature-icon mb-3"><i class="bi bi-clock-history"></i></div>
                    <h5 class="fw-bold"><?= lang('Portal.feat1_titulo') ?></h5>
                    <p class="text-sub small mb-0"><?= lang('Portal.feat1_desc') ?></p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="feature-icon mb-3"><i class="bi bi-shield-check"></i></div>
                    <h5 class="fw-bold"><?= lang('Portal.feat2_titulo') ?></h5>
                    <p class="text-sub small mb-0"><?= lang('Portal.feat2_desc') ?></p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="feature-icon mb-3"><i class="bi bi-cloud-arrow-up"></i></div>
                    <h5 class="fw-bold"><?= lang('Portal.feat3_titulo') ?></h5>
                    <p class="text-sub small mb-0"><?= lang('Portal.feat3_desc') ?></p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="feature-icon mb-3"><i class="bi bi-envelope-at"></i></div>
                    <h5 class="fw-bold"><?= lang('Portal.feat4_titulo') ?></h5>
                    <p class="text-sub small mb-0"><?= lang('Portal.feat4_desc') ?></p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-lg-7">
                <div class="process-card shadow-sm">
                    
                    <h2 class="h4 process-title"><?= lang('Portal.pasos_titulo') ?></h2>
                    
                    <div class="process-step">
                        <div class="step-number">1</div>
                        <p class="step-text"><?= lang('Portal.paso_1') ?></p>
                    </div>

                    <div class="process-step">
                        <div class="step-number">2</div>
                        <p class="step-text"><?= lang('Portal.paso_2') ?></p>
                    </div>

                    <div class="process-step">
                        <div class="step-number">3</div>
                        <p class="step-text"><?= lang('Portal.paso_3') ?></p>
                    </div>

                    <div class="process-step">
                        <div class="step-number">4</div>
                        <p class="step-text"><?= lang('Portal.paso_4') ?></p>
                    </div>

                    <div class="process-step">
                        <div class="step-number">5</div>
                        <p class="step-text"><?= lang('Portal.paso_5') ?></p>
                    </div>

                    <div class="process-step">
                        <div class="step-number">6</div>
                        <p class="step-text"><?= lang('Portal.paso_6') ?></p>
                    </div>

                    <div class="process-step">
                        <div class="step-number">7</div>
                        <p class="step-text"><?= lang('Portal.paso_7') ?></p>
                    </div>

                </div>
            </div>
        </div>

    </main>

    <footer class="text-center py-4 mt-5 text-sub border-top bg-surface">
        <small>&copy; <?= date('Y') ?> <?= lang('Portal.footer_derechos') ?></small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>