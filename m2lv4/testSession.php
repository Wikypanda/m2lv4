<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test Session</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f9f9f9;
        }
        .box {
            border: 1px solid #ccc;
            background-color: #fff;
            padding: 20px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .error {
            background-color: #ffe0e0;
            border-color: #f00;
        }
        .success {
            background-color: #e0ffe0;
            border-color: #0a0;
        }
    </style>
</head>
<body>
    <div class="box <?= !empty($_SESSION['utilisateur']) ? 'success' : 'error' ?>">
        <h2>Test de session utilisateur</h2>
        <?php if (!empty($_SESSION['utilisateur'])) : ?>
            <p><strong>✅ Utilisateur connecté</strong></p>
            
            <ul>
                <li><strong>ID :</strong> <?= htmlspecialchars($_SESSION['utilisateur']['idUser'] ?? 'non défini') ?></li>
                <li><strong>Type :</strong> <?= htmlspecialchars($_SESSION['utilisateur']['idTypeU'] ?? 'non défini') ?></li>
                <li><strong>Nom :</strong> <?= htmlspecialchars($_SESSION['utilisateur']['nom'] ?? 'non défini') ?></li>
                <li><strong>Prénom :</strong> <?= htmlspecialchars($_SESSION['utilisateur']['prenom'] ?? 'non défini') ?></li>
            </ul>
        <?php else : ?>
            <p><strong>❌ Aucun utilisateur connecté</strong></p>
        <?php endif; ?>
    </div>
</body>
</html>
