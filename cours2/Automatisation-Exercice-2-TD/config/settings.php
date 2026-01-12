<?php
try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->safeLoad();
    $dotenv->required([ 'MYSQL_HOST', 'MYSQL_DATABASE', 'MYSQL_USER', 'MYSQL_PASSWORD'])->notEmpty();
} catch (Dotenv\Exception\InvalidPathException $e) {
    error_log($e->getMessage());
    die('An error occured while loading the environment variables.');
}

$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';
$settings['view'] = $settings['root'] . '/view';

$settings['error'] = [
    'display_error_details' => true,
    'log_errors' => true,
    'log_error_details' => true,
];

$settings['db'] = [
    'driver' => 'mysql',
    'host' => $_ENV['MYSQL_HOST'],
    'database' => $_ENV['MYSQL_DATABASE'],
    'username' => $_ENV['MYSQL_USER'],
    'password' => $_ENV['MYSQL_PASSWORD'],
    'charset' => 'utf8',
    'collation' => 'utf8_general_ci',
];


return $settings;
