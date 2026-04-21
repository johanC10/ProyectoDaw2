<?php
$paso_actual = $paso_actual ?? 1;

$progreso = (($paso_actual - 1) / 4) * 100;
?>
<style>
    .step-wrapper {
        position: relative;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .step-circle {
        position: relative;
        z-index: 2;
        width: 45px;
        height: 45px;
        background: #dee2e6;
        border-radius: 50%;
        color: white;
        font-weight: bold;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 4px solid white;
        transition: background-color 0.3s;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .step-circle.active {
        background: #6d79ce;
    }

    .progress-track {
        position: absolute;
        top: 50%;
        left: 20px;
        right: 20px;
        height: 8px;
        transform: translateY(-130%);
        background: #dee2e6;
        z-index: 1;
        border-radius: 4px;
    }

    .progress-fill {
        height: 100%;
        background: #6d79ce;
        transition: width 0.3s ease;
        border-radius: 4px;
    }
</style>

<div class="mb-5 position-relative">
    <div class="step-wrapper">
        <div class="progress-track">
            <div class="progress-fill" style="width:<?= $progreso ?>%;"></div>
        </div>

        <div class="step-circle <?= $paso_actual >= 1 ? 'active' : '' ?>">1</div>
        <div class="step-circle <?= $paso_actual >= 2 ? 'active' : '' ?>">2</div>
        <div class="step-circle <?= $paso_actual >= 3 ? 'active' : '' ?>">3</div>
        <div class="step-circle <?= $paso_actual >= 4 ? 'active' : '' ?>">4</div>
        <div class="step-circle <?= $paso_actual >= 5 ? 'active' : '' ?>">5</div>
    </div>
</div>