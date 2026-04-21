<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('FichaValidacion.titulo_pestana') ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --bg-body: #f8fafc; --bg-card: #ffffff;
            --text-main: #0f172a; --text-muted: #64748b;
            --border-color: #e2e8f0; --color-light: #f1f5f9;
            --color-primary: #6d79ce; --color-success: #24c87e;
            --color-warning: #f5a623; --color-danger: #ef233c;
        }

        body { background: var(--bg-page); color: var(--text-main); font-family: system-ui, sans-serif; padding-bottom: 5rem; }
        
        /* Utilidades y Tarjetas */
        .info-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; }
        .card-title-sm { font-size: 1.05rem; font-weight: 600; margin-bottom: 1rem; color: var(--text-main); }
        .data-label { font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.1rem; }
        .data-value { font-size: 0.95rem; font-weight: 500; margin-bottom: 1rem; }
        
        /* Elementos Específicos */
        .foto-alumno { background: var(--color-light); border: 1px solid var(--border-color); width: 130px; height: 130px; display: flex; align-items: center; justify-content: center; border-radius: 8px; color: var(--text-muted); margin: auto; }
        .opt-badge { width: 22px; height: 22px; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: bold; margin-right: 5px; }
        .total-box { background: var(--color-light); border-radius: 8px; padding: 0.5rem 1rem; display: inline-block; font-size: 0.9rem; }
        
        /* Galería Docs */
        .doc-box { border: 1px solid var(--border-color); border-radius: 8px; padding: 0.4rem; background: var(--bg-card); text-align: center; }
        .doc-img { width: 100%; height: 140px; object-fit: cover; border-radius: 4px; cursor: pointer; transition: transform 0.2s; }
        .doc-img:hover { transform: scale(1.03); }

        /* Botonera Inferior */
        .action-bar { background: var(--bg-card); border-top: 1px solid var(--border-color); padding: 1rem; display: flex; justify-content: flex-end; gap: 0.5rem; position: fixed; bottom: 0; left: 0; right: 0; z-index: 1000; }
        .btn-act { padding: 0.5rem 1rem; border-radius: 6px; font-weight: 500; font-size: 0.9rem; border: 1px solid transparent; display: inline-flex; align-items: center; gap: 0.4rem; }
        .btn-notes { background: var(--bg-card); border-color: var(--border-color); }
        .btn-warn { background: var(--bg-card); color: var(--color-warning); border-color: var(--color-warning); }
        .btn-danger-custom { background: var(--color-danger); color: white; }
        .btn-success-custom { background: var(--color-success); color: white; }

        /* Estilo sutil para selector de idioma */
        .lang-btn { text-decoration: none; color: var(--text-muted); padding: 0.3rem 0.6rem; border-radius: 6px; border: 1px solid transparent; transition: all 0.2s; }
        .lang-btn:hover { background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-main); }
    </style>
