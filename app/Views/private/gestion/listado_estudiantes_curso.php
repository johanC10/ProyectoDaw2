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
            background-color: var(--bg-body);
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
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
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
            border-bottom: 1px solid var(--border-color);
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
        
        <div class="header-section d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <a href="<?= base_url('private/dashboard') ?>" class="btn-back"><i class="bi bi-arrow-left"></i></a>
                <div>
                    <h2 class="fw-bold mb-0">1r Desenvolupament d'Aplicacions Web (DAW)</h2>
                    <span class="text-muted small">Llistat de matrícules del curs actual</span>
                </div>
            </div>
            <div>
                <a href="<?= base_url('private/matricula/crear/10') ?>" class="btn-create shadow-sm">
                    <i class="bi bi-plus-lg"></i> Nova Matrícula
                </a>
            </div>
        </div>

        <div class="filter-panel">
            <form action="" method="get">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label text-muted small fw-semibold mb-1">Cercar</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                            <input type="text" name="q" class="form-control custom-input border-start-0 ps-0" placeholder="Nom, DNI, o Núm. Matrícula...">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label text-muted small fw-semibold mb-1">Estat</label>
                        <select name="estat" class="form-select custom-input">
                            <option value="">Tots els estats</option>
                            <option value="pendent">Pendent de revisar</option>
                            <option value="validat">Validada</option>
                            <option value="rebutjat">Rebutjada / Esmenes</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label text-muted small fw-semibold mb-1">Data Sol·licitud</label>
                        <input type="date" name="data" class="form-control custom-input">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-light border w-100 fw-medium">
                            <i class="bi bi-funnel me-1"></i> Filtrar
                        </button>
                    </div>
                </div>
            </form>
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