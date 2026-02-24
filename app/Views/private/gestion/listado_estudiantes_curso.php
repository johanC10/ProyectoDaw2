<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Matrículas - Institut Caparrella</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        /* Variables Globales de Color */
        :root {
            --brand-primary: #6d79ce; 
            --brand-hover: #5b66b8;
            --brand-success: #24c87e;
            --brand-warning: #f5a623;
            --brand-danger: #ef233c;
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
        .bg-surface { background-color: var(--bg-surface); }

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
            color: var(--brand-danger);
            border: 1px solid var(--brand-danger);
            background-color: transparent;
            padding: 0.4rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-logout:hover { background-color: var(--brand-danger); color: #ffffff; }

        /* Botón Volver */
        .btn-back {
            color: var(--text-secondary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-weight: 500;
            transition: color 0.2s;
        }
        .btn-back:hover { color: var(--brand-primary); }

        /* Encabezado del Curso */
        .course-header {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.01);
        }

        /* Tabla de Matrículas */
        .table-card {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }
        .custom-table {
            margin-bottom: 0;
        }
        .custom-table th {
            background-color: var(--bg-page);
            color: var(--text-secondary);
            font-weight: 600;
            border-bottom: 2px solid var(--border-light);
            padding: 1rem 1.5rem;
        }
        .custom-table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-light);
            color: var(--text-main);
        }
        .custom-table tr:last-child td {
            border-bottom: none;
        }
        .custom-table tbody tr:hover {
            background-color: rgba(109, 121, 206, 0.03);
        }

        /* Badges de Estado */
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }
        .badge-pending {
            background-color: rgba(245, 166, 35, 0.15);
            color: #d48a1b;
        }
        .badge-ok {
            background-color: rgba(36, 200, 126, 0.15);
            color: #1e9d63;
        }
        .badge-rejected {
            background-color: rgba(239, 35, 60, 0.15);
            color: #c9182b;
        }

        /* Botón de Acción (Revisar) */
        .btn-action {
            background-color: rgba(109, 121, 206, 0.1);
            color: var(--brand-primary);
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-action:hover {
            background-color: var(--brand-primary);
            color: #ffffff;
        }
    </style>
</head>
<body>

    <header class="top-navbar shadow-sm sticky-top">
        <div class="d-flex align-items-center gap-2">
            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-building text-brand"></i>
            </div>
            <h5 class="mb-0 fw-bold">Secretaría | <span class="text-sub fw-normal">Institut Caparrella</span></h5>
        </div>
        <div class="d-flex align-items-center gap-4">
            <span class="text-sub"><i class="bi bi-person-circle me-1"></i> Admin_Secretaria</span>
            <a href="<?= base_url('logout') ?>" class="btn-logout"><i class="bi bi-box-arrow-right me-1"></i> Salir</a>
        </div>
    </header>

    <main class="container py-4">
        
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
                <table class="table custom-table table-borderless">
                    <thead>
                        <tr>
                            <th>DNI / NIE</th>
                            <th>Alumne</th>
                            <th>Data Sol·licitud</th>
                            <th>Estat</th>
                            <th class="text-end">Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-semibold">12345678A</td>
                            <td>
                                <div class="fw-bold">García Pérez, Laura</div>
                                <div class="text-sub small">laura.garcia@email.com</div>
                            </td>
                            <td>24/06/2026</td>
                            <td><span class="status-badge badge-pending"><i class="bi bi-clock me-1"></i> Pendent</span></td>
                            <td class="text-end">
                                <a href="<?= base_url('private/validacion/1') ?>" class="btn-action">Revisar</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="fw-semibold">87654321B</td>
                            <td>
                                <div class="fw-bold">Martínez Costa, Marc</div>
                                <div class="text-sub small">marc.mart@email.com</div>
                            </td>
                            <td>23/06/2026</td>
                            <td><span class="status-badge badge-ok"><i class="bi bi-check-circle me-1"></i> Validat</span></td>
                            <td class="text-end">
                                <a href="<?= base_url('private/validacion/2') ?>" class="btn-action">Veure Fitxa</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="fw-semibold">X1234567C</td>
                            <td>
                                <div class="fw-bold">Popescu, Andrei</div>
                                <div class="text-sub small">andrei.pop@email.com</div>
                            </td>
                            <td>23/06/2026</td>
                            <td><span class="status-badge badge-rejected"><i class="bi bi-exclamation-octagon me-1"></i> Manca Doc.</span></td>
                            <td class="text-end">
                                <a href="<?= base_url('private/validacion/3') ?>" class="btn-action">Revisar</a>
                            </td>
                        </tr>

                        </tbody>
                </table>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>