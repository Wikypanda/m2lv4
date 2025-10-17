<?php
require_once __DIR__ . '/../modele/dao/DBConnex.php';
require_once __DIR__ . '/../modele/dao/BulletinDAO.php';
require_once __DIR__ . '/../modele/dto/bulletin.php';

$id = $_POST['id'] ?? null;
$idIntervenant = $_POST['idIntervenant'] ?? '';
$mois = $_POST['mois'] ?? '';
$netAPayer = $_POST['netAPayer'] ?? '';
$dateEmission = $_POST['dateEmission'] ?? '';

if (!$id || !$idIntervenant || !$mois || $netAPayer === '' || !$dateEmission) {
    $_SESSION['message'] = "Erreur : tous les champs sont obligatoires.";
    $_SESSION['m2lMP'] = 'bulletins';
    header('Location: index.php');
    exit;
}

$bulletin = BulletinDAO::getById($id);
if (!$bulletin) {
    $_SESSION['message'] = "Bulletin introuvable.";
    $_SESSION['m2lMP'] = 'bulletins';
    header('Location: index.php');
    exit;
}

// Gérer l'upload du fichier PDF si présent
$fichierPath = $bulletin->getFichier(); // conserver l'ancien par défaut
if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/../uploads/bulletins';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $tmpName = $_FILES['fichier']['tmp_name'];
    $origName = basename($_FILES['fichier']['name']);
    $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
    if ($ext !== 'pdf') {
        $_SESSION['message'] = "Erreur : seul le format PDF est autorisé pour le bulletin.";
        $_SESSION['m2lMP'] = 'bulletins';
        header('Location: index.php');
        exit;
    }

    $newName = 'bulletin_' . $id . '_' . time() . '.pdf';
    $dest = $uploadDir . '/' . $newName;
    if (move_uploaded_file($tmpName, $dest)) {
        // stocker le chemin relatif utilisable dans les vues
        $fichierPath = 'uploads/bulletins/' . $newName;
        // optionnel: supprimer l'ancien fichier si existant
        if ($bulletin->getFichier() && file_exists(__DIR__ . '/../' . $bulletin->getFichier())) {
            @unlink(__DIR__ . '/../' . $bulletin->getFichier());
        }
    } else {
        $_SESSION['message'] = "Erreur lors de l'upload du fichier.";
        $_SESSION['m2lMP'] = 'bulletins';
        header('Location: index.php');
        exit;
    }
}

$bulletin->setIdIntervenant($idIntervenant);
$bulletin->setMois($mois);
$bulletin->setNetAPayer($netAPayer);
$bulletin->setDateEmission($dateEmission);
$bulletin->setFichier($fichierPath);

if (BulletinDAO::update($bulletin)) {
    $_SESSION['message'] = "Bulletin modifié avec succès.";
} else {
    $_SESSION['message'] = "Erreur lors de la modification du bulletin.";
}

$_SESSION['m2lMP'] = 'bulletins';
header('Location: index.php');
exit;
