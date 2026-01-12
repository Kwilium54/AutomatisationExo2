<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Model\Personne;

$personne = new Personne();
$personne->setPrenom('Albert');
$personne->setNom('Mudha');
$personne->setAge(42);
$personne->setAdresse('1 rue de la Paix');
$personne->setVille('Paris');
$personne->setCodePostal('75000');
$personne->setEmail('albert.mudha@monmail.fr');
$personne->setTelephone('0123456789');
$personne->setProfession('Testeur');

require_once __DIR__ . '/../src/View/affichage.php';
