<?php
include_once __DIR__ . '/param.php';
include_once __DIR__ . '/dBConnex.php';

function getAllLigues() {
    try {
        $pdo = DBConnex::getInstance();
        $sql = "SELECT * FROM ligue";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur getAllLigues : " . $e->getMessage());
        return [];
    }
}

function getClubsByLigue($idLigue) {
    try {
        $pdo = DBConnex::getInstance();
        $sql = "SELECT * FROM club WHERE idLigue = :idLigue";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idLigue', $idLigue, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur getClubsByLigue : " . $e->getMessage());
        return [];
    }
}

function ajouterLigue($nom, $site, $descriptif) {
    $pdo = DBConnex::getInstance();
    $sql = "INSERT INTO ligue (nomLigue, site, descriptif) VALUES (:nom, :site, :desc)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':site' => $site,
        ':desc' => $descriptif
    ]);
}

function modifierLigue($id, $nom, $site, $descriptif) {
    $pdo = DBConnex::getInstance();
    $sql = "UPDATE ligue SET nomLigue = :nom, site = :site, descriptif = :desc WHERE idLigue = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':site' => $site,
        ':desc' => $descriptif,
        ':id' => $id
    ]);
}

function supprimerLigue($id) {
    $pdo = DBConnex::getInstance();
    $sql = "DELETE FROM ligue WHERE idLigue = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

