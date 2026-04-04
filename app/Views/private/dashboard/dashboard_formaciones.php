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

        /* Tarjetas de Estadísticas */
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
            <img src="<?= base_url('assets/img/logomini.png') ?>" alt="Logo Institut Caparrella"
                style="width: 40px; height: auto;">
            <h5 class="mb-0 fw-bold ms-2"><?= lang('Dashboard.header_secretaria') ?> | <span
                    class="text-sub fw-normal">Institut Caparrella</span></h5>
        </div>

        <div class="d-flex align-items-center gap-4">

            <div class="dropdown">
                <button class="btn btn-sm btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-globe"></i> <?= strtoupper(service('request')->getLocale()) ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                    <li><a class="dropdown-item <?= service('request')->getLocale() === 'ca' ? 'fw-bold' : '' ?>"
                            href="<?= base_url('lang/ca') ?>">Català (CA)</a></li>
                    <li><a class="dropdown-item <?= service('request')->getLocale() === 'es' ? 'fw-bold' : '' ?>"
                            href="<?= base_url('lang/es') ?>">Español (ES)</a></li>
                    <li><a class="dropdown-item <?= service('request')->getLocale() === 'en' ? 'fw-bold' : '' ?>"
                            href="<?= base_url('lang/en') ?>">English (EN)</a></li>
                </ul>
            </div>

            <span class="text-sub"><i class="bi bi-person-circle me-1"></i>
                <?= esc(session()->get('secretaria_name') ?? 'Admin') ?></span>
            <a href="<?= base_url('logout_secretaria') ?>" class="btn-logout"><i class="bi bi-box-arrow-right me-1"></i>
                <?= lang('Dashboard.btn_salir') ?></a>
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
                        <p class="text-sub small mb-0 fw-semibold"><?= lang('Dashboard.stat_total') ?></p>
                        <h3 class="fw-bold mb-0"><?= $stats['total'] ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon icon-orange"><i class="bi bi-hourglass-split"></i></div>
                    <div>
                        <p class="text-sub small mb-0 fw-semibold"><?= lang('Dashboard.stat_pendientes') ?></p>
                        <h3 class="fw-bold mb-0"><?= $stats['pendientes'] ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon icon-green"><i class="bi bi-check-circle"></i></div>
                    <div>
                        <p class="text-sub small mb-0 fw-semibold"><?= lang('Dashboard.stat_validadas') ?></p>
                        <h3 class="fw-bold mb-0"><?= $stats['validadas'] ?></h3>
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

        <?php foreach ($etapas as $etapa): ?>

            <div class="etapa-header d-flex justify-content-between align-items-end">
                <h4 class="fw-bold text-brand mb-0">
                    <i class="bi <?= $etapa['icono'] ?> me-2"></i>
                    <?= lang('Cursos.' . $etapa['clave']) ?>
                </h4>
            </div>

            <div class="row g-3">
                <?php foreach ($etapa['cursos'] as $curso):
                    $langKey = 'Cursos.' . $curso['clave_nombre'];
                    $translate = lang($langKey);
                    $finalName = ($translate === $langKey) ? ucfirst(str_replace('_', ' ', $curso['clave_nombre'])) : $translate;
                    ?>
                    <div class="col-md-6 col-lg-3 course-item" data-name="<?= esc(strtolower($finalName)) ?>"
                        data-id="<?= $curso['id'] ?>">
                        <div class="position-relative h-100">
                            <!-- PIN BUTTON -->
                            <button class="btn-pin" onclick="togglePin(<?= $curso['id'] ?>, event)"
                                title="<?= lang('Dashboard.tooltip_pin') ?? 'Anclar / Desanclar' ?>">
                                <i class="bi bi-pin-angle-fill"></i>
                            </button>

                            <a href="<?= base_url('private/curso/' . $curso['id']) ?>" class="course-card h-100 mt-0">
                                <div class="w-100">
                                    <h6 class="fw-bold mb-1 pe-3"><?= esc($finalName) ?></h6>

                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <?php if (isset($curso['familia_clave']) && $curso['familia_clave'] !== null): ?>
                                            <small class="text-sub text-truncate d-inline-block"
                                                style="max-width: 60%;"><?= lang('Cursos.' . $curso['familia_clave']) ?></small>
                                        <?php else: ?>
                                            <small class="text-sub"><?= $curso['alumnos'] ?>
                                                <?= lang('Dashboard.label_alumnos') ?></small>
                                        <?php endif; ?>

                                        <?php if ($curso['pendientes'] > 0): ?>
                                            <span class="badge badge-pending rounded-pill px-2"><?= $curso['pendientes'] ?>
                                                <?= lang('Dashboard.label_puntos') ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-ok rounded-pill px-2">0
                                                <?= lang('Dashboard.label_puntos') ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endforeach; ?>

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