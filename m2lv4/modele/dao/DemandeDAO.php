<?php

require_once __DIR__ . '/DBConnex.php';

class DemandeDAO {

    public static function creerDemande($idUser, $idFormation) {
    $pdo = DBConnex::getInstance();

    // Vérifie si une demande annulée existe
    $sqlCheck = "SELECT idDemande FROM demande WHERE idUser = :idU AND idForma = :idF AND idStatut = 4";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':idU' => $idUser, ':idF' => $idFormation]);
    $annulee = $stmtCheck->fetch(PDO::FETCH_ASSOC);

    if ($annulee) {
        // Réactive la demande
        $sqlUpdate = "UPDATE demande SET idStatut = 1, dateDemande = NOW() WHERE idDemande = :idD";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->execute([':idD' => $annulee['idDemande']]);
    } else {
        // Crée une nouvelle demande
        $sql = "INSERT INTO demande (idUser, idForma, idStatut, dateDemande)
                VALUES (:idU, :idF, 1, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':idU' => $idUser, ':idF' => $idFormation]);
    }
}


    public static function getDemandesByUtilisateur($idUser) {
        $pdo = DBConnex::getInstance();
        $sql = "SELECT d.dateDemande, s.statutDemande, f.intitule
                FROM demande d
                JOIN formation f ON d.idForma = f.idForma
                JOIN statut s ON d.idStatut = s.idStatut
                WHERE d.idUser = :idU
                ORDER BY d.dateDemande DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':idU' => $idUser]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getDemandesByResponsable($idResponsable) {
        $pdo = DBConnex::getInstance();
        $sql = "SELECT d.idDemande, u.nom, u.prenom, f.intitule, d.dateDemande, s.statutDemande
                FROM demande d
                JOIN formation f ON d.idForma = f.idForma
                JOIN utilisateur u ON d.idUser = u.idUser
                JOIN statut s ON d.idStatut = s.idStatut
                WHERE f.idResponsable = :idR";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':idR' => $idResponsable]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function changerStatut($idDemande, $idStatut) {
        $pdo = DBConnex::getInstance();
        $sql = "UPDATE demande SET idStatut = :statut WHERE idDemande = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':statut' => $idStatut,
            ':id' => $idDemande
        ]);
    }

    public static function existeDemande($idUser, $idFormation) {
    $pdo = DBConnex::getInstance();
    $sql = "SELECT COUNT(*) 
            FROM demande 
            WHERE idUser = :idU AND idForma = :idF AND idStatut != 4"; // 4 = annulée
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':idU' => $idUser, ':idF' => $idFormation]);
    return $stmt->fetchColumn() > 0;
}


public static function supprimerDemande($idUser, $idFormation) {
    $pdo = DBConnex::getInstance();
    $sql = "DELETE FROM demande WHERE idUser = :idU AND idForma = :idF";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':idU' => $idUser,
        ':idF' => $idFormation
    ]);
}

    public static function getDemandesByUser($idUser) {
    $pdo = DBConnex::getInstance();
    $sql = "SELECT d.idForma, f.intitule, f.descriptif, f.duree, f.nbPlaces, d.dateDemande, d.idStatut
        FROM demande d
        JOIN formation f ON d.idForma = f.idForma
        WHERE d.idUser = :idU AND d.idStatut != 4";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':idU' => $idUser]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public static function getStatutDemande($idUser, $idFormation) {
    try {
        $pdo = DBConnex::getInstance();
        $sql = "SELECT s.statutDemande
                FROM demande d
                JOIN statut s ON d.idStatut = s.idStatut
                WHERE d.idUser = :idUser AND d.idForma = :idFormation";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idUser', $idUser);
        $stmt->bindParam(':idFormation', $idFormation);
        $stmt->execute();

        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat['statutDemande'] ?? null;

    } catch (PDOException $e) {
        return null;
    }
}

public static function getDemandesFiltrees($idFormation, $idIntervenant) {
    $pdo = DBConnex::getInstance();
    $sql = "SELECT d.idDemande, u.nom, u.prenom, f.idForma, f.intitule, f.nbPlaces, d.dateDemande, s.statutDemande, d.idStatut
            FROM demande d
            JOIN utilisateur u ON d.idUser = u.idUser
            JOIN formation f ON d.idForma = f.idForma
            JOIN statut s ON d.idStatut = s.idStatut
            WHERE 1=1";

    $params = [];

    if ($idFormation !== 'all') {
        $sql .= " AND f.idForma = :idF";
        $params[':idF'] = $idFormation;
    }

    $sql .= " ORDER BY d.dateDemande DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public static function getNombreInscrits($idFormation) {
    $pdo = DBConnex::getInstance();
    $sql = "SELECT COUNT(*) FROM demande WHERE idForma = :idF AND idStatut != 4";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':idF' => $idFormation]);
    return $stmt->fetchColumn();
}
 
public static function getNbTotalDemandes($idForma) {
    $pdo = DBConnex::getInstance();
    $sql = "SELECT COUNT(*) FROM demande WHERE idForma = :idForma";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idForma', $idForma);
    $stmt->execute();
    return $stmt->fetchColumn();
}

public static function getNbDemandesAdmise($idForma) {
    $pdo = DBConnex::getInstance();
    $sql = "SELECT COUNT(*) FROM demande WHERE idForma = :idForma AND idStatut = 2"; // 2 = accepté
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idForma', $idForma);
    $stmt->execute();
    return $stmt->fetchColumn();
}

public static function getDemandeById($idDemande) {
    $pdo = DBConnex::getInstance();
    $sql = "SELECT idDemande, idForma FROM demande WHERE idDemande = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $idDemande]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public static function getNbPlacesFormation($idForma) {
    $pdo = DBConnex::getInstance();
    $sql = "SELECT nbPlaces FROM formation WHERE idForma = :idF";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':idF' => $idForma]);
    return $stmt->fetchColumn();
}

}
