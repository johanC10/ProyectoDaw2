<?= $this->extend('public/layouts/public_layout') ?>

<?= $this->section('content') ?>
<div class="container py-5 mt-4" style="max-width: 650px;">
    <div class="card shadow border-0 rounded-4 text-center">
        <div class="card-header bg-success text-white py-4 border-0 rounded-top-4">
            <i class='bi bi-check-circle-fill display-4 d-block mb-2'></i>
            <h3 class='mb-0 fw-bold'>Matrícula Completada!</h3>
        </div>
        <div class="card-body p-4 p-md-5">
            <h5 class="text-dark fw-bold mb-3">S'han registrat totes les teves dades amb èxit.</h5>
            <p class="text-muted mb-4">La teva documentació ja ha estat enviada de forma segura i està a l'espera de validació per part de l'equip de l'Institut Caparrella.</p>
            
            <div class="alert alert-info text-start shadow-sm border-info mt-4 mb-4">
                <h6 class="fw-bold text-info-emphasis mb-2">
                    <i class="bi bi-envelope-exclamation-fill fs-5 me-1"></i> Important: Estigues pendent als teus contactes
                </h6>
                <p class="small mb-0 text-info-emphasis">Si us plau, revisa pròximament el <strong>correu electrònic</strong> i els <strong>telèfons</strong> que ens has facilitat durant el qüestionari. L'institut et notificarà per allà qualsevol actualització, l'estat d'acceptació o si falta alguna dada de la teva matrícula.</p>
            </div>
            
            <a href="<?= base_url('/') ?>" class="btn btn-success px-5 py-2 rounded-pill fw-bold shadow-sm">
                <i class="bi bi-house-door-fill me-2"></i> Sortir i tornar a l'inici
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
