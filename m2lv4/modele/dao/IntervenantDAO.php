<?php

require_once(__DIR__ . '/../dto/intervenant.php');

class IntervenantDAO {
    
    // Alias pour compatibilité avec les contrôleurs
    public static function ajouterIntervenant(Intervenant $unIntervenant) {
        return self::creer($unIntervenant);
    }
    
    public static function modifierIntervenant(Intervenant $unIntervenant) {
        return self::modifier($unIntervenant);
    }
    
    public static function supprimerIntervenant($unIdIntervenant) {
        return self::supprimer($unIdIntervenant);
    }
    
    public static function getIntervenantById($unIdIntervenant) {
        return self::lireParId($unIdIntervenant);
    }
    
    public static function creer(Intervenant $unIntervenant) {
        $db = DBConnex::getInstance();
        $sql = "INSERT INTO intervenants (nom, prenom, email, telephone, adresse, statut, 
                date_embauche, rattachement_type, rattachement_nom) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $db->prepare($sql);
        $success = $stmt->execute([
            $unIntervenant->getNom(),
            $unIntervenant->getPrenom(),
            $unIntervenant->getEmail(),
            $unIntervenant->getTelephone(),
            $unIntervenant->getAdresse(),
            $unIntervenant->getStatut(),
            $unIntervenant->getDateEmbauche(),
            $unIntervenant->getRattachementType(),
            $unIntervenant->getRattachementNom()
        ]);
        
        if ($success) {
            return $db->lastInsertId();
        }
        return false;
    }
    
    public static function lireTous() {
        $db = DBConnex::getInstance();
        $sql = "SELECT * FROM intervenants WHERE actif = 1 ORDER BY nom, prenom";
        $stmt = $db->query($sql);
        
        $intervenants = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $intervenants[] = self::construireIntervenant($row);
        }
        return $intervenants;
    }
    
    public static function lireParId($unIdIntervenant) {
        $db = DBConnex::getInstance();
        $sql = "SELECT * FROM intervenants WHERE id_intervenant = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$unIdIntervenant]);
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return self::construireIntervenant($row);
        }
        return null;
    }
    
    public static function lireParEmail($unEmail) {
        $db = DBConnex::getInstance();
        $sql = "SELECT * FROM intervenants WHERE email = ? AND actif = 1";
        $stmt = $db->prepare($sql);
        $stmt->execute([$unEmail]);
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return self::construireIntervenant($row);
        }
        return null;
    }
    
    public static function modifier(Intervenant $unIntervenant) {
        $db = DBConnex::getInstance();
        $sql = "UPDATE intervenants SET nom = ?, prenom = ?, email = ?, telephone = ?, 
                adresse = ?, statut = ?, date_embauche = ?, rattachement_type = ?, 
                rattachement_nom = ? WHERE id_intervenant = ?";
        
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            $unIntervenant->getNom(),
            $unIntervenant->getPrenom(),
            $unIntervenant->getEmail(),
            $unIntervenant->getTelephone(),
            $unIntervenant->getAdresse(),
            $unIntervenant->getStatut(),
            $unIntervenant->getDateEmbauche(),
            $unIntervenant->getRattachementType(),
            $unIntervenant->getRattachementNom(),
            $unIntervenant->getIdIntervenant()
        ]);
    }
    
    public static function supprimer($unIdIntervenant) {
        $db = DBConnex::getInstance();
        $sql = "UPDATE intervenants SET actif = 0 WHERE id_intervenant = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$unIdIntervenant]);
    }
    
    public static function lireParStatut($unStatut) {
        $db = DBConnex::getInstance();
        $sql = "SELECT * FROM intervenants WHERE statut = ? AND actif = 1 ORDER BY nom, prenom";
        $stmt = $db->prepare($sql);
        $stmt->execute([$unStatut]);
        
        $intervenants = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $intervenants[] = self::construireIntervenant($row);
        }
        return $intervenants;
    }
    
    private static function construireIntervenant($row) {
        $intervenant = new Intervenant();
        $intervenant->setIdIntervenant($row['id_intervenant']);
        $intervenant->setNom($row['nom']);
        $intervenant->setPrenom($row['prenom']);
        $intervenant->setEmail($row['email']);
        $intervenant->setTelephone($row['telephone'] ?? '');
        $intervenant->setAdresse($row['adresse'] ?? '');
        $intervenant->setStatut($row['statut']);
        $intervenant->setDateEmbauche($row['date_embauche'] ?? null);
        $intervenant->setActif($row['actif']);
        
        // Récupérer les rattachements s'ils existent
        if (isset($row['rattachement_type'])) {
            $intervenant->setRattachementType($row['rattachement_type']);
        }
        if (isset($row['rattachement_nom'])) {
            $intervenant->setRattachementNom($row['rattachement_nom']);
        }
        
        return $intervenant;
    }
}