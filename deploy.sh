#!/bin/bash

# Script de déploiement pour l'application BRUNCH sur Render

echo "Début du déploiement de l'application BRUNCH..."

# Installer les dépendances
echo "Installation des dépendances PHP..."
composer install --no-dev --optimize-autoloader

# Générer l'optimisation de l'autoloader
echo "Optimisation de l'autoloader..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Exécuter les migrations
echo "Exécution des migrations..."
php artisan migrate --force

echo "Déploiement terminé avec succès!"