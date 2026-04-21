<?= $this->extend('public/layouts/public_layout') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Pas 3 - Optatives i Serveis Extras</h2>

        <div class="d-flex align-items-center gap-3">
            <div class="dropdown">
                <button class="btn btn-light btn-sm border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-globe"></i> <?= strtoupper(service('request')->getLocale()) ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                    <li><a class="dropdown-item <?= service('request')->getLocale() === 'ca' ? 'fw-bold' : '' ?>" href="<?= base_url('lang/ca') ?>">Català (CA)</a></li>
                    <li><a class="dropdown-item <?= service('request')->getLocale() === 'es' ? 'fw-bold' : '' ?>" href="<?= base_url('lang/es') ?>">Español (ES)</a></li>
                    <li><a class="dropdown-item <?= service('request')->getLocale() === 'en' ? 'fw-bold' : '' ?>" href="<?= base_url('lang/en') ?>">English (EN)</a></li>
                </ul>
            </div>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm">
                Tancar sessió
            </a>
        </div>
    </div>

    <?= view('public/layouts/wizard_steps', ['paso_actual' => 3]) ?>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <form method="post" action="<?= base_url('formulario/guardarPaso3') ?>" enctype="multipart/form-data" class="needs-validation" novalidate onsubmit="return validarOptativas()">
                <?= csrf_field() ?>

                <h5 class="mb-3 text-primary"><i class="bi bi-list-check"></i> 1. Tria les teves Optatives per ordre de preferència</h5>
                <p class="text-muted">
                    Llegeix la descripció del temari i escull la teva 1a, 2a i 3a opció. T'intentarem assignar la primera prioritat segons disponibilitat de places.
                </p>

                <!-- LISTADO DESCRIPTIVO MÓDULOS -->
                <div class="row g-3 mb-4">
                    <?php if(isset($optativas) && is_array($optativas)): ?>
                        <?php foreach ($optativas as $optativa): ?>
                            <div class="col-md-6 col-lg-3">
                                <div class="card h-100 border-info bg-light shadow-sm">
                                    <div class="card-body p-3">
                                        <h6 class="card-title fw-bold text-dark"><i class="bi bi-book text-info me-1"></i> <?= esc($optativa['nom_optativa']) ?></h6>
                                        <p class="card-text small text-secondary mb-0"><?= esc($optativa['descripcio'] ?? 'Sense descripció programada.') ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- SELECTORES -->
                <div class="bg-white border rounded p-4 mb-5 shadow-sm">
                    <div class="row g-4">
                        <?php 
                        $num_optativas = isset($optativas) ? count($optativas) : 0;
                        for ($i = 1; $i <= $num_optativas; $i++): 
                            // Labels dinámicos
                            $labelTitulo = "Opció $i";
                            $isRequired = ($i <= 2) ? "required" : ""; // Al menos 2 son obligatorias
                            $asterisk = ($i <= 2) ? '<span class="text-danger">*</span>' : '(Opcional)';
                            $badgeColor = ($i == 1) ? 'bg-primary' : (($i == 2) ? 'bg-secondary' : 'bg-light text-dark border');
                            if($i == 1) $labelTitulo = "Prioritat Alta";
                        ?>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark"><span class="badge <?= $badgeColor ?> rounded-pill me-2"><?= $i ?></span> <?= $labelTitulo ?> <?= $asterisk ?></label>
                                <select class="form-select opt-selector <?= $i == 1 ? 'border-primary' : '' ?>" name="optativa<?= $i ?>" <?= $isRequired ?>>
                                    <option value="">Tria la teva preferència...</option>
                                    <?php if(isset($optativas) && is_array($optativas)): ?>
                                        <?php foreach ($optativas as $optativa): ?>
                                            <option value="<?= esc($optativa['id']) ?>"><?= esc($optativa['nom_optativa']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="alert alert-danger d-none" id="errorOptativas">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> ERROR: Estàs escollint la mateixa optativa dues o més vegades. Cada prioritat ha de ser única.
                </div>

                <!-- SERVICIOS COMPLEMENTARIOS -->
                <h5 class="mb-3 text-primary border-top pt-4"><i class="bi bi-box-seam"></i> 2. Serveis Complementaris de l'Institut</h5>
                <p class="text-muted">Aquests serveis extrasòn gestionats de manera independent. Marca'ls si els necessites per aquest curs.</p>

                <div class="row g-4 mt-1">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 bg-light shadow-sm">
                            <div class="card-body">
                                <div class="form-check form-switch fs-5 mb-2">
                                    <input class="form-check-input" type="checkbox" role="switch" name="servei_taquilla" value="si" id="switchTaquilla" onchange="toggleTaquilla()">
                                    <label class="form-check-label fw-bold ms-2 text-dark" for="switchTaquilla">Sol·licitar Taquilla Física</label>
                                </div>
                                <div id="divOpcionesTaquilla" class="mt-3 d-none bg-white p-3 rounded border">
                                    <p class="small text-muted mb-2">Selecciona la mida (Sotmès a disponibilitat):</p>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="tipo_taquilla" id="taqMitja" value="mitja">
                                        <label class="form-check-label fw-medium" for="taqMitja">Mitja Taquilla <span class="badge bg-secondary ms-1">30€</span></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipo_taquilla" id="taqSencera" value="sencera">
                                        <label class="form-check-label fw-medium" for="taqSencera">Taquilla Sencera <span class="badge bg-success ms-1">45€</span></label>
                                    </div>
                                </div>
                                <p class="small text-muted mb-0 mt-3"><i class="bi bi-info-circle me-1"></i>S'assignarà un armariet per guardar els materials si hi ha disponibilitat d'espai.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card h-100 border-0 bg-light shadow-sm">
                            <div class="card-body">
                                <div class="form-check form-switch fs-5 mb-2">
                                    <input class="form-check-input" type="checkbox" role="switch" name="servei_transport" value="si" id="switchTransport" onchange="toggleTransporte()">
                                    <label class="form-check-label fw-bold ms-2 text-dark" for="switchTransport">Transport Escolar (Comarcal)</label>
                                </div>
                                <div id="divTransporte" class="mt-3 d-none p-3 border rounded bg-white">
                                    <label class="form-label small fw-bold text-dark mb-1">Comarca / Poble de residència <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-sm mb-3" name="comarca_transporte" id="selectComarca" onchange="actualizarEnlaceTransporte()">
                                        <option value="">Tria la comarca principal...</option>
                                        <option value="segria">Segrià (Lleida, Alcarràs, etc.)</option>
                                        <option value="garrigues">Les Garrigues (Borges, Juneda, etc.)</option>
                                        <option value="pla_urgell">Pla d'Urgell (Mollerussa, Linyola, etc.)</option>
                                        <option value="altres">Altres Comarques</option>
                                    </select>
                                    
                                    <div id="btnDescargaComarca" class="mb-3 d-none text-center">
                                        <a href="#" class="btn btn-outline-info btn-sm fw-bold w-100" id="linkDescargaTransporte">
                                            <i class="bi bi-file-earmark-arrow-down"></i> <span id="textoComarca">...</span>
                                        </a>
                                        <p class="small text-muted mt-1 mb-0 pb-2 border-bottom" style="font-size: 0.75rem;">Descarrega, omple i firma la sol·licitud oficial abans de pujar-la a baix.</p>
                                    </div>

                                    <label class="form-label text-danger fw-bold small"><i class="bi bi-cloud-upload"></i> Puja la sol·licitud firmada aquí *</label>
                                    <input type="file" class="form-control form-control-sm border-danger" name="doc_transporte" id="docTransporteInput" accept="image/*,.pdf">
                                    <p class="small text-muted mt-2 mb-0" style="font-size:0.75rem;">Recorda que la gestió externa depen del Consell Comarcal.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 bg-light shadow-sm">
                            <div class="card-body">
                                <div class="fs-5 mb-2 mt-1">
                                    <i class="bi bi-tools text-primary me-2"></i>
                                    <label class="fw-bold text-dark">L'equip de taller (Mecànica)</label>
                                </div>
                                <p class="small text-muted mt-2">La granota de treball i l'equipament individual no es gestiona des del centre directament, però ho hauràs de tenir si fas graus industrials o tallers.</p>
                                <a href="#" class="btn btn-outline-primary btn-sm mt-2 w-100 fw-bold">
                                    <i class="bi bi-download me-1"></i> Descarregar guia de compra
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="mt-5">

                <div class="mt-4 d-flex justify-content-between">
                    <a href="<?= base_url('formulario/paso2') ?>" class="btn btn-secondary px-4 py-2">
                        <i class="bi bi-arrow-left me-2"></i> Tornar
                    </a>
                    <button type="submit" class="btn btn-primary px-4 py-2" id="btnContinue">
                        Guardar seleccions <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const selects = document.querySelectorAll('.opt-selector');
    const errorBox = document.getElementById('errorOptativas');
    const btnContinue = document.getElementById('btnContinue');

    function toggleTransporte() {
        const trCheckbox = document.getElementById('switchTransport');
        const trDiv = document.getElementById('divTransporte');
        const docInp = document.getElementById('docTransporteInput');
        const selectC = document.getElementById('selectComarca');

        if (trCheckbox.checked) {
            trDiv.classList.remove('d-none');
            docInp.required = true;
            selectC.required = true;
        } else {
            trDiv.classList.add('d-none');
            docInp.required = false;
            selectC.required = false;
            selectC.value = '';
            actualizarEnlaceTransporte(); // oculta el botón
        }
    }

    function actualizarEnlaceTransporte() {
        const val = document.getElementById('selectComarca').value;
        const btnBox = document.getElementById('btnDescargaComarca');
        const linkText = document.getElementById('textoComarca');

        if (!val) {
            btnBox.classList.add('d-none');
            return;
        }

        btnBox.classList.remove('d-none');
        if (val === 'segria') linkText.innerText = "Formulari C.C. del Segrià";
        else if (val === 'garrigues') linkText.innerText = "Formulari C.C. de les Garrigues";
        else if (val === 'pla_urgell') linkText.innerText = "Formulari C.C. del Pla d'Urgell";
        else linkText.innerText = "Model de Sol·licitud Genèric";
    }

    function toggleTaquilla() {
        const taqCheckbox = document.getElementById('switchTaquilla');
        const trDiv = document.getElementById('divOpcionesTaquilla');
        const taqM = document.getElementById('taqMitja');
        const taqS = document.getElementById('taqSencera');

        if (taqCheckbox.checked) {
            trDiv.classList.remove('d-none');
            taqM.required = true;
        } else {
            trDiv.classList.add('d-none');
            taqM.required = false;
            taqS.required = false;
            taqM.checked = false;
            taqS.checked = false;
        }
    }

    function validarOptativas() {
        const form = document.querySelector('.needs-validation');
        const selectedValues = [];
        let hasErrorConflict = false;

        // Recolectar valores seleccionados ignorando los vacios
        selects.forEach(select => {
            if(select.value) {
                if(selectedValues.includes(select.value)) {
                    hasErrorConflict = true;
                }
                selectedValues.push(select.value);
            }
        });

        if (hasErrorConflict) {
            errorBox.classList.remove('d-none');
            form.classList.remove('was-validated');
            return false;
        } else {
            errorBox.classList.add('d-none');
        }

        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
            return false;
        }
        
        return true;
    }

    selects.forEach(select => {
        select.addEventListener('change', validarOptativas);
    });
</script>
<?= $this->endSection() ?>