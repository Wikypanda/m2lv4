<?php
require_once __DIR__ . '/../modele/dao/DemandeDAO.php';

if (!empty($_POST['idDemande'])) {
    $idDemande = $_POST['idDemande'];

    // Récupérer la formation liée à la demande
    $demande = DemandeDAO::getDemandeById($idDemande); 
    $idForma = $demande['idForma'];

    // Vérifier le nombre d'admis et la capacité
    $nbAdmis = DemandeDAO::getNbDemandesAdmise($idForma);
    $nbPlaces = DemandeDAO::getNbPlacesFormation($idForma); 


require_once __DIR__ . '/../modele/dao/DemandeDAO.php';

if (!empty($_POST['idDemande'])) {
    $idDemande = $_POST['idDemande'];

    // Récupérer la formation liée à la demande
    $demande = DemandeDAO::getDemandeById($idDemande); 
    $idForma = $demande['idForma'];

    // Vérifier le nombre d'admis et la capacité
    $nbAdmis = DemandeDAO::getNbDemandesAdmise($idForma);
    $nbPlaces = DemandeDAO::getNbPlacesFormation($idForma); 

    if ($nbAdmis < $nbPlaces) {
        DemandeDAO::changerStatut($idDemande, 2); // 2 = Validé
    } else {
        $_SESSION['messageErreur'] = "La formation est complète.";
    }
}

$_POST['m2lMP'] = 'adminDemandes';
include_once 'controleurAdminDemandes.php';


$_POST['m2lMP'] = 'adminDemandes';
include_once 'controleurAdminDemandes.php';

}