<?php
require_once __DIR__ . '/../modele/dao/DemandeDAO.php';

if (!empty($_POST['idDemande'])) {
    $idDemande = $_POST['idDemande'];
    DemandeDAO::changerStatut($idDemande, 3); // 3 = Refusé
    $_SESSION['message'] = "❌ La demande a été refusée.";
}

$_POST['m2lMP'] = 'adminDemandes';
include_once 'controleurAdminDemandes.php';
?>
