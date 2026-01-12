<?php

namespace App\Controller;

use Slim\App;
use Slim\Views\Twig;

class DefaultController
{
    // Get twig from container
    protected $twig;

    public function __construct(App $app)
    {
        $this->twig = $app->getContainer()->get('view');
    }
}
