# Génération de données dans le développement
## FakerPHP
- [Documentation officielle](https://fakerphp.github.io/)
- [Page Packagist](https://packagist.org/packages/fakerphp/faker)

FakerPHP est une **librairie puissante** qui simplifie considérablement la génération de données. Elle inclut des générateurs pour de nombreux types de données courantes (prénoms, adresses, mails, coordonnées, etc.).  
Elle supporte également plusieurs localisations, ce qui permet d’obtenir des données adaptées (formats d’adresse et dates françaises, par exemple) et de gérer plusieurs pays dans une même application, avec des formats adaptés.

## Datafixture/Seeder
Dans un projet, il est important de peupler la base de données avec des données cohérentes. Symfony et Laravel proposent respectivement les **Datafixtures** et **Seeders** qui permettent de générer des données fictives et peupler la base via une simple commande.  

- [Documentation Symfony](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html)  
- [Documentation Laravel](https://laravel.com/docs/10.x/seeding)

Par défaut, ces commandes purgent la base avant de recréer un jeu de données. Même si vous n’utilisez pas ces frameworks, il est recommandé de s’en inspirer.

**Bonnes pratiques**
- Créer des fonctions pour chaque type d’entité (générer une personne, une société, un article, etc.).  
- Cela simplifie le code, améliore la lisibilité et facilite les évolutions.