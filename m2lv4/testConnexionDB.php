<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=m2l', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Connexion à la base réussie !";
} catch (PDOException $e) {
    echo "❌ Erreur de connexion : " . $e->getMessage();
}
