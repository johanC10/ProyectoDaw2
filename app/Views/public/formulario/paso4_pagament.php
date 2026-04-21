<?= $this->extend('public/layouts/public_layout') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Pas 4 - Pagament de la Matrícula</h2>

        <div class="d-flex align-items-center gap-3">
            <div class="dropdown">
                <button class="btn btn-light btn-sm border dropdown-toggle" type="button" data-bs-toggle="dropdown">
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
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm">
                Tancar sessió
            </a>
        </div>
    </div>

    <?= view('public/layouts/wizard_steps', ['paso_actual' => 4]) ?>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <form method="post" action="<?= base_url('formulario/guardarPaso4') ?>" enctype="multipart/form-data"
                id="formPagament">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-lg-8">

                        <!-- 1. Configuracion de la Matrícula -->
                        <h5 class="mb-3 text-primary"><i class="bi bi-stack"></i> Configuració Acadèmica (Preu Públic)
                        </h5>

                        <div class="alert alert-info small">
                            <ul class="mb-0 ps-3">
                                <li>L’alumnat que es matricula al curs complet paga el preu públic sencer (360€).</li>
                                <li>Per a mòduls individuals: 65€/mòdul (màxim 360€). El mòdul d'FCT costa 25€.</li>
                            </ul>
                        </div>

                        <div class="bg-light p-3 rounded mb-4 border">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Modalitat de Matrícula</label>
                                <select class="form-select border-primary" name="tipo_matricula" id="tipoMatricula">
                                    <option value="completo">Curs Sencer (360€)</option>
                                    <option value="modulos">Matrícula Parcial (Mòduls solts / Repetidor)</option>
                                </select>
                            </div>

                            <div class="alert alert-warning mb-0" id="divModulosAviso" style="display: none;">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Atenció:</strong> Com que et matricules parcialment, hauràs d'acostar-te a Secretaria presencialment. Allà et calcularan els mòduls exactes i faràs el pagament de la Formació. Avui només se't cobrarà la quota de Serveis Escolars.
                            </div>
                        </div>

                        <!-- 2. Servicios Escolares -->
                        <h5 class="mb-3 text-primary"><i class="bi bi-building"></i> Serveis Escolars de l'Institut</h5>
                        <div class="bg-light p-3 rounded mb-4 border">
                            <p class="small text-muted mb-3">El pagament obligatori de Serveis Escolars cobreix
                                l'assegurança, materials de suport i despeses generals del departament.</p>

                            <div class="form-check border border-success rounded p-2 ps-4 bg-white mb-1">
                                <input class="form-check-input mt-2" type="checkbox" id="tieneHermanos"
                                    name="tiene_hermanos" value="si">
                                <label class="form-check-label fw-medium w-100" for="tieneHermanos">
                                    <strong>Descompte per Germans:</strong> Tinc un germà/na que ja ha pagat els serveis escolars íntegres (75€) a l'Institut enguany.
                                    <span class="d-block small text-success mt-1">El teu cost de serveis es reduirà a 45€.</span>
                                </label>
                            </div>
                            <div class="small fw-bold text-danger ps-2 mt-2">
                                <i class="bi bi-exclamation-circle"></i> Avís: En cas de marcar-ho i no tenir un germà/na real, seràs obligat a abonar l'excedent (30€) a Secretaria.
                            </div>
                        </div>

                        <!-- 3. Bonificaciones y Exenciones -->
                        <h5 class="mb-3 text-primary"><i class="bi bi-tag"></i> Descomptes en el Preu Públic</h5>
                        <p class="small text-muted">Els descomptes només s'apliquen a l'import del Preu Públic, mai a la
                            quota de Serveis Escolars. <strong>Penja el document d'acreditació en aquesta
                                secció.</strong></p>

                        <!-- Bonificaciones y Exenciones -->
                        <div class="bg-light border rounded p-3 mb-3">
                            <p class="small fw-bold mb-2">Bonificacions del 50%:</p>
                            <div class="form-check mb-2">
                                <input class="form-check-input bonificador" type="checkbox" name="tipo_descuento[]" value="Nombrosa_General" data-tipo="0.5">
                                <label class="form-check-label">Família Nombrosa de categoria General</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input bonificador" type="checkbox" name="tipo_descuento[]" value="Monoparental" data-tipo="0.5">
                                <label class="form-check-label">Família Monoparental</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input bonificador" type="checkbox" name="tipo_descuento[]" value="Beca_MEC" data-tipo="0.5">
                                <label class="form-check-label">Beca del Ministeri (MEC) del curs passat</label>
                            </div>

                            <p class="small fw-bold mb-2 pt-2 border-top">Exempcions del 100%:</p>
                            <div class="form-check mb-2">
                                <input class="form-check-input bonificador" type="checkbox" name="tipo_descuento[]" value="Nombrosa_Especial" data-tipo="1.0">
                                <label class="form-check-label">Família Nombrosa (Categoria Especial)</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input bonificador" type="checkbox" name="tipo_descuento[]" value="Minusvalia" data-tipo="1.0">
                                <label class="form-check-label">Minusvalidesa major o igual al 33%</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input bonificador" type="checkbox" name="tipo_descuento[]" value="Renta_Insercion" data-tipo="1.0">
                                <label class="form-check-label">Perceptors de Renda Mínima d'Inserció</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input bonificador" type="checkbox" name="tipo_descuento[]" value="Violencia_Genero_Terrorismo" data-tipo="1.0">
                                <label class="form-check-label">Víctimes de violència de gènere o terrorisme</label>
                            </div>
                        </div>

                        <!-- OBLIGATORIO SUBIR DOC BONIFICACION SI ELIGE UNA -->
                        <div id="rowDocBonificacion"
                            class="bg-white p-3 border border-top-0 rounded-bottom mb-4 d-none">
                            <label class="form-label text-info fw-bold"><i class="bi bi-cloud-upload"></i> Adjunta el
                                document justificatiu de la Bonificació/Exempció <span
                                    class="text-danger">*</span></label>
                            <input type="file" class="form-control border-info" name="doc_bonificacion"
                                id="docBonificacionInput" accept="image/*,.pdf">
                        </div>

                    </div>

                    <!-- CAJA DERECHA: RESUMEN Y PAGO -->
                    <div class="col-lg-4">
                        <div class="card border-primary mb-4 position-sticky" style="top: 20px;">
                            <div class="card-header bg-primary text-white text-center fw-bold fs-5">
                                <i class="bi bi-calculator"></i> RESUM TOTAL
                            </div>
                            <div class="card-body">

                                <div class="d-flex justify-content-between mb-1 small">
                                    <span class="text-secondary">Serveis Escolars:</span>
                                    <span id="txtServeis" class="fw-bold">75.00€</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1 small">
                                    <span class="text-secondary">Cost Base Formació:</span>
                                    <span id="txtFormacioBase">360.00€</span>
                                </div>

                                <div class="d-flex justify-content-between mb-3 pb-2 border-bottom small text-success"
                                    id="rowBonif">
                                    <span>Bonificació/Exempció:</span>
                                    <span id="txtDescompte">-0.00€</span>
                                </div>

                                <!-- Alertitas informativos -->
                                <div id="infoExtras" class="small mb-3 d-none">
                                    <span class="badge bg-warning text-dark w-100 text-start mb-1" id="badgeFct">Inclou
                                        Mòdul FCT (+25€)</span>
                                </div>

                                <div
                                    class="d-flex justify-content-between align-items-center bg-light p-3 rounded border">
                                    <span class="fs-6 fw-bold">TOTAL A PAGAR:</span>
                                    <span class="fs-4 fw-bold text-primary" id="totalFinalTxt">0.00€</span>
                                </div>

                                <input type="hidden" name="import_total" id="inputTotal" value="0">
                            </div>

                            <div class="card-footer bg-white border-top-0 pt-0">

                                <!-- Instrucciones de CaixaBank -->
                                <div class="alert alert-secondary mt-3 p-3 small">
                                    <h6 class="fw-bold text-dark text-center mb-2"><i class="bi bi-bank"></i>
                                        Instruccions de Pagament</h6>

                                    <p class="mb-1"><strong>Línia Oberta (CaixaBankNow):</strong></p>
                                    <ul class="ps-3 mb-2">
                                        <li>Codi entitat: <strong>0415876</strong></li>
                                        <li>Concepte: INGRESSOS ALUMNES</li>
                                        <li>Posar Nom i Curs.</li>
                                    </ul>
                                    <p class="mb-1"><strong>No ets client de CaixaBank?</strong></p>
                                    <a href="https://ja.cat/2526" target="_blank"
                                        class="btn btn-sm btn-dark w-100 mt-1 mb-2">
                                        <i class="bi bi-box-arrow-up-right"></i> Pagar a ja.cat/2526
                                    </a>
                                </div>

                                <!-- SUBIDA DEL JUSTIFICANTE (OBLIGATORIO) -->
                                <div class="mt-3">
                                    <label class="form-label fw-bold text-danger"><i class="bi bi-cloud-upload"></i>
                                        Puja el Justificant de Pagament *</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm border-danger"
                                            name="justificante_pago" id="docJustificante" accept="image/*,.pdf"
                                            required>
                                    </div>
                                    <div class="form-text small" id="alertaCero" style="display:none;">
                                        <i class="bi bi-info-circle"></i> Com has acreditat l'exempció del 100% i no
                                        tens Serveis, la quota és 0€. Pots pujar un document en blanc aquí per
                                        continuar.
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <hr class="mt-4">

                <div class="mt-4 d-flex justify-content-between">
                    <a href="<?= base_url('formulario/paso3') ?>" class="btn btn-secondary px-4 py-2">
                        <i class="bi bi-arrow-left me-2"></i> Tornar
                    </a>
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        Validar Pagament <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function toggleDocRow(show) {
        const row = document.getElementById('rowDocBonificacion');
        const input = document.getElementById('docBonificacionInput');
        if (show) {
            row.classList.remove('d-none');
            input.required = true;
        } else {
            row.classList.add('d-none');
            input.required = false;
        }
    }

    function calcularTotal() {
        const PRECIO_BASE = 360;
        const SERVICIOS_COMPLETOS = 75;
        const SERVICIOS_GERMANS = 45;

        let tipoMatricula = document.getElementById('tipoMatricula').value;
        let tieneHermanos = document.getElementById('tieneHermanos').checked;

        let costeServicios = tieneHermanos ? SERVICIOS_GERMANS : SERVICIOS_COMPLETOS;
        let costePublico = 0;

        if (tipoMatricula === 'completo') {
            document.getElementById('divModulosAviso').style.display = 'none';
            costePublico = PRECIO_BASE;
            document.getElementById('txtFormacioBase').innerText = costePublico.toFixed(2) + "€";
        } else {
            document.getElementById('divModulosAviso').style.display = 'block';
            costePublico = 0; // Se paga en secretaria
            document.getElementById('txtFormacioBase').innerText = "Pendent a Secretaria";
        }

        // Buscar el máximo descuento entre todos los checkboxes seleccionados
        let descuentoMaximo = 0;
        let numDescuentos = 0;
        document.querySelectorAll('.bonificador:checked').forEach(el => {
            let val = parseFloat(el.getAttribute('data-tipo'));
            if (val > descuentoMaximo) {
                descuentoMaximo = val;
            }
            numDescuentos++;
        });

        // Mostrar / Ocultar campo de subir documento
        toggleDocRow(numDescuentos > 0);

        let importeAhorro = costePublico * descuentoMaximo;
        let costePublicoNeto = costePublico - importeAhorro;
        let totalFinal = costeServicios + costePublicoNeto;

        if (totalFinal < 0) totalFinal = 0;

        document.getElementById('txtServeis').innerText = costeServicios.toFixed(2) + "€";
        document.getElementById('txtDescompte').innerText = "-" + importeAhorro.toFixed(2) + "€";
        document.getElementById('totalFinalTxt').innerText = totalFinal.toFixed(2) + "€";

        document.getElementById('inputTotal').value = totalFinal.toFixed(2);

        if (totalFinal === 0) {
            document.getElementById('alertaCero').style.display = 'block';
            document.getElementById('docJustificante').required = false;
        } else {
            document.getElementById('alertaCero').style.display = 'none';
            document.getElementById('docJustificante').required = true;
        }

        if (importeAhorro > 0) {
            document.getElementById('rowBonif').classList.remove('text-muted');
            document.getElementById('rowBonif').classList.add('text-success');
        } else {
            document.getElementById('rowBonif').classList.remove('text-success');
            document.getElementById('rowBonif').classList.add('text-muted');
        }
    }

    document.querySelectorAll('input:not(#docBonificacionInput):not(#docJustificante), select').forEach(el => {
        el.addEventListener('change', calcularTotal);
        if (el.type === 'number') {
            el.addEventListener('keyup', calcularTotal);
        }
    });

    document.querySelectorAll('input:not(#docBonificacionInput):not(#docJustificante), select').forEach(el => {
        el.addEventListener('change', calcularTotal);
    });

    calcularTotal();
</script>
<?= $this->endSection() ?>