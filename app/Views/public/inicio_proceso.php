<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Matrícula - Institut Caparrella</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        /* 1. Variables Globales de Color */
        :root {
            --brand-primary: #6d79ce; 
            --brand-hover: #5b66b8;
            --bg-page: #f8f9fa;
            --bg-surface: #ffffff;
            --text-main: #212529;
            --text-secondary: #6c757d;
            --border-light: #f1f3f5;
        }

        /* 2. Estilos Generales */
        body {
            background-color: var(--bg-page);
            color: var(--text-main);
        }
        .text-sub {
            color: var(--text-secondary);
        }
        .bg-surface {
            background-color: var(--bg-surface);
        }

        
        .btn-access {
            color: #ffffff;
            border: 1px solid var(--brand-primary);
            background-color: #24c87e;
        }
        .btn-access:hover {
            background-color: var(--brand-primary);
            color: #ffffff;
        }
        .btn-start {
            background-color: var(--brand-primary);
            color: #ffffff;
            border: none;
        }
        .btn-start:hover {
            background-color: #24c87e;
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
            transition: all 0.3s ease;
        }
        .card-feature:hover {
            transform: translateY(-5px);
        }
        .feature-icon {
            color: #24c87e;
            font-size: 2rem;
        }
        
        
        .step-item {
            border-color: var(--border-light);
            background-color: var(--bg-surface);
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
        }
    </style>
</head>
<body>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <a href="<?= base_url('auth/secretaria') ?>" class="btn btn-access btn-sm shadow-sm">
            <i class="bi bi-shield-lock-fill me-1"></i> Acceso Secretaría
        </a>
    </div>

    <main class="container py-5">
        <div class="row justify-content-center text-center py-5">
            <div class="col-lg-8">
                <div class="mx-auto hero-icon rounded-circle d-flex align-items-center justify-content-center mb-4 shadow">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <h1 class="display-5 fw-bold mb-3">Portal de Matrícula Escolar</h1>
                <p class="lead text-sub mb-4">
                    Bienvenido al sistema oficial del Institut Caparrella. Completa tu matrícula de forma rápida, segura y totalmente digital.
                </p>
                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                    <a href="<?= base_url('auth/estudiante') ?>" class="btn btn-start btn-lg px-5 py-3 shadow">Comenzar Matrícula</a>   
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5 pb-5">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="feature-icon mb-3"><i class="bi bi-clock-history"></i></div>
                    <h5 class="fw-bold">Proceso Rápido</h5>
                    <p class="text-sub small mb-0">Completa tu matrícula en solo 10 minutos desde cualquier lugar.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="feature-icon mb-3"><i class="bi bi-shield-check"></i></div>
                    <h5 class="fw-bold">Datos Seguros</h5>
                    <p class="text-sub small mb-0">Protección de datos garantizada según la normativa vigente.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="feature-icon mb-3"><i class="bi bi-cloud-arrow-up"></i></div>
                    <h5 class="fw-bold">100% Online</h5>
                    <p class="text-sub small mb-0">Gestión digital: olvídate de traer papeles físicos al centro.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="feature-icon mb-3"><i class="bi bi-envelope-at"></i></div>
                    <h5 class="fw-bold">Confirmación</h5>
                    <p class="text-sub small mb-0">Recibirás tu resguardo de matrícula una vez terminado el proceso.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-10 col-lg-8">
                <div class="card border-0 shadow-sm overflow-hidden bg-surface">
                    <div class="card-header bg-surface py-3 border-0">
                        <h2 class="h4 fw-bold mb-0 text-center">Pasos del Proceso</h2>
                    </div>
                    <div class="list-group list-group-flush">
                        
                        <div class="list-group-item d-flex justify-content-center py-3 px-4 step-item">
                            <div class="d-flex align-items-center" style="width: 100%; max-width: 500px;">
                                <span class="step-number rounded-circle me-3 flex-shrink-0">1</span>
                                <div class="flex-grow-1">Identificación con DNI/NIE y validación de correo.</div>
                            </div>
                        </div>

                        <div class="list-group-item d-flex justify-content-center py-3 px-4 step-item">
                            <div class="d-flex align-items-center" style="width: 100%; max-width: 500px;">
                                <span class="step-number rounded-circle me-3 flex-shrink-0">2</span>
                                <div class="flex-grow-1">Revisión de datos personales del alumno y tutores.</div>
                            </div>
                        </div>

                        <div class="list-group-item d-flex justify-content-center py-3 px-4 step-item">
                            <div class="d-flex align-items-center" style="width: 100%; max-width: 500px;">
                                <span class="step-number rounded-circle me-3 flex-shrink-0">3</span>
                                <div class="flex-grow-1">Carga de DNI/NIE y tarjeta sanitaria.</div>
                            </div>
                        </div>

                        <div class="list-group-item d-flex justify-content-center py-3 px-4 step-item">
                            <div class="d-flex align-items-center" style="width: 100%; max-width: 500px;">
                                <span class="step-number rounded-circle me-3 flex-shrink-0">4</span>
                                <div class="flex-grow-1">Firma de autorización de derechos de imagen.</div>
                            </div>
                        </div>

                        <div class="list-group-item d-flex justify-content-center py-3 px-4 step-item">
                            <div class="d-flex align-items-center" style="width: 100%; max-width: 500px;">
                                <span class="step-number rounded-circle me-3 flex-shrink-0">5</span>
                                <div class="flex-grow-1">Elección de asignaturas optativas y servicios del ciclo.</div>
                            </div>
                        </div>

                        <div class="list-group-item d-flex justify-content-center py-3 px-4 step-item">
                            <div class="d-flex align-items-center" style="width: 100%; max-width: 500px;">
                                <span class="step-number rounded-circle me-3 flex-shrink-0">6</span>
                                <div class="flex-grow-1">Aplicación de bonificaciones y adjuntar pago.</div>
                            </div>
                        </div>

                        <div class="list-group-item d-flex justify-content-center py-3 px-4 step-item">
                            <div class="d-flex align-items-center" style="width: 100%; max-width: 500px;">
                                <span class="step-number rounded-circle me-3 flex-shrink-0">7</span>
                                <div class="flex-grow-1">Resumen final y confirmación de la matrícula.</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center py-4 mt-5 text-sub border-top bg-surface">
        <small>&copy; 2026 Institut Caparrella - Lleida. Todos los derechos reservados.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>