# Automatisation du développement
## Cours 2 - TD

### Préalable
Comme pour la semaine dernière, utiliser les principes gitflow pour ce projet, nommer correctement vos branches et vos commits ([conventional commits](https://www.conventionalcommits.org/en/v1.0.0/), [gitmoji](https://gitmoji.dev/) ou autre).

Bien lire le readme disponible dans le projet pour comprendre son fonctionnement et comment l'installer.

Bien lire les MD td.build.md et td.linters.md disponibles dans le dossier cours2, qui contiennent des informations importantes pour réaliser cet exercice.

*Faire dans l'ordre : Génération de données, Linters, Vite.*

### Objectif
**TOUT SE PASSE DANS LE DOSSIER Automatisation-Exercice-2-TD**
- [ ] Installer et lancer le projet 
- [ ] "td-gen-donnees.md" => Modifier `PopulateDatabaseCommand.php` pour ajouter des données aléatoire cohérentes (2-4 sociétés avec 2-3 bureaux et une dizaine d'employés) utiliser PHP Faker + une commande custom (les datafixtures/seeders ne sont pas dans ce projet) et les setters "magiques" des modeles pour alimenter les données https://laravel.com/docs/12.x/eloquent#inserting-and-updating-models.
- [ ] "td-linters.md" => Installer PHPStan, PHPCodeSniffer et ESLint dans le projet. Faire une configuration de base pour chaque linter, les tester, et corriger les erreurs eventuelles (pas forcément celles de PHPStan, ni celles présentes dans le vite.config.js)
- [ ] "td-build.md" => Deplacer le js et css (transformer les fichiers CSS en SCSS) dans un dossiers `assets` à la racine du projet, et les build dans un dossier `./public/build` grâce à vite.

### Bonus
- [ ] Ajouter des git hooks pour lancer phpcs, phpstan et eslint avant chaque commit et/ou push
- [ ] Utiliser la version serveur de vite pour le développement
- [ ] Changer le liens des assets dans twig en fonction de la variable d'environnement `ENV` (dev ou prod)
- [ ] Utiliser le manifest.json pour avoir des noms de fichiers dynamiques avec hash pour le cache en production (= pour utiliser ceux dans /build dynamiquement).

### Rendre l'exercice
Par groupe de 2 ou 3.
Vous trouverez sur Arche un endroit où déposer un fichier contenant le lien de votre repo GIT auquel je devrai avoir accès (ou m'envoyer par mail) ! Précisez-moi qui est dans le groupe.