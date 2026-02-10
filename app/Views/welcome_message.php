<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Matrícula - Institut Caparrella</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --bs-primary: #0d6efd; /* Puedes cambiar este azul por el color corporativo del centro */
        }
        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--bs-primary), #004db3);
        }
        .card-feature:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
        .step-number {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-light">

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <a href="<?= base_url('auth/secretaria') ?>" class="btn btn-outline-dark btn-sm shadow-sm bg-blue">
            <i class="bi bi-key-fill me-1"></i> Acceso Secretaría
        </a>
    </div>

    <main class="container py-5">
        <div class="row justify-content-center text-center py-5">
            <div class="col-lg-8">
                <div class="mx-auto bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center mb-4 shadow" style="width: 90px; height: 90px;">
                    <i class="bi bi-mortarboard-fill text-white fs-1"></i>
                </div>
                <h1 class="display-5 fw-bold text-dark mb-3">Portal de Inscripción Escolar</h1>
                <p class="lead text-secondary mb-4">
                    Bienvenido al sistema oficial del Institut Caparrella. Completa tu matrícula de forma rápida, segura y totalmente digital.
                </p>
                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                    <a href="<?= base_url('auth/estudiante') ?>" class="btn btn-primary btn-lg px-5 py-3 shadow">Comenzar Inscripción</a>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5 pb-5">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="text-primary mb-3"><i class="bi bi-clock-history fs-2"></i></div>
                    <h5 class="fw-bold">Proceso Rápido</h5>
                    <p class="text-muted small mb-0">Completa tu inscripción en solo 10 minutos desde cualquier lugar.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="text-primary mb-3"><i class="bi bi-shield-check fs-2"></i></div>
                    <h5 class="fw-bold">Datos Seguros</h5>
                    <p class="text-muted small mb-0">Protección de datos garantizada según la normativa vigente.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="text-primary mb-3"><i class="bi bi-cloud-arrow-up fs-2"></i></div>
                    <h5 class="fw-bold">100% Online</h5>
                    <p class="text-muted small mb-0">Gestión digital: olvídate de traer papeles físicos al centro.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="text-primary mb-3"><i class="bi bi-envelope-at fs-2"></i></div>
                    <h5 class="fw-bold">Confirmación</h5>
                    <p class="text-muted small mb-0">Recibirás tu resguardo de matrícula directamente en tu email.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-10 col-lg-8">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-header bg-white py-3 border-0">
                        <h2 class="h4 fw-bold mb-0 text-center">Pasos del Proceso</h2>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center py-3 border-light">
                            <span class="step-number bg-primary text-white rounded-circle me-3">1</span>
                            <div>Identificación con DNI/NIE y validación de correo.</div>
                        </div>
                        <div class="list-group-item d-flex align-items-center py-3 border-light">
                            <span class="step-number bg-primary text-white rounded-circle me-3">2</span>
                            <div>Revisión de datos personales del alumno y tutores.</div>
                        </div>
                        <div class="list-group-item d-flex align-items-center py-3 border-light">
                            <span class="step-number bg-primary text-white rounded-circle me-3">3</span>
                            <div>Carga de DNI/NIE y tarjeta sanitaria.</div>
                        </div>
                        <div class="list-group-item d-flex align-items-center py-3 border-light">
                            <span class="step-number bg-primary text-white rounded-circle me-3">4</span>
                            <div>Firma de autorización de derechos de imagen.</div>
                        </div>
                        <div class="list-group-item d-flex align-items-center py-3 border-light">
                            <span class="step-number bg-primary text-white rounded-circle me-3">5</span>
                            <div>Elección de asignaturas optativas y servicios adicionales.</div>
                        </div>
                        <div class="list-group-item d-flex align-items-center py-3 border-light">
                            <span class="step-number bg-primary text-white rounded-circle me-3">6</span>
                            <div>Aplicación de bonificaciones y adjuntar resguardo de pago.</div>
                        </div>
                        <div class="list-group-item d-flex align-items-center py-3 border-light">
                            <span class="step-number bg-primary text-white rounded-circle me-3">7</span>
                            <div>Resumen final y confirmación de la matrícula.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center py-4 mt-5 text-muted border-top bg-white">
        <small>&copy; 2026 Institut Caparrella - Lleida. Todos los derechos reservados.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>