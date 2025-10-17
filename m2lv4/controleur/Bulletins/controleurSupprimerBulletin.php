<?php
require_once __DIR__ . '/../modele/dao/DBConnex.php';
require_once __DIR__ . '/../modele/dao/BulletinDAO.php';

$id = $_POST['idBulletin'] ?? null;
if ($id) {
    // Récupérer le bulletin avant suppression pour gérer le fichier si nécessaire
    $bulletin = BulletinDAO::getById($id);
    
    if ($bulletin) {
        // Supprimer le fichier PDF associé s'il existe
        $fichier = $bulletin->getFichier();
        if ($fichier && file_exists($fichier)) {
            unlink($fichier);
        }
        
        // Supprimer le bulletin de la base de données
        BulletinDAO::supprimer($id);
        $_SESSION['message'] = "Bulletin supprimé.";
    } else {
        $_SESSION['message'] = "Erreur : bulletin introuvable.";
    }
} else {
    $_SESSION['message'] = "Erreur : bulletin introuvable.";
}

$_SESSION['m2lMP'] = 'bulletins';
header('Location: index.php');
exit;