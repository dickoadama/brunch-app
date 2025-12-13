@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-question-circle me-2"></i>Aide & Support
                    </h4>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour
                    </a>
                </div>
                
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 feature-card">
                                <div class="card-body text-center">
                                    <div class="feature-icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <h5>Documentation</h5>
                                    <p class="text-muted">Accédez aux guides d'utilisation complets</p>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#docModal">
                                        <i class="fas fa-eye me-1"></i>Voir
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 feature-card">
                                <div class="card-body text-center">
                                    <div class="feature-icon">
                                        <i class="fas fa-video"></i>
                                    </div>
                                    <h5>Tutoriels vidéo</h5>
                                    <p class="text-muted">Regardez nos tutoriels pas à pas</p>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#videoModal">
                                        <i class="fas fa-play me-1"></i>Regarder
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 feature-card">
                                <div class="card-body text-center">
                                    <div class="feature-icon">
                                        <i class="fas fa-comments"></i>
                                    </div>
                                    <h5>Support technique</h5>
                                    <p class="text-muted">Contactez notre équipe de support</p>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#supportModal">
                                        <i class="fas fa-headset me-1"></i>Contacter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    <i class="fas fa-shopping-cart me-2"></i>Comment passer une commande ?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>Pour passer une commande :</p>
                                    <ol>
                                        <li>Rendez-vous dans la section "Commandes"</li>
                                        <li>Cliquez sur "Nouvelle commande"</li>
                                        <li>Sélectionnez les menus souhaités</li>
                                        <li>Choisissez la table concernée</li>
                                        <li>Validez la commande</li>
                                        <li>Procédez au paiement si nécessaire</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    <i class="fas fa-calendar-check me-2"></i>Comment faire une réservation ?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>Pour effectuer une réservation :</p>
                                    <ol>
                                        <li>Allez dans la section "Réservations"</li>
                                        <li>Cliquez sur "Nouvelle réservation"</li>
                                        <li>Indiquez la date et l'heure souhaitées</li>
                                        <li>Sélectionnez la table désirée</li>
                                        <li>Entrez les informations du client</li>
                                        <li>Confirmez la réservation</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    <i class="fas fa-utensils me-2"></i>Comment gérer les menus ?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>Pour gérer les menus :</p>
                                    <ol>
                                        <li>Accédez à la section "Cuisine" puis "Menus"</li>
                                        <li>Pour ajouter un menu : cliquez sur "Nouveau menu"</li>
                                        <li>Pour modifier un menu : cliquez sur l'icône d'édition</li>
                                        <li>Pour supprimer un menu : cliquez sur l'icône de suppression</li>
                                        <li>N'oubliez pas d'enregistrer vos modifications</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                    <i class="fas fa-chart-bar me-2"></i>Comment consulter les statistiques ?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>Pour accéder aux statistiques :</p>
                                    <ol>
                                        <li>Cliquez sur "Statistiques" dans le menu principal</li>
                                        <li>Choisissez le type de statistique souhaité :
                                            <ul>
                                                <li>Ventes : chiffre d'affaires, tendances, etc.</li>
                                                <li>Clients : nombre de clients, fidélisation, etc.</li>
                                                <li>Réservations : taux d'occupation, périodes de pointe, etc.</li>
                                            </ul>
                                        </li>
                                        <li>Utilisez les filtres pour affiner les résultats</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                                    <i class="fas fa-users me-2"></i>Comment gérer les employés ?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>Pour gérer les employés :</p>
                                    <ol>
                                        <li>Allez dans la section "Restaurant" puis "Employés"</li>
                                        <li>Pour ajouter un employé : cliquez sur "Nouvel employé"</li>
                                        <li>Remplissez les informations personnelles et professionnelles</li>
                                        <li>Affectez les rôles et permissions appropriés</li>
                                        <li>Les modifications sont automatiquement sauvegardées</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Documentation -->
<div class="modal fade" id="docModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-book me-2"></i>Documentation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6>Guides disponibles :</h6>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Guide de démarrage rapide
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-download me-1"></i>Télécharger
                        </a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Manuel utilisateur complet
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-download me-1"></i>Télécharger
                        </a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Guide de configuration
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-download me-1"></i>Télécharger
                        </a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        FAQ détaillée
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-download me-1"></i>Télécharger
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Vidéos -->
<div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-video me-2"></i>Tutoriels vidéo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-play-circle"></i>
                                </div>
                                <h6>Gestion des commandes</h6>
                                <p class="text-muted small">Durée: 5 min</p>
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-play me-1"></i>Lire
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-play-circle"></i>
                                </div>
                                <h6>Gestion des réservations</h6>
                                <p class="text-muted small">Durée: 7 min</p>
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-play me-1"></i>Lire
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-play-circle"></i>
                                </div>
                                <h6>Gestion des menus</h6>
                                <p class="text-muted small">Durée: 6 min</p>
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-play me-1"></i>Lire
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-play-circle"></i>
                                </div>
                                <h6>Analyses et statistiques</h6>
                                <p class="text-muted small">Durée: 8 min</p>
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-play me-1"></i>Lire
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Support -->
<div class="modal fade" id="supportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-headset me-2"></i>Support technique</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Notre équipe de support est disponible pour vous aider :</p>
                <ul class="list-group mb-3">
                    <li class="list-group-item">
                        <i class="fas fa-phone me-2 text-primary"></i>
                        Téléphone : <a href="tel:+2250767294255">+225 07 672 942 55</a>
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        Email : <a href="mailto:support@brunch.com">support@brunch.com</a>
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-clock me-2 text-primary"></i>
                        Horaires : Lun-Ven 8h-18h, Sam 9h-16h
                    </li>
                </ul>
                
                <form>
                    <div class="mb-3">
                        <label for="supportSujet" class="form-label">Sujet</label>
                        <input type="text" class="form-control" id="supportSujet" placeholder="Décrivez brièvement votre problème">
                    </div>
                    <div class="mb-3">
                        <label for="supportMessage" class="form-label">Description détaillée</label>
                        <textarea class="form-control" id="supportMessage" rows="4" placeholder="Expliquez en détail votre problème ou question"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-1"></i>Envoyer
                </button>
            </div>
        </div>
    </div>
</div>
@endsection