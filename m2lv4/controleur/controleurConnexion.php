<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../modele/dao/UtilisateurDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $mdp = $_POST['mdp'] ?? '';

    $utilisateur = UtilisateurDAO::verifierIdentifiants($login, $mdp);

    if ($utilisateur) {
        $_SESSION['identification'] = true;
        $_SESSION['utilisateur'] = [
            'idUser' => $utilisateur['idUser'],
            'nom' => $utilisateur['nom'],
            'prenom' => $utilisateur['prenom'],
            'idTypeU' => $utilisateur['idTypeU']
        ];
        $_SESSION['m2lMP'] = "accueil";
        header('Location: index.php'); 
        exit;
    } else {
        $_SESSION['identification'] = false;
        $_SESSION['erreurConnexion'] = "Identifiant incorrects.";
        $_SESSION['m2lMP'] = "connexion";
        header('Location: index.php'); 
        exit;
    }
}

// AFFICHAGE DU FORMULAIRE
$formulaireConnexion = new Formulaire('post', 'index.php', 'fConnexion', 'fConnexion');

$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabel('Identifiant :'));
$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputTexte('login', 'login', '', 1, 'Entrez votre identifiant', ''));
$formulaireConnexion->ajouterComposantTab();

$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabel('Mot de Passe :'));
$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputMdp('mdp', 'mdp', 1, 'Entrez votre mot de passe', ''));
$formulaireConnexion->ajouterComposantTab();

$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputSubmit('submitConnex', 'submitConnex', 'Valider'));
$formulaireConnexion->ajouterComposantTab();

$messageErreurConnexion = $_SESSION['erreurConnexion'] ?? "";
$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerMessage($messageErreurConnexion));
$formulaireConnexion->ajouterComposantTab();

$formulaireConnexion->creerFormulaire();

require_once 'vue/vueConnexion.php';
unset($_SESSION['erreurConnexion']);
