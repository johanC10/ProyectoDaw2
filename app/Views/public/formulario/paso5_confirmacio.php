<?= $this->extend('public/layouts/public_layout') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Pas 5 - Resum i Confirmació</h2>

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

    <?= view('public/layouts/wizard_steps', ['paso_actual' => 5]) ?>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <div class="text-center mb-4">
                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px;">
                    <i class="bi bi-card-checklist"></i>
                </div>
                <h4 class="fw-bold">Revisa les teves dades abans d'enviar</h4>
                <p class="text-muted">Aquesta és l'última oportunitat per modificar la informació. Si tot està correcte, procedeix a signar el compromís final.</p>
            </div>

            <div class="row g-4 mb-4">
                <!-- DATOS PERSONALES -->
                <div class="col-md-6">
                    <div class="card h-100 bg-light border-0">
                        <div class="card-body">
                            <h6 class="fw-bold text-primary mb-3"><i class="bi bi-person me-2"></i>Dades de l'Estudiant</h6>
                            <p class="mb-1"><strong>Nom:</strong> <?= esc($session_data['nombre'] ?? '---') ?></p>
                            <p class="mb-1"><strong>DNI/NIE:</strong> <?= esc($session_data['dni'] ?? '---') ?></p>
                            <p class="mb-1"><strong>Correu:</strong> <?= esc($session_data['email_alumno'] ?? '---') ?></p>
                            <p class="mb-1"><strong>Telèfon:</strong> <?= esc($session_data['telefono_alumno'] ?? '---') ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- ACADEMICO -->
                <div class="col-md-6">
                    <div class="card h-100 bg-light border-0">
                        <div class="card-body">
                            <h6 class="fw-bold text-primary mb-3"><i class="bi bi-mortarboard me-2"></i>Informació Acadèmica (Pas 3)</h6>
                            <?php foreach ($session_data as $key => $val): ?>
                                <?php if (strpos($key, 'optativa') === 0): ?>
                                    <p class="mb-1 text-capitalize"><strong><?= str_replace('_', ' ', $key) ?>:</strong> Seleccionada (#<?= esc($val) ?>)</p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <p class="mb-1 mt-3">
                                <strong>Serveis:</strong> 
                                <?php if(isset($session_data['servei_taquilla']) && $session_data['servei_taquilla'] === 'si'): ?>
                                    <span class="badge bg-secondary">Taquilla (<?= esc($session_data['tipo_taquilla'] ?? '---') ?>)</span>
                                <?php endif; ?>
                                <?php if(isset($session_data['servei_transport']) && $session_data['servei_transport'] === 'si'): ?>
                                    <span class="badge bg-secondary">Transport (<?= esc($session_data['comarca_transporte'] ?? '---') ?>)</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- CONSENTIMIENTOS -->
                <div class="col-md-6">
                    <div class="card h-100 bg-light border-0">
                        <div class="card-body">
                            <h6 class="fw-bold text-primary mb-3"><i class="bi bi-shield-check me-2"></i>Consentiments (Pas 2)</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="bi <?= (isset($session_data['autoriza_imagen']) && $session_data['autoriza_imagen'] == 'si') ? 'bi-check-circle-fill text-success' : 'bi-x-circle-fill text-danger' ?> me-2"></i> Drets d'imatge
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i> Llei Orgànica 3/2018 RGPD
                                </li>
                            </ul>
                            <?php if(!empty($session_data['firma_base64'])): ?>
                                <div class="mt-2 text-center p-2 bg-white border rounded">
                                    <span class="small text-muted d-block mb-1">Signatura Digital emesa per: <?= esc($session_data['firma_nombre'] ?? '---') ?></span>
                                    <img src="<?= $session_data['firma_base64'] ?>" alt="Signatura" style="max-height: 50px;">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- PAGO -->
                <div class="col-md-6">
                    <div class="card h-100 bg-light border-0">
                        <div class="card-body">
                            <h6 class="fw-bold text-primary mb-3"><i class="bi bi-cash-coin me-2"></i>Estat del Pagament (Pas 4)</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="bi bi-receipt text-primary me-2"></i> Tipus: <?= esc($session_data['tipo_matricula'] ?? '---') ?></li>
                                <?php
                                    $desc = 'Cap';
                                    if(isset($session_data['tipo_descuento'])) {
                                        $desc = is_array($session_data['tipo_descuento']) ? implode(', ', $session_data['tipo_descuento']) : $session_data['tipo_descuento'];
                                    }
                                ?>
                                <li class="mb-2"><i class="bi bi-tag text-primary me-2"></i> Descompte: <?= esc($desc) ?></li>
                            </ul>
                            <h5 class="mt-3 text-end"><span class="badge bg-success p-2 px-3 fs-6">Cost Final: <?= esc($session_data['import_total'] ?? '0.00') ?> €</span></h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FORMULARIO DE CONFIRMACION FINAL -->
            <form method="post" action="<?= base_url('formulario/finalizar') ?>">
                <?= csrf_field() ?>

                <div class="bg-white border border-secondary rounded p-3 mb-4 shadow-sm">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkFinal" required>
                        <label class="form-check-label fw-bold" for="checkFinal">
                            Declaro sota la meva responsabilitat que totes les dades introduïdes i els documents adjunts són completament certs i corresponen a la realitat autèntica, assumint les conseqüències legals de qualsevol falsedat.
                        </label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('formulario/paso4') ?>" class="btn btn-secondary px-4 py-2">
                        <i class="bi bi-arrow-left me-2"></i> Tornar per modificar
                    </a>

                    <button type="submit" class="btn btn-success px-5 py-2 fw-bold shadow-sm">
                        <i class="bi bi-send-check me-2"></i> Enviar i Finalitzar Matrícula
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<?= $this->endSection() ?>