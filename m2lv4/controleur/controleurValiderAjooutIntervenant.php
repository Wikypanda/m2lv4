<?php
if (!isset($_SESSION['identification']) || $_SESSION['utilisateur']['idTypeU'] != 1) {
    $_SESSION['erreurAcces'] = "Accès réservé aux administrateurs.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/DBConnex.php';
require_once __DIR__ . '/../modele/dao/IntervenantDAO.php';
require_once __DIR__ . '/../modele/dto/intervenant.php';
require_once __DIR__ . '/../lib/fonctionsUtiles.php';

// Vérification CSRF
$token = $_POST['csrf_token'] ?? null;
if (!$token || !validate_csrf_token($token)) {
    $_SESSION['message'] = "Requête invalide (token CSRF manquant ou invalide).";
    $_SESSION['messageType'] = "error";
    // préserver les données de formulaire pour ré-affichage
    $_SESSION['formData'] = $_POST;
    $_SESSION['m2lMP'] = 'ajouterIntervenant';
    header('Location: index.php');
    exit;
}

// Récupération et validation des données
$nom = trim($_POST['nom'] ?? '');
$prenom = trim($_POST['prenom'] ?? '');
$email = trim($_POST['email'] ?? '');
$telephone = trim($_POST['telephone'] ?? '');
$adresse = trim($_POST['adresse'] ?? '');
$statut = $_POST['statut'] ?? '';
$dateEmbauche = $_POST['date_embauche'] ?? date('Y-m-d');
$rattachementType = $_POST['rattachement_type'] ?? 'm2l';
$rattachementNom = trim($_POST['rattachement_nom'] ?? '');

// Validation des champs côté serveur avec messages par champ
$errors = [];
if (empty($nom)) $errors['nom'] = 'Le nom est obligatoire.';
if (empty($prenom)) $errors['prenom'] = 'Le prénom est obligatoire.';
if (empty($email)) {
    $errors['email'] = 'L\'email est obligatoire.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "L'adresse email n'est pas valide.";
} else {
    // Vérifier si l'email existe déjà (intervenant actif)
    $existant = IntervenantDAO::lireParEmail($email);
    if ($existant) {
        $errors['email'] = "Cette adresse email est déjà utilisée par un autre intervenant.";
    }
}

if (empty($statut) || !in_array($statut, ['salarie', 'benevole'])) {
    $errors['statut'] = "Le statut doit être 'salarie' ou 'benevole'.";
}

if (!empty($errors)) {
    $_SESSION['message'] = "Veuillez corriger les erreurs dans le formulaire.";
    $_SESSION['messageType'] = 'error';
    $_SESSION['formErrors'] = $errors;
    $_SESSION['formData'] = $_POST;
    $_SESSION['m2lMP'] = 'ajouterIntervenant';
    header('Location: index.php');
    exit;
}

try {
    // Créer l'objet Intervenant
    $intervenant = new Intervenant(
        null,
        $nom,
        $prenom,
        $email,
        $telephone,
        $adresse,
        $statut,
        $dateEmbauche,
        true,
        $rattachementType,
        $rattachementNom
    );

    // Ajouter l'intervenant en base de données
    $idIntervenant = IntervenantDAO::ajouterIntervenant($intervenant);

    if ($idIntervenant) {
        $_SESSION['message'] = "Intervenant ajouté avec succès.";
        $_SESSION['messageType'] = "success";
    } else {
        $_SESSION['message'] = "Erreur lors de l'ajout de l'intervenant.";
        $_SESSION['messageType'] = "error";
    }
} catch (Exception $e) {
    $_SESSION['message'] = "Erreur : " . $e->getMessage();
    $_SESSION['messageType'] = "error";
}

$_SESSION['m2lMP'] = 'intervenants';
header('Location: index.php');
exit;