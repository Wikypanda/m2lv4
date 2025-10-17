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

// Récupération des données
$idIntervenant = $_POST['id_intervenant'] ?? null;
// Vérifier token CSRF
$token = $_POST['csrf_token'] ?? null;
if (!$token || !validate_csrf_token($token)) {
    $_SESSION['message'] = "Requête invalide (token CSRF manquant ou invalide).";
    $_SESSION['messageType'] = "error";
    $_SESSION['m2lMP'] = 'modifierIntervenant';
    $_POST['id_intervenant'] = $idIntervenant;
    header('Location: index.php');
    exit;
}
$nom = trim($_POST['nom'] ?? '');
$prenom = trim($_POST['prenom'] ?? '');
$email = trim($_POST['email'] ?? '');
$telephone = trim($_POST['telephone'] ?? '');
$adresse = trim($_POST['adresse'] ?? '');
$statut = $_POST['statut'] ?? '';
$dateEmbauche = $_POST['date_embauche'] ?? '';
$rattachementType = $_POST['rattachement_type'] ?? 'm2l';
$rattachementNom = trim($_POST['rattachement_nom'] ?? '');

// Validation
if (!$idIntervenant) {
    $_SESSION['message'] = "Identifiant de l'intervenant manquant.";
    $_SESSION['messageType'] = "error";
    $_SESSION['m2lMP'] = 'intervenants';
    header('Location: index.php');
    exit;
}
// Validation par champ
$errors = [];
if (empty($nom)) {
    $errors['nom'] = "Le nom est obligatoire.";
}
if (empty($prenom)) {
    $errors['prenom'] = "Le prénom est obligatoire.";
}
if (empty($email)) {
    $errors['email'] = "L'email est obligatoire.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "L'adresse email n'est pas valide.";
} else {
    // vérifier terminaison .com ou .fr si nécessaire
    if (!preg_match('/\.(com|fr)$/i', $email)) {
        $errors['email'] = "L'adresse doit se terminer par .com ou .fr";
    }
}

if (empty($statut) || !in_array($statut, ['salarie', 'benevole'])) {
    $errors['statut'] = "Le statut doit être 'salarie' ou 'benevole'.";
}

// Si erreurs, préserver les données et les erreurs en session et renvoyer à la vue
if (!empty($errors)) {
    $_SESSION['formErrors'] = $errors;
    $_SESSION['formData'] = [
        'id_intervenant' => $idIntervenant,
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'telephone' => $telephone,
        'adresse' => $adresse,
        'statut' => $statut,
        'date_embauche' => $dateEmbauche,
        'rattachement_type' => $rattachementType,
        'rattachement_nom' => $rattachementNom,
    ];
    $_SESSION['m2lMP'] = 'modifierIntervenant';
    header('Location: index.php');
    exit;
}

try {
    // Créer l'objet Intervenant avec les nouvelles données
    $intervenant = new Intervenant(
        $idIntervenant,
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

    // Mettre à jour l'intervenant
    $success = IntervenantDAO::modifierIntervenant($intervenant);

    if ($success) {
        $_SESSION['message'] = "Intervenant modifié avec succès.";
        $_SESSION['messageType'] = "success";
    } else {
        $_SESSION['message'] = "Erreur lors de la modification de l'intervenant.";
        $_SESSION['messageType'] = "error";
    }
} catch (Exception $e) {
    $_SESSION['message'] = "Erreur : " . $e->getMessage();
    $_SESSION['messageType'] = "error";
}

$_SESSION['m2lMP'] = 'intervenants';
header('Location: index.php');
exit;