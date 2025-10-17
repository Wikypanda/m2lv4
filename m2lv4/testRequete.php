<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=m2l', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $login = 'esteban';
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE login = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();

    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur) {
        echo "✅ Utilisateur trouvé :<br>";
        print_r($utilisateur);
        $motDePasse = 'azerty';

        if (password_verify($motDePasse, $utilisateur['mdp'])) {
            echo "<br>✅ Mot de passe valide !";
        } else {
            echo "<br>❌ Mot de passe incorrect.";
        }
    } else {
        echo "❌ Aucun utilisateur trouvé.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
