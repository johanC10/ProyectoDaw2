<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Matrícula - Institut Caparrella</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        /* ==========================================
           1. VARIABLES GLOBALES DE COLOR
           ========================================== */
        :root {
            /* Colores de Marca */
            --brand-primary: #6d79ce; 
            --brand-hover: #5b66b8;
            --brand-success: #24c87e;
            
            /* Fondos y Superficies */
            --bg-page: #f8f9fa;
            --bg-surface: #ffffff;
            
            /* Textos y Bordes */
            --text-main: #212529;
            --text-secondary: #6c757d;
            --border-light: #f1f3f5;
            --border-medium: #e9ecef;
        }

        /* ==========================================
           2. ESTILOS BASE
           ========================================== */
        body {
            background-color: var(--bg-page);
            color: var(--text-main);
            font-family: system-ui, -apple-system, sans-serif;
        }
        .text-sub { color: var(--text-secondary); }
        .bg-surface { background-color: var(--bg-surface); }

        /* ==========================================
           3. BOTONES Y HERO
           ========================================== */
        /* Botón superior Secretaría */
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

        /* Botón Principal Estudiante */
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

        /* Icono Cabecera */
        .hero-icon {
            background: linear-gradient(135deg, var(--brand-primary), #4b58b0);
            width: 90px; 
            height: 90px;
            color: #ffffff;
            font-size: 2.5rem;
        }

        /* ==========================================
           4. TARJETAS DE CARACTERÍSTICAS (Features)
           ========================================== */
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
        
        /* ==========================================
           5. PASOS DEL PROCESO (Rediseño)
           ========================================== */
        .process-card {
            background-color: var(--bg-surface);
            border-radius: 12px;
            border: 1px solid var(--border-medium);
            padding: 2rem 0; /* Padding superior e inferior */
        }
        
        .process-title {
            text-align: center;
            font-weight: 700;
            margin-bottom: 2rem;
            color: var(--text-main);
        }

        /* Contenedor individual de cada paso */
        .process-step {
            display: flex;
            align-items: center;
            padding: 1.25rem 2rem;
            border-bottom: 1px solid var(--border-light);
            max-width: 650px; /* Controla el ancho para que no se estire de lado a lado */
            margin: 0 auto;   /* Centra el bloque entero en la pantalla */
        }
        /* Quita la línea divisoria del último paso */
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
            margin-right: 1.5rem; /* Espacio entre el círculo y el texto */
        }

        .step-text {
            font-size: 1rem;
            color: var(--text-main);
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <a href="<?= base_url('auth/secretaria') ?>" class="btn btn-access btn-sm shadow-sm">
            <i class="bi bi-shield-lock-fill me-1"></i> Accés Secretaria
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
                    Benvingut al sistema oficial de l'Institut Caparrella. Completa la teva matrícula de forma ràpida, segura i totalment digital.
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
                    <h5 class="fw-bold">Procés Ràpid</h5>
                    <p class="text-sub small mb-0">Completa la teva matrícula en només 10 minuts des de qualsevol lloc.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="feature-icon mb-3"><i class="bi bi-shield-check"></i></div>
                    <h5 class="fw-bold">Dades Segures</h5>
                    <p class="text-sub small mb-0">Protecció de dades garantida segons la normativa vigent.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="feature-icon mb-3"><i class="bi bi-cloud-arrow-up"></i></div>
                    <h5 class="fw-bold">100% Online</h5>
                    <p class="text-sub small mb-0">Gestió digital: oblida't de portar papers físics al centre.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4 card-feature">
                    <div class="feature-icon mb-3"><i class="bi bi-envelope-at"></i></div>
                    <h5 class="fw-bold">Confirmació</h5>
                    <p class="text-sub small mb-0">Rebràs el teu resguard de matrícula un cop acabat el procés.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-lg-7">
                <div class="process-card shadow-sm">
                    
                    <h2 class="h4 process-title">Pasos del Proceso</h2>
                    
                    <div class="process-step">
                        <div class="step-number">1</div>
                        <p class="step-text">Identificación con DNI/NIE y validación de correo.</p>
                    </div>

                    <div class="process-step">
                        <div class="step-number">2</div>
                        <p class="step-text">Revisión de datos personales del alumno y tutores.</p>
                    </div>

                    <div class="process-step">
                        <div class="step-number">3</div>
                        <p class="step-text">Carga de DNI/NIE y tarjeta sanitaria.</p>
                    </div>

                    <div class="process-step">
                        <div class="step-number">4</div>
                        <p class="step-text">Firma de autorización de derechos de imagen.</p>
                    </div>

                    <div class="process-step">
                        <div class="step-number">5</div>
                        <p class="step-text">Elección de asignaturas optativas y servicios del ciclo.</p>
                    </div>

                    <div class="process-step">
                        <div class="step-number">6</div>
                        <p class="step-text">Aplicación de bonificaciones y adjuntar pago.</p>
                    </div>

                    <div class="process-step">
                        <div class="step-number">7</div>
                        <p class="step-text">Resumen final y confirmación de la matrícula.</p>
                    </div>

                </div>
            </div>
        </div>

    </main>

    <footer class="text-center py-4 mt-5 text-sub border-top bg-surface">
        <small>&copy; 2026 Institut Caparrella - Lleida. Tots els drets reservats.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>