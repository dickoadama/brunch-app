#!/bin/bash

# Script de démarrage simplifié pour l'application BRUNCH sur Render

# Générer la clé d'application si elle n'existe pas
if [ -z "$APP_KEY" ]; then
    echo "Génération de la clé d'application..."
    php artisan key:generate --force
fi

# Exécuter les migrations
echo "Exécution des migrations..."
php artisan migrate --force

# Démarrer le serveur web
echo "Démarrage du serveur web..."
cd public && php -S 0.0.0.0:$PORT