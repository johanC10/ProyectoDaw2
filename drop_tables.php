<?php
require 'vendor/autoload.php';
$pathsConfig = new \Config\Paths();
require rtrim($pathsConfig->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
$app = \Config\Services::codeigniter(new \Config\App(), $pathsConfig);
$app->initialize();

$db = \Config\Database::connect();
$forge = \Config\Database::forge();
$db->query('SET FOREIGN_KEY_CHECKS = 0');
$tables = $db->listTables();
foreach($tables as $table) {
    echo "Dropping table: " . $table . PHP_EOL;
    $forge->dropTable($table, true);
}
$db->query('SET FOREIGN_KEY_CHECKS = 1');
echo "Cleanup complete." . PHP_EOL;
