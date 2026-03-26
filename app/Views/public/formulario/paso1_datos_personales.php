<?= $this->extend('public/layouts/public_layout') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Pas 1 - Dades Personals</h2>

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

    <?= view('public/layouts/wizard_steps', ['paso_actual' => 1]) ?>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <form method="post" action="<?= base_url('formulario/guardarPaso1') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- DATOS PERSONALES -->
                <h5 class="mb-3 text-primary"><i class="bi bi-person"></i> Dades de l'alumne/a</h5>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Cognom 1</label>
                        <input type="text" class="form-control" name="apellido1" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Cognom 2</label>
                        <input type="text" class="form-control" name="apellido2" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Tipus i Número d'Identificació <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <select class="form-select bg-light" name="tipo_documento" id="tipoDocSelector"
                                style="max-width: 110px;" required>
                                <option value="dni">DNI</option>
                                <option value="nie">NIE</option>
                                <option value="pasaporte">Passaport</option>
                            </select>
                            <input type="text" class="form-control" name="dni" id="inputDni" placeholder="Ej: 12345678A"
                                required>
                        </div>
                        <div class="invalid-feedback d-none" id="errorDni">
                            El format d'aquest document no és vàlid.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Data de naixement <span class="text-danger">*</span></label>
                        <!-- Calculamos con PHP el MAX date (10 años atras hoy) -->
                        <?php
                        $maxDate = date('Y-m-d', strtotime('-10 years'));
                        $minDate = date('Y-m-d', strtotime('-150 years'));
                        ?>
                        <input type="date" class="form-control" name="fecha_nacimiento" min="<?= $minDate ?>"
                            max="<?= $maxDate ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Població de naixement</label>
                        <input type="text" class="form-control" name="poblacion_nacimiento" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Num. Targeta Sanitària (TSI)</label>
                        <input type="text" class="form-control" name="num_sanitaria" placeholder="Ej: CAPA12345678"
                            required>
                    </div>
                </div>

                <!-- DIRECCIÓN -->
                <h5 class="mt-4 mb-3 text-primary"><i class="bi bi-house"></i> Domicili familiar</h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Carrer, número, pis</label>
                        <input type="text" class="form-control" name="direccion" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Municipi</label>
                        <input type="text" class="form-control" name="municipio" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Codi Postal</label>
                        <input type="text" class="form-control" name="codigo_postal" required>
                    </div>
                </div>

        <!-- CONTACTO -->
        <h5 class="mt-4 mb-3 text-primary"><i class="bi bi-telephone"></i> Dades de contacte de l'alumne/a</h5>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Telèfon familiar (Opcional)</label>
                <input type="text" class="form-control" name="telefono_familiar">
            </div>
            <div class="col-md-4">
                <label class="form-label">Telèfon alumne/a</label>
                <input type="text" class="form-control" name="telefono_alumno" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Email alumne/a</label>
                <input type="email" class="form-control" name="email_alumno" required>
            </div>
        </div>

        <!-- PADRES / TUTORES -->
        <h5 class="mt-4 mb-3 text-primary"><i class="bi bi-people"></i> Dades mare/pare/tutors legals</h5>

        <div id="tutores-container">
            <!-- Tutor 1 (Obligatorio) -->
            <div class="row mb-3 tutor-row bg-light p-3 rounded mx-0">
                <div class="col-md-4">
                    <label class="form-label">Nom tutor/a Principal <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="tutor_nombre[]" required>
                    <!-- Identificador oculto -->
                    <input type="hidden" name="tutor_tipo[]" value="Tutor Principal">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Telèfon <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="tutor_telefono[]" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="tutor_email[]" required>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <button type="button" class="btn btn-outline-primary btn-sm me-2" onclick="agregarTutorSecundario()"
                id="btnTutor2">
                <i class="bi bi-person-plus"></i> Afegir Segon Tutor/a
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="agregarContactoExtra()"
                id="btnContactoExtra">
                <i class="bi bi-plus-circle"></i> Afegir un altre contacte (familiars, feina, etc.)
            </button>
            <div id="contactInfo" class="form-text mt-1">Límit: 2 Tutors Legals i fins a 4 Contactes Extres. Vist que
                l'alumne podria ser major d'edat, el tutor pot ser opcional més endavant.</div>
        </div>

        <!-- IDENTIFICACIÓN FOTOGRÁFICA -->
        <h5 class="mt-4 mb-3 text-primary"><i class="bi bi-person-badge"></i> Documentació Identificativa</h5>
        <div class="bg-light p-3 rounded mb-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Document d'Identitat (Cara Frontal) <span
                            class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="doc_frontal" accept="image/*,.pdf" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Document d'Identitat (Darrere)</label>
                    <input type="file" class="form-control" name="doc_trasero" accept="image/*,.pdf">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Targeta Sanitària Mèdica <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="sanitaria_frontal" accept="image/*,.pdf" required>
                </div>
            </div>
        </div>

        <!-- CIRCUNSTANCIAS -->
        <h5 class="mt-4 mb-3 text-primary"><i class="bi bi-journal-medical"></i> Circumstàncies personals i Mèdiques
        </h5>

        <div class="alert alert-warning small">
            <p class="mb-1"><strong>Circumstàncies personals:</strong> L’Institut no adoptarà cap posicionament en les
                relacions privades entre els pares/tutors dels alumnes i complirà els mandats de les resolucions
                judicials, si n’hi ha.</p>
            <p class="mb-0"><strong>Situacions singulars que afecten l’alumne/a i la seva escolarització (malalties,
                    altres):</strong> cal que informeu a Secretaria i que aporteu la documentació pertinent en aquest
                apartat, per tal de poder actuar correctament.</p>
        </div>

        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <textarea class="form-control" rows="3" name="circunstancias"
                    placeholder="Escriu qualsevol situació singular o malaltia aquí si s'escau..."></textarea>
            </div>
            <div class="col-md-12">
                <label class="form-label text-secondary"><i class="bi bi-paperclip"></i> Si has descrit una malaltia,
                    adjunta aquí l'acreditació mèdica (Opcional)</label>
                <input type="file" class="form-control" name="doc_medico" accept="image/*,.pdf">
            </div>
        </div>

        <hr>

        <div class="text-end">
            <button type="submit" class="btn btn-primary px-4 py-2">
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
    let tutoresSecundarios = 0;
    let contactosExtra = 0;

    function agregarTutorSecundario() {
        if (tutoresSecundarios >= 1) {
            return;
        }

        const container = document.getElementById('tutores-container');
        const nuevoTutor = document.createElement('div');
        nuevoTutor.classList.add('row', 'mb-3', 'bg-light', 'p-3', 'rounded', 'mx-0', 'mt-3', 'border', 'border-primary');
        nuevoTutor.innerHTML = `
            <div class="col-md-4">
                <label class="form-label">Nom tutor/a 2</label>
                <input type="text" class="form-control" name="tutor_nombre[]" required>
                <input type="hidden" name="tutor_tipo[]" value="Tutor 2">
            </div>
            <div class="col-md-4">
                <label class="form-label">Telèfon</label>
                <input type="text" class="form-control" name="tutor_telefono[]" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="tutor_email[]">
            </div>
        `;
        // Insertamos justo despues del tutor 1 (al principio del contenedor)
        container.insertBefore(nuevoTutor, container.children[1] || null);
        tutoresSecundarios++;

        document.getElementById('btnTutor2').style.display = 'none'; // Solo se permite 1 extra
    }

    function agregarContactoExtra() {
        if (contactosExtra >= 4) {
            alert('Has assolit el límit màxim de 4 contactes extres.');
            return;
        }

        const container = document.getElementById('tutores-container');
        const nuevoContacto = document.createElement('div');
        nuevoContacto.classList.add('row', 'mb-3', 'bg-white', 'p-3', 'rounded', 'mx-0', 'mt-3', 'border', 'border-secondary', 'shadow-sm');
        nuevoContacto.innerHTML = `
            <div class="col-md-3">
                <label class="form-label text-secondary">Tipus / Relació</label>
                <input type="text" class="form-control" name="tutor_tipo[]" placeholder="Feina mare, Avi, Tiet..." required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Nom del contacte</label>
                <input type="text" class="form-control" name="tutor_nombre[]" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Telèfon</label>
                <input type="text" class="form-control" name="tutor_telefono[]" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Email (Opcional)</label>
                <input type="email" class="form-control" name="tutor_email[]">
            </div>
        `;
        container.appendChild(nuevoContacto);
        contactosExtra++;

        if (contactosExtra >= 4) {
            document.getElementById('btnContactoExtra').style.display = 'none';
        }
    }

    // --- ALGORITMO DNI / NIE (Modulo 23) ---
    function validarDNI(dni) {
        const regexLetra = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;
        if (!regexLetra.test(dni)) return false;

        const numero = dni.substr(0, dni.length - 1);
        const letra = dni.substr(dni.length - 1, 1).toUpperCase();
        const letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
        let modulo = numero % 23;
        return (letras.charAt(modulo) === letra);
    }

    function validarNIE(nie) {
        let nieLimpio = nie.toUpperCase();
        const regexNie = /^[XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;
        if (!regexNie.test(nieLimpio)) return false;

        let prefijo = nieLimpio.charAt(0);
        let prefixVal = (prefijo === 'X') ? '0' : (prefijo === 'Y') ? '1' : '2';

        let parseado = prefixVal + nieLimpio.substr(1);
        return validarDNI(parseado);
    }

    const inputDni = document.getElementById('inputDni');
    const tipoDoc = document.getElementById('tipoDocSelector');
    const errorDni = document.getElementById('errorDni');

    function rechekDni() {
        if (!inputDni.value) {
            inputDni.classList.remove('is-invalid');
            errorDni.classList.add('d-none');
            return;
        }

        let val = inputDni.value.trim().toUpperCase();
        let tipo = tipoDoc.value;
        let esValido = true;

        if (tipo === 'dni') {
            esValido = validarDNI(val);
        } else if (tipo === 'nie') {
            esValido = validarNIE(val);
        } else if (tipo === 'pasaporte') {
            // Validación basica para pasaporte: Alfanumerico de 6 a 15 min.
            const regexPas = /^[A-Z0-9]{6,15}$/i;
            esValido = regexPas.test(val);
        }

        if (!esValido) {
            inputDni.classList.add('is-invalid');
            errorDni.classList.remove('d-none');
            errorDni.classList.add('d-block');
            inputDni.setCustomValidity("Format de document invàlid per el tipus seleccionat");
        } else {
            inputDni.classList.remove('is-invalid');
            errorDni.classList.add('d-none');
            errorDni.classList.remove('d-block');
            inputDni.setCustomValidity("");
        }
    }

    inputDni.addEventListener('keyup', rechekDni);
    inputDni.addEventListener('blur', rechekDni);
    tipoDoc.addEventListener('change', rechekDni);

</script>
<?= $this->endSection() ?>