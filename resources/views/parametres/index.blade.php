@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-cog me-2"></i>Paramètres
                    </h4>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour
                    </a>
                </div>
                
                <div class="card-body">
                    <ul class="nav nav-tabs" id="parametresTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
                                <i class="fas fa-sliders-h me-1"></i>Général
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications" type="button" role="tab">
                                <i class="fas fa-bell me-1"></i>Notifications
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="securite-tab" data-bs-toggle="tab" data-bs-target="#securite" type="button" role="tab">
                                <i class="fas fa-shield-alt me-1"></i>Sécurité
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="apparence-tab" data-bs-toggle="tab" data-bs-target="#apparence" type="button" role="tab">
                                <i class="fas fa-palette me-1"></i>Apparence
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="parametresTabsContent">
                        <!-- Paramètres généraux -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5><i class="fas fa-building me-2"></i>Informations de l'entreprise</h5>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="nomEntreprise" class="form-label">Nom de l'entreprise</label>
                                                    <input type="text" class="form-control" id="nomEntreprise" value="BRUNCH Restaurant">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="adresse" class="form-label">Adresse</label>
                                                    <input type="text" class="form-control" id="adresse" value="Abidjan, Cocody Riviera Palmeraie">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="telephone" class="form-label">Téléphone</label>
                                                    <input type="text" class="form-control" id="telephone" value="+225 07 672 942 55">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" value="asaelaser@gmail.com">
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-1"></i>Enregistrer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5><i class="fas fa-clock me-2"></i>Horaires d'ouverture</h5>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="heureOuverture" class="form-label">Heure d'ouverture</label>
                                                    <input type="time" class="form-control" id="heureOuverture" value="08:00">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="heureFermeture" class="form-label">Heure de fermeture</label>
                                                    <input type="time" class="form-control" id="heureFermeture" value="20:00">
                                                </div>
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" id="weekend">
                                                    <label class="form-check-label" for="weekend">Ouvert le week-end</label>
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-1"></i>Enregistrer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="card">
                                        <div class="card-header">
                                            <h5><i class="fas fa-euro-sign me-2"></i>Devise</h5>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="devise" class="form-label">Devise principale</label>
                                                    <select class="form-select" id="devise">
                                                        <option>FCFA</option>
                                                        <option>Euro (€)</option>
                                                        <option>Dollar ($)</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-1"></i>Enregistrer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Paramètres de notifications -->
                        <div class="tab-pane fade" id="notifications" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5><i class="fas fa-envelope me-2"></i>Notifications par email</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="notifCommandes" checked>
                                                <label class="form-check-label" for="notifCommandes">
                                                    Notifications pour nouvelles commandes
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="notifReservations" checked>
                                                <label class="form-check-label" for="notifReservations">
                                                    Notifications pour nouvelles réservations
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="notifPaiements" checked>
                                                <label class="form-check-label" for="notifPaiements">
                                                    Notifications pour nouveaux paiements
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="notifStock" checked>
                                                <label class="form-check-label" for="notifStock">
                                                    Notifications pour niveau de stock bas
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i>Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5><i class="fas fa-bell me-2"></i>Notifications système</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="sonNotif" checked>
                                                <label class="form-check-label" for="sonNotif">
                                                    Activer le son des notifications
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="notifDesktop" checked>
                                                <label class="form-check-label" for="notifDesktop">
                                                    Notifications sur le bureau
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="notifMobile">
                                                <label class="form-check-label" for="notifMobile">
                                                    Notifications mobile
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i>Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Paramètres de sécurité -->
                        <div class="tab-pane fade" id="securite" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5><i class="fas fa-lock me-2"></i>Mot de passe</h5>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="ancienMdp" class="form-label">Ancien mot de passe</label>
                                                    <input type="password" class="form-control" id="ancienMdp">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nouveauMdp" class="form-label">Nouveau mot de passe</label>
                                                    <input type="password" class="form-control" id="nouveauMdp">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="confirmerMdp" class="form-label">Confirmer le nouveau mot de passe</label>
                                                    <input type="password" class="form-control" id="confirmerMdp">
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-1"></i>Changer le mot de passe
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5><i class="fas fa-user-shield me-2"></i>Sécurité du compte</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="doubleAuth" checked>
                                                <label class="form-check-label" for="doubleAuth">
                                                    Double authentification
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="connexionActive">
                                                <label class="form-check-label" for="connexionActive">
                                                    Afficher les connexions actives
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="sessionAuto">
                                                <label class="form-check-label" for="sessionAuto">
                                                    Déconnexion automatique après inactivité
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i>Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Paramètres d'apparence -->
                        <div class="tab-pane fade" id="apparence" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5><i class="fas fa-sun me-2"></i>Thème</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label">Mode d'affichage</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="themeMode" id="clair" checked>
                                                        <label class="form-check-label" for="clair">
                                                            Clair
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="themeMode" id="sombre">
                                                        <label class="form-check-label" for="sombre">
                                                            Sombre
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="themeMode" id="auto">
                                                        <label class="form-check-label" for="auto">
                                                            Automatique
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Couleur d'accentuation</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="accentColor" id="bleu" checked>
                                                        <label class="form-check-label" for="bleu">
                                                            Bleu
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="accentColor" id="vert">
                                                        <label class="form-check-label" for="vert">
                                                            Vert
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="accentColor" id="orange">
                                                        <label class="form-check-label" for="orange">
                                                            Orange
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i>Appliquer le thème
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5><i class="fas fa-language me-2"></i>Langue</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="langue" class="form-label">Langue de l'interface</label>
                                                <select class="form-select" id="langue">
                                                    <option>Français</option>
                                                    <option>English</option>
                                                    <option>Español</option>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="fuseauHoraire" class="form-label">Fuseau horaire</label>
                                                <select class="form-select" id="fuseauHoraire">
                                                    <option>UTC+00:00 (GMT)</option>
                                                    <option selected>UTC+01:00 (CET)</option>
                                                    <option>UTC+02:00 (CEST)</option>
                                                </select>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i>Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection