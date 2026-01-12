# Linters & git hooks
## Linters PHP
### PHPStan  
[Lien vers la documentation](https://phpstan.org/)  

C’est l’outil d’analyse de code statique de base en PHP. Comme les autres outils que nous verrons, il est facile à utiliser et à configurer, et peut facilement s'intégrer dans des projets grâce à une configuration contenant plusieurs niveaux 

Il permet aussi de générer une « baseline » pour ignorer les faux positifs sur un projet existant et ne traiter que le nouveau code.

Exemple de configuration simple :  
```yaml
# phpstan.neon
parameters:
    level: 5
    paths:
        - src
```
Les niveaux vont de 0 à 9, 0 étant le plus permissif, 8 le plus strict. Le niveau 5 est un bon compromis.  

Le paramètre `paths` définit les dossiers à analyser.

Comme pour toute librairie PHP, l’installation se fait via Composer :  
```bash
composer require --dev phpstan/phpstan
```
Pour lancer l’analyse, vous pouvez utiliser l’exécutable local dans `vendor/bin` ou l’installer globalement :  
```bash
vendor/bin/phpstan analyse
```
Pour simplifier et faciliter l’automatisation, il est conseillé de passer par un script dans `composer.json` :  
```json
// composer.json
{
    "scripts": {
        "phpstan": "phpstan analyse --memory-limit=1G"
    }
}
```
Vous pouvez y ajouter d’autres paramètres ou niveaux de règles, et le partager facilement dans le projet.

### PHP Code Sniffer (phpcs)
[Liens vers la documentation](https://github.com/squizlabs/PHP_CodeSniffer)  

Comme PHPStan, PHPCodeSniffer est un outil d’analyse de code statique qui vérifie le respect des règles de style définies. Il garantit un code homogène, plus lisible et facile à maintenir.  
Il propose également une commande pour corriger automatiquement les erreurs de style, ce qui fait gagner du temps.

Exemple de configuration :  
```xml
<?xml version="1.0" encoding="UTF-8"?>

<ruleset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/squizlabs/php_codesniffer/phpcs.xsd">

    <arg name="basepath" value="."/>
    <arg name="cache" value=".phpcs-cache"/>
    <arg name="colors"/>
    <arg name="extensions" value="php"/>

    <rule ref="PSR12">
        <exclude name="Generic.Files.LineLength"/>
    </rule>
    <rule ref="Generic.WhiteSpace.ScopeIndent">
        <properties>
            <property name="indent" value="4"/>
            <property name="tabIndent" value="false"/>
        </properties>
    </rule>
    <rule ref="Generic.Files.LineLength">
        <properties>
            <property name="lineLimit" value="140"/>
            <property name="absoluteLineLimit" value="0"/>
        </properties>
    </rule>

    <file>src</file>
</ruleset>
```

Résumé des règles principales :  
- [PSR12](https://www.php-fig.org/psr/psr-12/) : standard de style PHP  
- `Generic.WhiteSpace.ScopeIndent` : indentation 4 espaces, pas de tabulations  
- `Generic.Files.LineLength` : ligne limitée à 140 caractères  

Installation via Composer :  
```bash
composer require --dev squizlabs/php_codesniffer
```
Pour lancer l’analyse :  
```bash
vendor/bin/phpcs
```
Pour corriger automatiquement :  
```bash
vendor/bin/phpcbf
```
Il est conseillé d’intégrer ces commandes dans `composer.json` :  
```json
{
    "scripts": {
        "phpcs": "phpcs --standard=PSR12 src",
        "phpcbf": "phpcbf --standard=PSR12 src"
    }
}
```

## Linters JavaScript
### ESLint
[Liens vers la documentation](https://eslint.org/)  
ESLint est un linter pour JavaScript. Il veille au respect des règles de style définies.  
L’utilisation d’un linter est particulièrement importante en JS, car le langage est plus permissif et les divergences de style plus nombreuses (guillemets simples ou doubles, point-virgule optionnel, etc.). L'environnement cible est également plus varié. Il est important d'avoir une configuration pour le backend s’il est en JS, et une pour le frontend. 

Exemple de configuration :  
```yaml
env:
    browser: true
    es2021: true
extends:
    - airbnb-base
parserOptions:
    ecmaVersion: latest
    sourceType: module
rules:
    import/no-extraneous-dependencies:
        - error
        -   devDependencies: true
    indent:
        - error
        - 4
    import/prefer-default-export:
        - off
    no-else-return:
        - error
```

Cette configuration s’appuie sur la base d’Airbnb, très répandue.  
Selon le framework, adaptez la config. Par exemple pour Vue.js, il est préférable d'ajouter :  
```yaml
extends:
    - plugin:vue/vue3-recommended
```

Installation via npm (ou yarn, pnpm...) :  
```bash
npm install eslint eslint-config-airbnb-base --save-dev
```

Configuration des scripts dans `package.json` :  
```json
{
    "scripts": {
        "lint": "eslint --ext .js,.vue --ignore-path .gitignore",
        "lint:fix": "eslint . --fix --ext .js,.vue --ignore-path .gitignore"
    }
}
```

Pour lancer l’analyse ou corriger automatiquement :  
```bash
npm run lint
npm run lint:fix 
```

## Utilisation automatique  
Il est possible, et recommandé, de configurer les linters pour qu’ils s’exécutent automatiquement. Configurez votre IDE pour cela.  

### VSCode  
- [PHPStan](https://marketplace.visualstudio.com/items?itemName=swordev.phpstan)  
- [PHPCodeSniffer](https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs)  
- [ESLint](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint)  

### PHPStorm  
- [PHPStan](https://www.jetbrains.com/help/phpstorm/using-phpstan.html)  
- [PHPCodeSniffer](https://www.jetbrains.com/help/phpstorm/using-php-code-sniffer.html)  
- [ESLint](https://www.jetbrains.com/help/phpstorm/eslint.html)  

Il est vivement conseillé de bien [configurer l’exécutable PHP dans PHPStorm](https://www.jetbrains.com/help/phpstorm/configuring-local-php-interpreters.html).

---

## GIT hooks  
Les git hooks sont simplement des scripts bash exécutés à un moment précis (avant commit, avant push, etc.). Ils interrompent l’action si la commande retourne une erreur.
Cela évite de pousser du code incorrect et permet (normalement) de réussir à chaque fois la CI s’il y en a une.

Exemple simple de script `pre-commit` lançant PHPCodeSniffer via Docker :  
```bash
#!/bin/bash
docker compose run --rm -T php composer run-script phpcs
```
Explications : `docker compose run` lance la commande dans un conteneur Docker, `--rm` supprime le conteneur après exécution, `-T` évite les erreurs de tty, et `php` désigne le service PHP dans Docker.

Il faut ensuite le rendre exécutable :
```bash
chmod +x pre-commit
```
Puis le placer dans `.git/hooks` (où vous trouverez déjà des exemples) :    
```bash
mv pre-commit .git/hooks/
```

Il est astucieux de conserver tous les scripts de hook dans un dossier versionné, puis de créer des liens symboliques vers `.git/hooks` pour faciliter leur partage :
```bash
~/.git/hooks ln -s path/to/versionned/git_hooks/pre-commit pre-commit
```

Pour une documentation complète, voir : [Git Hooks documentation](https://git-scm.com/book/en/v2/Customizing-Git-Git-Hooks).