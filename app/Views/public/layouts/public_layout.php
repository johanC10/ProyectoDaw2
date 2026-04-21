<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Portal de Matrícula' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body { background-color: #f4f6f9; }
        
        .progress-wrapper { position: relative; height: 50px; }
        .step-circle { width: 36px; height: 36px; background: #dee2e6; border-radius: 50%; position: absolute; top: -14px; transform: translateX(-50%); color: white; font-weight: bold; display: flex; justify-content: center; align-items: center; border: 3px solid white; transition: background-color 0.3s; }
        .step-circle.active { background: #6d79ce; } /* brand primary */
        .progress-bar { background-color: #6d79ce !important; transition: width 0.3s ease; }
        
        .btn-primary { background-color: #6d79ce; border-color: #6d79ce; }
        .btn-primary:hover { background-color: #5b66b8; border-color: #5b66b8; }
        .btn-outline-danger { border-color: #ef233c; color: #ef233c; }
        .btn-outline-danger:hover { background-color: #ef233c; color: white; }
        
        .lang-selector {
            background-color: #ffffff;
            color: #212529;
            font-weight: 500;
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body class="bg-light">

    <?= $this->renderSection('content') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
