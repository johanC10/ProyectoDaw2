<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pas 3 - Subida de documents</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .progress-wrapper {
            position: relative;
            height: 50px;
        }

        .step-circle {
            width: 36px;
            height: 36px;
            background: #dee2e6;
            border-radius: 50%;
            position: absolute;
            top: -14px;
            transform: translateX(-50%);
            color: white;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 3px solid white;
        }

        .step-circle.active {
            background: #0d6efd;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">Pas 3 - Subida de documents</h2>

            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm">
                Tancar sessió
            </a>
        </div>

        <!-- PROGRESO -->
        <div class="progress-wrapper mb-5">

            <div class="progress" style="height:8px;">
                <div class="progress-bar bg-primary" style="width:33%;"></div>
            </div>

            <div class="step-circle" style="left:0%;">1</div>
            <div class="step-circle" style="left:16.6%;">2</div>
            <div class="step-circle active" style="left:33%;">3</div>
            <div class="step-circle" style="left:50%;">4</div>
            <div class="step-circle" style="left:66%;">5</div>
            <div class="step-circle" style="left:83%;">6</div>
            <div class="step-circle" style="left:100%;">7</div>

        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <form method="post" action="<?= base_url('formulario/guardarPaso3') ?>" enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <h5 class="mb-3">Documentació obligatòria</h5>

                    <p class="text-muted">
                        Adjunta els documents necessaris per validar la matrícula.
                        S'accepten DNI, NIE o passaport.
                    </p>

                    <hr>

                    <!-- DOCUMENTO IDENTIDAD -->
                    <h6 class="mt-3">Document d'identitat</h6>

                    <div class="mb-3">
                        <label class="form-label">Tipus de document</label>
                        <select class="form-select" name="tipo_documento" required>
                            <option value="">Selecciona</option>
                            <option value="dni">DNI</option>
                            <option value="nie">NIE</option>
                            <option value="pasaporte">Passaport</option>
                        </select>
                    </div>

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label class="form-label">Document (davant)</label>
                            <input type="file" class="form-control" name="doc_frontal" accept="image/*,.pdf" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Document (darrere)</label>
                            <input type="file" class="form-control" name="doc_trasero" accept="image/*,.pdf">
                        </div>

                    </div>

                    <!-- TARJETA SANITARIA -->
                    <h6 class="mt-4">Targeta sanitària</h6>

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label class="form-label">Targeta sanitària (davant)</label>
                            <input type="file" class="form-control" name="sanitaria_frontal" accept="image/*,.pdf" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Targeta sanitària (darrere)</label>
                            <input type="file" class="form-control" name="sanitaria_trasera" accept="image/*,.pdf">
                        </div>

                    </div>

                    <!-- INFO -->
                    <div class="alert alert-info mt-3">
                        Els documents han de ser llegibles. Formats acceptats: JPG, PNG o PDF.
                    </div>

                    <!-- BOTONES -->
                    <div class="mt-4 d-flex justify-content-between">

                        <a href="<?= base_url('formulario/paso2') ?>" class="btn btn-secondary">
                            Tornar
                        </a>

                        <button class="btn btn-primary">
                            Guardar i continuar
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>

</body>

</html>