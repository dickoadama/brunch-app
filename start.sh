#!/bin/bash

# Vérifier si PHP est disponible
if ! command -v php &> /dev/null; then
    echo "PHP n'est pas disponible"
    exit 1
fi

# Générer la clé d'application si elle n'existe pas
if [ -z "$APP_KEY" ]; then
    echo "Génération de la clé d'application..."
    php artisan key:generate --force
fi

# Attendre que l'environnement soit prêt
echo "Attente de la disponibilité de l'environnement..."
sleep 5

# Exécuter les migrations
echo "Exécution des migrations..."
php artisan migrate --force

# Démarrer le serveur web
echo "Démarrage du serveur web..."
cd public && exec php ../artisan serve --host=0.0.0.0 --port=$PORT