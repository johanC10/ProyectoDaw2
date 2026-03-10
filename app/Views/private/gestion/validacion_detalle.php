<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Matrícula</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --bg-body: #f8fafc; --bg-card: #ffffff;
            --text-main: #0f172a; --text-muted: #64748b;
            --border-color: #e2e8f0; --color-light: #f1f5f9;
            --color-primary: #3b82f6; --color-success: #10b981;
            --color-warning: #f59e0b; --color-danger: #ef4444;
        }

        body { background: var(--bg-body); color: var(--text-main); font-family: system-ui, sans-serif; padding-bottom: 5rem; }
        
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
    </style>
</head>
<body>

    <main class="container pt-4">
        
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div class="d-flex gap-3">
                <a href="<?= base_url('private/curso/1') ?>" class="text-dark fs-4"><i class="bi bi-arrow-left"></i></a>
                <div>
                    <h2 class="fw-bold mb-0">María García López</h2>
                    <span class="text-muted small">1eso · Matrícula del 25/2/2026</span>
                </div>
            </div>
            <span class="badge border text-dark bg-white px-3 py-2 rounded-pill">Pendiente</span>
        </div>

        <form action="<?= base_url('private/procesar_matricula/1') ?>" method="post">
            <?= csrf_field() ?>

            <div class="row g-3 mb-3">
                <div class="col-lg-9">
                    <div class="info-card h-100 mb-0">
                        <div class="card-title-sm"><i class="bi bi-person me-2"></i>Datos Personales</div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="data-label">Nombre Completo</div><div class="data-value">María García López</div>
                                <div class="data-label">Email</div><div class="data-value">maria@ejemplo.com</div>
                            </div>
                            <div class="col-md-4">
                                <div class="data-label">DNI / NIE</div><div class="data-value">12345678A</div>
                                <div class="data-label">Teléfono</div><div class="data-value">612 345 678</div>
                            </div>
                            <div class="col-md-4">
                                <div class="data-label">Nº Tarjeta Sanitaria</div><div class="data-value">TSE123456789</div>
                                <div class="data-label">Derechos Imagen</div><div class="data-value text-danger"><i class="bi bi-x"></i> No aceptados</div>
                            </div>
                            <div class="col-12">
                                <div class="data-label">Dirección</div><div class="data-value mb-0">Calle Mayor 15, 2ºB, Madrid 28001</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="info-card h-100 mb-0 text-center">
                        <div class="card-title-sm">Foto del Alumno</div>
                        <div class="foto-alumno">
                            <i class="bi bi-person-bounding-box fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="info-card h-100 mb-0">
                        <div class="card-title-sm"><i class="bi bi-people me-2"></i>Datos del Tutor</div>
                        <div class="row">
                            <div class="col-6"><div class="data-label">Nombre</div><div class="data-value">Pedro García</div></div>
                            <div class="col-6"><div class="data-label">Teléfono</div><div class="data-value">698 765 432</div></div>
                            <div class="col-12"><div class="data-label">Email</div><div class="data-value mb-0">pedro@ejemplo.com</div></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card h-100 mb-0">
                        <div class="card-title-sm"><i class="bi bi-mortarboard me-2"></i>Información Académica</div>
                        <div class="d-flex gap-4 mb-2">
                            <div><div class="data-label">Tipo</div><div class="data-value mb-1">Nuevo</div></div>
                            <div><div class="data-label">Curso</div><div class="data-value mb-1">1eso</div></div>
                        </div>
                        <div class="data-label">Optativas</div>
                        <div class="mb-2 small">
                            <span class="opt-badge">1</span> Francés &nbsp; <span class="opt-badge">2</span> Tecnología
                        </div>
                        <div class="total-box">Total: <strong>€380.00</strong></div>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="card-title-sm"><i class="bi bi-file-earmark-text me-2"></i>Documentos Adjuntos</div>
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="doc-box">
                            <div class="data-label text-start ms-1">DNI Frontal</div>
                            <img src="https://via.placeholder.com/300x200" class="doc-img" alt="DNI Frontal" onclick="window.open(this.src)">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="doc-box">
                            <div class="data-label text-start ms-1">DNI Trasero</div>
                            <img src="https://via.placeholder.com/300x200" class="doc-img" alt="DNI Trasero" onclick="window.open(this.src)">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="doc-box">
                            <div class="data-label text-start ms-1">TSI Frontal</div>
                            <img src="https://via.placeholder.com/300x200" class="doc-img" alt="TSI" onclick="window.open(this.src)">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="doc-box">
                            <div class="data-label text-start ms-1">TSI Trasera</div>
                            <img src="https://via.placeholder.com/300x200" class="doc-img" alt="TSI" onclick="window.open(this.src)">
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-card mb-4">
                <div class="card-title-sm">Notas Administrativas</div>
                <textarea name="notas" class="form-control" rows="3" placeholder="Añadir notas internas..." style="background:#f8fafc; border-color:#e2e8f0;"></textarea>
            </div>

            <div class="action-bar px-4">
                <button type="submit" name="accion" value="guardar" class="btn-act btn-notes"><i class="bi bi-floppy"></i> Guardar Notas</button>
                <button type="button" class="btn-act btn-warn" data-bs-toggle="modal" data-bs-target="#modalCorreccion"><i class="bi bi-envelope"></i> Solicitar Corrección</button>
                <button type="submit" name="accion" value="rechazar" class="btn-act btn-danger-custom" onclick="return confirm('¿Rechazar matrícula?');"><i class="bi bi-x-circle"></i> Rechazar</button>
                <button type="submit" name="accion" value="validar" class="btn-act btn-success-custom"><i class="bi bi-check-circle"></i> Validar</button>
            </div>
        </form>
    </main>

    <div class="modal fade" id="modalCorreccion" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-warning">Solicitar Corrección</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <form action="<?= base_url('private/solicitar_correccion/1') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-body pt-2">
                        <p class="text-muted small mb-3">Se enviará un correo a <strong>maria@ejemplo.com</strong> indicando qué debe corregir.</p>
                        
                        <div class="mb-3">
                            <label class="fw-medium small mb-1">Mensaje detallado</label>
                            <textarea name="mensaje" class="form-control" rows="4" placeholder="Ej: La foto del DNI frontal se ve borrosa, por favor adjunte una más nítida..." required></textarea>
                        </div>
                        
                        <div class="mb-2">
                            <label class="fw-medium small mb-1">Adjuntar imagen de referencia (Opcional)</label>
                            <input type="file" name="archivo_adjunto" class="form-control form-control-sm" accept="image/*,.pdf">
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning text-white btn-sm">Enviar Correo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>