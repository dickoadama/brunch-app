#!/bin/bash

# Vérifier si PHP est disponible
if ! command -v php &> /dev/null
then
    echo "PHP n'est pas disponible"
    exit 1
fi

# Générer la clé d'application si elle n'existe pas
if [ -z "$APP_KEY" ]; then
    echo "Génération de la clé d'application..."
    php artisan key:generate --force
fi

# Attendre que la base de données soit prête
echo "Attente de la disponibilité de la base de données..."
sleep 10

# Exécuter les migrations
echo "Exécution des migrations..."
php artisan migrate --force

# Démarrer Apache
echo "Démarrage d'Apache..."
apache2-foreground