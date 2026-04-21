<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pas 5 - Pagament</title>

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

        .total-box {
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">Pas 5 - Pagament matrícula</h2>

            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm">
                Tancar sessió
            </a>
        </div>

        <div class="progress-wrapper mb-5">
            <div class="progress" style="height:8px;">
                <div class="progress-bar bg-primary" style="width:80%;"></div>
            </div>

            <div class="step-circle" style="left:0%;">1</div>
            <div class="step-circle" style="left:20%;">2</div>
            <div class="step-circle" style="left:40%;">3</div>
            <div class="step-circle" style="left:60%;">4</div>
            <div class="step-circle active" style="left:80%;">5</div>
            <div class="step-circle" style="left:100%;">6</div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <form method="post" action="<?= base_url('formulario/guardarPaso5') ?>">

                    <?= csrf_field() ?>

                    <h5>Configuració matrícula</h5>

                    <div class="mb-3">
                        <label>Tipus matrícula</label>
                        <select class="form-select" id="tipoMatricula">
                            <option value="completo">Curs complet (360€)</option>
                            <option value="modulos">Mòduls individuals</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Número de mòduls</label>
                        <input type="number" id="modulos" class="form-control" value="1" min="1">
                    </div>

                    <hr>

                    <h5>Bonificacions</h5>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="familiaNumerosa">
                        <label class="form-check-label">Família nombrosa / monoparental (50%)</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="beca">
                        <label class="form-check-label">Beca Ministeri (50%)</label>
                    </div>

                    <hr>

                    <h5>Exempcions</h5>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="exento">
                        <label class="form-check-label">Exempt de pagament</label>
                    </div>

                    <hr>

                    <h5>Total</h5>

                    <div class="alert alert-primary total-box" id="total">
                        435 €
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="<?= base_url('formulario/paso4') ?>" class="btn btn-secondary">Tornar</a>
                        <button class="btn btn-primary">Guardar i continuar</button>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <script>
        function calcularTotal() {

            let total = 75; // servicios escolares
            let tipo = document.getElementById('tipoMatricula').value;
            let modulos = document.getElementById('modulos').value;

            if (tipo === 'completo') {
                total += 360;
            } else {
                total += modulos * 65;
                if (total > 435) total = 435;
            }

            if (document.getElementById('exento').checked) {
                total = 0;
            } else {
                if (document.getElementById('familiaNumerosa').checked || document.getElementById('beca').checked) {
                    total = total / 2;
                }
            }

            document.getElementById('total').innerText = total + " €";

        }

        document.querySelectorAll('input, select').forEach(el => {
            el.addEventListener('change', calcularTotal);
        });

        calcularTotal();
    </script>

</body>

</html>