<?php
// --- SIMULACIÓN DE BASE DE DATOS ---
// Este array simula la consulta que harás a tu BD en el futuro.
// Fíjate que ya no hay texto en duro, solo las 'claves' para buscar en el diccionario.
$etapas = [
    [
        'clave' => 'etapa_eso',
        'icono' => 'bi-backpack',
        'badge_clave' => 'badge_4_cursos',
        'cursos' => [
            ['id' => 1, 'familia_clave' => null, 'alumnos' => 90, 'pendientes' => 12],
            ['id' => 2, 'familia_clave' => null, 'alumnos' => 85, 'pendientes' => 0],
            ['id' => 3, 'familia_clave' => null, 'alumnos' => 88, 'pendientes' => 5],
            ['id' => 4, 'familia_clave' => null, 'alumnos' => 82, 'pendientes' => 0],
        ]
    ],
    [
        'clave' => 'etapa_bat',
        'icono' => 'bi-journal-bookmark',
        'badge_clave' => 'badge_2_cursos',
        'cursos' => [
            ['id' => 5, 'familia_clave' => null, 'alumnos' => 60, 'pendientes' => 8],
            ['id' => 6, 'familia_clave' => null, 'alumnos' => 55, 'pendientes' => 0],
        ]
    ],
    [
        'clave' => 'etapa_cfgm',
        'icono' => 'bi-tools',
        'badge_clave' => 'badge_multiples',
        'cursos' => [
            ['id' => 7, 'familia_clave' => 'fam_arts', 'alumnos' => 0, 'pendientes' => 3],
            ['id' => 8, 'familia_clave' => 'fam_auto', 'alumnos' => 0, 'pendientes' => 0],
            ['id' => 9, 'familia_clave' => 'fam_imatge', 'alumnos' => 0, 'pendientes' => 7],
        ]
    ],
    [
        'clave' => 'etapa_cfgs',
        'icono' => 'bi-laptop',
        'badge_clave' => 'badge_multiples',
        'cursos' => [
            ['id' => 10, 'familia_clave' => 'fam_info', 'alumnos' => 0, 'pendientes' => 18],
            ['id' => 11, 'familia_clave' => 'fam_auto', 'alumnos' => 0, 'pendientes' => 0],
        ]
    ],
    [
        'clave' => 'etapa_fpb',
        'icono' => 'bi-pc-display',
        'badge_clave' => 'badge_1_curso',
        'cursos' => [
            ['id' => 12, 'familia_clave' => 'fam_fpb', 'alumnos' => 0, 'pendientes' => 2],
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('Dashboard.titulo_pestana') ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        /* Variables Globales de Color */
        :root {
            --brand-primary: #6d79ce; 
            --brand-hover: #5b66b8;
            --brand-success: #24c87e;
            --brand-warning: #f5a623;
            --bg-page: #f4f6f9;
            --bg-surface: #ffffff;
            --text-main: #2b2d42;
            --text-secondary: #8d99ae;
            --border-light: #edf2f4;
        }

        body {
            background-color: var(--bg-page);
            color: var(--text-main);
            font-family: system-ui, -apple-system, sans-serif;
        }
        .text-sub { color: var(--text-secondary); }
        .text-brand { color: var(--brand-primary); }
        
        /* Barra de navegación superior */
        .top-navbar {
            background-color: var(--bg-surface);
            border-bottom: 1px solid var(--border-light);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-logout {
            color: #ef233c;
            border: 1px solid #ef233c;
            background-color: transparent;
            padding: 0.4rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-logout:hover { background-color: #ef233c; color: #ffffff; }

        /* Tarjetas de Estadísticas */
        .stat-card {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .icon-blue { background-color: rgba(109, 121, 206, 0.1); color: var(--brand-primary); }
        .icon-orange { background-color: rgba(245, 166, 35, 0.1); color: var(--brand-warning); }
        .icon-green { background-color: rgba(36, 200, 126, 0.1); color: var(--brand-success); }

        /* Tarjetas de Cursos */
        .course-card {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-light);
            border-radius: 10px;
            padding: 1.2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-decoration: none;
            color: var(--text-main);
            transition: all 0.2s ease;
        }
        .course-card:hover {
            transform: translateY(-3px);
            border-color: var(--brand-primary);
            box-shadow: 0 6px 12px rgba(109, 121, 206, 0.1);
        }
        
        .badge-pending {
            background-color: rgba(245, 166, 35, 0.15);
            color: #d48a1b;
            border: 1px solid rgba(245, 166, 35, 0.3);
        }
        .badge-ok {
            background-color: rgba(36, 200, 126, 0.15);
            color: #1e9d63;
        }
        
        .etapa-header {
            border-bottom: 2px solid var(--border-light);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            margin-top: 3rem;
        }
    </style>
</head>
<body>

    <header class="top-navbar shadow-sm sticky-top">
        <div class="d-flex align-items-center gap-2">
            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-building text-brand"></i>
            </div>
            <h5 class="mb-0 fw-bold"><?= lang('Dashboard.header_secretaria') ?> | <span class="text-sub fw-normal">Institut Caparrella</span></h5>
        </div>
        
        <div class="d-flex align-items-center gap-4">
            
            <div class="dropdown">
                <button class="btn btn-sm btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-globe"></i> <?= strtoupper(service('request')->getLocale()) ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                    <li><a class="dropdown-item <?= service('request')->getLocale() === 'ca' ? 'fw-bold' : '' ?>" href="<?= base_url('lang/ca') ?>">Català (CA)</a></li>
                    <li><a class="dropdown-item <?= service('request')->getLocale() === 'es' ? 'fw-bold' : '' ?>" href="<?= base_url('lang/es') ?>">Español (ES)</a></li>
                    <li><a class="dropdown-item <?= service('request')->getLocale() === 'en' ? 'fw-bold' : '' ?>" href="<?= base_url('lang/en') ?>">English (EN)</a></li>
                </ul>
            </div>

            <span class="text-sub"><i class="bi bi-person-circle me-1"></i> Admin</span>
            <a href="<?= base_url('logout_secretaria') ?>" class="btn-logout"><i class="bi bi-box-arrow-right me-1"></i> <?= lang('Dashboard.btn_salir') ?></a>
        </div>
    </header>

    <main class="container py-4">
        
        <div class="row g-4 mb-2">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon icon-blue"><i class="bi bi-folder2-open"></i></div>
                    <div>
                        <p class="text-sub small mb-0 fw-semibold"><?= lang('Dashboard.stat_total') ?></p>
                        <h3 class="fw-bold mb-0">842</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon icon-orange"><i class="bi bi-hourglass-split"></i></div>
                    <div>
                        <p class="text-sub small mb-0 fw-semibold"><?= lang('Dashboard.stat_pendientes') ?></p>
                        <h3 class="fw-bold mb-0">124</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon icon-green"><i class="bi bi-check-circle"></i></div>
                    <div>
                        <p class="text-sub small mb-0 fw-semibold"><?= lang('Dashboard.stat_validadas') ?></p>
                        <h3 class="fw-bold mb-0">718</h3>
                    </div>
                </div>
            </div>
        </div>

        <?php foreach ($etapas as $etapa): ?>
            
            <div class="etapa-header d-flex justify-content-between align-items-end">
                <h4 class="fw-bold text-brand mb-0">
                    <i class="bi <?= $etapa['icono'] ?> me-2"></i>
                    <?= lang('Cursos.' . $etapa['clave']) ?> 
                </h4>
                <span class="badge bg-light text-dark border"><?= lang('Dashboard.' . $etapa['badge_clave']) ?></span>
            </div>
            
            <div class="row g-3">
                <?php foreach ($etapa['cursos'] as $curso): ?>
                    <div class="col-md-6 col-lg-3">
                        <a href="<?= base_url('private/curso/' . $curso['id']) ?>" class="course-card">
                            <div>
                                <h6 class="fw-bold mb-1"><?= lang('Cursos.curso_' . $curso['id']) ?></h6>
                                
                                <?php if(isset($curso['familia_clave']) && $curso['familia_clave'] !== null): ?>
                                    <small class="text-sub"><?= lang('Cursos.' . $curso['familia_clave']) ?></small>
                                <?php else: ?>
                                    <small class="text-sub"><?= $curso['alumnos'] ?> <?= lang('Dashboard.label_alumnos') ?></small>
                                <?php endif; ?>
                            </div>
                            
                            <?php if($curso['pendientes'] > 0): ?>
                                <span class="badge badge-pending rounded-pill px-3"><?= $curso['pendientes'] ?> <?= lang('Dashboard.label_puntos') ?></span>
                            <?php else: ?>
                                <span class="badge badge-ok rounded-pill px-3">0 <?= lang('Dashboard.label_puntos') ?></span>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endforeach; ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>