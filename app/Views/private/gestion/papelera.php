<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papelera de Matrículas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
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

        .text-muted, .text-sub { color: var(--text-secondary) !important; }
        
        .top-navbar {
            background-color: var(--bg-surface);
            border-bottom: 1px solid var(--border-light);
            padding: 0.75rem 2rem;
        }

        .btn-logout {
            color: #ef233c;
            text-decoration: none;
            font-weight: 500;
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .btn-logout:hover {
            background-color: #fef2f2;
        }

        .header-section {
            padding: 2rem 0 1.5rem 0;
        }

        .btn-back {
            color: var(--text-main);
            text-decoration: none;
            font-size: 1.25rem;
            margin-right: 1rem;
            transition: color 0.2s;
        }

        .btn-back:hover {
            color: var(--brand-primary);
        }

        .table-card {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .table th {
            background-color: var(--bg-page);
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-light);
        }

        .table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-light);
            color: var(--text-main);
        }

        .table tbody tr:hover {
            background-color: var(--bg-page);
        }

        .status-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .bg-pending { background-color: #fef3c7; color: #d97706; }
        .bg-valid { background-color: #d1fae5; color: #059669; }
        .bg-rejected { background-color: #fee2e2; color: #dc2626; }
        
        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
            color: var(--text-secondary);
        }
        .empty-state i {
            font-size: 3rem;
            color: var(--border-light);
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    <header class="top-navbar d-flex justify-content-between align-items-center sticky-top">
        <div class="d-flex align-items-center gap-2">
            <h5 class="mb-0 fw-bold">Secretaria | <span class="text-muted fw-normal">Institut Caparrella</span></h5>
        </div>
        <div class="d-flex align-items-center gap-4">
            <span class="text-muted d-none d-md-inline"><i class="bi bi-person-circle me-1"></i> Admin</span>
            <a href="<?= base_url('logout_secretaria') ?>" class="btn-logout"><i class="bi bi-box-arrow-right me-1"></i> Salir</a>
        </div>
    </header>

    <main class="container">

        <div class="header-section d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <a href="javascript:history.back()" class="btn-back"><i class="bi bi-arrow-left"></i></a>
                <div>
                    <h2 class="fw-bold mb-0">Papelera de Matrículas</h2>
                    <span class="text-muted small">Matrículas archivadas o eliminadas</span>
                </div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="table-card mt-3">
            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <thead>
                        <tr>
                            <th>Identificador</th>
                            <th>Alumno</th>
                            <th>Curso</th>
                            <th>Estado Original</th>
                            <th>Fecha Eliminación</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($alumnos)): ?>
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="bi bi-trash"></i>
                                        <h5>La papelera está vacía</h5>
                                        <p>No hay matrículas archivadas en este momento.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($alumnos as $alumne): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold"><?= esc($alumne['dni']) ?></div>
                                    <div class="text-muted small"><?= esc($alumne['num_matricula']) ?></div>
                                </td>
                                <td>
                                    <div class="fw-bold"><?= esc($alumne['nombre']) ?></div>
                                </td>
                                <td class="text-muted"><?= esc($alumne['curso_nombre']) ?></td>
                                <td>
                                    <?php if ($alumne['estat'] === 'pendent'): ?>
                                        <span class="status-badge bg-pending">Pendiente</span>
                                    <?php elseif ($alumne['estat'] === 'validat'): ?>
                                        <span class="status-badge bg-valid">Validada</span>
                                    <?php else: ?>
                                        <span class="status-badge bg-rejected">Rechazada</span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="text-danger"><i class="bi bi-clock-history me-1"></i> <?= $alumne['fecha_borrado'] ?></span></td>
                                <td class="text-end">
                                    <form action="<?= base_url('private/matricula/restaurar/' . $alumne['id_matricula']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('¿Seguro que deseas restaurar esta matrícula a su curso original?');">
                                            <i class="bi bi-arrow-counterclockwise"></i> Restaurar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
