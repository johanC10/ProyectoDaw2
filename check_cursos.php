<?php
$host = '127.0.0.1';
$db   = 'p_matricula_caparrella';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $pdo->exec("CREATE TABLE `cursos` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `id_etapa` INT UNSIGNED NOT NULL,
        `nom_curs` VARCHAR(200) NOT NULL,
        `familia_profesional` VARCHAR(200) NULL,
        PRIMARY KEY (`id`),
        CONSTRAINT `cursos_id_etapa_foreign` FOREIGN KEY (`id_etapa`) REFERENCES `etapes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB");
    echo "Cursos created.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
