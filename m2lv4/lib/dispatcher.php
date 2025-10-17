<?php
class dispatcher {
    public static function dispatch($unMenuP) {
        switch ($unMenuP) {
            case "ajouterFormation":
                return "controleur/controleurAjouterFormation.php";            
            case "validerAjoutFormation":
                return "controleur/controleurValiderAjoutFormation.php";
            case "mesDemandes":
                return "controleur/controleurMesDemandes.php";
            case "intervenants":
                return "controleur/controleurIntervenant.php";
            case "modifierFormation":
                return "controleur/controleurModifierFormation.php";
            case "supprimerFormation":
                return "controleur/controleurSupprimerFormation.php";
            case "supprimerBulletin":
                return "controleur/controleurSupprimerBulletin.php";
            case "annulerDemande":
                return "controleur/controleurAnnulerDemande.php";          
            case 'validerDemande':
                return "controleur/controleurValiderDemande.php";
            case 'refuserDemande':
                return "controleur/controleurRefuserDemande.php";
            default:
                return "controleur/controleur" . ucfirst($unMenuP) . ".php";
        }
    }
}