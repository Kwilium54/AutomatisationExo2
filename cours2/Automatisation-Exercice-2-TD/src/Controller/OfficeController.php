<?php

namespace App\Controller;

use App\Models\Company;
use App\Models\Office;
use http\Exception\InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;


class OfficeController extends DefaultController
{
    public function editGet(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
       $office = $this->findOfficeById($request);

        return $this->twig->render($response, 'office/form.twig', ['office' => $office]);
    }

    public function editPost(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $office = $this->findOfficeById($request);
        $officeQuery = $request->getParsedBody();
        if ($officeQuery['officeName'] !== null && $officeQuery['officeName'] !== $office->name) {
            $office->name = $officeQuery['officeName'];
        }
        if ($officeQuery['officeAddress'] !== null && $officeQuery['officeAddress'] !== $office->address) {
            $office->address = $officeQuery['officeAddress'];
        }
        if ($officeQuery['officeCity'] !== null && $officeQuery['officeCity'] !== $office->city) {
            $office->city = $officeQuery['officeCity'];
        }
        if ($officeQuery['officeZipCode'] !== null && $officeQuery['officeZipCode'] !== $office->zip_code) {
            $office->zip_code = $officeQuery['officeZipCode'];
        }
        if ($officeQuery['officeCountry'] !== null && $officeQuery['officeCountry'] !== $office->country) {
            $office->country = $officeQuery['officeCountry'];
        }
        if ($officeQuery['officeEmail'] !== null && $officeQuery['officeEmail'] !== $office->email) {
            $office->email = $officeQuery['officeEmail'];
        }
        if ($officeQuery['officePhone'] !== null && $officeQuery['officePhone'] !== $office->phone) {
            $office->phone = $officeQuery['officePhone'];
        }
        $office->save();
        return $response->withStatus(302)->withHeader('Location', '/company/' . $office->company->id);
    }


    private function findOfficeById(ServerRequestInterface $request): Office
    {
        $officeId = $request->getAttribute('id');
        // On vérifie que l'id est bien un int
        if (!is_numeric($officeId)) {
            throw new InvalidArgumentException('Invalid office id format');
        }

        $office = Office::find($request->getAttribute('id'));
        if (!$office) {
            throw new HttpNotFoundException($request);
        }
        return $office;
    }
}
