<?php
require_once __DIR__ . '/../modele/dao/DemandeDAO.php';
require_once __DIR__ . '/../modele/dao/FormationDAO.php';
require_once __DIR__ . '/../modele/dao/UtilisateurDAO.php';

$formations = FormationDAO::getToutesFormations(); 
$intervenants = UtilisateurDAO::getIntervenants(); 

$filtreFormation = $_POST['filtreFormation'] ?? 'all';
$filtreIntervenant = $_POST['filtreIntervenant'] ?? 'all';

$demandes = DemandeDAO::getDemandesFiltrees($filtreFormation, $filtreIntervenant);

foreach ($demandes as &$demande) {
    $idForma = $demande['idForma'] ?? null;

    if ($idForma !== null) {
        $demande['nbAdmis'] = DemandeDAO::getNbDemandesAdmise($idForma);
    } else {
        $demande['nbAdmis'] = 0;
        $demande['nbPlaces'] = 0;
    }
}


$_SESSION['formations'] = $formations;
$_SESSION['intervenants'] = $intervenants;
$_SESSION['demandesFiltrees'] = $demandes;
$_SESSION['m2lMP'] = 'adminDemandes';

require_once 'vue/vueAdminDemandes.php';
