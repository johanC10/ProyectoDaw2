<?php
$pasos = [
    1 => "Verificación",
    2 => "Ciclo y Curso",
    3 => "Datos Personales",
    4 => "Información Adicional",
    5 => "Derechos de Imagen",
    6 => "Optativas",
    7 => "Pago",
    8 => "Subida de Documentos"
];
?>

<style>
    .wizard-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        position: relative;
    }

    .wizard-container::before {
        content: "";
        position: absolute;
        top: 22px;
        left: 0;
        width: 100%;
        height: 4px;
        background-color: #e0e0e0;
        z-index: 0;
    }

    .wizard-step {
        text-align: center;
        position: relative;
        z-index: 1;
        flex: 1;
    }

    .wizard-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: #e0e0e0;
        color: #333;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 8px auto;
        font-weight: bold;
        transition: 0.3s;
    }

    .wizard-step.active .wizard-circle {
        background-color: #2d6cdf;
        color: white;
    }

    .wizard-step.completed .wizard-circle {
        background-color: #6d79ce;
        color: white;
    }

    .wizard-label {
        font-size: 14px;
    }
</style>

<div class="wizard-container">

    <?php foreach ($pasos as $numero => $nombre): ?>
        <div class="wizard-step 
            <?= ($paso_actual == $numero) ? 'active' : '' ?>
            <?= ($paso_actual > $numero) ? 'completed' : '' ?>">
            
            <div class="wizard-circle">
                <?= $numero ?>
            </div>

            <div class="wizard-label">
                <?= $nombre ?>
            </div>
        </div>
    <?php endforeach; ?>

</div>