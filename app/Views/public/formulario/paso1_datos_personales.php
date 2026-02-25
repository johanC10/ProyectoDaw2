<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pas 1 - Dades Personals</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .card {
            border-radius: 15px;
        }

        .section-title {
            border-left: 4px solid #6d79ce;
            padding-left: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container py-5">

        <?= view('layouts/wizard_steps', ['paso_actual' => 1]) ?>

        <div class="card shadow p-4">
            <div class="container py-5">

                <div class="card shadow p-4">

                    <h2 class="mb-4 text-center">Paso 1: Datos personales</h2>

                    <form action="<?= base_url('formulario/guardar_paso1') ?>" method="post">
                        <?= csrf_field() ?>

                        <!-- 1. DATOS MATRÍCULA -->
                        <h5 class="section-title">1. Dades de la matrícula</h5>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Any escolar</label>
                                <input type="text" name="any_escolar" class="form-control" placeholder="2025 / 2026">
                            </div>
                            <div class="col-md-4">
                                <label>Curs</label>
                                <input type="text" name="curs" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Cicle Formatiu</label>
                                <input type="text" name="cicle_formatiu" class="form-control">
                            </div>
                        </div>

                        <!-- 2. DATOS PERSONALES -->
                        <h5 class="section-title">2. Dades personals</h5>

                        <div class="mb-3">
                            <label>Cognoms i nom de l’alumne/a</label>
                            <input type="text" name="nom_complet" class="form-control" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>DNI</label>
                                <input type="text" name="dni" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Data de naixement</label>
                                <input type="date" name="data_naixement" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Població de naixement</label>
                                <input type="text" name="poblacio_naixement" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Domicili familiar</label>
                            <input type="text" name="domicili" class="form-control">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Municipi</label>
                                <input type="text" name="municipi" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Codi Postal</label>
                                <input type="text" name="codi_postal" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Telèfon alumne/a</label>
                                <input type="text" name="telefon_alumne" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Correu electrònic alumne/a</label>
                            <input type="email" name="email_alumne" class="form-control">
                        </div>

                        <!-- DADES PARES -->
                        <h5 class="section-title">Dades mare/pare/tutors legals</h5>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Nom mare/pare/tutor</label>
                                <input type="text" name="tutor1_nom" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Telèfon</label>
                                <input type="text" name="tutor1_telefon" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Email</label>
                                <input type="email" name="tutor1_email" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label>Nom mare/pare/tutor</label>
                                <input type="text" name="tutor2_nom" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Telèfon</label>
                                <input type="text" name="tutor2_telefon" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Email</label>
                                <input type="email" name="tutor2_email" class="form-control">
                            </div>
                        </div>

                        <!-- CIRCUMSTANCIAS -->
                        <h5 class="section-title">Circumstàncies personals</h5>

                        <div class="mb-3">
                            <textarea name="circumstancies" class="form-control" rows="3"
                                placeholder="Malalties o situacions singulars..."></textarea>
                        </div>

                        <!-- AUTORIZACIÓN -->
                        <h5 class="section-title">Tramesa d’informació (majors d’edat)</h5>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="autoritzacio" value="si">
                            <label class="form-check-label">Autoritzo (SÍ)</label>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="autoritzacio" value="no">
                            <label class="form-check-label">No autoritzo (NO)</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('logout') ?>" class="btn btn-secondary">Sortir</a>
                            <button type="submit" class="btn btn-primary">Guardar i continuar</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>



</body>

</html>