</head>
<body>

    <main class="container pt-4">
        
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div class="d-flex gap-3">
                <a href="<?= base_url('private/curso/' . $curso['id']) ?>" class="text-dark fs-4"><i class="bi bi-arrow-left"></i></a>
                <div>
                    <h2 class="fw-bold mb-0"><?= esc($estudiante['nom'] . ' ' . $estudiante['cognom1'] . ' ' . $estudiante['cognom2']) ?></h2>
                    <span class="text-muted small"><?= lang('Cursos.' . $curso['nom_curs']) ?> · <?= lang('FichaValidacion.texto_matricula_de') ?> <?= $fecha ?></span>
                </div>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <button class="lang-btn dropdown-toggle bg-transparent border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-globe"></i> <?= strtoupper(service('request')->getLocale()) ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                        <li><a class="dropdown-item <?= service('request')->getLocale() === 'ca' ? 'fw-bold' : '' ?>" href="<?= base_url('lang/ca') ?>">Català</a></li>
                        <li><a class="dropdown-item <?= service('request')->getLocale() === 'es' ? 'fw-bold' : '' ?>" href="<?= base_url('lang/es') ?>">Español</a></li>
                        <li><a class="dropdown-item <?= service('request')->getLocale() === 'en' ? 'fw-bold' : '' ?>" href="<?= base_url('lang/en') ?>">English</a></li>
                    </ul>
                </div>
                
                <?php
                    $badgeClass = 'bg-white';
                    if ($matricula['estat'] === 'pendent') $badgeClass = 'bg-warning text-dark';
                    if ($matricula['estat'] === 'validat') $badgeClass = 'bg-success text-white';
                    if ($matricula['estat'] === 'rebutjat') $badgeClass = 'bg-danger text-white';
                ?>
                <span class="badge border <?= $badgeClass ?> px-3 py-2 rounded-pill"><?= strtoupper($matricula['estat']) ?></span>
            </div>
        </div>


        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('private/procesar_matricula/' . $matricula['id']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="row g-3 mb-3">
                <div class="col-lg-9">
                    <div class="info-card h-100 mb-0">
                        <div class="card-title-sm"><i class="bi bi-person me-2"></i><?= lang('FichaValidacion.card_personales') ?></div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="data-label"><?= lang('FichaValidacion.lbl_nombre') ?></div><div class="data-value"><?= esc($estudiante['nom'] . ' ' . $estudiante['cognom1'] . ' ' . $estudiante['cognom2']) ?></div>
                                <div class="data-label"><?= lang('FichaValidacion.lbl_email') ?></div><div class="data-value"><?= esc($estudiante['email']) ?></div>
                            </div>
                            <div class="col-md-4">
                                <div class="data-label"><?= lang('FichaValidacion.lbl_dni') ?></div><div class="data-value"><?= esc($estudiante['identificacio']) ?></div>
                                <div class="data-label"><?= lang('FichaValidacion.lbl_telefono') ?></div><div class="data-value text-muted fst-italic"><?= esc($estudiante['telefon'] ?? 'Sin teléfono') ?></div>
                            </div>
                            <div class="col-md-4">
                                <div class="data-label"><?= lang('FichaValidacion.lbl_tsi') ?></div><div class="data-value text-muted fst-italic"><?= esc($estudiante['tsi'] ?? 'No disponible') ?></div>
                                <div class="data-label"><?= lang('FichaValidacion.lbl_derechos') ?></div><div class="data-value <?= $matricula['data_firma_imatge'] ? 'text-success' : 'text-danger' ?>"><i class="bi <?= $matricula['data_firma_imatge'] ? 'bi-check' : 'bi-x' ?>"></i> <?= $matricula['data_firma_imatge'] ? 'Aceptados' : lang('FichaValidacion.val_no_aceptados') ?></div>
                            </div>
                            <div class="col-12">
                                <div class="data-label"><?= lang('FichaValidacion.lbl_direccion') ?></div><div class="data-value mb-0"><?= esc($estudiante['adreca']) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="info-card h-100 mb-0 text-center">
                        <div class="card-title-sm">Foto</div>
                        <div class="foto-alumno">
                            <i class="bi bi-person-bounding-box fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="info-card h-100 mb-0">
                        <div class="card-title-sm"><i class="bi bi-people me-2"></i><?= lang('FichaValidacion.card_tutor') ?></div>
                        <div class="row">
                            <div class="col-6"><div class="data-label"><?= lang('FichaValidacion.lbl_nombre') ?></div><div class="data-value">Pedro García</div></div>
                            <div class="col-6"><div class="data-label"><?= lang('FichaValidacion.lbl_telefono') ?></div><div class="data-value">698 765 432</div></div>
                            <div class="col-12"><div class="data-label"><?= lang('FichaValidacion.lbl_email') ?></div><div class="data-value mb-0">pedro@ejemplo.com</div></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card h-100 mb-0">
                        <div class="card-title-sm"><i class="bi bi-mortarboard me-2"></i><?= lang('FichaValidacion.card_academica') ?></div>
                        <div class="d-flex gap-4 mb-2">
                            <div><div class="data-label"><?= lang('FichaValidacion.lbl_tipo') ?></div><div class="data-value mb-1"><?= ucfirst($matricula['tipus_alumne']) ?></div></div>
                            <div><div class="data-label"><?= lang('FichaValidacion.lbl_curso') ?></div><div class="data-value mb-1"><?= lang('Cursos.' . $curso['nom_curs']) ?></div></div>
                        </div>
                        <div class="data-label"><?= lang('FichaValidacion.lbl_optativas') ?></div>
                        <div class="mb-2 small">
                            <span class="opt-badge">1</span> Francés &nbsp; <span class="opt-badge">2</span> Tecnología
                        </div>
                        <div class="total-box"><?= lang('FichaValidacion.lbl_total') ?>: <strong>€<?= number_format($matricula['import_total'], 2) ?></strong></div>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="card-title-sm"><i class="bi bi-file-earmark-text me-2"></i><?= lang('FichaValidacion.card_documentos') ?></div>
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="doc-box">
                            <div class="data-label text-start ms-1"><?= lang('FichaValidacion.doc_dni_front') ?></div>
                            <img src="https://via.placeholder.com/300x200" class="doc-img" alt="DNI Frontal" onclick="window.open(this.src)">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="doc-box">
                            <div class="data-label text-start ms-1"><?= lang('FichaValidacion.doc_dni_back') ?></div>
                            <img src="https://via.placeholder.com/300x200" class="doc-img" alt="DNI Trasero" onclick="window.open(this.src)">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="doc-box">
                            <div class="data-label text-start ms-1"><?= lang('FichaValidacion.doc_tsi_front') ?></div>
                            <img src="https://via.placeholder.com/300x200" class="doc-img" alt="TSI" onclick="window.open(this.src)">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="doc-box">
                            <div class="data-label text-start ms-1"><?= lang('FichaValidacion.doc_tsi_back') ?></div>
                            <img src="https://via.placeholder.com/300x200" class="doc-img" alt="TSI" onclick="window.open(this.src)">
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-card mb-4">
                <div class="card-title-sm"><?= lang('FichaValidacion.card_notas') ?></div>
                <textarea name="notas" class="form-control" rows="3" placeholder="<?= lang('FichaValidacion.ph_notas') ?>" style="background:#f8fafc; border-color:#e2e8f0;"><?= esc($matricula['notes_admin']) ?></textarea>
            </div>

            <div class="action-bar px-4">
                <button type="submit" name="accion" value="guardar" class="btn-act btn-notes"><i class="bi bi-floppy"></i> <?= lang('FichaValidacion.btn_guardar_notas') ?></button>
                <button type="button" class="btn-act btn-warn" data-bs-toggle="modal" data-bs-target="#modalCorreccion"><i class="bi bi-envelope"></i> <?= lang('FichaValidacion.btn_solicitar_corr') ?></button>
                <button type="submit" name="accion" value="rechazar" class="btn-act btn-danger-custom" onclick="return confirm('<?= lang('FichaValidacion.confirm_rechazar') ?>');"><i class="bi bi-x-circle"></i> <?= lang('FichaValidacion.btn_rechazar') ?></button>
                <button type="submit" name="accion" value="validar" class="btn-act btn-success-custom"><i class="bi bi-check-circle"></i> <?= lang('FichaValidacion.btn_validar') ?></button>
            </div>
        </form>
    </main>

    <div class="modal fade" id="modalCorreccion" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-warning"><?= lang('FichaValidacion.modal_titulo') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <form action="<?= base_url('private/solicitar_correccion/' . $matricula['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-body pt-2">
                        <p class="text-muted small mb-3"><?= lang('FichaValidacion.modal_desc_1') ?> <strong><?= esc($estudiante['email']) ?></strong> <?= lang('FichaValidacion.modal_desc_2') ?></p>
                        
                        <div class="mb-3">
                            <label class="fw-medium small mb-1"><?= lang('FichaValidacion.lbl_mensaje') ?></label>
                            <textarea name="mensaje" class="form-control" rows="4" placeholder="<?= lang('FichaValidacion.ph_mensaje') ?>" required></textarea>
                        </div>
                        
                        <div class="mb-2">
                            <label class="fw-medium small mb-1"><?= lang('FichaValidacion.lbl_adjunto') ?></label>
                            <input type="file" name="archivo_adjunto" class="form-control form-control-sm" accept="image/*,.pdf">
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"><?= lang('FichaValidacion.btn_cancelar') ?></button>
                        <button type="submit" class="btn btn-warning text-white btn-sm"><?= lang('FichaValidacion.btn_enviar_correo') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>