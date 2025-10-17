<?php
require_once 'param.php';

class UtilisateurDAO {

    public static function verifierIdentifiants($login, $motDePasse) {
        try {
            $pdo = new PDO(Param::$dsn, Param::$user, Param::$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE login = :login");
            $stmt->bindParam(':login', $login);
            $stmt->execute();

            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($utilisateur && password_verify($motDePasse, $utilisateur['mdp'])) {
    return [
        'idUser' => $utilisateur['idUser'],         
        'nom' => $utilisateur['nom'],
        'prenom' => $utilisateur['prenom'],
        'idTypeU' => $utilisateur['idTypeU']       
    ];
} else {
                return false;
            }

        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getIntervenants() {
    $pdo = DBConnex::getInstance();
    $sql = "SELECT idUser, nom, prenom 
            FROM utilisateur 
            WHERE idTypeU = 2 
            ORDER BY nom, prenom";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}

