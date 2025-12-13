#!/bin/bash

# Script de déploiement pour l'application BRUNCH sur Render

echo "Début du déploiement de l'application BRUNCH..."

# Installer les dépendances
echo "Installation des dépendances PHP..."
if ! composer install --no-dev --optimize-autoloader; then
    echo "Erreur lors de l'installation des dépendances"
    exit 1
fi

# Vérifier si PHP est disponible
if ! command -v php &> /dev/null; then
    echo "PHP n'est pas disponible"
    exit 1
fi

# Générer l'optimisation de l'autoloader
echo "Optimisation de l'autoloader..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Attendre que l'environnement soit prêt
echo "Attente de la disponibilité de l'environnement..."
sleep 5

# Générer les caches
echo "Génération des caches..."
if ! php artisan config:cache; then
    echo "Attention: Impossible de générer le cache de configuration"
fi

if ! php artisan route:cache; then
    echo "Attention: Impossible de générer le cache des routes"
fi

if ! php artisan view:cache; then
    echo "Attention: Impossible de générer le cache des vues"
fi

echo "Déploiement terminé avec succès!"