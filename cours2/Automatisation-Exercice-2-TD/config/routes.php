<?php

use Slim\App;
use App\Controller\CompanyController;
use App\Controller\HomeController;
use App\Controller\OfficeController;

return function (App $app) {
    // On gère la route "par défaut" de l'application
    $app->get('/', HomeController::class . ':index');

    // CompanyController
    $app->get('/company/{id}', CompanyController::class . ':index');

    // OfficeController
    $app->get('/office/{id}/edit', OfficeController::class . ':editGet');
    $app->post('/office/{id}/edit', OfficeController::class . ':editPost');
};
