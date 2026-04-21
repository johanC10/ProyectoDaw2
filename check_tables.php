<?php
require 'vendor/autoload.php';
$pathsConfig = new \Config\Paths();
require rtrim($pathsConfig->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
$app = \Config\Services::codeigniter(new \Config\App(), $pathsConfig);
$app->initialize();

$db = \Config\Database::connect();
$tables = $db->listTables();
file_put_contents('tables.json', json_encode($tables));
echo "Done";
