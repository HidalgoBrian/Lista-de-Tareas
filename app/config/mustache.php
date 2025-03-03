<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$mustache = new Mustache_Engine([
    'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . '/../views')
]);


