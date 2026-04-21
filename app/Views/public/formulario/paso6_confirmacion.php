<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pas 6 - Confirmació</title>

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
            <h2 class="fw-bold">Pas 6 - Confirmació final</h2>

            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm">
                Tancar sessió
            </a>
        </div>

        <!-- PROGRESO -->
        <div class="progress-wrapper mb-5">

            <div class="progress" style="height:8px;">
                <div class="progress-bar bg-primary" style="width:100%;"></div>
            </div>

            <div class="step-circle active" style="left:0%;">1</div>
            <div class="step-circle active" style="left:20%;">2</div>
            <div class="step-circle active" style="left:40%;">3</div>
            <div class="step-circle active" style="left:60%;">4</div>
            <div class="step-circle active" style="left:80%;">5</div>
            <div class="step-circle active" style="left:100%;">6</div>

        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <!-- RESUMEN DATOS -->
                <h5 class="mb-3">Dades personals</h5>
                <ul class="list-group mb-4">
                    <li class="list-group-item">Nom: <?= $nombre ?? '---' ?></li>
                    <li class="list-group-item">DNI/NIE: <?= $dni ?? '---' ?></li>
                    <li class="list-group-item">Email: <?= $email ?? '---' ?></li>
                </ul>

                <!-- RESUMEN CONSENTIMIENTOS -->
                <h5 class="mb-3">Consentiments</h5>
                <ul class="list-group mb-4">
                    <li class="list-group-item">
                        Drets d'imatge: <?= ($autoriza_imagen ?? '') == 'si' ? 'Autoritzat' : 'No autoritzat' ?>
                    </li>
                    <li class="list-group-item">
                        Protecció de dades: Acceptada
                    </li>
                </ul>

                <!-- DOCUMENTOS -->
                <h5 class="mb-3">Documents</h5>
                <ul class="list-group mb-4">
                    <li class="list-group-item">DNI pujat ✔</li>
                    <li class="list-group-item">Targeta sanitària ✔</li>
                </ul>

                <!-- PAGO -->
                <h5 class="mb-3">Pagament</h5>
                <ul class="list-group mb-4">
                    <li class="list-group-item">Import total: <strong>435€</strong></li>
                    <li class="list-group-item">Bonificació aplicada: No</li>
                </ul>

                <!-- CONFIRMACION -->
                <form method="post" action="<?= base_url('formulario/finalizar') ?>">
                    <?= csrf_field() ?>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" required>
                        <label class="form-check-label">
                            Confirmo que totes les dades són correctes
                        </label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('formulario/paso5') ?>" class="btn btn-secondary">
                            Tornar
                        </a>

                        <button class="btn btn-success">
                            Finalitzar matrícula
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>

</body>

</html>