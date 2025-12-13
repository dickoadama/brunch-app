<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRUNCH - Gestion de Brunch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #8B4513;
            --secondary-color: #D2691E;
            --accent-color: #FFD700;
            --light-color: #FFF8DC;
            --dark-color: #3E2723;
        }
        
        /* Style pour l'horloge */
        .clock-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 5px 10px;
            backdrop-filter: blur(5px);
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            font-size: 0.8rem;
        }
        
        .clock-container i {
            font-size: 0.8rem;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f5f0;
            background-image: 
                url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlckNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxjaXJjbGUgY3g9IjIwIiBjeT0iMjAiIHI9IjAuNSIgZmlsbD0iI2QyNjkxZSIgb3BhY2l0eT0iMC4xIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjlmNWYwIi8+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIgb3BhY2l0eT0iMC4zIi8+PC9zdmc+'),
                url('{{ asset('images/theme/bg-hero.jpg') }}');
            background-blend-mode: overlay, normal;
            background-size: auto, cover;
            background-position: center, center;
            background-repeat: repeat, no-repeat;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 0.3rem 0; /* Réduction significative du padding */
            position: static !important;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            min-height: 40px; /* Hauteur minimale réduite */
        }
        
        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            max-width: 100% !important;
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.2rem; /* Réduction de la taille de police */
            color: var(--accent-color) !important;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3); /* Ombre réduite */
            margin-right: auto;
            padding-left: 0 !important;
            margin-left: 0 !important;
            left: 0;
            flex-shrink: 0;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px; /* Réduction de la largeur */
            height: 40px; /* Réduction de la hauteur */
            background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
            border-radius: 8px; /* Bordure légèrement réduite */
            box-shadow: 0 2px 6px rgba(0,0,0,0.2); /* Ombre réduite */
            transition: all 0.3s ease; /* Transition réduite */
            position: relative;
            overflow: hidden;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        
        .navbar-brand::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: 0.5s;
        }
        
        .navbar-brand:hover::before {
            left: 100%;
        }
        
        /* Animation pour le texte du tableau de bord */
        @keyframes dashboardPulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.9;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        /* Animation de chargement entre le logo et le tableau de bord */
        @keyframes logoToDashboard {
            0% {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }
            25% {
                transform: scale(1.2) rotate(5deg);
                opacity: 0.8;
            }
            50% {
                transform: scale(0.8) rotate(-5deg);
                opacity: 0.6;
            }
            75% {
                transform: scale(1.1) rotate(2deg);
                opacity: 0.9;
            }
            100% {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }
        }
        
        .page-transition {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.3s ease-out, transform 0.3s ease-out;
        }
        
        .page-transition.loaded {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Animation spécifique pour les appareils mobiles */
        @media (max-width: 768px) {
            .navbar-brand {
                animation: mobileLogoEntrance 0.5s ease-out forwards; /* Animation réduite */
            }
            
            @keyframes mobileLogoEntrance {
                0% {
                    transform: translateX(-30px) scale(0.7); /* Valeurs réduites */
                    opacity: 0;
                }
                70% {
                    transform: translateX(5px) scale(0.9); /* Valeurs réduites */
                }
                100% {
                    transform: translateX(0) scale(1);
                    opacity: 1;
                }
            }
            
            .page-transition {
                animation: mobilePageTransition 0.4s ease-out forwards; /* Animation réduite */
            }
            
            @keyframes mobilePageTransition {
                0% {
                    opacity: 0;
                    transform: translateY(20px) scale(0.95); /* Valeurs réduites */
                }
                100% {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }
            
            /* Ajustements spécifiques mobile pour l'en-tête */
            .navbar {
                padding: 0.2rem 0; /* Padding encore plus réduit sur mobile */
            }
            
            .navbar-brand {
                width: 35px; /* Largeur réduite sur mobile */
                height: 35px; /* Hauteur réduite sur mobile */
                font-size: 1rem; /* Taille de police réduite sur mobile */
            }
            
            .nav-link {
                font-size: 0.8rem; /* Taille de police réduite sur mobile */
                padding: 0.2rem 0.4rem; /* Padding réduit sur mobile */
            }
        }
        
        .navbar-brand i {
            margin-right: 0 !important;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        
        .navbar-nav {
            margin-left: auto !important;
            display: flex;
            flex-wrap: nowrap;
            justify-content: flex-end;
            gap: 1rem;
            margin-bottom: 0;
            align-items: center;
            margin-right: 2rem;
        }
        
        /* Réduction de la taille des éléments de navigation */
        .nav-link {
            font-size: 0.85rem; /* Taille de police réduite */
            font-weight: 500;
            transition: all 0.2s ease; /* Transition réduite */
            position: relative;
            padding: 0.3rem 0.5rem; /* Padding réduit */
        }
        
        /* Effets de survol avancés */
        .btn, .nav-link {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            transform: translateZ(0);
            will-change: transform;
        }
        
        .btn:hover, .nav-link:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .btn:active, .nav-link:active {
            transform: translateY(0) scale(0.98);
        }
        
        .nav-link:hover::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--accent-color);
            animation: slideIn 0.3s ease;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            color: var(--dark-color);
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            margin-bottom: 25px;
            animation: fadeInUp 0.6s ease-out;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(139, 69, 19, 0.4);
        }
        
        .btn-warning {
            border-radius: 30px;
            padding: 8px 20px;
            font-weight: 500;
        }
        
        .btn-danger {
            border-radius: 30px;
            padding: 8px 20px;
            font-weight: 500;
        }
        
        .btn-info {
            border-radius: 30px;
            padding: 8px 20px;
            font-weight: 500;
        }
        
        .btn-secondary {
            border-radius: 30px;
            padding: 8px 20px;
            font-weight: 500;
        }
        
        .table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .table thead {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        
        /* Icône de panier flottante */
        .floating-cart-icon {
            position: fixed;
            bottom: 100px;
            right: 30px;
            z-index: 1000;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .cart-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .cart-link:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 6px 20px rgba(0,0,0,0.4);
        }
        
        .cart-link i {
            font-size: 24px;
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent-color);
            color: var(--dark-color);
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            animation: pulse 1s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .form-control {
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(210, 105, 30, 0.25);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideIn {
            from {
                width: 0;
            }
            to {
                width: 100%;
            }
        }
        
        /* Effet de survol pour les cartes */
        .feature-card {
            position: relative;
            overflow: hidden;
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,215,0,0.2) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .feature-card:hover::before {
            opacity: 1;
        }
        
        /* Notifications */
        .notification-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1002;
            width: 300px;
        }
        
        .notification {
            background: white;
            border-left: 4px solid var(--primary-color);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            animation: slideInRight 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .notification.success {
            border-left-color: #4CAF50;
        }
        
        .notification.error {
            border-left-color: #F44336;
        }
        
        .notification.warning {
            border-left-color: #FF9800;
        }
        
        .notification-icon {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .notification-content {
            flex: 1;
        }
        
        .notification-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: #999;
        }
        
        /* Animations pour les notifications */
        @keyframes notificationSlideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes notificationSlideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
        
        .notification {
            animation: notificationSlideIn 0.3s ease forwards;
        }
        
        .notification.closing {
            animation: notificationSlideOut 0.3s ease forwards;
        }
        
        /* Raccourcis rapides */
        .quick-access-bar {
            position: fixed;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(139, 69, 19, 0.9);
            border-radius: 0 10px 10px 0;
            padding: 10px 5px;
            z-index: 999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .quick-access-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-size: 1rem;
        }
        
        .quick-access-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
        
        /* Barre de recherche rapide */
        .search-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.3);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1003;
        }
        
        .search-box {
            background: white;
            border-radius: 15px;
            padding: 20px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .search-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 30px;
            font-size: 1.1rem;
            outline: none;
        }
        
        .search-input:focus {
            border-color: var(--secondary-color);
        }
        
        .search-results {
            margin-top: 15px;
            max-height: 300px;
            overflow-y: auto;
        }
        
        .search-result-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .search-result-item:hover {
            background: #f5f5f5;
        }
        
        /* Transitions fluides */
        .page-transition {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        
        .page-transition.loaded {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Indicateur de chargement */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            backdrop-filter: blur(5px);
        }
        
        .logo-loading-animation {
            position: relative;
            width: 80px;
            height: 80px;
        }
        
        .logo-spinner {
            width: 100%;
            height: 100%;
            border: 5px solid rgba(139, 69, 19, 0.2);
            border-top: 5px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        .logo-pulse {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 40px;
            height: 40px;
            background: var(--accent-color);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            animation: pulse 1.5s ease-in-out infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%) scale(0.8);
                opacity: 0.7;
            }
            50% {
                transform: translate(-50%, -50%) scale(1.2);
                opacity: 1;
            }
            100% {
                transform: translate(-50%, -50%) scale(0.8);
                opacity: 0.7;
            }
        }
        
        /* Dropdown menus */
        .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }
        
        .dropdown-item {
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease;
            color: var(--dark-color);
        }
        
        .dropdown-item:hover {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        .dropdown-item i {
            width: 20px;
            text-align: center;
        }
        
        .nav-link.dropdown-toggle::after {
            margin-left: 0.5rem;
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--dark-color), var(--primary-color));
            color: white;
            padding: 1rem 0;
            margin-top: auto;
            font-size: 0.85rem;
        }
        
        .footer h5 {
            color: var(--accent-color);
            font-family: 'Playfair Display', serif;
            border-bottom: 1px solid var(--accent-color);
            padding-bottom: 0.25rem;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }
        
        .footer-contact {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        
        .footer-contact a {
            color: #e0e0e0;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.8rem;
        }
        
        .footer-contact a:hover {
            color: var(--accent-color);
            transform: translateX(3px);
        }
        
        .footer-contact i {
            margin-right: 0.25rem;
            font-size: 0.7rem;
        }
        
        /* Liens des réseaux sociaux dans le footer */
        .social-links-footer {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }
        
        .social-link-footer {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: var(--accent-color);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1rem;
        }
        
        .social-link-footer:hover {
            background: var(--accent-color);
            color: var(--dark-color);
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        /* Liens des réseaux sociaux */
        .social-links {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: var(--accent-color);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        
        .social-link:hover {
            background: var(--accent-color);
            color: var(--dark-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        /* Version mobile des réseaux sociaux */
        @media (max-width: 768px) {
            .social-links {
                display: none;
            }
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 0.5rem;
            margin-top: 0.5rem;
            text-align: center;
            font-size: 0.75rem;
            color: #ccc;
        }
        
        /* Zone de recherche dans le header */
        .search-container {
            position: relative;
            margin-left: 15px;
        }
        
        .search-group {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .search-input-navbar {
            border: none;
            border-radius: 20px 0 0 20px;
            padding: 8px 15px;
            font-size: 0.9rem;
            background: rgba(255, 255, 255, 0.9);
            width: 200px;
        }
        
        .search-input-navbar:focus {
            outline: none;
            box-shadow: none;
            background: white;
        }
        
        .btn-search {
            border: none;
            border-radius: 0 20px 20px 0;
            background: var(--accent-color);
            color: var(--dark-color);
            padding: 8px 15px;
        }
        
        .btn-search:hover {
            background: #ffc400;
        }
        
        /* Nouveaux éléments flottants */
        .floating-element {
            position: fixed;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 1.2rem;
        }
        
        .floating-element:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(0,0,0,0.3);
        }
        
        /* Bouton d'aide flottant */
        .floating-help {
            bottom: 170px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #2196F3, #0D47A1);
            color: white;
        }
        
        /* Bouton de contact flottant */
        .floating-contact {
            bottom: 240px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
            color: white;
        }
        
        /* Bouton de paramètres flottant */
        .floating-settings {
            bottom: 310px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #9C27B0, #6A1B9A);
            color: white;
        }
        
        /* Animation pour les éléments flottants */
        .floating-element {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0px);
            }
        }
        
        /* Responsive pour les éléments flottants */
        @media (max-width: 768px) {
            .floating-help {
                bottom: 150px;
                right: 20px;
                width: 45px;
                height: 45px;
                font-size: 1rem;
            }
            
            .floating-contact {
                bottom: 210px;
                right: 20px;
                width: 45px;
                height: 45px;
                font-size: 1rem;
            }
            
            .floating-settings {
                bottom: 270px;
                right: 20px;
                width: 45px;
                height: 45px;
                font-size: 1rem;
            }
        }
        
        /* Boutons flottants */
        .floating-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 1000;
        }
        
        .floating-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-size: 1.2rem;
        }
        
        .floating-btn:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 6px 15px rgba(0,0,0,0.3);
        }
        
        .floating-btn.chat {
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
        }
        
        .floating-btn.help {
            background: linear-gradient(135deg, #2196F3, #0D47A1);
        }
        
        .floating-btn.top {
            background: linear-gradient(135deg, #FF9800, #EF6C00);
        }
        
        /* Chatbot */
        .chatbot-container {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 350px;
            height: 400px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            display: none;
            flex-direction: column;
            z-index: 1001;
            overflow: hidden;
        }
        
        .chatbot-header {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .chatbot-body {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: #f9f5f0;
        }
        
        .chatbot-footer {
            padding: 10px;
            border-top: 1px solid #eee;
            background: white;
        }
        
        .chat-message {
            margin-bottom: 10px;
            padding: 8px 12px;
            border-radius: 10px;
            max-width: 80%;
        }
        
        .user-message {
            background: #E3F2FD;
            margin-left: auto;
        }
        
        .bot-message {
            background: #FFF8DC;
            margin-right: auto;
        }
        
        .chat-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 20px;
            outline: none;
        }
        
        .send-btn {
            background: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer;
        }
        
        /* Icônes animées */
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .feature-card:hover .feature-icon {
            transform: scale(1.2) rotate(5deg);
            color: var(--accent-color);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.5rem;
            }
            
            .feature-icon {
                font-size: 2rem;
            }
        }
        
        /* Logo */
        .navbar-brand {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.3);
            margin: 0.5rem 1rem 0.5rem 0.5rem !important;
        }
        
        .navbar-brand img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Animation du titre BRUNCH Manager */
        .brunch-title {
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: white;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        
        .brunch-title:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        
        .brunch-subtitle {
            font-weight: 300;
            letter-spacing: 0.5px;
        }
        
        /* Réduction de la taille des icônes */
        .nav-link i {
            font-size: 0.9rem; /* Taille d'icône réduite */
        }
        
        /* Réduction de la taille du bouton de recherche */
        .search-input-navbar {
            padding: 4px 10px; /* Padding réduit */
            font-size: 0.8rem; /* Taille de police réduite */
        }
        
        .btn-search {
            padding: 4px 8px; /* Padding réduit */
            font-size: 0.8rem; /* Taille de police réduite */
        }
        
        /* Réduction de la taille des liens sociaux */
        .social-link {
            width: 28px; /* Largeur réduite */
            height: 28px; /* Hauteur réduite */
            font-size: 0.7rem; /* Taille de police réduite */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="navbar-container w-100">
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/carre.jpg') }}" alt="BRUNCH Logo">
                </a>
                
                <!-- Liens des réseaux sociaux -->
                <div class="social-links d-none d-md-flex ms-2">
                    <a href="#" class="social-link" target="_blank" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link" target="_blank" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link" target="_blank" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link" target="_blank" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                
                <!-- Zone de recherche -->
                <div class="search-container ms-3 d-none d-lg-flex">
                    <div class="input-group search-group">
                        <input type="text" class="form-control search-input-navbar" placeholder="Rechercher...">
                        <button class="btn btn-search" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Horloge et Calendrier -->
                    <li class="nav-item d-flex align-items-center me-3">
                        <div class="clock-container d-flex align-items-center">
                            <i class="fas fa-clock me-2 text-white"></i>
                            <span id="currentTime" class="text-white small"></span>
                        </div>
                    </li>
                    
                    <!-- Tableau de bord -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-chart-line me-1"></i> Tableau de bord</a>
                    </li>
                    
                    <!-- Statistiques -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-chart-bar me-1"></i> Statistiques
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('statistiques.ventes') }}"><i class="fas fa-euro-sign me-1"></i> Ventes</a></li>
                            <li><a class="dropdown-item" href="{{ route('statistiques.clients') }}"><i class="fas fa-users me-1"></i> Clients</a></li>
                            <li><a class="dropdown-item" href="{{ route('statistiques.reservations') }}"><i class="fas fa-calendar-check me-1"></i> Réservations</a></li>
                        </ul>
                    </li>
                    
                    <!-- Gestion du restaurant -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-concierge-bell me-1"></i> Restaurant
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('tables.index') }}"><i class="fas fa-chair me-1"></i> Tables</a></li>
                            <li><a class="dropdown-item" href="{{ route('employes.index') }}"><i class="fas fa-user-tie me-1"></i> Employés</a></li>
                        </ul>
                    </li>

                    <!-- Gestion des clients et commandes -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-exchange-alt me-1"></i> Transactions
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('clients.index') }}"><i class="fas fa-users me-1"></i> Clients</a></li>
                            <li><a class="dropdown-item" href="{{ route('reservations.index') }}"><i class="fas fa-calendar-check me-1"></i> Réservations</a></li>
                            <li><a class="dropdown-item" href="{{ route('commandes.index') }}"><i class="fas fa-shopping-cart me-1"></i> Commandes</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('tickets.index') }}"><i class="fas fa-ticket-alt me-1"></i> Tickets</a></li>
                            <li><a class="dropdown-item" href="{{ route('panier.index') }}"><i class="fas fa-shopping-cart me-1"></i> Panier</a></li>
                            <li><a class="dropdown-item" href="{{ route('paiements.index') }}"><i class="fas fa-money-bill-wave me-1"></i> Paiements</a></li>
                        </ul>
                    </li>

                    <!-- Gestion de la cuisine -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-utensils me-1"></i> Cuisine
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('menus.index') }}"><i class="fas fa-clipboard-list me-1"></i> Menus</a></li>
                            <li><a class="dropdown-item" href="{{ route('categories.index') }}"><i class="fas fa-tags me-1"></i> Catégories</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('fournisseurs.index') }}"><i class="fas fa-truck me-1"></i> Fournisseurs</a></li>
                            <li><a class="dropdown-item" href="{{ route('commandes.liste_predifinie') }}"><i class="fas fa-list me-1"></i> Liste Prédéfinie</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('boutique.index') }}"><i class="fas fa-store me-1"></i> Boutique</a></li>
                        </ul>
                    </li>
                    
                    <!-- Menu déroulant Paramètres/Aides/Contacts -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-cogs me-1"></i> Administration
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('parametres.index') }}"><i class="fas fa-cog me-1"></i> Paramètres</a></li>
                            <li><a class="dropdown-item" href="{{ route('aides.index') }}"><i class="fas fa-question-circle me-1"></i> Aide</a></li>
                            <li><a class="dropdown-item" href="{{ route('contacts.index') }}"><i class="fas fa-address-book me-1"></i> Contacts</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-info-circle me-1"></i> À propos</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Notifications -->
    <div class="notification-container">
        <!-- Les notifications seront insérées ici dynamiquement -->
    </div>
    
    <!-- Raccourcis rapides -->
    <div class="quick-access-bar">
        <button class="quick-access-btn" title="Nouvelle réservation" data-href="{{ route('reservations.create') }}">
            <i class="fas fa-calendar-plus"></i>
        </button>
        <button class="quick-access-btn" title="Nouvelle commande" data-href="{{ route('commandes.create') }}">
            <i class="fas fa-plus-circle"></i>
        </button>

        <button class="quick-access-btn" title="Nouveau client" data-href="{{ route('clients.create') }}">
            <i class="fas fa-user-plus"></i>
        </button>
    </div>

    <main class="py-4 flex-grow-1 page-transition" id="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-utensils me-2"></i>BRUNCH</h5>
                    <p>Votre solution complète pour la gestion de brunch professionnel.</p>
                </div>
                <div class="col-md-4">
                    <h5><i class="fas fa-address-book me-2"></i>Contact</h5>
                    <div class="footer-contact">
                        <a href="tel:+2250767294255"><i class="fas fa-phone"></i> +225 07 672 942 55</a>
                        <a href="tel:+2250555786430"><i class="fas fa-phone"></i> +225 05 557 864 30</a>
                        <a href="mailto:asaelaser@gmail.com"><i class="fas fa-envelope"></i> asaelaser@gmail.com</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5><i class="fas fa-share-alt me-2"></i>Suivez-nous</h5>
                    <div class="social-links-footer">
                        <a href="#" class="social-link-footer" target="_blank" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link-footer" target="_blank" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link-footer" target="_blank" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link-footer" target="_blank" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} BRUNCH. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Icône de panier flottante -->
    <div class="floating-cart-icon" id="floatingCartIcon">
        <a href="{{ route('panier.index') }}" class="cart-link">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count" id="cartCount" style="{{ App\Helpers\CartHelper::getCartCount() == 0 ? 'display: none;' : '' }}">
                {{ App\Helpers\CartHelper::getCartCount() }}
            </span>
        </a>
    </div>
        
    <!-- Nouveaux éléments flottants -->
    <a href="#" class="floating-element floating-help" title="Aide">
        <i class="fas fa-question"></i>
    </a>
        
    <a href="#" class="floating-element floating-contact" title="Contact">
        <i class="fas fa-envelope"></i>
    </a>
        
    <a href="#" class="floating-element floating-settings" title="Paramètres">
        <i class="fas fa-cog"></i>
    </a>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Horloge en temps réel
        function updateClock() {
            const now = new Date();
            
            // Formater l'heure
            const timeOptions = { 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit',
                hour12: false
            };
            
            const formattedTime = now.toLocaleTimeString('fr-FR', timeOptions);
            document.getElementById('currentTime').textContent = formattedTime;
        }
        
        // Mettre à jour immédiatement et ensuite toutes les secondes
        updateClock();
        setInterval(updateClock, 1000);
        
        // Animation pour les cartes
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des transitions de page
            const mainContent = document.getElementById('main-content');
            const navbarBrand = document.querySelector('.navbar-brand');
            
            if (mainContent) {
                // Marquer la page comme chargée après un court délai
                setTimeout(() => {
                    mainContent.classList.add('loaded');
                    
                    // Animation spécifique du logo lors du chargement de la page
                    if (navbarBrand) {
                        navbarBrand.style.animation = 'logoToDashboard 0.8s ease-out';
                        setTimeout(() => {
                            navbarBrand.style.animation = '';
                        }, 800);
                    }
                }, 100);
            }
            
            // Afficher l'indicateur de chargement au début
            const loadingOverlay = document.querySelector('.loading-overlay');
            if (loadingOverlay) {
                loadingOverlay.style.display = 'flex';
                
                // Cacher l'indicateur après un court délai
                setTimeout(() => {
                    loadingOverlay.style.display = 'none';
                }, 500);
            }
            
            // Observer les clics sur les liens pour afficher le chargement
            document.addEventListener('click', function(e) {
                const link = e.target.closest('a');
                if (link && link.href && !link.target && !e.defaultPrevented) {
                    // Vérifier si le lien pointe vers une page interne
                    const currentDomain = window.location.origin;
                    if (link.href.startsWith(currentDomain) || link.href.startsWith('/')) {
                        // Animation du logo avant le chargement
                        if (navbarBrand) {
                            navbarBrand.style.animation = 'logoToDashboard 0.5s ease-out';
                        }
                        
                        // Afficher l'indicateur de chargement
                        if (loadingOverlay) {
                            loadingOverlay.style.display = 'flex';
                        }
                        
                        // Ajouter un effet de transition à la page actuelle
                        if (mainContent) {
                            mainContent.classList.remove('loaded');
                        }
                        
                        // Pour les appareils mobiles, ajouter une animation spéciale
                        if (window.innerWidth <= 768) {
                            if (navbarBrand) {
                                navbarBrand.style.animation = 'mobileLogoEntrance 0.6s ease-out';
                            }
                        }
                    }
                }
            });
            
            // Mettre à jour le compteur du panier
            function updateCartCount() {
                fetch('{{ route('panier.count') }}')
                    .then(response => response.json())
                    .then(data => {
                        const cartCountElement = document.getElementById('cartCount');
                        if (cartCountElement) {
                            cartCountElement.textContent = data.count;
                            // Cacher le compteur s'il est à zéro
                            if (data.count === 0) {
                                cartCountElement.style.display = 'none';
                            } else {
                                cartCountElement.style.display = 'block';
                            }
                        }
                    })
                    .catch(error => console.error('Erreur lors de la mise à jour du panier:', error));
            }
            
            // Mettre à jour le compteur du panier toutes les 30 secondes
            setInterval(updateCartCount, 30000);
            
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
            
            // Animation pour les liens de navigation
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                link.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // Fonctionnalité du bouton retour en haut
            const topBtn = document.querySelector('.floating-btn.top');
            if (topBtn) {
                topBtn.addEventListener('click', function() {
                    window.scrollTo({top: 0, behavior: 'smooth'});
                });
                
                // Afficher/cacher le bouton selon le scroll
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 300) {
                        topBtn.style.display = 'flex';
                    } else {
                        topBtn.style.display = 'none';
                    }
                });
            }
            
            // Fonctionnalité du chatbot
            const chatBtn = document.querySelector('.floating-btn.chat');
            const chatContainer = document.querySelector('.chatbot-container');
            const closeChat = document.querySelector('.close-chat');
            
            if (chatBtn && chatContainer) {
                chatBtn.addEventListener('click', function() {
                    chatContainer.style.display = 'flex';
                });
                
                if (closeChat) {
                    closeChat.addEventListener('click', function() {
                        chatContainer.style.display = 'none';
                    });
                }
                
                // Message de bienvenue
                const chatBody = document.querySelector('.chatbot-body');
                if (chatBody) {
                    chatBody.innerHTML += `
                        <div class="chat-message bot-message">
                            Bonjour ! Je suis votre assistant virtuel BRUNCH. Comment puis-je vous aider ?
                        </div>
                    `;
                }
            }
            
            // Fonctionnalité des raccourcis rapides
            const quickAccessButtons = document.querySelectorAll('.quick-access-btn');
            quickAccessButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const href = this.getAttribute('data-href');
                    if (href) {
                        window.location.href = href;
                    }
                });
            });
            
            // Fonctionnalité de recherche rapide
            const searchInput = document.querySelector('.search-input');
            const searchOverlay = document.querySelector('.search-overlay');
            const helpBtn = document.querySelector('.floating-btn.help');
            
            // Fonctionnalité de recherche dans le header
            const navbarSearchInput = document.querySelector('.search-input-navbar');
            const navbarSearchBtn = document.querySelector('.btn-search');
            
            if (navbarSearchInput && navbarSearchBtn) {
                navbarSearchBtn.addEventListener('click', function() {
                    const searchTerm = navbarSearchInput.value.trim();
                    if (searchTerm.length > 0) {
                        // Simuler une recherche
                        console.log('Recherche pour:', searchTerm);
                        // Ici, vous pouvez ajouter la logique de recherche réelle
                        navbarSearchInput.value = '';
                        navbarSearchInput.blur();
                        
                        // Afficher une notification de recherche
                        showNotification('Recherche en cours pour: ' + searchTerm, 'info');
                    }
                });
                
                // Recherche avec la touche Enter
                navbarSearchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        navbarSearchBtn.click();
                    }
                });
            }
            
            if (helpBtn && searchOverlay) {
                helpBtn.addEventListener('click', function() {
                    searchOverlay.style.display = 'flex';
                    if (searchInput) {
                        searchInput.focus();
                    }
                });
                
                // Fermer la recherche en cliquant en dehors
                searchOverlay.addEventListener('click', function(e) {
                    if (e.target === searchOverlay) {
                        searchOverlay.style.display = 'none';
                    }
                });
                
                // Recherche en temps réel (simulation)
                if (searchInput) {
                    searchInput.addEventListener('keyup', function() {
                        const searchTerm = this.value.toLowerCase();
                        const searchResults = document.querySelector('.search-results');
                        
                        if (searchTerm.length > 2) {
                            // Simulation de résultats de recherche
                            searchResults.innerHTML = `
                                <div class="search-result-item">
                                    <strong>Réservation #001</strong> - Client: Jean Dupont
                                </div>
                                <div class="search-result-item">
                                    <strong>Commande #002</strong> - Menu: Brunch Complet
                                </div>
                                <div class="search-result-item">
                                    <strong>Ingrédient:</strong> Œufs Bio
                                </div>
                            `;
                            
                            // Ajouter les événements de clic
                            document.querySelectorAll('.search-result-item').forEach(item => {
                                item.addEventListener('click', function() {
                                    searchOverlay.style.display = 'none';
                                });
                            });
                        } else {
                            searchResults.innerHTML = '';
                        }
                    });
                }
            }
            
            // Fonctionnalité des nouveaux éléments flottants
            const floatingHelp = document.querySelector('.floating-help');
            const floatingContact = document.querySelector('.floating-contact');
            const floatingSettings = document.querySelector('.floating-settings');
            
            // Debug pour voir si les éléments sont trouvés
            console.log('Floating Help:', floatingHelp);
            console.log('Floating Contact:', floatingContact);
            console.log('Floating Settings:', floatingSettings);
            
            if (floatingHelp) {
                floatingHelp.addEventListener('click', function(e) {
                    e.preventDefault();
                    showNotification('Section d\'aide en développement', 'info');
                });
            } else {
                console.log('Floating Help not found');
            }
            
            if (floatingContact) {
                floatingContact.addEventListener('click', function(e) {
                    e.preventDefault();
                    showNotification('Formulaire de contact en développement', 'info');
                });
            } else {
                console.log('Floating Contact not found');
            }
            
            if (floatingSettings) {
                floatingSettings.addEventListener('click', function(e) {
                    e.preventDefault();
                    showNotification('Paramètres en développement', 'info');
                });
            } else {
                console.log('Floating Settings not found');
            }
            
            // Fonction pour afficher les notifications
            function showNotification(message, type = 'info') {
                const notificationContainer = document.querySelector('.notification-container');
                if (notificationContainer) {
                    const notification = document.createElement('div');
                    notification.className = `notification ${type}`;
                    
                    let icon = 'info-circle';
                    if (type === 'success') icon = 'check-circle';
                    else if (type === 'error') icon = 'exclamation-circle';
                    else if (type === 'warning') icon = 'exclamation-triangle';
                    
                    notification.innerHTML = `
                        <div class="notification-icon">
                            <i class="fas fa-${icon}"></i>
                        </div>
                        <div class="notification-content">
                            ${message}
                        </div>
                        <button class="notification-close">&times;</button>
                    `;
                    
                    notificationContainer.appendChild(notification);
                    
                    // Ajouter l'événement de fermeture
                    const closeBtn = notification.querySelector('.notification-close');
                    closeBtn.addEventListener('click', function() {
                        notification.classList.add('closing');
                        setTimeout(() => {
                            if (notification.parentNode) {
                                notification.remove();
                            }
                        }, 300);
                    });
                    
                    // Supprimer automatiquement après 5 secondes
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.classList.add('closing');
                            setTimeout(() => {
                                if (notification.parentNode) {
                                    notification.remove();
                                }
                            }, 300);
                        }
                    }, 5000);
                }
            }
        });
    </script>
    
    <!-- Indicateur de chargement -->
    <div class="loading-overlay">
        <div class="logo-loading-animation">
            <div class="logo-spinner"></div>
            <div class="logo-pulse"></div>
        </div>
    </div>
</body>
</html>