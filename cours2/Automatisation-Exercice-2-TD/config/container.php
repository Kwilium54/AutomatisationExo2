<?php

use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;
use Psr\Container\ContainerInterface;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },
    'db' => function (ContainerInterface $container) {
        $capsule = new \Illuminate\Database\Capsule\Manager;
        $capsule->addConnection($container->get('settings')['db']);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    },
    App::class => function (ContainerInterface $container) {
        $container->get('db');
        AppFactory::setContainer($container);
        $app =  AppFactory::create();
        $app->addRoutingMiddleware();
        $app->add(TwigMiddleware::createFromContainer($app));
        return $app;
    },
    ErrorMiddleware::class => function (ContainerInterface $container) {
        $app = $container->get(App::class);
        $settings = $container->get('settings')['error'];

        return new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool)$settings['display_error_details'],
            (bool)$settings['log_errors'],
            (bool)$settings['log_error_details']
        );
    },
    'view' => function(ContainerInterface $container) {
        $viewPath = $container->get('settings')['view'];
        $twig = Twig::create($viewPath, ['cache' => false]);

        $twig->addExtension(new \App\Twig\MyExtension());
        return $twig;
    }
];
