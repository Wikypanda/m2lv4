<?php
require_once __DIR__ . '/DBConnex.php';
require_once __DIR__ . '/../dto/contrat.php';

class ContratDAO {
    
    // Récupérer tous les contrats avec infos utilisateur
    public static function getAllContrats() {
        $db = DBConnex::getInstance();
        $sql = "SELECT c.*, u.nom, u.prenom, u.login 
                FROM contrat c
                LEFT JOIN utilisateur u ON c.idUser = u.idUser
                ORDER BY c.dateDebut DESC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les contrats d'un utilisateur
    public static function getContratsByUser($idUser) {
        $db = DBConnex::getInstance();
        $sql = "SELECT c.*, u.nom, u.prenom 
                FROM contrat c
                LEFT JOIN utilisateur u ON c.idUser = u.idUser
                WHERE c.idUser = ?
                ORDER BY c.dateDebut DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute([$idUser]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un contrat par ID
    public static function getContratById($idContrat) {
        $db = DBConnex::getInstance();
        $sql = "SELECT c.*, u.nom, u.prenom 
                FROM contrat c
                LEFT JOIN utilisateur u ON c.idUser = u.idUser
                WHERE c.idContrat = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$idContrat]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Contrat(
                $row['idContrat'],
                $row['dateDebut'],
                $row['dateFin'],
                $row['typeContrat'],
                $row['nbHeures'],
                $row['idUser'],
                $row['salaireBrut'],
                $row['actif']
            );
        }
        return null;
    }

    // Créer un nouveau contrat
    public static function creerContrat(Contrat $contrat) {
        $db = DBConnex::getInstance();
        $sql = "INSERT INTO contrat (idContrat, dateDebut, dateFin, typeContrat, 
                nbHeures, idUser, salaireBrut, actif) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $db->prepare($sql);
        $success = $stmt->execute([
            $contrat->getIdContrat(),
            $contrat->getDateDebut(),
            $contrat->getDateFin(),
            $contrat->getTypeContrat(),
            $contrat->getNbHeures(),
            $contrat->getIdUser(),
            $contrat->getSalaireBrut(),
            $contrat->getActif() ? 1 : 0
        ]);
        
        return $success;
    }

    // Modifier un contrat
    public static function modifierContrat(Contrat $contrat) {
        $db = DBConnex::getInstance();
        $sql = "UPDATE contrat 
                SET dateDebut = ?, dateFin = ?, typeContrat = ?, 
                    nbHeures = ?, idUser = ?, salaireBrut = ?, actif = ?
                WHERE idContrat = ?";
        
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            $contrat->getDateDebut(),
            $contrat->getDateFin(),
            $contrat->getTypeContrat(),
            $contrat->getNbHeures(),
            $contrat->getIdUser(),
            $contrat->getSalaireBrut(),
            $contrat->getActif() ? 1 : 0,
            $contrat->getIdContrat()
        ]);
    }

    // Supprimer un contrat (soft delete)
    public static function supprimerContrat($idContrat) {
        $db = DBConnex::getInstance();
        $sql = "UPDATE contrat SET actif = 0 WHERE idContrat = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$idContrat]);
    }

    // Supprimer définitivement
    public static function supprimerDefinitif($idContrat) {
        $db = DBConnex::getInstance();
        $sql = "DELETE FROM contrat WHERE idContrat = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$idContrat]);
    }

    // Vérifier si un ID contrat existe déjà
    public static function contratExiste($idContrat) {
        $db = DBConnex::getInstance();
        $sql = "SELECT COUNT(*) FROM contrat WHERE idContrat = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$idContrat]);
        return $stmt->fetchColumn() > 0;
    }

    // Récupérer les contrats actifs
    public static function getContratsActifs() {
        $db = DBConnex::getInstance();
        $sql = "SELECT c.*, u.nom, u.prenom 
                FROM contrat c
                LEFT JOIN utilisateur u ON c.idUser = u.idUser
                WHERE c.actif = 1 AND (c.dateFin IS NULL OR c.dateFin >= CURDATE())
                ORDER BY c.dateDebut DESC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les utilisateurs disponibles
    public static function getUtilisateursDisponibles() {
        $db = DBConnex::getInstance();
        $sql = "SELECT idUser, nom, prenom, login FROM utilisateur ORDER BY nom, prenom";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>