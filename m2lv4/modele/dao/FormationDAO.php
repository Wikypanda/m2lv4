<?php
require_once __DIR__ . '/DBConnex.php';

class FormationDAO {

    public static function ajouterFormation($intitule, $descriptif, $duree, $dateOuvert, $dateCloture, $nbPlaces) {
        $pdo = DBConnex::getInstance();
        $sql = "INSERT INTO formation (intitule, descriptif, duree, dateOuvertInscriptions, dateClotureInscriptions, nbPlaces, dateCreation)
                VALUES (:intitule, :descriptif, :duree, :dateOuvert, :dateCloture, :nbPlaces, CURDATE())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':intitule' => $intitule,
            ':descriptif' => $descriptif,
            ':duree' => $duree,
            ':dateOuvert' => $dateOuvert,
            ':dateCloture' => $dateCloture,
            ':nbPlaces' => $nbPlaces
        ]);
    }

    public static function modifierFormation($id, $intitule, $descriptif, $duree, $dateOuvert, $dateCloture, $nbPlaces) {
        $pdo = DBConnex::getInstance();
        $sql = "UPDATE formation SET intitule = :intitule, descriptif = :descriptif, duree = :duree,
                dateOuvertInscriptions = :dateOuvert, dateClotureInscriptions = :dateCloture, nbPlaces = :nbPlaces
                WHERE idForma = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':intitule' => $intitule,
            ':descriptif' => $descriptif,
            ':duree' => $duree,
            ':dateOuvert' => $dateOuvert,
            ':dateCloture' => $dateCloture,
            ':nbPlaces' => $nbPlaces
        ]);
    }

    public static function supprimerFormation($id) {
        $pdo = DBConnex::getInstance();
        $sql = "DELETE FROM formation WHERE idForma = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    public static function getFormationById($id) {
        $pdo = DBConnex::getInstance();
        $sql = "SELECT * FROM formation WHERE idForma = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode principale pour afficher les formations triées par date de création
    public static function getToutesFormations() {
        $pdo = DBConnex::getInstance();
        $sql = "SELECT idForma, intitule, descriptif, nbPlaces, duree, dateOuvertInscriptions, dateClotureInscriptions, dateCreation
                FROM formation
                ORDER BY dateClotureInscriptions ASC"; 
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    public static function getFormationsSelonProfil($isAdmin) {
        $pdo = DBConnex::getInstance();

        if ($isAdmin) {
            $sql = "SELECT idForma, intitule, descriptif, nbPlaces, duree, dateOuvertInscriptions, dateClotureInscriptions, dateCreation
                    FROM formation
                    ORDER BY dateCreation DESC";
        } else {
            $sql = "SELECT idForma, intitule, descriptif, nbPlaces, duree, dateOuvertInscriptions, dateClotureInscriptions, dateCreation
                    FROM formation
                    WHERE CURDATE() BETWEEN dateOuvertInscriptions AND dateClotureInscriptions
                    ORDER BY dateCreation DESC";
        }

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
