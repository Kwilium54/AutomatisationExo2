# Exemple d'utilisation de vite

Vous trouverez un exemple d'utilisation de vite avec un projet très simple.  
Nous utiliserons un serveur Nginx pour servir les fichiers statiques, mais dans l'idée cela pourrait être une application php.
Nous ne nous servons pas complètement du serveur Vite, mais uniquement des fichiers qu'il sert. (voir le `index.html`)

## Installation
```bash
docker compose run --rm node npm install
```

## Lancement
```bash
docker compose up
```