<?php
require_once __DIR__ . '/DBConnex.php';
require_once __DIR__ . '/../dto/bulletin.php';

class BulletinDAO {
    public static function getAll() {
        $db = DBConnex::getInstance();
        $sql = "SELECT * FROM bulletin ORDER BY dateEmission DESC";
        $stmt = $db->query($sql);
        $res = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $b = new Bulletin($row['id'], $row['idIntervenant'], $row['mois'], $row['netAPayer'], $row['dateEmission'], $row['fichier']);
            $res[] = $b;
        }
        return $res;
    }

    public static function getByIntervenant($idIntervenant) {
        $db = DBConnex::getInstance();
        $sql = "SELECT * FROM bulletin WHERE idIntervenant = ? ORDER BY dateEmission DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute([$idIntervenant]);
        $res = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $b = new Bulletin($row['id'], $row['idIntervenant'], $row['mois'], $row['netAPayer'], $row['dateEmission'], $row['fichier']);
            $res[] = $b;
        }
        return $res;
    }

    public static function getById($id) {
        $db = DBConnex::getInstance();
        $sql = "SELECT * FROM bulletin WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Bulletin($row['id'], $row['idIntervenant'], $row['mois'], $row['netAPayer'], $row['dateEmission'], $row['fichier']);
        }
        return null;
    }

    public static function update(Bulletin $b) {
        $db = DBConnex::getInstance();
        $sql = "UPDATE bulletin SET idIntervenant = ?, mois = ?, netAPayer = ?, dateEmission = ?, fichier = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$b->getIdIntervenant(), $b->getMois(), $b->getNetAPayer(), $b->getDateEmission(), $b->getFichier(), $b->getId()]);
    }

    public static function create(Bulletin $b) {
        $db = DBConnex::getInstance();
        $sql = "INSERT INTO bulletin (idIntervenant, mois, netAPayer, dateEmission, fichier) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $success = $stmt->execute([$b->getIdIntervenant(), $b->getMois(), $b->getNetAPayer(), $b->getDateEmission(), $b->getFichier()]);
        if ($success) return $db->lastInsertId();
        return false;
    }
}
