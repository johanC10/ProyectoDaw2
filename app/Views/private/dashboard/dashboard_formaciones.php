<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Secretaría - Institut Caparrella</title>
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

        .text-sub {
            color: var(--text-secondary);
        }

        .text-brand {
            color: var(--brand-primary);
        }

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

        .btn-logout:hover {
            background-color: #ef233c;
            color: #ffffff;
        }

        /* Tarjetas de Estadísticas Globales */
        .stat-card {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
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

        .icon-blue {
            background-color: rgba(109, 121, 206, 0.1);
            color: var(--brand-primary);
        }

        .icon-orange {
            background-color: rgba(245, 166, 35, 0.1);
            color: var(--brand-warning);
        }

        .icon-green {
            background-color: rgba(36, 200, 126, 0.1);
            color: var(--brand-success);
        }

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

        /* Botón de anclaje (Pin) */
        .btn-pin {
            position: absolute;
            top: -12px;
            right: -12px;
            background: white;
            border: 1px solid var(--border-light);
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.2s;
            z-index: 10;
        }

        .btn-pin:hover {
            color: var(--brand-primary);
            transform: scale(1.1);
        }

        .btn-pin.pinned {
            background: #5b66b8;
            color: white;
            border-color: #5b66b8;
        }

        .btn-pin i {
            display: inline-block;
            transition: transform 0.3s ease;
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
            <span class="text-sub"><i class="bi bi-person-circle me-1"></i> Admin</span>
            <a href="<?= base_url('logout_secretaria') ?>" class="btn-logout"><i class="bi bi-box-arrow-right me-1"></i> Salir</a>
        </div>
    </header>

    <main class="container py-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <h4 class="fw-bold mb-3 mb-md-0 text-brand"><i class="bi bi-grid-1x2 me-2"></i>
                <?= lang('Dashboard.vista_general') ?? 'Vista General' ?>
            </h4>
            <div class="input-group shadow-sm" style="max-width: 350px;">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input type="text" id="searchInput" class="form-control border-start-0 ps-0"
                    placeholder="<?= lang('Dashboard.buscar_ph') ?? 'Buscar formación...' ?>">
            </div>
        </div>

        <div class="row g-4 mb-2">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon icon-blue"><i class="bi bi-folder2-open"></i></div>
                    <div>
                        <p class="text-sub small mb-0 fw-semibold">Total Matrículas</p>
                        <h3 class="fw-bold mb-0">842</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon icon-orange"><i class="bi bi-hourglass-split"></i></div>
                    <div>
                        <p class="text-sub small mb-0 fw-semibold">Pendientes de Validar</p>
                        <h3 class="fw-bold mb-0">124</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon icon-green"><i class="bi bi-check-circle"></i></div>
                    <div>
                        <p class="text-sub small mb-0 fw-semibold">Validadas (Aceptadas)</p>
                        <h3 class="fw-bold mb-0">718</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECCIÓN DE FAVORITOS (ANCLADOS) -->
        <div id="favorites-section" style="display: none;">
            <div class="etapa-header d-flex justify-content-between align-items-end" style="margin-top: 2rem;">
                <h4 class="fw-bold mb-0" style="color: #5b66b8;">
                    <i class="bi bi-pin-angle-fill me-2" style="display: inline-block;"></i>
                    <?= lang('Dashboard.formaciones_ancladas') ?? 'Formaciones Ancladas' ?>
                </h4>
            </div>
            <div class="row g-3" id="favorites-container">
                <!-- Se llenará con JS -->
            </div>
        </div>

        <div class="etapa-header d-flex justify-content-between align-items-end">
            <h4 class="fw-bold text-brand mb-0"><i class="bi bi-backpack me-2"></i>E.S.O.</h4>
            <span class="badge bg-light text-dark border">4 Cursos</span>
        </div>
        <div class="row g-3">
            <div class="col-md-6 col-lg-3">
                <a href="<?= base_url('private/curso/1') ?>" class="course-card">
                    <div>
                        <h6 class="fw-bold mb-1">1r d'ESO</h6>
                        <small class="text-sub">90 Alumnes</small>
                    </div>
                    <span class="badge badge-pending rounded-pill px-3">12 Pts.</span>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="<?= base_url('private/curso/2') ?>" class="course-card">
                    <div>
                        <h6 class="fw-bold mb-1">2n d'ESO</h6>
                        <small class="text-sub">85 Alumnes</small>
                    </div>
                    <span class="badge badge-ok rounded-pill px-3">0 Pts.</span>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="<?= base_url('private/curso/3') ?>" class="course-card">
                    <div>
                        <h6 class="fw-bold mb-1">3r d'ESO</h6>
                        <small class="text-sub">88 Alumnes</small>
                    </div>
                    <span class="badge badge-pending rounded-pill px-3">5 Pts.</span>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="<?= base_url('private/curso/4') ?>" class="course-card">
                    <div>
                        <h6 class="fw-bold mb-1">4t d'ESO</h6>
                        <small class="text-sub">82 Alumnes</small>
                    </div>
                    <span class="badge badge-ok rounded-pill px-3">0 Pts.</span>
                </a>
            </div>
        </div>

        <div class="etapa-header d-flex justify-content-between align-items-end">
            <h4 class="fw-bold text-brand mb-0"><i class="bi bi-journal-bookmark me-2"></i>Batxillerat</h4>
            <span class="badge bg-light text-dark border">2 Cursos</span>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <a href="<?= base_url('private/curso/5') ?>" class="course-card">
                    <div>
                        <h6 class="fw-bold mb-1">1r de Batxillerat</h6>
                        <small class="text-sub">60 Alumnes</small>
                    </div>
                    <span class="badge badge-pending rounded-pill px-3">8 Pts.</span>
                </a>
            </div>
            <div class="col-md-6">
                <a href="<?= base_url('private/curso/6') ?>" class="course-card">
                    <div>
                        <h6 class="fw-bold mb-1">2n de Batxillerat</h6>
                        <small class="text-sub">55 Alumnes</small>
                    </div>
                    <span class="badge badge-ok rounded-pill px-3">0 Pts.</span>
                </a>
            </div>
        </div>

        <div class="etapa-header d-flex justify-content-between align-items-end">
            <h4 class="fw-bold text-brand mb-0"><i class="bi bi-tools me-2"></i>CFGM - Grau Mitjà</h4>
            <span class="badge bg-light text-dark border">Múltiples especialitats</span>
        </div>
        <div class="row g-3">
            <div class="col-md-6 col-lg-4">
                <a href="<?= base_url('private/curso/7') ?>" class="course-card">
                    <div>
                        <h6 class="fw-bold mb-1">Preimpressió digital</h6>
                        <small class="text-sub">Arts Gràfiques</small>
                    </div>
                    <span class="badge badge-pending rounded-pill px-3">3 Pts.</span>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="<?= base_url('private/curso/8') ?>" class="course-card">
                    <div>
                        <h6 class="fw-bold mb-1">Electromecànica de vehicles</h6>
                        <small class="text-sub">Automoció</small>
                    </div>
                    <span class="badge badge-ok rounded-pill px-3">0 Pts.</span>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="<?= base_url('private/curso/9') ?>" class="course-card">
                    <div>
                        <h6 class="fw-bold mb-1">Vídeo, discjòquei i so</h6>
                        <small class="text-sub">Imatge i So</small>
                    </div>
                    <span class="badge badge-pending rounded-pill px-3">7 Pts.</span>
                </a>
            </div>
        </div>

        <div class="etapa-header d-flex justify-content-between align-items-end">
            <h4 class="fw-bold text-brand mb-0"><i class="bi bi-laptop me-2"></i>CFGS - Grau Superior</h4>
            <span class="badge bg-light text-dark border">Múltiples especialitats</span>
        </div>
        <div class="row g-3">
            <div class="col-md-6 col-lg-6">
                <a href="<?= base_url('private/curso/10') ?>" class="course-card">
                    <div>
                        <h6 class="fw-bold mb-1">Desenvolupament d'Aplicacions Web (DAW)</h6>
                        <small class="text-sub">Informàtica i Comunicacions</small>
                    </div>
                    <span class="badge badge-pending rounded-pill px-3">18 Pts.</span>
                </a>
            </div>
            <div class="col-md-6 col-lg-6">
                <a href="<?= base_url('private/curso/11') ?>" class="course-card">
                    <div>
                        <h6 class="fw-bold mb-1">Automoció</h6>
                        <small class="text-sub">Transport i Manteniment de Vehicles</small>
                    </div>
                    <span class="badge badge-ok rounded-pill px-3">0 Pts.</span>
                </a>
            </div>
        </div>

        <div class="etapa-header d-flex justify-content-between align-items-end">
            <h4 class="fw-bold text-brand mb-0"><i class="bi bi-pc-display me-2"></i>FP Bàsica / PFI</h4>
            <span class="badge bg-light text-dark border">1 Curs</span>
        </div>
        <div class="row g-3">
            <div class="col-md-6 col-lg-6">
                <a href="<?= base_url('private/curso/12') ?>" class="course-card">
                    <div>
                        <h6 class="fw-bold mb-1">Informàtica d'oficina</h6>
                        <small class="text-sub">FP Bàsica</small>
                    </div>
                    <span class="badge badge-pending rounded-pill px-3">2 Pts.</span>
                </a>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Logica para Anclar (Favorites) en LocalStorage
        const userId = '<?= esc(session()->get('secretaria_id') ?? 'guest') ?>';
        const storageKey = 'pinned_courses_' + userId;

        function getPinned() {
            return JSON.parse(localStorage.getItem(storageKey) || '[]');
        }

        function setPinned(arr) {
            localStorage.setItem(storageKey, JSON.stringify(arr));
        }

        function togglePin(id, event) {
            event.preventDefault();
            event.stopPropagation();
            let pinned = getPinned();
            if (pinned.includes(id)) {
                pinned = pinned.filter(p => p !== id);
            } else {
                pinned.push(id);
            }
            setPinned(pinned);
            renderPins();
        }

        function renderPins() {
            let pinned = getPinned();
            // Buscar todos los cursos que no esten en el contenedor de favoritos
            const allCourses = Array.from(document.querySelectorAll('.course-item')).filter(el => !el.closest('#favorites-container'));
            const favContainer = document.getElementById('favorites-container');
            const favSection = document.getElementById('favorites-section');

            favContainer.innerHTML = '';
            let hasPins = false;

            allCourses.forEach(el => {
                const id = parseInt(el.getAttribute('data-id'));
                const btn = el.querySelector('.btn-pin');

                if (pinned.includes(id)) {
                    btn.classList.add('pinned');
                    const clone = el.cloneNode(true);
                    // Actualizar el estado del pin del clon para que muestre que está anclado visualmente
                    clone.querySelector('.btn-pin').classList.add('pinned');
                    favContainer.appendChild(clone);
                    hasPins = true;
                } else {
                    btn.classList.remove('pinned');
                }
            });

            favSection.style.display = hasPins ? 'block' : 'none';
        }

        // Search Filter (Buscador instantáneo)
        document.getElementById('searchInput').addEventListener('input', function (e) {
            const term = e.target.value.toLowerCase().trim();
            // Evitar conflictos con el clon filtrando solo los principales (o filtrar ambos)
            document.querySelectorAll('.course-item').forEach(el => {
                const name = el.getAttribute('data-name');
                if (name.includes(term)) {
                    el.style.display = 'block';
                } else {
                    el.style.display = 'none';
                }
            });

            // Ocultar cabeceras de Etapa si no hay cursos visibles dentro
            document.querySelectorAll('.etapa-header').forEach(header => {
                if (header.closest('#favorites-section')) return; // ignorar favoritos

                const nextRow = header.nextElementSibling;
                if (nextRow && nextRow.classList.contains('row')) {
                    const visibleItems = nextRow.querySelectorAll('.course-item[style="display: block;"], .course-item:not([style*="display: none"])');
                    header.style.display = visibleItems.length === 0 ? 'none' : 'flex';
                }
            });
        });

        // Al cargar la pantalla, mostramos los anclados
        document.addEventListener('DOMContentLoaded', renderPins);
    </script>
</body>

</html>