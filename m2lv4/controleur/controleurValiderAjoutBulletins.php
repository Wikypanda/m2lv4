<?php
if (!isset($_SESSION['identification']) || $_SESSION['utilisateur']['idTypeU'] != 1) {
    $_SESSION['erreurAcces'] = "Accès réservé aux administrateurs.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/DBConnex.php';
require_once __DIR__ . '/../modele/dao/BulletinDAO.php';
require_once __DIR__ . '/../modele/dto/bulletin.php';

$idIntervenant = $_POST['idIntervenant'] ?? '';
$mois = $_POST['mois'] ?? '';
$netAPayer = $_POST['netAPayer'] ?? '';
$dateEmission = $_POST['dateEmission'] ?? '';

if ($idIntervenant && $mois && $netAPayer !== '' && $dateEmission) {
    $fichierPath = null;
    // gérer l'upload si présent
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

        $newName = 'bulletin_' . time() . '.pdf';
        $dest = $uploadDir . '/' . $newName;
        if (move_uploaded_file($tmpName, $dest)) {
            $fichierPath = 'uploads/bulletins/' . $newName;
        } else {
            $_SESSION['message'] = "Erreur lors de l'upload du fichier.";
            $_SESSION['m2lMP'] = 'bulletins';
            header('Location: index.php');
            exit;
        }
    }

    $b = new Bulletin(null, $idIntervenant, $mois, $netAPayer, $dateEmission, $fichierPath);
    $res = BulletinDAO::create($b);
    if ($res) {
        $_SESSION['message'] = "Bulletin ajouté avec succès.";
    } else {
        $_SESSION['message'] = "Erreur lors de l'ajout du bulletin.";
    }
} else {
    $_SESSION['message'] = "Tous les champs sont obligatoires.";
}

$_SESSION['m2lMP'] = 'bulletins';
header('Location: index.php');
exit;
