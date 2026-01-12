<?php

namespace App\Controller;

use App\Models\Company;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController extends DefaultController
{
    public function index(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $companies = Company::all();
        return $this->twig->render($response, 'home/index.twig', ['companies' => $companies]);
    }
}
