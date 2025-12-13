#!/bin/bash

# Script de déploiement simplifié pour l'application BRUNCH sur Render

echo "Début du déploiement de l'application BRUNCH..."

# Installer les dépendances
echo "Installation des dépendances PHP..."
composer install --no-dev --optimize-autoloader

echo "Déploiement terminé avec succès!"