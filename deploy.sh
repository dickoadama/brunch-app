#!/bin/bash

# Script de déploiement pour l'application BRUNCH sur Render

echo "Début du déploiement de l'application BRUNCH..."

# Vérifier si PHP est disponible
if ! command -v php &> /dev/null
then
    echo "PHP n'est pas disponible"
    exit 1
fi

# Installer les dépendances
echo "Installation des dépendances PHP..."
composer install --no-dev --optimize-autoloader

# Générer l'optimisation de l'autoloader
echo "Optimisation de l'autoloader..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Attendre que la base de données soit prête
echo "Attente de la disponibilité de la base de données..."
sleep 10

# Exécuter les migrations
echo "Exécution des migrations..."
php artisan migrate --force

echo "Déploiement terminé avec succès!"