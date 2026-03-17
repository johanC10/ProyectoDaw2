<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paso 1 - Dades Personals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Barra de progreso */
        .progress-wrapper {
            position: relative;
            height: 24px;
            margin-bottom: 40px;
        }

        .step-circle {
            width: 30px;
            height: 30px;
            background-color: #dee2e6;
            border-radius: 50%;
            top: -12px;
            transform: translateX(-50%);
            color: #fff;
            font-weight: bold;
            z-index: 2;
            border: 2px solid #fff;
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .step-circle.active {
            background-color: #0d6efd;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Pas 1 - Dades Personals</h2>
            <div class="progress-wrapper">
                <div class="progress" style="height:8px; border-radius:4px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width:16.6%;"></div>
                </div>
                <div class="step-circle active" style="left:0%;">1</div>
                <div class="step-circle" style="left:16.6%;">2</div>
                <div class="step-circle" style="left:33%;">3</div>
                <div class="step-circle" style="left:50%;">4</div>
                <div class="step-circle" style="left:66%;">5</div>
                <div class="step-circle" style="left:100%;">6</div>
            </div>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm">Tancar sessió</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <form method="post" action="<?= base_url('formulario/guardarPaso1') ?>">

                    <?= csrf_field() ?>

                    <!-- DATOS PERSONALES -->
                    <h5 class="mb-3">Dades de l'alumne/a</h5>

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label class="form-label">Cognoms i nom</label>
                            <input type="text" class="form-control" name="nombre">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">DNI</label>
                            <input type="text" class="form-control" name="dni">
                        </div>

                    </div>

                    <div class="row mb-3">

                        <div class="col-md-4">
                            <label class="form-label">Població de naixement</label>
                            <input type="text" class="form-control" name="poblacion_nacimiento">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Data de naixement</label>
                            <input type="date" class="form-control" name="fecha_nacimiento">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Tipus Seguretat</label>

                            <select class="form-select" name="seguridad">
                                <option value="">Selecciona</option>
                                <option value="tsi">TSI (Seguretat Social) </option>
                                <option value="mutua">Mútua</option>
                            </select>

                        </div>

                    </div>

                    <!-- DIRECCIÓN -->
                    <h5 class="mt-4 mb-3">Domicili familiar</h5>

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label class="form-label">Carrer, número, pis</label>
                            <input type="text" class="form-control" name="direccion">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Municipi</label>
                            <input type="text" class="form-control" name="municipio">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Codi Postal</label>
                            <input type="text" class="form-control" name="codigo_postal">
                        </div>

                    </div>

                    <div class="row mb-3">

                        <div class="col-md-4">
                            <label class="form-label">Telèfon familiar</label>
                            <input type="text" class="form-control" name="telefono_familiar">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Telèfon alumne/a</label>
                            <input type="text" class="form-control" name="telefono_alumno">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Email alumne/a</label>
                            <input type="email" class="form-control" name="email_alumno">
                        </div>

                    </div>

                    <!-- PADRES -->
                    <h5 class="mt-4 mb-3">Dades mare/pare/tutors</h5>

                    <div class="row mb-3">

                        <div class="col-md-4">
                            <label class="form-label">Nom tutor/a</label>
                            <input type="text" class="form-control" name="tutor1_nombre">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Telèfon</label>
                            <input type="text" class="form-control" name="tutor1_telefono">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="tutor1_email">
                        </div>

                    </div>

                    <div class="row mb-3">

                        <div class="col-md-4">
                            <label class="form-label">Nom tutor/a 2</label>
                            <input type="text" class="form-control" name="tutor2_nombre">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Telèfon</label>
                            <input type="text" class="form-control" name="tutor2_telefono">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="tutor2_email">
                        </div>

                    </div>

                    <!-- CIRCUNSTANCIAS -->
                    <h5 class="mt-4 mb-3">Circumstàncies personals</h5>

                    <div class="mb-3">
                        <textarea class="form-control" rows="3" name="circunstancias"></textarea>
                    </div>

                    <!-- AUTORIZACIÓN -->
                    <h5 class="mt-4 mb-3">Autorització informació pares</h5>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="autoriza_info" value="si">
                        <label class="form-check-label">Sí</label>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="autoriza_info" value="no">
                        <label class="form-check-label">No</label>
                    </div>

                    <div class="text-end">
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