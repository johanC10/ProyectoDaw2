<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llistat de Matrícules - Secretaria</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        /* Variables Globales de Color */
        :root {
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            
            --color-primary: #3b82f6;
            --color-primary-hover: #2563eb;
            --color-success: #10b981;
            --color-warning: #f59e0b;
            --color-danger:  #ef4444;
            --color-light:   #f1f5f9;
        }

        body {
            background-color: var(--bg-page);
            background-color: var(--bg-page);
            color: var(--text-main);
            font-family: system-ui, -apple-system, sans-serif;
        }

        /* Cabecera y Navegación */
        .top-navbar {
            background-color: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
            padding: 0.75rem 2rem;
        }
        
        .lang-selector {
            border: 1px solid var(--border-color);
            background-color: var(--bg-body);
            border-radius: 6px;
            padding: 0.3rem 0.8rem;
            color: var(--text-main);
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-logout {
            color: var(--color-danger);
            text-decoration: none;
            font-weight: 500;
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
            transition: background 0.2s;
        }
        .btn-logout:hover { background-color: #fef2f2; }

        /* Controles y Botones */
        .header-section { padding: 2rem 0 1.5rem 0; }
        
        .btn-back {
            color: var(--text-main);
            text-decoration: none;
            font-size: 1.25rem;
            margin-right: 1rem;
            transition: color 0.2s;
        }
        .btn-back:hover { color: var(--color-primary); }

        .btn-create {
            background-color: var(--color-primary);
            color: #ffffff;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.2s;
        }
        .btn-create:hover { background-color: var(--color-primary-hover); color: #ffffff; }

        /* Panel de Filtros */
        .filter-panel {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        
        .custom-input {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background-color: var(--bg-body);
        }
        .custom-input:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Tabla de Datos */
        .table-card {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-light);
            background-color: var(--bg-surface);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        
        .table th {
            background-color: var(--color-light);
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-light);
            border-bottom: 1px solid var(--border-light);
            color: var(--text-main);
        }

        .table tr:last-child td { border-bottom: none; }
        .table tbody tr:hover { background-color: var(--color-light); }

        /* Badges y Enlaces de Tabla */
        .status-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .bg-pending { background-color: #fef3c7; color: #d97706; }
        .bg-valid { background-color: #d1fae5; color: #059669; }
        
        .action-link {
            color: var(--color-primary);
            font-weight: 500;
            text-decoration: none;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            transition: background 0.2s;
        }
        .action-link:hover { background-color: #eff6ff; }
    </style>
</head>
<body>

    <header class="top-navbar d-flex justify-content-between align-items-center sticky-top">
        <div class="d-flex align-items-center gap-2">
            <h5 class="mb-0 fw-bold">Secretaria | <span class="text-muted fw-normal">Institut Caparrella</span></h5>
        </div>
        <div class="d-flex align-items-center gap-4">
            <div class="dropdown">
                <button class="lang-selector dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-globe"></i> CA
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                    <li><a class="dropdown-item fw-bold" href="#">Català (CA)</a></li>
                    <li><a class="dropdown-item" href="#">Español (ES)</a></li>
                    <li><a class="dropdown-item" href="#">English (EN)</a></li>
                </ul>
            </div>
            
            <div class="d-none d-md-block" style="width: 1px; height: 24px; background-color: var(--border-color);"></div>
            
            <span class="text-muted d-none d-md-inline"><i class="bi bi-person-circle me-1"></i> Admin</span>
            <a href="<?= base_url('logout_secretaria') ?>" class="btn-logout"><i class="bi bi-box-arrow-right me-1"></i> Sortir</a>
        </div>
    </header>

    <main class="container">
        
        <div class="mb-3">
            <a href="<?= base_url('private/dashboard') ?>" class="btn-back">
                <i class="bi bi-arrow-left me-2"></i> Tornar al panell principal
            </a>
        </div>

        <div class="course-header d-flex justify-content-between align-items-center">
            <div>
                <span class="text-sub fw-bold text-uppercase" style="letter-spacing: 1px; font-size: 0.8rem;">CFGS - Grau Superior</span>
                <h2 class="fw-bold text-brand mt-1 mb-0">1r Desenvolupament d'Aplicacions Web (DAW)</h2>
            </div>
            <div class="text-end">
                <div class="fs-4 fw-bold">30</div>
                <div class="text-sub small">Total Sol·licituds</div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Llistat d'Alumnes</h4>
            <div class="d-flex gap-2">
                <input type="text" class="form-control" placeholder="Cercar per DNI o Nom..." style="width: 250px;">
                <select class="form-select" style="width: 150px;">
                    <option value="">Tots els estats</option>
                    <option value="pending">Pendents</option>
                    <option value="ok">Validats</option>
                </select>
            </div>
        </div>

        <div class="table-card">
            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <thead>
                        <tr>
                            <th>Identificador</th>
                            <th>Alumne</th>
                            <th>Data</th>
                            <th>Documents</th>
                            <th>Estat</th>
                            <th class="text-end">Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="fw-bold">12345678A</div>
                                <div class="text-muted small">#MAT-2026-0015</div>
                            </td>
                            <td>
                                <div class="fw-bold">García Pérez, Laura</div>
                                <div class="text-muted small">laura.garcia@email.com</div>
                            </td>
                            <td class="text-muted">25/02/2026</td>
                            <td>
                                <i class="bi bi-file-earmark-pdf text-danger me-1" title="DNI Adjuntat"></i>
                                <i class="bi bi-file-earmark-image text-primary me-1" title="TSI Adjuntada"></i>
                            </td>
                            <td><span class="status-badge bg-pending">Pendent</span></td>
                            <td class="text-end">
                                <a href="<?= base_url('private/validacion/15') ?>" class="action-link">
                                    Revisar <i class="bi bi-chevron-right ms-1 small"></i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="fw-bold">87654321B</div>
                                <div class="text-muted small">#MAT-2026-0008</div>
                            </td>
                            <td>
                                <div class="fw-bold">Martínez Costa, Marc</div>
                                <div class="text-muted small">marc.mart@email.com</div>
                            </td>
                            <td class="text-muted">23/02/2026</td>
                            <td>
                                <i class="bi bi-file-earmark-pdf text-danger me-1"></i>
                                <i class="bi bi-file-earmark-image text-primary me-1"></i>
                                <i class="bi bi-receipt text-success me-1" title="Pagament Adjuntat"></i>
                            </td>
                            <td><span class="status-badge bg-valid">Validada</span></td>
                            <td class="text-end">
                                <a href="<?= base_url('private/validacion/8') ?>" class="action-link text-muted">
                                    Veure Fitxa <i class="bi bi-chevron-right ms-1 small"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>