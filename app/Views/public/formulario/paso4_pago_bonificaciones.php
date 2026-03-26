<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pas 4 - Optatives</title>

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
            <h2 class="fw-bold">Pas 4 - Selecció d'optatives</h2>

            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm">
                Tancar sessió
            </a>
        </div>

        <!-- PROGRESO -->
        <div class="progress-wrapper mb-5">

            <div class="progress" style="height:8px;">
                <div class="progress-bar bg-primary" style="width:60%;"></div>
            </div>

            <div class="step-circle" style="left:0%;">1</div>
            <div class="step-circle" style="left:20%;">2</div>
            <div class="step-circle" style="left:40%;">3</div>
            <div class="step-circle active" style="left:60%;">4</div>
            <div class="step-circle" style="left:80%;">5</div>
            <div class="step-circle" style="left:100%;">6</div>

        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <form method="post" action="<?= base_url('formulario/guardarPaso4') ?>">

                    <?= csrf_field() ?>

                    <h5 class="mb-3">Tria les optatives per ordre de preferència</h5>

                    <p class="text-muted">
                        Selecciona l'ordre de preferència (1 = prioritat màxima)
                    </p>

                    <div class="row">

                        <div class="col-md-4">
                            <label>1ª Opció</label>
                            <select class="form-select" name="optativa1">
                                <option value="">Selecciona</option>

                                <?php foreach ($optativas as $optativa): ?>
                                    <option value="<?= $optativa['id'] ?>">
                                        <?= $optativa['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>2ª Opció</label>
                            <select class="form-select" name="optativa2">
                                <option value="">Selecciona</option>

                                <?php foreach ($optativas as $optativa): ?>
                                    <option value="<?= $optativa['id'] ?>">
                                        <?= $optativa['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>3ª Opció</label>
                            <select class="form-select" name="optativa3">
                                <option value="">Selecciona</option>
                                
                                <?php foreach ($optativas as $optativa): ?>
                                    <option value="<?= $optativa['id'] ?>">
                                        <?= $optativa['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                        </div>

                    </div>

                    <!-- ERROR -->
                    <div class="text-danger mt-2 d-none" id="errorOptativas">
                        Només pots seleccionar màxim 2 optatives
                    </div>

                    <hr>

                    <div class="mt-4 d-flex justify-content-between">

                        <a href="<?= base_url('formulario/paso3') ?>" class="btn btn-secondary">
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

    <script>
        // limitar a 2 optativas
        const checkboxes = document.querySelectorAll('.optativa');
        const error = document.getElementById('errorOptativas');

        checkboxes.forEach(cb => {
            cb.addEventListener('change', () => {

                let seleccionadas = document.querySelectorAll('.optativa:checked').length;

                if (seleccionadas > 2) {
                    cb.checked = false;
                    error.classList.remove('d-none');
                } else {
                    error.classList.add('d-none');
                }

            });
        });
    </script>

</body>

</html>