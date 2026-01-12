<?php global $personne; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Client</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body class="container">

<h1>Fiche client</h1>

<div class="fiche">
    <div>
        <div class="label">Prenom</div>
        <div class="value"><?= $personne->getPrenom(); ?></div>
    </div>
    <div>
        <div class="label">Nom</div>
        <div class="value"><?= $personne->getNom(); ?></div>
    </div>
    <div>
        <div class="label">Age</div>
        <div class="value"><?= $personne->getAge(); ?></div>
    </div>
    <div>
        <div class="label">Adresse</div>
        <div class="value"><?= $personne->getAdresse(); ?></div>
    </div>
    <div>
        <div class="label">Ville</div>
        <div class="value"><?= $personne->getVille(); ?></div>
    </div>
    <div>
        <div class="label">Code postal</div>
        <div class="value"><?= $personne->getCodePostal(); ?></div>
    </div>
    <div>
        <div class="label">Email</div>
        <div class="value"><?= $personne->getEmail(); ?></div>
    </div>
    <div>
        <div class="label">Téléphone</div>
        <div class="value"><?= $personne->getTelephone(); ?></div>
    </div>
    <div>
        <div class="label">Profession</div>
        <div class="value"><?= $personne->getProfession(); ?></div>
    </div>
</div>
</body>
</html>
