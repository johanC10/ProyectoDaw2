<?= $this->extend('public/layouts/public_layout') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Pas 2 - Consentiments legals</h2>

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

    <?= view('public/layouts/wizard_steps', ['paso_actual' => 2]) ?>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <form method="post" action="<?= base_url('formulario/guardarPaso2') ?>" id="formConsentimientos">
                <?= csrf_field() ?>

                <h5 class="mb-3 text-primary"><i class="bi bi-camera"></i> Autorització relativa als alumnes</h5>
                <p class="fw-bold text-dark mb-2">Ús d’imatges de l’alumne/a, publicació de dades de caràcter personal i material elaborat per l’alumnat</p>
                
                <div class="alert alert-secondary small text-justify shadow-sm mb-4">
                    <p>L'Institut Caparrella disposa a Internet d’un espai web <a href="http://www.inscaparrella.cat" target="_blank" class="fw-bold text-decoration-none">www.inscaparrella.cat</a>, així com diferents comptes en Xarxes Socials, on informa i fa difusió de les seves activitats escolars lectives, complementàries i extraescolars. En aquesta pàgina web s’hi poden publicar imatges en les quals apareguin individualment o en grup, alumnes realitzant les esmentades activitats. Així mateix es poden fer enregistraments d’imatge i veu d’alumnes amb la finalitat de participar en projectes educatius.</p>
                    <p>Atès que el dret a la pròpia imatge és reconegut en l’article 18.1 de la Constitució espanyola i està regulat per la Llei orgànica 1/1982, de 5 de maig, sobre el dret a l’honor, a la intimitat personal i familiar i a la pròpia imatge, la Direcció d’aquest centre demana l’autorització per publicar fotografies i vídeos on aparegui l’alumne o alumna i hi sigui clarament identificable.</p>
                    <p class="mb-0">Per a l’edició de materials en espais de difusió del centre (blogs, web, revistes) cal la corresponent cessió del dret de comunicació pública expressat per escrit dels afectats, sense que la Llei de propietat intel·lectual admeti cap mena de modulació segons l’edat dels alumnes. Aquesta cessió s’ha d’efectuar encara que l’autor/a en qüestió no aparegui clarament identificat i s’estén a realitzacions com ara el treball de recerca de batxillerat i altres de similars.</p>
                </div>

                <div class="bg-white p-4 rounded mb-4 border border-primary shadow-sm">
                    <p class="fw-bold mb-2"><i class="bi bi-check2-square text-primary me-2"></i> Amb la següent acció, Autoritzo expressament:</p>
                    <ol class="text-muted small mb-4">
                        <li class="mb-2">Que la imatge/veu de l'alumne/a pugui aparèixer en fotografies/enregistraments corresponents a activitats escolars lectives, complementàries i extraescolars o a la participació en projectes educatius organitzats pel centre docent, tals com:
                            <ul class="mt-1">
                                <li>Pàgines Web i Xarxes Socials del Centre.</li>
                                <li>Presentacions digitals / enregistraments destinats a difusió pública no comercial.</li>
                                <li>Fotografies per a revistes o publicacions d'àmbit educatiu i per a les orles de fi d’etapa.</li>
                            </ul>
                        </li>
                        <li class="mb-2">Que el material elaborat pel meu fill/a pugui ser publicat en blogs i altres espais de comunicació pública amb finalitat educativa.</li>
                        <li>Que en les pàgines web o blogs i revistes editades pel centre hi constin les meves inicials i el nom del centre.</li>
                    </ol>

                    <div class="d-flex flex-column gap-2 bg-light p-3 rounded border">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="autoriza_imagen" value="si" id="authSi" required>
                            <label class="form-check-label fw-bold text-success" for="authSi">SÍ autoritzo els punts anteriors</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="autoriza_imagen" value="no" id="authNo">
                            <label class="form-check-label fw-bold text-danger" for="authNo">NO autoritzo els punts anteriors</label>
                        </div>
                    </div>
                </div>

                <hr>
                
                <h5 class="mb-3 text-primary"><i class="bi bi-shield-lock"></i> Protecció de dades personals</h5>
                
                <div class="alert alert-secondary small mb-3 text-justify">
                    <p class="mb-2">Les dades que proporcioneu s’integraran en una base de dades del Departament d´Educació que té per finalitat la tramitació i resolució dels processos d’admissió de l’alumnat, el seguiment de l’escolarització de l’alumne i la gestió de l’acció educativa, i en la base de dades d'alumnes de l’INS Caparrella. Estaran protegides per la Llei orgànica 3/2018, de 5 de desembre, de protecció de dades personals i garantia dels drets digitals.</p>
                    <p class="mb-2">Els responsables dels fitxers esmentats són: el Departament d’Educació i la Direcció del centre. Podeu exercir els drets d’accés, rectificació, cancel·lació, oposició, oblit i portabilitat mitjançant un escrit adreçat a la Direcció del centre educatiu corresponent.</p>
                    <p class="mb-2">La conformitat o no conformitat signada tindrà validesa durant el curs acadèmic actual.</p>
                    <p class="mb-0"><strong>Informació addicional:</strong> Podeu consultar la informació addicional i detallada sobre protecció de dades a la pàgina: <a href="http://educacio.gencat.cat/ca/Detall/alumnes-centres-departament" target="_blank" class="text-decoration-none fw-bold">Generalitat de Catalunya</a></p>
                </div>

                <div class="form-check mb-4 bg-light p-3 rounded border border-primary">
                    <input class="form-check-input ms-1 me-2" type="checkbox" name="rgpd" id="checkRgpd" required>
                    <label class="form-check-label fw-bold" for="checkRgpd">
                        Certifico que he llegit i Accepto la política de protecció de dades.
                    </label>
                </div>

                <h5 class="mb-3 text-primary"><i class="bi bi-pen"></i> Signatura Digital</h5>
                <p class="small text-muted mb-2">Procediu a signar a dins del requadre blanc fent servir el ratolí (ordinador) o el dit (tauleta/mòbil). Aquesta signatura actua amb validesa legal representativa.</p>

                <div class="row bg-light p-3 rounded mx-0 border mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label">Nom i cognoms del signant</label>
                        <input type="text" class="form-control" name="firma_nombre" placeholder="Pare / Mare o Alumne (Si és major edat)" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Identificació (DNI/NIE del signant)</label>
                        <input type="text" class="form-control" name="firma_dni" required>
                    </div>
                    
                    <div class="col-12 mt-4 text-center">
                        <label class="form-label fw-bold w-100 text-start">Espai per Signar <span class="text-danger">*</span></label>
                        <div style="border: 2px dashed #6d79ce; background: #fff; border-radius: 8px; overflow: hidden; display: inline-block;">
                            <canvas id="signatureCanvas" width="400" height="200" style="touch-action: none; cursor: crosshair;"></canvas>
                        </div>
                        <div class="mt-2 text-start" style="max-width: 400px; margin: 0 auto;">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearCanvas()">
                                <i class="bi bi-eraser"></i> Netejar Signatura
                            </button>
                        </div>
                        <!-- Este input oculto llevará la imagen generada en Base64 al backend -->
                        <input type="hidden" name="firma_base64" id="firmaBase64">
                    </div>
                </div>

                <hr class="mt-5">

                <div class="mt-4 d-flex justify-content-between">
                    <a href="<?= base_url('formulario/paso1') ?>" class="btn btn-secondary px-4 py-2">
                        <i class="bi bi-arrow-left me-2"></i> Tornar
                    </a>
                    <button type="button" onclick="submitFormConFirma()" class="btn btn-primary px-4 py-2">
                        Guardar i continuar <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const canvas = document.getElementById('signatureCanvas');
    const ctx = canvas.getContext('2d');
    let isDrawing = false;
    let hasSignature = false;

    // Ajustar configuración del trazo
    ctx.lineWidth = 2.5;
    ctx.lineCap = 'round';
    ctx.strokeStyle = '#000000';

    // Funciones para pintar
    function startPosition(e) {
        isDrawing = true;
        hasSignature = true;
        draw(e);
    }

    function endPosition() {
        isDrawing = false;
        ctx.beginPath();
    }

    function draw(e) {
        if (!isDrawing) return;

        // Soporte para táctil y ratón
        let clientX = e.clientX || (e.touches && e.touches[0].clientX);
        let clientY = e.clientY || (e.touches && e.touches[0].clientY);
        
        let rect = canvas.getBoundingClientRect();
        let x = clientX - rect.left;
        let y = clientY - rect.top;

        ctx.lineTo(x, y);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(x, y);
        
        e.preventDefault(); // Prevenir el scroll en móbiles al dibujar
    }

    // Eventos
    canvas.addEventListener('mousedown', startPosition);
    canvas.addEventListener('mouseup', endPosition);
    canvas.addEventListener('mousemove', draw);
    
    canvas.addEventListener('touchstart', startPosition, {passive: false});
    canvas.addEventListener('touchend', endPosition);
    canvas.addEventListener('touchmove', draw, {passive: false});

    function clearCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        hasSignature = false;
    }

    function submitFormConFirma() {
        const form = document.getElementById('formConsentimientos');
        
        // Validación HTML5 manual
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        if (!hasSignature) {
            alert("Si us plau, has de dibuixar la teva signatura dins del requadre abans d'avançar.");
            return;
        }

        // Extraer imagen y guardarla en el input oculto
        const dataURL = canvas.toDataURL('image/png');
        document.getElementById('firmaBase64').value = dataURL;

        // Enviar formulario
        form.submit();
    }
</script>
<?= $this->endSection() ?>